<?php
require_once '../class/CategoriaCapacitacion.php';
require_once '../class/UtilDB.php';
session_start();

if (!isset($_SESSION['dominio']) or ! isset($_SESSION['cve_usuario'])) {
    header('Location:login.php');
    return;
}

$cc = new CategoriaCapacitacion();
$count = NULL;
$sql = "";
$rst = NULL;

if (isset($_POST['txtCveCategoriaCapacitacion'])) {
    if (((int) $_POST['txtCveCategoriaCapacitacion']) != 0) {
        $cc = new CategoriaCapacitacion((int) $_POST['txtCveCategoriaCapacitacion']);
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        $cc->setNombre($_POST['txtNombre']);
        $cc->setDescripcion($_POST['txtDescripcion']);
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
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Categoria(s) de capacitación</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="container">
            <?php include './includeHeader2.php'; ?>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <a href="home.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Atrás</a><br/>
                    <h3 class="text-center">Categoria(s) de capacitación</h3>

                    <form name="frmCategoriaCapacitacion" id="frmCategoriaCapacitacion" action="<?php echo($_SERVER['PHP_SELF']); ?>" role="form" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                            <input type="hidden" class="form-control" id="txtCveCategoriaCapacitacion" name="txtCveCategoriaCapacitacion" value="<?php echo($cc->getId()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtNombre">Nombre:</label>
                            <input type="text" name="txtNombre" id="txtNombre" placeholder="Ingrese un nombre" value="<?php echo($cc->getNombre()); ?>" class="form-control"  maxlength="50"/>
                        </div>
                        <div class="form-group">
                            <label for="txtDescripcion">* Descripción:</label><br/>
                            <textarea class="form-control" rows="4" cols="50" id="txtDescripcion" name="txtDescripcion" placeholder="Ingrese una descripción"><?php echo($cc->getDescripcion()); ?></textarea>                         
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
                   <table id="tabla_categorias_capacitaciones" class="table table-bordered table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM categorias_capacitaciones ORDER BY id DESC";
                            $rst = UtilDB::ejecutaConsulta($sql);
                            foreach ($rst as $row) {
                                ?>
                                <tr>
                                    <td><a href="javascript:void(0);" onclick="$('#txtCveCategoriaCapacitacion').val(<?php echo($row['id']); ?>);
                                            recargar();"><?php echo($row['id']); ?></a></td>
                                    <td><?php echo($row['nombre']); ?></td>
                                    <td><?php echo($row['img'] != NULL ? "<span class=\"glyphicon glyphicon-eye-open\"  style=\"font-size: 2em; cursor:pointer;\" data-toggle=\"popover\" data-content=\"<img src='../" . $row['img'] . "' alt='" . str_replace('"', "'", $row['nombre']) . "' class='img-responsive'/>\" ></span><br/><br/><a data-toggle=\"modal\" data-target=\"#myModal\" data-remote=\"cat_categorias_capacitaciones_upload_img.php?xCveCategoria=" . $row['id'] . "\" href=\"javascript:void(0);\">Cambiar imagen</a>" : "<a data-toggle=\"modal\" data-target=\"#myModal\" data-remote=\"cat_categorias_capacitaciones_upload_img.php?xCveCategoria=" . $row['id'] . "\" href=\"javascript:void(0);\">Subir imagen</a>"); ?></td>
                                    <td><?php echo($row['activo'] == 1 ? "Si" : "No"); ?></td>                                    
                                </tr>
                            <?php } $rst->closeCursor(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" >
                <div class="col-sm-12">
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php include './includeFooter.php'; ?>
            </div>
        </div>
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bower_components/ckeditor/ckeditor.js"></script>
        <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="../js/php/cat_categorias_capacitaciones.min.js"></script>
        <script>
                $(document).ready(function () {
                    $('#tabla_categorias_capacitaciones').DataTable({responsive: true,
                        "order": [[0, "desc"]]
                    });
                });
        </script>
    </body>
</html>
