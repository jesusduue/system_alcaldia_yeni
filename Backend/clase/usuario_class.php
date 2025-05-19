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
        @ $this->que_bd = "SELECT usuario.id_usu, usuario.nom_usu, rol.rol, usuario.est_usu, usuario.fky_rol FROM usuario 
        inner join rol on usuario.fky_rol = rol.id_rol where 1=1";
        return $this->ejecutar();
    }
    public function eliminar()
    {
      @  $this->que_bd = "DELETE FROM usuario WHERE id_usu = $this->id_usu";
        $this->ejecutar();
    }

public function modificar()
    {
      @  $this->que_bd = "UPDATE usuario SET
        nom_usu = '$this->nom_usu',
        cla_usu = '$this->cla_usu',
        fky_rol = '$this->fky_rol',
        est_usu = '$this->est_usu'
        WHERE id_usu = $this->id_usu";
        $this->ejecutar();
    }

/*     
    no funciona 
public function asignar_valor()
    {
        $this->id_usu = $_POST["id_usu"];
        $this->nom_usu = $_POST["nom_usu"];
        $this->cla_usu = $_POST["cla_usu"];
        $this->fky_rol = $_POST["fky_rol"];
        $this->est_usu = $_POST["est_usu"];
    } */

}
?>