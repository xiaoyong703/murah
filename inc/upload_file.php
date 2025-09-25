<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$subject_id = isset($_POST['subject_id']) ? (int)$_POST['subject_id'] : null;
$description = $_POST['description'] ?? '';

// Handle multiple files
$files = [];
if (isset($_FILES['files'])) {
    $files = $_FILES['files'];
} elseif (isset($_FILES['file'])) {
    // Single file - convert to array format
    $files = [
        'name' => [$_FILES['file']['name']],
        'type' => [$_FILES['file']['type']],
        'tmp_name' => [$_FILES['file']['tmp_name']],
        'error' => [$_FILES['file']['error']],
        'size' => [$_FILES['file']['size']]
    ];
}

if (empty($files) || empty($files['name'])) {
    echo json_encode(['success' => false, 'message' => 'No files uploaded']);
    exit;
}

try {
    // Check if uploaded_files table exists, create if not
    $stmt = $pdo->query("SHOW TABLES LIKE 'uploaded_files'");
    if (!$stmt->fetch()) {
        $pdo->exec("CREATE TABLE uploaded_files (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            subject_id INT,
            filename VARCHAR(255) NOT NULL,
            original_filename VARCHAR(255) NOT NULL,
            file_path TEXT NOT NULL,
            file_size INT NOT NULL,
            mime_type VARCHAR(100),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )");
        
        // Add foreign key for subject_id if subjects table has user_id column
        try {
            $stmt = $pdo->query("SHOW COLUMNS FROM subjects LIKE 'user_id'");
            if ($stmt->fetch()) {
                $pdo->exec("ALTER TABLE uploaded_files ADD FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE");
            }
        } catch (Exception $e) {
            // Ignore foreign key errors
        }
    }
    
    // Create upload directory
    $base_upload_dir = "../uploads/{$user_id}/";
    if ($subject_id) {
        $base_upload_dir .= "subjects/{$subject_id}/";
    }
    
    if (!file_exists($base_upload_dir)) {
        mkdir($base_upload_dir, 0755, true);
    }
    
    $uploaded_files = [];
    $allowed_types = [
        'application/pdf', 'image/jpeg', 'image/png', 'image/gif', 
        'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'text/plain', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];
    
    // Process each file
    for ($i = 0; $i < count($files['name']); $i++) {
        $file_name = $files['name'][$i];
        $file_type = $files['type'][$i];
        $file_tmp = $files['tmp_name'][$i];
        $file_error = $files['error'][$i];
        $file_size = $files['size'][$i];
        
        if ($file_error !== UPLOAD_ERR_OK) {
            continue; // Skip files with errors
        }
        
        // Validate file type
        if (!in_array($file_type, $allowed_types)) {
            continue; // Skip invalid file types
        }
        
        // Validate file size (10MB limit)
        if ($file_size > 10 * 1024 * 1024) {
            continue; // Skip files that are too large
        }
        
        // Sanitize filename
        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($file_name));
        $filename = time() . '_' . $filename; // Add timestamp to prevent conflicts
        $filepath = $base_upload_dir . $filename;
        
        // Move uploaded file
        if (move_uploaded_file($file_tmp, $filepath)) {
            // Save to database
            $stmt = $pdo->prepare("INSERT INTO uploaded_files (user_id, subject_id, filename, original_filename, file_path, file_size, mime_type, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$user_id, $subject_id, $filename, $file_name, $filepath, $file_size, $file_type]);
            
            $uploaded_files[] = [
                'id' => $pdo->lastInsertId(),
                'filename' => $filename,
                'original_name' => $file_name
            ];
        }
    }
    
    if (!empty($uploaded_files)) {
        echo json_encode([
            'success' => true, 
            'message' => count($uploaded_files) . ' file(s) uploaded successfully',
            'files' => $uploaded_files
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No files were uploaded successfully']);
    }
    
} catch (Exception $e) {
    error_log("Error uploading files: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Upload error occurred',
        'debug' => $e->getMessage()
    ]);
}
?>
