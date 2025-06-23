<?php
/**
 * Clase Utilidad para manejo de base de datos y operaciones comunes
 */
class Utilidad {
    // Configuración de conexión
    protected $nombre_servidor = "localhost";
    protected $usuario_servidor = "root";
    protected $clave_servidor = "";
    protected $nombre_bd = "alcaldia_patente";
    
    // Propiedades de operación
    public $que_bd;      // Almacena la consulta SQL
    public $resultado;   // Resultado de operaciones
    public $puntero;     // Para recorrer resultados
    protected $con_bd;   // Conexión a la base de datos
    
    /**
     * Constructor - Establece la conexión automáticamente
     */
    public function __construct() {
        $this->conectar();
    }
    
    /**
     * Establece conexión con la base de datos
     * @throws Exception Si falla la conexión
     */
    protected function conectar() {
        $this->con_bd = new mysqli(
            $this->nombre_servidor,
            $this->usuario_servidor,
            $this->clave_servidor,
            $this->nombre_bd
        );
        
        if ($this->con_bd->connect_error) {
            throw new Exception("Error de conexión: " . $this->con_bd->connect_error);
        }
        
        $this->con_bd->set_charset("utf8");
    }
    
    /**
     * Ejecuta una consulta SQL con seguridad
     * @param array $params Parámetros para consulta preparada
     * @return mixed Resultado de la consulta
     * @throws Exception Si hay error en la consulta
     */
    public function ejecutar($params = []) {
        if (!$this->con_bd || !$this->con_bd->ping()) {
            $this->conectar(); // Reconoectar si es necesario
        }
        
        $stmt = $this->con_bd->prepare($this->que_bd);
        if (!$stmt) {
            throw new Exception("Error al preparar consulta: " . $this->con_bd->error);
        }
        
        if (!empty($params)) {
            $types = $this->determinarTipos($params);
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        
        // Manejar diferentes tipos de consultas
        if ($stmt->field_count > 0) {
            $this->resultado = $stmt->get_result();
            $this->puntero = $this->resultado;
            return $this->resultado;
        }
        
        $this->resultado = $stmt->affected_rows > 0;
        return $this->resultado;
    }
    
    /**
     * Extrae un registro como array asociativo
     * @return array|null
     */
    public function extraer_dato() {
        return $this->puntero ? $this->puntero->fetch_assoc() : null;
    }
    
    /**
     * Extrae todos los registros
     * @return array
     */
    public function extraer_todo() {
        $resultados = [];
        if ($this->puntero) {
            while ($fila = $this->puntero->fetch_assoc()) {
                $resultados[] = $fila;
            }
        }
        return $resultados;
    }
    
    /**
     * Asigna valores desde $_REQUEST a propiedades
     */
    public function asignar_valor() {
        foreach ($_REQUEST as $atributo => $valor) {
            if (property_exists($this, $atributo)) {
                $this->$atributo = $this->sanitizar($valor);
            }
        }
    }
    
    /**
     * Cierra la conexión a la base de datos
     */
    public function cerrar() {
        if ($this->con_bd) {
            $this->con_bd->close();
            $this->con_bd = null;
        }
    }
    
    // ========== MÉTODOS DE MENSAJES ==========
    
    public function mensaje_registro_patente() {
        $this->mostrar_mensaje(
            $this->resultado,
            'REGISTRO EXITOSO!',
            '../../Frontend/vista/listado_patente.php'
        );
    }
    
    public function mensaje_registro_licencia() {
        $this->mostrar_mensaje(
            $this->resultado,
            'REGISTRO EXITOSO!',
            '../../Frontend/vista/listado_patente.php'
        );
    }
    
    public function mensaje_modificar_patente() {
        $this->mostrar_mensaje(
            $this->resultado,
            'REGISTRO ACTUALIZADO!',
            '../../Frontend/vista/listado_patente.php'
        );
    }
    
    public function mensaje_registro_solvencia() {
        $this->mostrar_mensaje(
            $this->resultado,
            'REGISTRO EXITOSO!',
            '../../Frontend/vista/listado_patente.php'
        );
    }
    
    // ========== MÉTODOS PRIVADOS ==========
    
    /**
     * Determina tipos para consultas preparadas
     */
    private function determinarTipos($params) {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) $types .= 'i';
            elseif (is_float($param)) $types .= 'd';
            elseif (is_string($param)) $types .= 's';
            else $types .= 'b';
        }
        return $types;
    }
    
    /**
     * Sanitiza entradas
     */
    private function sanitizar($valor) {
        if (is_string($valor)) {
            return $this->con_bd ? 
                   $this->con_bd->real_escape_string($valor) : 
                   htmlspecialchars($valor, ENT_QUOTES);
        }
        return $valor;
    }
    
    /**
     * Muestra mensaje genérico
     */
    private function mostrar_mensaje($condicion, $mensaje, $redireccion) {
        $location = $condicion ? $redireccion : str_replace('../../vista/', '../../', $redireccion);
        echo "<script>
                alert('$mensaje');
                document.location='$location';
              </script>";
    }
    
    /**
     * Destructor - Cierra conexión automáticamente
     */
    public function __destruct() {
        $this->cerrar();
    }
}
?>