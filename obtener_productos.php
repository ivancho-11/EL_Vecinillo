<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('HTTP/1.0 403 Forbidden');
    echo json_encode(["error" => "No autorizado"]);
    exit();
}

// Conexión a la base de datos
$servername = "127.0.0.1";
$username = "LINA";
$password_db = "1234";
$dbname = "ADMINISTRACION";

// Crear conexión
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conn->connect_error]));
}

// Obtener productos
$sql = "SELECT id, nombre, precio FROM productos";
$result = $conn->query($sql);

if (!$result) {
    die(json_encode(["error" => "Error en la consulta: " . $conn->error]));
}

$productos = $result->fetch_all(MYSQLI_ASSOC);

// Devolver los productos en formato JSON
header('Content-Type: application/json');
echo json_encode($productos);

$conn->close();
?>