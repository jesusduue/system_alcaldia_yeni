<?php
class Utilidad
{
    protected $nombre_servidor;
    protected $usu_servidor;
    protected $cla_servidor;
    protected $nom_bd;
    protected $con_bd;
    public $que_bd;
    public $resultado;
    public $puntero;

    function __construct()
    {
        $this->nombre_servidor = "localhost";
        $this->usu_servidor = "root";
        $this->cla_servidor = "";
        $this->nom_bd = "alcaldia";

        // Intenta conectar en el constructor
        try {
            $this->con_bd = new mysqli($this->nombre_servidor,$this->usu_servidor,$this->cla_servidor,$this->nom_bd);

            // Verifica si hay errores en la conexión
            if ($this->con_bd->connect_error) {
                throw new Exception("Error de conexión: " . $this->con_bd->connect_error);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ejecutar()
{
    $this->resultado = $this->con_bd->query($this->que_bd);
    $this->puntero = $this->resultado;
    return $this->resultado;
}
    

    public function extraer_dato()
    {
    return $this->puntero->fetch_assoc();
    }

    public function asignar_valor()
    {
        foreach ($_REQUEST as $atributo => $valor) {
            $this->$atributo = $valor;
        }
    }

   public function mensaje()
    {
        if ($this->resultado === true) {
            echo "<script language='javascript'>\n";
            echo "alert('Procesado correctamente');\n";
            echo "</script>";
       } else {
            echo "Hubo un error";
        }

    }
    public function mensaje_personal()
    {
        if ($this->resultado === true) {
            echo "<script language='javascript'>\n";
            echo "alert('se guardo correctamente');\n";
            echo "document.location='../../frontend/vista/registrar.personal.php'";
            echo "</script>";
       } else {
           echo "Hubo un error";
       }

    }
    public function mensaje_eliminar()
    {
        if ($this->resultado === true) {
            echo "<script language='javascript'>\n";
            echo "alert('eliminado');\n";
            echo "document.location='../../frontend/vista/listado.personal.php'";
            echo "</script>";
       } else {
        echo "<script language='javascript'>\n";
        echo "alert('hubo un error ya que existe registro previo en el control de carpeta');\n";
        echo "document.location='../../frontend/vista/listado.personal.php'";
        echo "</script>";
       }
    }
    //mensajes de patentes
    public function mensaje_patente()
    {
        if ($this->resultado === true) {
            echo "<script language='javascript'>\n";
            echo "alert('registro de patente confirmado');\n";
            echo "document.location='../../frontend/vista/registro.patente.php'";
            echo "</script>";
       } else {
           echo "Hubo un error";
       }
    }
    public function mensaje_eliminar_patente()
    {
        if ($this->resultado === true) {
            echo "<script language='javascript'>\n";
            echo "alert('patente eliminada correctamente');\n";
            echo "document.location='../../frontend/vista/listado.patente.php'";
            echo "</script>";
       } else {
           echo "Hubo un error";
       }
    }
    public function mensaje_modificar_patente()
    {
        if ($this->resultado === true) {
            echo "<script language='javascript'>\n";
            echo "alert('modifico correctamente');\n";
            echo "document.location='../../frontend/vista/listado.patente.php'";
            echo "</script>";
       } else {
           echo "Hubo un error";
       }
    }
    //mensajes de catastro
    public function mensaje_catastro()
    {
        if ($this->resultado === true) {
            echo "<script language='javascript'>\n";
            echo "alert('registro de catastro confirmado');\n";
            echo "document.location='../../frontend/vista/registro.catastro.php'";
            echo "</script>";
       } else {
           echo "Hubo un error";
       }
    }   
    public function mensaje_eliminar_catastro()
    {
        if ($this->resultado === true) {
            echo "<script language='javascript'>\n";
            echo "alert('eliminado correctamente');\n";
            echo "document.location='../../frontend/vista/listado.catastro.php'";
            echo "</script>";
       } else {
           echo "Hubo un error";
       }
    }
    public function mensaje_modificar_catastro()
    {
        if ($this->resultado === true) {
            echo "<script language='javascript'>\n";
            echo "alert('modifico correctamente');\n";
            echo "document.location='../../frontend/vista/listado.catastro.php'";
            echo "</script>";
       } else {
           echo "Hubo un error";
       }
    }
   
    public function cerrarConexion()
    {
        if ($this->con_bd && !$this->con_bd->connect_errno) {

            // Verifica si la conexión está abierta antes de cerrarla
            
            if ($this->con_bd->ping()) {
                $this->con_bd->close();
            }
        }
    }
    }
    
    
    ?>
    