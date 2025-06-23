<?php include_once 'header.php';

function fecha_actual()
{
    date_default_timezone_set('america/caracas');
    $fecha_hora = date('Y-m-d');
    return $fecha_hora;
}
$fecha_hora = fecha_actual();


?>
<link rel="stylesheet" href="../estilos/css/style.css">
<title>Formulario de Registro</title>
<style>
    * {
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    body {
        background-color: #f5f5f5;
        background-repeat: no-repeat;
        background-position: center top;
        margin: 0;
        padding: 20px;
    }

    .sidebar ul li a:hover {
        background-color: #34495e;
        cursor: pointer;
    }

    .registration-form {
        max-width: 800px;
        margin: 50px auto;
        background-image: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)), url('../estilos/img/logo_alcaldia_la_fria.png');
        background-repeat: no-repeat, no-repeat;
        background-size: cover, contain;
        /* Ajusta según necesites */
        background-position: center, center;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-title {
        text-align: center;
        color: #333;
        margin-bottom: 10px;
    }

    .form-description {
        text-align: center;
        color: #666;
        margin-bottom: 30px;
        font-size: 14px;
        line-height: 1.5;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .section-title {
        color: #333;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
        margin-bottom: 20px;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }

    .form-group {
        flex: 1;
        min-width: 250px;
        margin-right: 20px;
        margin-bottom: 10px;
    }

    .form-group:last-child {
        margin-right: 0;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="date"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .phone-options {
        display: flex;
        align-items: center;
        margin-top: 5px;
    }

    .phone-options span {
        margin-right: 15px;
        display: flex;
        align-items: center;
    }

    .phone-options input[type="radio"] {
        margin-right: 5px;
    }

    .divider {
        border-top: 1px solid #ddd;
        margin: 30px 0;
    }

    .sidebar ul li a:nth-child(2) {
        background-color: #34495e;
        cursor: pointer;
    }

    button {
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        background-color: #007bff;
        /* Color azul para el botón */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin-right: 10px;
        height: 45px;
        /* Espaciado entre botones */
    }

    button:hover {
        background-color: rgb(74, 75, 77);
        /* Color más oscuro al pasar el mouse */
        transform: scale(1.05);
        /* Efecto de agrandamiento */
    }

    button:last-child {
        background-color: rgb(74, 75, 77);
        /* Color rojo para el botón de limpiar */
    }

    button:last-child:hover {
        background-color: #c82333;
        /* Color más oscuro para el botón de limpiar */
    }

    .date input[type="date"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    /* Añade esto a tu sección de estilos */
    .dates {
        align-items: flex-end;
        /* Alinea todos los elementos por la parte inferior */
    }

    .dates .form-group {
        flex: 0 0 100px;
        /* Ancho fijo para los campos de fecha */
        margin-right: 10px;
    }

    .dates button {
        margin: 0;
        margin-left: 10px;
        height: 40px;
        /* Ajusta la altura para que coincida con los inputs */
        flex: 0 0 auto;
        /* Permite que los botones mantengan su ancho natural */
        padding: 0 15px;
        /* Ajusta el padding horizontal */
    }
</style>
</head>

<body>
    <main>
        <?php include_once 'panel_navegacion.php'; ?>
        <div class="registration-form">
            <h1 class="form-title">REGISTRO DE PATENTE</h1>
            <p class="form-description">
                Patentar es asegurar el futuro de su invento: protección legal y reconocimiento de autoría.
            </p>

            <form action="../../Backend/controlador/patente.php" method="POST">
                <input type="hidden" name="accion" value="insertar">

                <input type="hidden" name="fky_usu" value="<?php echo $_SESSION['id_usu']; ?>">
                <!-- Registra el usuario que tramito una nueva patente -->

                <div class="form-section">
                    <div class="form-row">

                        <div class="form-group">
                            <label for="fecha_apertura">Fecha de Apertura:</label>
                            <input type="text" id="fecha_apertura" name="fec_pat" value="<?php echo $fecha_hora; ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="numero_exp">Numero de Patente:</label>
                            <input type="text" id="num_pat" name="num_pat" inputmode="numeric" pattern="[0-9]{1,6}"
                                placeholder="Hasta 6 dígitos" title="Por favor, introduce el número de patente"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);" required>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="razon_social">Razón Social:</label>
                            <input type="text" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+"
                                Placeholder="Solo se permiten letras y espacios." required
                                oninput="this.value = this.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '');"
                                id="razon_social" name="nom_pat" required>
                        </div>
                        <div class="form-group">
                            <label for="representante_legal">Representante Legal:</label>
                            <input pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" Placeholder="Solo se permiten letras y espacios."
                                required oninput="this.value = this.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '');"
                                type="text" id="representante_legal" name="rep_pat" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cedula_rif">Cédula o RIF:</label>
                            <input type="text" id="cedula_rif" name="rif_pat" inputmode="text"
                                pattern="[VJEvje][-]?[0-9]{7,12}" placeholder="Ej: V-123456789"
                                title="Debe empezar con V, J o E, seguido de un guion opcional y hasta 12 dígitos.">
                        </div>

                        <div class="form-group">
                            <label for="ubicacion">Ubicación:</label>
                            <input type="text" id="ubicacion" name="ubi_pat" required>
                        </div>
                        <div class="form-group">
                            <label for="rubro">Descripcion de actividad:</label>
                            <input type="text" id="rubro" name="rub_pat" required>

                        </div>

                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select id="estado" name="est_pat" required>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="form-section">

                    <button type="submit">Registrar</button>
                    <button type="reset">LIMPIAR</button>
                </div>
        </div>
        </form>

        </div>

    </main>
    <?php include_once 'footer.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Función para formatear y validar la cédula/RIF en tiempo real
            window.formatearCedulaRif = function (input) {
                let valor = input.value.toUpperCase(); // Convertir todo a mayúsculas

                let resultado = '';
                let tieneGuion = false;
                let numerosContados = 0;

                if (valor.length > 0) {
                    // Paso 1: Procesar el primer carácter (letra V, J, E)
                    const primerChar = valor.charAt(0);
                    if (primerChar === 'V' || primerChar === 'J' || primerChar === 'E') {
                        resultado += primerChar;
                    } else {
                        // Si el primer carácter no es válido, no agregamos nada y salimos.
                        input.value = '';
                        return;
                    }

                    // Paso 2: Procesar el resto de la cadena
                    for (let i = 1; i < valor.length; i++) {
                        const char = valor.charAt(i);

                        // Si encontramos un guion
                        if (char === '-') {
                            if (!tieneGuion && numerosContados === 0) { // Solo un guion y antes de los números
                                resultado += char;
                                tieneGuion = true;
                            }
                        }
                        // Si encontramos un número
                        else if (char >= '0' && char <= '9') {
                            if (numerosContados < 12) { // Limitar a 12 números
                                resultado += char;
                                numerosContados++;
                            }
                        }
                        // Cualquier otro carácter no se añade
                    }
                }
                input.value = resultado; // Actualizar el valor del input
            };

            // Si tienes otros inputs con oninput, asegúrate de que sus IDs sean únicos
            // y que no colisionen con 'cedula_rif'.

            // Script para el campo de número de patente (ejemplo previo)
            const numeroPatenteInput = document.getElementById('numero_patente');
            if (numeroPatenteInput) {
                numeroPatenteInput.addEventListener('input', function () {
                    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);
                });
            }
        });
    </script>
</body>

</html>