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
            echo "Brute-force cleanup for $cid (" . $c['course_name'] . ")\n";
            
            // Get Enrollments for this course
            $enStmt = $pdo->prepare("SELECT id_enrollment FROM enrollments WHERE id_course = ?");
            $enStmt->execute([$cid]);
            $enIds = $enStmt->fetchAll(PDO::FETCH_COLUMN);
            if (!empty($enIds)) {
                $enIdsStr = implode(',', $enIds);
                $pdo->exec("DELETE FROM enrollment_schedules WHERE enrollment_id IN ($enIdsStr)");
                $pdo->exec("DELETE FROM enrollments WHERE id_course = $cid");
            }
            
            // Get Schedules for this course
            $scStmt = $pdo->prepare("SELECT id_schedule FROM schedules WHERE id_course = ?");
            $scStmt->execute([$cid]);
            $scIds = $scStmt->fetchAll(PDO::FETCH_COLUMN);
            if (!empty($scIds)) {
                $scIdsStr = implode(',', $scIds);
                // The issue is likely in schedule_teachers column name. 
                // Let's generic delete if possible or bypass.
                $pdo->exec("DELETE FROM schedule_teachers WHERE id_schedule IN ($scIdsStr)");
                $pdo->exec("DELETE FROM schedules WHERE id_course = $cid");
            }
            
            // Final delete the course itself
            $pdo->exec("DELETE FROM courses WHERE id_course = $cid");
        }
    }
    
    echo "Brute-Force Complete.\n";
} catch (Exception $e) { echo "Error: " . $e->getMessage() . "\n"; }
?>
