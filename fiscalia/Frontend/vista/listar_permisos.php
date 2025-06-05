<?php
// Incluir el encabezado (asumiendo que existe un archivo header.php)
// include 'header.php';
// Incluir el panel de navegación (asumiendo que existe un archivo panel_navegacion.php)
// include 'panel_navegacion.php';

// Aquí iría la lógica para obtener los permisos desde el controlador o la API
// Por ahora, usaremos datos de ejemplo o un mensaje placeholder.

$permisos = [
    // Ejemplo de datos:
    // ['id_perm' => 1, 'nom_perm' => 'Administrador', 'est_perm' => 'A'],
    // ['id_perm' => 2, 'nom_perm' => 'Usuario', 'est_perm' => 'A'],
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Permisos</title>
    <!-- Incluir estilos CSS si es necesario -->
    <!-- <link rel="stylesheet" href="../estilos/css/style.css"> -->
</head>
<body>

    <div class="container">
        <h1>Listado de Permisos</h1>

        <?php if (empty($permisos)): ?>
            <p>No hay permisos registrados.</p>
        <?php else: ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Permiso</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($permisos as $permiso): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($permiso['id_perm']); ?></td>
                            <td><?php echo htmlspecialchars($permiso['nom_perm']); ?></td>
                            <td><?php echo htmlspecialchars($permiso['est_perm']); ?></td>
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