<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revision HQ - Your Personal Study Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        /* Landing Page Specific Styles */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            z-index: 1000;
            padding: 1rem 2rem;
            transition: all 0.3s ease;
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }

        .logo-icon {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .nav-auth {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .hero {
            padding: 8rem 2rem 4rem;
            text-align: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--text-primary), var(--primary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--text-secondary);
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 4rem;
        }

        .features {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .features-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .features-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .features-subtitle {
            font-size: 1.1rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--bg-secondary);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1.5rem;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .feature-description {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .login-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }

        .modal-content {
            background: var(--bg-secondary);
            border-radius: 20px;
            padding: 3rem;
            width: 90%;
            max-width: 400px;
            text-align: center;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: var(--border-color);
        }

        .modal-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .modal-subtitle {
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        .google-btn {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            background: var(--bg-primary);
            color: var(--text-primary);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .google-btn:hover {
            border-color: var(--primary-color);
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }
            
            .nav-links {
                display: none;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero {
                padding: 6rem 1rem 3rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .features {
                padding: 3rem 1rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="#" class="logo">
                <div class="logo-icon">RHQ</div>
                Revision HQ
            </a>
            
            <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            
            <div class="nav-auth">
                <button class="btn-secondary btn-small" onclick="openLoginModal()">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
                <button class="btn-primary btn-small" onclick="openLoginModal()">
                    <i class="fas fa-user-plus"></i> Get Started
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1 class="hero-title">Your Personal Study Hub</h1>
        <p class="hero-subtitle">
            Transform your study routine with smart tools, organized notes, and progress tracking. 
            Everything you need for academic excellence in one beautiful platform.
        </p>
        
        <div class="cta-buttons">
            <button class="btn-primary" onclick="openLoginModal()" style="padding: 1rem 2rem; font-size: 1.1rem;">
                <i class="fas fa-rocket"></i> Start Studying Free
            </button>
            <button class="btn-secondary" onclick="scrollToFeatures()" style="padding: 1rem 2rem; font-size: 1.1rem;">
                <i class="fas fa-play"></i> See How It Works
            </button>
        </div>
        
        <!-- Success Message Preview -->
        <div style="background: var(--bg-secondary); border-radius: 16px; padding: 2rem; margin: 2rem auto; max-width: 600px; border: 1px solid var(--border-color);">
            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; color: var(--success); margin-bottom: 1rem;">
                <i class="fas fa-check-circle" style="font-size: 1.5rem;"></i>
                <span style="font-weight: 600; font-size: 1.1rem;">✨ Success! Redirecting...</span>
            </div>
            <p style="color: var(--text-secondary); margin: 0;">Join thousands of students already improving their grades</p>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="features-header">
            <h2 class="features-title">⭐ What's Inside</h2>
            <p class="features-subtitle">
                Everything you need to organize your studies, track progress, and achieve your academic goals
            </p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h3 class="feature-title">Smart Study Tools</h3>
                <p class="feature-description">
                    Organize subjects, create flashcards, and use advanced study techniques to maximize retention and understanding.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-folder"></i>
                </div>
                <h3 class="feature-title">File Management</h3>
                <p class="feature-description">
                    Upload and organize all your study materials in one place. PDFs, documents, images - everything accessible instantly.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="feature-title">Pomodoro Timer</h3>
                <p class="feature-description">
                    Built-in focus timer helps you study more effectively with proven time management techniques.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <h3 class="feature-title">Task Tracking</h3>
                <p class="feature-description">
                    Set study goals, track progress, and never miss important deadlines with our intuitive task management.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <h3 class="feature-title">Flashcards</h3>
                <p class="feature-description">
                    Create, review, and master concepts with our intelligent flashcard system designed for optimal learning.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <h3 class="feature-title">Custom Themes</h3>
                <p class="feature-description">
                    Personalize your study environment with beautiful themes and wallpapers that inspire focus and creativity.
                </p>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="login-modal" id="loginModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeLoginModal()">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="logo-icon" style="margin: 0 auto 1.5rem;">RHQ</div>
            <h2 class="modal-title">Welcome to Revision HQ</h2>
            <p class="modal-subtitle">Sign in to access your personal study hub</p>
            
            <div id="g_id_onload"
                 data-client_id="your-google-client-id"
                 data-callback="handleCredentialResponse"
                 data-auto_prompt="false">
            </div>
            
            <button class="google-btn" onclick="handleGoogleSignIn()">
                <svg width="20" height="20" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Continue with Google
            </button>
            
            <p style="margin-top: 1.5rem; font-size: 0.9rem; color: var(--text-secondary);">
                By continuing, you agree to our Terms of Service and Privacy Policy
            </p>
        </div>
    </div>

    <script>
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