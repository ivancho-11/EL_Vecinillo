<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="images/el-vecinillo.png" type="image/png">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .comentarios {
            margin-top: 50px;
        }
        .comentario {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .comentario h5 {
            margin: 0;
        }
        .comentario p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .comentario time {
            font-size: 12px;
            color: #6c757d;
        }
        <?php
// Reemplaza esta sección en tu archivo Testimonios.php
// ... (alrededor de la línea 90)

// Configuración específica para XAMPP en Mac
$servername = 'localhost:/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock';
$username = 'root';
$password = '';
$dbname = 'ADMINISTRACION';

try {
    // Crear conexión
    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        throw new Exception("Error en la conexión: " . $conexion->connect_error);
    }

    // Consulta para obtener los comentarios
    $sql = "SELECT nombre, comentario, fecha FROM testimonios ORDER BY fecha DESC";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="comentario">
                    <h5>' . htmlspecialchars($row['nombre']) . '</h5>
                    <p>' . htmlspecialchars($row['comentario']) . '</p>
                    <time>' . htmlspecialchars($row['fecha']) . '</time>
                  </div>';
        }
    } else {
        echo '<p class="text-center">Aún no hay comentarios. Sé el primero en dejar uno.</p>';
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if (isset($conexion)) {
        $conexion->close();
    }
}
?>
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                if (isset($_GET['mensaje'])) {
                    if ($_GET['mensaje'] == 'success') {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                ¡Gracias! Tu comentario ha sido enviado correctamente.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    } else if ($_GET['mensaje'] == 'error') {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Hubo un error al enviar tu comentario. Por favor, intenta nuevamente.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    }
                }
                ?>
                <div class="card">
                    <div class="card-header text-center">
                        <h1 class="h3">Dejanos tus comentarios</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="procesar_testimonio.php">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Deja tu comentario aquí" id="comentario" name="comentario" style="height: 150px" required></textarea>
                                <label for="comentario">Tu opinión nos importa</label>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sección de comentarios -->
                <div class="comentarios">
                    <h3 class="text-center mt-5">Comentarios recientes</h3>
                    <?php
                    // Conexión a la base de datos
                    $conexion = new mysqli("localhost", "usuario", "contraseña", "nombre_base_datos");

                    if ($conexion->connect_error) {
                        die("Error en la conexión: " . $conexion->connect_error);
                    }

                    // Consulta para obtener los comentarios
                    $sql = "SELECT nombre, comentario, fecha FROM testimonios ORDER BY fecha DESC";
                    $result = $conexion->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="comentario">
                                    <h5>' . htmlspecialchars($row['nombre']) . '</h5>
                                    <p>' . htmlspecialchars($row['comentario']) . '</p>
                                    <time>' . htmlspecialchars($row['fecha']) . '</time>
                                  </div>';
                        }
                    } else {
                        echo '<p class="text-center">Aún no hay comentarios. Sé el primero en dejar uno.</p>';
                    }

                    $conexion->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
