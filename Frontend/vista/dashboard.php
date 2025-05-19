<?php include_once 'header.php'; ?>
<link rel="stylesheet" href="../estilos/css/style.css">
<link rel="stylesheet" href="../estilos/css/estilos_lis_pat.css">
<title>Página Principal</title>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
        background-color: #f4f4f4;
    }
    .titulo {
        text-align: center;
        margin: 20px;
    }
</style>

<main>
    <?php include_once 'panel_navegacion.php'; ?>

    <!-- Contenido Principal -->
    <div class="main-content titulo">
        <h1>Bienvenido a SistemaPat </h1>
        <p>Control de Patentes de la Alcaldia del Municipio Garcia de Hevia la Fria/Tàchira.</p>

        <!-- Cuadros de Estadísticas -->
        <!--  -->
    </div>
<?php  include_once 'listado_patente.php';  ?>

</main>
<!-- Enlace a Chart.js -->
<script src="../estilos/lib/js/jquery-3.6.0.min.js"></script>
<script src="../estilos/lib/js/chart.js"></script>
<script>
    
</script>
<?php include_once 'footer.php'; ?>