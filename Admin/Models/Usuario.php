<?php
require_once 'Conexion.php';

class Usuario
{
    private $pdo;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function autenticar($nombre, $clave)
    {
        $sql = "SELECT * FROM usuario WHERE nom_usu = :nombre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nombre' => $nombre]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($clave, $usuario['clave_usu'])) {
            return $usuario;
        } else {
            return false;
        }
    }
}
?>