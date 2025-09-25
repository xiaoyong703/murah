<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM wallpapers WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id]);
    $wallpapers = $stmt->fetchAll();
    
    echo json_encode(['success' => true, 'wallpapers' => $wallpapers]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>
