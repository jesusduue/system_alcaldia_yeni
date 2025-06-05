<?php
// Incluir el encabezado (asumiendo que existe un archivo header.php)
// include 'header.php';
// Incluir el panel de navegación (asumiendo que existe un archivo panel_navegacion.php)
// include 'panel_navegacion.php';

// Aquí iría la lógica para obtener los casos desde el controlador o la API
// Por ahora, usaremos datos de ejemplo o un mensaje placeholder.

$casos = [
    // Ejemplo de datos:
    // ['id_cas' => 1, 'fky_per' => 1, 'num_cas' => 'ABC-123', 'nom_cas' => 'Robo', 'cat_cas' => 'Denuncia', 'des_cas' => 'Robo a mano armada en...', 'est_cas' => 'A'],
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Casos</title>
    <!-- Incluir estilos CSS si es necesario -->
    <!-- <link rel="stylesheet" href="../estilos/css/style.css"> -->
</head>
<body>

    <div class="container">
        <h1>Listado de Casos</h1>

        <?php if (empty($casos)): ?>
            <p>No hay casos registrados.</p>
        <?php else: ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID Caso</th>
                        <th>ID Persona</th>
                        <th>Número de Control</th>
                        <th>Nombre del Caso</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($casos as $caso): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($caso['id_cas']); ?></td>
                            <td><?php echo htmlspecialchars($caso['fky_per']); ?></td>
                            <td><?php echo htmlspecialchars($caso['num_cas']); ?></td>
                            <td><?php echo htmlspecialchars($caso['nom_cas']); ?></td>
                            <td><?php echo htmlspecialchars($caso['cat_cas']); ?></td>
                            <td><?php echo htmlspecialchars($caso['des_cas']); ?></td>
                            <td><?php echo htmlspecialchars($caso['est_cas']); ?></td>
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