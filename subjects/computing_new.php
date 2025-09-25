<?php
session_start();
require_once '../inc/config.php';
require_once '../inc/functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$subject_name = 'Computing';
$subject_id = 1; // You'll want to get this dynamically

try {
    $user = getUserById($user_id);
    $flashcards = getFlashcardsBySubject($user_id, $subject_id);
    $files = getFilesBySubject($user_id, $subject_id);
} catch (Exception $e) {
    error_log("Subject page error: " . $e->getMessage());
    $flashcards = [];
    $files = [];
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $user['theme'] ?? 'light'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computing - Revision HQ</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="<?php echo !empty($user['wallpaper']) ? 'has-wallpaper' : ''; ?>" style="<?php echo !empty($user['wallpaper']) ? 'background-image: url(' . $user['wallpaper'] . ');' : ''; ?>">
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
        
        <!-- Quick Reference -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem; box-shadow: 0 2px 4px var(--shadow);">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--text-primary);">
                <i class="fas fa-lightbulb" style="color: var(--primary-color);"></i>
                Key Concepts & Formulas
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                <div style="background: var(--bg-primary); padding: 1rem; border-radius: 8px; border: 1px solid var(--border-color);">
                    <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Big O Notation</h4>
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">O(1) < O(log n) < O(n) < O(n log n) < O(n²)</p>
                </div>
                <div style="background: var(--bg-primary); padding: 1rem; border-radius: 8px; border: 1px solid var(--border-color);">
                    <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Data Structures</h4>
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">Arrays, Linked Lists, Stacks, Queues, Trees, Graphs</p>
                </div>
            </div>
        </div>

        <!-- File Upload & Management -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem; box-shadow: 0 2px 4px var(--shadow);">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--text-primary);">
                <i class="fas fa-folder" style="color: var(--primary-color);"></i>
                Notes & Files
            </h2>
            
            <div style="margin-bottom: 2rem;">
                <input type="file" id="fileInput" style="display: none;" accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png,.gif">
                <button onclick="document.getElementById('fileInput').click()" style="background: var(--primary-color); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-upload"></i> Upload File
                </button>
            </div>
            
            <div id="filesList" style="display: grid; gap: 1rem;">
                <?php foreach ($files as $file): ?>
                <div style="background: var(--bg-primary); padding: 1rem; border-radius: 8px; border: 1px solid var(--border-color); display: flex; align-items: center; gap: 1rem;">
                    <i class="fas fa-file" style="color: var(--primary-color);"></i>
                    <div style="flex: 1;">
                        <h4 style="color: var(--text-primary); margin-bottom: 0.25rem;"><?php echo htmlspecialchars($file['original_name']); ?></h4>
                        <p style="color: var(--text-secondary); font-size: 0.9rem;"><?php echo date('M j, Y', strtotime($file['created_at'])); ?> • <?php echo round($file['file_size'] / 1024, 1); ?>KB</p>
                    </div>
                    <button onclick="downloadFile(<?php echo $file['id']; ?>)" style="background: var(--bg-tertiary); border: 1px solid var(--border-color); color: var(--text-primary); padding: 0.5rem; border-radius: 6px; cursor: pointer;">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Flashcards -->
        <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 2rem; box-shadow: 0 2px 4px var(--shadow);">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--text-primary);">
                <i class="fas fa-cards-blank" style="color: var(--primary-color);"></i>
                Flashcards
            </h2>
            
            <div style="margin-bottom: 2rem;">
                <button onclick="createFlashcardModal()" style="background: var(--primary-color); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-plus"></i> Create Flashcard
                </button>
            </div>
            
            <div id="flashcardsList" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                <?php foreach ($flashcards as $card): ?>
                <div style="background: var(--bg-primary); padding: 1.5rem; border-radius: 8px; border: 1px solid var(--border-color); cursor: pointer;" onclick="reviewFlashcard(<?php echo $card['id']; ?>)">
                    <h4 style="color: var(--text-primary); margin-bottom: 1rem;"><?php echo htmlspecialchars($card['deck_name']); ?></h4>
                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 0.5rem;"><?php echo htmlspecialchars(substr($card['question'], 0, 100)) . '...'; ?></p>
                    <div style="display: flex; justify-content: between; align-items: center; font-size: 0.8rem; color: var(--text-secondary);">
                        <span><?php echo $card['difficulty']; ?></span>
                        <span><?php echo $card['review_count']; ?> reviews</span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <script src="../assets/dashboard.js"></script>
    <script>
        // File upload handling
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('file', file);
                formData.append('subject_id', <?php echo $subject_id; ?>);
                formData.append('category', 'computing');
                
                fetch('../inc/upload_file.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Upload failed: ' + data.message);
                    }
                });
            }
        });
        
        function createFlashcardModal() {
            const question = prompt('Enter question:');
            if (question) {
                const answer = prompt('Enter answer:');
                if (answer) {
                    const deck_name = prompt('Deck name:', 'Computing Basics');
                    if (deck_name) {
                        fetch('../inc/flashcards.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `action=create&subject_id=<?php echo $subject_id; ?>&deck_name=${encodeURIComponent(deck_name)}&question=${encodeURIComponent(question)}&answer=${encodeURIComponent(answer)}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Failed to create flashcard');
                            }
                        });
                    }
                }
            }
        }
        
        function reviewFlashcard(id) {
            // Simple flashcard review implementation
            alert('Flashcard review feature - implement your preferred UI here');
        }
    </script>
</body>
</html>