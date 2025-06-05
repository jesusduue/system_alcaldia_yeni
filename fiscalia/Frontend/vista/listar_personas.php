<?php
// Incluir el encabezado (asumiendo que existe un archivo header.php)
// include 'header.php';
// Incluir el panel de navegación (asumiendo que existe un archivo panel_navegacion.php)
// include 'panel_navegacion.php';

// Aquí iría la lógica para obtener las personas desde el controlador o la API
// Por ahora, usaremos datos de ejemplo o un mensaje placeholder.

$personas = [
    // Ejemplo de datos:
    // ['id_per' => 1, 'ced_per' => '12345678', 'nom_per' => 'Juan', 'ape_per' => 'Perez', 'tel_per' => '0412-1234567', 'ema_per' => 'juan.perez@example.com', 'dir_per' => 'Calle Falsa 123', 'cat_per' => 'Civil', 'fec_ing_per' => '2023-10-27', 'fky_usu' => 1, 'est_per' => 'A'],
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Personas</title>
    <!-- Incluir estilos CSS si es necesario -->
    <!-- <link rel="stylesheet" href="../estilos/css/style.css"> -->
</head>
<body>

    <div class="container">
        <h1>Listado de Personas</h1>

        <?php if (empty($personas)): ?>
            <p>No hay personas registradas.</p>
        <?php else: ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cédula/RIF</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Categoría</th>
                        <th>Fecha Ingreso</th>
                        <th>Usuario Registro</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($personas as $persona): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($persona['id_per']); ?></td>
                            <td><?php echo htmlspecialchars($persona['ced_per']); ?></td>
                            <td><?php echo htmlspecialchars($persona['nom_per']); ?></td>
                            <td><?php echo htmlspecialchars($persona['ape_per']); ?></td>
                            <td><?php echo htmlspecialchars($persona['tel_per']); ?></td>
                            <td><?php echo htmlspecialchars($persona['ema_per']); ?></td>
                            <td><?php echo htmlspecialchars($persona['dir_per']); ?></td>
                            <td><?php echo htmlspecialchars($persona['cat_per']); ?></td>
                            <td><?php echo htmlspecialchars($persona['fec_ing_per']); ?></td>
                            <td><?php echo htmlspecialchars($persona['fky_usu']); ?></td>
                            <td><?php echo htmlspecialchars($persona['est_per']); ?></td>
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