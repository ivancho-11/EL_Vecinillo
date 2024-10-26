<?php
// Configuración específica para XAMPP en Mac
$servername = 'localhost:/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock';
$username = 'root';
$password = '';
$dbname = 'ADMINISTRACION';

try {
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }

    // Verificar si se han enviado datos por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $comentario = $_POST['comentario'];
        $fecha = date('Y-m-d H:i:s');

        // Preparar la consulta SQL
        $sql = "INSERT INTO testimonios (nombre, email, comentario, fecha) 
                VALUES (?, ?, ?, ?)";
        
        // Preparar la sentencia
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $email, $comentario, $fecha);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir con mensaje de éxito
            header("Location: Testimonios.php?mensaje=success");
            exit();
        } else {
            // Redirigir con mensaje de error
            header("Location: Testimonios.php?mensaje=error");
            exit();
        }

        $stmt->close();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?>