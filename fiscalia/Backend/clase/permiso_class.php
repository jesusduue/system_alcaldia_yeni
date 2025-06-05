<?php

// Clase para gestionar los permisos de los usuarios
class Permiso {
    // Propiedades de la clase (correspondientes a las columnas de la tabla permiso)
    public $id_perm;
    public $nom_perm;
    public $est_perm;

    // Constructor de la clase
    public function __construct($id_perm = null, $nom_perm = null, $est_perm = null) {
        $this->id_perm = $id_perm;
        $this->nom_perm = $nom_perm;
        $this->est_perm = $est_perm;
    }

    // Métodos para interactuar con la base de datos (ejemplos: crear, leer, actualizar, eliminar)
    // public function crearPermiso() { ... }
    // public function obtenerPermisoPorId($id) { ... }
    // public function actualizarPermiso() { ... }
    // public function eliminarPermiso($id) { ... }
    // public function listarPermisos() { ... }
}

?>