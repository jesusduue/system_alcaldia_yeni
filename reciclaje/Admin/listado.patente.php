<?php include_once './layout/header.php';

require('class/patente.class.php');
$obj_patente=new patente;
$obj_patente->id_pate="id_pate";
$obj_patente->puntero=$obj_patente->listar();

?>

<title>Listado de Patentes - SistemaPat</title>
<link rel="stylesheet" href="../public/css/style.css">
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    #buscador {
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

    #buscador:focus {
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

    .patente-list table td .action-buttons .solvencia {
        background-color: #dc3545;
        color: white;
    }

    .patente-list table td .action-buttons .solvencia:hover {
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
            <input name="buscador" type="text" id="buscador" placeholder="Razón Social, Representante Legal, Cédula/RIF...">
            <table class="patentes-table">
                <thead>
                    <tr>
                        <th>Nº de Expediente</th>
                        <th>Razón Social</th>
                        <th>Representante Legal</th>
                        <th>Cédula/RIF</th>
                        <th>Ubicación</th>
                        <th>Rubro</th>
                        <th>Estado</th>
                        <?php if ($_SESSION["rol"] === "admin"): ?>
                        <th> Opciones</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se generarán las filas dinámicamente con PHP -->
                    <?php
        $i = 0;
        while ($patente = $obj_patente->extraer_dato()) {
            echo "<tr>
                    <td>" . htmlspecialchars($patente['numero_exp']) . "</td>
                    <td>" . htmlspecialchars($patente['razon_so']) . "</td>
                    <td>" . htmlspecialchars($patente['rep_legal']) . "</td>
                    <td>" . htmlspecialchars($patente['ced_rif']) . "</td>
                    <td>" . htmlspecialchars($patente['ubicacion']) . "</td>
                    <td>" . htmlspecialchars($patente['rubro']) . "</td>
                    <td>" . htmlspecialchars($patente['estado']) . "</td>";
            // Verificar si el usuario es admin para mostrar los botones
            if ($_SESSION['rol'] === 'admin') {
                echo "<td>
                            <div class='action-buttons'>
                                <a href='licencia.php?id_pate=" . htmlspecialchars($patente['id_pate']) . "'  class='license'  data-tooltip='Licencia'><i class='fas fa-file'> LICENCIA</i></a>
                                <a href='' class='solvencia' data-tooltip='solvencia'><i class='fas fa-file'>SOLVENCIA</i></a>
                                <a href='' class='update' data-tooltip='Modificar'><i class='fas fa-edit'>MODIFICAR</i></a>
                            </div>
                        </td>";
            } 
            echo "</tr>";
            $i++;
        }
        if ($i == 0) {
            echo "<script language='javascript'>
                    alert('No hay registros');
                    document.location='registro.patente.php';
                </script>";
        }
        ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script>
    // Filtrar tabla en tiempo real
    document.addEventListener("DOMContentLoaded", function () {
        var inputBuscador = document.getElementById("buscador");

        inputBuscador.addEventListener("input", function () {
            var filtro = inputBuscador.value.trim().toLowerCase();
            var filas = document.querySelectorAll("table.patentes-table tbody tr");

            filas.forEach(function (fila) {
                var textoFila = fila.textContent.trim().toLowerCase();
                fila.style.display = textoFila.includes(filtro) ? "table-row" : "none";
            });
        });
    });
</script>

<?php include_once './layout/footer.php'; ?>