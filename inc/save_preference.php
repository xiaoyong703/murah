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
    if (isset($input['key']) && isset($input['value'])) {
        $key = $input['key'];
        $value = $input['value'];
        
        if ($key === 'theme') {
            // Update theme in users table
            $stmt = $pdo->prepare("UPDATE users SET theme = ? WHERE id = ?");
            $stmt->execute([$value, $user_id]);
        } else {
            // Update other preferences in user_preferences table
            $stmt = $pdo->prepare("INSERT INTO user_preferences (user_id, pref_key, pref_value) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE pref_value = VALUES(pref_value)");
            $stmt->execute([$user_id, $key, $value]);
        }
    } elseif (isset($input['theme'])) {
        // Legacy support
        $stmt = $pdo->prepare("UPDATE users SET theme = ? WHERE id = ?");
        $stmt->execute([$input['theme'], $user_id]);
    }
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    error_log("Preference save error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>
