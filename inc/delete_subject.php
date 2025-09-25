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
if (empty($input['subject_id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Subject ID is required']);
    exit;
}

$subject_id = (int)$input['subject_id'];
$user_id = $_SESSION['user_id'];

try {
    // Verify that the subject belongs to the current user
    $stmt = $pdo->prepare("SELECT id, name FROM subjects WHERE id = ? AND user_id = ?");
    $stmt->execute([$subject_id, $user_id]);
    $subject = $stmt->fetch();
    
    if (!$subject) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Subject not found or access denied']);
        exit;
    }
    
    // Start transaction for safe deletion
    $pdo->beginTransaction();
    
    try {
        // Delete flashcards associated with this subject
        $stmt = $pdo->prepare("DELETE FROM flashcards WHERE subject_id = ?");
        $stmt->execute([$subject_id]);
        
        // Delete tasks associated with this subject (if you have such a table)
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE subject_id = ?");
        $stmt->execute([$subject_id]);
        
        // Delete uploaded files associated with this subject
        $stmt = $pdo->prepare("DELETE FROM uploaded_files WHERE subject_id = ?");
        $stmt->execute([$subject_id]);
        
        // Delete the subject itself
        $stmt = $pdo->prepare("DELETE FROM subjects WHERE id = ? AND user_id = ?");
        $stmt->execute([$subject_id, $user_id]);
        
        // Commit the transaction
        $pdo->commit();
        
        // Remove the subject directory and all files
        $subject_dir = "../uploads/{$user_id}/subjects/{$subject_id}";
        if (file_exists($subject_dir)) {
            removeDirectory($subject_dir);
        }
        
        echo json_encode([
            'success' => true, 
            'message' => 'Subject deleted successfully'
        ]);
        
    } catch (Exception $e) {
        // Rollback on error
        $pdo->rollBack();
        throw $e;
    }
    
} catch (Exception $e) {
    error_log("Error deleting subject: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error occurred']);
}

// Helper function to recursively remove directory
function removeDirectory($dir) {
    if (!file_exists($dir)) return;
    
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        if (is_dir($path)) {
            removeDirectory($path);
        } else {
            unlink($path);
        }
    }
    rmdir($dir);
}
?>