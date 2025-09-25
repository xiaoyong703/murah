<?php
session_start();

echo "<h2>Subject Debug Page</h2>";

// Check session
echo "<h3>Session Info:</h3>";
echo "User ID: " . ($_SESSION['user_id'] ?? 'NOT SET') . "<br>";
echo "Subject ID from URL: " . ($_GET['id'] ?? 'NOT SET') . "<br>";

// Check config
echo "<h3>Config Test:</h3>";
try {
    require_once '../inc/config.php';
    echo "✅ Config loaded successfully<br>";
    echo "PDO connection: " . ($pdo ? "✅ Connected" : "❌ Failed") . "<br>";
} catch (Exception $e) {
    echo "❌ Config error: " . $e->getMessage() . "<br>";
}

// Check functions
echo "<h3>Functions Test:</h3>";
try {
    require_once '../inc/functions.php';
    echo "✅ Functions loaded successfully<br>";
} catch (Exception $e) {
    echo "❌ Functions error: " . $e->getMessage() . "<br>";
}

// Check database
if (isset($pdo)) {
    echo "<h3>Database Test:</h3>";
    try {
        // Check subjects table
        $stmt = $pdo->query("DESCRIBE subjects");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo "Subjects table columns: " . implode(", ", $columns) . "<br>";
        
        // Check if we have any subjects
        $stmt = $pdo->query("SELECT COUNT(*) FROM subjects");
        $count = $stmt->fetchColumn();
        echo "Total subjects in database: " . $count . "<br>";
        
        // If we have a subject ID, try to get it
        if (isset($_GET['id'])) {
            $subject_id = (int)$_GET['id'];
            $user_id = $_SESSION['user_id'] ?? 1;
            
            echo "<br><h4>Looking for subject ID: $subject_id</h4>";
            
            // Check if user_id column exists
            $has_user_id = in_array('user_id', $columns);
            echo "Has user_id column: " . ($has_user_id ? "YES" : "NO") . "<br>";
            
            if ($has_user_id) {
                $stmt = $pdo->prepare("SELECT * FROM subjects WHERE id = ? AND user_id = ?");
                $stmt->execute([$subject_id, $user_id]);
            } else {
                $stmt = $pdo->prepare("SELECT * FROM subjects WHERE id = ?");
                $stmt->execute([$subject_id]);
            }
            
            $subject = $stmt->fetch();
            
            if ($subject) {
                echo "✅ Subject found: " . htmlspecialchars($subject['name']) . "<br>";
                echo "Subject data: <pre>" . print_r($subject, true) . "</pre>";
            } else {
                echo "❌ Subject not found<br>";
                
                // Show all subjects for debugging
                echo "<h4>All subjects:</h4>";
                $stmt = $pdo->query("SELECT * FROM subjects LIMIT 10");
                $all_subjects = $stmt->fetchAll();
                if ($all_subjects) {
                    echo "<table border='1'>";
                    echo "<tr><th>ID</th><th>Name</th><th>User ID</th></tr>";
                    foreach ($all_subjects as $s) {
                        echo "<tr>";
                        echo "<td>" . $s['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($s['name']) . "</td>";
                        echo "<td>" . ($s['user_id'] ?? 'NULL') . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No subjects found in database<br>";
                }
            }
        }
        
    } catch (Exception $e) {
        echo "❌ Database error: " . $e->getMessage() . "<br>";
    }
}

echo "<br><a href='../dashboard.php'>Back to Dashboard</a>";
?>