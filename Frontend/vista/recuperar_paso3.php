<?php
// Frontend/vista/recuperar_paso3.php
session_start();
include_once 'header_index.php';

// Validar que el usuario tiene permiso para estar en este paso.
if (!isset($_SESSION['recuperacion_paso']) || $_SESSION['recuperacion_paso'] != 3) {
    header('Location: recuperar_paso1.php');
    exit();
}

// Obtener y limpiar el mensaje de error de la sesión, si existe.
$error = $_SESSION['recuperacion_error'] ?? null;
unset($_SESSION['recuperacion_error']);
?>
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
        background-color: #fdd;
        border: 1px solid #e74c3c;
        padding: 10px;
        border-radius: 4px;
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
        box-sizing: border-box;
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
    <h2>Establecer Nueva Contraseña</h2>

    <?php if (isset($error)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <!-- El formulario apunta al controlador. Ya no necesita enviar el id_usu. -->
    <form action="../../Backend/controlador/recuperar_clave.php" method="post">
        <input type="hidden" name="paso" value="3">

        <div class="form-group">
            <label for="nueva_clave">Nueva Contraseña:</label>
            <input type="password" id="nueva_clave" name="nueva_clave" required>
            <div class="password-strength">Mínimo 8 caracteres, con al menos una mayúscula y un número.</div>
        </div>

        <div class="form-group">
            <label for="confirmar_clave">Confirmar Contraseña:</label>
            <input type="password" id="confirmar_clave" name="confirmar_clave" required>
        </div>

        <button type="submit" class="btn-submit">Actualizar Contraseña</button>
    </form>
</div>

<script>
    // Tu script de validación del cliente es correcto y se puede mantener.
    document.getElementById('nueva_clave').addEventListener('input', function() {
        const password = this.value;
        const strengthText = document.querySelector('.password-strength');

        if (password.length < 8) {
            strengthText.style.color = '#e74c3c';
            strengthText.textContent = 'La contraseña es demasiado corta (mínimo 8 caracteres)';
            return;
        }

        const hasUpperCase = /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);

        if (!hasUpperCase || !hasNumber) {
            strengthText.style.color = '#e67e22';
            strengthText.textContent = 'Debe contener al menos una mayúscula y un número.';
            return;
        }

        strengthText.style.color = '#27ae60';
        strengthText.textContent = 'Contraseña segura.';
    });
</script>

<?php include_once 'footer.php'; ?>