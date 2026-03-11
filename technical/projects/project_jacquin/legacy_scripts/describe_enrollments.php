<?php
include_once 'config/connection.php';
try {
    $stmt = $pdo->query("DESCRIBE enrollments");
    $cols = $stmt->fetchAll();
    foreach($cols as $c) echo $c['Field'] . " | " . $c['Type'] . "\n";
} catch (Exception $e) { echo $e->getMessage(); }
?>
