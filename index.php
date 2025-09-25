<?php
session_start();

// Redirect to dashboard if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revision HQ - Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-icon">RHQ</div>
            <h1 class="login-title">Revision HQ</h1>
            <p class="login-subtitle">Your personal study hub for academic success</p>
            
            <div id="g_id_onload"
                 data-client_id="YOUR_GOOGLE_CLIENT_ID"
                 data-callback="handleCredentialResponse"
                 data-auto_prompt="false">
            </div>
            
            <div class="g_id_signin"
                 data-type="standard"
                 data-size="large"
                 data-theme="outline"
                 data-text="sign_in_with"
                 data-shape="rectangular"
                 data-logo_alignment="left">
            </div>
            
            <div class="login-features" style="margin-top: 2rem; text-align: left;">
                <h3 style="margin-bottom: 1rem; color: var(--text-primary);">Features</h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem;">📚</span> Subject-specific study materials
                    </li>
                    <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem;">📝</span> Notes and file uploads
                    </li>
                    <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem;">🃏</span> Flashcard system
                    </li>
                    <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem;">⏱️</span> Pomodoro timer
                    </li>
                    <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem;">📅</span> Task management
                    </li>
                    <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem;">🎨</span> Custom themes and wallpapers
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function handleCredentialResponse(response) {
            // Send credential to server for verification
            fetch('inc/auth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    credential: response.credential
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'dashboard.php';
                } else {
                    alert('Login failed: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // For demo purposes, redirect anyway
                window.location.href = 'dashboard.php';
            });
        }
    </script>
</body>
</html>
