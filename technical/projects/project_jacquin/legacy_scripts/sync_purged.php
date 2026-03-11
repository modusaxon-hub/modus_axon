<?php
include_once 'config/connection.php';
try {
    // 1. Get titles from JSON to keep
    $jsonPath = 'data/programs.json';
    $jsonContent = file_get_contents($jsonPath);
    $programs = json_decode($jsonContent, true);
    $titlesToKeep = array_map(function($p) { return $p['title']; }, $programs);
    
    // Test titles to definitely kill
    $killList = ['Curso Test A', 'Curso Test B', 'Curso Test'];

    $stmt = $pdo->query("SELECT id_course, course_name FROM courses");
    $dbCourses = $stmt->fetchAll();
    
    foreach($dbCourses as $c) {
        if (!in_array($c['course_name'], $titlesToKeep) || in_array($c['course_name'], $killList)) {
            $cid = $c['id_course'];
            echo "Purging relations for: " . $c['course_name'] . "\n";
            
            // Delete in order
            $pdo->exec("DELETE FROM enrollment_schedules WHERE enrollment_id IN (SELECT id_enrollment FROM enrollments WHERE id_course = $cid)");
            $pdo->exec("DELETE FROM enrollments WHERE id_course = $cid");
            $pdo->exec("DELETE FROM schedule_teachers WHERE id_schedule IN (SELECT id_schedule FROM schedules WHERE id_course = $cid)");
            $pdo->exec("DELETE FROM schedules WHERE id_course = $cid");
            $pdo->exec("DELETE FROM courses WHERE id_course = $cid");
        }
    }
    
    echo "Sync Complete.\n";
} catch (Exception $e) { echo "Error: " . $e->getMessage() . "\n"; }
?>
