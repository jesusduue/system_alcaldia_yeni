<?php include_once 'header.php';

require_once('../../Backend/clase/patente_class.php');

$obj_patente = new patente;
$obj_patente->asignar_valor();
$obj_patente->puntero = $obj_patente->mostrar_patente();
$patente = $obj_patente->extraer_dato();
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
/* if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obj_patente->id_pat = $id_pat;
    $obj_patente->num_pat = $_POST['num_pat'];
    $obj_patente->nom_pat = $_POST['nom_pat'];
    $obj_patente->rep_pat = $_POST['rep_pat'];
    $obj_patente->rif_pat = $_POST['rif_pat'];
    $obj_patente->ubi_pat = $_POST['ubi_pat']; /// CODIGO PARA MODIFICAR VALORES DE LA PATENTE
    $obj_patente->rub_pat = $_POST['rub_pat'];
    $obj_patente->est_pat = $_POST['est_pat'];

    $resultado = $obj_patente->modificar();

    if ($resultado) {
        echo "<script language='javascript'>
            alert('patente modificado correctamente');
            document.location='../listado.patente.php';
            </script>";
    } else {
        echo "Error al modificar el producto.";
    }
} */
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
    <link rel="stylesheet" href="../estilos/css/style.css">
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
            /* border: 2px solid #000; */
            border-radius: 70px;
            padding: 15px;
            box-sizing: border-box;
            position: relative;
            /* estilos para imagen de fondo */

            background-size: cover, contain;
            /* Ajusta según necesites */
            background-position: center, center;

            /* For absolute positioning of logos */
            background-color: #ffffff;


            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .header {
            display: grid;
            grid-template-columns: auto 1fr auto;
            /* Left, Center, Right */
            align-items: center;
            text-align: center;
            margin-bottom: 10px;
        }

        .logo-left {
            width: 100px;
            height: 60px;
            background-image: linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 0)), url('../estilos/img/logo_alcaldia_la_fria.png');
            background-repeat: no-repeat, no-repeat;
            background-size: cover, contain;
            /* Ajusta según necesites */
            background-position: center, center;
        }


        .logo-right {
            width: 60px;
            /* Adjust logo size */
            height: 60px;
            border: 1px solid #000;
            border-radius: 20px;

            /* Placeholder border */
            /* You'll need to add your actual logo images here */
        }

        .header-text {
            width: 450px;
            height: auto;
            font-size: 0.8em;
            line-height: 1.2;
            font-family: Courier New;
            font-weight: bold;
            text-align: center; /* Asegura que el contenido de header-text esté centrado */
        }

        /* --- INICIO DE MODIFICACIONES CSS PARA CENTRAR Y EXPANDIR --- */
        .header-text .direccion {
            color: red;
            font-weight: bold;
            font-size: 0.9em;
            display: block; /* Hace que el span se comporte como un bloque para poder centrar su contenido */
            width: 100%; /* Asegura que ocupe todo el ancho disponible para centrado */
            text-align: center; /* Centra el texto dentro de este span */
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
        .direccion, /* Esta clase se usa aquí para la sección de campos, no confundir con el span.direccion */
        .actividad {
            margin-bottom: 5px;
            display: flex; /* Convierte estos contenedores en Flex containers */
            align-items: center; /* Alinea verticalmente el texto y el input */
            /* Añade un pequeño margen a la derecha del texto de la etiqueta */
            padding-right: 10px;
            white-space: nowrap; /* Evita que el texto de la etiqueta se rompa en varias líneas */
        }

        /* Estilos para que los inputs dentro de estas secciones tomen el espacio restante */
        .contribuyente input,
        .representante input,
        .direccion input,
        .actividad input {
            flex-grow: 1; /* ¡Esta es la clave para que el input ocupe el resto del espacio! */
            width: 100%; /* Asegura que el input ocupe el 100% del espacio que flex-grow le permite */
            padding: 2px;
            border: 1px solid #000;
            font-size: 0.8em;
            box-sizing: border-box;
            border: none; /* Mantengo tus estilos originales */
            outline: none; /* Mantengo tus estilos originales */
            border-bottom: #000 2px solid; /* Mantengo tus estilos originales */
            background: local; /* Mantengo tus estilos originales */
        }
        /* --- FIN DE MODIFICACIONES CSS --- */

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
            display: flex;
            flex-direction: column; /* Apila el contenido verticalmente */
            justify-content: flex-end; /* Alinea el contenido hacia abajo */
            align-items: center; /* Centra horizontalmente el contenido */
            font-size: 0.6em; /* **La mitad del tamaño original (de 1.2em a 0.6em)** */
            text-align: center; /* Asegura el centrado del texto */
            border: none; /* Eliminamos el borde del contenedor de texto */
            position: relative; /* Necesario para posicionar la línea */
            padding-top: 15px; /* Espacio para la línea si no se ajusta con margin-top */
        }

        .month.big-text .firma-linea {
            position: absolute;
            top: 65px; /* Ajusta este valor para mover la línea más arriba o abajo */
            left: 50%;
            transform: translateX(-50%);
            width: 80%; /* Ancho de la línea */
            border-top: 1px solid #000;
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
        .header-text .direccion, /* Este selector ahora apunta a una clase específica en el span */
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

        /* Esta regla es redundante con las nuevas reglas específicas para .campos input,
           pero la dejo por si tiene alguna intención global que no se ve afectada
           por las nuevas. Si las nuevas reglas son suficientes, se podría eliminar. */
        .campos input {
            font-family: Courier New;
            font-weight: bold;
            /* border: none; */ /* Ya definido arriba */
            /* outline: none; */ /* Ya definido arriba */
            /* border-bottom: #000 2px solid; */ /* Ya definido arriba */
            /* background: local; */ /* Ya definido arriba */
        }

        @media print {
            .oculto-impresion,
            .oculto-impresion * {
                display: none !important;
            }

            .license {
                background-color: #007bff;
                color: white;
            }

            .license:hover {
                background-color: #0056b3;
            }
        }
        /* Estilos para el mensaje de error de validación */
        .error-message {
            color: red;
            font-size: 0.8em;
            margin-top: 2px;
            /* Pequeño espacio debajo del input */
            text-align: center; /* Centra el mensaje de error si el input es centrado */
            /* Puedes añadir más estilos si quieres, ej. font-weight: bold; */
        }
        .input-error {
            border: 2px solid red !important; /* Resalta el borde del input con error */
        }
    </style>
</head>

<body>
    <?php include_once 'panel_navegacion.php';
    function fecha_actual()
    {
        date_default_timezone_set('America/Caracas'); // Aseguramos la zona horaria de Venezuela
        $fecha_hora = date('Y-m-d');
        return $fecha_hora;
    }
    $fecha_hora = fecha_actual();
    ?>


    <div class="licencia-container ">
        <form id="licenciaForm" action="../../Backend/controlador/licencia.php" method="POST">
            <input type="hidden" name="accion" value="insertar">

            <input type="hidden" name="fky_pat" value="<?php echo $id_pat; ?>">
            <input type="hidden" name="est_lic" value="a">
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
                <div class="logo-right">FOTO
                </div>
            </div>

            <div class="rif-patente campos" readonly>
                RIF:
                <input type="text" id="rif" name="rif" value="<?php echo isset($patente['rif_pat']) ? htmlspecialchars($patente['rif_pat']) : ''; ?>"  readonly>
                <span class="pat">Patente No.:</span>
                <input type="text" id="patente" name="patente" value="<?php echo isset($patente['num_pat']) ? htmlspecialchars($patente['num_pat']) : ''; ?>">
                <div class="year-box">2025</div>
            </div>

            <div class="contribuyente campos">
                Nombre del Contribuyente:
                <input type="text" id="nombre" name="nombre" value="<?php echo isset($patente['nom_pat']) ? htmlspecialchars($patente['nom_pat']) : ''; ?>"  readonly>
            </div>

            <div class="representante campos">
                Representante Legal:
                <input type="text" id="representante" name="representante"
                    value="<?php echo isset($patente['rep_pat']) ? htmlspecialchars($patente['rep_pat']) : ''; ?>"  readonly>
            </div>

            <div class="direccion campos">
                Dirección:
                <input type="text" id="direccion" name="direccion" value="<?php echo isset($patente['ubi_pat']) ? htmlspecialchars($patente['ubi_pat']) : ''; ?>">
            </div>

            <div class="actividad campos">
                Descripción Actividad:
                <input type="text" id="actividad" name="actividad"
                    value="<?php echo isset($patente['rub_pat']) ? htmlspecialchars($patente['rub_pat']) : ''; ?>"  readonly>
            </div>

            <div class="months-grid">
                <div class="month">Enero<br>Recibo No.<br><input type="text" name="enero_recibo"> / <input type="text"
                            name="enero_slash"> / <input type="text" name="enero_year"  readonly></div>
                <div class="month">Febrero<br>Recibo No.<br><input type="text" name="febrero_recibo"> / <input type="text"
                            name="febrero_slash"> / <input type="text" name="febrero_year"  readonly></div>
                <div class="month">Marzo<br>Recibo No.<br><input type="text" name="marzo_recibo"> / <input type="text"
                            name="marzo_slash"> / <input type="text" name="marzo_year"  readonly></div>
                <div class="month">Abril<br>Recibo No.<br><input type="text" name="abril_recibo"> / <input type="text"
                            name="abril_slash"> / <input type="text" name="abril_year"  readonly></div>
                <div class="month">Mayo<br>Recibo No.<br><input type="text" name="mayo_recibo"> / <input type="text"
                            name="mayo_slash"> / <input type="text" name="mayo_year"  readonly></div>
                <div class="month">Junio<br>Recibo No.<br><input type="text" name="junio_recibo"> / <input type="text"
                            name="junio_slash"> / <input type="text" name="junio_year"  readonly></div>
                <div class="month big-text">
                    <div class="firma-linea"></div> DIRECTOR(A) DE RECAUDACIÓN Y <br>TRIBUTOS MUNICIPALES
                </div>
                <div class="month">Julio<br>Recibo No.<br><input type="text" name="julio_recibo"> / <input type="text"
                            name="julio_slash"> / <input type="text" name="julio_year"  readonly></div>
                <div class="month">Agosto<br>Recibo No.<br><input type="text" name="agosto_recibo"> / <input type="text"
                            name="agosto_slash"> / <input type="text" name="agosto_year"  readonly></div>
                <div class="month">Septiembre<br>Recibo No.<br><input type="text" name="septiembre_recibo"> / <input
                            type="text" name="septiembre_slash"> / <input type="text" name="septiembre_year"  readonly></div>
                <div class="month">Octubre<br>Recibo No.<br><input type="text" name="octubre_recibo"> / <input type="text"
                            name="octubre_slash"> / <input type="text" name="octubre_year"  readonly></div>
                <div class="month">Noviembre<br>Recibo No.<br><input type="text" name="noviembre_recibo"> / <input
                            type="text" name="noviembre_slash"> / <input type="text" name="noviembre_year"  readonly></div>
                <div class="month">Diciembre<br>Recibo No.<br><input type="text" name="diciembre_recibo" > / <input
                            type="text" name="diciembre_slash"> / <input type="text" name="diciembre_year"  readonly></div>
                <div class="month big-text"></div>
            </div>

            <div class="area-timbre">
                AREA PARA LOS TIMBRES FISCALES Y SELLOS
            </div>

            <div class="bottom-info">
                <div class="place-date">La Fría Edo. Táchira</div>
                <div class="coloque">COLOQUESE EN <br> LUGAR VISIBLE</div>

                <div class="validity">
                    VALIDO A PARTIR EL:
                    <input type="date" id="valido_desde" name="valido_desde" value="<?php echo $fecha_hora; ?>" readonly>
                    HASTA:
                    <input type="date" id="valido_hasta" name="fec_ven" required>
                    <div id="fechaError" class="error-message"></div>
                </div>
                <div class="nota">
                    NOTA: Al cesar este negocio, devuelva este permiso con una carta, participando el caso, así mismo cuando
                    se mude o cambie de Propietario notifiquelo por escrito para fines de ley.
                </div>
                <div class="directora">
                    <br>
                </div>
            </div>
            <button type="submit" class="btn oculto-impresion" value="imprimir"><i class="fas fa-print"></i> Imprimir</button>
        </form>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const licenciaForm = document.getElementById('licenciaForm');
            const fechaInput = document.getElementById('valido_hasta');
            const fechaErrorDiv = document.getElementById('fechaError'); // El div que agregamos para el mensaje de error

            // Manejador del evento 'submit' del formulario
            licenciaForm.addEventListener('submit', function(event) {
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

                // Si la validación es exitosa, se procede a imprimir
                window.print();
                document.location='../../vista/Frontend/listado_patente.php';

                // Si la intención es SOLO imprimir y NO enviar el formulario, descomenta la siguiente línea:
                // event.preventDefault();
            });
        });
    </script>

</body>

</html>