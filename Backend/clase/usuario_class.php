<?php 
require_once("utilidad.php");
/* 
  id_usu int PRIMARY KEY NOT NULL AUTO_INCREMENT,  -- ID unico del usuario
  nom_usu varchar(50) NOT NULL,                    -- Nombre de usuario para login
  cla_usu varchar(50) NOT NULL,                    -- Clave de acceso (deberia ser campo cifrado en produccion)
  fky_rol int NOT NULL,                            -- Rol asignado (relacion con tabla rol)
  est_usu varchar(1) NOT NULL,                     -- Estado usuario: A activo, I inactivo
*/

class usuario extends utilidad
{
    // Atributos de la clase
    public $id_usu; // ID unico del usuario
    public $nom_usu; // Nombre de usuario para login
    public $cla_usu; // Clave de acceso (deberia ser campo cifrado en produccion)
    public $fky_rol; // Rol asignado (relacion con tabla rol)
    public $est_usu; // Estado usuario: A activo, I inactivo

    public function insertar()
    {
        $this->que_bd = "INSERT INTO usuario(
        nom_usu,
        cla_usu,
        fky_rol,
        est_usu)
        VALUES('$this->nom_usu',
        '$this->cla_usu',
        '$this->fky_rol',
        '$this->est_usu')";
        $this->ejecutar();
    }

    public function listar()
    {
        $this->que_bd = "SELECT * FROM usuario";
        return $this->ejecutar();
    }


}
?>