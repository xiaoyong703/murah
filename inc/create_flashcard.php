<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
    exit;
}

$subject_id = isset($input['subject_id']) ? (int)$input['subject_id'] : null;
$question = trim($input['question'] ?? '');
$answer = trim($input['answer'] ?? '');
$difficulty = $input['difficulty'] ?? 'medium';
$user_id = $_SESSION['user_id'];

// Validate inputs
if (empty($question) || empty($answer)) {
    echo json_encode(['success' => false, 'message' => 'Question and answer are required']);
    exit;
}

if (!in_array($difficulty, ['easy', 'medium', 'hard'])) {
    $difficulty = 'medium';
}

if (strlen($question) > 500) {
    echo json_encode(['success' => false, 'message' => 'Question too long (max 500 characters)']);
    exit;
}

if (strlen($answer) > 1000) {
    echo json_encode(['success' => false, 'message' => 'Answer too long (max 1000 characters)']);
    exit;
}

try {
    // Check if flashcards table exists, create if not
    $stmt = $pdo->query("SHOW TABLES LIKE 'flashcards'");
    if (!$stmt->fetch()) {
        $pdo->exec("CREATE TABLE flashcards (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            subject_id INT,
            question TEXT NOT NULL,
            answer TEXT NOT NULL,
            difficulty ENUM('easy', 'medium', 'hard') DEFAULT 'medium',
            last_reviewed TIMESTAMP NULL,
            times_reviewed INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )");
        
        // Add foreign key for subject_id if subjects table has user_id column
        try {
            $stmt = $pdo->query("SHOW COLUMNS FROM subjects LIKE 'user_id'");
            if ($stmt->fetch()) {
                $pdo->exec("ALTER TABLE flashcards ADD FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE");
            }
        } catch (Exception $e) {
            // Ignore foreign key errors
        }
    }
    
    // Verify subject ownership if subject_id provided
    if ($subject_id) {
        $stmt = $pdo->query("SHOW COLUMNS FROM subjects LIKE 'user_id'");
        $has_user_id = $stmt->fetch();
        
        if ($has_user_id) {
            $stmt = $pdo->prepare("SELECT id FROM subjects WHERE id = ? AND user_id = ?");
            $stmt->execute([$subject_id, $user_id]);
            if (!$stmt->fetch()) {
                echo json_encode(['success' => false, 'message' => 'Subject not found or access denied']);
                exit;
            }
        }
    }
    
    // Create the flashcard
    $stmt = $pdo->prepare("INSERT INTO flashcards (user_id, subject_id, question, answer, difficulty, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $result = $stmt->execute([$user_id, $subject_id, $question, $answer, $difficulty]);
    
    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Flashcard created successfully',
            'flashcard_id' => $pdo->lastInsertId()
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create flashcard']);
    }
    
} catch (Exception $e) {
    error_log("Error creating flashcard: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Database error occurred',
        'debug' => $e->getMessage()
    ]);
}
?>