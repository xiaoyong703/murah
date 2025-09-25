<?php
// Database configuration
$host = 'localhost';
$dbname = 'xynx4483_revision_hq';  // Fixed: was missing 'yn'
$username = 'xynx4483_dbuser';
$password = 'H}{$_QM2$.=Mb?s=';

// Google OAuth configuration
define('GOOGLE_CLIENT_ID', '707730920463-tf7svsd22kt8jh5jjsq9llp4ti1lchd9.apps.googleusercontent.com'); // Your Google OAuth Client ID

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
    ]);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection failed. Please check your configuration.");
}

// Security settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));

// File upload settings
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10MB
define('ALLOWED_FILE_TYPES', ['pdf', 'doc', 'docx', 'txt', 'jpg', 'jpeg', 'png', 'gif', 'mp4', 'mp3']);
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('WALLPAPER_DIR', __DIR__ . '/../media/wallpapers/');

// Ensure upload directories exist
if (!file_exists(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}
if (!file_exists(WALLPAPER_DIR)) {
    mkdir(WALLPAPER_DIR, 0755, true);
}
?>