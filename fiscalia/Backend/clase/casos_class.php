<?php

// Clase para gestionar los casos judiciales
class Casos {
    // Propiedades de la clase (correspondientes a las columnas de la tabla casos)
    public $id_cas;
    public $fky_per;
    public $num_cas;
    public $nom_cas;
    public $cat_cas;
    public $des_cas;
    public $est_cas;

    // Constructor de la clase
    public function __construct($id_cas = null, $fky_per = null, $num_cas = null, $nom_cas = null, $cat_cas = null, $des_cas = null, $est_cas = null) {
        $this->id_cas = $id_cas;
        $this->fky_per = $fky_per;
        $this->num_cas = $num_cas;
        $this->nom_cas = $nom_cas;
        $this->cat_cas = $cat_cas;
        $this->des_cas = $des_cas;
        $this->est_cas = $est_cas;
    }

    // Métodos para interactuar con la base de datos (ejemplos: crear, leer, actualizar, eliminar)
    // public function crearCaso() { ... }
    // public function obtenerCasoPorId($id) { ... }
    // public function actualizarCaso() { ... }
    // public function eliminarCaso($id) { ... }
    // public function listarCasos() { ... }
}

?>