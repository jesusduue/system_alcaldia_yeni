<?php 
require_once("utilidad.php");

class usuario extends utilidad
{
    // Atributos de la clase
    public $id_usu;                  // ID único del usuario
    public $nom_usu;                 // Nombre de usuario
    public $cla_usu;                 // Contraseña (hash)
    public $fky_rol;                 // Rol del usuario (FK)
    public $est_usu;                 // Estado (A:Activo, I:Inactivo)
    public $que_bd;                  // Consulta SQL
    public $id_pregunta;            // ID pregunta seguridad
    public $respuesta_seguridad;     // Respuesta seguridad (hash)

    /**
     * Insertar nuevo usuario con transacción
     * @return int|bool ID del nuevo usuario o false en error
     */
    public function insertar() {
        $this->con_bd->begin_transaction();
        try {
            // Hashear contraseña
            $this->cla_usu = password_hash($this->cla_usu, PASSWORD_BCRYPT);
            
            // Insertar usuario
            $this->que_bd = "INSERT INTO usuario(nom_usu, cla_usu, fky_rol, est_usu)
                           VALUES(?, ?, ?, ?)";
            $stmt = $this->con_bd->prepare($this->que_bd);
            $stmt->bind_param("ssis", $this->nom_usu, $this->cla_usu, $this->fky_rol, $this->est_usu);
            $stmt->execute();
            
            $id_usuario = $this->con_bd->insert_id;
            
            // Insertar pregunta seguridad si existe
            if (!empty($this->id_pregunta)) {
                $respuesta_hash = password_hash($this->respuesta_seguridad, PASSWORD_BCRYPT);
                $this->agregar_pregunta_usuario($id_usuario, $this->id_pregunta, $respuesta_hash);
            }
            
            $this->con_bd->commit();
            return $id_usuario;
        } catch (Exception $e) {
            $this->con_bd->rollback();
            error_log("Error insertar usuario: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Listar todos los usuarios con sus roles
     * @return mysqli_result|bool Resultado de consulta o false
     */
    public function listar() {
        $this->que_bd = "SELECT u.id_usu, u.nom_usu, r.rol, 
                        u.est_usu, u.fky_rol 
                        FROM usuario u
                        INNER JOIN rol r ON u.fky_rol = r.id_rol
                        ORDER BY u.nom_usu";
        return $this->ejecutar();
    }

    /**
     * Eliminar usuario por ID
     * @return bool True si éxito, false si falla
     */
    public function eliminar() {
        $this->que_bd = "DELETE FROM usuario WHERE id_usu = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        $stmt->bind_param("i", $this->id_usu);
        return $stmt->execute();
    }

    /**
     * Modificar datos de usuario
     * @return bool True si éxito, false si falla
     */
    public function modificar() {
        // Actualizar con/sin contraseña
        if (!empty($this->cla_usu)) {
            $this->cla_usu = password_hash($this->cla_usu, PASSWORD_BCRYPT);
            $this->que_bd = "UPDATE usuario SET
                            nom_usu = ?,
                            cla_usu = ?,
                            fky_rol = ?,
                            est_usu = ?
                            WHERE id_usu = ?";
            $stmt = $this->con_bd->prepare($this->que_bd);
            $stmt->bind_param("ssisi", $this->nom_usu, $this->cla_usu, 
                             $this->fky_rol, $this->est_usu, $this->id_usu);
        } else {
            $this->que_bd = "UPDATE usuario SET
                            nom_usu = ?,
                            fky_rol = ?,
                            est_usu = ?
                            WHERE id_usu = ?";
            $stmt = $this->con_bd->prepare($this->que_bd);
            $stmt->bind_param("sisi", $this->nom_usu, 
                             $this->fky_rol, $this->est_usu, $this->id_usu);
        }
        
        return $stmt->execute();
    }

    // ========== MÉTODOS RECUPERACIÓN CONTRASEÑA ==========

    /**
     * Verificar existencia de usuario
     * @param string $nom_usu Nombre usuario
     * @return array|bool Datos usuario o false
     */
    public function verificarUsuario($nom_usu) {
        $this->que_bd = "SELECT id_usu, nom_usu, est_usu 
                        FROM usuario 
                        WHERE nom_usu = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        $stmt->bind_param("s", $nom_usu);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Verificar respuesta de seguridad
     * @param int $id_usuario ID usuario
     * @param int $id_pregunta ID pregunta
     * @param string $respuesta Respuesta a verificar
     * @return bool True si coincide, false si no
     */
    public function verificar_respuesta($id_usuario, $id_pregunta, $respuesta) {
        $this->que_bd = "SELECT respuesta FROM usuario_pregunta 
                        WHERE fky_usu = ? AND fky_pregunta = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        $stmt->bind_param("ii", $id_usuario, $id_pregunta);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows === 1) {
            $fila = $resultado->fetch_assoc();
            return password_verify($respuesta, $fila['respuesta']);
        }
        return false;
    }

    /**
     * Obtener pregunta de seguridad de usuario
     * @param int $id_usuario ID usuario
     * @return array|bool Datos pregunta o false
     */
    public function obtener_preguntas_usuario($id_usuario) {
        $this->que_bd = "SELECT up.fky_pregunta, ps.pregunta 
                        FROM usuario_pregunta up
                        JOIN pregunta_seguridad ps ON up.fky_pregunta = ps.id_pregunta
                        WHERE up.fky_usu = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Actualizar contraseña de usuario
     * @param int $id_usuario ID usuario
     * @param string $nueva_clave Nueva contraseña
     * @return bool True si éxito, false si falla
     */
    public function actualizar_clave($id_usuario, $nueva_clave) {
        $hash = password_hash($nueva_clave, PASSWORD_BCRYPT);
        $this->que_bd = "UPDATE usuario SET cla_usu = ? WHERE id_usu = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        $stmt->bind_param("si", $hash, $id_usuario);
        return $stmt->execute();
    }

    // ========== MÉTODOS PREGUNTAS SEGURIDAD ==========

    /**
     * Agregar pregunta de seguridad a usuario
     * @param int $id_usuario ID usuario
     * @param int $id_pregunta ID pregunta
     * @param string $respuesta_hash Respuesta hasheada
     * @return bool True si éxito, false si falla
     */
    public function agregar_pregunta_usuario($id_usuario, $id_pregunta, $respuesta_hash) {
        $this->eliminar_preguntas_usuario($id_usuario);
        
        $this->que_bd = "INSERT INTO usuario_pregunta (fky_usu, fky_pregunta, respuesta) 
                        VALUES (?, ?, ?)";
        $stmt = $this->con_bd->prepare($this->que_bd);
        return $stmt->execute([$id_usuario, $id_pregunta, $respuesta_hash]);
    }

    /**
     * Eliminar preguntas de usuario
     * @param int $id_usuario ID usuario
     * @return bool True si éxito, false si falla
     */
    public function eliminar_preguntas_usuario($id_usuario) {
        $this->que_bd = "DELETE FROM usuario_pregunta WHERE fky_usu = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        return $stmt->execute([$id_usuario]);
    }

    /**
     * Obtener usuario por ID
     * @param int $id_usuario ID usuario
     * @return array|bool Datos usuario o false
     */
    public function getById($id_usuario) {
        $this->que_bd = "SELECT u.*, r.rol 
                        FROM usuario u
                        JOIN rol r ON u.fky_rol = r.id_rol
                        WHERE u.id_usu = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>