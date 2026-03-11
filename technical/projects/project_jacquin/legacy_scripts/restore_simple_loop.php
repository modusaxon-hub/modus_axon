<?php
include_once 'config/connection.php';
try {
    // Let's use simpler queries to avoid complex joins in DELETE
    $stmt = $pdo->prepare("SELECT id_course FROM courses WHERE course_name IN ('Curso Test A', 'Curso Test B')");
    $stmt->execute();
    $test_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if(!empty($test_ids)) {
        foreach($test_ids as $courseId) {
            // Delete associated data
            $pdo->exec("DELETE FROM enrollment_schedules WHERE enrollment_id IN (SELECT id_enrollment FROM enrollments WHERE id_course = $courseId)");
            $pdo->exec("DELETE FROM enrollments WHERE id_course = $courseId");
            $pdo->exec("DELETE FROM schedule_teachers WHERE id_schedule IN (SELECT id_schedule FROM schedules WHERE id_course = $courseId)");
            $pdo->exec("DELETE FROM schedules WHERE id_course = $courseId");
            $pdo->exec("DELETE FROM courses WHERE id_course = $courseId");
        }
        echo "Deleted test courses.\n";
    }

    $programs = ['Guitarra', 'Piano'];
    foreach($programs as $name) {
        $stmt = $pdo->prepare("SELECT id_course FROM courses WHERE course_name = ?");
        $stmt->execute([$name]);
        if(!$stmt->fetch()) {
            $pdo->prepare("INSERT INTO courses (course_name, price) VALUES (?, 0)")->execute([$name]);
            echo "Created course: $name\n";
        }
    }
} catch (Exception $e) { echo $e->getMessage(); }
?>
