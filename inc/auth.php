<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['credential'])) {
    echo json_encode(['success' => false, 'message' => 'No credential provided']);
    exit;
}

// Verify Google ID token
$credential = $input['credential'];

// Verify the token with Google's servers
$google_url = 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $credential;
$google_response = @file_get_contents($google_url);

if (!$google_response) {
    echo json_encode(['success' => false, 'message' => 'Unable to verify token']);
    exit;
}

$google_data = json_decode($google_response, true);

if (!$google_data || isset($google_data['error'])) {
    echo json_encode(['success' => false, 'message' => 'Token verification failed']);
    exit;
}

$email = $google_data['email'];
$name = $google_data['name'];
$picture = $google_data['picture'] ?? '';

try {
    // Check if user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        // Create new user
        $stmt = $pdo->prepare("INSERT INTO users (email, name, picture, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$email, $name, $picture]);
        $user_id = $pdo->lastInsertId();
        
        // Initialize default subjects for new user
        initializeDefaultSubjects($user_id);
    } else {
        // Update existing user
        $user_id = $user['id'];
        $stmt = $pdo->prepare("UPDATE users SET name = ?, picture = ?, last_login = NOW() WHERE id = ?");
        $stmt->execute([$name, $picture, $user_id]);
    }

    // Set session
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $name;
    $_SESSION['login_time'] = time();

    echo json_encode(['success' => true, 'message' => 'Login successful']);

} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error occurred']);
}
?>
