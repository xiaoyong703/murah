<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chinese - Revision HQ</title>
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
        <div style="background: #f97316; width: 64px; height: 64px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
            <i class="fas fa-language"></i>
        </div>
        <div>
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">Chinese</h1>
            <p style="color: var(--text-secondary);">中文语言学习 - Chinese language studies</p>
        </div>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 2rem; display: grid; gap: 2rem;">
        
        <!-- Character Practice -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-pen-nib" style="color: var(--primary-color);"></i>
                Character Practice (汉字练习)
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem; text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 0.5rem;">学</div>
                    <p style="font-weight: 500;">xué</p>
                    <p style="font-size: 0.9rem; color: var(--text-secondary);">to study</p>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem; text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 0.5rem;">习</div>
                    <p style="font-weight: 500;">xí</p>
                    <p style="font-size: 0.9rem; color: var(--text-secondary);">to practice</p>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem; text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 0.5rem;">语</div>
                    <p style="font-weight: 500;">yǔ</p>
                    <p style="font-size: 0.9rem; color: var(--text-secondary);">language</p>
                </div>
            </div>
        </div>

        <!-- Composition Templates -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem;">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-file-alt" style="color: var(--primary-color);"></i>
                作文模板 (Composition Templates)
            </h2>
            <div style="display: grid; gap: 1rem;">
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 1rem;">记叙文 (Narrative Essay)</h4>
                    <div style="color: var(--text-secondary); font-size: 0.9rem;">
                        <p><strong>开头:</strong> 时间、地点、人物、事件</p>
                        <p><strong>经过:</strong> 详细描述事件发展</p>
                        <p><strong>结尾:</strong> 总结感想</p>
                    </div>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 1rem;">议论文 (Argumentative Essay)</h4>
                    <div style="color: var(--text-secondary); font-size: 0.9rem;">
                        <p><strong>论点:</strong> 明确观点</p>
                        <p><strong>论据:</strong> 事实和道理</p>
                        <p><strong>论证:</strong> 逻辑推理</p>
                        <p><strong>结论:</strong> 总结观点</p>
                    </div>
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
