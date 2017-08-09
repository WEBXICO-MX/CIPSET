<?php
require_once '../class/Persona.php';
require_once '../class/Especialidad.php';
require_once '../class/Instructor.php';
require_once '../class/UtilDB.php';
session_start();

if (!isset($_SESSION['dominio']) or ! isset($_SESSION['cve_usuario'])) {
    header('Location:login.php');
    return;
}

$e = new Instructor();
$count = NULL;
$sql = "";
$rst = NULL;

if (isset($_POST['txtCveInstructor'])) {
    if (((int) $_POST['txtCveInstructor']) != 0) {
        $e = new Instructor((int) $_POST['txtCveInstructor']);
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        if ($e->getCvePersona() != NULL) {
            $p = $e->getCvePersona();
        } else {
            $p = new Persona();
        }

        $p->setNombre($_POST['txtNombre']);
        $p->setApPaterno($_POST['txtPaterno']);
        $p->setApMaterno($_POST['txtMaterno']);
        $p->setFechaNacimiento($_POST['txtFechaNacimiento']);
        $p->setSexo($_POST['rdSexo']);
        $p->setActivo(isset($_POST['cbxActivo']));
        if ($p->grabar() != 0) {
            $e->setCvePersona($p);
            $e->setCveEspecialidad(new Especialidad((int) $_POST['cmbEspecialidad']));
            $e->setExperiencia($_POST['txtExperiencia']);
            $e->setActivo(isset($_POST['cbxActivo']) ? 1 : 0);
            $count = $e->grabar();
        }
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
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Instructor</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/jquery-ui/themes/blitzer/jquery-ui.min.css" rel="stylesheet"/>
        <link href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <style>
            #url_agregar_especialidad { font-size: 18px; font-weight: bold; display: none;}

            .ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
                color: #2660A9 !important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <?php include './includeHeader2.php'; ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <a href="home.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Atrás</a><br/>
                    <h3 class="text-center">Instructor(es)</h3>

                    <form name="frmInstructor" id="frmInstructor" action="<?php echo($_SERVER['PHP_SELF']); ?>" role="form" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                            <input type="hidden" class="form-control" id="txtCveInstructor" name="txtCveInstructor" value="<?php echo($e->getId()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtNombre">Nombre(s) del instructor:</label>
                            <input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre(s) del instructor" value="<?php echo($e->getCvePersona() != NULL ? $e->getCvePersona()->getNombre() : ""); ?>" class="form-control"  maxlength="50"/>
                        </div>
                        <div class="form-group">
                            <label for="txtPaterno">Apellido paterno del instructor:</label>
                            <input type="text" name="txtPaterno" id="txtPaterno" placeholder="Apellido paterno del instructor" value="<?php echo($e->getCvePersona() != NULL ? $e->getCvePersona()->getApPaterno() : ""); ?>" class="form-control"  maxlength="50"/>
                        </div>
                        <div class="form-group">
                            <label for="txtMaterno">Apellido materno del instructor:</label>
                            <input type="text" name="txtMaterno" id="txtMaterno" placeholder="Apellido materno del instructor" value="<?php echo($e->getCvePersona() != NULL ? $e->getCvePersona()->getApMaterno() : ""); ?>" class="form-control"  maxlength="50"/>
                        </div>
                        <div class="form-group">
                            <div class="date-form">
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label for="txtFechaNacimiento">Fecha de nacimiento:</label>
                                        <div class="controls">
                                            <div class="input-group">
                                                <input id="txtFechaNacimiento" name="txtFechaNacimiento" type="text" class="date-picker form-control"  value="<?php echo($e->getCvePersona() != NULL ? $e->getCvePersona()->getFechaNacimiento() : ""); ?>"/>
                                                <label for="txtFechaNacimiento" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="radio-inline">
                                <input type="radio" name="rdSexo" value="M" <?php echo($e->getCvePersona() != NULL ? ($e->getCvePersona()->getSexo() === "M" ? "checked" : "") : ""); ?>>Masculino
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="rdSexo" value="F" <?php echo($e->getCvePersona() != NULL ? ($e->getCvePersona()->getSexo() === "F" ? "checked" : "") : ""); ?>>Femenino
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="cmbEspecialidad">Especialidad:</label>
                            <select id="cmbEspecialidad" name="cmbEspecialidad" class="form-control">
                                <option value="0">---- Elija una opción por favor -----</option>
                                <?php
                                $sql = "SELECT * FROM especialidades WHERE activo = 1";
                                $rst = UtilDB::ejecutaConsulta($sql);
                                foreach ($rst as $row) {
                                    echo("<option value=\"" . $row['id'] . "\" " . ($e->getCveEspecialidad() != NULL ? ($e->getCveEspecialidad()->getId() === $row['id'] ? "selected" : "") : "") . ">" . $row['nombre'] . "</option>");
                                }
                                echo("<option value='2017'>----- NO ENCUENTRO MI ESPECIALIDAD ----</option>");
                                $rst->closeCursor();
                                ?>
                            </select>
                            <a data-toggle="modal" data-target="#myModal" data-remote="cat_especialidad2.php" href="javascript:void(0);" id="url_agregar_especialidad">Agregar especialidad</a>
                        </div>
                        <div class="form-group">
                            <label for="txtRutaFoto">Ruta foto:</label>
                            <input type="text" name="txtRutaFoto" id="txtRutaFoto" placeholder="Ruta de la foto" value="<?php echo($e->getRutaFoto()); ?>" class="form-control"  maxlength="50" readonly/>
                        </div>
                        <div class="form-group">
                            <label for="txtExperiencia">Experiencia:</label>
                            <textarea name="txtExperiencia" id="txtExperiencia" placeholder="Experiencia" class="form-control" cols="100" rows="15"><?php echo($e->getExperiencia()); ?></textarea>                            
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="cbxActivo" id="cbxActivo" <?php echo($e->getId() != 0 ? ($e->getActivo() ? "checked" : "") : "checked") ?>/>¿Activo?</label>
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
                    <table id="tabla_instructores" class="table table-bordered table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Instructor</th>
                                <th>Especialidad</th>
                                <th>Foto</th>
                                <th>Capacitaciones</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT i.id,CONCAT(p.nombre,' ',p.ap_paterno,' ',p.ap_materno) AS nombre_completo, ";
                            $sql .= "e.nombre AS especialidad,i.ruta_foto, i.activo ";
                            $sql .= "FROM instructores AS i ";
                            $sql .= "INNER JOIN personas AS p ON p.id =i.cve_persona ";
                            $sql .= "INNER JOIN especialidades AS e ON e.id = i.cve_especialidad ";
                            $sql .= "WHERE p.activo = 1";
                            $rst = UtilDB::ejecutaConsulta($sql);
                            foreach ($rst as $row) {
                                ?>
                                <tr>
                                    <td><a href="javascript:void(0);" onclick="$('#txtCveInstructor').val(<?php echo($row['id']); ?>);recargar();"><?php echo($row['id']); ?></a></td>
                                    <td><?php echo($row['nombre_completo']); ?></td>
                                    <td><?php echo($row['especialidad']); ?></td>
                                    <td><?php echo($row['ruta_foto'] != NULL ? "<span class=\"glyphicon glyphicon-eye-open\"  style=\"font-size: 2em; cursor:pointer;\" data-toggle=\"popover\" data-content=\"<img src='../" . $row['ruta_foto'] . "' alt='" . str_replace('"', "'", $row['nombre_completo']) . "' class='img-responsive'/>\" ></span><br/><br/><a data-toggle=\"modal\" data-target=\"#myModal\" data-remote=\"cat_instructor_upload_img.php?id=" . $row['id'] . "\" href=\"javascript:void(0);\">Cambiar foto</a>" : "<a data-toggle=\"modal\" data-target=\"#myModal\" data-remote=\"cat_instructor_upload_img.php?id=" . $row['id'] . "\" href=\"javascript:void(0);\">Subir foto</a>"); ?></td>
                                    <?php
                                    $sql2 = "select c.nombre as capacitacion from instructores_capacitaciones as ic inner join capacitaciones as c on c.id = ic.cve_capacitacion where ic.cve_instructor = " . $row['id'] . " and ic.activo = 1 order by capacitacion";
                                    
                                    $rst2 = UtilDB::ejecutaConsulta($sql2);
                                    $msg = "";
                                    if ($rst2->rowCount() > 0) {
                                        $msg .= "<h4>Capacitaciones</h4>";
                                        $msg .= "<ul>";
                                        foreach ($rst2 as $row2) {
                                            $msg .= "<li>" . $row2['capacitacion'] . "</li>";
                                        }
                                        $msg .= "</ul>";
                                    }
                                    $rst2->closeCursor();
                                    ?>
                                    <td><?php echo($msg != "" ? "<span class=\"glyphicon glyphicon-eye-open\"  style=\"font-size: 2em; cursor:pointer;\" data-toggle=\"popover\" data-content=\"" . $msg . "\" ></span><br/><br/><a href=\"cat_instructores_capacitaciones.php?i=" . $row['id'] . "\">Agregar/eliminar capacitaciones</a>" : "<a href=\"cat_instructores_capacitaciones.php?i=" . $row['id'] . "\">Agregar capacitaciones</a>"); ?></td>
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
        <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script src="../bower_components/jquery-ui/ui/i18n/datepicker-es.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>        
        <script src="../js/php/cat_instructor.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#tabla_instructores').DataTable({responsive: true,
                    "order": [[0, "desc"]]
                });
            });
        </script>
    </body>
</html>
