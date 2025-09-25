<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chemistry & Physics - Revision HQ</title>
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
        <div style="background: #10b981; width: 64px; height: 64px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
            <i class="fas fa-atom"></i>
        </div>
        <div>
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">Chemistry & Physics</h1>
            <p style="color: var(--text-secondary);">Sciences, experiments, and natural phenomena</p>
        </div>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 2rem; display: grid; gap: 2rem;">
        
        <!-- Periodic Table -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-table" style="color: var(--primary-color);"></i>
                Periodic Table
            </h2>
            <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 2rem; text-align: center;">
                <p style="color: var(--text-secondary); margin-bottom: 1rem;">Interactive Periodic Table</p>
                <div style="display: grid; grid-template-columns: repeat(18, 1fr); gap: 2px; max-width: 900px; margin: 0 auto;">
                    <div style="background: #ff6b6b; color: white; padding: 0.25rem; text-align: center; font-size: 0.8rem; border-radius: 2px;">H</div>
                    <div style="grid-column: 18; background: #4ecdc4; color: white; padding: 0.25rem; text-align: center; font-size: 0.8rem; border-radius: 2px;">He</div>
                    <div style="background: #45b7d1; color: white; padding: 0.25rem; text-align: center; font-size: 0.8rem; border-radius: 2px;">Li</div>
                    <div style="background: #96ceb4; color: white; padding: 0.25rem; text-align: center; font-size: 0.8rem; border-radius: 2px;">Be</div>
                </div>
                <p style="color: var(--text-secondary); margin-top: 1rem; font-size: 0.9rem;">Click on elements for more information</p>
            </div>
        </div>

        <!-- Physics Constants -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-bolt" style="color: var(--primary-color);"></i>
                Physics Constants
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Speed of Light</h4>
                    <p>c = 3.00 × 10⁸ m/s</p>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Gravity</h4>
                    <p>g = 9.81 m/s²</p>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Planck's Constant</h4>
                    <p>h = 6.626 × 10⁻³⁴ J·s</p>
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
        }
    </script>
</body>
</html>
