<?php
$pdo = new PDO('mysql:host=localhost;dbname=jam_db', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");
    
    // Create query with RELATIVE database references
    $create = "
    CREATE TABLE IF NOT EXISTS `schedule_teachers_new` (
      `id_assignment` int(11) NOT NULL AUTO_INCREMENT,
      `id_schedule` int(11) NOT NULL,
      `id_teacher` int(11) NOT NULL,
      `assigned_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id_assignment`),
      KEY `id_schedule` (`id_schedule`),
      KEY `id_teacher` (`id_teacher`),
      CONSTRAINT `schedule_teachers_new_ibfk_1` FOREIGN KEY (`id_schedule`) REFERENCES `schedules` (`id_schedule`) ON DELETE CASCADE,
      CONSTRAINT `schedule_teachers_new_ibfk_2` FOREIGN KEY (`id_teacher`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    
    $pdo->exec($create);
    
    // Copy data
    $pdo->exec("INSERT INTO `schedule_teachers_new` SELECT * FROM `schedule_teachers`;");
    // Drop old
    $pdo->exec("DROP TABLE `schedule_teachers`;");
    // Rename new
    $pdo->exec("RENAME TABLE `schedule_teachers_new` TO `schedule_teachers`;");
    
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");
    echo "Success!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
