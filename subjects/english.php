<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English - Revision HQ</title>
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
        <div style="background: #ef4444; width: 64px; height: 64px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
            <i class="fas fa-book-open"></i>
        </div>
        <div>
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">English</h1>
            <p style="color: var(--text-secondary);">Language, literature, and composition</p>
        </div>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 2rem; display: grid; gap: 2rem;">
        
        <!-- Vocabulary Builder -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-spell-check" style="color: var(--primary-color);"></i>
                Vocabulary Builder
            </h2>
            <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                    <input type="text" placeholder="Enter new word..." style="flex: 1; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px;">
                    <button class="btn">Add Word</button>
                </div>
                <div style="display: grid; gap: 0.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: var(--bg-tertiary); border-radius: 8px;">
                        <div>
                            <strong>Eloquent</strong> - fluent or persuasive in speaking or writing
                        </div>
                        <button class="btn secondary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Study</button>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: var(--bg-tertiary); border-radius: 8px;">
                        <div>
                            <strong>Meticulous</strong> - showing great attention to detail; very careful
                        </div>
                        <button class="btn secondary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Study</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Essay Templates -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-file-alt" style="color: var(--primary-color);"></i>
                Essay Templates
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 1rem;">Argumentative Essay</h4>
                    <ul style="color: var(--text-secondary); font-size: 0.9rem;">
                        <li>Introduction with thesis</li>
                        <li>Body paragraph 1: First argument</li>
                        <li>Body paragraph 2: Second argument</li>
                        <li>Counter-argument & refutation</li>
                        <li>Conclusion</li>
                    </ul>
                    <button class="btn secondary" style="margin-top: 1rem; width: 100%;">Use Template</button>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 1rem;">Descriptive Essay</h4>
                    <ul style="color: var(--text-secondary); font-size: 0.9rem;">
                        <li>Introduction with hook</li>
                        <li>Body paragraph 1: Visual details</li>
                        <li>Body paragraph 2: Sensory details</li>
                        <li>Body paragraph 3: Emotional impact</li>
                        <li>Conclusion with reflection</li>
                    </ul>
                    <button class="btn secondary" style="margin-top: 1rem; width: 100%;">Use Template</button>
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
