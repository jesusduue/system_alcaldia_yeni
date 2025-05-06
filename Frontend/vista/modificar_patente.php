<?php include_once 'header.php';
require_once('../../Backend/clase/patente_class.php');
$obj_patente = new patente;
$obj_patente->asignar_valor();
$obj_patente->puntero= $obj_patente->mostrar_patente();
$patente=$obj_patente->extraer_dato();
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
    background-size: cover, contain; /* Ajusta según necesites */
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
            <h1 class="form-title">ACTUALIZAR PATENTE</h1>
            <p class="form-description">
                Patentar es asegurar el futuro de su invento: protección legal y reconocimiento de autoría.
            </p>

            <form action="../../Backend/controlador/patente.php" method="POST">
                <input type="hidden" name="accion" value="modificar">
                <input type="hidden" name="id_pat" value="<?php echo $patente['id_pat']; ?>">

                <input type="hidden" name="fky_usu" value="<?php echo $_SESSION['id_usu']; ?>"> <!-- Registra el usuario que tramito una nueva patente -->
             
                <div class="form-section">
                    <div class="form-row">

                        <div class="form-group">
                            <label for="fecha_apertura">Fecha de Apertura:</label>
                            <input type="text" id="fecha_apertura" name="fec_pat" value="<?php echo $patente['fec_pat']; ?>" readonly>
                            </div>
                            <div class="form-group">
                            <label for="numero_exp">Numero de Patente:</label>
                            <input type="text" id="numero_exp" name="num_pat" value="<?php echo $patente['num_pat']; ?>" required>
                        </div>
                        
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="razon_social">Razón Social:</label>
                            <input type="text" id="razon_social" name="nom_pat" value="<?php echo $patente['nom_pat']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="representante_legal">Representante Legal:</label>
                            <input type="text" id="representante_legal" name="rep_pat"  value="<?php echo $patente['rep_pat']; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cedula_rif">Cédula o RIF:</label>
                            <input type="text" id="cedula_rif" name="rif_pat" value="<?php echo $patente['rif_pat']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="ubicacion">Ubicación:</label>
                            <input type="text" id="ubicacion" name="ubi_pat" value="<?php echo $patente['ubi_pat']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="rubro">Rubro:</label>
                            <input type="text" id="rubro" name="rub_pat" value="<?php echo $patente['rub_pat']; ?>" required>

                        </div>
                        
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <input type="text" id="estado" name="est_pat" value="<?php echo $patente['est_pat']; ?>" required>
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
</body>

</html>