<?php

// Clase para gestionar la información de las personas en la fiscalía
class Persona {
    // Propiedades de la clase (correspondientes a las columnas de la tabla persona)
    public $id_per;
    public $ced_per;
    public $nom_per;
    public $ape_per;
    public $tel_per;
    public $ema_per;
    public $dir_per;
    public $cat_per;
    public $fec_ing_per;
    public $fky_usu;
    public $est_per;

    // Constructor de la clase
    public function __construct($id_per = null, $ced_per = null, $nom_per = null, $ape_per = null, $tel_per = null, $ema_per = null, $dir_per = null, $cat_per = null, $fec_ing_per = null, $fky_usu = null, $est_per = null) {
        $this->id_per = $id_per;
        $this->ced_per = $ced_per;
        $this->nom_per = $nom_per;
        $this->ape_per = $ape_per;
        $this->tel_per = $tel_per;
        $this->ema_per = $ema_per;
        $this->dir_per = $dir_per;
        $this->cat_per = $cat_per;
        $this->fec_ing_per = $fec_ing_per;
        $this->fky_usu = $fky_usu;
        $this->est_per = $est_per;
    }

    // Métodos para interactuar con la base de datos (ejemplos: crear, leer, actualizar, eliminar)
    // public function crearPersona() { ... }
    // public function obtenerPersonaPorId($id) { ... }
    // public function actualizarPersona() { ... }
    // public function eliminarPersona($id) { ... }
    // public function listarPersonas() { ... }
}

?>