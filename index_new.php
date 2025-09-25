<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revision HQ - Your Study Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --secondary: #06b6d4;
            --success: #10b981;
            --bg: #ffffff;
            --bg-secondary: #f8fafc;
            --text: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #22d3ee;
            --success: #34d399;
            --bg: #0f172a;
            --bg-secondary: #1e293b;
            --text: #f1f5f9;
            --text-light: #94a3b8;
            --border: #334155;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg-secondary) 100%);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(79, 70, 229, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(6, 182, 212, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 40% 80%, rgba(16, 185, 129, 0.1) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes float {
            0%, 100% { transform: translate(0px, 0px) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        .login-container {
            background: var(--bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            width: 100%;
            max-width: 480px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            color: white;
            font-size: 2rem;
            font-weight: 800;
            box-shadow: var(--shadow);
        }

        .title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: var(--text-light);
            font-size: 1.1rem;
            margin-bottom: 3rem;
            font-weight: 400;
        }

        .google-signin-container {
            margin: 2rem 0;
        }

        .custom-google-btn {
            background: var(--bg);
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text);
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            box-shadow: var(--shadow);
        }

        .custom-google-btn:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px -4px rgba(79, 70, 229, 0.3);
        }

        .features {
            margin-top: 3rem;
            text-align: left;
        }

        .features h3 {
            color: var(--text);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background: var(--bg-secondary);
            border-radius: 12px;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .feature-text {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text);
        }

        .theme-toggle {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text);
        }

        .theme-toggle:hover {
            background: var(--primary);
            color: white;
        }

        @media (max-width: 640px) {
            .login-container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .title {
                font-size: 2rem;
            }
            
            .feature-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <button class="theme-toggle" onclick="toggleTheme()">
        <i class="fas fa-moon"></i>
    </button>

    <div class="login-container">
        <div class="logo">
            RHQ
        </div>
        
        <h1 class="title">Revision HQ</h1>
        <p class="subtitle">Your personal study hub for academic excellence</p>
        
        <div class="google-signin-container">
            <div id="g_id_onload"
                 data-client_id="707730920463-tf7svsd22kt8jh5jjsq9llp4ti1lchd9.apps.googleusercontent.com"
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
        </div>

        <div class="features">
            <h3>✨ What's Inside</h3>
            <div class="feature-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <div class="feature-text">Smart Study Tools</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-upload"></i>
                    </div>
                    <div class="feature-text">File Management</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="feature-text">Pomodoro Timer</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="feature-text">Task Tracking</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-cards-blank"></i>
                    </div>
                    <div class="feature-text">Flashcards</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <div class="feature-text">Custom Themes</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Theme toggle
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            
            const icon = document.querySelector('.theme-toggle i');
            icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            
            localStorage.setItem('theme', newTheme);
        }

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        document.querySelector('.theme-toggle i').className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';

        // Google Sign-In Handler
        function handleCredentialResponse(response) {
            // Show loading state
            const signinDiv = document.querySelector('.g_id_signin');
            signinDiv.innerHTML = '<div style="padding: 1rem; color: var(--primary);"><i class="fas fa-spinner fa-spin"></i> Signing in...</div>';
            
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
                    // Success animation
                    signinDiv.innerHTML = '<div style="padding: 1rem; color: var(--success);"><i class="fas fa-check"></i> Success! Redirecting...</div>';
                    setTimeout(() => {
                        window.location.href = 'dashboard.php';
                    }, 1500);
                } else {
                    // Error handling
                    signinDiv.innerHTML = '<div style="padding: 1rem; color: #ef4444;"><i class="fas fa-exclamation-triangle"></i> ' + data.message + '</div>';
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Auth error:', error);
                signinDiv.innerHTML = '<div style="padding: 1rem; color: #ef4444;"><i class="fas fa-exclamation-triangle"></i> Connection error. Redirecting anyway...</div>';
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 2000);
            });
        }
    </script>
</body>
</html>