<?php
require_once('utilidad.class.php');
class Patente extends Utilidad
{
    public $id_pate;
    public $numero_exp;
    public $razon_so;
    public $rep_legal;
    public $ced_rif;
    public $ubicacion;
    public $rubro;
    public $estado;

    public function insertar()
    {
     echo  $this->que_bd = "INSERT INTO patente (numero_exp, razon_so, rep_legal, ced_rif, ubicacion, rubro, estado)
        VALUES ('$this->numero_exp',
                '$this->razon_so',
                '$this->rep_legal',
                '$this->ced_rif',
                '$this->ubicacion',
                '$this->rubro',
                '$this->estado')";
        return $this->ejecutar();
    }

    public function listar()
    {
        $this->que_bd = "SELECT * FROM patente";
        return $this->ejecutar();
    }
    
    public function modificar()
    {
        $this->que_bd = "UPDATE patente SET
                          numero_exp='$this->numero_exp',
                          razon_so='$this->razon_so',
                          rep_legal='$this->rep_legal',
                          ced_rif='$this->ced_rif',
                          ubicacion='$this->ubicacion',
                          rubro='$this->rubro',
                          estado='$this->estado'
                          WHERE id_pate='$this->id_pate'";
        return $this->ejecutar();
    }

    public function eliminar()
    {
        $this->que_bd = "DELETE FROM patente WHERE id_pate='$this->id_pate'";
        $resultado = $this->ejecutar();

        // Verificar si la eliminación fue exitosa
        if (!$resultado) {
            echo "Error en la eliminación: " . $this->con_bd->error;
        }

        return $resultado;
    }
    public function obtenerPorCodigo($id_pate)
    {
        $this->que_bd = "SELECT * FROM patente WHERE id_pate = '$id_pate'";
        return $this->ejecutar()->fetch_assoc();
    } 
    public function obtenerDescripcionPorId($idPatente)
    {
        $this->que_bd = "SELECT ubicacion FROM patente WHERE id_pate = '$idPatente'";
        $resultado = $this->ejecutar();

        if ($resultado) {
            $patente = $resultado->fetch_assoc();
            return $patente['ubicacion'];
        } else {
            return "Descripción no disponible";
        }
    }
}
?>