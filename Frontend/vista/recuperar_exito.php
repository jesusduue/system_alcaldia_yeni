<?php include_once 'header_index.php'; ?>
<title>Contraseña Actualizada</title>
<style>
    .success-container {
        text-align: center;
        width: 450px;
        margin: 50px auto;
        padding: 40px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .success-container h2 {
        color: #27ae60;
        margin-bottom: 20px;
    }

    .success-container p {
        color: #34495e;
        font-size: 18px;
        margin-bottom: 30px;
    }

    .success-icon {
        font-size: 50px;
        color: #27ae60;
        margin-bottom: 20px;
    }

    .login-link {
        display: inline-block;
        padding: 12px 25px;
        background-color: #2c3e50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .login-link:hover {
        background-color: #34495e;
    }
</style>
<!-- Incluir Font Awesome para el ícono -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<div class="success-container">
    <div class="success-icon"><i class="fas fa-check-circle"></i></div>
    <h2>¡Éxito!</h2>
    <p>Tu contraseña ha sido actualizada correctamente.</p>
    <a href="../../index.php" class="login-link">Ir a Iniciar Sesión</a>
</div>

<?php include_once 'footer.php'; ?>