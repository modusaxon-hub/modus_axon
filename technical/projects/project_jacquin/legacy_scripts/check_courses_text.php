<?php
include_once 'config/connection.php';
try {
    $stmt = $pdo->query("SELECT id_course, course_name FROM courses");
    $courses = $stmt->fetchAll();
    foreach($courses as $c) {
        echo $c['id_course'] . " | " . $c['course_name'] . "\n";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
