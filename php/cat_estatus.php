<?php
require_once '../class/Estatus.php';
require_once '../class/UtilDB.php';
session_start();

if (!isset($_SESSION['cve_usuario'])) {
    header('Location:login.php');
    return;
}
    
$e = new Estatus();
$count = NULL;
$sql = "";
$rst = NULL;

if (isset($_POST['txtCveEstatus'])) {
    if (((int) $_POST['txtCveEstatus']) != 0) {
        $e = new Estatus((int) $_POST['txtCveEstatus']);
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        $e->setNombre($_POST['txtNombre']);
        $e->setActivo(isset($_POST['cbxActivo']) ? 1 : 0);
        $count = $e->grabar();
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
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Estatus</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="container">
            <?php include './includeHeader2.php'; ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <a href="home.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Atrás</a><br/>
                    <h3 class="text-center">Estatus</h3>

                    <form name="frmEstatus" id="frmEstatus" action="<?php echo($_SERVER['PHP_SELF']); ?>" role="form" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                            <input type="hidden" class="form-control" id="txtCveEstatus" name="txtCveEstatus" value="<?php echo($e->getId()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtNombre">Nombre:</label>
                            <input type="text" name="txtNombre" id="txtNombre" placeholder="Ingrese un nombre" value="<?php echo($e->getNombre()); ?>" class="form-control"  maxlength="50"/>
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
                <div class="col-md-6 col-md-offset-3">
                    <br/>
                    <br/>
                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM estatus ORDER BY id DESC";
                            $rst = UtilDB::ejecutaConsulta($sql);
                            foreach ($rst as $row) {
                                ?>
                                <tr>
                                    <th><a href="javascript:void(0);" onclick="$('#txtCveEstatus').val(<?php echo($row['id']); ?>);
                                                recargar();"><?php echo($row['id']); ?></a></th>
                                    <th><?php echo($row['nombre']); ?></th>
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
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../js/php/cat_estatus.js"></script>
    </body>
</html>
