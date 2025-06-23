<?php 
include_once 'header_index.php'; 
?>
<title>Recuperar Contraseña - Paso 2</title>
<style>
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
    
    .security-question {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        border-left: 4px solid #3498db;
    }
    
    .error-message {
        color: #e74c3c;
        margin-bottom: 15px;
        text-align: center;
    }
    
    .success-message {
        color: #27ae60;
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
    <h2>Recuperar Contraseña - Paso 2</h2>
    
    <?php 
    // Verificar si hay errores
    if (isset($error)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php
    // Verificar que las variables necesarias estén definidas
    if (!isset($id_usuario) || !isset($id_pregunta)) {
        $error = "Datos incompletos. Por favor inicie el proceso nuevamente.";
    } else {
        // Obtener el texto de la pregunta de seguridad
        $pregunta_texto = "Pregunta no disponible";
        
        try {
            $usuario->que_bd = "SELECT pregunta FROM pregunta_seguridad WHERE id_pregunta = ?";
            $params = [$id_pregunta];
            $result = $usuario->ejecutar($params);
            
            if ($result && $result->num_rows > 0) {
                $pregunta_texto = $result->fetch_assoc()['pregunta'];
            } else {
                $error = "No se pudo recuperar la pregunta de seguridad. Por favor contacte al administrador.";
            }
        } catch (Exception $e) {
            $error = "Error técnico al recuperar la pregunta. Por favor intente más tarde.";
            error_log("Error en recuperar_paso2: " . $e->getMessage());
        }
    }
    ?>
    
    <?php if (!isset($error)): ?>
        <div class="security-question">
            <strong>Pregunta de seguridad:</strong>
            <p><?php echo htmlspecialchars($pregunta_texto); ?></p>
        </div>
        
        <form action="recuperar_clave.php?paso=2" method="post">
            <input type="hidden" name="id_usu" value="<?php echo htmlspecialchars($id_usuario); ?>">
            <input type="hidden" name="id_pregunta" value="<?php echo htmlspecialchars($id_pregunta); ?>">
            
            <div class="form-group">
                <label for="respuesta">Respuesta:</label>
                <input type="text" id="respuesta" name="respuesta" required>
            </div>
            
            <button type="submit" class="btn-submit">Verificar Respuesta</button>
        </form>
    <?php else: ?>
        <a href="../index.php" class="back-link">Volver al inicio de sesión</a>
    <?php endif; ?>
</div>

<?php 
include_once 'footer.php'; 
?>