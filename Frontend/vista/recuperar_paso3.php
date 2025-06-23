
<?php include_once 'header_index.php'; ?>
<title>Recuperar Contraseña - Paso 3</title>
<style>
    /* Estilos similares a los pasos anteriores */
    .recovery-container {
        width: 400px;
        margin: 50px auto;
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
    
    .password-strength {
        margin-top: 5px;
        font-size: 12px;
        color: #7f8c8d;
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
</style>

<div class="recovery-container">
    <h2>Recuperar Contraseña - Paso 3</h2>
    
    <?php if (isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form action="recuperar_clave.php?paso=3" method="post">
        <input type="hidden" name="id_usu" value="<?php echo $id_usuario; ?>">
        
        <div class="form-group">
            <label for="nueva_clave">Nueva Contraseña:</label>
            <input type="password" id="nueva_clave" name="nueva_clave" required>
            <div class="password-strength">Mínimo 8 caracteres, con al menos una mayúscula y un número</div>
        </div>
        
        <div class="form-group">
            <label for="confirmar_clave">Confirmar Contraseña:</label>
            <input type="password" id="confirmar_clave" name="confirmar_clave" required>
        </div>
        
        <button type="submit" class="btn-submit">Establecer Nueva Contraseña</button>
    </form>
</div>

<script>
    // Validación básica de contraseña en el cliente
    document.getElementById('nueva_clave').addEventListener('input', function() {
        const password = this.value;
        const strengthText = document.querySelector('.password-strength');
        
        // Verificar longitud mínima
        if (password.length < 8) {
            strengthText.style.color = '#e74c3c';
            strengthText.textContent = 'La contraseña es demasiado corta (mínimo 8 caracteres)';
            return;
        }
        
        // Verificar complejidad
        const hasUpperCase = /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        
        if (!hasUpperCase || !hasNumber) {
            strengthText.style.color = '#e67e22';
            strengthText.textContent = 'La contraseña debe contener al menos una mayúscula y un número';
            return;
        }
        
        strengthText.style.color = '#27ae60';
        strengthText.textContent = 'Contraseña segura';
    });
</script>

<?php include_once 'footer.php'; ?>