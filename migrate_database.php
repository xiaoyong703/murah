<?php
// Database migration script to update subjects table for user-specific subjects
session_start();
require_once 'inc/config.php';

// Only allow this script to run for authenticated users (you can add admin check here)
if (!isset($_SESSION['user_id'])) {
    die('Access denied. Please login first.');
}

echo "<h2>Database Migration Script - Updating Subjects Table</h2>";

try {
    // Check if subjects table has user_id column
    $stmt = $pdo->query("DESCRIBE subjects");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<h3>Current subjects table structure:</h3>";
    echo "<pre>" . implode("\n", $columns) . "</pre>";
    
    if (!in_array('user_id', $columns)) {
        echo "<h3>Adding user_id column to subjects table...</h3>";
        
        // Add user_id column
        $pdo->exec("ALTER TABLE subjects ADD COLUMN user_id INT NOT NULL DEFAULT 1");
        echo "✅ Added user_id column<br>";
        
        // Add foreign key constraint
        $pdo->exec("ALTER TABLE subjects ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE");
        echo "✅ Added foreign key constraint<br>";
        
        // Remove unique constraint on name (if exists) and add unique constraint for user_id + name
        $pdo->exec("ALTER TABLE subjects DROP INDEX name");
        echo "✅ Removed global unique constraint on name<br>";
        
        $pdo->exec("ALTER TABLE subjects ADD UNIQUE KEY unique_user_subject (user_id, name)");
        echo "✅ Added user-specific unique constraint<br>";
    }
    
    if (!in_array('updated_at', $columns)) {
        echo "<h3>Adding updated_at column...</h3>";
        $pdo->exec("ALTER TABLE subjects ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        echo "✅ Added updated_at column<br>";
    }
    
    // Update existing subjects to belong to the current user
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("UPDATE subjects SET user_id = ? WHERE user_id = 1");
    $stmt->execute([$user_id]);
    echo "✅ Updated existing subjects to belong to current user<br>";
    
    // Create additional tables if they don't exist
    echo "<h3>Creating additional tables...</h3>";
    
    // Uploaded files table
    $pdo->exec("CREATE TABLE IF NOT EXISTS uploaded_files (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT NOT NULL,
        subject_id INT,
        filename VARCHAR(255) NOT NULL,
        original_filename VARCHAR(255) NOT NULL,
        file_path TEXT NOT NULL,
        file_size INT NOT NULL,
        mime_type VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE
    )");
    echo "✅ Created uploaded_files table<br>";
    
    // Flashcards table
    $pdo->exec("CREATE TABLE IF NOT EXISTS flashcards (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT NOT NULL,
        subject_id INT,
        question TEXT NOT NULL,
        answer TEXT NOT NULL,
        difficulty ENUM('easy', 'medium', 'hard') DEFAULT 'medium',
        last_reviewed TIMESTAMP NULL,
        times_reviewed INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE
    )");
    echo "✅ Created flashcards table<br>";
    
    // Check if tasks table has subject_id column
    $stmt = $pdo->query("DESCRIBE tasks");
    $task_columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (!in_array('subject_id', $task_columns)) {
        $pdo->exec("ALTER TABLE tasks ADD COLUMN subject_id INT");
        $pdo->exec("ALTER TABLE tasks ADD FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE SET NULL");
        echo "✅ Added subject_id column to tasks table<br>";
    }
    
    echo "<h3>✅ Migration completed successfully!</h3>";
    echo "<p><a href='dashboard.php'>Go back to dashboard</a></p>";
    
} catch (Exception $e) {
    echo "<h3>❌ Migration failed:</h3>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<p>Please check your database configuration.</p>";
}
?>