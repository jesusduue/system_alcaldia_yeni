<?php
require_once("utilidad.php");

class usuario extends utilidad
{
    // Atributos de la clase
    public $id_usu;
    public $nom_usu;
    public $cla_usu;
    public $fky_rol;
    public $est_usu;
    public $que_bd;
    public $id_pregunta;
    public $respuesta_seguridad;

    /**
     * Insertar nuevo usuario con transacción
     * @return int|bool ID del nuevo usuario o false en error
     */
    public function insertar()
    {
        $this->con_bd->begin_transaction();
        try {
            // Hashear contraseña del usuario
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
                // --- CAMBIO REALIZADO ---
                // Ahora pasamos la respuesta en texto plano. El método 'agregar_pregunta_usuario'
                // se encargará internamente de cifrarla.
                $this->agregar_pregunta_usuario($id_usuario, $this->id_pregunta, $this->respuesta_seguridad);
            }
            
            $this->con_bd->commit();
            return $id_usuario;
        } catch (Exception $e) {
            $this->con_bd->rollback();
            error_log("Error insertar usuario: " . $e->getMessage());
            return false;
        }
    }
    
    // ... otros métodos como listar, eliminar, modificar ...
    // (Se mantienen sin cambios)

    /**
     * Listar todos los usuarios con sus roles
     * @return mysqli_result|bool Resultado de consulta o false
     */
    public function listar()
    {
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
    public function eliminar()
    {
        $this->que_bd = "DELETE FROM usuario WHERE id_usu = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        $stmt->bind_param("i", $this->id_usu);
        return $stmt->execute();
    }

    /**
     * Modificar datos de usuario
     * @return bool True si éxito, false si falla
     */
    public function modificar()
    {
        if (!empty($this->cla_usu)) {
            $this->cla_usu = password_hash($this->cla_usu, PASSWORD_BCRYPT);
            $this->que_bd = "UPDATE usuario SET nom_usu = ?, cla_usu = ?, fky_rol = ?, est_usu = ? WHERE id_usu = ?";
            $stmt = $this->con_bd->prepare($this->que_bd);
            $stmt->bind_param("ssisi", $this->nom_usu, $this->cla_usu, $this->fky_rol, $this->est_usu, $this->id_usu);
        } else {
            $this->que_bd = "UPDATE usuario SET nom_usu = ?, fky_rol = ?, est_usu = ? WHERE id_usu = ?";
            $stmt = $this->con_bd->prepare($this->que_bd);
            $stmt->bind_param("sisi", $this->nom_usu, $this->fky_rol, $this->est_usu, $this->id_usu);
        }
        return $stmt->execute();
    }


    // ========== MÉTODOS RECUPERACIÓN CONTRASEÑA ==========

    public function verificarUsuario($nom_usu)
    {
        $this->que_bd = "SELECT id_usu, nom_usu, est_usu FROM usuario WHERE nom_usu = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        $stmt->bind_param("s", $nom_usu);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function verificar_respuesta($id_usuario, $id_pregunta, $respuesta)
    {
        $this->que_bd = "SELECT respuesta FROM usuario_pregunta WHERE fky_usu = ? AND fky_pregunta = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        $stmt->bind_param("ii", $id_usuario, $id_pregunta);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows === 1) {
            $fila = $resultado->fetch_assoc();
            // Esta función está correcta, compara texto plano con el hash.
            return password_verify($respuesta, $fila['respuesta']);
        }
        return false;
    }

    public function obtener_preguntas_usuario($id_usuario)
    {
        $this->que_bd = "SELECT up.fky_pregunta, ps.pregunta 
                         FROM usuario_pregunta up
                         JOIN pregunta_seguridad ps ON up.fky_pregunta = ps.id_pregunta
                         WHERE up.fky_usu = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizar_clave($id_usuario, $nueva_clave)
    {
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
     * @param string $respuesta Respuesta en TEXTO PLANO
     * @return bool True si éxito, false si falla
     */
    public function agregar_pregunta_usuario($id_usuario, $id_pregunta, $respuesta)
    {
        $this->eliminar_preguntas_usuario($id_usuario);
        
        // --- CAMBIO REALIZADO ---
        // Se cifra la respuesta aquí, dentro del método.
        // Esto asegura que SIEMPRE se guarde cifrada.
        $respuesta_hash = password_hash($respuesta, PASSWORD_BCRYPT);
        
        $this->que_bd = "INSERT INTO usuario_pregunta (fky_usu, fky_pregunta, respuesta) VALUES (?, ?, ?)";
        $stmt = $this->con_bd->prepare($this->que_bd);

        // --- CORRECCIÓN DE BUG ---
        // Se corrigió el método de ejecución para que use bind_param,
        // que es lo correcto para mysqli, en lugar de pasar un array a execute.
        $stmt->bind_param("iis", $id_usuario, $id_pregunta, $respuesta_hash);
        return $stmt->execute();
    }

    public function eliminar_preguntas_usuario($id_usuario)
    {
        $this->que_bd = "DELETE FROM usuario_pregunta WHERE fky_usu = ?";
        $stmt = $this->con_bd->prepare($this->que_bd);
        // --- CORRECCIÓN DE BUG ---
        // Se corrigió el método de ejecución para que use bind_param.
        $stmt->bind_param("i", $id_usuario);
        return $stmt->execute();
    }
    
    public function getById($id_usuario)
    {
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
