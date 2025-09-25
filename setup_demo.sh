#!/bin/bash

echo "🚀 Setting up Revision HQ Demo Environment..."

# Create necessary directories
mkdir -p uploads/demo_user/computing
mkdir -p uploads/demo_user/math  
mkdir -p uploads/demo_user/english
mkdir -p media/wallpapers/demo_user

# Set permissions
chmod 755 uploads
chmod 755 media/wallpapers
chmod 644 uploads/.htaccess
chmod 644 media/wallpapers/.htaccess

echo "📁 Directories created and secured"

# Check if MySQL is available
if command -v mysql &> /dev/null; then
    echo "✅ MySQL detected"
    echo "📋 To complete setup:"
    echo "   1. Create database: CREATE DATABASE revision_hq;"
    echo "   2. Import schema: mysql -u root -p revision_hq < database_complete.sql"
    echo "   3. Update inc/config.php with your database credentials"
    echo "   4. Set up Google OAuth Client ID in config.php"
else
    echo "⚠️  MySQL not detected - you'll need to set up the database manually"
fi

echo ""
echo "🌟 Revision HQ Setup Complete!"
echo ""
echo "📚 Your improved features:"
echo "   ✅ Secure user authentication with Google"  
echo "   ✅ Complete database integration"
echo "   ✅ File upload system with security"
echo "   ✅ Flashcard management"
echo "   ✅ Personal wallpapers"
echo "   ✅ Task and notes sync"
echo "   ✅ Theme switching"
echo "   ✅ User data isolation"
echo ""
echo "📖 Read SETUP_GUIDE.md for detailed instructions"
echo "🚀 Ready to deploy to cPanel hosting!"

# Create a simple test file
cat > test_config.php << 'EOF'
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
EOF

echo ""
echo "🧪 Test your setup by visiting: test_config.php"
echo ""