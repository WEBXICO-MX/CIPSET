<?php

require_once '../class/UtilDB.php';

$xAccion = $_POST['xAccion'];
$obj = json_decode($_POST['datos']);
$sql = "";
$xCveEstatus = (int) $obj->{'xCveEstatus'};
$xCveEstatusActual = (int) $obj->{'xCveEstatusActual'};
$xCveRegistroCapacitacion = (int) $obj->{'xCveRegistroCapacitacion'};

if ($xAccion == "cambiarStatus") {
    $sql = "UPDATE registros_capacitaciones SET estatus_id = $xCveEstatus, fecha_modificacion = NOW() WHERE id = $xCveRegistroCapacitacion";
    $count = UtilDB::ejecutaSQL($sql);

    if ($count > 0) {
        $resultado = "{\"resultado\":1,\"mensaje\":\"Estatus cambiado con éxito\",\"estatus\":".$xCveEstatusActual."}";
    } else {
        $resultado = "{\"resultado\":0,\"mensaje\":\"Estatus no cambiado\"}";
    }
} else {
    $resultado = "{\"resultado\":0,\"mensaje\":\"Acción no valida\"}";
}
echo($resultado);