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
        $this->utilidad->que_bd = "SELECT u.*, r.rol FROM usuario u JOIN rol r ON u.fky_rol = r.id_rol WHERE nom_usu = '$nombreUsuario' AND cla_usu = '$claveUsuario'";
        $this->utilidad->puntero = $this->utilidad->ejecutar();

        return $this->utilidad->extraer_dato();
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
                    
                    echo "</script>";
            }
        }
    }
}
 catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Cerrar la conexión cuando hayas terminado
    $utilidad->cerrarConexion();
}



?>