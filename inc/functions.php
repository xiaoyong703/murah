<?php
require_once 'config.php';

function getUserById($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetch();
}

function getSubjectsForUser($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT s.*, us.position, us.color 
        FROM subjects s 
        JOIN user_subjects us ON s.id = us.subject_id 
        WHERE us.user_id = ? 
        ORDER BY us.position
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

function getTasksForUser($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? AND completed = 0 ORDER BY created_at DESC LIMIT 10");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

function getNotesForUser($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ? AND type = 'quick' LIMIT 1");
    $stmt->execute([$user_id]);
    return $stmt->fetch();
}

function initializeDefaultSubjects($user_id) {
    global $pdo;
    
    $default_subjects = [
        ['name' => 'Computing', 'icon' => 'fas fa-laptop-code', 'color' => '#3b82f6', 'description' => 'Programming and computer science'],
        ['name' => 'History & Social Studies', 'icon' => 'fas fa-landmark', 'color' => '#f59e0b', 'description' => 'Historical events and society'],
        ['name' => 'Chemistry & Physics', 'icon' => 'fas fa-atom', 'color' => '#10b981', 'description' => 'Sciences and experiments'],
        ['name' => 'English', 'icon' => 'fas fa-book-open', 'color' => '#ef4444', 'description' => 'Language and literature'],
        ['name' => 'Chinese', 'icon' => 'fas fa-language', 'color' => '#f97316', 'description' => 'Chinese language studies'],
        ['name' => 'Math', 'icon' => 'fas fa-calculator', 'color' => '#8b5cf6', 'description' => 'Mathematics and algebra'],
        ['name' => 'A-Math', 'icon' => 'fas fa-square-root-alt', 'color' => '#ec4899', 'description' => 'Advanced mathematics'],
        ['name' => 'Electronics', 'icon' => 'fas fa-microchip', 'color' => '#06b6d4', 'description' => 'Electronic circuits and components']
    ];

    foreach ($default_subjects as $index => $subject) {
        // Insert subject if it doesn't exist
        $stmt = $pdo->prepare("INSERT IGNORE INTO subjects (name, icon, description) VALUES (?, ?, ?)");
        $stmt->execute([$subject['name'], $subject['icon'], $subject['description']]);
        
        // Get subject ID
        $stmt = $pdo->prepare("SELECT id FROM subjects WHERE name = ?");
        $stmt->execute([$subject['name']]);
        $subject_id = $stmt->fetchColumn();
        
        // Link user to subject
        $stmt = $pdo->prepare("INSERT IGNORE INTO user_subjects (user_id, subject_id, position, color) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $subject_id, $index + 1, $subject['color']]);
    }
}

function sanitizeFilename($filename) {
    $filename = basename($filename);
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
    
    if (strlen($filename) > 100) {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $name = substr(pathinfo($filename, PATHINFO_FILENAME), 0, 100 - strlen($extension) - 1);
        $filename = $name . '.' . $extension;
    }
    
    return $filename;
}

function createUserDirectory($user_id, $subdirectory = '') {
    $path = UPLOAD_DIR . $user_id . '/' . $subdirectory;
    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }
    return $path;
}

function checkSessionTimeout() {
    if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time']) > 7200) { // 2 hours
        session_destroy();
        return false;
    }
    return true;
}

function getUserWallpapers($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM wallpapers WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

function getFlashcardsBySubject($user_id, $subject_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM flashcards WHERE user_id = ? AND subject_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id, $subject_id]);
    return $stmt->fetchAll();
}

function getFilesBySubject($user_id, $subject_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM files WHERE user_id = ? AND subject_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id, $subject_id]);
    return $stmt->fetchAll();
}

function validateFileUpload($file) {
    $errors = [];
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'File upload error.';
        return $errors;
    }
    
    if ($file['size'] > MAX_FILE_SIZE) {
        $errors[] = 'File size exceeds limit.';
    }
    
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, ALLOWED_FILE_TYPES)) {
        $errors[] = 'File type not allowed.';
    }
    
    return $errors;
}
?>
