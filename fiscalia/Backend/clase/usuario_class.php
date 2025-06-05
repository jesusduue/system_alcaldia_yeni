<?php

// Clase para gestionar los usuarios del sistema
class Usuario {
    // Propiedades de la clase (correspondientes a las columnas de la tabla usuario)
    public $id_usu;
    public $nom_usu;
    public $cla_usu;
    public $fky_perm;
    public $est_usu;

    // Constructor de la clase
    public function __construct($id_usu = null, $nom_usu = null, $cla_usu = null, $fky_perm = null, $est_usu = null) {
        $this->id_usu = $id_usu;
        $this->nom_usu = $nom_usu;
        $this->cla_usu = $cla_usu;
        $this->fky_perm = $fky_perm;
        $this->est_usu = $est_usu;
    }

    // Métodos para interactuar con la base de datos (ejemplos: crear, leer, actualizar, eliminar)
    // public function crearUsuario() { ... }
    // public function obtenerUsuarioPorId($id) { ... }
    // public function actualizarUsuario() { ... }
    // public function eliminarUsuario($id) { ... }
    // public function listarUsuarios() { ... }
}

?>