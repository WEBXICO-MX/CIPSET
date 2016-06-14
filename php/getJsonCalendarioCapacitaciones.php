<?php

require_once '../class/UtilDB.php';

$c = isset($_GET['c']) ? ((int) $_GET['c']) : 0;
$json = "";
$sql = "SELECT * FROM calendarios_capacitaciones WHERE activo = 1 AND capacitacion_id = $c";
$rst = UtilDB::ejecutaConsulta($sql);
//[{"id":51,"fecha_inicio":"2016-01-27","fecha_fin":"2016-01-29","activo":true},{"id":52,"fecha_inicio":"2016-02-10","fecha_fin":"2016-02-12","activo":true},{"id":53,"fecha_inicio":"2016-02-24","fecha_fin":"2016-02-26","activo":true},{"id":54,"fecha_inicio":"2016-03-09","fecha_fin":"2016-03-11","activo":true},{"id":55,"fecha_inicio":"2016-04-13","fecha_fin":"2016-04-15","activo":true},{"id":56,"fecha_inicio":"2016-04-27","fecha_fin":"2016-04-29","activo":true},{"id":57,"fecha_inicio":"2016-05-11","fecha_fin":"2016-05-13","activo":true},{"id":58,"fecha_inicio":"2016-05-25","fecha_fin":"2016-05-27","activo":true},{"id":59,"fecha_inicio":"2016-06-08","fecha_fin":"2016-06-10","activo":true},{"id":60,"fecha_inicio":"2016-06-22","fecha_fin":"2016-06-24","activo":true},{"id":61,"fecha_inicio":"2016-07-06","fecha_fin":"2016-07-08","activo":true},{"id":62,"fecha_inicio":"2016-08-10","fecha_fin":"2016-08-12","activo":true},{"id":63,"fecha_inicio":"2016-08-24","fecha_fin":"2016-08-26","activo":true},{"id":64,"fecha_inicio":"2016-09-07","fecha_fin":"2016-09-09","activo":true},{"id":65,"fecha_inicio":"2016-09-21","fecha_fin":"2016-09-23","activo":true},{"id":66,"fecha_inicio":"2016-10-05","fecha_fin":"2016-10-07","activo":true},{"id":67,"fecha_inicio":"2016-10-19","fecha_fin":"2016-10-21","activo":true},{"id":68,"fecha_inicio":"2016-11-09","fecha_fin":"2016-11-11","activo":true},{"id":69,"fecha_inicio":"2016-11-23","fecha_fin":"2016-11-25","activo":true}]
$size = $rst->rowCount();
$count = 0;

if ($size > 0) {
    $json .= "[";
    foreach ($rst as $row) {
        $json .= "{\"id\":" . $row['id'] . ",\"fecha_inicio\":\"" . $row['fecha_inicio'] . "\",\"fecha_fin\":\"" . $row['fecha_fin'] . "\"}";
        if (++$count < $size) {
            $json .= ",";
        }
    }
    $json .= "]";
} else {
    $json = "[]";
}
$rst->closeCursor();
header('Content-Type: application/json');
echo($json);