<?php
require('../clase/clase_patente.php');

$obj_patente = new patente();
$obj_patente->asignar_valor();

switch ($_REQUEST["accion"]) {
    case 'insertar':
        $obj_patente->resultado = $obj_patente->insertar();
        $obj_patente->mensaje();
        break;

    case 'modificar':
        $obj_patente->resultado = $obj_patente->modificar();
        $obj_patente->mensaje_modificar();
        break;

    case 'eliminar':
        $obj_patente->resultado = $obj_patente->eliminar();
        $obj_patente->mensaje_eliminar();
        break;

    case 'mostrar':
        $datos = $obj_patente->mostrar_patentes();
        while ($obj_patente->puntero = $datos->fetch_assoc()) {
            print_r($obj_patente->extraer_dato());
            echo "<br>";
        }
        break;
}
?>
