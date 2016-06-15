<?php
require_once '../class/UtilDB.php';
session_start();
$resultado = "";
$obj = json_decode($_POST['datos']);
$sql = sprintf("SELECT * FROM usuarios WHERE  login = '%s' AND password = '%s';", $obj->{'txtLogin'}, $obj->{'txtPassword'});
$rst = UtilDB::ejecutaConsulta($sql);
if ($rst->rowCount() > 0) {
    foreach ($rst as $row) {
        $_SESSION['cve_usuario'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['dominio'] = 'cipset.com.mx';
        $resultado = "{\"resultado\":1,\"mensaje\":\"Acceso valido\"}";
        break;
    }
    
} else {
    $resultado = "{\"resultado\":0,\"mensaje\":\"Acceso inválido\"}";
}
$rst->closeCursor();
echo($resultado);