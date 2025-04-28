<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Usuario - SistemaPat</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .main-content {
            margin-left: 250px;
            margin-top: 50px;
            padding: 20px;
            box-sizing: border-box;
            width: calc(100% - 250px);
        }

        .create-user-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .create-user-container h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        .create-user-container form {
            display: flex;
            flex-direction: column;
        }

        .create-user-container label {
            font-size: 16px;
            color: #555;
            margin-bottom: 5px;
        }

        .create-user-container input,
        .create-user-container select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .create-user-container button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .create-user-container button:hover {
            background-color: #0056b3;
        }

        .create-user-container a {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }

        .create-user-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="create-user-container">
            <h2>Crear Nuevo Usuario</h2>
            <form action="procesar_crear_usuario.php" method="POST">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre completo" required>

                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="Ingrese el correo electrónico" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingrese la contraseña" required>

                <label for="rol">Rol</label>
                <select id="rol" name="rol" required>
                    <option value="Administrador">Administrador</option>
                    <option value="Usuario">Usuario</option>
                </select>

                <button type="submit">Crear Usuario</button>
            </form>
            <a href="gestion_de_usuarios.html"><i class="fas fa-arrow-left"></i> Volver a Gestión de Usuarios</a>
        </div>
    </div>
</body>
</html>