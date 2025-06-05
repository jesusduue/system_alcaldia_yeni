<?php

// Incluir el archivo de conexión a la base de datos (asumiendo que existe una conexión compartida)
// require_once 'Conexion.php';

/**
 * Clase para registrar información de personas en la fiscalía.
 */
class Persona_class {
    private $conn; // Variable para la conexión a la base de datos

    /**
     * Constructor de la clase.
     * @param object $db La conexión a la base de datos.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Obtiene todas las personas.
     * @return mysqli_result|false Retorna un resultado de mysqli o false si hay un error.
     */
    public function obtenerPersonas() {
        // Consulta SQL para seleccionar todas las personas
        $query = "SELECT id_per, ced_per, nom_per, ape_per, tel_per, ema_per, dir_per, cat_per, fec_ing_per, fky_usu, est_per FROM persona";

        // Ejecutar la consulta
        $result = $this->conn->query($query);

        return $result;
    }

    /**
     * Obtiene una persona por su ID.
     * @param int $id_per El ID de la persona.
     * @return array|null Retorna un array asociativo con los datos de la persona o null si no se encuentra.
     */
    public function obtenerPersonaPorId($id_per) {
        // Consulta SQL para seleccionar una persona por su ID
        $query = "SELECT id_per, ced_per, nom_per, ape_per, tel_per, ema_per, dir_per, cat_per, fec_ing_per, fky_usu, est_per FROM persona WHERE id_per = ? LIMIT 0,1";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("i", $id_per);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        // Obtener la fila como array asociativo
        $persona = $result->fetch_assoc();

        return $persona;
    }

    /**
     * Crea una nueva persona.
     * @param string $ced_per Cédula o rif de la persona.
     * @param string $nom_per Nombres de la persona.
     * @param string $ape_per Apellidos de la persona.
     * @param string $tel_per Teléfono de la persona.
     * @param string $ema_per Correo de la persona.
     * @param string $dir_per Dirección de la persona.
     * @param string $cat_per Categoría de la persona (Militar/Civil).
     * @param string $fec_ing_per Fecha de ingreso (formato YYYY-MM-DD).
     * @param int $fky_usu ID del usuario que realizó el registro.
     * @param string $est_per Estado de la persona (A=Activo, I=Inactivo).
     * @return bool Retorna true si se creó correctamente, false en caso contrario.
     */
    public function crearPersona($ced_per, $nom_per, $ape_per, $tel_per, $ema_per, $dir_per, $cat_per, $fec_ing_per, $fky_usu, $est_per) {
        // Consulta SQL para insertar una nueva persona
        $query = "INSERT INTO persona (ced_per, nom_per, ape_per, tel_per, ema_per, dir_per, cat_per, fec_ing_per, fky_usu, est_per) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("ssssssssis", $ced_per, $nom_per, $ape_per, $tel_per, $ema_per, $dir_per, $cat_per, $fec_ing_per, $fky_usu, $est_per);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Actualiza una persona existente.
     * @param int $id_per El ID de la persona a actualizar.
     * @param string $ced_per Cédula o rif de la persona.
     * @param string $nom_per Nombres de la persona.
     * @param string $ape_per Apellidos de la persona.
     * @param string $tel_per Teléfono de la persona.
     * @param string $ema_per Correo de la persona.
     * @param string $dir_per Dirección de la persona.
     * @param string $cat_per Categoría de la persona (Militar/Civil).
     * @param string $fec_ing_per Fecha de ingreso (formato YYYY-MM-DD).
     * @param int $fky_usu ID del usuario que realizó el registro.
     * @param string $est_per Estado de la persona (A=Activo, I=Inactivo).
     * @return bool Retorna true si se actualizó correctamente, false en caso contrario.
     */
    public function actualizarPersona($id_per, $ced_per, $nom_per, $ape_per, $tel_per, $ema_per, $dir_per, $cat_per, $fec_ing_per, $fky_usu, $est_per) {
        // Consulta SQL para actualizar una persona
        $query = "UPDATE persona SET ced_per = ?, nom_per = ?, ape_per = ?, tel_per = ?, ema_per = ?, dir_per = ?, cat_per = ?, fec_ing_per = ?, fky_usu = ?, est_per = ? WHERE id_per = ?";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("ssssssssisi", $ced_per, $nom_per, $ape_per, $tel_per, $ema_per, $dir_per, $cat_per, $fec_ing_per, $fky_usu, $est_per, $id_per);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

     /**
     * Elimina una persona por su ID.
     * @param int $id_per El ID de la persona a eliminar.
     * @return bool Retorna true si se eliminó correctamente, false en caso contrario.
     */
    public function eliminarPersona($id_per) {
        // Consulta SQL para eliminar una persona
        $query = "DELETE FROM persona WHERE id_per = ?";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("i", $id_per);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>