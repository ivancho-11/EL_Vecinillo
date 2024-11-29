<?php
session_start();

// Obtener datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['email'];  // Mantuve 'email' del formulario
    $password = $_POST['password'];  // Contraseña ingresada

    // Conexión a la base de datos
    $servername = "127.0.0.1";
    $username = "LINA";        
    $password_db = "1234";     
    $dbname = "ADMINISTRACION"; 

    // Crear conexión
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para verificar usuario
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        
        
        
        if ($password === $usuario['clave']) {
            $_SESSION['user'] = $correo;
            header("Location: panel_admin.php");
            exit();
        } else {
            echo "Credenciales incorrectas.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>