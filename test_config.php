<?php
// Test database connection
require_once 'inc/config.php';

echo "<h2>🧪 Revision HQ Configuration Test</h2>";

// Test database connection
try {
    $test_query = $pdo->query("SELECT 1");
    echo "<p>✅ Database connection: <strong>SUCCESS</strong></p>";
} catch (Exception $e) {
    echo "<p>❌ Database connection: <strong>FAILED</strong> - " . $e->getMessage() . "</p>";
}

// Test directories
$dirs = ['uploads', 'media/wallpapers', 'inc', 'subjects', 'assets'];
foreach ($dirs as $dir) {
    if (is_dir($dir)) {
        echo "<p>✅ Directory $dir: <strong>EXISTS</strong></p>";
    } else {
        echo "<p>❌ Directory $dir: <strong>MISSING</strong></p>";
    }
}

// Test key files
$files = ['inc/config.php', 'inc/functions.php', 'inc/auth.php', 'database_complete.sql'];
foreach ($files as $file) {
    if (file_exists($file)) {
        echo "<p>✅ File $file: <strong>EXISTS</strong></p>";
    } else {
        echo "<p>❌ File $file: <strong>MISSING</strong></p>";
    }
}

echo "<p>📖 See SETUP_GUIDE.md for complete installation instructions</p>";
?>
