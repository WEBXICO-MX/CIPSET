<?php
require_once '../class/UtilDB.php';

$st = isset($_GET['st']) ? ((int) $_GET['st']) : 0;

$sql = "SELECT rc.id, c.nombre AS capacitacion,c.fecha_inicio,c.fecha_fin,CONCAT(p.nombre,' ',p.ap_paterno,' ',p.ap_materno) AS nombre_completo,e.nombre AS empresa,est.nombre AS estatus,rc.fecha_registro,rc.fecha_modificacion,rc.activo ";
$sql .= "FROM registros_capacitaciones AS rc ";
$sql .= "INNER JOIN calendarios_capacitaciones AS cc ON cc.id = rc.calendario_capacitacion_Id ";
$sql .= "INNER JOIN capacitaciones AS c ON c.id = cc.capacitacion_id ";
$sql .= "INNER JOIN personas AS p ON p.id = rc.persona_id ";
$sql .= "INNER JOIN empresas AS e ON e.id = rc.empresa_id ";
$sql .= "INNER JOIN  estatus AS est ON est.id = rc.estatus_id ";
$sql .= "WHERE rc.estatus_id = $st";

$rst = UtilDB::ejecutaConsulta($sql);
$count = 0;

if ($rst->rowCount() > 0) {
    ?>
    <table class="table table-hover table-condensed table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre completo</th>
                <th>Capacitación</th>
                <th>Fechas de la capacitación</th>
                <th>Fecha de registro</th>
                <th>Fecha de modificación</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rst = UtilDB::ejecutaConsulta($sql);
            foreach ($rst as $row) {
                ?>
                <tr>
                    <td><?php echo($count); ?></td>
                    <td><a data-toggle="modal" data-target="#myModal" data-remote="mailbox_id.php?id=<?php echo($row['id']); ?>" href="javascript:void(0);"><?php echo($row['nombre_completo']); ?></a></td>
                    <td><?php echo($row['capacitacion']); ?></td>
                    <td>Fecha inicio: <?php echo($row['fecha_inicio']); ?> | Fecha fin: <?php echo($row['fecha_fin']); ?></td>
                    <td><?php echo($row['fecha_registro']); ?></td>
                    <td><?php echo($row['fecha_modificacion']); ?></td>
                </tr>
                <?php
            }
            $rst->closeCursor();
            ?>
        </tbody>
    </table>
    <?php
} else {
    ?>
    <h4>No hay registros para mostrar</h4>
    <?php
}
?>