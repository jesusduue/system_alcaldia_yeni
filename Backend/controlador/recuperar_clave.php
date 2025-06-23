<?php
// Backend/controlador/recuperar_clave.php
require_once("../clase/usuario_class.php");

$usuario = new usuario();

// Proceso en 3 pasos:
// 1. Verificar nombre de usuario
// 2. Responder pregunta de seguridad
// 3. Establecer nueva contraseña

$paso = isset($_GET['paso']) ? (int)$_GET['paso'] : 1;

switch ($paso) {
    case 1:
        // Paso 1: Verificar nombre de usuario
        if (isset($_POST['nom_usu'])) {
            $nom_usu = trim($_POST['nom_usu']);
            $usuario->nom_usu = $nom_usu;
            $datos_usuario = $usuario->verificarUsuario($nom_usu);
            
            if ($datos_usuario && isset($datos_usuario['id_usu'])) {
                // Obtener pregunta de seguridad del usuario
                $pregunta = $usuario->obtener_preguntas_usuario($datos_usuario['id_usu']);
                
                if ($pregunta && isset($pregunta['id_pregunta'])) {
                    // Redirigir al paso 2 con los datos necesarios
                    header("Location: recuperar_clave.php?paso=2&id_usu=".$datos_usuario['id_usu']."&id_pregunta=".$pregunta['id_pregunta']);
                    exit();
                } else {
                    $error = "El usuario no tiene pregunta de seguridad configurada.";
                }
            } else {
                $error = "Nombre de usuario no encontrado.";
            }
        }
        include("../../Frontend/vista/recuperar_paso1.php");
        break;
        
    case 2:
        // Paso 2: Verificar respuesta de seguridad
        // Validar que los parámetros GET existen
        if (!isset($_GET['id_usu']) || !isset($_GET['id_pregunta'])) {
            $error = "Datos incompletos. Por favor inicie el proceso nuevamente.";
            include("../../Frontend/vista/recuperar_paso1.php");
            break;
        }

        $id_usuario = (int)$_GET['id_usu'];
        $id_pregunta = (int)$_GET['id_pregunta'];

        if (isset($_POST['respuesta'])) {
            $respuesta = trim($_POST['respuesta']);
            
            if ($usuario->verificar_respuesta($id_usuario, $id_pregunta, $respuesta)) {
                // Respuesta correcta, redirigir al paso 3
                header("Location: recuperar_clave.php?paso=3&id_usu=".$id_usuario);
                exit();
            } else {
                $error = "Respuesta incorrecta. Intente nuevamente.";
            }
        }
        
        include("../../Frontend/vista/recuperar_paso2.php");
        break;
        
    case 3:
        // Paso 3: Establecer nueva contraseña
        // Validar que el parámetro GET existe
        if (!isset($_GET['id_usu'])) {
            $error = "Datos incompletos. Por favor inicie el proceso nuevamente.";
            include("../../Frontend/vista/recuperar_paso1.php");
            break;
        }

        $id_usuario = (int)$_GET['id_usu'];

        if (isset($_POST['nueva_clave']) && isset($_POST['confirmar_clave'])) {
            $nueva_clave = $_POST['nueva_clave'];
            $confirmar_clave = $_POST['confirmar_clave'];
            
            if ($nueva_clave === $confirmar_clave) {
                if (strlen($nueva_clave) < 8) {
                    $error = "La contraseña debe tener al menos 8 caracteres.";
                } elseif ($usuario->actualizar_clave($id_usuario, $nueva_clave)) {
                    $mensaje = "Contraseña actualizada correctamente. Ahora puede iniciar sesión.";
                    include("../../Frontend/vista/recuperar_exito.php");
                    exit();
                } else {
                    $error = "Error al actualizar la contraseña.";
                }
            } else {
                $error = "Las contraseñas no coinciden.";
            }
        }
        
        include("../../Frontend/vista/recuperar_paso3.php");
        break;
        
    default:
        header("Location: recuperar_clave.php?paso=1");
        exit();
}
?>