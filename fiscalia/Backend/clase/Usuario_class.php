<?php

// Incluir el archivo de conexión a la base de datos (asumiendo que existe una conexión compartida)
// require_once 'Conexion.php';

/**
 * Clase para gestionar los usuarios que ingresan al sistema.
 */
class Usuario_class {
    private $conn; // Variable para la conexión a la base de datos

    /**
     * Constructor de la clase.
     * @param object $db La conexión a la base de datos.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Obtiene todos los usuarios.
     * @return mysqli_result|false Retorna un resultado de mysqli o false si hay un error.
     */
    public function obtenerUsuarios() {
        // Consulta SQL para seleccionar todos los usuarios
        $query = "SELECT id_usu, nom_usu, cla_usu, fky_perm, est_usu FROM usuario";

        // Ejecutar la consulta
        $result = $this->conn->query($query);

        return $result;
    }

    /**
     * Obtiene un usuario por su ID.
     * @param int $id_usu El ID del usuario.
     * @return array|null Retorna un array asociativo con los datos del usuario o null si no se encuentra.
     */
    public function obtenerUsuarioPorId($id_usu) {
        // Consulta SQL para seleccionar un usuario por su ID
        $query = "SELECT id_usu, nom_usu, cla_usu, fky_perm, est_usu FROM usuario WHERE id_usu = ? LIMIT 0,1";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("i", $id_usu);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        // Obtener la fila como array asociativo
        $usuario = $result->fetch_assoc();

        return $usuario;
    }

    /**
     * Crea un nuevo usuario.
     * @param string $nom_usu Nombre del usuario.
     * @param string $cla_usu Clave del usuario.
     * @param int $fky_perm ID del permiso asociado al usuario.
     * @param string $est_usu Estado del usuario (A=Activo, I=Inactivo).
     * @return bool Retorna true si se creó correctamente, false en caso contrario.
     */
    public function crearUsuario($nom_usu, $cla_usu, $fky_perm, $est_usu) {
        // Consulta SQL para insertar un nuevo usuario
        $query = "INSERT INTO usuario (nom_usu, cla_usu, fky_perm, est_usu) VALUES (?, ?, ?, ?)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros (asumiendo que la clave ya está hasheada antes de pasarla aquí)
        $stmt->bind_param("ssis", $nom_usu, $cla_usu, $fky_perm, $est_usu);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Actualiza un usuario existente.
     * @param int $id_usu El ID del usuario a actualizar.
     * @param string $nom_usu Nombre del usuario.
     * @param string $cla_usu Clave del usuario.
     * @param int $fky_perm ID del permiso asociado al usuario.
     * @param string $est_usu Estado del usuario (A=Activo, I=Inactivo).
     * @return bool Retorna true si se actualizó correctamente, false en caso contrario.
     */
    public function actualizarUsuario($id_usu, $nom_usu, $cla_usu, $fky_perm, $est_usu) {
        // Consulta SQL para actualizar un usuario
        $query = "UPDATE usuario SET nom_usu = ?, cla_usu = ?, fky_perm = ?, est_usu = ? WHERE id_usu = ?";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros (asumiendo que la clave ya está hasheada antes de pasarla aquí)
        $stmt->bind_param("ssisi", $nom_usu, $cla_usu, $fky_perm, $est_usu, $id_usu);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

     /**
     * Elimina un usuario por su ID.
     * @param int $id_usu El ID del usuario a eliminar.
     * @return bool Retorna true si se eliminó correctamente, false en caso contrario.
     */
    public function eliminarUsuario($id_usu) {
        // Consulta SQL para eliminar un usuario
        $query = "DELETE FROM usuario WHERE id_usu = ?";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("i", $id_usu);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>