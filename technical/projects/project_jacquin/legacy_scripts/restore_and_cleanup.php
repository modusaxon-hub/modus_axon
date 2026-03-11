<?php
include_once 'config/connection.php';
try {
    // 1. Delete actual test courses by name
    $stmt = $pdo->prepare("SELECT id_course FROM courses WHERE course_name IN ('Curso Test A', 'Curso Test B')");
    $stmt->execute();
    $test_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if(!empty($test_ids)) {
        $ids_str = implode(',', $test_ids);
        $pdo->exec("DELETE FROM enrollment_schedules WHERE id_enrollment IN (SELECT id_enrollment FROM enrollments WHERE id_course IN ($ids_str))");
        $pdo->exec("DELETE FROM enrollments WHERE id_course IN ($ids_str)");
        $pdo->exec("DELETE FROM schedule_teachers WHERE id_schedule IN (SELECT id_schedule FROM schedules WHERE id_course IN ($ids_str))");
        $pdo->exec("DELETE FROM schedules WHERE id_course IN ($ids_str)");
        $pdo->exec("DELETE FROM courses WHERE id_course IN ($ids_str)");
        echo "Deleted test courses IDs: $ids_str\n";
    } else {
        echo "No test courses found by name.\n";
    }

    // 2. Re-create Guitarra and Piano
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
        } else {
            echo "Course " . $p['name'] . " already exists.\n";
        }
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
