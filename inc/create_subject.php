<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
    exit;
}

// Validate required fields
if (empty($input['name'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Subject name is required']);
    exit;
}

$name = trim($input['name']);
$description = trim($input['description'] ?? '');
$icon = trim($input['icon'] ?? 'fas fa-book');
$user_id = $_SESSION['user_id'];

// Validate name length
if (strlen($name) > 100) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Subject name too long (max 100 characters)']);
    exit;
}

// Validate description length
if (strlen($description) > 255) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Description too long (max 255 characters)']);
    exit;
}

// Validate icon format
if (!preg_match('/^(fas|far|fab) fa-[\w-]+$/', $icon)) {
    $icon = 'fas fa-book'; // Default fallback
}

try {
    // Check if user already has a subject with this name
    $stmt = $pdo->prepare("SELECT id FROM subjects WHERE user_id = ? AND name = ?");
    $stmt->execute([$user_id, $name]);
    
    if ($stmt->fetch()) {
        http_response_code(400);
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
        throw new Exception('Failed to create subject');
    }
    
} catch (Exception $e) {
    error_log("Error creating subject: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error occurred']);
}
?>