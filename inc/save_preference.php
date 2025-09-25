<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$user_id = $_SESSION['user_id'];

try {
    if (isset($input['theme'])) {
        $stmt = $pdo->prepare("UPDATE users SET theme = ? WHERE id = ?");
        $stmt->execute([$input['theme'], $user_id]);
    }
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>
