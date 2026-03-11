<?php
include_once 'config/connection.php';
try {
    // Determine the actual column names in enrollment_schedules and schedule_teachers
    // to build a correct deletion query.
    
    // 1. Get database records
    $jsonPath = 'data/programs.json';
    $jsonContent = file_get_contents($jsonPath);
    $programs = json_decode($jsonContent, true);
    $titlesToKeep = array_map(function($p) { return $p['title']; }, $programs);
    
    $stmt = $pdo->query("SELECT id_course, course_name FROM courses");
    $dbCourses = $stmt->fetchAll();
    
    foreach($dbCourses as $c) {
        if (!in_array($c['course_name'], $titlesToKeep) || strpos($c['course_name'], 'Test') !== false) {
            $cid = $c['id_course'];
            echo "Step-by-step cleanup for $cid (" . $c['course_name'] . ")\n";
            
            // Delete enrollments and their schedules
            $enStmt = $pdo->prepare("SELECT id_enrollment FROM enrollments WHERE id_course = ?");
            $enStmt->execute([$cid]);
            while ($row = $enStmt->fetch()) {
                $enId = $row['id_enrollment'];
                // Clean schedules for THIS specific enrollment
                $pdo->exec("DELETE FROM enrollment_schedules WHERE enrollment_id = $enId");
            }
            $pdo->exec("DELETE FROM enrollments WHERE id_course = $cid");
            
            // Delete schedules and their teachers
            $scStmt = $pdo->prepare("SELECT id_schedule FROM schedules WHERE id_course = ?");
            $scStmt->execute([$cid]);
            while ($rowS = $scStmt->fetch()) {
                $scId = $rowS['id_schedule'];
                // Clean teachers for THIS specific schedule
                $pdo->exec("DELETE FROM schedule_teachers WHERE id_schedule = $scId");
            }
            $pdo->exec("DELETE FROM schedules WHERE id_course = $cid");
            
            // Final delete course
            $pdo->exec("DELETE FROM courses WHERE id_course = $cid");
        }
    }
    
    echo "Step-by-Step Sync Complete.\n";
} catch (Exception $e) { echo "Error: " . $e->getMessage() . "\n"; }
?>
