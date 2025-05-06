<?php
require_once('utilidad.php');

class expediente extends utilidad
{
    public $id_Expediente;
    public $Num_Expediente;
    public $Nombre_Propietario;
    public $apellido_Propietario;
    public $CedulaPropietario;
    public $Direccion;
    public $Fecha_apertura;

    public function insertar() {
        $this->consulta_bd = "INSERT INTO expedientes (
            Num_Expediente,
            Nombre_Propietario,
            apellido_Propietario,
            CedulaPropietario,
            Direccion,
            Fecha_apertura
        ) VALUES (
            '$this->Num_Expediente',
            '$this->Nombre_Propietario',
            '$this->apellido_Propietario',
            '$this->CedulaPropietario',
            '$this->Direccion',
            '$this->Fecha_apertura'
        )";

        return $this->ejecutar();
    }

    public function mostrar_expedientes() {
        $this->consulta_bd = "SELECT * FROM expedientes";
        return $this->ejecutar();
    }

    public function eliminar() {
        $this->consulta_bd = "DELETE FROM expedientes WHERE id_Expediente = '$this->id_Expediente'";
        return $this->ejecutar();
    }

    public function modificar() {
        $this->consulta_bd = "UPDATE expedientes SET 
            Num_Expediente = '$this->Num_Expediente',
            Nombre_Propietario = '$this->Nombre_Propietario',
            apellido_Propietario = '$this->apellido_Propietario',
            CedulaPropietario = '$this->CedulaPropietario',
            Direccion = '$this->Direccion',
            Fecha_apertura = '$this->Fecha_apertura'
        WHERE id_Expediente = '$this->id_Expediente'";

        return $this->ejecutar();
    }
}
?>
