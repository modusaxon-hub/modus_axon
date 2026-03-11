<?php
include_once 'config/connection.php';
try {
    $tables = ['site_config', 'system_settings'];
    foreach ($tables as $table) {
        echo "\nTable: $table\n";
        $stmt = $pdo->query("DESCRIBE $table");
        while ($row = $stmt->fetch()) {
            echo "  {$row['Field']} - {$row['Type']}\n";
        }
        echo "\nData from $table:\n";
        $stmt = $pdo->query("SELECT * FROM $table");
        print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
