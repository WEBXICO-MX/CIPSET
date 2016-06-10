<?php
require_once '../class/SectorProductivo.php';
require_once '../class/Empresa.php';
require_once '../class/UtilDB.php';
session_start();

if (!isset($_SESSION['cve_usuario'])) {
    header('Location:login.php');
    return;
}

$e = new Empresa();
$count = NULL;
$sql = "";
$rst = NULL;

if (isset($_POST['txtCveEmpresa'])) {
    if (((int) $_POST['txtCveEmpresa']) != 0) {
        $e = new Empresa((int) $_POST['txtCveEmpresa']);
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        $e->setSectorProductivoId(new SectorProductivo((int) $_POST['cmbSectorProductivo']));
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
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Empresas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="container">
            <?php include './footer.php'; ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <a href="home.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Atrás</a><br/>
                    <h3 class="text-center">Empresas</h3>

                    <form name="frmEmpresa" id="frmEmpresa" action="<?php echo($_SERVER['PHP_SELF']); ?>" role="form" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                            <input type="hidden" class="form-control" id="txtCveEmpresa" name="txtCveEmpresa" value="<?php echo($e->getId()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="cmbSectorProductivo">Sectores productivos</label>
                            <select name="cmbSectorProductivo" id="cmbSectorProductivo" class="form-control">
                                <option value="0">--------- Seleccione una opción ---------</option>
                                <?php
                                $eql = "SELECT * FROM sectores_productivos WHERE activo = 1 ORDER BY nombre";
                                $rst = UtilDB::ejecutaConsulta($eql);
                                foreach ($rst as $row) {
                                    echo("<option value=\"" . $row['id'] . "\" " . ($e->getId() != 0 ? ($e->getSectorProductivoId()->getId() == $row['id'] ? "selected" : "") : "") . ">" . $row['nombre'] . "</option>");
                                }
                                $rst->closeCursor();
                                ?>
                            </select>
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
                                <th>Empresa</th>
                                <th>Sector productivo</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT e.id, sp.nombre AS sector_productivo, e.nombre, e.activo FROM empresas AS e ";
                            $sql .= "INNER JOIN sectores_productivos AS sp ON sp.id = e.sector_productivo_id ";
                            $sql .= "ORDER BY e.fecha_registro DESC";                          
                            
                            $rst = UtilDB::ejecutaConsulta($sql);
                            foreach ($rst as $row) {
                                ?>
                                <tr>
                                    <th><a href="javascript:void(0);" onclick="$('#txtCveEmpresa').val(<?php echo($row['id']); ?>);
                                                recargar();"><?php echo($row['id']); ?></a></th>
                                    <th><?php echo($row['nombre']); ?></th>
                                    <th><?php echo($row['sector_productivo']); ?></th>
                                    <th><?php echo($row['activo'] == 1 ? "Si" : "No"); ?></th>                                    
                                </tr>
                            <?php } $rst->closeCursor(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>      
        <script>
                                        function limpiar()
                                        {
                                            $("#xAccion").val("0");
                                            $("#txtCveEmpresa").val("0");
                                            $("#cmbSectorProductivo").val("0");
                                            $("#txtNombre").val("");
                                            $("#frmEmpresa").submit();
                                        }

                                        function grabar()
                                        {
                                            $("#xAccion").val("grabar");
                                            $("#frmEmpresa").submit();

                                        }

                                        function recargar()
                                        {
                                            $("#xAccion").val("recargar");
                                            $("#frmEmpresa").submit();

                                        }
        </script>
    </body>
</html>
