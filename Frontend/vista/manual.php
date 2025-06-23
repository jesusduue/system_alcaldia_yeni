<?php include_once 'header.php';

require('../../Backend/clase/patente_class.php');
$obj_patente = new patente;
/* $obj_patente->id_pat="id_pat"; */
$obj_patente->puntero = $obj_patente->listar();

?>

<title>MANUAL - SistemaPat</title>
<link rel="stylesheet" href="../estilos/css/style.css">
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

    i:hover {
        transform: scale(2, 2);
    }

    .container-manual-description {
        width: 800px;
        height: 400px;
        position: relative;
        top: 70px;
        left: 280px;
    }

    /* Contenedor principal del acordeón */
    .accordion-container {
        margin: 20px auto;
        /* Centra el acordeón */
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        /* Importante para que la transición funcione bien */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Estilo de cada ítem del acordeón */
    .accordion-item {
        border-bottom: 1px solid #eee;
    }

    /* Quita el borde inferior del último ítem para una mejor estética */
    .accordion-item:last-child {
        border-bottom: none;
    }

    /* Estilo del encabezado/botón de cada ítem */
    .accordion-header {
        background-color: #f9f9f9;
        color: #333;
        cursor: pointer;
        padding: 15px 25px;
        width: 100%;
        text-align: left;
        border: none;
        outline: none;
        font-size: 1.1em;
        font-weight: 600;
        display: flex;
        /* Para alinear el texto y la flecha */
        justify-content: space-between;
        /* Empuja la flecha a la derecha */
        align-items: center;
        transition: background-color 0.3s ease;
        /* Suaviza el cambio de color al pasar el mouse */
    }

    /* Cambio de color al pasar el mouse o al estar activo */
    .accordion-header:hover,
    .accordion-header.active {
        background-color: #e0e0e0;
    }

    /* Estilo de la flechita */
    .arrow-icon {
        font-size: 0.8em;
        transition: transform 0.3s ease;
        /* Suaviza la rotación de la flecha */
        margin-left: 15px;
        /* Espacio entre el texto y la flecha */
        color: #666;
    }

    /* Rotar la flecha cuando el encabezado está activo (abierto) */
    .accordion-header.active .arrow-icon {
        transform: rotate(180deg);
    }

    /* Estilo del contenido oculto por defecto */
    .accordion-content {
        background-color: #fff;
        max-height: 0;
        /* MUY IMPORTANTE: oculta el contenido por defecto */
        overflow: hidden;
        /* Oculta cualquier contenido que se desborde */
        transition: max-height 0.3s ease-out, padding 0.3s ease-out;
        /* Transición suave para la altura y padding */
        padding: 0 25px;
        /* Padding inicial cero (se aplicará cuando esté abierto) */
    }

    /* Estilo del párrafo dentro del contenido */
    .accordion-content p {
        padding: 15px 0;
        /* Padding real del contenido */
        margin: 0;
        line-height: 1.6;
        color: #555;
    }

    /* NUEVO: Estilos para las imágenes dentro del contenido del acordeón */
    .accordion-content img {
        width: 100%;
        /* Ocupa el 100% del ancho disponible en su contenedor */
        height: auto;
        /* Mantiene la proporción original de la imagen (¡NO SE DISTORSIONA!) */
        display: block;
        /* Elimina cualquier espacio extra por debajo de la imagen */
        max-width: 100%;
        /* Asegura que la imagen no se desborde si es inherentemente más grande */
        margin: 15px 0;
        /* Añade un poco de margen vertical para separar la imagen del texto/bordes */
        object-fit: contain;
        /* Asegura que la imagen se ajuste dentro de sus dimensiones sin recortarse ni distorsionarse */
    }

    /* NUEVO: Clase para aplicar el padding real cuando el acordeón está abierto (manejado por JS) */
    .accordion-content.active-content {
        padding: 15px 25px;
        /* Restaura el padding del contenido cuando está abierto */
    }

    /*
        IMPORTANTE: La siguiente regla ha sido ELIMINADA del CSS porque la altura (max-height)
        será manejada dinámicamente por JavaScript para adaptarse al contenido.
        .accordion-header.active + .accordion-content { ... }
        */
    img {
        border-bottom: 2px solid #076FF9;
    }
    ul img{
        border: none;
    }
    .container-manual-description h1, .container-manual-description p  {
        align-items: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .fondo-manual{
        width: 380px;
        height: auto;
        position: fixed;
        right: 20px;
        top: 200px;
    }
    .manu-fixed{
        border-top: 6px solid #076FF9;
        /* Clase para la descripción del contenido principal */
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        /* Centra el bloque horizontalmente */
        position: fixed;
        right: 20px;
        top: 70px;
        width: 380px;
    }
</style>

<main>
    <?php include_once 'panel_navegacion.php'; ?>

    <!-- Contenido Principal -->
    <div class="container-manual-description">
        <h1>Manual de Usuario - SistemaPat</h1>
        <p>Este manual está diseñado para guiarte a través de las funcionalidades del SistemaPat, facilitando el registro y gestión de patentes, licencias y solvencias.</p>
        <p class="manu-fixed">En la Alcaldía, nos regimos por principios de integridad, transparencia y servicio. Este manual es una herramienta fundamental que refleja nuestro compromiso ético con la eficiencia y la claridad,</p>
        <img src="img/fondo-manual.jpg" alt="" class="fondo-manual">
        <div class="accordion-container">

            <div class="accordion-item">
                <button class="accordion-header">
                    ¿Cómo registro una patente?
                    <span class="arrow-icon">&#9660;</span>
                </button>
                <div class="accordion-content">
                    <img src="img/Manual/registrar patente.png" alt="Imagen de registro de patente">
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    ¿Cómo puedo ver todas las licencias/solvencias de un representante?
                    <span class="arrow-icon">&#9660;</span>
                </button>
                <div class="accordion-content">
                    <img src="img/Manual/Listado-1.png" alt="Imagen de registro de patente">
                    <img src="img/Manual/Listado-2.png" alt="Imagen de registro de patente">
                    <img src="img/Manual/Listado-3.png" alt="Imagen de registro de patente">
                    <img src="img/Manual/Listado-4.png" alt="Imagen de registro de patente">
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    ¿Cómo genero una licencia?
                    <span class="arrow-icon">&#9660;</span>
                </button>
                <div class="accordion-content">
                    <img src="img/Manual/Listado-1.png" alt="Imagen de registro de patente">
                    <img src="img/Manual/Listado-2.png" alt="Imagen de registro de patente">
                    <img src="img/Manual/Generar-licencia-solvencia.png" alt="Imagen de registro de patente">
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    ¿Cómo registro un usuario?
                    <span class="arrow-icon">&#9660;</span>
                </button>
                <div class="accordion-content">
                    <img src="img/Manual/Crear-ver-usuarios.png" alt="Imagen de registro de patente">
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    ¿Cómo modifico o edito una patente existente?
                    <span class="arrow-icon">&#9660;</span>
                </button>
                <div class="accordion-content">
                    <img src="img/Manual/Modificar-contribuyente.png" alt="Imagen de registro de patente">
                </div>
            </div>

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const accordionHeaders = document.querySelectorAll('.accordion-header');

                accordionHeaders.forEach(header => {
                    header.addEventListener('click', function () {
                        const content = this.nextElementSibling; // El div .accordion-content es el siguiente hermano

                        // Opcional: Cierra todos los demás acordeones abiertos
                        // Si quieres que solo se abra un acordeón a la vez, descomenta el siguiente bloque:
                        accordionHeaders.forEach(otherHeader => {
                            if (otherHeader !== this) { // Si no es el encabezado que se clickeó
                                otherHeader.classList.remove('active'); // Quita la clase 'active' del encabezado
                                const otherContent = otherHeader.nextElementSibling;
                                otherContent.style.maxHeight = null; // Colapsa el contenido
                                otherContent.classList.remove('active-content'); // Quita la clase de padding
                            }
                        });

                        // Alterna la clase 'active' en el encabezado clickeado
                        this.classList.toggle('active');

                        // Gestiona la altura del contenido y el padding
                        if (this.classList.contains('active')) {
                            // Si el acordeón se está abriendo
                            // Primero, asegúrate de que el contenido sea visible para calcular scrollHeight correctamente
                            content.style.maxHeight = 'fit-content'; // Una altura temporal para que scrollHeight sea preciso
                            const scrollHeight = content.scrollHeight;
                            content.style.maxHeight = scrollHeight + "px"; // Luego, establece la altura real

                            content.classList.add('active-content'); // Añade la clase para el padding
                        } else {
                            // Si el acordeón se está cerrando
                            // Establece la altura a la altura real antes de colapsar para que la transición sea suave
                            content.style.maxHeight = content.scrollHeight + "px"; // Temporalmente a su altura actual
                            requestAnimationFrame(() => { // Pequeño truco para asegurar que la altura se aplique antes de cambiar a null
                                content.style.maxHeight = null; // Restablece max-height para permitir la transición de cierre
                            });
                            content.classList.remove('active-content'); // Quita la clase de padding
                        }
                    });
                });
            });
        </script>
    </div>

</main>

<?php include_once 'footer.php'; ?>