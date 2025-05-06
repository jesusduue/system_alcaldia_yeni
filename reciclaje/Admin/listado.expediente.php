<?php include_once './layout/header.php'; ?>

<title>Listado de Patentes - SistemaPat</title>
<link rel="stylesheet" href="../public/css/style.css">
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    #searchInput {
        width: 100%;
        /* Ocupa todo el ancho del contenedor */
        padding: 10px;
        /* Espaciado interno */
        margin-bottom: 20px;
        /* Espaciado inferior */
        border: 1px solid #ddd;
        /* Borde gris claro */
        border-radius: 5px;
        /* Bordes redondeados */
        font-size: 16px;
        /* Tamaño de fuente */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Sombra ligera */
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        /* Transiciones suaves */
    }

    #searchInput:focus {
        border-color: #007bff;
        /* Cambia el color del borde al enfocar */
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
        /* Sombra más pronunciada */
        outline: none;
        /* Elimina el borde azul predeterminado */
    }

    .main-content {
        margin-left: 250px;
        margin-top: 50px;
        padding: 20px;
        box-sizing: border-box;
        width: calc(100% - 250px);
    }

    .patente-list {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .patente-list h2 {
        margin-top: 0;
        font-size: 24px;
        color: #333;
    }

    .patente-list table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .patente-list table th,
    .patente-list table td {
        padding: 10px;
        text-align: center;
        /* Centra horizontalmente el contenido */
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        /* Centra verticalmente el contenido */
    }

    .patente-list table th {
        background-color: #f4f4f4;
        color: #333;
    }

    .patente-list table td .action-buttons {
        display: flex;
        justify-content: center;
        /* Centra los botones horizontalmente */
        align-items: center;
        /* Centra los botones verticalmente */
        gap: 10px;
        /* Espacio entre los botones */
    }

    .patente-list table td .action-buttons a {
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
        position: relative;
        /* Necesario para el tooltip */
    }

    .patente-list table td .action-buttons .update {
        background-color: #28a745;
        color: white;
    }

    .patente-list table td .action-buttons .update:hover {
        background-color: #218838;
    }

    .patente-list table td .action-buttons .delete {
        background-color: #dc3545;
        color: white;
    }

    .patente-list table td .action-buttons .delete:hover {
        background-color: #c82333;
    }

    .patente-list table td .action-buttons .license {
        background-color: #007bff;
        color: white;
    }

    .patente-list table td .action-buttons .license:hover {
        background-color: #0056b3;
    }

    /* Tooltip personalizado */
    .action-buttons a::after {
        content: attr(data-tooltip);
        /* Obtiene el texto del atributo data-tooltip */
        position: absolute;
        bottom: -30px;
        /* Posiciona el tooltip debajo del botón */
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        z-index: 10;
    }

    .action-buttons a:hover::after {
        opacity: 1;
        visibility: visible;
    }
</style>

<main>
    <?php include_once './layout/nav.php'; ?>

    <!-- Contenido Principal -->
    <div class="main-content">

        <div class="patente-list">
            <h2>Listado de Patentes</h2>
            <!-- Buscador -->
            <input type="text" id="searchInput"
                placeholder="Buscar por Razón Social, Representante Legal, Cédula/RIF..."
                style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
            <table>
                <thead>
                    <tr>
                        <th>Nº de Expediente</th>
                        <th>nombre y apellido</th>
                        <th>Cédula/RIF</th>
                        <th>direccion</th>
                        <th>fecha de apertura</th>
                        <th>opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Juan Pérez</td>
                        <td>V-12345678</td>
                        <td>Av. Principal</td>
                        <td>27-10-2023</td>
                        <td>
                            <div class="action-buttons">
                                <a href="" class="update" data-tooltip="Modificar"><i class="fas fa-edit"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!-- Más filas aquí -->
                </tbody>
            </table>
        </div>
    </div>
</main>
<script>
    // Filtrar tabla en tiempo real
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#patenteTable tr');

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
            row.style.display = rowText.includes(filter) ? '' : 'none';
        });
    });
</script>

<?php include_once './layout/footer.php'; ?>