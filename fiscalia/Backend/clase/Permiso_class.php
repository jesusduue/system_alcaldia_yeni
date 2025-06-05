<?php

// Incluir el archivo de conexión a la base de datos (asumiendo que existe una conexión compartida)
// require_once 'Conexion.php'; 

/**
 * Clase para gestionar los permisos de usuarios en el sistema.
 */
class Permiso_class {
    private $conn; // Variable para la conexión a la base de datos

    /**
     * Constructor de la clase.
     * @param object $db La conexión a la base de datos.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Obtiene todos los permisos.
     * @return mysqli_result|false Retorna un resultado de mysqli o false si hay un error.
     */
    public function obtenerPermisos() {
        // Consulta SQL para seleccionar todos los permisos
        $query = "SELECT id_perm, nom_perm, est_perm FROM permiso";

        // Ejecutar la consulta
        $result = $this->conn->query($query);

        return $result;
    }

    /**
     * Obtiene un permiso por su ID.
     * @param int $id_perm El ID del permiso.
     * @return array|null Retorna un array asociativo con los datos del permiso o null si no se encuentra.
     */
    public function obtenerPermisoPorId($id_perm) {
        // Consulta SQL para seleccionar un permiso por su ID
        $query = "SELECT id_perm, nom_perm, est_perm FROM permiso WHERE id_perm = ? LIMIT 0,1";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("i", $id_perm);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        // Obtener la fila como array asociativo
        $permiso = $result->fetch_assoc();

        return $permiso;
    }

    /**
     * Crea un nuevo permiso.
     * @param string $nom_perm Nombre del permiso.
     * @param string $est_perm Estado del permiso (A=Activo, I=Inactivo).
     * @return bool Retorna true si se creó correctamente, false en caso contrario.
     */
    public function crearPermiso($nom_perm, $est_perm) {
        // Consulta SQL para insertar un nuevo permiso
        $query = "INSERT INTO permiso (nom_perm, est_perm) VALUES (?, ?)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("ss", $nom_perm, $est_perm);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Actualiza un permiso existente.
     * @param int $id_perm El ID del permiso a actualizar.
     * @param string $nom_perm Nombre del permiso.
     * @param string $est_perm Estado del permiso (A=Activo, I=Inactivo).
     * @return bool Retorna true si se actualizó correctamente, false en caso contrario.
     */
    public function actualizarPermiso($id_perm, $nom_perm, $est_perm) {
        // Consulta SQL para actualizar un permiso
        $query = "UPDATE permiso SET nom_perm = ?, est_perm = ? WHERE id_perm = ?";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("ssi", $nom_perm, $est_perm, $id_perm);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Elimina un permiso por su ID.
     * @param int $id_perm El ID del permiso a eliminar.
     * @return bool Retorna true si se eliminó correctamente, false en caso contrario.
     */
    public function eliminarPermiso($id_perm) {
        // Consulta SQL para eliminar un permiso
        $query = "DELETE FROM permiso WHERE id_perm = ?";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("i", $id_perm);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>