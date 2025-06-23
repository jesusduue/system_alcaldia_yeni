<?php include_once 'header_index.php';?>

<title>Recuperar Contraseña - Paso 1</title>
<style>
    .recovery-container {
        width: 400px;
        margin: 50px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .recovery-container {
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    
    .recovery-container h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 20px;
    }
    
    .error-message {
        color: #e74c3c;
        margin-bottom: 15px;
        text-align: center;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #34495e;
    }
    
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }
    
    .btn-submit {
        width: 100%;
        padding: 12px;
        background-color: #2c3e50;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .btn-submit:hover {
        background-color: #34495e;
    }
    
    .back-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #3498db;
        text-decoration: none;
    }
</style>

<div class="recovery-container">
    <h2>Recuperar Contraseña - Paso 1</h2>
    
    <?php if (isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form action="../../Backend/controlador/recuperar_clave.php" method="post">
        <input type="hidden" name="paso" value="1">
        <div class="form-group">
            <label for="nom_usu">Nombre de Usuario:</label>
            <input type="text" id="nom_usu" name="nom_usu" required>
        </div>
        
        <button type="submit" class="btn-submit">Continuar</button>
    </form>
    
    <a href="../../index.php" class="back-link">Volver al inicio de sesión</a>
</div>

<?php include_once 'footer.php'; ?>