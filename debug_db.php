<?php
// Simple database connection test
echo "<h2>🔧 Database Connection Debug</h2>";

// Test configuration
$host = 'localhost';
$dbname = 'xynx4483_revision_hq';
$username = 'xynx4483_dbuser';
$password = 'H}{$_QM2$.=Mb?s=';

echo "<p><strong>Testing with these credentials:</strong></p>";
echo "<p>Host: $host</p>";
echo "<p>Database: $dbname</p>";
echo "<p>Username: $username</p>";
echo "<p>Password: " . str_repeat('*', strlen($password)) . "</p>";

echo "<hr>";

// Test connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    echo "<p style='color: green; font-size: 18px;'>✅ <strong>DATABASE CONNECTION: SUCCESS!</strong></p>";
    
    // Test if tables exist
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "<p><strong>Tables found:</strong> " . count($tables) . "</p>";
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li>$table</li>";
    }
    echo "</ul>";
    
} catch (PDOException $e) {
    echo "<p style='color: red; font-size: 18px;'>❌ <strong>DATABASE CONNECTION: FAILED</strong></p>";
    echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
    
    // Common solutions
    echo "<hr>";
    echo "<h3>🔧 Common Solutions:</h3>";
    echo "<ol>";
    echo "<li><strong>Check database name:</strong> Should be exactly 'xynx4483_revision_hq'</li>";
    echo "<li><strong>Check username:</strong> Should be exactly 'xynx4483_dbuser'</li>";
    echo "<li><strong>Check password:</strong> Must match what you set in cPanel</li>";
    echo "<li><strong>Verify user permissions:</strong> User must have ALL PRIVILEGES on database</li>";
    echo "<li><strong>Check if database exists:</strong> Go to cPanel → MySQL Databases</li>";
    echo "</ol>";
}
?>