<?php
include_once 'config/connection.php';
try {
    $stmt = $pdo->query("SELECT * FROM schedules WHERE id_course NOT IN (SELECT id_course FROM courses)");
    $orphans = $stmt->fetchAll();
    echo "Orphaned Schedules:\n";
    foreach($orphans as $o) {
        echo "ID: " . $o['id_schedule'] . " | CourseID: " . $o['id_course'] . " | Day: " . $o['day'] . "\n";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
