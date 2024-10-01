<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$servername = "127.0.0.1";
$username = "LINA";        // Usar 'LINA' en lugar de 'root'
$password_db = "1234";     // Contraseña de 'LINA'
$dbname = "ADMINISTRACION";

// Crear conexión
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para obtener todos los productos
function obtenerProductos() {
    global $conn;
    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

// Función para actualizar el precio de un producto
function actualizarPrecio($id, $precio) {
    global $conn;

    $sql = "UPDATE productos SET precio = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("di", $precio, $id);

    if ($stmt->execute()) {
        echo "<p>Precio actualizado correctamente.</p>";
    } else {
        echo "<p>Error al actualizar el precio: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// Lógica para actualizar el precio de un producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $precio = floatval($_POST['precio']);

    if ($id > 0 && $precio >= 0) {
        actualizarPrecio($id, $precio);
    } else {
        echo "<p>Datos inválidos.</p>";
    }
}

// Obtener productos
$productos = obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - Vecinillo</title>
    <style>
        body {
            background-color: #f4f4f4; /* Color de fondo gris claro */
            font-family: Arial, sans-serif; /* Fuente general */
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #333; /* Fondo oscuro para la cabecera */
            color: white; /* Color del texto en la cabecera */
            padding: 20px; /* Espaciado interno */
            text-align: center; /* Centrar texto */
        }

        .logo-2 {
            max-width: 150px; /* Ajusta el tamaño del logo */
            margin-bottom: 10px; /* Espacio debajo del logo */
        }

        h2 {
            margin-top: 0; /* Eliminar margen superior del título */
        }

        table {
            width: 100%; /* Tabla ocupa el 100% del ancho */
            border-collapse: collapse; /* Colapsar bordes */
            margin-top: 20px; /* Espacio superior de la tabla */
        }

        th, td {
            padding: 15px; /* Espaciado interno en celdas */
            text-align: left; /* Alinear texto a la izquierda */
            border-bottom: 1px solid #ddd; /* Línea inferior de las celdas */
        }

        th {
            background-color: #333; /* Fondo oscuro para encabezados */
            color: white; /* Texto blanco en encabezados */
        }

        tr:hover {
            background-color: #f1f1f1; /* Color de fondo al pasar el mouse sobre las filas */
        }

        input[type="text"] {
            width: 80%; /* Ancho del campo de texto */
            padding: 10px; /* Espaciado interno del campo de texto */
            border-radius: 5px; /* Bordes redondeados */
            border: 1px solid #ccc; /* Borde gris claro */
        }

        input[type="submit"] {
            padding: 10px 15px; /* Espaciado interno del botón */
            background-color: #28a745; /* Color verde para el botón */
            color: white; /* Texto blanco en el botón */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cambiar cursor al pasar sobre el botón */
        }

        input[type="submit"]:hover {
            background-color: #218838; /* Color más oscuro al pasar el mouse sobre el botón */
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #007bff; /* Color azul para el enlace de cerrar sesión */
        }

        a:hover {
            text-decoration: underline; /* Subrayar enlace al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="header">
        <img class="logo-2" src="images/el vecinillo.png" alt="Logo alternativo">
        <h2>Panel de Administración - Vecinillo</h2>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?php echo htmlspecialchars($producto['id']); ?></td>
            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
            <td><?php echo htmlspecialchars($producto['precio']); ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">
                    <input type="text" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
                    <input type="submit" value="Actualizar">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="logout.php">Cerrar sesión</a>
</body>
</html>