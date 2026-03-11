<?php
include_once 'config/connection.php';
try {
    // 1. Get titles from JSON to keep
    $jsonPath = 'data/programs.json';
    $jsonContent = file_get_contents($jsonPath);
    $programs = json_decode($jsonContent, true);
    $titlesToKeep = [];
    foreach($programs as $p) {
        $titlesToKeep[] = $p['title'];
    }
    
    // 2. Delete test courses specifically
    $pdo->exec("DELETE FROM courses WHERE course_name IN ('Curso Test A', 'Curso Test B')");
    
    // 3. Delete ANY course that doesn't have a matching title in JSON (optional, but requested "not in active programs")
    // Let's be safe and just target the ones that are definitely not desired.
    // The user said "igual no existen en los programas activos".
    
    $stmt = $pdo->query("SELECT id_course, course_name FROM courses");
    $dbCourses = $stmt->fetchAll();
    
    foreach($dbCourses as $c) {
        if (!in_array($c['course_name'], $titlesToKeep)) {
            echo "Deleting orphaned DB course: " . $c['course_name'] . "\n";
            $cid = $c['id_course'];
            $pdo->exec("DELETE FROM courses WHERE id_course = $cid");
        }
    }
    
    echo "Sync Complete.\n";
} catch (Exception $e) { echo $e->getMessage(); }
?>
