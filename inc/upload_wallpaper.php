<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

if (!isset($_FILES['wallpaper'])) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded']);
    exit;
}

$user_id = $_SESSION['user_id'];
$file = $_FILES['wallpaper'];

// Validate file
$allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
if (!in_array($file['type'], $allowed_types)) {
    echo json_encode(['success' => false, 'message' => 'Invalid file type']);
    exit;
}

if ($file['size'] > 5 * 1024 * 1024) { // 5MB limit
    echo json_encode(['success' => false, 'message' => 'File too large']);
    exit;
}

try {
    // Create wallpaper directory
    $wallpaper_dir = WALLPAPER_DIR . $user_id . '/';
    if (!file_exists($wallpaper_dir)) {
        mkdir($wallpaper_dir, 0755, true);
    }
    
    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $filepath = $wallpaper_dir . $filename;
    
    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        // Save to database
        $url = 'media/wallpapers/' . $user_id . '/' . $filename;
        $stmt = $pdo->prepare("INSERT INTO wallpapers (user_id, filename, original_name, file_path, url, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$user_id, $filename, $file['name'], $filepath, $url]);
        
        echo json_encode(['success' => true, 'url' => $url]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save file']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Upload failed']);
}
?>
