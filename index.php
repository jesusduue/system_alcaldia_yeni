
<?php 
include_once 'Frontend/vista/header_index.php';
session_start();

// Verificar si el usuario ya está logueado
if (isset($_SESSION['user_id'])) {
    header("Location: frontend/vista/dashboard.php");
    exit();
}

// Inicializar variables
$error = '';
?>
<title>Inicio de Sesión - SistemaPat</title>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-image: url('Frontend/estilos/img/alcaldia2.jpg');
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-size: 100% 100%;

    }

    .login-container {
        width: 500px;
        max-width: 600px;
        height: 100vh;
        /* Ocupa todo el alto de la pantalla */
        position: fixed;
        /* Fija el contenedor a la izquierda */
        top: 0;
        left: 0;
        padding: 40px;
        border-right: 3px solid rgb(57, 87, 119);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        margin: auto;
        background-color: rgba(175, 174, 174, 0.7);
        /* Fondo blanco semi-transparente */
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));
        /* Sombra adicional */

    }

    img {
        margin-bottom: 10px;
        width: 900px;
        /* Adjust as needed */
        height: auto;
        /* Maintain aspect ratio */
    }

    .login-container h1 {
        margin-bottom: 10px;
        font-size: 24px;
        font-family: Algerian;
        color: #333;
    }

    .login-container h2 {
        margin-bottom: 20px;
        font-size: 18px;
        color: #007bff;
    }

    .login-container form {
        display: flex;
        flex-direction: column;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .login-container button {
        padding: 10px;
        background-color: #2c3e50;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .login-container button:hover {
        background-color: #34495e;
    }

    .login-container a {
        margin-top: 10px;
        display: inline-block;
        font-size: 14px;
        color: #2c3e50;
        text-decoration: none;
    }

    .login-container a:hover {
        text-decoration: underline;
    }

    /*  .login-container .logo-container {
    
}*/

    .login-container .logo-container img {
        width: 100px;
        /* Ajusta el ancho de las imágenes */
        height: auto;
        /* Mantiene la proporción */
    }

    /* --- ESTILOS ESPECÍFICOS DEL CARRUSEL --- */

    #myCarouselContainer {
        /* ID para el contenedor principal del carrusel */
        width: 470px;
        /* **NUEVO ANCHO DEL CARRUSEL** */
        height: 145px;
        /* **NUEVA ALTURA DEL CARRUSEL** */
        position: relative;
        margin: 20px 10px;
        overflow: hidden;
        /* Oculta las imágenes fuera del área visible */
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        background-color: #fff;
    }

    #myCarouselInner {
        /* ID para el contenedor de los slides que se desliza */
        display: flex;
        /* Coloca los ítems en una fila */
        width: 100%;
        /* Ocupa el 100% del ancho del contenedor padre */
        height: 100%;
        /* Ocupa el 100% de la altura del contenedor padre */
        transition: transform 0.8s ease-in-out;
        /* Animación de deslizamiento suave */
    }

    .my-carousel-item {
        /* Clase para cada slide individual */
        min-width: 100%;
        /* Cada slide ocupa el 100% del ancho del #myCarouselInner */
        flex-shrink: 0;
        /* Evita que los ítems se encojan */
        position: relative;
        display: flex;
        /* Para centrar la imagen y el caption */
        justify-content: center;
        align-items: center;
        height: 100%;
        /* Cada ítem toma el 100% de la altura del #myCarouselInner */
    }

    .my-carousel-item img {
        width: 100%;
        /* **NUEVO ANCHO FIJO DE LA IMAGEN** */
        height: 100%;
        /* **NUEVA ALTURA FIJA DE LA IMAGEN** */
        object-fit: fill;
        /* Asegura que la imagen cubra el área sin deformarse */
        display: block;
        border-radius: 10px;
    }

    .my-carousel-caption {
        /* Clase para el pie de imagen */
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 15px 0;
        font-size: 1.1em;
        text-align: center;
        box-sizing: border-box;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    /* Botones de Navegación (Flechas) */
    .my-carousel-control {
        /* Clase para los botones de control */
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 18px 12px;
        margin-top: -25px;
        /* Ajuste para centrar verticalmente */
        color: white;
        font-weight: bold;
        font-size: 28px;
        transition: 0.6s ease;
        user-select: none;
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 5px;
        z-index: 10;
    }

    .my-carousel-control.prev {
        left: 15px;
    }

    .my-carousel-control.next {
        right: 15px;
    }

    .my-carousel-control:hover {
        background-color: rgba(0, 0, 0, 0.9);
    }

    /* Puntos Indicadores */
    #myCarouselDots {
        /* ID para el contenedor de los puntos */
        text-align: center;
        padding: 10px 0;
        position: absolute;
        bottom: 15px;
        width: 100%;
        z-index: 10;
    }
