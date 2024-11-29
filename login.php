<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #000; 
            color: #fff; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            font-family: 'Poppins', sans-serif; 
            flex-direction: column; 
        }

        h2 {
            margin-bottom: 20px; 
        }

        .logo-2 {
            max-width: 150px; 
            margin-bottom: 20px; 
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.1); 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); 
            width: 300px; 
        }

        input[type="submit"] {
            background-color: #db241b;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #f40d0d;
        }

        .form-container button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <img class="logo-2" src="images/el vecinillo.png" alt="Logo alternativo">
    
    <div class="form-container">
        <h2>Hey tú, ingresa a tu administrador</h2>
        <form action="process_login.php" method="POST">
            <div class="form-group mb-3">
                <label for="email">Correo</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <input type="submit" value="Iniciar sesión" class="btn btn-block">
        </form>

        <!-- Botón para ir a la página de creación de usuario -->
        <a href="crear_usuario.php">
            <button type="button">Crear Usuario</button>
        </a>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
