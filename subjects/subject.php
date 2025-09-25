<?php
session_start();

try {
    require_once '../inc/config.php';
    require_once '../inc/functions.php';
} catch (Exception $e) {
    header('Location: ../dashboard.php?error=config');
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

// Get subject ID from URL
$subject_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user_id = $_SESSION['user_id'];

if (!$subject_id) {
    header('Location: ../dashboard.php');
    exit;
}

// Get subject details
try {
    // Check if subjects table has user_id column
    $stmt = $pdo->query("SHOW COLUMNS FROM subjects LIKE 'user_id'");
    $has_user_id = $stmt->fetch();
    
    if ($has_user_id) {
        $stmt = $pdo->prepare("SELECT * FROM subjects WHERE id = ? AND user_id = ?");
        $stmt->execute([$subject_id, $user_id]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM subjects WHERE id = ?");
        $stmt->execute([$subject_id]);
    }
    
    $subject = $stmt->fetch();
    
    if (!$subject) {
        header('Location: ../dashboard.php');
        exit;
    }
} catch (Exception $e) {
    header('Location: ../dashboard.php?error=database');
    exit;
}

// Get uploaded files for this subject (if table exists)
$files = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM uploaded_files WHERE subject_id = ? ORDER BY created_at DESC");
    $stmt->execute([$subject_id]);
    $files = $stmt->fetchAll();
} catch (Exception $e) {
    // Table doesn't exist yet
    $files = [];
}

// Get flashcards for this subject (if table exists)
$flashcards = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM flashcards WHERE subject_id = ? ORDER BY created_at DESC LIMIT 10");
    $stmt->execute([$subject_id]);
    $flashcards = $stmt->fetchAll();
} catch (Exception $e) {
    // Table doesn't exist yet
    $flashcards = [];
}

