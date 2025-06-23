<?php


// Requiere la clase Utilidad
require_once('utilidad.php');

// Clase para la gestión de usuarios
class usuario extends utilidad
{
    private $utilidad;

    public function __construct($utilidad)
    {
        $this->utilidad = $utilidad;
    }

    // Método para verificar las credenciales del usuario
    public function verificarCredenciales($nombreUsuario, $claveUsuario)
    {
        // 1. Consulta SQL segura para obtener los datos del usuario por su nombre.
        // Se usa una sentencia preparada (?) para prevenir inyección SQL.
    $this->utilidad->que_bd = "SELECT u.*, r.rol 
                                  FROM usuario u 
                                  JOIN rol r ON u.fky_rol = r.id_rol 
                                  WHERE u.nom_usu = ?";

        // Prepara y ejecuta la consulta de forma segura
        $stmt = $this->utilidad->con_bd->prepare($this->utilidad->que_bd);
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        // 2. Verificar si se encontró un usuario
        if ($resultado->num_rows === 1) {
            $usuarioData = $resultado->fetch_assoc();

            // 3. Comparar la contraseña del formulario con el hash de la BD
            // password_verify() es la función segura para esta tarea.
            if (password_verify($claveUsuario, $usuarioData['cla_usu'])) {
                // Si la contraseña es correcta, retorna todos los datos del usuario.
                return $usuarioData;
            }
        }

        // Si el usuario no existe o la contraseña es incorrecta, retorna false.
        return false;
    }



}

// Clase para la gestión de sesiones
class Sesion
{
    // Método para iniciar la sesión
    public static function iniciarSesion()
    {
        session_start();
    }

    // Método para almacenar información del usuario en la sesión
    public static function establecerSesionUsuario($usuario)
    {
        $_SESSION["id_usu"] = $usuario["id_usu"];
        $_SESSION["nom_usu"] = $usuario["nom_usu"];
        $_SESSION["rol"] = $usuario["rol"];
    }

    // Método para registrar la entrada del usuario
    public static function registrarEntrada($usuario)
    {
        $utilidad = new Utilidad();
        $utilidad->que_bd = "INSERT INTO logs_acceso (id_usuario, nombre_usuario, rol_usuario, tipo_evento, fecha_hora) 
                                VALUES (?, ?, ?, 'entrada', NOW())";
        $params = [
            $usuario["id_usu"],
            $usuario["nom_usu"],
            $usuario["rol"]
        ];
        $utilidad->ejecutar($params);
        $utilidad->cerrar();
    }   


    // Método para redirigir según el rol del usuario
    public static function redirigirSegunRol($rol)
    {
        if ($rol == "admin") {
            header("Location:../../frontend/vista/dashboard.php");
        } elseif ($rol == "usuario") {
            header("Location:../../frontend/vista/dashboard.php");
        } else {
            echo "Rol no válido";
        }
    }
}

// Crear instancia de la clase Utilidad
$utilidad = new Utilidad();

try {
    // Verificar si se ha enviado un formulario de inicio de sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (isset($_POST["nom_usu"]) && isset($_POST["cla_usu"])) {
           $nom_usu = $_POST["nom_usu"];
            $cla_usu = $_POST["cla_usu"];

            // Validar la longitud y formato de las credenciales
            if (strlen($nom_usu) >=2 && strlen($cla_usu) >=3 ) {
                // Crear instancia de la clse Usuario
                $usuario = new Usuario($utilidad);

                // Verificar las credenciales del usuario
                $usuarioData = $usuario->verificarCredenciales($nom_usu, $cla_usu);

                // Verificar si se encontró un usuario con las credenciales proporcionadas
                if ($usuarioData) {
                    // Crear instancia de la clase Sesion
                    Sesion::iniciarSesion();

                    // Registrar la entrada del usuario
                    Sesion::registrarEntrada($usuarioData);

                    // Establecer información del usuario en la sesión
                    Sesion::establecerSesionUsuario($usuarioData);

                    // Redirigir según el rol del usuario
                    Sesion::redirigirSegunRol($usuarioData["rol"]);


                } else {
                    echo "<script language='javascript'>\n";
                    echo "alert('Nombre de usuario o contraseña incorrectos');\n";
                    echo "document.location='../../index.php'";
                    echo "</script>";
                }
            } else {
                echo "<script language='javascript'>\n";
                    echo "alert('los caracteres deben ser mayor a 3 caracteres y minimo 7');\n";
                    echo "document.location='../../index.php'";
                    echo "</script>";
            }
        }
    }
}
 catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Cerrar la conexión cuando hayas terminado
    $utilidad->cerrar();
}



?>