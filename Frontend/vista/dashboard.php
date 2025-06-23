<?php include_once 'header.php'; ?>
<link rel="stylesheet" href="../estilos/css/style.css">
<link rel="stylesheet" href="../estilos/css/estilos_lis_pat.css">
<title>Página Principal</title>

<style>
    /* Estilos Generales del body y main-content para tu estructura existente */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
        /* Mantiene tu diseño con panel de navegación */
        background-color: #f0f2f5;
        /* Un gris suave */
        color: #333;
        line-height: 1.6;
    }

    /* Asegúrate de que .main-content tenga un ancho adecuado para que el carrusel no se desborde */
    .main-content {
        /* Ocupa el espacio restante después del panel de navegación */
        padding: 20px;
        /* Incluye padding en el ancho total */
    }

    .titulo {
        text-align: center;
        margin-bottom: 20px;
        /* Espacio debajo del título */
    }

    .my-dot {
        /* Clase para cada punto indicador */
        cursor: pointer;
        height: 14px;
        width: 14px;
        margin: 0 5px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease, transform 0.2s ease;
    }

    .my-dot.active,
    .my-dot:hover {
        background-color: #7a7a7a;
        transform: scale(1.2);
    }

    /* Estilos del Pie de Página (si lo tienes en el mismo archivo) */
    footer {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 1.5em 0;
        margin-top: 50px;
        font-size: 0.9em;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
    }

    footer p {
        margin: 0.5em 0;
    }

    .main-content-descripcion {
        border-top: 6px solid #076FF9;
        /* Clase para la descripción del contenido principal */
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        width: 650px;
        transform: translateX(-50%);
        position: absolute;
        top: 90px;
        left: 1200px;
        /* Centra el bloque horizontalmente */
    }

    .inicio-fondo {
        display: block;
        width: 585px;

    }

    .box {
        background-color: rgb(117, 190, 249);
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        margin: 10px 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 250px;
        height: 80px;
    }
    .box:hover{
        box-shadow: none;
    }
    .alcalde{
        position: absolute;
        top:26%;
        left: 44%;
        width: 350px;
    }
</style>

<main>
    <?php include_once 'panel_navegacion.php'; ?>

    <div class="main-content titulo">
        <h1>Bienvenido a SistemaPat </h1>
        <p>Control de Patentes de la Alcaldia del Municipio Garcia de Hevia la Fria/Tàchira.</p>
        <img class="inicio-fondo" src="img/incio.jpg" alt="Inicio">

    </div>
    <div class="main-content-descripcion">
        <p>
            El <strong>Sistema de Patentes</strong> de la Alcaldía del Municipio García de Hevia (La Fría, Táchira) es
            una
            plataforma digital integral diseñada para ✨ <strong>simplificar y</strong> 📈 <strong>optimizar</strong> la
            gestión de patentes de industria y comercio en la localidad. Su objetivo principal:
        </p>

        <div class="container-box">
            <div class="box">✨ Simplificar y 📈 optimizar la gestión.</div>

            <div class="box">⚡ agilizar y 🤖 automatizar los procesos.</div>

            <div class="box">👁️ garantizar la transparencia y 🔗 trazabilidad.</div>

            <div class="box">✅ facilitar el cumplimiento normativo y 💰 tributario.</div>

            <img  class="alcalde " src="img/carrusel2.png" alt="Alcalde Willinton Vivas">

        </div>

    </div>

</main>

<script src="../estilos/lib/js/jquery-3.6.0.min.js"></script>
<script src="../estilos/lib/js/chart.js"></script>
<?php include_once 'footer.php'; ?>