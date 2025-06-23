<?php
require_once('../clase/licencia_class.php');

$obj_patente = new licencia();
$obj_patente->asignar_valor();

switch ($_REQUEST["accion"]) {
    case 'insertar':
        $obj_patente->resultado = $obj_patente->insertar();
         $obj_patente->mensaje_registro_licencia();   
        break;

        case 'eliminar':
        $obj_patente->resultado = $obj_patente->eliminar_licencia();
        $obj_patente->mensaje_registro_licencia();
        break;

}
?>