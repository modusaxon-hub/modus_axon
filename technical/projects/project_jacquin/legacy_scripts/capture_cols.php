<?php
include_once 'config/connection.php';
try {
    $stmt = $pdo->query("DESCRIBE enrollments");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        file_put_contents('enrollments_cols.txt', $row['Field'] . "\n", FILE_APPEND);
    }
} catch (Exception $e) { echo $e->getMessage(); }
?>
