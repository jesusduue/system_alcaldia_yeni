<?php
require_once('../clase/usuario_class.php');

$obj_patente = new usuario();
$obj_patente->asignar_valor();

switch ($_REQUEST["accion"]) {
    case 'insertar':
       @ $obj_patente->resultado = $obj_patente->insertar();
       $obj_patente->mensaje_registro_solvencia();   
        break;

    case 'eliminar' :
       $obj_patente->resultado = $obj_patente->eliminar();
        $obj_patente->mensaje_registro_solvencia(); 
        break;  
        
    case 'modificar':
        $obj_patente->resultado = $obj_patente->modificar();
        $obj_patente->mensaje_registro_solvencia(); 
        break;   
    
        }
    
  
?>