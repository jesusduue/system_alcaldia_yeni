<?php
include_once 'header.php';
require_once('../../Backend/clase/usuario_class.php');
require_once('../../Backend/clase/pregunta_seguridad_class.php');
 
$usuario = new usuario();
 $preguntaSeguridad = new pregunta_seguridad();
 
$idUsuario = isset($_GET['id_usu']) ? $_GET['id_usu'] : 0;

// Obtener preguntas disponibles
 $preguntasDisponibles = $preguntaSeguridad->listar_activas();
 $preguntasUsuario = $usuario->obtener_preguntas_usuario($idUsuario);

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['preguntas'])) {
    // Eliminar preguntas existentes del usuario
    $usuario->eliminar_preguntas_usuario($idUsuario);
    
    // Insertar nuevas preguntas
    foreach ($_POST['preguntas'] as $idPregunta => $respuesta) {
        if (!empty($respuesta)) {
            $usuario->agregar_pregunta_usuario($idUsuario, $idPregunta, $respuesta);
        }
    }
    
    echo "<script>alert('Preguntas de seguridad actualizadas correctamente');</script>";
}
?>

<title>Configurar Preguntas de Seguridad</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="../estilos/css/style.css">
<style>
    .security-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        max-width: 800px;
    }
    
    .security-container h2 {
        margin-top: 0;
    }
    
    .security-form .form-group {
        margin-bottom: 15px;
    }
    
    .security-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    .security-form select, .security-form input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    .btn-save {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
    
    .btn-save:hover {
        background-color: #218838;
    }
</style>
</head>

<body>
    <?php include_once 'panel_navegacion.php'; ?>
    
    <div class="main-content">
        <div class="security-container">
            <h2>Configurar Preguntas de Seguridad</h2>
            
            <form class="security-form" method="POST">
                <?php while ($pregunta = $preguntasDisponibles->extraer_dato()): ?>
                    <div class="form-group">
                        <label><?php echo htmlspecialchars($pregunta['pregunta']); ?></label>
                        <input type="text" name="preguntas[<?php echo $pregunta['id_pregunta']; ?>]" 
                               placeholder="Tu respuesta" required>
                    </div>
                <?php endwhile; ?>
                
                <button type="submit" class="btn-save">Guardar Preguntas</button>
            </form>
        </div>
    </div>
    
    <?php include_once 'footer.php'; ?>
</body>
</html>