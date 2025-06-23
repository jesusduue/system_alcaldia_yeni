<?php
// Se asume que este archivo está en el mismo directorio que usuario_class.php
require_once("utilidad.php");
/**
 * Clase pregunta_seguridad
 *
 * Gestiona las operaciones relacionadas con la tabla `pregunta_seguridad`
 * en la base de datos.
 */
class pregunta_seguridad extends Utilidad
{
    /**
     * Constructor de la clase.
     * Llama al constructor de la clase padre (Utilidad) para establecer
     * la conexión a la base de datos.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Lista todas las preguntas de seguridad que están activas ('a').
     *
     * Prepara la consulta SQL y la ejecuta a través del método `ejecutar()`
     * heredado de la clase `Utilidad`. El resultado queda almacenado en el 
     * puntero de la clase padre, listo para ser recorrido con `extraer_dato()`.
     *
     * @return mixed El resultado de la ejecución de la consulta.
     */
    public function listar_activas()
    {
        // Consulta SQL para seleccionar las preguntas con estado 'a' (activo).
        $this->que_bd = "SELECT id_pregunta, pregunta 
                         FROM pregunta_seguridad 
                         WHERE est_pregunta = 'a'";
        
        // Ejecutar la consulta usando el método de la clase padre 'Utilidad'.
        // Este método preparará el puntero para poder usar 'extraer_dato()'.
       $this->ejecutar();

        // **CORRECCIÓN:** Devolver el objeto actual en lugar del resultado de la consulta.
        // Esto permite que la vista llame a $objeto->extraer_dato().
        return $this;
    }

    // No es necesario definir el método extraer_dato() aquí,
    // ya que se hereda directamente de la clase Utilidad.
}
?>
