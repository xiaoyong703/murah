<?php
session_start();

// Simple authentication handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Basic validation
    if (empty($email) || empty($password)) {
        header('Location: index.html?error=missing_fields');
        exit();
    }
    
    // For demo purposes - you can add real authentication here
    if ($email === 'demo@revisionhq.com' && $password === 'demo123') {
        $_SESSION['user_email'] = $email;
        $_SESSION['logged_in'] = true;
        header('Location: dashboard.php');
        exit();
    } else {
        // In a real app, you'd check against a database
        // For now, just redirect to dashboard for any login attempt
        $_SESSION['user_email'] = $email;
        $_SESSION['logged_in'] = true;
        header('Location: dashboard.php');
        exit();
    }
} else {
    // If not POST request, redirect to home
    header('Location: index.html');
    exit();
}
?>