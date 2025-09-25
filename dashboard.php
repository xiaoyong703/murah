<?php
session_start();
require_once 'inc/config.php';
require_once 'inc/functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    // Get user data
    $user = getUserById($user_id);
    if (!$user) {
        session_destroy();
        header('Location: index.php');
        exit;
    }
    
    // Get user's subjects
    $subjects = getSubjectsForUser($user_id);
    
    // If no subjects found, initialize defaults
    if (empty($subjects)) {
        initializeDefaultSubjects($user_id);
        $subjects = getSubjectsForUser($user_id);
    }
    
    // Get user's tasks
    $tasks = getTasksForUser($user_id);
    
    // Get user's quick notes
    $quick_notes = getNotesForUser($user_id);
    
} catch (Exception $e) {
    error_log("Dashboard error: " . $e->getMessage());
    // Fallback data
    $user = ['name' => 'User', 'picture' => '', 'theme' => 'light'];
    $subjects = [];
    $tasks = [];
    $quick_notes = null;
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $user['theme'] ?? 'light'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Revision HQ</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --secondary: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --bg: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #e2e8f0;
            --text: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --radius: 12px;
            --radius-lg: 16px;
        }

        [data-theme="dark"] {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #22d3ee;
            --success: #34d399;
            --warning: #fbbf24;
            --error: #f87171;
            --bg: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
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
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: var(--bg);
            border-bottom: 1px solid var(--border);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--text);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 1.2rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .header-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-btn {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.75rem;
            color: var(--text);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-1px);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid var(--border);
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            border-color: var(--primary);
        }

        /* Main Layout */
        .main-container {
            display: grid;
            grid-template-columns: 300px 1fr 300px;
            gap: 2rem;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        @media (max-width: 1200px) {
            .main-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        /* Cards */
        .card {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .card-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text);
        }

        /* Subjects Grid */
        .subjects-grid {
            display: grid;
            gap: 1rem;
        }

        .subject-card-container {
            position: relative;
        }

        .subject-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            text-decoration: none;
            color: var(--text);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: block;
        }

        .subject-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .subject-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            background: var(--bg);
        }

        .subject-actions {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            display: flex;
            gap: 0.25rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .subject-card-container:hover .subject-actions {
            opacity: 1;
        }

        .action-btn-small {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--border);
            border-radius: 6px;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.8rem;
        }

        .action-btn-small.edit:hover {
            background: var(--primary);
            color: white;
        }

        .action-btn-small.delete:hover {
            background: var(--error);
            color: white;
        }

        .subject-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.75rem;
        }

        .subject-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .subject-info h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .subject-info p {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        /* Tasks */
        .task-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .task-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            transition: all 0.3s ease;
        }

        .task-item:hover {
            background: var(--bg);
            box-shadow: var(--shadow);
        }

        .task-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid var(--border);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .task-checkbox.completed {
            background: var(--success);
            border-color: var(--success);
        }

        .task-text {
            flex: 1;
            font-weight: 500;
        }

        .task-text.completed {
            text-decoration: line-through;
            color: var(--text-light);
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .action-btn {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            text-decoration: none;
            color: var(--text);
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .action-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .action-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        /* Notes */
        .notes-textarea {
            width: 100%;
            min-height: 200px;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1rem;
            font-family: inherit;
            font-size: 0.95rem;
            color: var(--text);
            resize: vertical;
            transition: all 0.3s ease;
        }

        .notes-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        /* Timer */
        .timer-display {
            font-size: 3rem;
            font-weight: 800;
            text-align: center;
            margin: 1.5rem 0;
            color: var(--primary);
            font-family: 'JetBrains Mono', monospace;
        }

        .timer-controls {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .timer-btn {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius);
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .timer-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .timer-btn.secondary {
            background: var(--bg-secondary);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .timer-btn.secondary:hover {
            background: var(--bg-tertiary);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }
            
            .main-container {
                padding: 1rem;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <a href="dashboard.php" class="logo">
            <div class="logo-icon">RHQ</div>
            <div class="logo-text">Revision HQ</div>
        </a>
        
        <div class="header-controls">
            <button class="header-btn" onclick="toggleTheme()">
                <i class="fas fa-moon"></i>
            </button>
            <button class="header-btn" onclick="openWallpaperModal()">
                <i class="fas fa-image"></i>
            </button>
            <img src="<?php echo htmlspecialchars($user['picture'] ?: 'https://via.placeholder.com/40'); ?>" 
                 alt="Avatar" 
                 class="user-avatar" 
                 onclick="logout()">
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Left Sidebar - Subjects -->
        <div class="sidebar">
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h2 class="card-title">My Subjects</h2>
                    <button onclick="openSubjectModal()" style="background: var(--primary); color: white; border: none; border-radius: 8px; padding: 0.5rem 1rem; cursor: pointer; margin-left: auto;">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
                <div class="subjects-grid">
                    <?php foreach ($subjects as $subject): ?>
                    <div class="subject-card-container">
                        <a href="subjects/subject.php?id=<?php echo $subject['id']; ?>" class="subject-card">
                            <div class="subject-header">
                                <div class="subject-icon">
                                    <i class="<?php echo $subject['icon']; ?>"></i>
                                </div>
                                <div class="subject-info">
                                    <h3><?php echo htmlspecialchars($subject['name']); ?></h3>
                                    <p><?php echo htmlspecialchars($subject['description']); ?></p>
                                </div>
                            </div>
                        </a>
                        <div class="subject-actions">
                            <button onclick="editSubject(<?php echo $subject['id']; ?>, '<?php echo htmlspecialchars($subject['name']); ?>', '<?php echo htmlspecialchars($subject['description']); ?>', '<?php echo $subject['icon']; ?>')" class="action-btn-small edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteSubject(<?php echo $subject['id']; ?>, '<?php echo htmlspecialchars($subject['name']); ?>')" class="action-btn-small delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Center Content -->
        <div class="main-content">
            <!-- Pomodoro Timer -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h2 class="card-title">Focus Timer</h2>
                </div>
                <div class="timer-display" id="timerDisplay">25:00</div>
                <div class="timer-controls">
                    <button class="timer-btn" id="startBtn" onclick="startTimer()">Start</button>
                    <button class="timer-btn secondary" onclick="resetTimer()">Reset</button>
                </div>
            </div>

            <!-- Quick Notes -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-sticky-note"></i>
                    </div>
                    <h2 class="card-title">Quick Notes</h2>
                </div>
                <textarea 
                    class="notes-textarea" 
                    id="quickNotes"
                    placeholder="Jot down your thoughts, reminders, or quick notes here..."
                    onchange="saveNotes()"><?php echo htmlspecialchars($quick_notes['content'] ?? ''); ?></textarea>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="sidebar">
            <!-- Tasks -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h2 class="card-title">Tasks</h2>
                </div>
                <div class="task-list" id="taskList">
                    <?php foreach ($tasks as $task): ?>
                    <div class="task-item">
                        <div class="task-checkbox <?php echo $task['completed'] ? 'completed' : ''; ?>" 
                             onclick="toggleTask(<?php echo $task['id']; ?>)">
                            <?php if ($task['completed']): ?>
                            <i class="fas fa-check" style="color: white;"></i>
                            <?php endif; ?>
                        </div>
                        <div class="task-text <?php echo $task['completed'] ? 'completed' : ''; ?>">
                            <?php echo htmlspecialchars($task['title']); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div style="margin-top: 1rem;">
                    <input type="text" id="newTaskInput" placeholder="Add new task..." 
                           style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: var(--radius); background: var(--bg-secondary); color: var(--text);"
                           onkeypress="if(event.key==='Enter') addTask()">
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h2 class="card-title">Quick Tools</h2>
                </div>
                <div class="quick-actions">
                    <a href="#" class="action-btn" onclick="openCalculator()">
                        <div class="action-icon"><i class="fas fa-calculator"></i></div>
                        <div>Calculator</div>
                    </a>
                    <a href="#" class="action-btn" onclick="openConverter()">
                        <div class="action-icon"><i class="fas fa-exchange-alt"></i></div>
                        <div>Converter</div>
                    </a>
                    <a href="#" class="action-btn" onclick="openWordCounter()">
                        <div class="action-icon"><i class="fas fa-font"></i></div>
                        <div>Word Count</div>
                    </a>
                    <a href="#" class="action-btn" onclick="openQRGenerator()">
                        <div class="action-icon"><i class="fas fa-qrcode"></i></div>
                        <div>QR Code</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Load user wallpaper on page load
        document.addEventListener('DOMContentLoaded', function() {
            const wallpaper = '<?php echo htmlspecialchars($user['wallpaper'] ?? ''); ?>';
            if (wallpaper) {
                document.body.style.backgroundImage = `url('${wallpaper}')`;
                document.body.style.backgroundSize = 'cover';
                document.body.style.backgroundPosition = 'center';
                document.body.style.backgroundAttachment = 'fixed';
            }
        });

        // Timer functionality
        let timerInterval = null;
        let timeLeft = 25 * 60; // 25 minutes
        let isRunning = false;

        function updateTimerDisplay() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            document.getElementById('timerDisplay').textContent = 
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        function startTimer() {
            if (isRunning) return;
            
            isRunning = true;
            const startBtn = document.getElementById('startBtn');
            startBtn.textContent = 'Running...';
            startBtn.disabled = true;
            
            timerInterval = setInterval(() => {
                timeLeft--;
                updateTimerDisplay();
                
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    isRunning = false;
                    startBtn.textContent = 'Start';
                    startBtn.disabled = false;
                    
                    // Notification
                    if (Notification.permission === 'granted') {
                        new Notification('🍅 Pomodoro Complete!', {
                            body: 'Time for a break!',
                            icon: '/favicon.ico'
                        });
                    }
                    alert('🍅 Pomodoro Complete! Time for a break!');
                    resetTimer();
                }
            }, 1000);
        }

        function resetTimer() {
            clearInterval(timerInterval);
            isRunning = false;
            timeLeft = 25 * 60;
            updateTimerDisplay();
            const startBtn = document.getElementById('startBtn');
            startBtn.textContent = 'Start';
            startBtn.disabled = false;
        }

        // Request notification permission
        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission();
        }

        // Theme toggle
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            
            const icon = document.querySelector('.header-btn i');
            icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            
            // Save preference
            fetch('inc/save_preference.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({key: 'theme', value: newTheme})
            });
        }

        // Notes auto-save
        function saveNotes() {
            const content = document.getElementById('quickNotes').value;
            fetch('inc/save_notes.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({content: content, type: 'quick'})
            });
        }

        // Task management
        function addTask() {
            const input = document.getElementById('newTaskInput');
            const title = input.value.trim();
            if (!title) return;
            
            fetch('inc/add_task.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({title: title})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function toggleTask(taskId) {
            fetch('inc/toggle_task.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({task_id: taskId})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        // Quick tools (placeholder functions)
        function openCalculator() {
            window.open('https://www.google.com/search?q=calculator', '_blank');
        }

        function openConverter() {
            window.open('https://www.google.com/search?q=unit+converter', '_blank');
        }

        function openWordCounter() {
            const text = prompt('Enter text to count words:');
            if (text) {
                const words = text.trim().split(/\s+/).length;
                alert(`Word count: ${words}\nCharacter count: ${text.length}`);
            }
        }

        function openQRGenerator() {
            const text = prompt('Enter text to generate QR code:');
            if (text) {
                window.open(`https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(text)}`, '_blank');
            }
        }

        function openWallpaperModal() {
            // Create wallpaper modal
            const modal = document.createElement('div');
            modal.innerHTML = `
                <div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); z-index: 1000; display: flex; align-items: center; justify-content: center;" onclick="closeWallpaperModal(event)">
                    <div style="background: var(--bg); border-radius: 16px; padding: 2rem; width: 90%; max-width: 500px; max-height: 80vh; overflow-y: auto;" onclick="event.stopPropagation()">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                            <h2 style="color: var(--text); margin: 0;">🎨 Wallpapers</h2>
                            <button onclick="closeWallpaperModal()" style="background: none; border: none; font-size: 1.5rem; color: var(--text); cursor: pointer;">&times;</button>
                        </div>
                        
                        <div style="margin-bottom: 2rem;">
                            <input type="file" id="wallpaperInput" accept="image/*" style="display: none;" onchange="uploadWallpaper()">
                            <button onclick="document.getElementById('wallpaperInput').click()" style="background: var(--primary); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; width: 100%;">
                                <i class="fas fa-upload"></i> Upload New Wallpaper
                            </button>
                        </div>
                        
                        <div style="margin-bottom: 1rem;">
                            <button onclick="removeWallpaper()" style="background: var(--error); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; width: 100%;">
                                <i class="fas fa-trash"></i> Remove Wallpaper
                            </button>
                        </div>
                        
                        <div id="wallpaperGallery" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem;">
                            <div style="text-align: center; color: var(--text-light);">Loading wallpapers...</div>
                        </div>
                    </div>
                </div>
            `;
            modal.id = 'wallpaperModal';
            document.body.appendChild(modal);
            
            // Load user wallpapers
            loadWallpapers();
        }
        
        function closeWallpaperModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('wallpaperModal');
            if (modal) modal.remove();
        }
        
        function loadWallpapers() {
            fetch('inc/get_wallpapers.php')
                .then(response => response.json())
                .then(data => {
                    const gallery = document.getElementById('wallpaperGallery');
                    if (data.success && data.wallpapers.length > 0) {
                        gallery.innerHTML = data.wallpapers.map(wallpaper => `
                            <div style="position: relative; border-radius: 8px; overflow: hidden; cursor: pointer; border: 2px solid var(--border);" onclick="setWallpaper('${wallpaper.url}')">
                                <img src="${wallpaper.url}" style="width: 100%; height: 100px; object-fit: cover;">
                                <div style="position: absolute; top: 4px; right: 4px;">
                                    <button onclick="event.stopPropagation(); deleteWallpaper(${wallpaper.id})" style="background: rgba(239, 68, 68, 0.8); color: white; border: none; border-radius: 4px; width: 24px; height: 24px; cursor: pointer; font-size: 12px;">×</button>
                                </div>
                            </div>
                        `).join('');
                    } else {
                        gallery.innerHTML = '<div style="text-align: center; color: var(--text-light); grid-column: 1/-1;">No wallpapers uploaded yet</div>';
                    }
                });
        }
        
        function uploadWallpaper() {
            const input = document.getElementById('wallpaperInput');
            const file = input.files[0];
            if (!file) return;
            
            if (file.size > 5 * 1024 * 1024) {
                alert('File too large. Please choose an image under 5MB.');
                return;
            }
            
            const formData = new FormData();
            formData.append('wallpaper', file);
            
            fetch('inc/upload_wallpaper.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadWallpapers();
                } else {
                    alert('Upload failed: ' + data.message);
                }
            });
        }
        
        function setWallpaper(url) {
            document.body.style.backgroundImage = `url('${url}')`;
            document.body.style.backgroundSize = 'cover';
            document.body.style.backgroundPosition = 'center';
            document.body.style.backgroundAttachment = 'fixed';
            
            // Save preference
            fetch('inc/set_wallpaper.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({wallpaper: url})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeWallpaperModal();
                }
            });
        }
        
        function removeWallpaper() {
            document.body.style.backgroundImage = '';
            
            fetch('inc/set_wallpaper.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({wallpaper: ''})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeWallpaperModal();
                }
            });
        }
        
        function deleteWallpaper(id) {
            if (!confirm('Delete this wallpaper?')) return;
            
            fetch('inc/delete_wallpaper.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({wallpaper_id: id})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadWallpapers();
                }
            });
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'inc/logout.php';
            }
        }

        // Subject Management Functions
        function openSubjectModal(editMode = false, subjectData = null) {
            const isEdit = editMode && subjectData;
            const modalTitle = isEdit ? 'Edit Subject' : 'Create New Subject';
            const submitText = isEdit ? 'Update Subject' : 'Create Subject';
            
            const modal = document.createElement('div');
            modal.innerHTML = `
                <div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); z-index: 1000; display: flex; align-items: center; justify-content: center;" onclick="closeSubjectModal(event)">
                    <div style="background: var(--bg); border-radius: 16px; padding: 2rem; width: 90%; max-width: 500px;" onclick="event.stopPropagation()">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                            <h2 style="color: var(--text); margin: 0;">📚 ${modalTitle}</h2>
                            <button onclick="closeSubjectModal()" style="background: none; border: none; font-size: 1.5rem; color: var(--text); cursor: pointer;">&times;</button>
                        </div>
                        
                        <form onsubmit="submitSubject(event, ${isEdit})">
                            <input type="hidden" id="subjectId" value="${isEdit ? subjectData.id : ''}">
                            
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; margin-bottom: 0.5rem; color: var(--text); font-weight: 500;">Subject Name</label>
                                <input type="text" id="subjectName" required maxlength="100" 
                                       value="${isEdit ? subjectData.name : ''}"
                                       style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 8px; background: var(--bg-secondary); color: var(--text);"
                                       placeholder="e.g., Advanced Mathematics">
                            </div>
                            
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; margin-bottom: 0.5rem; color: var(--text); font-weight: 500;">Description</label>
                                <textarea id="subjectDescription" maxlength="255" rows="3"
                                          style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 8px; background: var(--bg-secondary); color: var(--text); resize: vertical;"
                                          placeholder="Brief description of this subject...">${isEdit ? subjectData.description : ''}</textarea>
                            </div>
                            
                            <div style="margin-bottom: 2rem;">
                                <label style="display: block; margin-bottom: 0.5rem; color: var(--text); font-weight: 500;">Icon</label>
                                <div style="display: grid; grid-template-columns: repeat(8, 1fr); gap: 0.5rem; max-height: 200px; overflow-y: auto; padding: 1rem; border: 1px solid var(--border); border-radius: 8px; background: var(--bg-secondary);">
                                    ${getIconOptions(isEdit ? subjectData.icon : 'fas fa-book')}
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: 1rem;">
                                <button type="button" onclick="closeSubjectModal()" 
                                        style="flex: 1; background: var(--bg-secondary); color: var(--text); border: 1px solid var(--border); border-radius: 8px; padding: 0.75rem; cursor: pointer;">
                                    Cancel
                                </button>
                                <button type="submit" 
                                        style="flex: 1; background: var(--primary); color: white; border: none; border-radius: 8px; padding: 0.75rem; cursor: pointer;">
                                    ${submitText}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            `;
            modal.id = 'subjectModal';
            document.body.appendChild(modal);
        }

        function getIconOptions(selectedIcon = 'fas fa-book') {
            const icons = [
                'fas fa-book', 'fas fa-calculator', 'fas fa-atom', 'fas fa-laptop-code',
                'fas fa-language', 'fas fa-landmark', 'fas fa-microscope', 'fas fa-flask',
                'fas fa-music', 'fas fa-palette', 'fas fa-running', 'fas fa-globe',
                'fas fa-chart-line', 'fas fa-dna', 'fas fa-brush', 'fas fa-camera',
                'fas fa-microchip', 'fas fa-rocket', 'fas fa-leaf', 'fas fa-heart',
                'fas fa-brain', 'fas fa-star', 'fas fa-graduation-cap', 'fas fa-lightbulb',
                'fas fa-cog', 'fas fa-cube', 'fas fa-fire', 'fas fa-eye',
                'fas fa-hand-holding-heart', 'fas fa-award', 'fas fa-trophy', 'fas fa-magic'
            ];
            
            return icons.map(icon => `
                <div onclick="selectIcon('${icon}')" 
                     style="width: 40px; height: 40px; border: 2px solid ${icon === selectedIcon ? 'var(--primary)' : 'var(--border)'}; 
                            border-radius: 8px; display: flex; align-items: center; justify-content: center; 
                            cursor: pointer; transition: all 0.3s ease; background: ${icon === selectedIcon ? 'var(--primary)' : 'var(--bg)'};
                            color: ${icon === selectedIcon ? 'white' : 'var(--text)'};" 
                     data-icon="${icon}">
                    <i class="${icon}"></i>
                </div>
            `).join('');
        }

        function selectIcon(iconClass) {
            // Remove selection from all icons
            document.querySelectorAll('[data-icon]').forEach(el => {
                el.style.borderColor = 'var(--border)';
                el.style.background = 'var(--bg)';
                el.style.color = 'var(--text)';
            });
            
            // Select clicked icon
            const selectedEl = document.querySelector(`[data-icon="${iconClass}"]`);
            selectedEl.style.borderColor = 'var(--primary)';
            selectedEl.style.background = 'var(--primary)';
            selectedEl.style.color = 'white';
            
            // Store selection
            document.getElementById('subjectModal').dataset.selectedIcon = iconClass;
        }

        function closeSubjectModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('subjectModal');
            if (modal) modal.remove();
        }

        function submitSubject(event, isEdit = false) {
            event.preventDefault();
            
            const name = document.getElementById('subjectName').value.trim();
            const description = document.getElementById('subjectDescription').value.trim();
            const selectedIcon = document.getElementById('subjectModal').dataset.selectedIcon || 'fas fa-book';
            const subjectId = document.getElementById('subjectId').value;
            
            if (!name) {
                alert('Please enter a subject name');
                return;
            }
            
            const data = {
                name: name,
                description: description,
                icon: selectedIcon
            };
            
            if (isEdit) {
                data.subject_id = subjectId;
            }
            
            const url = isEdit ? 'inc/update_subject.php' : 'inc/create_subject.php';
            
            fetch(url, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeSubjectModal();
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Network error occurred');
            });
        }

        function editSubject(id, name, description, icon) {
            openSubjectModal(true, {id, name, description, icon});
        }

        function deleteSubject(id, name) {
            if (!confirm(`Are you sure you want to delete "${name}"? This will also delete all files and data associated with this subject.`)) {
                return;
            }
            
            fetch('inc/delete_subject.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({subject_id: id})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Network error occurred');
            });
        }
    </script>
</body>
</html>