<?php 
require_once("utilidad.php");
/*
  id_sol int PRIMARY KEY NOT NULL AUTO_INCREMENT,   -- Identificador unico de solvencia
  fky_pat int NOT NULL,                            -- patnte asociada (debe ser id_pat)
  fec_ven date NOT NULL,                           -- Fecha hasta cuando es valida la solvencia
  est_sol varchar(1) NOT NULL,                     -- Estado (V=Valida, C=Caducada, R=Rechazada) */

class solvencia extends utilidad
{
    // Atributos de la clase
    public $id_sol; // Identificador unico de solvencia
    public $fky_pat; // patnte asociada (debe ser id_pat)
    public $fec_ven; // Fecha hasta cuando es valida la solvencia
    public $est_sol; // Estado (V=Valida, C=Caducada, R=Rechazada)

    public function insertar()
    {
        $this->que_bd = "INSERT INTO solvencia(
        fky_pat,
        fec_ven,
        est_sol)
        VALUES('$this->fky_pat',
        '$this->fec_ven',
        '$this->est_sol')";
        $this->ejecutar();
    }

    public function listar()
    {
        $this->que_bd = "SELECT * FROM solvencia";
        return $this->ejecutar();
    }
     public function eliminar()
    {
        @$this->que_bd = "DELETE FROM solvencia WHERE id_sol='$this->id_sol'";
        $this->ejecutar();
    }

    public function mostrar()
{
  $filtro1=($this->id_sol!="")?" and id_sol='$this->'id_sol'":"";
  //Los % son para que se busque todo con las iniciales de los nombres.
 
@ $this->que_bd="SELECT * from solvencia WHERE 1=1 $filtro1 ORDER BY id_sol DESC;";
return $this->ejecutar();

}
}
