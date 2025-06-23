<?php
include_once 'header.php';

require_once('../../Backend/clase/patente_class.php');
require_once('../../Backend/clase/solvencia_class.php');



$obj_patente = new patente;
$obj_patente->asignar_valor();
$obj_patente->puntero = $obj_patente->mostrar_patente();
$patente = $obj_patente->extraer_dato();

$obj_solvencia = new solvencia;
$obj_solvencia->asignar_valor();
$obj_solvencia->puntero = $obj_solvencia->mostrar();
$solvencia = $obj_solvencia->extraer_dato();

/* $obj_fact->asignar_valor();
        $obj_fact->puntero=$obj_fact->filtrar();
        $factura=$obj_fact->extraer_dato(); */

// $patente = $obj_patente->mostrar_patente($id_pat); // Obtener la patente por ID
if (isset($_GET['id_pat'])) {
    $id_pat = $_GET['id_pat'];




    if (!$patente) {
        echo "Patente no encontrado.";
        exit;
    }
} else {
    echo "Código de patente no proporcionado.";
    exit;
}

if (!isset($_SESSION["rol"]) || ($_SESSION["rol"] !== "admin")) {
    header("Location:../../index.php"); // Redirige a la página de inicio de sesión si no cumple con los requisitos
    exit();
}