</style>
<main>
    <div class="login-container">
        <div class="logo-container">
            <img src="Frontend/estilos/img/logo_alcaldia_la_fria.png" alt="Logo Alcaldía">
        </div>
        <h1>Bienvenido a SistemaPat</h1>
        <h2>Gestión y Control de Patentes</h2>
        <p>Construyendo naciòn y forjando futuro</p>
        <form class="login" action="Backend/clase/login_class.php" method="post">
            <input type="text" name="nom_usu" placeholder="Nombre de Usuario" required>
            <input type="password" name="cla_usu" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
<div class="forgot-password">
    <a href="Backend/controlador/recuperar_clave.php">¿Olvidaste tu contraseña?</a>
</div>
            <div id="myCarouselContainer">
                <div id="myCarouselInner">
                    <div class="my-carousel-item">
                        <img src="Frontend/vista/img/image1.jpg" alt="Imagen 1 - La Fría">
                        <div class="my-carousel-caption">Explora los servicios municipales</div>
                    </div>

                    <div class="my-carousel-item">
                        <img src="Frontend/vista/img/image2.jpg" alt="Imagen 2 - Obras en el Municipio">
                        <div class="my-carousel-caption">Conoce nuestras obras y proyectos</div>
                    </div>

                    <div class="my-carousel-item">
                        <img src="Frontend/vista/img/image3.jpg" alt="Imagen 3 - Gestión de Patentes">
                        <div class="my-carousel-caption">Simplificando tu gestión de patentes</div>
                    </div>
                </div> <a class="my-carousel-control prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="my-carousel-control next" onclick="plusSlides(1)">&#10095;</a>

                <div id="myCarouselDots">
                    <span class="my-dot" onclick="currentSlide(1)"></span>
                    <span class="my-dot" onclick="currentSlide(2)"></span>
                    <span class="my-dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
        </form>
    </div>

</main>

<script>
    let slideIndex = 0; // Índice de la imagen actual (0-based para JavaScript)
    let slideshowInterval; // Variable para almacenar el ID del temporizador

    // Seleccionamos elementos por su ID (para el contenedor) y clases (para ítems y puntos)
    const myCarouselContainer = document.getElementById('myCarouselContainer');
    const myCarouselInner = document.getElementById('myCarouselInner');
    let myCarouselItems = document.querySelectorAll('.my-carousel-item');
    let myDots = document.querySelectorAll('.my-dot');

    // Función principal para mostrar el siguiente slide automáticamente
    function showSlides() {
        slideIndex++;
        if (slideIndex >= myCarouselItems.length) {
            slideIndex = 0; // Vuelve al primer slide
        }
        updateCarousel(); // Llama a la función para actualizar la UI
    }

    // Función para actualizar la posición del carrusel
    function updateCarousel() {
        const offset = -slideIndex * 100; // Calcula el desplazamiento horizontal necesario
        myCarouselInner.style.transform = `translateX(${offset}%)`;

        // Actualiza el estado de los puntos indicadores (activo/inactivo)
        myDots.forEach((dot, index) => {
            dot.classList.remove('active'); // Remueve la clase 'active' de todos los puntos
            if (index === slideIndex) {
                dot.classList.add('active'); // Añade la clase 'active' al punto correspondiente al slide actual
            }
        });
    }

    // Función para avanzar/retroceder los slides con los botones de navegación
    function plusSlides(n) {
        clearInterval(slideshowInterval); // Detiene el temporizador automático al interactuar con los botones

        slideIndex += n; // Ajusta el índice del slide

        // Lógica para ir al final o al principio si se exceden los límites
        if (slideIndex >= myCarouselItems.length) {
            slideIndex = 0; // Vuelve al primer slide
        }
        if (slideIndex < 0) {
            slideIndex = myCarouselItems.length - 1; // Va al último slide
        }

        updateCarousel(); // Actualiza la interfaz del carrusel
        slideshowInterval = setInterval(showSlides, 3000); // Reinicia el temporizador automático
    }

    // Función para ir a una diapositiva específica usando los puntos indicadores
    function currentSlide(n) {
        clearInterval(slideshowInterval); // Detiene el temporizador automático

        slideIndex = n - 1; // Ajusta a índice 0-based (si el punto es 1, el índice es 0)

        updateCarousel(); // Actualiza la interfaz del carrusel
        slideshowInterval = setInterval(showSlides, 3000); // Reinicia el temporizador automático
    }

    // Inicializa el carrusel cuando todo el contenido del DOM ha cargado
    document.addEventListener('DOMContentLoaded', () => {
        if (myCarouselItems.length > 0) {
            updateCarousel(); // Establece la primera diapositiva como activa
            slideshowInterval = setInterval(showSlides, 3000); // Inicia el carrusel automático después de 3 segundos
        }
    });

    // Aunque la altura es fija, se mantiene por buena práctica, pero no es estrictamente necesario ya
    window.addEventListener('resize', () => {
        // En este caso, con altura fija, no necesitamos recalcular nada
        // Si en el futuro cambias a altura adaptable, esta función sería crucial.
    });
</script>
<?php include_once 'Frontend/vista/footer.php'; ?>