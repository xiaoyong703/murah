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
if (empty($input['subject_id']) || empty($input['name'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Subject ID and name are required']);
    exit;
}

$subject_id = (int)$input['subject_id'];
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
    // Verify that the subject belongs to the current user
    $stmt = $pdo->prepare("SELECT id, name FROM subjects WHERE id = ? AND user_id = ?");
    $stmt->execute([$subject_id, $user_id]);
    $existing_subject = $stmt->fetch();
    
    if (!$existing_subject) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Subject not found or access denied']);
        exit;
    }
    
    // Check if user already has another subject with this name
    $stmt = $pdo->prepare("SELECT id FROM subjects WHERE user_id = ? AND name = ? AND id != ?");
    $stmt->execute([$user_id, $name, $subject_id]);
    
    if ($stmt->fetch()) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'You already have another subject with this name']);
        exit;
    }
    
    // Update the subject
    $stmt = $pdo->prepare("UPDATE subjects SET name = ?, description = ?, icon = ?, updated_at = NOW() WHERE id = ? AND user_id = ?");
    $result = $stmt->execute([$name, $description, $icon, $subject_id, $user_id]);
    
    if ($result) {
        echo json_encode([
            'success' => true, 
            'message' => 'Subject updated successfully'
        ]);
    } else {
        throw new Exception('Failed to update subject');
    }
    
} catch (Exception $e) {
    error_log("Error updating subject: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error occurred']);
}
?>