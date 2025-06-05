<?php

// Incluir el archivo de conexión a la base de datos (asumiendo que existe una conexión compartida)
// require_once 'Conexion.php';

/**
 * Clase para gestionar casos judiciales.
 */
class Casos_class {
    private $conn; // Variable para la conexión a la base de datos

    /**
     * Constructor de la clase.
     * @param object $db La conexión a la base de datos.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Obtiene todos los casos.
     * @return mysqli_result|false Retorna un resultado de mysqli o false si hay un error.
     */
    public function obtenerCasos() {
        // Consulta SQL para seleccionar todos los casos
        $query = "SELECT id_cas, fky_per, num_cas, nom_cas, cat_cas, des_cas, est_cas FROM casos";

        // Ejecutar la consulta
        $result = $this->conn->query($query);

        return $result;
    }

    /**
     * Obtiene un caso por su ID.
     * @param int $id_cas El ID del caso.
     * @return array|null Retorna un array asociativo con los datos del caso o null si no se encuentra.
     */
    public function obtenerCasoPorId($id_cas) {
        // Consulta SQL para seleccionar un caso por su ID
        $query = "SELECT id_cas, fky_per, num_cas, nom_cas, cat_cas, des_cas, est_cas FROM casos WHERE id_cas = ? LIMIT 0,1";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("i", $id_cas);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        // Obtener la fila como array asociativo
        $caso = $result->fetch_assoc();

        return $caso;
    }

    /**
     * Crea un nuevo caso.
     * @param int $fky_per ID de la persona vinculada al caso.
     * @param string $num_cas Número de control del informe.
     * @param string $nom_cas Nombre del caso.
     * @param string $cat_cas Categoría del caso.
     * @param string $des_cas Descripción del caso.
     * @param string $est_cas Estado del caso (A/P/C).
     * @return bool Retorna true si se creó correctamente, false en caso contrario.
     */
    public function crearCaso($fky_per, $num_cas, $nom_cas, $cat_cas, $des_cas, $est_cas) {
        // Consulta SQL para insertar un nuevo caso
        $query = "INSERT INTO casos (fky_per, num_cas, nom_cas, cat_cas, des_cas, est_cas) VALUES (?, ?, ?, ?, ?, ?)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("isssss", $fky_per, $num_cas, $nom_cas, $cat_cas, $des_cas, $est_cas);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Actualiza un caso existente.
     * @param int $id_cas El ID del caso a actualizar.
     * @param int $fky_per ID de la persona vinculada al caso.
     * @param string $num_cas Número de control del informe.
     * @param string $nom_cas Nombre del caso.
     * @param string $cat_cas Categoría del caso.
     * @param string $des_cas Descripción del caso.
     * @param string $est_cas Estado del caso (A/P/C).
     * @return bool Retorna true si se actualizó correctamente, false en caso contrario.
     */
    public function actualizarCaso($id_cas, $fky_per, $num_cas, $nom_cas, $cat_cas, $des_cas, $est_cas) {
        // Consulta SQL para actualizar un caso
        $query = "UPDATE casos SET fky_per = ?, num_cas = ?, nom_cas = ?, cat_cas = ?, des_cas = ?, est_cas = ? WHERE id_cas = ?";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("issssi", $fky_per, $num_cas, $nom_cas, $cat_cas, $des_cas, $est_cas, $id_cas);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

     /**
     * Elimina un caso por su ID.
     * @param int $id_cas El ID del caso a eliminar.
     * @return bool Retorna true si se eliminó correctamente, false en caso contrario.
     */
    public function eliminarCaso($id_cas) {
        // Consulta SQL para eliminar un caso
        $query = "DELETE FROM casos WHERE id_cas = ?";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("i", $id_cas);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>