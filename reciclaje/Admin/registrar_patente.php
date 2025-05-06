<?php include_once './layout/header.php'; ?> 
<link rel="stylesheet" href="../public/css/style.css">
<title>Formulario de Registro</title>
<style>
     * {
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    body {
        background-color: #f5f5f5;
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
    background-image: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)), url('../public/img/logo_alcaldia_la_fria.png');
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
        flex: 0 0 150px;
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
        <?php include_once './layout/nav.php'; ?>

        <div class="registration-form">
            <h1 class="form-title">REGISTRO DE PATENTE</h1>
            <p class="form-description">
                Patentar es asegurar el futuro de su invento: protección legal y reconocimiento de autoría.
            </p>

            <form action="Controllers/controlador_patente.php" method="POST">
                <input type="hidden" name="accion" value="insertar">

                <div class="form-section">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="numero_exp">Numero de Patente:</label>
                            <input type="text" id="numero_exp" name="numero_exp">
                        </div>
                        <div class="form-group">
                            <label for="fecha_apertura">fecha de apertura:</label>
                            <input type="date" id="fecha_apertura" name="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="razon_social">razón social:</label>
                            <input type="text" id="razon_social" name="razon_so">
                        </div>
                        <div class="form-group">
                            <label for="representante_legal">representante Legal:</label>
                            <input type="text" id="representante_legal" name="rep_legal">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cedula_rif">cédula o RIF:</label>
                            <input type="text" id="cedula_rif" name="ced_rif">
                        </div>
                        <div class="form-group">
                            <label for="ubicacion">ubicación:</label>
                            <input type="text" id="ubicacion" name="ubicacion">
                        </div>
                        <div class="form-group">
                            <label for="rubro">Rubro:</label>
                            <input type="text" id="rubro" name="rubro">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <input type="text" id="estado" name="estado">
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="form-section">
                   <!--  <h2 class="section-title">Validación</h2>
                    <div class="form-row dates">
                        <div class="form-group">
                            <label for="fecha_inicio">Desde:</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio">
                        </div>
                        <div class="form-group">
                            <label for="fecha_fin">Hasta:</label>
                            <input type="date" id="fecha_fin" name="fecha_fin">
                        </div> -->
                        <button type="submit">Registrar</button>
                        <button type="reset">LIMPIAR</button>
                    </div>
                </div>
            </form>
            
        </div>
    </main>
    <?php include_once './layout/footer.php'; ?>