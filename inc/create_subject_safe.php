<?php
session_start();
require_once 'inc/config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
    exit;
}

// Validate required fields
if (empty($input['name'])) {
    echo json_encode(['success' => false, 'message' => 'Subject name is required']);
    exit;
}

$name = trim($input['name']);
$description = trim($input['description'] ?? '');
$icon = trim($input['icon'] ?? 'fas fa-book');
$user_id = $_SESSION['user_id'];

// Validate inputs
if (strlen($name) > 100) {
    echo json_encode(['success' => false, 'message' => 'Subject name too long (max 100 characters)']);
    exit;
}

if (strlen($description) > 255) {
    echo json_encode(['success' => false, 'message' => 'Description too long (max 255 characters)']);
    exit;
}

// Validate icon format
if (!preg_match('/^(fas|far|fab) fa-[\w-]+$/', $icon)) {
    $icon = 'fas fa-book';
}

try {
    // Check current table structure
    $stmt = $pdo->query("DESCRIBE subjects");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $has_user_id = in_array('user_id', $columns);
    $has_updated_at = in_array('updated_at', $columns);
    
    // If missing user_id, we need to update the schema
    if (!$has_user_id) {
        // Add user_id column
        $pdo->exec("ALTER TABLE subjects ADD COLUMN user_id INT NOT NULL DEFAULT " . intval($user_id));
        
        // Add foreign key
        try {
            $pdo->exec("ALTER TABLE subjects ADD CONSTRAINT fk_subjects_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE");
        } catch (Exception $e) {
            // Foreign key might already exist or users table issue
        }
        
        // Handle unique constraints
        try {
            // Check what indexes exist
            $stmt = $pdo->query("SHOW INDEX FROM subjects");
            $indexes = $stmt->fetchAll();
            
            foreach ($indexes as $index) {
                if ($index['Key_name'] == 'name' && $index['Non_unique'] == 0) {
                    $pdo->exec("ALTER TABLE subjects DROP INDEX name");
                    break;
                }
            }
        } catch (Exception $e) {
            // Index might not exist
        }
        
        // Add new unique constraint
        try {
            $pdo->exec("ALTER TABLE subjects ADD UNIQUE KEY unique_user_subject (user_id, name)");
        } catch (Exception $e) {
            // Constraint might already exist
        }
    }
    
    // Add updated_at if missing
    if (!$has_updated_at) {
        try {
            $pdo->exec("ALTER TABLE subjects ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        } catch (Exception $e) {
            // Column might already exist
        }
    }
    
    // Now check for duplicates
    $stmt = $pdo->prepare("SELECT id FROM subjects WHERE user_id = ? AND name = ?");
    $stmt->execute([$user_id, $name]);
    
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'You already have a subject with this name']);
        exit;
    }
    
    // Create the subject
    $stmt = $pdo->prepare("INSERT INTO subjects (user_id, name, description, icon, created_at) VALUES (?, ?, ?, ?, NOW())");
    $result = $stmt->execute([$user_id, $name, $description, $icon]);
    
    if ($result) {
        $subject_id = $pdo->lastInsertId();
        
        // Create directory for subject files
        $subject_dir = "../uploads/{$user_id}/subjects/{$subject_id}";
        if (!file_exists($subject_dir)) {
            mkdir($subject_dir, 0755, true);
        }
        
        echo json_encode([
            'success' => true, 
            'message' => 'Subject created successfully',
            'subject_id' => $subject_id
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create subject']);
    }
    
} catch (Exception $e) {
    error_log("Error creating subject: " . $e->getMessage());
    
    // More user-friendly error messages
    $error_message = 'Database error occurred';
    
    if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
        $error_message = 'A subject with this name already exists';
    } elseif (strpos($e->getMessage(), 'foreign key') !== false) {
        $error_message = 'Database relationship error - please contact support';
    } elseif (strpos($e->getMessage(), 'syntax') !== false) {
        $error_message = 'Database syntax error - schema update needed';
    }
    
    echo json_encode([
        'success' => false, 
        'message' => $error_message,
        'debug' => $e->getMessage()
    ]);
}
?>