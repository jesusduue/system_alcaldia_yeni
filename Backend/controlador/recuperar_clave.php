<?php
// Backend/controlador/recuperar_clave.php
require_once("../clase/usuario_class.php");

// Iniciar la sesión al principio de todo. Es crucial para pasar datos entre pasos.
session_start();

// Requerir la clase de usuario que contiene la lógica de la base de datos.
require_once("../clase/usuario_class.php");

// Crear una instancia del objeto usuario.
$usuario = new usuario();

// Determinar el paso actual. Por defecto es 1.
// Se usa 'paso' de la sesión si existe, si no, se toma del POST o GET.
$paso = $_SESSION['recuperacion_paso'] ?? $_REQUEST['paso'] ?? 1;

// Router principal para manejar la lógica de cada paso.
switch ($paso) {
    case 1:
        // --- PASO 1: VERIFICAR USUARIO ---
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom_usu'])) {
            $nom_usu = trim($_POST['nom_usu']);
            
            // Usar el método para verificar si el usuario existe.
            $datos_usuario = $usuario->verificarUsuario($nom_usu);
            
            if ($datos_usuario) {
                // El usuario existe, ahora verificar si tiene una pregunta de seguridad.
                $pregunta_data = $usuario->obtener_preguntas_usuario($datos_usuario['id_usu']);

                if ($pregunta_data) {
                    // ¡Éxito! El usuario tiene pregunta. Guardar datos en la sesión.
                    $_SESSION['recuperacion_id_usu'] = $datos_usuario['id_usu'];
                    $_SESSION['recuperacion_pregunta'] = $pregunta_data['pregunta'];
                    $_SESSION['recuperacion_id_pregunta'] = $pregunta_data['fky_pregunta'];
                    $_SESSION['recuperacion_paso'] = 2; // Avanzar al siguiente paso.

                    // Redirigir al usuario a la VISTA del paso 2.
                    header("Location: ../../Frontend/vista/recuperar_paso2.php");
                    exit();
                } else {
                    $error = "Este usuario no tiene preguntas de seguridad configuradas.";
                }
            } else {
                $error = "El nombre de usuario no ha sido encontrado.";
            }
        }
        // Incluir la vista del paso 1.
        include("../../Frontend/vista/recuperar_paso1.php");
        break;

    case 2:
// --- PASO 2: VERIFICAR RESPUESTA ---
        // Asegurarnos de que el usuario viene del paso 1 y tiene los datos en la sesión.
        if (!isset($_SESSION['recuperacion_id_usu'], $_SESSION['recuperacion_id_pregunta'])) {
            // Si no, es un acceso inválido y lo reiniciamos al paso 1.
            header("Location: recuperar_clave.php?paso=1");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['respuesta'])) {
            $id_usuario  = $_SESSION['recuperacion_id_usu'];
            $id_pregunta = $_SESSION['recuperacion_id_pregunta'];
            $respuesta   = trim($_POST['respuesta']);

            // Se usa el método que verifica la respuesta contra el hash de la BD.
            if ($usuario->verificar_respuesta($id_usuario, $id_pregunta, $respuesta)) {
                // ¡Éxito! La respuesta es correcta.
                $_SESSION['recuperacion_paso'] = 3; // Avanzamos al paso final.
                
                // Limpiamos los datos de la pregunta que ya no son necesarios.
                unset($_SESSION['recuperacion_pregunta'], $_SESSION['recuperacion_id_pregunta']);

                // Redirigir al usuario a la VISTA del paso 3.
                header("Location: ../../Frontend/vista/recuperar_paso3.php");
                exit();
            } else {
                // La respuesta fue incorrecta. Guardamos un error en la sesión.
                $_SESSION['recuperacion_error'] = "La respuesta es incorrecta. Por favor, intente de nuevo.";
                
                // Lo devolvemos a la vista del paso 2 para que lo intente otra vez.
                header("Location: ../../Frontend/vista/recuperar_paso2.php");
                exit();
            }
        }
        
        // Si el usuario llega a este controlador en el paso 2 sin enviar el formulario,
        // simplemente lo enviamos a la vista correspondiente.
        include("../../Frontend/vista/recuperar_paso2.php");
        break;
        
    case 3:
        // --- PASO 3: CAMBIAR CONTRASEÑA ---
        // Asegurarnos de que el usuario viene del paso 2.
        if (!isset($_SESSION['recuperacion_id_usu']) || $_SESSION['recuperacion_paso'] != 3) {
            header("Location: recuperar_clave.php?paso=1");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nueva_clave'], $_POST['confirmar_clave'])) {
            $id_usuario = $_SESSION['recuperacion_id_usu'];
            $nueva_clave = $_POST['nueva_clave'];
            $confirmar_clave = $_POST['confirmar_clave'];

            // 1. Validar que las contraseñas no estén vacías.
            if (empty($nueva_clave) || empty($confirmar_clave)) {
                $_SESSION['recuperacion_error'] = "Ambos campos de contraseña son obligatorios.";
                header("Location: ../../Frontend/vista/recuperar_paso3.php");
                exit();
            }
            
            // 2. Validar que las contraseñas coincidan.
            if ($nueva_clave !== $confirmar_clave) {
                $_SESSION['recuperacion_error'] = "Las contraseñas no coinciden.";
                header("Location: ../../Frontend/vista/recuperar_paso3.php");
                exit();
            }

            // 3. Validar la complejidad de la contraseña.
            if (strlen($nueva_clave) < 8 || !preg_match('/[A-Z]/', $nueva_clave) || !preg_match('/[0-9]/', $nueva_clave)) {
                $_SESSION['recuperacion_error'] = "La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.";
                header("Location: ../../Frontend/vista/recuperar_paso3.php");
                exit();
            }

            // 4. Si todo es válido, actualizar la contraseña en la base de datos.
            if ($usuario->actualizar_clave($id_usuario, $nueva_clave)) {
                // ¡Éxito! Contraseña actualizada.
                // Destruir la sesión de recuperación para finalizar el proceso.
                session_destroy();
                
                // Redirigir a una página de éxito.
                header("Location: ../../Frontend/vista/recuperar_exito.php");
                exit();
            } else {
                // Si hay un error de base de datos.
                $_SESSION['recuperacion_error'] = "Ocurrió un error al actualizar la contraseña. Intente de nuevo.";
                header("Location: ../../Frontend/vista/recuperar_paso3.php");
                exit();
            }
        }
        
        // Si el usuario llega sin enviar el formulario, mostrar la vista del paso 3.
        include("../../Frontend/vista/recuperar_paso3.php");
        break;
        
    default:
        // Si el paso no es válido, reiniciar el proceso.
        session_destroy();
        header("Location: ../../Frontend/vista/recuperar_paso1.php");
        exit();
}
?>
