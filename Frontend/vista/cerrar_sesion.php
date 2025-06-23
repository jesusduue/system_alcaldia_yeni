<?php
// Habilitar reporte de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Ruta relativa correcta para utilidad.php (ajusta según tu estructura)
$ruta_utilidad = '../../Backend/clase/utilidad.php';

if (!file_exists($ruta_utilidad)) {
    die("Error: No se pudo encontrar el archivo utilidad.php en: $ruta_utilidad");
}

require_once($ruta_utilidad);

if (isset($_SESSION["id_usu"])) {
    try {
        $utilidad = new Utilidad();
        
        // Registrar salida usando consulta preparada
        $utilidad->que_bd = "INSERT INTO logs_acceso 
                            (id_usuario, nombre_usuario, rol_usuario, tipo_evento, fecha_hora) 
                            VALUES (?, ?, ?, 'salida', NOW())";
        
        $params = [
            $_SESSION["id_usu"],
            $_SESSION["nom_usu"],
            $_SESSION["rol"]
        ];
        
        $utilidad->ejecutar($params);
        
        // Cerrar conexión si el método existe
        if (method_exists($utilidad, 'cerrar')) {
            $utilidad->cerrar();
        }
    } catch (Exception $e) {
        error_log("Error al registrar salida: " . $e->getMessage());
    }
}

// Destruir sesión
session_unset();
session_destroy();

// Redireccionar
header("Location: ../../index.php");
exit();
?>