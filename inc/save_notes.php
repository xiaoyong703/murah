<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$content = $input['content'] ?? '';
$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT id FROM notes WHERE user_id = ? AND type = 'quick'");
    $stmt->execute([$user_id]);
    $note = $stmt->fetch();
    
    if ($note) {
        $stmt = $pdo->prepare("UPDATE notes SET content = ?, updated_at = NOW() WHERE id = ?");
        $stmt->execute([$content, $note['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO notes (user_id, type, content, created_at) VALUES (?, 'quick', ?, NOW())");
        $stmt->execute([$user_id, $content]);
    }
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>
