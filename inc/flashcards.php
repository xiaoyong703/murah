<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'create':
            $subject_id = $_POST['subject_id'] ?? null;
            $deck_name = $_POST['deck_name'] ?? '';
            $question = $_POST['question'] ?? '';
            $answer = $_POST['answer'] ?? '';
            $difficulty = $_POST['difficulty'] ?? 'medium';
            
            $stmt = $pdo->prepare("INSERT INTO flashcards (user_id, subject_id, deck_name, question, answer, difficulty, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$user_id, $subject_id, $deck_name, $question, $answer, $difficulty]);
            
            echo json_encode(['success' => true, 'flashcard_id' => $pdo->lastInsertId()]);
            break;
            
        case 'get':
            $subject_id = $_GET['subject_id'] ?? null;
            $where_clause = $subject_id ? "AND subject_id = ?" : "";
            $params = $subject_id ? [$user_id, $subject_id] : [$user_id];
            
            $stmt = $pdo->prepare("SELECT * FROM flashcards WHERE user_id = ? $where_clause ORDER BY created_at DESC");
            $stmt->execute($params);
            $flashcards = $stmt->fetchAll();
            
            echo json_encode(['success' => true, 'flashcards' => $flashcards]);
            break;
            
        case 'update_review':
            $flashcard_id = $_POST['flashcard_id'] ?? 0;
            $correct = $_POST['correct'] ?? false;
            
            $stmt = $pdo->prepare("UPDATE flashcards SET last_reviewed = NOW(), review_count = review_count + 1, correct_count = correct_count + ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$correct ? 1 : 0, $flashcard_id, $user_id]);
            
            echo json_encode(['success' => true]);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>
