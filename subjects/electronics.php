<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronics - Revision HQ</title>
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
        <div style="background: #06b6d4; width: 64px; height: 64px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
            <i class="fas fa-microchip"></i>
        </div>
        <div>
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">Electronics</h1>
            <p style="color: var(--text-secondary);">Circuits, components, and electrical engineering</p>
        </div>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 2rem; display: grid; gap: 2rem;">
        
        <!-- Ohm's Law Calculator -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-calculator" style="color: var(--primary-color);"></i>
                Ohm's Law Calculator
            </h2>
            <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 2rem;">
                <p style="text-align: center; margin-bottom: 1rem; font-size: 1.2rem; color: var(--primary-color);">V = I × R</p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem;">Voltage (V)</label>
                        <input type="number" id="voltage" placeholder="Volts" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem;">Current (I)</label>
                        <input type="number" id="current" placeholder="Amperes" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem;">Resistance (R)</label>
                        <input type="number" id="resistance" placeholder="Ohms" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px;">
                    </div>
                </div>
                <button class="btn" onclick="calculateOhmsLaw()" style="width: 100%;">Calculate</button>
                <div id="ohmsResult" style="margin-top: 1rem; padding: 1rem; background: var(--bg-tertiary); border-radius: 8px; text-align: center; display: none;">
                    Result will appear here
                </div>
            </div>
        </div>

        <!-- Component Symbols -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-sitemap" style="color: var(--primary-color);"></i>
                Component Symbols
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem; text-align: center;">
                    <div style="height: 60px; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--primary-color);">⚡</div>
                    <p style="font-weight: 500;">Resistor</p>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem; text-align: center;">
                    <div style="height: 60px; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--primary-color);">🔋</div>
                    <p style="font-weight: 500;">Battery</p>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem; text-align: center;">
                    <div style="height: 60px; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--primary-color);">💡</div>
                    <p style="font-weight: 500;">LED</p>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem; text-align: center;">
                    <div style="height: 60px; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--primary-color);">🔘</div>
                    <p style="font-weight: 500;">Switch</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateOhmsLaw() {
            const voltage = parseFloat(document.getElementById('voltage').value);
            const current = parseFloat(document.getElementById('current').value);
            const resistance = parseFloat(document.getElementById('resistance').value);
            const result = document.getElementById('ohmsResult');
            
            let calculation = '';
            
            if (!isNaN(voltage) && !isNaN(current) && isNaN(resistance)) {
                const r = voltage / current;
                calculation = `Resistance = ${voltage}V ÷ ${current}A = ${r.toFixed(2)}Ω`;
            } else if (!isNaN(voltage) && isNaN(current) && !isNaN(resistance)) {
                const i = voltage / resistance;
                calculation = `Current = ${voltage}V ÷ ${resistance}Ω = ${i.toFixed(2)}A`;
            } else if (isNaN(voltage) && !isNaN(current) && !isNaN(resistance)) {
                const v = current * resistance;
                calculation = `Voltage = ${current}A × ${resistance}Ω = ${v.toFixed(2)}V`;
            } else {
                calculation = 'Please enter exactly 2 values to calculate the third.';
            }
            
            result.innerHTML = calculation;
            result.style.display = 'block';
        }

        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
        }
    </script>
</body>
</html>
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
        }
    </script>
</body>
</html>
