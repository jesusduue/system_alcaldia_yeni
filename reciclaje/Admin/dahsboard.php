<?php include_once './layout/header.php'; ?>
<link rel="stylesheet" href="../public/css/style.css">
<title>Página Principal</title>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
        background-color: #f4f4f4;
    }


    .main-content {
        position: absolute;
        /* Posiciona el contenedor de forma absoluta */
        top: 50px;
        /* Respeta la altura de la barra superior */
        left: 250px;
        /* Respeta el ancho de la barra lateral */
        right: 0;
        /* Se extiende hasta el borde derecho */
        bottom: 0;
        /* Se extiende hasta el borde inferior */
        padding: 20px;
        box-sizing: border-box;
        background-color: #ffffff;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        /* Tres columnas */
        gap: 20px;
        margin-top: 20px;
    }

    .stat-box {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .stat-box h3 {
        margin: 0;
        font-size: 20px;
        color: #333;
    }

    .stat-box p {
        margin: 10px 0 0;
        font-size: 16px;
        color: #555;
    }

    .chart-container {
        margin-top: 40px;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .chart-container h3 {
        margin-bottom: 20px;
        font-size: 20px;
        color: #333;
    }

    .filter-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .filter-buttons button {
        padding: 10px 20px;
        background-color: #2c3e50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .filter-buttons button:hover {
        background-color: #34495e;
    }

    .stat-box:hover {
        background-color: #eaeaea;
    }
</style>

<main>
    <?php include_once './layout/nav.php'; ?>

    <!-- Contenido Principal -->
    <div class="main-content">
        <h1>Bienvenido a SistemaPat </h1>
        <p>Control de Patentes de la Alcaldia del Municipio Garcia de Hevia la Fria/Tàchira.</p>

        <!-- Cuadros de Estadísticas -->
        <?php include_once './layout/estadisticas.php'; ?>
    </div>


</main>
<!-- Enlace a Chart.js -->
<script src="../lib/js/jquery-3.6.0.min.js"></script>
<script src="../lib/js/chart.js"></script>
<script>
    
</script>
<?php include_once './layout/footer.php'; ?>