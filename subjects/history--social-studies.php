<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History & Social Studies - Revision HQ</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <a href="../dashboard.php" class="logo">
            <div class="logo-icon">RHQ</div>
            Revision HQ
        </a>
        
        <nav>
            <a href="../dashboard.php" style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--text-primary); text-decoration: none; padding: 0.5rem 1rem; border: 1px solid var(--border-color); border-radius: 8px;">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </nav>
        
        <div class="header-controls">
            <button class="theme-switcher" onclick="toggleTheme()">
                <i class="fas fa-moon"></i>
            </button>
        </div>
    </header>

    <div style="background: var(--bg-secondary); padding: 2rem; display: flex; align-items: center; gap: 1.5rem;">
        <div style="background: #f59e0b; width: 64px; height: 64px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
            <i class="fas fa-landmark"></i>
        </div>
        <div>
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">History & Social Studies</h1>
            <p style="color: var(--text-secondary);">Historical events, society, and human civilization</p>
        </div>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 2rem; display: grid; gap: 2rem;">
        
        <!-- Timeline Tool -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-timeline" style="color: var(--primary-color);"></i>
                Historical Timeline
            </h2>
            <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                <div style="position: relative; padding-left: 2rem;">
                    <div style="position: absolute; left: 1rem; top: 0; bottom: 0; width: 2px; background: var(--primary-color);"></div>
                    
                    <div style="position: relative; margin-bottom: 2rem;">
                        <div style="position: absolute; left: -2rem; width: 12px; height: 12px; background: var(--primary-color); border-radius: 50%; margin-top: 0.25rem;"></div>
                        <div>
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">1945</h4>
                            <p><strong>End of World War II</strong></p>
                            <p style="color: var(--text-secondary); font-size: 0.9rem;">Allied victory, formation of UN</p>
                        </div>
                    </div>
                    
                    <div style="position: relative; margin-bottom: 2rem;">
                        <div style="position: absolute; left: -2rem; width: 12px; height: 12px; background: var(--primary-color); border-radius: 50%; margin-top: 0.25rem;"></div>
                        <div>
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">1965</h4>
                            <p><strong>Singapore Independence</strong></p>
                            <p style="color: var(--text-secondary); font-size: 0.9rem;">Separation from Malaysia</p>
                        </div>
                    </div>
                    
                    <div style="position: relative;">
                        <div style="position: absolute; left: -2rem; width: 12px; height: 12px; background: var(--primary-color); border-radius: 50%; margin-top: 0.25rem;"></div>
                        <div>
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">1989</h4>
                            <p><strong>Fall of Berlin Wall</strong></p>
                            <p style="color: var(--text-secondary); font-size: 0.9rem;">End of Cold War era</p>
                        </div>
                    </div>
                </div>
                <button class="btn" style="margin-top: 1rem; width: 100%;">Add New Event</button>
            </div>
        </div>

        <!-- Essay Structure -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-scroll" style="color: var(--primary-color);"></i>
                Essay Templates
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 1rem;">Source-Based Question (SBQ)</h4>
                    <ul style="color: var(--text-secondary); font-size: 0.9rem; padding-left: 1rem;">
                        <li>Study the source carefully</li>
                        <li>Identify the message/purpose</li>
                        <li>Consider the context</li>
                        <li>Evaluate reliability</li>
                        <li>Cross-reference with knowledge</li>
                    </ul>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 1rem;">Structured Essay Question (SEQ)</h4>
                    <ul style="color: var(--text-secondary); font-size: 0.9rem; padding-left: 1rem;">
                        <li>Introduction with thesis</li>
                        <li>Factor 1 with examples</li>
                        <li>Factor 2 with examples</li>
                        <li>Counter-argument (if applicable)</li>
                        <li>Conclusion with judgment</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
        }
    </script>
</body>
</html>
    </script>
</body>
</html>
