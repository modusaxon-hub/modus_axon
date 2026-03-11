<?php
include_once 'config/connection.php';
try {
    // Correct column name for enrollment ID in enrollment_schedules is likely 'enrollment_id'
    // Let's re-verify the names from the actual DB query output
    
    // 1. Delete actual test courses by name
    $stmt = $pdo->prepare("SELECT id_course FROM courses WHERE course_name IN ('Curso Test A', 'Curso Test B')");
    $stmt->execute();
    $test_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if(!empty($test_ids)) {
        $ids_str = implode(',', $test_ids);
        
        // Use JOIN to find enrollment_schedules to delete
        $pdo->exec("DELETE es FROM enrollment_schedules es 
                    JOIN enrollments e ON es.enrollment_id = e.id_enrollment 
                    WHERE e.id_course IN ($ids_str)");
                    
        $pdo->exec("DELETE FROM enrollments WHERE id_course IN ($ids_str)");
        
        // delete schedule_teachers
        $pdo->exec("DELETE st FROM schedule_teachers st 
                    JOIN schedules s ON st.id_schedule = s.id_schedule 
                    WHERE s.id_course IN ($ids_str)");
                    
        $pdo->exec("DELETE FROM schedules WHERE id_course IN ($ids_str)");
        $pdo->exec("DELETE FROM courses WHERE id_course IN ($ids_str)");
        
        echo "Deleted test courses IDs: $ids_str\n";
    }

    // 2. Re-create Guitarra and Piano if missing
    $programs = [
        ['name' => 'Guitarra', 'desc' => 'Acústica y Eléctrica'],
        ['name' => 'Piano', 'desc' => 'Clásico y Moderno']
    ];
    
    foreach($programs as $p) {
        $stmt = $pdo->prepare("SELECT id_course FROM courses WHERE course_name = ?");
        $stmt->execute([$p['name']]);
        if(!$stmt->fetch()) {
            $stmt = $pdo->prepare("INSERT INTO courses (course_name, price) VALUES (?, 0)");
            $stmt->execute([$p['name']]);
            echo "Created course: " . $p['name'] . "\n";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
