<?php
require_once('utilidad.php');

class patente extends utilidad {
    public $id_pate;
    public $numero_exp;
    public $razon_so;
    public $rep_legal;
    public $ced_rif;
    public $ubicacion;
    public $rubro;
    public $estado;

    public function insertar() {
        $this->consulta_bd = "INSERT INTO patente (
            numero_exp, razon_so, rep_legal, ced_rif, ubicacion, rubro, estado
        ) VALUES (
            '$this->numero_exp',
            '$this->razon_so',
            '$this->rep_legal',
            '$this->ced_rif',
            '$this->ubicacion',
            '$this->rubro',
            '$this->estado'
        )";
        return $this->ejecutar();
    }

    public function mostrar_patentes() {
        $this->consulta_bd = "SELECT * FROM patente";
        return $this->ejecutar();
    }

    public function eliminar() {
        $this->consulta_bd = "DELETE FROM patente WHERE id_pate = '$this->id_pate'";
        return $this->ejecutar();
    }

    public function modificar() {
        $this->consulta_bd = "UPDATE patente SET 
            numero_exp = '$this->numero_exp',
            razon_so = '$this->razon_so',
            rep_legal = '$this->rep_legal',
            ced_rif = '$this->ced_rif',
            ubicacion = '$this->ubicacion',
            rubro = '$this->rubro',
            estado = '$this->estado'
        WHERE id_pate = '$this->id_pate'";
        return $this->ejecutar();
    }
}
?>
