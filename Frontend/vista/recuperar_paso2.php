<?php
// Frontend/vista/recuperar_paso2.php
session_start();
include_once 'header_index.php';

// Verificar si tenemos los datos necesarios en la sesión. Si no, redirigir al paso 1.
if (!isset($_SESSION['recuperacion_id_usu']) || !isset($_SESSION['recuperacion_pregunta'])) {
    header('Location: recuperar_paso1.php');
    exit();
}

// Obtener la pregunta de la sesión para mostrarla de forma segura.
$pregunta_seguridad = htmlspecialchars($_SESSION['recuperacion_pregunta']);

// Variable para mostrar errores que pueda enviar el controlador.
$error = $_SESSION['recuperacion_error'] ?? null;
unset($_SESSION['recuperacion_error']); // Limpiar el error después de mostrarlo.
?>
<title>Recuperar Contraseña - Paso 2</title>
<style>
    /* Estilos del archivo recuperar_paso1.php para consistencia */
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
         margin-bottom: 20px; }
    .error-message { 
        color: #e74c3c;
         background-color: #fdd; 
         border: 1px solid #e74c3c; 
         padding: 10px; border-radius: 4px; 
         margin-bottom: 15px; 
         text-align: center; }
    .form-group { 
        margin-bottom: 20px; }
    .form-group label { 
        display: block; 
        margin-bottom: 8px; 
        font-weight: bold; 
        color: #34495e; }
    .form-group input { 
        width: 100%; 
        padding: 10px; 
        border: 1px solid #ddd; 
        border-radius: 4px; 
        font-size: 16px; 
        box-sizing: border-box; }
    .btn-submit {
         width: 100%; 
         padding: 12px; 
         background-color: #2c3e50; 
         color: white; 
         border: none; 
         border-radius: 4px; 
         font-size: 16px; 
         cursor: pointer; 
         transition: background-color 0.3s; }
    .btn-submit:hover { background-color: #34495e; }
    .back-link { 
        display: block; 
        text-align: center; 
        margin-top: 15px; 
        color: #3498db; 
        text-decoration: none; 
    }
    .security-question {
        background-color: #ecf0f1;
        border-left: 5px solid #3498db;
        padding: 15px;
        margin-bottom: 20px;
        font-style: italic;
        color: #34495e;
    }
</style>

<div class="recovery-container">
    <h2>Recuperar Contraseña - Paso 2</h2>

    <?php if (isset($error)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <!-- La acción apunta al controlador, que sabrá que estamos en el paso 2 gracias a la sesión. -->
    <form action="../../Backend/controlador/recuperar_clave.php" method="post">
        <!-- El único dato que necesita el controlador es la respuesta y el paso en el que estamos -->
        <input type="hidden" name="paso" value="2">
        
        <div class="form-group">
            <label>Pregunta de Seguridad:</label>
            <div class="security-question">
                <?php echo $pregunta_seguridad; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="respuesta">Tu Respuesta:</label>
            <input type="text" id="respuesta" name="respuesta" required autofocus>
        </div>
        
        <button type="submit" class="btn-submit">Verificar Respuesta</button>
    </form>

    <a href="../../Backend/controlador/recuperar_clave.php?paso=1" class="back-link">Volver al paso anterior</a>
</div>

<?php include_once 'footer.php'; ?>
