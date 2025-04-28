<?php include_once './layout/header_licencia.php';

require_once('class/patente.class.php');

$obj_patente = new patente;

if (isset($_GET['id_pate'])) {
    $id_pate = $_GET['id_pate'];

    $patente = $obj_patente->obtenerPorCodigo($id_pate);

    if (!$patente) {
        echo "Patente no encontrado.";
        exit;
    }
} else {
    echo "Código de patente no proporcionado.";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obj_patente->id_pate = $id_pate;
    $obj_patente->numero_exp = $_POST['numero_exp'];
    $obj_patente->razon_so = $_POST['razon_so'];
    $obj_patente->rep_legal = $_POST['rep_legal'];
    $obj_patente->ced_rif = $_POST['ced_rif'];
    $obj_patente->ubicacion = $_POST['ubicacion'];
    $obj_patente->rubro = $_POST['rubro'];
    $obj_patente->estado = $_POST['estado'];
    
    $resultado = $obj_patente->modificar();

    if ($resultado) {
        echo "<script language='javascript'>
              alert('patente modificado correctamente');
              document.location='../listado.patente.php';
              </script>";
    } else {
        echo "Error al modificar el producto.";
    }
}
// Verificar el rol del usuario y redirigir si no es un administrador
if (!isset($_SESSION["rol"]) || ($_SESSION["rol"] !== "admin")) {
    header("Location:../../index.php"); // Redirige a la página de inicio de sesión si no cumple con los requisitos
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licencia de Actividades Económicas</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <!-- <link rel="icon" href="../../../public/img/logo_alcaldia_la_fria.png" type="image/x-icon"> -->
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
            /* Light gray background */
        }

        .licencia-container {
            width: 80%;
            /* Adjust as needed */
            max-width: 700px;
            /* Maximum width */
            background-color: #fff;
            border: 6px solid #000;
            border-radius: 70px;
            padding: 15px;
            box-sizing: border-box;
            position: relative;
            /* For absolute positioning of logos */
        }

        .header {
            display: grid;
            grid-template-columns: auto 1fr auto;
            /* Left, Center, Right */
            align-items: center;
            text-align: center;
            margin-bottom: 10px;
        }

        .logo-left,
        .logo-right {
            width: 60px;
            /* Adjust logo size */
            height: 60px;
            border: 1px solid #000;
            /* Placeholder border */
            /* You'll need to add your actual logo images here */
        }

        .header-text {
            font-size: 0.8em;
            line-height: 1.2;
            font-family: Courier New;
            font-weight: bold;
        }

        .rif-patente {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .rif-patente input,
        .rif-patente .year-box {
            padding: 2px;
            border: 1px solid #000;
            font-size: 0.8em;
        }

        .rif-patente .year-box {
            width: 40px;
            /* Width for "202" box */
            text-align: center;
        }

        .contribuyente,
        .representante,
        .direccion,
        .actividad {
            margin-bottom: 5px;
        }

        .contribuyente input,
        .representante input,
        .direccion input,
        .actividad input {
            width: 50%;
            padding: 2px;
            border: 1px solid #000;
            font-size: 0.8em;
            box-sizing: border-box;
        }

        .months-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            /* 7 columns */
            grid-gap: 2px;
            text-align: center;
            font-size: 0.6em;
            margin-bottom: 5px;
        }

        .month {
            border: 1px solid #000;
            padding: 2px;
        }

        .month input {
            width: 20px;
            padding: 1px;
            border: 1px solid #000;
            font-size: 0.6em;
            box-sizing: border-box;
            text-align: center;
        }

        .month.big-text {
            grid-column: 7;
            /* Span full width */
            grid-row: 1 / 3;
            /* Span two rows */
            font-size: 1.2em;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .area-timbre {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            text-align: center;
            font-size: 0.7em;
            padding: 2px;
            margin-bottom: 5px;
        }

        .bottom-info {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-gap: 5px;
            font-size: 0.7em;
        }

        .place-date {
            text-align: left;
        }

        .coloque {
            text-align: center;
            font-weight: bold;
            font-size: 0.9em;
            color: red;
            border: red 5px solid;
            border-radius: 10px;
            padding: 5px;
            font-family: Cambria;
            position: relative;
            left: -px;

        }

        .validity {
            text-align: center;
        }

        .validity input {
            width: 80px;
            padding: 2px;
            border: 1px solid #000;
            font-size: 0.7em;
            box-sizing: border-box;
            text-align: center;
        }

        .nota {
            text-align: left;
            grid-column: 1 / 4;
            /* Span full width */
        }

        .directora {
            text-align: right;
        }

        .campos {
            font-family: Times New Roman;
        }

        /* Media Query for Responsiveness (adjust as needed) */
        @media (max-width: 600px) {
            .licencia-container {
                width: 95%;
            }

            .header-text {
                font-size: 0.7em;
            }

            .months-grid {
                grid-template-columns: repeat(4, 1fr);
                /* Adjust columns on smaller screens */
            }

            .month.big-text {
                grid-column: 1 / 5;
                grid-row: auto;
            }

            .bottom-info {
                grid-template-columns: 1fr;
                /* Stack columns */
                text-align: center;
            }

        }

        br span,
        .header-text .direccion,
        .nota,
        .pat {
            color: red;
            font-weight: bold;
            font-size: 0.9em;
        }

        .month input {
            outline: none;
            border: none;
        }

        .campos input {
            font-family: Courier New;
            border: none;
            outline: none;
            border-bottom: #000 2px solid;

        }
    </style>
</head>

<body>
<?php include_once './layout/nav.php'; ?>
    <div class="licencia-container">

        <div class="header">
            <div class="logo-left">
            </div>
            <div class="header-text">
                REPUBLICA BOLIVARIANA DE VENEZUELA <br>
                ESTADO TACHIRA <br>
                ALCALDIA DEL MUNICIPIO GARCIA DE HEVIA <br>
                <span class="direccion">DIRECCION DE HACIENDA <br>
                    Licencia de Actividades Económicas</span>

            </div>
            <div class="logo-right">
            </div>
        </div>

        <div class="rif-patente campos">
            RIF: 
            <input type="text" id="rif" name="rif" value="<?php echo isset($patente['ced_rif']) ? htmlspecialchars($patente['ced_rif']) : ''; ?>">

            <span class="pat">Patente No.:</span>
            <input type="text" id="patente" name="patente" value="<?php echo isset($patente['numero_exp']) ? htmlspecialchars($patente['numero_exp']) : ''; ?>">
            <div class="year-box">202</div>
        </div>

        <div class="contribuyente campos">
            Razón Social: 
            <input type="text" id="nombre" name="nombre" value="<?php echo isset($patente['razon_so']) ? htmlspecialchars($patente['razon_so']) : ''; ?>">
        </div>

        <div class="representante campos">
            Representante Legal: 
            <input type="text" id="representante" name="representante"
                value="<?php echo isset($patente['rep_legal']) ? htmlspecialchars($patente['rep_legal']) : ''; ?>">
        </div>

        <div class="direccion campos">
            Dirección: 
            <input type="text" id="direccion" name="direccion"  value="<?php echo isset($patente['ubicacion']) ? htmlspecialchars($patente['ubicacion']) : ''; ?>">
        </div>

        <div class="actividad campos">
            Descripción Actividad:
            <input type="text" id="actividad" name="actividad"
                value="<?php echo isset($patente['rubro']) ? htmlspecialchars($patente['rubro']) : ''; ?>">
        </div>

        <div class="months-grid">
            <div class="month">Enero<br>Recibo No.<br><input type="text" name="enero_recibo"> / <input type="text"
                    name="enero_slash"> / <input type="text" name="enero_year"></div>
            <div class="month">Febrero<br>Recibo No.<br><input type="text" name="febrero_recibo"> / <input type="text"
                    name="febrero_slash"> / <input type="text" name="febrero_year"></div>
            <div class="month">Marzo<br>Recibo No.<br><input type="text" name="marzo_recibo"> / <input type="text"
                    name="marzo_slash"> / <input type="text" name="marzo_year"></div>
            <div class="month">Abril<br>Recibo No.<br><input type="text" name="abril_recibo"> / <input type="text"
                    name="abril_slash"> / <input type="text" name="abril_year"></div>
            <div class="month">Mayo<br>Recibo No.<br><input type="text" name="mayo_recibo"> / <input type="text"
                    name="mayo_slash"> / <input type="text" name="mayo_year"></div>
            <div class="month">Junio<br>Recibo No.<br><input type="text" name="junio_recibo"> / <input type="text"
                    name="junio_slash"> / <input type="text" name="junio_year"></div>
            <div class="month big-text">FEJHF<br>FFFFFE</div>
            <div class="month">Julio<br>Recibo No.<br><input type="text" name="julio_recibo"> / <input type="text"
                    name="julio_slash"> / <input type="text" name="julio_year"></div>
            <div class="month">Agosto<br>Recibo No.<br><input type="text" name="agosto_recibo"> / <input type="text"
                    name="agosto_slash"> / <input type="text" name="agosto_year"></div>
            <div class="month">Septiembre<br>Recibo No.<br><input type="text" name="septiembre_recibo"> / <input
                    type="text" name="septiembre_slash"> / <input type="text" name="septiembre_year"></div>
            <div class="month">Octubre<br>Recibo No.<br><input type="text" name="octubre_recibo"> / <input type="text"
                    name="octubre_slash"> / <input type="text" name="octubre_year"></div>
            <div class="month">Noviembre<br>Recibo No.<br><input type="text" name="noviembre_recibo"> / <input
                    type="text" name="noviembre_slash"> / <input type="text" name="noviembre_year"></div>
            <div class="month">Diciembre<br>Recibo No.<br><input type="text" name="diciembre_recibo"> / <input
                    type="text" name="diciembre_slash"> / <input type="text" name="diciembre_year"></div>
            <div class="month big-text">HWJGHG</div>
        </div>

        <div class="area-timbre">
            AREA PARA LOS TIMBRES FISCALES Y SELLOS
        </div>

        <div class="bottom-info">
            <div class="place-date">La Fría Edo. Táchira</div>
            <div class="coloque">COLOQUESE EN <br> LUGAR VISIBLE</div>
            <div class="validity">
                VALIDO A PARTIR EL: <input type="text" id="valido_desde" name="valido_desde" value="01-07-2022"
                    placeholder="01-07-2022"> hasta: <input type="text" id="valido_hasta" name="valido_hasta"
                    value="31-12-2022" placeholder="31-12-2022">
            </div>
            <div class="nota">
                NOTA: Al cesar este negocio, devuelva este permiso con una carta, participando el caso, así mismo cuando
                se mude o cambie de Propietario notifiquelo por escrito para fines de ley.
            </div>
            <div class="directora">
               <br>
                DIRECTORA DE HACIENDA Y <br>
                RECAUDACION
            </div>
        </div>

    </div>

</body>

</html>