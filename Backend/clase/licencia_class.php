<?php 
require_once("utilidad.php");
/* 
  id_lic int PRIMARY KEY NOT NULL AUTO_INCREMENT,   -- Identificador unico de licencia
  fky_pat int NOT NULL,                            -- patnte asociada (debe ser id_pat)
  fec_ven date NOT NULL,                           -- Fecha de vencimiento de la licencia
  est_lic varchar(1) NOT NULL,                     -- Estado (V=Vigente, C=Caducada, P=Pendiente)
*/
class licencia extends utilidad
{
    // Atributos de la clase
    public $id_lic; // Identificador unico de licencia
    public $fky_pat; // patnte asociada (debe ser id_pat)
    public $fec_ven; // Fecha de vencimiento de la licencia
    public $est_lic; // Estado (V=Vigente, C=Caducada, P=Pendiente)

    public function insertar()
    {
     @   $this->que_bd = "INSERT INTO licencia(
        fky_pat,
        fec_ven,
        est_lic)
        VALUES('$this->fky_pat',
        '$this->fec_ven',
        '$this->est_lic')";
        $this->ejecutar();
    }
  
    public function listar()
    {
        $this->que_bd = "SELECT * FROM licencia";
        return $this->ejecutar();
    }

    public function mostrar_licencias()
    {
    @    $this->que_bd="SELECT 
        fec_ven,
        num_pat,
        nom_pat,
        rif_pat,
        est_lic from licencia 
        inner join patente on licencia.fky_pat = patente.id_pat
        where id_pat = '$this->fky_pat'";
        $this->ejecutar();
    }
}


?>
