<?php
require_once('utilidad.class.php');//herencia
class personal extends utilidad
{
    //campos de la tabla
    public $id_usu;
    public $nom_usu;
    public $clave_usu;
    public $id_rol;
    
        public function insertar(){

            $this->que_bd="INSERT into usuario (nom_usu,clave_usu,id_rol)
            values ('$this->nom_usu','$this->clave_usu','$this->id_rol');";
            return $this->ejecutar();
        }
    
        public function listar(){

        $this->que_bd = "SELECT * FROM usuario";
        return $this->ejecutar();
        }
        public function eliminar()
        {
            $this->que_bd = "DELETE FROM usuario WHERE id_usu='$this->id_usu'";
            return $this->ejecutar();
        }
        public function obtenerPorCodigo($id_usu)
        {
            $this->que_bd = "SELECT * FROM usuario WHERE id_usu = '$id_usu'";
            return $this->ejecutar()->fetch_assoc();
        } 
        public function modificar()
    {
        $this->que_bd = "UPDATE usuario SET
      nom_usu='$this->nom_usu',
      clave_usu='$this->clave_usu',
      id_rol='$this->id_rol'
      WHERE id_usu='$this->id_usu'";
        return $this->ejecutar();
    }
      
}
?>