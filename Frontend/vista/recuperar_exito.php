<?php include_once 'header_index.php'; ?>
<title>Contraseña Recuperada</title>
<style>
    .success-container {
        width: 400px;
        margin: 50px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    
    .success-container h2 {
        color: #27ae60;
        margin-bottom: 20px;
    }
    
    .success-icon {
        font-size: 50px;
        color: #27ae60;
        margin-bottom: 20px;
    }
    
    .btn-login {
        display: inline-block;
        padding: 10px 20px;
        background-color: #2c3e50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 20px;
        transition: background-color 0.3s;
    }
    
    .btn-login:hover {
        background-color: #34495e;
    }
</style>

<div class="success-container">
    <div class="success-icon">✓</div>
    <h2>¡Contraseña Actualizada!</h2>
    <p><?php echo $mensaje; ?></p>
    <a href="../../index.php" class="btn-login">Iniciar Sesión</a>
</div>

<?php include_once 'footer.php'; ?>