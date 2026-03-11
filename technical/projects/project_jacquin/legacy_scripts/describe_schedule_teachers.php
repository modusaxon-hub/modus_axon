<?php
include_once 'config/connection.php';
try {
    $stmt = $pdo->query("DESCRIBE schedule_teachers");
    while ($row = $stmt->fetch()) {
        echo "  {$row['Field']} - {$row['Type']}\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
