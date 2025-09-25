<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

if (!isset($_FILES['file'])) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded']);
    exit;
}

$user_id = $_SESSION['user_id'];
$file = $_FILES['file'];
$subject_id = $_POST['subject_id'] ?? null;
$category = $_POST['category'] ?? 'general';
$description = $_POST['description'] ?? '';

// Validate file
$allowed_types = ['application/pdf', 'image/jpeg', 'image/png', 'image/gif', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
if (!in_array($file['type'], $allowed_types)) {
    echo json_encode(['success' => false, 'message' => 'Invalid file type']);
    exit;
}

if ($file['size'] > 10 * 1024 * 1024) { // 10MB limit
    echo json_encode(['success' => false, 'message' => 'File too large']);
    exit;
}

try {
    // Create upload directory
    $upload_dir = createUserDirectory($user_id, $category);
    
    // Sanitize filename
    $filename = sanitizeFilename($file['name']);
    $filepath = $upload_dir . $filename;
    
    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        // Save to database
        $stmt = $pdo->prepare("INSERT INTO files (user_id, subject_id, filename, original_name, file_path, file_size, mime_type, category, description, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$user_id, $subject_id, $filename, $file['name'], $filepath, $file['size'], $file['type'], $category, $description]);
        
        echo json_encode(['success' => true, 'file_id' => $pdo->lastInsertId()]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save file']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Upload failed']);
}
?>
