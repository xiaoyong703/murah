<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$wallpaper_id = $input['wallpaper_id'] ?? 0;
$user_id = $_SESSION['user_id'];

try {
    // Get wallpaper info
    $stmt = $pdo->prepare("SELECT * FROM wallpapers WHERE id = ? AND user_id = ?");
    $stmt->execute([$wallpaper_id, $user_id]);
    $wallpaper = $stmt->fetch();
    
    if ($wallpaper) {
        // Delete file
        if (file_exists($wallpaper['file_path'])) {
            unlink($wallpaper['file_path']);
        }
        
        // Delete from database
        $stmt = $pdo->prepare("DELETE FROM wallpapers WHERE id = ? AND user_id = ?");
        $stmt->execute([$wallpaper_id, $user_id]);
    }
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Delete failed']);
}
?>
