<?php
require_once '../class/Usuario.php';
require_once '../class/TipoCapacitacion.php';
require_once '../class/CategoriaCapacitacion.php';
require_once '../class/Capacitacion.php';
require_once '../class/CalendarioCapacitacion.php';
require_once '../class/UtilDB.php';
session_start();

if (!isset($_SESSION['dominio']) or !isset($_SESSION['cve_usuario'])) {
    header('Location:login.php');
    return;
}

$cc = new CalendarioCapacitacion();
$count = NULL;
$sql = "";
$rst = NULL;

if (isset($_POST['txtCalendarioCapacitacion'])) {
    if (((int) $_POST['txtCalendarioCapacitacion']) != 0) {
        $cc = new CalendarioCapacitacion((int) $_POST['txtCalendarioCapacitacion']);
        $cc->setUsuarioModifico(new Usuario((int) $_SESSION['cve_usuario']));
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        $cc->setCapacitacionId(new Capacitacion((int) $_POST['cmbCapacitacion']));
        $cc->setFechaInicio($_POST['txtFechaInicio']);
        $cc->setFechaFin($_POST['txtFechaFin']);
        $cc->setUsuarioRegistro(new Usuario((int) $_SESSION['cve_usuario']));
        $cc->setActivo(isset($_POST['cbxActivo']) ? 1 : 0);
        $count = $cc->grabar();
    }


    if ($_POST['xAccion'] == 'logout') {
        unset($_SESSION['cve_usuario']);
        unset($_SESSION['nombre']);
        header('Location:login.php');
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Calendario de capacitaciones</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/jquery-ui/themes/blitzer/jquery-ui.min.css" rel="stylesheet"/>
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="container">
            <?php include './includeHeader2.php'; ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <a href="home.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Atrás</a><br/>
                    <h3 class="text-center">Calendario de capacitaciones</h3>

                    <form name="frmCapacitacion" id="frmCapacitacion" action="<?php echo($_SERVER['PHP_SELF']); ?>" role="form" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                            <input type="hidden" class="form-control" id="txtCalendarioCapacitacion" name="txtCalendarioCapacitacion" value="<?php echo($cc->getId()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="cmbCapacitacion">Capacitación</label>
                            <select name="cmbCapacitacion" id="cmbCapacitacion" class="form-control">
                                <option value="0">--------- Seleccione una opción ---------</option>
                                <?php
                                $sql = "SELECT * FROM capacitaciones WHERE activo = 1 ORDER BY nombre";
                                $rst = UtilDB::ejecutaConsulta($sql);
                                foreach ($rst as $row) {
                                    echo("<option value=\"" . $row['id'] . "\" " . ($cc->getId() != 0 ? ($cc->getCapacitacionId()->getId() == $row['id'] ? "selected" : "") : "") . ">" . $row['nombre'] . "</option>");
                                }
                                $rst->closeCursor();
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="date-form">
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label for="txtFechaInicio">Fecha inicio:</label>
                                        <div class="controls">
                                            <div class="input-group">
                                                <input id="txtFechaInicio" name="txtFechaInicio" type="text" class="date-picker form-control"  value="<?php echo($cc->getFechaInicio()); ?>"/>
                                                <label for="txtFechaInicio" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="date-form">
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label for="txtFechaFin">Fecha fin:</label>
                                        <div class="controls">
                                            <div class="input-group">
                                                <input id="txtFechaFin" name="txtFechaFin" type="text" class="date-picker form-control"  value="<?php echo($cc->getFechaFin()); ?>"/>
                                                <label for="txtFechaFin" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="cbxActivo" id="cbxActivo" checked/>¿Activo?</label>
                        </div>
                        <button type="button" class="btn btn-primary" id="btnLimpiar" name="btnLimpiar" onclick="limpiar();">Limpiar</button>
                        <button type="button" class="btn btn-success" id="btnGrabar" name="btnGrabar" onclick="grabar();">Guardar</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <br/>
                    <br/>
                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Capacitación</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT cc.id,c.nombre AS capacitacion,cc.fecha_inicio,cc.fecha_fin,cc.activo FROM calendarios_capacitaciones AS cc ";
                            $sql .= "INNER JOIN capacitaciones AS c ON c.id = cc.capacitacion_id ";
                            $sql .= "ORDER BY cc.fecha_registro DESC";                         
                            
                            $rst = UtilDB::ejecutaConsulta($sql);
                            foreach ($rst as $row) {
                                ?>
                                <tr>
                                    <th><a href="javascript:void(0);" onclick="$('#txtCalendarioCapacitacion').val(<?php echo($row['id']); ?>);
                                                recargar();"><?php echo($row['id']); ?></a></th>
                                    <th><?php echo($row['capacitacion']); ?></th>
                                    <th><?php echo($row['fecha_inicio']); ?></th>
                                    <th><?php echo($row['fecha_fin']); ?></th>
                                    <th><?php echo($row['activo'] == 1 ? "Si" : "No"); ?></th>                                    
                                </tr>
                            <?php } $rst->closeCursor(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <?php include './includeFooter.php'; ?>
            </div>
        </div>
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script src="../bower_components/jquery-ui/ui/i18n/datepicker-es.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>     
        <script src="../js/php/cat_calendario_capacitaciones.js"></script>
    </body>
</html>
