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
            background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-tertiary) 100%);
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 3rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }
        
        .subject-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color), var(--primary-color));
            border-radius: 20px 20px 0 0;
        }
        
        .subject-header-content {
            display: flex;
            align-items: center;
            gap: 2.5rem;
        }
        
        .subject-icon-large {
            font-size: 5rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.15), rgba(59, 130, 246, 0.08));
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid rgba(37, 99, 235, 0.2);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.15);
        }
        
        .subject-info {
            flex: 1;
        }
        
        .subject-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: var(--text-primary);
            background: linear-gradient(135deg, var(--text-primary), var(--primary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .subject-description {
            color: var(--text-secondary);
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .subject-stats {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
        }
        
        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.95rem;
        }
        
        .subject-actions {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
        }
        
        .subject-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 2.5rem;
            margin-bottom: 3rem;
        }
        
        .section-card {
            background: var(--bg-secondary);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-color);
            position: relative;
            transition: all 0.3s ease;
        }
        
        .section-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--border-color);
            position: relative;
        }
        
        .section-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        .section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-primary);
            font-size: 1.4rem;
            font-weight: 700;
        }
        
        .section-title i {
            font-size: 1.5rem;
            padding: 8px;
            background: rgba(37, 99, 235, 0.1);
            border-radius: 8px;
        }
        
        .file-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 1rem;
            background: var(--bg-primary);
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        
        .file-item:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            border-color: var(--primary-color);
        }
        
        .file-icon {
            font-size: 2rem;
            color: var(--primary-color);
            background: rgba(37, 99, 235, 0.1);
            padding: 12px;
            border-radius: 10px;
            min-width: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .file-info {
            flex: 1;
        }
        
        .file-name {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
            font-size: 1.1rem;
        }
        
        .file-meta {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }
        
        .flashcard-item {
            padding: 2rem;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 1rem;
            background: var(--bg-primary);
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            position: relative;
        }
        
        .flashcard-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
        }
        
        .flashcard-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 12px 12px 0 0;
        }
        
        .flashcard-question {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
            font-size: 1.1rem;
            line-height: 1.5;
        }
        
        .flashcard-answer {
            color: var(--text-secondary);
            font-size: 1rem;
            line-height: 1.6;
            padding: 1rem;
            background: var(--bg-secondary);
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }
        
        .task-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 1rem;
            background: var(--bg-primary);
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        
        .task-item:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }
        
        .task-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid var(--border-color);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .task-checkbox:checked {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .task-content {
            flex: 1;
        }
        
        .task-title {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
            font-size: 1.1rem;
        }
        
        .task-date {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-secondary);
        }
        
        .empty-state i {
            font-size: 4rem;
            color: var(--border-color);
            margin-bottom: 1rem;
            display: block;
        }
        
        .empty-state h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }
        
        .empty-state p {
            font-size: 1rem;
            line-height: 1.6;
        }
        
        .btn-small {
            padding: 0.75rem 1.25rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .btn-primary { 
            background: var(--primary); 
            color: white;
        }
        .btn-primary:hover {
            background: #3b82f6;
            transform: translateY(-1px);
        }
        
        .btn-secondary { 
            background: var(--bg-secondary); 
            color: var(--text); 
            border: 1px solid var(--border);
        }
        .btn-secondary:hover {
            background: var(--bg);
            border-color: var(--primary);
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
            border: none;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        
        @media (max-width: 768px) {
            .subject-header {
                padding: 2rem 1.5rem;
                margin-bottom: 2rem;
            }
            
            .subject-header-content {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }
            
            .subject-title {
                font-size: 2.5rem;
            }
            
            .subject-icon-large {
                width: 100px;
                height: 100px;
                font-size: 4rem;
            }
            
            .subject-stats {
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .subject-actions {
                flex-direction: column;
                width: 100%;
                max-width: 300px;
            }
            
            .subject-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .section-card {
                padding: 1.5rem;
            }
            
            .file-item,
            .flashcard-item,
            .task-item {
                padding: 1.25rem;
            }
            
            .file-icon {
                font-size: 1.5rem;
                width: 40px;
                height: 40px;
                min-width: 40px;
            }
        }
        
        @media (max-width: 480px) {
            .subject-header {
                padding: 1.5rem 1rem;
            }
            
            .subject-title {
                font-size: 2rem;
            }
            
            .section-card {
                padding: 1rem;
                margin-bottom: 1.5rem;
            }
            
            .section-title {
                font-size: 1.2rem;
            }
            
            .file-item,
            .flashcard-item,
            .task-item {
                padding: 1rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .file-info,
            .task-content {
                width: 100%;
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
        <div class="subject-header-content">
            <div class="subject-icon-large">
                <i class="<?php echo $subject['icon']; ?>"></i>
            </div>
            <div class="subject-info">
                <h1 class="subject-title">
                    <?php echo htmlspecialchars($subject['name']); ?>
                </h1>
                <p class="subject-description">
                    <?php echo htmlspecialchars($subject['description'] ?: 'Organize your study materials and track your progress'); ?>
                </p>
                <div class="subject-stats">
                    <div class="stat-item">
                        <i class="fas fa-file"></i>
                        <span><?php echo count($files); ?> Files</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-layer-group"></i>
                        <span><?php echo count($flashcards); ?> Flashcards</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-tasks"></i>
                        <span><?php echo count($tasks); ?> Tasks</span>
                    </div>
                </div>
            </div>
            <div class="subject-actions">
                <button onclick="editSubject()" class="btn-secondary btn-small">
                    <i class="fas fa-edit"></i> Edit Subject
                </button>
                <button onclick="deleteSubject()" class="btn-danger btn-small">
                    <i class="fas fa-trash"></i> Delete Subject
                </button>
            </div>
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
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <h3>No Files Yet</h3>
                        <p>Upload your study materials, notes, and resources to get started.<br>
                        Supported formats: PDF, DOC, TXT, PPT, and more.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($files as $file): ?>
                        <div class="file-item">
                            <div class="file-icon">
                                <i class="fas fa-file-<?php 
                                    $ext = strtolower(pathinfo($file['original_filename'], PATHINFO_EXTENSION));
                                    echo ($ext === 'pdf') ? 'pdf' : (in_array($ext, ['doc', 'docx']) ? 'word' : (in_array($ext, ['ppt', 'pptx']) ? 'powerpoint' : 'alt'));
                                ?>"></i>
                            </div>
                            <div class="file-info">
                                <div class="file-name">
                                    <?php echo htmlspecialchars($file['original_filename']); ?>
                                </div>
                                <div class="file-meta">
                                    <?php echo formatFileSize($file['file_size']); ?> • 
                                    Uploaded <?php echo date('M j, Y', strtotime($file['created_at'])); ?>
                                </div>
                            </div>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="<?php echo $file['file_path']; ?>" target="_blank" class="btn-secondary btn-small">
                                    <i class="fas fa-external-link-alt"></i> Open
                                </a>
                                <button onclick="deleteFile(<?php echo $file['id']; ?>)" 
                                        class="btn-danger btn-small"
                                        style="padding: 0.5rem 0.75rem;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
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
                    <div class="empty-state">
                        <i class="fas fa-layer-group"></i>
                        <h3>No Flashcards Yet</h3>
                        <p>Create flashcards to help memorize key concepts and facts.<br>
                        Perfect for vocabulary, formulas, and quick reviews.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($flashcards as $card): ?>
                        <div class="flashcard-item">
                            <div class="flashcard-question">
                                <?php echo htmlspecialchars($card['question']); ?>
                            </div>
                            <div class="flashcard-answer">
                                <?php echo htmlspecialchars($card['answer']); ?>
                            </div>
                            <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; color: var(--text-secondary); font-size: 0.9rem;">
                                <div>
                                    <i class="fas fa-chart-line"></i>
                                    Difficulty: <span style="color: var(--primary-color); font-weight: 600;"><?php echo ucfirst($card['difficulty']); ?></span>
                                    • Reviewed <?php echo $card['times_reviewed']; ?> times
                                </div>
                                <button onclick="deleteFlashcard(<?php echo $card['id']; ?>)" 
                                        class="btn-danger btn-small"
                                        style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                                    <i class="fas fa-trash"></i>
                                </button>
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
                    <div class="empty-state">
                        <i class="fas fa-tasks"></i>
                        <h3>No Tasks Yet</h3>
                        <p>Set study goals and track your progress.<br>
                        Break down complex topics into manageable tasks.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($tasks as $task): ?>
                        <div class="task-item">
                            <input type="checkbox" class="task-checkbox" 
                                   <?php echo $task['completed'] ? 'checked' : ''; ?> 
                                   onchange="toggleTask(<?php echo $task['id']; ?>)">
                            <div class="task-content">
                                <div class="task-title" style="<?php echo $task['completed'] ? 'text-decoration: line-through; opacity: 0.6;' : ''; ?>">
                                    <?php echo htmlspecialchars($task['title']); ?>
                                </div>
                                <div class="task-date">
                                    Created <?php echo date('M j, Y', strtotime($task['created_at'])); ?>
                                    <?php if ($task['completed']): ?>
                                        • <i class="fas fa-check" style="color: var(--success);"></i> Completed
                                    <?php endif; ?>
                                </div>
                            </div>
                            <button onclick="deleteTask(<?php echo $task['id']; ?>)" 
                                    class="btn-danger btn-small"
                                    style="padding: 0.5rem 0.75rem;">
                                <i class="fas fa-trash"></i>
                            </button>
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
                <div style="background: var(--bg-primary); border-radius: 50%; width: 200px; height: 200px; margin: 0 auto 2rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); border: 4px solid var(--primary-color);">
                    <div style="font-size: 3rem; font-weight: 700; color: var(--primary-color);" id="timerDisplay">
                        25:00
                    </div>
                </div>
                <div style="display: flex; gap: 1rem; justify-content: center; margin-bottom: 1.5rem;">
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
                <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 0;">
                    <i class="fas fa-info-circle"></i>
                    Focus for 25 minutes, then take a 5-minute break
                </p>
            </div>
        </div>
    </div>

    <script src="../script.js"></script>
    <script>
        // File upload functionality
        function uploadFile() {
            const modal = document.createElement('div');
            modal.innerHTML = `
                <div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); z-index: 1000; display: flex; align-items: center; justify-content: center;" onclick="closeUploadModal(event)">
                    <div style="background: var(--bg-secondary); border-radius: 16px; padding: 2rem; width: 90%; max-width: 500px;" onclick="event.stopPropagation()">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                            <h2 style="color: var(--text); margin: 0;">📁 Upload File</h2>
                            <button onclick="closeUploadModal()" style="background: none; border: none; font-size: 1.5rem; color: var(--text); cursor: pointer;">&times;</button>
                        </div>
                        
                        <form onsubmit="handleFileUpload(event)">
                            <div style="margin-bottom: 1.5rem;">
                                <input type="file" id="fileInput" required multiple
                                       style="width: 100%; padding: 0.75rem; border: 2px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text);">
                            </div>
                            
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; margin-bottom: 0.5rem; color: var(--text); font-weight: 500;">Description (optional)</label>
                                <input type="text" id="fileDescription" maxlength="255"
                                       style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text);"
                                       placeholder="Brief description of the file(s)">
                            </div>
                            
                            <div style="display: flex; gap: 1rem;">
                                <button type="button" onclick="closeUploadModal()" 
                                        style="flex: 1; background: var(--bg); color: var(--text); border: 1px solid var(--border); border-radius: 8px; padding: 0.75rem; cursor: pointer;">
                                    Cancel
                                </button>
                                <button type="submit" 
                                        style="flex: 1; background: var(--primary); color: white; border: none; border-radius: 8px; padding: 0.75rem; cursor: pointer;">
                                    Upload Files
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            `;
            modal.id = 'uploadModal';
            document.body.appendChild(modal);
        }

        function closeUploadModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('uploadModal');
            if (modal) modal.remove();
        }

        function handleFileUpload(event) {
            event.preventDefault();
            
            const fileInput = document.getElementById('fileInput');
            const description = document.getElementById('fileDescription').value;
            
            if (!fileInput.files.length) {
                alert('Please select at least one file');
                return;
            }
            
            const formData = new FormData();
            for (let file of fileInput.files) {
                formData.append('files[]', file);
            }
            formData.append('subject_id', <?php echo $subject_id; ?>);
            formData.append('description', description);
            
            fetch('../inc/upload_file.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeUploadModal();
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Upload failed. Please try again.');
            });
        }
        
        // Flashcard creation functionality
        function createFlashcard() {
            const modal = document.createElement('div');
            modal.innerHTML = `
                <div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); z-index: 1000; display: flex; align-items: center; justify-content: center;" onclick="closeFlashcardModal(event)">
                    <div style="background: var(--bg-secondary); border-radius: 16px; padding: 2rem; width: 90%; max-width: 600px;" onclick="event.stopPropagation()">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                            <h2 style="color: var(--text); margin: 0;">🃏 Create Flashcard</h2>
                            <button onclick="closeFlashcardModal()" style="background: none; border: none; font-size: 1.5rem; color: var(--text); cursor: pointer;">&times;</button>
                        </div>
                        
                        <form onsubmit="handleFlashcardCreate(event)">
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; margin-bottom: 0.5rem; color: var(--text); font-weight: 500;">Question</label>
                                <textarea id="flashcardQuestion" required rows="3" maxlength="500"
                                          style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text); resize: vertical;"
                                          placeholder="Enter your question here..."></textarea>
                            </div>
                            
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; margin-bottom: 0.5rem; color: var(--text); font-weight: 500;">Answer</label>
                                <textarea id="flashcardAnswer" required rows="3" maxlength="1000"
                                          style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text); resize: vertical;"
                                          placeholder="Enter the answer here..."></textarea>
                            </div>
                            
                            <div style="margin-bottom: 2rem;">
                                <label style="display: block; margin-bottom: 0.5rem; color: var(--text); font-weight: 500;">Difficulty</label>
                                <select id="flashcardDifficulty" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text);">
                                    <option value="easy">Easy</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                            </div>
                            
                            <div style="display: flex; gap: 1rem;">
                                <button type="button" onclick="closeFlashcardModal()" 
                                        style="flex: 1; background: var(--bg); color: var(--text); border: 1px solid var(--border); border-radius: 8px; padding: 0.75rem; cursor: pointer;">
                                    Cancel
                                </button>
                                <button type="submit" 
                                        style="flex: 1; background: var(--primary); color: white; border: none; border-radius: 8px; padding: 0.75rem; cursor: pointer;">
                                    Create Flashcard
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            `;
            modal.id = 'flashcardModal';
            document.body.appendChild(modal);
        }

        function closeFlashcardModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('flashcardModal');
            if (modal) modal.remove();
        }

        function handleFlashcardCreate(event) {
            event.preventDefault();
            
            const question = document.getElementById('flashcardQuestion').value.trim();
            const answer = document.getElementById('flashcardAnswer').value.trim();
            const difficulty = document.getElementById('flashcardDifficulty').value;
            
            if (!question || !answer) {
                alert('Please fill in both question and answer');
                return;
            }
            
            fetch('../inc/create_flashcard.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    subject_id: <?php echo $subject_id; ?>,
                    question: question,
                    answer: answer,
                    difficulty: difficulty
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeFlashcardModal();
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to create flashcard. Please try again.');
            });
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
        
        function editSubject() {
            const modal = document.createElement('div');
            modal.innerHTML = `
                <div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); z-index: 1000; display: flex; align-items: center; justify-content: center;" onclick="closeEditModal(event)">
                    <div style="background: var(--bg-secondary); border-radius: 16px; padding: 2rem; width: 90%; max-width: 500px;" onclick="event.stopPropagation()">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                            <h2 style="color: var(--text); margin: 0;">✏️ Edit Subject</h2>
                            <button onclick="closeEditModal()" style="background: none; border: none; font-size: 1.5rem; color: var(--text); cursor: pointer;">&times;</button>
                        </div>
                        
                        <form onsubmit="handleSubjectEdit(event)">
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; margin-bottom: 0.5rem; color: var(--text); font-weight: 500;">Subject Name</label>
                                <input type="text" id="editSubjectName" required maxlength="100" 
                                       value="${'<?php echo htmlspecialchars($subject['name'], ENT_QUOTES); ?>'}"
                                       style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text);"
                                       placeholder="Enter subject name">
                            </div>
                            
                            <div style="margin-bottom: 2rem;">
                                <label style="display: block; margin-bottom: 0.5rem; color: var(--text); font-weight: 500;">Description</label>
                                <textarea id="editSubjectDescription" maxlength="255" rows="3"
                                          style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 8px; background: var(--bg); color: var(--text); resize: vertical;"
                                          placeholder="Brief description of this subject...">${'<?php echo htmlspecialchars($subject['description'] ?? '', ENT_QUOTES); ?>'}</textarea>
                            </div>
                            
                            <div style="display: flex; gap: 1rem;">
                                <button type="button" onclick="closeEditModal()" 
                                        style="flex: 1; background: var(--bg); color: var(--text); border: 1px solid var(--border); border-radius: 8px; padding: 0.75rem; cursor: pointer;">
                                    Cancel
                                </button>
                                <button type="submit" 
                                        style="flex: 1; background: var(--primary); color: white; border: none; border-radius: 8px; padding: 0.75rem; cursor: pointer;">
                                    Update Subject
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            `;
            modal.id = 'editSubjectModal';
            document.body.appendChild(modal);
        }

        function closeEditModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('editSubjectModal');
            if (modal) modal.remove();
        }

        function handleSubjectEdit(event) {
            event.preventDefault();
            
            const name = document.getElementById('editSubjectName').value.trim();
            const description = document.getElementById('editSubjectDescription').value.trim();
            
            if (!name) {
                alert('Please enter a subject name');
                return;
            }
            
            fetch('../inc/update_subject.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    subject_id: <?php echo $subject_id; ?>,
                    name: name,
                    description: description,
                    icon: '<?php echo $subject['icon']; ?>'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeEditModal();
                    location.reload();
                } else {
                    alert('Error: ' + data.message + (data.debug ? '\n\nDebug: ' + data.debug : ''));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Network error occurred');
            });
        }

        function deleteSubject() {
            const subjectName = '<?php echo htmlspecialchars($subject['name'], ENT_QUOTES); ?>';
            if (!confirm(`Are you sure you want to delete "${subjectName}"?\n\nThis will permanently delete:\n• All files uploaded to this subject\n• All flashcards created for this subject\n• All tasks associated with this subject\n\nThis action cannot be undone.`)) {
                return;
            }
            
            fetch('../inc/delete_subject.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({subject_id: <?php echo $subject_id; ?>})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Subject deleted successfully');
                    window.location.href = '../dashboard.php';
                } else {
                    alert('Error: ' + data.message + (data.debug ? '\n\nDebug: ' + data.debug : ''));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Network error occurred');
            });
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
        
        function deleteFile(fileId) {
            if (!confirm('Are you sure you want to delete this file?')) return;
            
            fetch('../inc/delete_file.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({file_id: fileId})
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
        
        function deleteFlashcard(cardId) {
            if (!confirm('Are you sure you want to delete this flashcard?')) return;
            
            fetch('../inc/delete_flashcard.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({flashcard_id: cardId})
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
        
        function deleteTask(taskId) {
            if (!confirm('Are you sure you want to delete this task?')) return;
            
            fetch('../inc/delete_task.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({task_id: taskId})
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