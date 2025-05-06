<?php 
require_once("utilidad.php");
     /* 
  id_pat int PRIMARY KEY NOT NULL AUTO_INCREMENT,  -- Identificador unico de patente
  fec_pat date NOT NULL,                           -- Fecha de registro de la patente
  num_pat int DEFAULT NULL,                        -- Numero oficial de patente (podria ser unico)
  nom_pat varchar(100) NOT NULL,                   -- Nombre legal del comercio
  rep_pat varchar(100) NOT NULL,                   -- Nombre del representante legal
  rif_pat varchar(50) NOT NULL,                    -- RIF del comercio (Ej: J-12345678-9)
  ubi_pat varchar(200) NOT NULL,                   -- Direccion fisica del establecimiento
  rub_pat varchar(200) NOT NULL,                   -- Rubro o actividad economica principal
  fky_usu int NOT NULL,                            -- Usuario que realizo el registro
  est_pat varchar(1) NOT NULL,                     -- Estado (A=Activo, I=Inactivo, E=En proceso)
     */

class patente extends utilidad
    {
    // Atributos de la clase
    public $id_pat; // Identificador unico de patente
    public $fec_pat; // Fecha de registro de la patente
    public $num_pat; // Numero oficial de patente (podria ser unico)
    public $nom_pat; // Nombre legal del comercio
    public $rep_pat; // Nombre del representante legal
    public $rif_pat; // RIF del comercio (Ej: J-12345678-9)
    public $ubi_pat; // Direccion fisica del establecimiento
    public $rub_pat; // Rubro o actividad economica principal
    public $fky_usu; // Usuario que realizo el registro
    public $est_pat; // Estado (A=Activo, I=Inactivo, E=En proceso)

    public function insertar()
    {
   @     $this->que_bd =" INSERT INTO patente(
        fec_pat,
        num_pat,
        nom_pat,
        rep_pat,
        rif_pat,
        ubi_pat,
        rub_pat,
        fky_usu,
        est_pat)
        VALUES('$this->fec_pat',
        '$this->num_pat',
        '$this->nom_pat',
        '$this->rep_pat',
        '$this->rif_pat',
        '$this->ubi_pat',
        '$this->rub_pat',
        '$this->fky_usu',
        '$this->est_pat')";
        $this->ejecutar();
    }

    public function listar()
    {
     @   $this->que_bd = "SELECT * FROM patente";
        return $this->ejecutar();
    }
/* funcion para generar una nueva patente con los datos seleccionados */
    public function mostrar_patente()
    {
     @   $this->que_bd = "SELECT * FROM patente WHERE id_pat='$this->id_pat'";
        return $this->ejecutar();
    }
    public function modificar()
    { //pendiente con el fky_usu no se debe modificar por que es el usuario que lo registro
     @ $this->que_bd = "UPDATE patente SET 
        fec_pat='$this->fec_pat',
        num_pat='$this->num_pat',
        nom_pat='$this->nom_pat',
        rep_pat='$this->rep_pat',
        rif_pat='$this->rif_pat',
        ubi_pat='$this->ubi_pat',
        rub_pat='$this->rub_pat',
        fky_usu='$this->fky_usu',
        est_pat='$this->est_pat'
        WHERE id_pat='$this->id_pat'";
        $this->ejecutar();
    }
}
?>