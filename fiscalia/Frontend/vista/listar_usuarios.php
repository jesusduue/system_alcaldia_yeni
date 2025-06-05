<?php
// Incluir el encabezado (asumiendo que existe un archivo header.php)
// include 'header.php';
// Incluir el panel de navegación (asumiendo que existe un archivo panel_navegacion.php)
// include 'panel_navegacion.php';

// Aquí iría la lógica para obtener los usuarios desde el controlador o la API
// Por ahora, usaremos datos de ejemplo o un mensaje placeholder.

$usuarios = [
    // Ejemplo de datos:
    // ['id_usu' => 1, 'nom_usu' => 'admin', 'cla_usu' => '...', 'fky_perm' => 1, 'est_usu' => 'A'],
    // ['id_usu' => 2, 'nom_usu' => 'usuario_ejemplo', 'cla_usu' => '...', 'fky_perm' => 2, 'est_usu' => 'A'],
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <!-- Incluir estilos CSS si es necesario -->
    <!-- <link rel="stylesheet" href="../estilos/css/style.css"> -->
</head>
<body>

    <div class="container">
        <h1>Listado de Usuarios</h1>

        <?php if (empty($usuarios)): ?>
            <p>No hay usuarios registrados.</p>
        <?php else: ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Usuario</th>
                        <th>ID Permiso</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['id_usu']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['nom_usu']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['fky_perm']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['est_usu']); ?></td>
                            <td>
                                <!-- Enlaces o botones para editar y eliminar -->
                                <a href="#">Editar</a> |
                                <a href="#">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>

    <?php
    // Incluir el pie de página (asumiendo que existe un archivo footer.php)
    // include 'footer.php';
    ?>

</body>
</html>