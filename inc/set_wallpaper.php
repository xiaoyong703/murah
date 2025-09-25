<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$wallpaper = $input['wallpaper'] ?? '';
$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("UPDATE users SET wallpaper = ? WHERE id = ?");
    $stmt->execute([$wallpaper, $user_id]);
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>
