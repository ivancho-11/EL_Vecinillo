<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $conn = new PDO("mysql:host=127.0.0.1;dbname=ADMINISTRACION", "LINA", "1234");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Listar bases de datos
    $stmt = $conn->query("SHOW DATABASES");
    echo "Bases de datos disponibles:\n";
    while ($row = $stmt->fetch(PDO::FETCH_COLUMN)) {
        echo $row . "\n";
    }

    // Listar tablas en ADMINISTRACION
    $stmt = $conn->query("SHOW TABLES FROM ADMINISTRACION");
    echo "\nTablas en ADMINISTRACION:\n";
    while ($row = $stmt->fetch(PDO::FETCH_COLUMN)) {
        echo $row . "\n";
    }

    // Verificar estructura de la tabla usuarios
    $stmt = $conn->query("DESCRIBE ADMINISTRACION.usuarios");
    echo "\nEstructura de la tabla usuarios:\n";
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

} catch(PDOException $e) {
    echo "Error completo: " . $e->getMessage() . "\n";
}
?>