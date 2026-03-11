<?php
include_once 'config/connection.php';
try {
    // Manually delete test courses and restore Guitarra/Piano
    $pdo->exec("DELETE FROM courses WHERE course_name IN ('Curso Test A', 'Curso Test B')");
    
    $programs = ['Guitarra', 'Piano'];
    foreach($programs as $n) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM courses WHERE course_name = ?");
        $stmt->execute([$n]);
        if($stmt->fetchColumn() == 0) {
            $pdo->prepare("INSERT INTO courses (course_name, price) VALUES (?, 0)")->execute([$n]);
            echo "Restored: $n\n";
        }
    }
} catch (Exception $e) { echo $e->getMessage(); }
?>
