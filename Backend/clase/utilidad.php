<?php 
// Clase Utilidad
class utilidad{

        private $nombre_servidor; // nombre del servidor (LOCALHOST)
		private $usuario_servidor; // nombre de usuario en el sevidor (root)
		private $clave_servidor; // clave de usuario para entrar el servidor
		private $nombre_bd; // el nombre de la base de datos
		private $con_bd; // variable de conexion a la base de datos
		public $consulta_bd; // la ejecucion de las consultas sql en la base de datos
		public $resultado; //
		public $puntero; //

        function __construct()
        {
           
				$this->nombre_servidor="localhost";
				$this->usuario_servidor="root";
				$this->clave_servidor="";
				$this->nombre_bd="alcaldia_patente";
			
        // Intenta conectar en el constructor
        try {
            $this->con_bd = new mysqli($this->nombre_servidor,$this->usuario_servidor,$this->clave_servidor,$this->nombre_bd);

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
      @  $this->$atributo = $valor;
        }
    }


    public function mensaje_registro_patente()
    {
        if($this->resultado == true){
            echo "<script languaje='javascript'>
                    alert('REGISTRO EXITOSO!');
                    document.location='../../vista/Frontend/dashboard.php';
                    </script>";
        }
         else{
             echo "<script languaje='javascript'>
                    alert('ERROR DE REGISTRO');
                    document.location='../../Frontend/vista/dashboard.php';
                    </script>";
         }
    }// FIN MENSAJE
    public function mensaje_registro_licencia()
    {
        if($this->resultado == true){
            echo "<script languaje='javascript'>
                    alert('REGISTRO EXITOSO!');
                    document.location='../../vista/Frontend/dashboard.php';
                    </script>";
        }
         else{
             echo "<script languaje='javascript'>
                    alert('ERROR DE REGISTRO');
                    document.location='../../Frontend/vista/dashboard.php';
                    </script>";
         }
    }// FIN MENSAJE
    public function mensaje_modificar_patente()
    {
        if($this->resultado == true){
            echo "<script languaje='javascript'>
                    alert('REGISTRO ACTUALIZADO!');
                    document.location='../../vista/Frontend/dashboard.php';
                    </script>";
        }
         else{
             echo "<script languaje='javascript'>
                    alert('ERROR');
                    document.location='../../Frontend/vista/dashboard.php';
                    </script>";
         }
    }// FIN MENSAJE


/*         			// inicio funcion
			public function conectar()
			{
				$this->conexion_bd=new mysqli($this->nombre_servidor,$this->usuario_servidor,$this->clave_servidor,$this->nombre_bd);
			}// fin funcion conectar

            public function ejecutar()
			{
		     $this->que_bd; // consulta sql a ejecutar
				return $this->conexion_bd->query($this->consulta_bd);
			}

            public function asignar_valor()
			{
				foreach ($_REQUEST as $atributo => $valor) 
				{
					$this->$atributo=$valor;				
				}
			}
            
			public function extraer_dato(){
				return $this->puntero->fetch_assoc(); // funcion de php para recorrer las tablas en la base de datos
			} */

    
}

?>