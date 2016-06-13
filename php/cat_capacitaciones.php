<?php
require_once '../class/CategoriaCapacitacion.php';
require_once '../class/TipoCapacitacion.php';
require_once '../class/Capacitacion.php';
require_once '../class/UtilDB.php';
session_start();

if (!isset($_SESSION['cve_usuario'])) {
    header('Location:login.php');
    return;
}

$c = new Capacitacion();
$count = NULL;
$sql = "";
$rst = NULL;

if (isset($_POST['txtCveCapacitacion'])) {
    if (((int) $_POST['txtCveCapacitacion']) != 0) {
        $c = new Capacitacion((int) $_POST['txtCveCapacitacion']);
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        $c->setCategoriaCapacitacionId(new CategoriaCapacitacion((int) $_POST['cmbCategoriaCapacitacion']));
        $c->setTipoCapacitacionId(new TipoCapacitacion((int) $_POST['cmbTipoCapacitacion']));
        $c->setNombre($_POST['txtNombre']);
        $c->setDescripcion($_POST['txtDescripcion']);
        $c->setActivo(isset($_POST['cbxActivo']) ? 1 : 0);
        $count = $c->grabar();
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
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Capacitaciones</title>
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
                    <h3 class="text-center">Capacitaciones</h3>

                    <form name="frmCapacitacion" id="frmCapacitacion" action="<?php echo($_SERVER['PHP_SELF']); ?>" role="form" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                            <input type="hidden" class="form-control" id="txtCveCapacitacion" name="txtCveCapacitacion" value="<?php echo($c->getId()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="cmbCategoriaCapacitacion">Categoría de capacitación</label>
                            <select name="cmbCategoriaCapacitacion" id="cmbCategoriaCapacitacion" class="form-control">
                                <option value="0">--------- Seleccione una opción ---------</option>
                                <?php
                                $sql = "SELECT * FROM categorias_capacitaciones WHERE activo = 1 ORDER BY nombre";
                                $rst = UtilDB::ejecutaConsulta($sql);
                                foreach ($rst as $row) {
                                    echo("<option value=\"" . $row['id'] . "\" " . ($c->getId() != 0 ? ($c->getCategoriaCapacitacionId()->getId() == $row['id'] ? "selected" : "") : "") . ">" . $row['nombre'] . "</option>");
                                }
                                $rst->closeCursor();
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cmbTipoCapacitacion">Tipo de capacitación</label>
                            <select name="cmbTipoCapacitacion" id="cmbTipoCapacitacion" class="form-control">
                                <option value="0">--------- Seleccione una opción ---------</option>
                                <?php
                                $sql = "SELECT * FROM tipos_capacitaciones WHERE activo = 1 ORDER BY nombre";
                                $rst = UtilDB::ejecutaConsulta($sql);
                                foreach ($rst as $row) {
                                    echo("<option value=\"" . $row['id'] . "\" " . ($c->getId() != 0 ? ($c->getTipoCapacitacionId()->getId() == $row['id'] ? "selected" : "") : "") . ">" . $row['nombre'] . "</option>");
                                }
                                $rst->closeCursor();
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txtNombre">Nombre:</label>
                            <input type="text" name="txtNombre" id="txtNombre" placeholder="Ingrese un nombre" value="<?php echo($c->getNombre()); ?>" class="form-control"  maxlength="50"/>
                        </div>
                        <div class="form-group">
                            <label for="txtDescripcion">* Descripción:</label><br/>
                            <textarea class="form-control" rows="4" cols="50" id="txtDescripcion" name="txtDescripcion" placeholder="Ingrese una descripción"><?php echo($c->getDescripcion()); ?></textarea>                         
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
                                <th>Capacitación</th>
                                <th>Categoría</th>
                                <th>Tipo</th>
                                <th>Imagen</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT c.id,cc.nombre AS categoria,t.nombre AS tipo, c.nombre,c.img,c.activo FROM capacitaciones AS c ";
                            $sql .= "INNER JOIN categorias_capacitaciones AS cc ON cc.id = c.categoria_capacitacion_id ";
                            $sql .= "INNER JOIN tipos_capacitaciones AS t ON t.id = c.tipo_capacitacion_id ";
                            $sql .= "ORDER BY c.fecha_registro DESC";

                            $rst = UtilDB::ejecutaConsulta($sql);
                            foreach ($rst as $row) {
                                ?>
                                <tr>
                                    <td><a href="javascript:void(0);" onclick="$('#txtCveCapacitacion').val(<?php echo($row['id']); ?>);
                                        recargar();"><?php echo($row['id']); ?></a></td>
                                    <td><?php echo($row['nombre']); ?></td>
                                    <td><?php echo($row['categoria']); ?></td>
                                    <td><?php echo($row['tipo']); ?></td>
                                    <td><?php echo($row['img'] != NULL ? "<span class=\"glyphicon glyphicon-eye-open\"  style=\"font-size: 2em; cursor:pointer;\" data-toggle=\"popover\" data-content=\"<img src='../" . $row['img'] . "' alt='" . str_replace('"', "'", $row['nombre']) . "' class='img-responsive'/>\" ></span><br/><br/><a data-toggle=\"modal\" data-target=\"#myModal\" data-remote=\"cat_capacitaciones_upload_img.php?xCveCapacitacion=" . $row['id'] . "\" href=\"javascript:void(0);\">Cambiar imagen</a>" : "<a data-toggle=\"modal\" data-target=\"#myModal\" data-remote=\"cat_capacitaciones_upload_img.php?xCveCapacitacion=" . $row['id'] . "\" href=\"javascript:void(0);\">Subir imagen</a>"); ?></td>
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
        </div>
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bower_components/ckeditor/ckeditor.js"></script>        
        <script>
                                        $(document).ready(function () {
                                            $('[data-toggle="popover"]').popover({placement: 'top', html: true, trigger: 'click hover'});

                                            /* Limpiar la ventana modal para volver a usar*/
                                            $('body').on('hidden.bs.modal', '.modal', function () {
                                                $(this).removeData('bs.modal');
                                            });

                                            CKEDITOR.replace("txtDescripcion");

                                        });
                                        function limpiar()
                                        {
                                            $("#xAccion").val("0");
                                            $("#txtCveCapacitacion").val("0");
                                            $("#cmbCategoriaCapacitacion").val("0");
                                            $("#cmbTipoCapacitacion").val("0");
                                            $("#txtNombre").val("");
                                            $("#txtDescripcion").val("");
                                            $("#frmCapacitacion").submit();
                                        }

                                        function grabar()
                                        {
                                            $("#xAccion").val("grabar");
                                            $("#frmCapacitacion").submit();

                                        }

                                        function recargar()
                                        {
                                            $("#xAccion").val("recargar");
                                            $("#frmCapacitacion").submit();

                                        }

                                        function subir()
                                        {
                                            if ($("#fileToUpload").val() !== "")
                                            {
                                                $("#xAccion2").val("upload");
                                                $("#frmUpload").submit();
                                            }
                                            else
                                            {
                                                alert("No ha seleccionado un archivo para subir.");
                                            }
                                        }
        </script>
    </body>
</html>
