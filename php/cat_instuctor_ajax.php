<?php

require_once '../class/UtilDB.php';
require_once '../class/Especialidad.php';

$resultado = "";
$xAccion = $_POST['xAccion'];
$count = 0;

if ($xAccion == "grabarEspecialidad") {
    $e = new Especialidad();
    $e->setNombre($_POST['txtNombre2']);
    $e->setActivo(isset($_POST['cbxActivo2']));
    if ($e->grabar() > 0) {
        $resultado = "{\"resultado\":1,\"mensaje\":\"Especialidad registrada con éxito\",\"especialidad_id\":" . ($e->getId()) . "}";
    } else {
        $resultado = "{\"resultado\":0,\"mensaje\":\"Especialidad no registrada\"}";
    }
    echo($resultado);
    return;
} else if ($xAccion == "getComboEspecialidad") {
    $sql = "SELECT * FROM especialidades WHERE activo = 1 ORDER BY nombre";
    $rst = UtilDB::ejecutaConsulta($sql);
    $htm = "";
    foreach ($rst as $row) {
        $html .= "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
    }
    $html .= "<option value='2017'>----- NO ENCUENTRO MI ESPECIALIDAD ----</option>";
    $rst->closeCursor();
    echo($html);
    return;
}
?>