<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math - Revision HQ</title>
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
        <div style="background: #8b5cf6; width: 64px; height: 64px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
            <i class="fas fa-calculator"></i>
        </div>
        <div>
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">Mathematics</h1>
            <p style="color: var(--text-secondary);">Algebra, geometry, and mathematical concepts</p>
        </div>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 2rem; display: grid; gap: 2rem;">
        
        <!-- Math Formulas -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-square-root-alt" style="color: var(--primary-color);"></i>
                Math Formulas
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 1rem;">Quadratic Formula</h4>
                    <p style="font-size: 1.2rem; text-align: center;">x = (-b ± √(b² - 4ac)) / 2a</p>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 1rem;">Circle Area</h4>
                    <p style="font-size: 1.2rem; text-align: center;">A = πr²</p>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 1rem;">Pythagorean Theorem</h4>
                    <p style="font-size: 1.2rem; text-align: center;">a² + b² = c²</p>
                </div>
            </div>
        </div>

        <!-- Graphing Tool -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-chart-line" style="color: var(--primary-color);"></i>
                Graphing Tool
            </h2>
            <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 2rem; text-align: center;">
                <p style="color: var(--text-secondary); margin-bottom: 1rem;">Enter a function to graph:</p>
                <input type="text" placeholder="e.g., x^2 + 2x + 1" style="width: 100%; max-width: 300px; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; margin-bottom: 1rem;">
                <br>
                <button class="btn">Graph Function</button>
                <div style="height: 300px; background: #f8f9fa; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 1rem; display: flex; align-items: center; justify-content: center; color: var(--text-secondary);">
                    Graph will appear here
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