// Get subject-specific tasks
$tasks = [];
try {
    // Check if tasks table has subject_id column
    $stmt = $pdo->query("SHOW COLUMNS FROM tasks LIKE 'subject_id'");
    $has_subject_id = $stmt->fetch();
    
    if ($has_subject_id) {
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? AND (subject_id = ? OR subject_id IS NULL) ORDER BY created_at DESC LIMIT 10");
        $stmt->execute([$user_id, $subject_id]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC LIMIT 10");
        $stmt->execute([$user_id]);
    }
    $tasks = $stmt->fetchAll();
} catch (Exception $e) {
    // Use basic task query
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC LIMIT 10");
    $stmt->execute([$user_id]);
    $tasks = $stmt->fetchAll();
}

// Get user theme
$stmt = $pdo->prepare("SELECT theme FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user_theme = $stmt->fetchColumn() ?: 'light';
?>

<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $user_theme; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($subject['name']); ?> - Revision HQ</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .subject-header {
            background: var(--bg-secondary);
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        
        .subject-icon-large {
            background: var(--primary);
            width: 80px;
            height: 80px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
        }
        
        .subject-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        
        .section-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 4px var(--shadow);
        }
        
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text);
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .file-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 0.5rem;
            background: var(--bg);
        }
        
        .flashcard-item {
            padding: 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 0.5rem;
            background: var(--bg);
        }
        
        .task-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 0.5rem;
            background: var(--bg);
        }
        
        .btn-small {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary { background: var(--primary); color: white; }
        .btn-secondary { background: var(--bg-secondary); color: var(--text); border: 1px solid var(--border); }
        
        @media (max-width: 768px) {
            .subject-content {
                grid-template-columns: 1fr;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <a href="../dashboard.php" class="logo">
            <div class="logo-icon">RHQ</div>
            Revision HQ
        </a>
        
        <nav>
            <a href="../dashboard.php" class="btn-secondary">
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
    <div class="subject-header">
        <div class="subject-icon-large">
            <i class="<?php echo $subject['icon']; ?>"></i>
        </div>
        <div>
            <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: var(--text);">
                <?php echo htmlspecialchars($subject['name']); ?>
            </h1>
            <p style="color: var(--text-secondary); font-size: 1.1rem;">
                <?php echo htmlspecialchars($subject['description'] ?: 'Organize your study materials and track your progress'); ?>
            </p>
        </div>
    </div>

    <!-- Subject Content -->
    <div class="subject-content">
        
        <!-- Files Section -->
        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-folder" style="color: var(--primary);"></i>
                    Files & Resources
                </h2>
                <button class="btn-primary btn-small" onclick="uploadFile()">
                    <i class="fas fa-upload"></i> Upload
                </button>
            </div>
            
            <div id="filesList">
                <?php if (empty($files)): ?>
                    <p style="color: var(--text-secondary); text-align: center; padding: 2rem;">
                        No files uploaded yet. Click "Upload" to add your study materials.
                    </p>
                <?php else: ?>
                    <?php foreach ($files as $file): ?>
                        <div class="file-item">
                            <i class="fas fa-file" style="color: var(--primary);"></i>
                            <div style="flex: 1;">
                                <div style="font-weight: 500; color: var(--text);">
                                    <?php echo htmlspecialchars($file['original_filename']); ?>
                                </div>
                                <div style="font-size: 0.875rem; color: var(--text-secondary);">
                                    <?php echo formatFileSize($file['file_size']); ?> • 
                                    <?php echo date('M j, Y', strtotime($file['created_at'])); ?>
                                </div>
                            </div>
                            <a href="<?php echo $file['file_path']; ?>" target="_blank" class="btn-secondary btn-small">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Flashcards Section -->
        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-cards-blank" style="color: var(--primary);"></i>
                    Flashcards
                </h2>
                <button class="btn-primary btn-small" onclick="createFlashcard()">
                    <i class="fas fa-plus"></i> Create
                </button>
            </div>
            
            <div id="flashcardsList">
                <?php if (empty($flashcards)): ?>
                    <p style="color: var(--text-secondary); text-align: center; padding: 2rem;">
                        No flashcards yet. Create your first flashcard to start studying!
                    </p>
                <?php else: ?>
                    <?php foreach ($flashcards as $card): ?>
                        <div class="flashcard-item">
                            <div style="font-weight: 500; color: var(--text); margin-bottom: 0.5rem;">
                                <?php echo htmlspecialchars(substr($card['question'], 0, 100)) . (strlen($card['question']) > 100 ? '...' : ''); ?>
                            </div>
                            <div style="font-size: 0.875rem; color: var(--text-secondary);">
                                Difficulty: <?php echo ucfirst($card['difficulty']); ?> • 
                                Reviewed <?php echo $card['times_reviewed']; ?> times
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tasks Section -->
        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-tasks" style="color: var(--primary);"></i>
                    Tasks & Goals
                </h2>
                <button class="btn-primary btn-small" onclick="addTask()">
                    <i class="fas fa-plus"></i> Add Task
                </button>
            </div>
            
            <div id="tasksList">
                <?php if (empty($tasks)): ?>
                    <p style="color: var(--text-secondary); text-align: center; padding: 2rem;">
                        No tasks yet. Add some study goals to stay organized!
                    </p>
                <?php else: ?>
                    <?php foreach ($tasks as $task): ?>
                        <div class="task-item">
                            <input type="checkbox" <?php echo $task['completed'] ? 'checked' : ''; ?> 
                                   onchange="toggleTask(<?php echo $task['id']; ?>)">
                            <span style="flex: 1; color: var(--text); <?php echo $task['completed'] ? 'text-decoration: line-through; opacity: 0.6;' : ''; ?>">
                                <?php echo htmlspecialchars($task['title']); ?>
                            </span>
                            <span style="font-size: 0.875rem; color: var(--text-secondary);">
                                <?php echo date('M j', strtotime($task['created_at'])); ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Study Timer Section -->
        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-clock" style="color: var(--primary);"></i>
                    Study Timer
                </h2>
            </div>
            
            <div style="text-align: center;">
                <div style="font-size: 3rem; font-weight: 700; color: var(--primary); margin-bottom: 1rem;" id="timerDisplay">
                    25:00
                </div>
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <button class="btn-primary" onclick="startTimer()">
                        <i class="fas fa-play"></i> Start
                    </button>
                    <button class="btn-secondary" onclick="pauseTimer()">
                        <i class="fas fa-pause"></i> Pause
                    </button>
                    <button class="btn-secondary" onclick="resetTimer()">
                        <i class="fas fa-refresh"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="../script.js"></script>
    <script>
        // Basic functionality placeholders
        function uploadFile() {
            alert('File upload feature coming soon!');
        }
        
        function createFlashcard() {
            alert('Flashcard creation feature coming soon!');
        }
        
        function addTask() {
            const title = prompt('Enter task title:');
            if (title) {
                // Add task via AJAX
                fetch('../inc/add_task.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        title: title,
                        subject_id: <?php echo $subject_id; ?>
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error adding task');
                    }
                });
            }
        }
        
        function toggleTask(taskId) {
            fetch('../inc/toggle_task.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({task_id: taskId})
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Error updating task');
                    location.reload();
                }
            });
        }
        
        // Simple timer functionality
        let timerInterval;
        let timeLeft = 25 * 60; // 25 minutes in seconds
        
        function updateTimerDisplay() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            document.getElementById('timerDisplay').textContent = 
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        
        function startTimer() {
            if (timerInterval) return;
            timerInterval = setInterval(() => {
                timeLeft--;
                updateTimerDisplay();
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerInterval = null;
                    alert('Study session complete! Take a break.');
                    resetTimer();
                }
            }, 1000);
        }
        
        function pauseTimer() {
            clearInterval(timerInterval);
            timerInterval = null;
        }
        
        function resetTimer() {
            clearInterval(timerInterval);
            timerInterval = null;
            timeLeft = 25 * 60;
            updateTimerDisplay();
        }
        
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
            
            // Save theme preference
            fetch('../inc/save_preference.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({type: 'theme', value: newTheme})
            });
        }
    </script>
</body>
</html>

<?php
function formatFileSize($bytes) {
    $units = ['B', 'KB', 'MB', 'GB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, 1) . ' ' . $units[$pow];
}
?>