?>
<link rel="stylesheet" href="../estilos/css/style.css">
<title>Document</title>
<style>
    @media print {
        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        body {
            background: none;
            margin: 0;
            padding: 0;
        }

        main {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
            box-shadow: none;
            border: none;
            background: none;
        }

        .tabla-grid,
        .table-grid-new,
        .detalles-contribuyentes {
            width: 100% !important;
            max-width: 100% !important;
        }

        .tabla-grid {
            font-size: 12px;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: repeat(10, auto);
        }

        .table-grid-new {
            grid-template-columns: 1fr 150px 100px;
            grid-template-rows: 30px 10px 30px 10px repeat(3, 30px) 20px;
        }

        .detalles-contribuyentes>p {
            font-size: 14px !important;
        }

        input {
            font-size: 12px;
        }

        .oculto-impresion,
        .oculto-impresion * {
            display: none !important;
        }
    }


    body {
        font-family: Times New Roman;
        font-size: 12px;
        font-weight: bold;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f0f0f0;
    }

    .principal {
        font-size: 25px;
        font-weight: bold;
        margin: auto;
        text-decoration: underline;
        text-decoration-thickness: 2px;
    }

    main {
        margin-top: 55px;
        margin-bottom: 25px;
        width: 80%;
        /* Adjust as needed */
        max-width: 700px;
        /* Maximum width */
        /* background-color: #fff; */
        /* border: 2px solid #000; */

        /* padding: 15px; */
        position: relative;
        box-sizing: border-box;
        background-image: url(../estilos/img/fondo-solvencia.png);
        background-position: center, center;
        background-repeat: no-repeat, no-repeat;
        background-size: cover, contain;
        border: .5px solid rgb(218, 212, 212);
        background-color: #ffffff;


        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }

    @media (max-width: 600px) {
        main {
            width: 95%;
        }
    }

    .tabla-grid {
        gap: 0;
        border: .5px solid black;
        width: 650px;
        font-size: 14px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* 2 columnas */
        grid-template-rows: repeat(10, 20px);

    }

    .grid-item {
        border: 1px solid black;
        display: flex;
    }

    .input-box {
        border: none;
        outline: none;
        display: flex;
        border-bottom: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
    }

    input {
        background: transparent;
        outline: none;
        font-family: 'Times New Roman', Times;
        text-transform: uppercase;
        font-weight: bold;
    }

    input:active {
        outline: none;
    }

    .direccion {
        width: 90%;
    }

    .solvencia {
        width: 75%;
    }

    .label-bajo {
        border-bottom: none;
    }

    .grid-item:nth-child(1) {
        grid-column: 1/3;
        grid-row: 1/ 2;
    }

    .grid-item:nth-child(2) {
        grid-column: 1/3;
        grid-row: 2/ 3;
    }

    .grid-item:nth-child(3) {
        grid-column: 1/2;
        grid-row: 3/ 4;
    }

    .grid-item:nth-child(4) {
        grid-column: 1/2;
        grid-row: 4/5;
    }

    .grid-item:nth-child(5) {
        grid-column: 2/3;
        grid-row: 3/4;
    }

    .grid-item:nth-child(6) {
        grid-column: 2/3;
        grid-row: 4/5;
    }

    .grid-item:nth-child(7) {
        grid-column: 1/3;
        grid-row: 5/6;
    }

    .grid-item:nth-child(8) {
        grid-column: 1/3;
        grid-row: 6/7;
    }

    .grid-item:nth-child(9) {
        grid-column: 1/3;
        grid-row: 7/8;
        border: 1px, 1px, 1px solid black;
    }

    .grid-item:nth-child(10) {
        grid-column: 1/3;
        grid-row: 8/9;
    }

    .grid-item:nth-child(11) {
        grid-column: 2/3;
        grid-row: 7/8;
        border: 1px, 1px, 1px solid black;
    }

    .grid-item:nth-child(12) {
        grid-column: 2/3;
        grid-row: 8/9;
    }

    .grid-item:nth-child(13) {
        grid-column: 2/3;
        grid-row: 9/10;
    }

    .grid-item:nth-child(14) {
        grid-column: 2/3;
        grid-row: 10/11;
    }

    .none {
        outline: none;
        border: none;
    }

    .box {
        border: 1px solid black;
    }

    .dir {
        width: 100%;
    }

    .sol {
        width: 75%;
    }

    .fecha-apertura {
        float: right;
        font-size: 18px;
        font-weight: 400;
        white-space: nowrap;
        width: auto;
    }

    .parrafo {
        font-size: 15px;
    }

    #num_catastro {
        width: 30px;
    }

    .table-grid-new {
        gap: 0;
        width: 670px;
        font-size: 14px;
        margin: 160px auto 0 auto;
        display: grid;
        grid-template-columns: 1fr 150px 100px;
        /* 2 columnas */
        grid-template-rows: 30px 10px 30px 10px repeat(3, 30px) 20px;
    }

    .item-new {
        display: flex;
    }

    .item-new:first-child {
        grid-column: 2/4;
        grid-row: 1/2;
    }

    .item-new:nth-child(2) {
        grid-column: 1/4;
        grid-row: 3/4;
    }

    .item-new:nth-child(3) {
        grid-column: 1/4;
        grid-row: 5/7;
    }

    .item-new:nth-child(4) {
        grid-column: 3/4;
        grid-row: 7/8;
    }

    .numero-solvencia {
        font-size: 25px;
        font-weight: 900;
        outline: none;
        border: none;
    }

    .numero-solvencia input {
        width: 70px;
        border: none;
        outline: none;
        font-size: 25px;
        font-weight: 700;
        text-align: start;
    }

    .item-new>p {
        font-size: 18px;
        outline: none;
        border: none;
        text-indent: 90px;
        font-weight: 400;
    }

    .detalles-contribuyentes>p {
        font-size: 18px;
        font-weight: 400;
    }

    .detalles-contribuyentes {
        margin: 20px auto 100px auto;
        width: 650px;
        height: 100px;
        display: flex;
        text-align: justify;
        justify-content: center;
        align-items: center;
    }

    .center {
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .detalles-contribuyentes>p>span {
        font-weight: 700;
    }

    .item-new>p>input {
        border: none;
        font-weight: 400;
        font-size: 20px;
        text-align: start;
    }

    .firma {
        width: 210px;
        outline: none;
        border: none;
        border-bottom: 1px solid black;
    }

    .titulo {
        margin: 0 auto;
        align-items: center;
        border: none;

    }

    @media print {

        .oculto-impresion,
        .oculto-impresion * {
            display: none !important;
        }
    }

    .btn {
        background-color: rgb(72, 127, 208);
        /* Green */
        border: none;
        color: white;
        padding: 10px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 2px 2px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: rgba(72, 126, 208, 0.52);
        ;
    }

    /* Estilos para el mensaje de error de validación */
    .error-message {
        color: red;
        font-size: 0.8em;
        margin-top: 2px;
        text-align: center;
        grid-column: 1 / 3;
        /* Para que ocupe todo el ancho de las dos columnas de la tabla-grid */
    }

    .input-error {
        border: 2px solid red !important;
    }
</style>
</head>

<body>
    <?php include_once 'panel_navegacion.php';
    function fecha_actual()
    {
        date_default_timezone_set('America/Caracas');

        // Array con nombres de meses en mayúsculas
        $meses = [
            1 => "ENERO",
            2 => "FEBRERO",
            3 => "MARZO",
            4 => "ABRIL",
            5 => "MAYO",
            6 => "JUNIO",
            7 => "JULIO",
            8 => "AGOSTO",
            9 => "SEPTIEMBRE",
            10 => "OCTUBRE",
            11 => "NOVIEMBRE",
            12 => "DICIEMBRE"
        ];

        $dia = date('j');  // Día sin ceros iniciales
        $mes = $meses[date('n')];  // n = número del mes sin ceros
        $anio = date('Y');

        return "$dia DE $mes DE $anio";
    }
    $fecha_hora = fecha_actual();

    function fecha_desde()
    {
        date_default_timezone_set('America/Caracas');
        $fecha = date('Y-m-d');
        return $fecha;
    }
    $fecha = fecha_desde();

    ?>
    <main>
        <div class="table-grid-new">
            <div class="item-new fecha-apertura">LA FRÍA, <?php echo $fecha_hora; ?> </div>
            <div class="item-new principal center">SOLVENCIA MUNICIPAL</div>
            <div class="item-new">
                <p>Quien suscribe, LCDA LISETT C. GRUESO DE SANCHEZ Otorga la presente Solvencia Municipal a:<input
                        class="propietario" type="text" name="" id=""></p>
            </div>
            <div class="item-new numero-solvencia"><span>No.</span> <input type="text" style="width: 70px;"
                    value="<?php echo $solvencia['id_sol'] + 1; ?>" readonly></div>
        </div>
        <form action="../../Backend/controlador/solvencia.php" method="post" id="solvenciaForm">
            <input type="hidden" name="accion" value="insertar">
            <input type="hidden" name="fky_pat" value="<?php echo $id_pat; ?>">
            <input type="hidden" name="est_sol" value="a">

            <div class="tabla-grid">
                <label class="grid-item label-bajo titulo">REPRESENTANTE LEGAL:</label>
                <input class="grid-item input-box" value="<?php echo $patente['rep_pat']; ?>" readonly></input>

                <label class="grid-item label-bajo ">CEDULA / RIF:</label>
                <input class="grid-item input-box" value="<?php echo $patente['rif_pat']; ?>" readonly></input>
                <label class="grid-item label-bajo">DIRECCION:</label>
                <input class="grid-item input-box" value="<?php echo $patente['ubi_pat']; ?>" readonly></input>

                <label class="grid-item label-bajo titulo">RAZON SOCIAL: </label>
                <input class="grid-item input-box" value="<?php echo $patente['nom_pat']; ?>" readonly></input>

                <label class="grid-item label-bajo">TIPO TRAMITE: </label>
                <input class="grid-item input-box" readonly></input>
                <label class="grid-item label-bajo" readonly>NUMERO PATENTE</label>
                <input class="grid-item input-box" value="<?php echo $patente['num_pat']; ?>" readonly></input>

                <label class="grid-item label-bajo">HASTA:</label>
                <input type="date" class="grid-item input-box" name="fec_ven" id="fec_ven_solvencia" required>
                <label class="grid-item label-bajo">VIGENCIA DESDE:</label>
                <input type="date" class="grid-item input-box" value="<?php echo $fecha; ?>" readonly
                    name="vigencia_desde" id="vigencia_desde"></input>
            </div>


            <div class="detalles-contribuyentes">
                <p>
                    Después de haber revisado y comprobado que el contribuyente antes mencionado no presenta ninguna
                    deuda en el <span id="trimestre-desde"></span> trimestre del año fiscal <span
                        id="anio-desde"></span> con el municipio, de acuerdo al régimen
                    tributario municipal. Se expide SOLVENCIA a solicitud de la parte interesada, con vigencia hasta el
                    <span id="trimestre-hasta"></span> trimestre del año fiscal <span id="anio-hasta"></span>
                </p>
                
            </div>
            <div class="container-firma center">
                <input type="text" class="firma" readonly><br>
                <label for="firma"> DIRECTOR(A) DE RECAUDACIÓN <br> Y TRIBUTOS
                    MUNICIPALES</label>
            </div>
            <button type="submit" class="btn oculto-impresion" value="imprimir"><i class="fas fa-print"></i>
                Imprimir</button>

        </form>
    </main>
    <script>
        function obtenerTrimestreYAnio(fechaStr) {
            if (!fechaStr) return { trimestre: '', nombreTrimestre: '', anio: '' };
            const fecha = new Date(fechaStr);
            const mes = fecha.getMonth() + 1;
            let trimestre = 1, nombreTrimestre = "PRIMER";
            if (mes >= 1 && mes <= 3) { trimestre = 1; nombreTrimestre = "PRIMER"; }
            else if (mes >= 4 && mes <= 6) { trimestre = 2; nombreTrimestre = "SEGUNDO"; }
            else if (mes >= 7 && mes <= 9) { trimestre = 3; nombreTrimestre = "TERCER"; }
            else if (mes >= 10 && mes <= 12) { trimestre = 4; nombreTrimestre = "CUARTO"; }
            return { trimestre, nombreTrimestre, anio: fecha.getFullYear() };
        }

        function actualizarTrimestres() {
            const fechaDesde = document.getElementById('vigencia_desde')?.value;
            const fechaHasta = document.getElementById('fec_ven_solvencia')?.value;

            const desde = obtenerTrimestreYAnio(fechaDesde);
            const hasta = obtenerTrimestreYAnio(fechaHasta);

            document.getElementById('trimestre-desde').textContent = desde.nombreTrimestre;
            document.getElementById('anio-desde').textContent = desde.anio;
            document.getElementById('trimestre-hasta').textContent = hasta.nombreTrimestre;
            document.getElementById('anio-hasta').textContent = hasta.anio;
            document.getElementById('trimestre-hasta-2').textContent = hasta.nombreTrimestre;
            document.getElementById('anio-hasta-2').textContent = hasta.anio;
        }

        document.addEventListener('DOMContentLoaded', actualizarTrimestres);
        document.getElementById('fec_ven_solvencia').addEventListener('change', actualizarTrimestres);


        //CODIGO DUQUE
        document.addEventListener('DOMContentLoaded', function () {
            const solvenciaForm = document.getElementById('solvenciaForm');
            const fechaInput = document.getElementById('fec_ven_solvencia');
            let fechaErrorDiv = document.getElementById('fechaSolvenciaError');

            // Si el div para el mensaje de error no existe, lo creamos dinámicamente
            if (!fechaErrorDiv) {
                fechaErrorDiv = document.createElement('div');
                fechaErrorDiv.id = 'fechaSolvenciaError';
                fechaErrorDiv.className = 'error-message';
                // Insertar el div justo después del input de fecha
                fechaInput.parentNode.insertBefore(fechaErrorDiv, fechaInput.nextSibling);
            }

            solvenciaForm.addEventListener('submit', function(event) {
                // Validación JavaScript para el campo de fecha
                if (fechaInput.value.trim() === '') {
                    event.preventDefault(); // Detiene el envío del formulario si el campo está vacío

                    // Añade clase para resaltar el input y muestra el mensaje de error
                    fechaInput.classList.add('input-error');
                    fechaErrorDiv.textContent = 'Por favor, seleccione una fecha de vencimiento.';
                    fechaInput.focus(); // Pone el foco en el campo para que el usuario lo vea
                    return; // Sale de la función
                } else {
                    // Si el campo está lleno, limpia cualquier estilo o mensaje de error anterior
                    fechaInput.classList.remove('input-error');
                    fechaErrorDiv.textContent = '';
                }

                // Imprimir antes de enviar el formulario
                window.print();
                // El formulario se enviará después de imprimir
            });
        });
    </script>

</body>

</html>