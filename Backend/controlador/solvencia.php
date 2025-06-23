<?php
require_once('../clase/solvencia_class.php');

$obj_patente = new solvencia();
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
        }

  
?>