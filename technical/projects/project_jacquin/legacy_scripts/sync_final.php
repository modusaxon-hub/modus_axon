<?php
include_once 'config/connection.php';
try {
    // 1. Get desired course names from JSON
    $jsonPath = 'data/programs.json';
    $jsonContent = file_get_contents($jsonPath);
    $programs = json_decode($jsonContent, true);
    $activeTitles = array_map(function($p) { return $p['title']; }, $programs);
    
    // 2. Identify Courses to delete
    $killList = ['Curso Test A', 'Curso Test B', 'Curso Test'];
    $stmt = $pdo->query("SELECT id_course, course_name FROM courses");
    $dbCourses = $stmt->fetchAll();
    
    foreach($dbCourses as $c) {
        if (!in_array($c['course_name'], $activeTitles) || in_array($c['course_name'], $killList)) {
            $cid = $c['id_course'];
            echo "Deleting: " . $c['course_name'] . " (ID: $cid)\n";
            
            // A. Delete relations in enrollment_schedules
            $pdo->exec("DELETE FROM enrollment_schedules WHERE enrollment_id IN (SELECT id_enrollment FROM enrollments WHERE course_id = $cid)");
            
            // B. Delete from enrollments (Active/Pending)
            $pdo->exec("DELETE FROM enrollments WHERE course_id = $cid");
            
            // C. Delete from schedule_teachers (Depends on id_schedule)
            $pdo->exec("DELETE FROM schedule_teachers WHERE id_schedule IN (SELECT id_schedule FROM schedules WHERE id_course = $cid)");
            
            // D. Delete from schedules
            $pdo->exec("DELETE FROM schedules WHERE id_course = $cid");
            
            // E. Delete from courses
            $pdo->exec("DELETE FROM courses WHERE id_course = $cid");
        }
    }
    echo "Cleanup Successful.\n";
} catch (Exception $e) { echo "Error: " . $e->getMessage() . "\n"; }
?>
