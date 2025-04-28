<div class="stats-container">
    <div class="stat-box">
        <i class="fas fa-file-alt"
            style="font-size: 30px; color: #007bff; margin-bottom: 10px; display: inline-block;"></i>
        <h3>Total de Patentes</h3>
        <p>150</p>
    </div>
    <div class="stat-box">
        <i class="fas fa-check-circle"
            style="font-size: 30px; color: #28a745; margin-bottom: 10px; display: inline-block;"></i>
        <h3>Patentes Activas</h3>
        <p>120</p>
    </div>
    <div class="stat-box">
        <i class="fas fa-times-circle"
            style="font-size: 30px; color: #dc3545; margin-bottom: 10px; display: inline-block;"></i>
        <h3>Patentes Inactivas</h3>
        <p>30</p>
    </div>

    <!-- CARRUSEL -->
    <div class="carousel-container">
    <div class="carousel">
        <div class="carousel-item active">
            <img src="../../public/img/carrusel1.png" alt="Imagen 1">
        </div>
        <div class="carousel-item">
            <img src="../../public/img/carrusel2.png" alt="Imagen 2">
        </div>
        <div class="carousel-item">
            <img src="../../public/img/carrusel3.png" alt="Imagen 3">
        </div>
    </div>
    <button class="carousel-control prev" onclick="prevSlide()">&#10094;</button>
    <button class="carousel-control next" onclick="nextSlide()">&#10095;</button>
</div>
</div>
<script>
    let currentSlide = 0;

function showSlide(index) {
    const slides = document.querySelectorAll('.carousel-item');
    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }

    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === currentSlide) {
            slide.classList.add('active');
        }
    });
}

function nextSlide() {
    showSlide(currentSlide + 1);
}

function prevSlide() {
    showSlide(currentSlide - 1);
}

// Inicializa el carrusel
showSlide(currentSlide);
</script>