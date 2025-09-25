<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computing - Revision HQ</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <a href="../dashboard.php" class="logo">
            <div class="logo-icon">RHQ</div>
            Revision HQ
        </a>
        
        <nav>
            <a href="../dashboard.php" style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--text-primary); text-decoration: none; padding: 0.5rem 1rem; border: 1px solid var(--border-color); border-radius: 8px; transition: all 0.2s ease;">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </nav>
        
        <div class="header-controls">
            <button class="theme-switcher" onclick="toggleTheme()">
                <i class="fas fa-moon"></i>
            </button>
        </div>
    </header>

    <!-- Subject Header -->
    <div style="background: var(--bg-secondary); padding: 2rem; display: flex; align-items: center; gap: 1.5rem; border-bottom: 1px solid var(--border-color);">
        <div style="background: #3b82f6; width: 64px; height: 64px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
            <i class="fas fa-laptop-code"></i>
        </div>
        <div>
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem; color: var(--text-primary);">Computing</h1>
            <p style="color: var(--text-secondary);">Programming, algorithms, and computer science fundamentals</p>
        </div>
    </div>

    <!-- Subject Content -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 2rem; display: grid; gap: 2rem;">
        
        <!-- Key Concepts -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem; box-shadow: 0 2px 4px var(--shadow);">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--text-primary);">
                <i class="fas fa-lightbulb" style="color: var(--primary-color);"></i>
                Key Concepts & Formulas
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 1rem;">Time Complexity</h4>
                    <code style="background: var(--bg-tertiary); padding: 0.5rem; border-radius: 4px; font-size: 0.9rem;">O(1) < O(log n) < O(n) < O(n log n) < O(n²) < O(2ⁿ)</code>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem;">
                    <h4 style="color: var(--primary-color); margin-bottom: 1rem;">Binary Search</h4>
                    <pre style="background: var(--bg-tertiary); padding: 0.5rem; border-radius: 4px; font-size: 0.9rem;"><code>while (low <= high) {
    mid = (low + high) / 2;
    if (arr[mid] == target) return mid;
    else if (arr[mid] < target) low = mid + 1;
    else high = mid - 1;
}</code></pre>
                </div>
            </div>
        </div>

        <!-- Code Snippets -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem; box-shadow: 0 2px 4px var(--shadow);">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--text-primary);">
                <i class="fas fa-code" style="color: var(--primary-color);"></i>
                Code Snippets
            </h2>
            <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem; margin-bottom: 1rem;">
                <h4 style="margin-bottom: 0.5rem; color: var(--text-primary);">Bubble Sort</h4>
                <span style="background: var(--primary-color); color: white; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">Python</span>
                <pre style="margin-top: 1rem; background: var(--bg-tertiary); padding: 1rem; border-radius: 4px; overflow-x: auto;"><code>def bubble_sort(arr):
    n = len(arr)
    for i in range(n):
        for j in range(0, n-i-1):
            if arr[j] > arr[j+1]:
                arr[j], arr[j+1] = arr[j+1], arr[j]</code></pre>
            </div>
        </div>

        <!-- Flashcards -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem; box-shadow: 0 2px 4px var(--shadow);">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--text-primary);">
                <i class="fas fa-clone" style="color: var(--primary-color);"></i>
                Flashcards
            </h2>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1rem;">
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem; text-align: center;">
                    <div style="font-size: 2rem; font-weight: bold; color: var(--primary-color);">24</div>
                    <div style="color: var(--text-secondary);">Total Cards</div>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem; text-align: center;">
                    <div style="font-size: 2rem; font-weight: bold; color: var(--success);">18</div>
                    <div style="color: var(--text-secondary);">Mastered</div>
                </div>
                <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 1rem; text-align: center;">
                    <div style="font-size: 2rem; font-weight: bold; color: var(--warning);">6</div>
                    <div style="color: var(--text-secondary);">Learning</div>
                </div>
            </div>
            <div style="display: flex; gap: 1rem;">
                <button class="btn" onclick="alert('Study session - to be implemented')">
                    <i class="fas fa-play"></i>
                    Study Session
                </button>
                <button class="btn secondary" onclick="alert('Manage cards - to be implemented')">
                    <i class="fas fa-cog"></i>
                    Manage Cards
                </button>
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