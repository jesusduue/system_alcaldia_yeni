<?php
require_once('../clase/usuario_class.php');

// 1. Datos de acceso al servidor MySQL
$host     = 'localhost';        // Dirección del servidor (puede ser IP o nombre de dominio)
$usuario  = 'root'; // Usuario con permisos sobre la base de datos
$password = ''; // Contraseña de ese usuario
$basedatos= 'alcaldia_patente'; // Nombre de la base de datos a usar

// 2. Crear la conexión con mysqli
$conexion = new mysqli($host, $usuario, $password, $basedatos);

// 3. Verificar si hubo error al conectar
if ($conexion->connect_error) {
    // Si falla la conexión, detenemos la ejecución y mostramos un mensaje
    die("Error de conexión (" . $conexion->connect_errno . "): " . $conexion->connect_error);
}

// 4. Opcional: establecer conjunto de caracteres para evitar problemas con tildes y ñ
$conexion->set_charset("utf8");

$obj_patente = new usuario();
$obj_patente->asignar_valor();

switch ($_REQUEST["accion"]) {
    case 'insertar':
       @ $obj_patente->resultado = $obj_patente->insertar();
       $obj_patente->mensaje_registro_solvencia();   
        break;

    case 'eliminar' :
        // 1. Obtener y sanear el ID de usuario a eliminar
        $id_usu = isset($_GET['id_usu']) ? intval($_GET['id_usu']) : 0;

        // 2. Preparar la consulta para contar patentes asociadas a ese usuario
        $sql_check = "SELECT COUNT(*) AS total FROM patente WHERE fky_usu = ?";
        $stmt_check = $conexion->prepare($sql_check);
        $stmt_check->bind_param('i', $id_usu);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row = $result_check->fetch_assoc();
        $patentes_count = $row['total'];  // Número de patentes encontradas

        // 3. Si hay al menos una patente, no permitir la eliminación
        if ($patentes_count > 0) {
            // Puedes reemplazar esto por un mensaje más elegante o un flash en sesión
            echo "<script>
                    alert('Este usuario no puede eliminarse porque tiene patentes registradas.');
                    window.history.back();  // Volver a la página anterior
                  </script>";
            exit; // Detener ejecución para que no siga al DELETE
        }

        // 4. Si no tiene patentes, proceder a eliminar
        $sql_delete = "DELETE FROM usuario WHERE id_usu = ?";
        $stmt_del = $conexion->prepare($sql_delete);
        $stmt_del->bind_param('i', $id_usu);
        $stmt_del->execute();

        // 5. Comprobar que efectivamente se borró
        if ($stmt_del->affected_rows > 0) {
            // Éxito: redirigir o mostrar mensaje de confirmación
            echo "<script>
                    alert('Usuario eliminado correctamente.');
                    window.location.href = '../../Frontend/vista/gestion_de_usuarios.php';
                  </script>";
        } else {
            // Error inesperado
            echo "<script>
                    alert('Error al eliminar el usuario. Inténtalo de nuevo.');
                    window.history.back();
                  </script>";
        }

        // 6. Cerrar sentencias y conexión
        $stmt_check->close();
        $stmt_del->close();
        $conexion->close();
        break;

     /*   $obj_patente->resultado = $obj_patente->eliminar();
        $obj_patente->mensaje_registro_solvencia(); */ 
        break;  
        
    case 'modificar':
        $obj_patente->resultado = $obj_patente->modificar();
        $obj_patente->mensaje_registro_solvencia(); 
        break;   
    
        }
    
  
?>