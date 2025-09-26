<!DOCTYPE html><!DOCTYPE html><!DOCTYPE html>

<html lang="en" data-theme="light">

<head><html lang="en" data-theme="light"><html lang="en" data-theme="light">

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"><head><head>

    <title>Revision HQ - Your Personal Study Hub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">    <meta charset="UTF-8">    <meta charset="UTF-8">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://accounts.google.com/gsi/client" async defer></script>    <title>Revision HQ - Your Personal Study Hub</title>    <title>Revision HQ - Your Personal Study Hub</title>

    <style>

        :root {    <link rel="preconnect" href="https://fonts.googleapis.com">    <link rel="preconnect" href="https://fonts.googleapis.com">

            --primary-color: #2563eb;

            --secondary-color: #1e40af;    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

            --accent-color: #3b82f6;

            --bg-primary: #ffffff;    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

            --bg-secondary: #f8fafc;

            --bg-tertiary: #e2e8f0;    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

            --text-primary: #1e293b;

            --text-secondary: #64748b;    <link rel="stylesheet" href="styles.css">    <link rel="stylesheet" href="styles.css">

            --border-color: #cbd5e1;

            --shadow: rgba(0, 0, 0, 0.1);    <script src="https://accounts.google.com/gsi/client" async defer></script>    <script src="https://accounts.google.com/gsi/client" async defer></script>

            --shadow-hover: rgba(0, 0, 0, 0.15);

            --success: #10b981;    <style>    <style>

            --warning: #f59e0b;

            --error: #ef4444;        /* Landing Page Specific Styles */        /* Landing Page Specific Styles */

        }

        .navbar {        .navbar {

        [data-theme="dark"] {

            --primary-color: #3b82f6;            position: fixed;            position: fixed;

            --secondary-color: #2563eb;

            --accent-color: #60a5fa;            top: 0;            top: 0;

            --bg-primary: #0f172a;

            --bg-secondary: #1e293b;            width: 100%;            width: 100%;

            --bg-tertiary: #334155;

            --text-primary: #f1f5f9;            background: rgba(255, 255, 255, 0.95);            background: rgba(255, 255, 255, 0.95);

            --text-secondary: #94a3b8;

            --border-color: #475569;            backdrop-filter: blur(10px);            backdrop-filter: blur(10px);

            --shadow: rgba(0, 0, 0, 0.3);

            --shadow-hover: rgba(0, 0, 0, 0.4);            border-bottom: 1px solid var(--border-color);            border-bottom: 1px solid var(--border-color);

        }

            z-index: 1000;            z-index: 1000;

        * {

            margin: 0;            padding: 1rem 2rem;            padding: 1rem 2rem;

            padding: 0;

            box-sizing: border-box;            transition: all 0.3s ease;            transition: all 0.3s ease;

        }

        }        }

        body {

            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;

            background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);

            color: var(--text-primary);        .navbar-content {        .navbar-content {

            min-height: 100vh;

        }            max-width: 1200px;            max-width: 1200px;



        .btn-primary {            margin: 0 auto;            margin: 0 auto;

            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));

            color: white;            display: flex;            display: flex;

            border: none;

            padding: 0.75rem 1.5rem;            justify-content: space-between;            justify-content: space-between;

            border-radius: 0.5rem;

            font-weight: 600;            align-items: center;            align-items: center;

            cursor: pointer;

            transition: all 0.3s ease;        }        }

            display: inline-flex;

            align-items: center;

            gap: 0.5rem;

            font-size: 0.875rem;        .logo {        .logo {

            text-decoration: none;

        }            display: flex;            display: flex;



        .btn-primary:hover {            align-items: center;            align-items: center;

            transform: translateY(-2px);

            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);            gap: 0.75rem;            gap: 0.75rem;

        }

            font-size: 1.5rem;            font-size: 1.5rem;

        .btn-secondary {

            background: var(--bg-secondary);            font-weight: 700;            font-weight: 700;

            color: var(--text-primary);

            border: 2px solid var(--border-color);            color: var(--primary-color);            color: var(--primary-color);

            padding: 0.75rem 1.5rem;

            border-radius: 0.5rem;            text-decoration: none;            text-decoration: none;

            font-weight: 600;

            cursor: pointer;        }        }

            transition: all 0.3s ease;

            display: inline-flex;

            align-items: center;

            gap: 0.5rem;        .logo-icon {        .logo-icon {

            font-size: 0.875rem;

            text-decoration: none;            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));

        }

            color: white;            color: white;

        .btn-secondary:hover {

            border-color: var(--primary-color);            width: 40px;            width: 40px;

            color: var(--primary-color);

            transform: translateY(-1px);            height: 40px;            height: 40px;

        }

            border-radius: 10px;            border-radius: 10px;

        .btn-small {

            padding: 0.5rem 1rem;            display: flex;            display: flex;

            font-size: 0.8rem;

            border-radius: 0.375rem;            align-items: center;            align-items: center;

        }

            justify-content: center;            justify-content: center;

        .navbar {

            position: fixed;            font-size: 1.2rem;            font-size: 1.2rem;

            top: 0;

            width: 100%;            font-weight: 700;            font-weight: 700;

            background: rgba(255, 255, 255, 0.95);

            backdrop-filter: blur(10px);        }        }

            border-bottom: 1px solid var(--border-color);

            z-index: 1000;

            padding: 1rem 2rem;

            transition: all 0.3s ease;        .nav-links {        .nav-links {

        }

            display: flex;            display: flex;

        .navbar-content {

            max-width: 1200px;            align-items: center;            align-items: center;

            margin: 0 auto;

            display: flex;            gap: 2rem;            gap: 2rem;

            justify-content: space-between;

            align-items: center;            list-style: none;            list-style: none;

        }

        }        }

        .logo {

            display: flex;

            align-items: center;

            gap: 0.75rem;        .nav-links a {        .nav-links a {

            font-size: 1.5rem;

            font-weight: 700;            text-decoration: none;            text-decoration: none;

            color: var(--primary-color);

            text-decoration: none;            color: var(--text-secondary);            color: var(--text-secondary);

        }

            font-weight: 500;            font-weight: 500;

        .logo-icon {

            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));            transition: color 0.3s ease;            transition: color 0.3s ease;

            color: white;

            width: 40px;        }        }

            height: 40px;

            border-radius: 10px;

            display: flex;

            align-items: center;        .nav-links a:hover {        .nav-links a:hover {

            justify-content: center;

            font-size: 1.2rem;            color: var(--primary-color);            color: var(--primary-color);

            font-weight: 700;

        }        }        }



        .nav-links {

            display: flex;

            align-items: center;        .nav-auth {        .nav-auth {

            gap: 2rem;

            list-style: none;            display: flex;            display: flex;

        }

            align-items: center;            align-items: center;

        .nav-links a {

            text-decoration: none;            gap: 1rem;            gap: 1rem;

            color: var(--text-secondary);

            font-weight: 500;        }        }

            transition: color 0.3s ease;

        }



        .nav-links a:hover {        .hero {        .hero {

            color: var(--primary-color);

        }            padding: 8rem 2rem 4rem;            padding: 8rem 2rem 4rem;



        .nav-auth {            text-align: center;            text-align: center;

            display: flex;

            align-items: center;            max-width: 1200px;            max-width: 1200px;

            gap: 1rem;

        }            margin: 0 auto;            margin: 0 auto;



        .hero {        }        }

            padding: 8rem 2rem 4rem;

            text-align: center;

            max-width: 1200px;

            margin: 0 auto;        .hero-title {        .hero-title {

        }

            font-size: 4rem;            font-size: 4rem;

        .hero-title {

            font-size: 4rem;            font-weight: 800;            font-weight: 800;

            font-weight: 800;

            margin-bottom: 1.5rem;            margin-bottom: 1.5rem;            margin-bottom: 1.5rem;

            background: linear-gradient(135deg, var(--text-primary), var(--primary-color));

            -webkit-background-clip: text;            background: linear-gradient(135deg, var(--text-primary), var(--primary-color));            background: linear-gradient(135deg, var(--text-primary), var(--primary-color));

            -webkit-text-fill-color: transparent;

            background-clip: text;            -webkit-background-clip: text;            -webkit-background-clip: text;

            line-height: 1.1;

        }            -webkit-text-fill-color: transparent;            -webkit-text-fill-color: transparent;



        .hero-subtitle {            background-clip: text;            background-clip: text;

            font-size: 1.3rem;

            color: var(--text-secondary);            line-height: 1.1;            line-height: 1.1;

            margin-bottom: 3rem;

            max-width: 600px;        }        }

            margin-left: auto;

            margin-right: auto;

            line-height: 1.6;

        }        .hero-subtitle {        .hero-subtitle {



        .cta-buttons {            font-size: 1.3rem;            font-size: 1.3rem;

            display: flex;

            gap: 1rem;            color: var(--text-secondary);            color: var(--text-secondary);

            justify-content: center;

            margin-bottom: 4rem;            margin-bottom: 3rem;            margin-bottom: 3rem;

        }

            max-width: 600px;            max-width: 600px;

        .features {

            padding: 4rem 2rem;            margin-left: auto;            margin-left: auto;

            max-width: 1200px;

            margin: 0 auto;            margin-right: auto;            margin-right: auto;

        }

            line-height: 1.6;            line-height: 1.6;

        .features-header {

            text-align: center;        }        }

            margin-bottom: 4rem;

        }



        .features-title {        .cta-buttons {        .cta-buttons {

            font-size: 2.5rem;

            font-weight: 700;            display: flex;            display: flex;

            margin-bottom: 1rem;

            color: var(--text-primary);            gap: 1rem;            gap: 1rem;

        }

            justify-content: center;            justify-content: center;

        .features-subtitle {

            font-size: 1.1rem;            margin-bottom: 4rem;            margin-bottom: 4rem;

            color: var(--text-secondary);

            max-width: 600px;        }        }

            margin: 0 auto;

        }



        .features-grid {        .features {        .features {

            display: grid;

            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));            padding: 4rem 2rem;            padding: 4rem 2rem;

            gap: 2rem;

        }            max-width: 1200px;            max-width: 1200px;



        .feature-card {            margin: 0 auto;            margin: 0 auto;

            background: var(--bg-secondary);

            border-radius: 16px;        }        }

            padding: 2rem;

            text-align: center;

            border: 1px solid var(--border-color);

            transition: all 0.3s ease;        .features-header {        .features-header {

        }

            text-align: center;            text-align: center;

        .feature-card:hover {

            transform: translateY(-4px);            margin-bottom: 4rem;            margin-bottom: 4rem;

            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);

        }        }        }



        .feature-icon {

            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));

            color: white;        .features-title {        .features-title {

            width: 60px;

            height: 60px;            font-size: 2.5rem;            font-size: 2.5rem;

            border-radius: 15px;

            display: flex;            font-weight: 700;            font-weight: 700;

            align-items: center;

            justify-content: center;            margin-bottom: 1rem;            margin-bottom: 1rem;

            font-size: 1.5rem;

            margin: 0 auto 1.5rem;            color: var(--text-primary);            color: var(--text-primary);

        }

        }        }

        .feature-title {

            font-size: 1.3rem;

            font-weight: 600;

            margin-bottom: 1rem;        .features-subtitle {        .features-subtitle {

            color: var(--text-primary);

        }            font-size: 1.1rem;            font-size: 1.1rem;



        .feature-description {            color: var(--text-secondary);            color: var(--text-secondary);

            color: var(--text-secondary);

            line-height: 1.6;            max-width: 600px;            max-width: 600px;

        }

            margin: 0 auto;            margin: 0 auto;

        .login-modal {

            position: fixed;        }        }

            top: 0;

            left: 0;

            width: 100%;

            height: 100%;        .features-grid {        .features-grid {

            background: rgba(0, 0, 0, 0.8);

            display: none;            display: grid;            display: grid;

            align-items: center;

            justify-content: center;            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));

            z-index: 2000;

        }            gap: 2rem;            gap: 2rem;



        .modal-content {        }        }

            background: var(--bg-secondary);

            border-radius: 20px;

            padding: 3rem;

            width: 90%;        .feature-card {        .feature-card {

            max-width: 400px;

            text-align: center;            background: var(--bg-secondary);            background: var(--bg-secondary);

            position: relative;

        }            border-radius: 16px;            border-radius: 16px;



        .modal-close {            padding: 2rem;            padding: 2rem;

            position: absolute;

            top: 1rem;            text-align: center;            text-align: center;

            right: 1rem;

            background: none;            border: 1px solid var(--border-color);            border: 1px solid var(--border-color);

            border: none;

            font-size: 1.5rem;            transition: all 0.3s ease;            transition: all 0.3s ease;

            color: var(--text-secondary);

            cursor: pointer;        }        }

            padding: 0.5rem;

            border-radius: 8px;

            transition: all 0.3s ease;

        }        .feature-card:hover {        .feature-card:hover {



        .modal-close:hover {            transform: translateY(-4px);            transform: translateY(-4px);

            background: var(--border-color);

        }            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);



        .modal-title {        }        }

            font-size: 1.8rem;

            font-weight: 700;

            margin-bottom: 1rem;

            color: var(--text-primary);        .feature-icon {        .feature-icon {

        }

            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));

        .modal-subtitle {

            color: var(--text-secondary);            color: white;            color: white;

            margin-bottom: 2rem;

        }            width: 60px;            width: 60px;



        .google-btn {            height: 60px;            height: 60px;

            width: 100%;

            padding: 1rem;            border-radius: 15px;            border-radius: 15px;

            border: 2px solid var(--border-color);

            border-radius: 12px;            display: flex;            display: flex;

            background: var(--bg-primary);

            color: var(--text-primary);            align-items: center;            align-items: center;

            font-size: 1rem;

            font-weight: 500;            justify-content: center;            justify-content: center;

            cursor: pointer;

            transition: all 0.3s ease;            font-size: 1.5rem;            font-size: 1.5rem;

            display: flex;

            align-items: center;            margin: 0 auto 1.5rem;            margin: 0 auto 1.5rem;

            justify-content: center;

            gap: 0.75rem;        }        }

        }



        .google-btn:hover {

            border-color: var(--primary-color);        .feature-title {        .feature-title {

            transform: translateY(-1px);

        }            font-size: 1.3rem;            font-size: 1.3rem;



        @media (max-width: 768px) {            font-weight: 600;            font-weight: 600;

            .navbar {

                padding: 1rem;            margin-bottom: 1rem;            margin-bottom: 1rem;

            }

            color: var(--text-primary);            color: var(--text-primary);

            .nav-links {

                display: none;        }        }

            }



            .hero-title {

                font-size: 2.5rem;        .feature-description {        .feature-description {

            }

            color: var(--text-secondary);            color: var(--text-secondary);

            .hero {

                padding: 6rem 1rem 3rem;            line-height: 1.6;            line-height: 1.6;

            }

        }        }

            .cta-buttons {

                flex-direction: column;

                align-items: center;

            }        .login-modal {        .login-modal {



            .features {            position: fixed;            position: fixed;

                padding: 3rem 1rem;

            }            top: 0;            top: 0;



            .features-grid {            left: 0;            left: 0;

                grid-template-columns: 1fr;

            }            width: 100%;            width: 100%;

        }

            height: 100%;            height: 100%;

        @keyframes spin {

            0% { transform: rotate(0deg); }            background: rgba(0, 0, 0, 0.8);            background: rgba(0, 0, 0, 0.8);

            100% { transform: rotate(360deg); }

        }            display: none;            display: none;

    </style>

</head>            align-items: center;            align-items: center;

<body>

    <!-- Navigation Bar -->            justify-content: center;            justify-content: center;

    <nav class="navbar">

        <div class="navbar-content">            z-index: 2000;            z-index: 2000;

            <a href="#" class="logo">

                <div class="logo-icon">RHQ</div>        }        }

                Revision HQ

            </a>



            <ul class="nav-links">        .modal-content {        .modal-content {

                <li><a href="#features">Features</a></li>

                <li><a href="#about">About</a></li>            background: var(--bg-secondary);            background: var(--bg-secondary);

                <li><a href="#contact">Contact</a></li>

            </ul>            border-radius: 20px;            border-radius: 20px;



            <div class="nav-auth">            padding: 3rem;            padding: 3rem;

                <button class="btn-secondary btn-small" onclick="openLoginModal()">

                    <i class="fas fa-sign-in-alt"></i> Sign In            width: 90%;            width: 90%;

                </button>

                <button class="btn-primary btn-small" onclick="openLoginModal()">            max-width: 400px;            max-width: 400px;

                    <i class="fas fa-user-plus"></i> Get Started

                </button>            text-align: center;            text-align: center;

            </div>

        </div>            position: relative;            position: relative;

    </nav>

        }        }

    <!-- Hero Section -->

    <section class="hero">

        <h1 class="hero-title">Your Personal Study Hub</h1>

        <p class="hero-subtitle">        .modal-close {        .modal-close {

            Transform your study routine with smart tools, organized notes, and progress tracking.

            Everything you need for academic excellence in one beautiful platform.            position: absolute;            position: absolute;

        </p>

            top: 1rem;            top: 1rem;

        <div class="cta-buttons">

            <button class="btn-primary" onclick="openLoginModal()" style="padding: 1rem 2rem; font-size: 1.1rem;">            right: 1rem;            right: 1rem;

                <i class="fas fa-rocket"></i> Start Studying Free

            </button>            background: none;            background: none;

            <button class="btn-secondary" onclick="scrollToFeatures()" style="padding: 1rem 2rem; font-size: 1.1rem;">

                <i class="fas fa-play"></i> See How It Works            border: none;            border: none;

            </button>

        </div>            font-size: 1.5rem;            font-size: 1.5rem;



        <!-- Success Message Preview -->            color: var(--text-secondary);            color: var(--text-secondary);

        <div style="background: var(--bg-secondary); border-radius: 16px; padding: 2rem; margin: 2rem auto; max-width: 600px; border: 1px solid var(--border-color);">

            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; color: var(--success); margin-bottom: 1rem;">            cursor: pointer;            cursor: pointer;

                <i class="fas fa-check-circle" style="font-size: 1.5rem;"></i>

                <span style="font-weight: 600; font-size: 1.1rem;">✨ Success! Redirecting...</span>            padding: 0.5rem;            padding: 0.5rem;

            </div>

            <p style="color: var(--text-secondary); margin: 0;">Join thousands of students already improving their grades</p>            border-radius: 8px;            border-radius: 8px;

        </div>

    </section>            transition: all 0.3s ease;            transition: all 0.3s ease;



    <!-- Features Section -->        }        }

    <section class="features" id="features">

        <div class="features-header">

            <h2 class="features-title">⭐ What's Inside</h2>

            <p class="features-subtitle">        .modal-close:hover {        .modal-close:hover {

                Everything you need to organize your studies, track progress, and achieve your academic goals

            </p>            background: var(--border-color);            background: var(--border-color);

        </div>

        }        }

        <div class="features-grid">

            <div class="feature-card">

                <div class="feature-icon">

                    <i class="fas fa-brain"></i>        .modal-title {        .modal-title {

                </div>

                <h3 class="feature-title">Smart Study Tools</h3>            font-size: 1.8rem;            font-size: 1.8rem;

                <p class="feature-description">

                    Organize subjects, create flashcards, and use advanced study techniques to maximize retention and understanding.            font-weight: 700;            font-weight: 700;

                </p>

            </div>            margin-bottom: 1rem;            margin-bottom: 1rem;



            <div class="feature-card">            color: var(--text-primary);            color: var(--text-primary);

                <div class="feature-icon">

                    <i class="fas fa-folder"></i>        }        }

                </div>

                <h3 class="feature-title">File Management</h3>

                <p class="feature-description">

                    Upload and organize all your study materials in one place. PDFs, documents, images - everything accessible instantly.        .modal-subtitle {        .modal-subtitle {

                </p>

            </div>            color: var(--text-secondary);            color: var(--text-secondary);



            <div class="feature-card">            margin-bottom: 2rem;            margin-bottom: 2rem;

                <div class="feature-icon">

                    <i class="fas fa-clock"></i>        }        }

                </div>

                <h3 class="feature-title">Pomodoro Timer</h3>

                <p class="feature-description">

                    Built-in focus timer helps you study more effectively with proven time management techniques.        .google-btn {        .google-btn {

                </p>

            </div>            width: 100%;            width: 100%;



            <div class="feature-card">            padding: 1rem;            padding: 1rem;

                <div class="feature-icon">

                    <i class="fas fa-tasks"></i>            border: 2px solid var(--border-color);            border: 2px solid var(--border-color);

                </div>

                <h3 class="feature-title">Task Tracking</h3>            border-radius: 12px;            border-radius: 12px;

                <p class="feature-description">

                    Set study goals, track progress, and never miss important deadlines with our intuitive task management.            background: var(--bg-primary);            background: var(--bg-primary);

                </p>

            </div>            color: var(--text-primary);            color: var(--text-primary);



            <div class="feature-card">            font-size: 1rem;            font-size: 1rem;

                <div class="feature-icon">

                    <i class="fas fa-layer-group"></i>            font-weight: 500;            font-weight: 500;

                </div>

                <h3 class="feature-title">Flashcards</h3>            cursor: pointer;            cursor: pointer;

                <p class="feature-description">

                    Create, review, and master concepts with our intelligent flashcard system designed for optimal learning.            transition: all 0.3s ease;            transition: all 0.3s ease;

                </p>

            </div>            display: flex;            display: flex;



            <div class="feature-card">            align-items: center;            align-items: center;

                <div class="feature-icon">

                    <i class="fas fa-palette"></i>            justify-content: center;            justify-content: center;

                </div>

                <h3 class="feature-title">Custom Themes</h3>            gap: 0.75rem;            gap: 0.75rem;

                <p class="feature-description">

                    Personalize your study environment with beautiful themes and wallpapers that inspire focus and creativity.        }        }

                </p>

            </div>

        </div>

    </section>        .google-btn:hover {        .google-btn:hover {



    <!-- Login Modal -->            border-color: var(--primary-color);            border-color: var(--primary-color);

    <div class="login-modal" id="loginModal">

        <div class="modal-content">            transform: translateY(-1px);            transform: translateY(-1px);

            <button class="modal-close" onclick="closeLoginModal()">

                <i class="fas fa-times"></i>        }        }

            </button>



            <div class="logo-icon" style="margin: 0 auto 1.5rem;">RHQ</div>

            <h2 class="modal-title">Welcome to Revision HQ</h2>        @media (max-width: 768px) {        @media (max-width: 768px) {

            <p class="modal-subtitle">Sign in to access your personal study hub</p>

            .navbar {            .navbar {

            <div id="g_id_onload"

                 data-client_id="1067928071044-h9jm9q2g6vtl8vc44gk94lhp3dq4cgoi.apps.googleusercontent.com"                padding: 1rem;                padding: 1rem;

                 data-callback="handleCredentialResponse"

                 data-auto_prompt="false">            }            }

            </div>

                        

            <button class="google-btn" onclick="handleGoogleSignIn()">

                <svg width="20" height="20" viewBox="0 0 24 24">            .nav-links {            .nav-links {

                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>

                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>                display: none;                display: none;

                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>

                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>            }            }

                </svg>

                Continue with Google                        

            </button>

            .hero-title {            .hero-title {

            <p style="margin-top: 1.5rem; font-size: 0.9rem; color: var(--text-secondary);">

                By continuing, you agree to our Terms of Service and Privacy Policy                font-size: 2.5rem;                font-size: 2.5rem;

            </p>

        </div>            }            }

    </div>

                        

    <script>

        // Landing page functionality            .hero {            .hero {

        function openLoginModal() {

            document.getElementById('loginModal').style.display = 'flex';                padding: 6rem 1rem 3rem;                padding: 6rem 1rem 3rem;

        }

            }            }

        function closeLoginModal() {

            document.getElementById('loginModal').style.display = 'none';                        

        }

            .cta-buttons {            .cta-buttons {

        function scrollToFeatures() {

            document.getElementById('features').scrollIntoView({ behavior: 'smooth' });                flex-direction: column;                flex-direction: column;

        }

                align-items: center;                align-items: center;

        // Close modal when clicking outside

        document.getElementById('loginModal').addEventListener('click', function(e) {            }            }

            if (e.target === this) {

                closeLoginModal();                        

            }

        });            .features {            .features {



        // Google Sign-In functionality                padding: 3rem 1rem;                padding: 3rem 1rem;

        function handleGoogleSignIn() {

            // Initialize Google Sign-In if not already done            }            }

            if (typeof google !== 'undefined') {

                google.accounts.id.initialize({                        

                    client_id: '1067928071044-h9jm9q2g6vtl8vc44gk94lhp3dq4cgoi.apps.googleusercontent.com',

                    callback: handleCredentialResponse            .features-grid {            .features-grid {

                });

                google.accounts.id.prompt();                grid-template-columns: 1fr;                grid-template-columns: 1fr;

            } else {

                // Fallback - redirect to dashboard for demo            }            }

                window.location.href = 'dashboard.php';

            }        }        }

        }

    </style>

        function handleCredentialResponse(response) {

            // Show loading state        body {</head>

            const modalContent = document.querySelector('.modal-content');

            modalContent.innerHTML = `            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;<body>

                <div style="padding: 2rem; text-align: center;">

                    <div style="display: inline-block; width: 40px; height: 40px; border: 4px solid var(--border-color); border-top: 4px solid var(--primary-color); border-radius: 50%; animation: spin 1s linear infinite; margin-bottom: 1.5rem;"></div>            background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);    <!-- Navigation Bar -->

                    <h3 style="color: var(--text-primary); margin-bottom: 0.5rem;">Signing you in...</h3>

                    <p style="color: var(--text-secondary);">Please wait while we set up your account</p>            color: var(--text-primary);    <nav class="navbar">

                </div>

            `;            min-height: 100vh;        <div class="navbar-content">



            // Send the ID token to your server        }            <a href="#" class="logo">

            fetch('inc/auth.php', {

                method: 'POST',    </style>                <div class="logo-icon">RHQ</div>

                headers: {

                    'Content-Type': 'application/json',</head>                Revision HQ

                },

                body: JSON.stringify({<body>            </a>

                    credential: response.credential

                })    <!-- Navigation Bar -->            

            })

            .then(response => response.json())    <nav class="navbar">            <ul class="nav-links">

            .then(data => {

                if (data.success) {        <div class="navbar-content">                <li><a href="#features">Features</a></li>

                    // Success - show success message and redirect

                    modalContent.innerHTML = `            <a href="#" class="logo">                <li><a href="#about">About</a></li>

                        <div style="padding: 2rem; text-align: center;">

                            <div style="color: var(--success); font-size: 3rem; margin-bottom: 1rem;">                <div class="logo-icon">RHQ</div>                <li><a href="#contact">Contact</a></li>

                                <i class="fas fa-check-circle"></i>

                            </div>                Revision HQ            </ul>

                            <h3 style="color: var(--text-primary); margin-bottom: 0.5rem;">Welcome aboard!</h3>

                            <p style="color: var(--text-secondary);">Redirecting to your study dashboard...</p>            </a>            

                        </div>

                    `;                        <div class="nav-auth">

                    setTimeout(() => {

                        window.location.href = 'dashboard.php';            <ul class="nav-links">                <button class="btn-secondary btn-small" onclick="openLoginModal()">

                    }, 1500);

                } else {                <li><a href="#features">Features</a></li>                    <i class="fas fa-sign-in-alt"></i> Sign In

                    // Error handling

                    modalContent.innerHTML = `                <li><a href="#about">About</a></li>                </button>

                        <div style="padding: 2rem; text-align: center;">

                            <div style="color: var(--error); font-size: 3rem; margin-bottom: 1rem;">                <li><a href="#contact">Contact</a></li>                <button class="btn-primary btn-small" onclick="openLoginModal()">

                                <i class="fas fa-exclamation-triangle"></i>

                            </div>            </ul>                    <i class="fas fa-user-plus"></i> Get Started

                            <h3 style="color: var(--text-primary); margin-bottom: 0.5rem;">Oops! Something went wrong</h3>

                            <p style="color: var(--text-secondary);">${data.message}</p>                            </button>

                            <button onclick="closeLoginModal(); location.reload();" class="btn-primary" style="margin-top: 1rem;">Try Again</button>

                        </div>            <div class="nav-auth">            </div>

                    `;

                }                <button class="btn-secondary btn-small" onclick="openLoginModal()">        </div>

            })

            .catch(error => {                    <i class="fas fa-sign-in-alt"></i> Sign In    </nav>

                console.error('Auth error:', error);

                // For demo purposes, redirect anyway                </button>

                modalContent.innerHTML = `

                    <div style="padding: 2rem; text-align: center;">                <button class="btn-primary btn-small" onclick="openLoginModal()">    <!-- Hero Section -->

                        <div style="color: var(--success); font-size: 3rem; margin-bottom: 1rem;">

                            <i class="fas fa-check-circle"></i>                    <i class="fas fa-user-plus"></i> Get Started    <section class="hero">

                        </div>

                        <h3 style="color: var(--text-primary); margin-bottom: 0.5rem;">Demo Mode</h3>                </button>        <h1 class="hero-title">Your Personal Study Hub</h1>

                        <p style="color: var(--text-secondary);">Redirecting to dashboard...</p>

                    </div>            </div>        <p class="hero-subtitle">

                `;

                setTimeout(() => {        </div>            Transform your study routine with smart tools, organized notes, and progress tracking. 

                    window.location.href = 'dashboard.php';

                }, 1500);    </nav>            Everything you need for academic excellence in one beautiful platform.

            });

        }        </p>



        // Smooth navbar scroll effect    <!-- Hero Section -->        

        window.addEventListener('scroll', function() {

            const navbar = document.querySelector('.navbar');    <section class="hero">        <div class="cta-buttons">

            if (window.scrollY > 50) {

                navbar.style.background = 'rgba(255, 255, 255, 0.98)';        <h1 class="hero-title">Your Personal Study Hub</h1>            <button class="btn-primary" onclick="openLoginModal()" style="padding: 1rem 2rem; font-size: 1.1rem;">

                navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';

            } else {        <p class="hero-subtitle">                <i class="fas fa-rocket"></i> Start Studying Free

                navbar.style.background = 'rgba(255, 255, 255, 0.95)';

                navbar.style.boxShadow = 'none';            Transform your study routine with smart tools, organized notes, and progress tracking.             </button>

            }

        });            Everything you need for academic excellence in one beautiful platform.            <button class="btn-secondary" onclick="scrollToFeatures()" style="padding: 1rem 2rem; font-size: 1.1rem;">

    </script>

</body>        </p>                <i class="fas fa-play"></i> See How It Works

</html>
                    </button>

        <div class="cta-buttons">        </div>

            <button class="btn-primary" onclick="openLoginModal()" style="padding: 1rem 2rem; font-size: 1.1rem;">        

                <i class="fas fa-rocket"></i> Start Studying Free        <!-- Success Message Preview -->

            </button>        <div style="background: var(--bg-secondary); border-radius: 16px; padding: 2rem; margin: 2rem auto; max-width: 600px; border: 1px solid var(--border-color);">

            <button class="btn-secondary" onclick="scrollToFeatures()" style="padding: 1rem 2rem; font-size: 1.1rem;">            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; color: var(--success); margin-bottom: 1rem;">

                <i class="fas fa-play"></i> See How It Works                <i class="fas fa-check-circle" style="font-size: 1.5rem;"></i>

            </button>                <span style="font-weight: 600; font-size: 1.1rem;">✨ Success! Redirecting...</span>

        </div>            </div>

                    <p style="color: var(--text-secondary); margin: 0;">Join thousands of students already improving their grades</p>

        <!-- Success Message Preview -->        </div>

        <div style="background: var(--bg-secondary); border-radius: 16px; padding: 2rem; margin: 2rem auto; max-width: 600px; border: 1px solid var(--border-color);">    </section>

            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; color: var(--success); margin-bottom: 1rem;">

                <i class="fas fa-check-circle" style="font-size: 1.5rem;"></i>    <!-- Features Section -->

                <span style="font-weight: 600; font-size: 1.1rem;">✨ Success! Redirecting...</span>    <section class="features" id="features">

            </div>        <div class="features-header">

            <p style="color: var(--text-secondary); margin: 0;">Join thousands of students already improving their grades</p>            <h2 class="features-title">⭐ What's Inside</h2>

        </div>            <p class="features-subtitle">

    </section>                Everything you need to organize your studies, track progress, and achieve your academic goals

            </p>

    <!-- Features Section -->        </div>

    <section class="features" id="features">        

        <div class="features-header">        <div class="features-grid">

            <h2 class="features-title">⭐ What's Inside</h2>            <div class="feature-card">

            <p class="features-subtitle">                <div class="feature-icon">

                Everything you need to organize your studies, track progress, and achieve your academic goals                    <i class="fas fa-brain"></i>

            </p>                </div>

        </div>                <h3 class="feature-title">Smart Study Tools</h3>

                        <p class="feature-description">

        <div class="features-grid">                    Organize subjects, create flashcards, and use advanced study techniques to maximize retention and understanding.

            <div class="feature-card">                </p>

                <div class="feature-icon">            </div>

                    <i class="fas fa-brain"></i>            

                </div>            <div class="feature-card">

                <h3 class="feature-title">Smart Study Tools</h3>                <div class="feature-icon">

                <p class="feature-description">                    <i class="fas fa-folder"></i>

                    Organize subjects, create flashcards, and use advanced study techniques to maximize retention and understanding.                </div>

                </p>                <h3 class="feature-title">File Management</h3>

            </div>                <p class="feature-description">

                                Upload and organize all your study materials in one place. PDFs, documents, images - everything accessible instantly.

            <div class="feature-card">                </p>

                <div class="feature-icon">            </div>

                    <i class="fas fa-folder"></i>            

                </div>            <div class="feature-card">

                <h3 class="feature-title">File Management</h3>                <div class="feature-icon">

                <p class="feature-description">                    <i class="fas fa-clock"></i>

                    Upload and organize all your study materials in one place. PDFs, documents, images - everything accessible instantly.                </div>

                </p>                <h3 class="feature-title">Pomodoro Timer</h3>

            </div>                <p class="feature-description">

                                Built-in focus timer helps you study more effectively with proven time management techniques.

            <div class="feature-card">                </p>

                <div class="feature-icon">            </div>

                    <i class="fas fa-clock"></i>            

                </div>            <div class="feature-card">

                <h3 class="feature-title">Pomodoro Timer</h3>                <div class="feature-icon">

                <p class="feature-description">                    <i class="fas fa-tasks"></i>

                    Built-in focus timer helps you study more effectively with proven time management techniques.                </div>

                </p>                <h3 class="feature-title">Task Tracking</h3>

            </div>                <p class="feature-description">

                                Set study goals, track progress, and never miss important deadlines with our intuitive task management.

            <div class="feature-card">                </p>

                <div class="feature-icon">            </div>

                    <i class="fas fa-tasks"></i>            

                </div>            <div class="feature-card">

                <h3 class="feature-title">Task Tracking</h3>                <div class="feature-icon">

                <p class="feature-description">                    <i class="fas fa-layer-group"></i>

                    Set study goals, track progress, and never miss important deadlines with our intuitive task management.                </div>

                </p>                <h3 class="feature-title">Flashcards</h3>

            </div>                <p class="feature-description">

                                Create, review, and master concepts with our intelligent flashcard system designed for optimal learning.

            <div class="feature-card">                </p>

                <div class="feature-icon">            </div>

                    <i class="fas fa-layer-group"></i>            

                </div>            <div class="feature-card">

                <h3 class="feature-title">Flashcards</h3>                <div class="feature-icon">

                <p class="feature-description">                    <i class="fas fa-palette"></i>

                    Create, review, and master concepts with our intelligent flashcard system designed for optimal learning.                </div>

                </p>                <h3 class="feature-title">Custom Themes</h3>

            </div>                <p class="feature-description">

                                Personalize your study environment with beautiful themes and wallpapers that inspire focus and creativity.

            <div class="feature-card">                </p>

                <div class="feature-icon">            </div>

                    <i class="fas fa-palette"></i>        </div>

                </div>    </section>

                <h3 class="feature-title">Custom Themes</h3>

                <p class="feature-description">    <!-- Login Modal -->

                    Personalize your study environment with beautiful themes and wallpapers that inspire focus and creativity.    <div class="login-modal" id="loginModal">

                </p>        <div class="modal-content">

            </div>            <button class="modal-close" onclick="closeLoginModal()">

        </div>                <i class="fas fa-times"></i>

    </section>            </button>

            

    <!-- Login Modal -->            <div class="logo-icon" style="margin: 0 auto 1.5rem;">RHQ</div>

    <div class="login-modal" id="loginModal">            <h2 class="modal-title">Welcome to Revision HQ</h2>

        <div class="modal-content">            <p class="modal-subtitle">Sign in to access your personal study hub</p>

            <button class="modal-close" onclick="closeLoginModal()">            

                <i class="fas fa-times"></i>            <div id="g_id_onload"

            </button>                 data-client_id="your-google-client-id"

                             data-callback="handleCredentialResponse"

            <div class="logo-icon" style="margin: 0 auto 1.5rem;">RHQ</div>                 data-auto_prompt="false">

            <h2 class="modal-title">Welcome to Revision HQ</h2>            </div>

            <p class="modal-subtitle">Sign in to access your personal study hub</p>            

                        <button class="google-btn" onclick="handleGoogleSignIn()">

            <div id="g_id_onload"                <svg width="20" height="20" viewBox="0 0 24 24">

                 data-client_id="1067928071044-h9jm9q2g6vtl8vc44gk94lhp3dq4cgoi.apps.googleusercontent.com"                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>

                 data-callback="handleCredentialResponse"                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>

                 data-auto_prompt="false">                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>

            </div>                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>

                            </svg>

            <button class="google-btn" onclick="handleGoogleSignIn()">                Continue with Google

                <svg width="20" height="20" viewBox="0 0 24 24">            </button>

                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>            

                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>            <p style="margin-top: 1.5rem; font-size: 0.9rem; color: var(--text-secondary);">

                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>                By continuing, you agree to our Terms of Service and Privacy Policy

                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>            </p>

                </svg>        </div>

                Continue with Google    </div>

            </button>

                <script>

            <p style="margin-top: 1.5rem; font-size: 0.9rem; color: var(--text-secondary);">            margin: 2rem 0;

                By continuing, you agree to our Terms of Service and Privacy Policy        }

            </p>

        </div>        .custom-google-btn {

    </div>            background: var(--bg);

            border: 2px solid var(--border);

    <script>            border-radius: 12px;

        // Landing page functionality            padding: 1rem 2rem;

        function openLoginModal() {            font-size: 1.1rem;

            document.getElementById('loginModal').style.display = 'flex';            font-weight: 600;

        }            color: var(--text);

                    cursor: pointer;

        function closeLoginModal() {            transition: all 0.3s ease;

            document.getElementById('loginModal').style.display = 'none';            display: inline-flex;

        }            align-items: center;

                    gap: 1rem;

        function scrollToFeatures() {            text-decoration: none;

            document.getElementById('features').scrollIntoView({ behavior: 'smooth' });            box-shadow: var(--shadow);

        }        }

        

        // Close modal when clicking outside        .custom-google-btn:hover {

        document.getElementById('loginModal').addEventListener('click', function(e) {            border-color: var(--primary);

            if (e.target === this) {            transform: translateY(-2px);

                closeLoginModal();            box-shadow: 0 8px 16px -4px rgba(79, 70, 229, 0.3);

            }        }

        });

                .features {

        // Google Sign-In functionality            margin-top: 3rem;

        function handleGoogleSignIn() {            text-align: left;

            // Initialize Google Sign-In if not already done        }

            if (typeof google !== 'undefined') {

                google.accounts.id.initialize({        .features h3 {

                    client_id: '1067928071044-h9jm9q2g6vtl8vc44gk94lhp3dq4cgoi.apps.googleusercontent.com',            color: var(--text);

                    callback: handleCredentialResponse            font-size: 1.2rem;

                });            font-weight: 600;

                google.accounts.id.prompt();            margin-bottom: 1.5rem;

            } else {            text-align: center;

                // Fallback - redirect to dashboard for demo        }

                window.location.href = 'dashboard.php';

            }        .feature-grid {

        }            display: grid;

                    grid-template-columns: 1fr 1fr;

        function handleCredentialResponse(response) {            gap: 1rem;

            // Show loading state        }

            const modalContent = document.querySelector('.modal-content');

            modalContent.innerHTML = `        .feature-item {

                <div style="padding: 2rem; text-align: center;">            display: flex;

                    <div style="display: inline-block; width: 40px; height: 40px; border: 4px solid var(--border-color); border-top: 4px solid var(--primary-color); border-radius: 50%; animation: spin 1s linear infinite; margin-bottom: 1.5rem;"></div>            align-items: center;

                    <h3 style="color: var(--text-primary); margin-bottom: 0.5rem;">Signing you in...</h3>            gap: 0.75rem;

                    <p style="color: var(--text-secondary);">Please wait while we set up your account</p>            padding: 1rem;

                </div>            background: var(--bg-secondary);

            `;            border-radius: 12px;

            border: 1px solid var(--border);

            // Send the ID token to your server            transition: all 0.3s ease;

            fetch('inc/auth.php', {        }

                method: 'POST',

                headers: {        .feature-item:hover {

                    'Content-Type': 'application/json',            transform: translateY(-2px);

                },            box-shadow: var(--shadow);

                body: JSON.stringify({        }

                    credential: response.credential

                })        .feature-icon {

            })            width: 40px;

            .then(response => response.json())            height: 40px;

            .then(data => {            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);

                if (data.success) {            border-radius: 10px;

                    // Success - show success message and redirect            display: flex;

                    modalContent.innerHTML = `            align-items: center;

                        <div style="padding: 2rem; text-align: center;">            justify-content: center;

                            <div style="color: var(--success); font-size: 3rem; margin-bottom: 1rem;">            color: white;

                                <i class="fas fa-check-circle"></i>            font-size: 1.2rem;

                            </div>        }

                            <h3 style="color: var(--text-primary); margin-bottom: 0.5rem;">Welcome aboard!</h3>

                            <p style="color: var(--text-secondary);">Redirecting to your study dashboard...</p>        .feature-text {

                        </div>            font-size: 0.9rem;

                    `;            font-weight: 500;

                    setTimeout(() => {            color: var(--text);

                        window.location.href = 'dashboard.php';        }

                    }, 1500);

                } else {        .theme-toggle {

                    // Error handling            position: absolute;

                    modalContent.innerHTML = `            top: 1rem;

                        <div style="padding: 2rem; text-align: center;">            right: 1rem;

                            <div style="color: var(--error); font-size: 3rem; margin-bottom: 1rem;">            background: var(--bg-secondary);

                                <i class="fas fa-exclamation-triangle"></i>            border: 1px solid var(--border);

                            </div>            border-radius: 10px;

                            <h3 style="color: var(--text-primary); margin-bottom: 0.5rem;">Oops! Something went wrong</h3>            padding: 0.75rem;

                            <p style="color: var(--text-secondary);">${data.message}</p>            cursor: pointer;

                            <button onclick="closeLoginModal(); location.reload();" class="btn-primary" style="margin-top: 1rem;">Try Again</button>            transition: all 0.3s ease;

                        </div>            color: var(--text);

                    `;        }

                }

            })        .theme-toggle:hover {

            .catch(error => {            background: var(--primary);

                console.error('Auth error:', error);            color: white;

                // For demo purposes, redirect anyway        }

                modalContent.innerHTML = `

                    <div style="padding: 2rem; text-align: center;">        @media (max-width: 640px) {

                        <div style="color: var(--success); font-size: 3rem; margin-bottom: 1rem;">            .login-container {

                            <i class="fas fa-check-circle"></i>                padding: 2rem;

                        </div>                margin: 1rem;

                        <h3 style="color: var(--text-primary); margin-bottom: 0.5rem;">Demo Mode</h3>            }

                        <p style="color: var(--text-secondary);">Redirecting to dashboard...</p>            

                    </div>            .title {

                `;                font-size: 2rem;

                setTimeout(() => {            }

                    window.location.href = 'dashboard.php';            

                }, 1500);            .feature-grid {

            });                grid-template-columns: 1fr;

        }            }

                }

        // Add loading animation CSS    </style>

        const style = document.createElement('style');</head>

        style.textContent = `<body>

            @keyframes spin {    <button class="theme-toggle" onclick="toggleTheme()">

                0% { transform: rotate(0deg); }        <i class="fas fa-moon"></i>

                100% { transform: rotate(360deg); }    </button>

            }

        `;    <div class="login-container">

        document.head.appendChild(style);        <div class="logo">

                    RHQ

        // Smooth navbar scroll effect        </div>

        window.addEventListener('scroll', function() {        

            const navbar = document.querySelector('.navbar');        <h1 class="title">Revision HQ</h1>

            if (window.scrollY > 50) {        <p class="subtitle">Your personal study hub for academic excellence</p>

                navbar.style.background = 'rgba(255, 255, 255, 0.98)';        

                navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';        <div class="google-signin-container">

            } else {            <div id="g_id_onload"

                navbar.style.background = 'rgba(255, 255, 255, 0.95)';                 data-client_id="707730920463-tf7svsd22kt8jh5jjsq9llp4ti1lchd9.apps.googleusercontent.com"

                navbar.style.boxShadow = 'none';                 data-callback="handleCredentialResponse"

            }                 data-auto_prompt="false">

        });            </div>

    </script>            

</body>            <div class="g_id_signin"

</html>                 data-type="standard"
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