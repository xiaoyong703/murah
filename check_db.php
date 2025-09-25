<?php
session_start();
require_once 'inc/config.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please login first";
    exit;
}

echo "<h2>Database Schema Check</h2>";

try {
    // Check subjects table structure
    echo "<h3>Current subjects table structure:</h3>";
    $stmt = $pdo->query("DESCRIBE subjects");
    $columns = $stmt->fetchAll();
    echo "<table border='1'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    foreach ($columns as $column) {
        echo "<tr>";
        foreach ($column as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    
    // Check if user_id column exists
    $stmt = $pdo->query("SHOW COLUMNS FROM subjects LIKE 'user_id'");
    $has_user_id = $stmt->fetch();
    
    echo "<h3>Has user_id column: " . ($has_user_id ? "YES" : "NO") . "</h3>";
    
    // Show existing subjects
    echo "<h3>Existing subjects:</h3>";
    $stmt = $pdo->query("SELECT * FROM subjects LIMIT 10");
    $subjects = $stmt->fetchAll();
    
    if ($subjects) {
        echo "<table border='1'>";
        echo "<tr>";
        foreach (array_keys($subjects[0]) as $key) {
            if (!is_numeric($key)) {
                echo "<th>" . htmlspecialchars($key) . "</th>";
            }
        }
        echo "</tr>";
        
        foreach ($subjects as $subject) {
            echo "<tr>";
            foreach ($subject as $key => $value) {
                if (!is_numeric($key)) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No subjects found</p>";
    }
    
    echo "<br><a href='dashboard.php'>Back to Dashboard</a>";
    
} catch (Exception $e) {
    echo "<h3>Error: " . $e->getMessage() . "</h3>";
}
?>