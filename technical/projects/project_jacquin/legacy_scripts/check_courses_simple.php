<?php
include_once 'config/connection.php';
try {
    $stmt = $pdo->query("SELECT id_course, course_name FROM courses");
    $courses = $stmt->fetchAll();
    echo json_encode($courses);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
