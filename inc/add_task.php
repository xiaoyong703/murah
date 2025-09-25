<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$title = trim($input['title'] ?? '');
$user_id = $_SESSION['user_id'];

if (empty($title)) {
    echo json_encode(['success' => false, 'message' => 'Title is required']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, created_at) VALUES (?, ?, NOW())");
    $stmt->execute([$user_id, $title]);
    
    echo json_encode(['success' => true, 'task_id' => $pdo->lastInsertId()]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>
