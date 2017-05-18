<?php
require_once '../class/Persona.php';
require_once '../class/Instructor.php';
require_once '../class/UtilDB.php';
session_start();

if (!isset($_SESSION['dominio']) or !isset($_SESSION['cve_usuario'])) {
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
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Instructor</title>
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
                    <h3 class="text-center">Instructor</h3>

                    <form name="frmInstructor" id="frmInstructor" action="<?php echo($_SERVER['PHP_SELF']); ?>" role="form" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                            <input type="hidden" class="form-control" id="txtCveInstructor" name="txtCveInstructor" value="<?php echo($e->getId()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="cmbPersona">Persona:</label>
                            <select id="cmbPersona" name="cmbPersona">
                                <option value="0">---- Elija una opción por favor -----</option>
                                <?php
                                    $sql = "SELECT id, CONCAT(nombre,' ',ap_paterno,' ',ap_materno) AS nombre_completo FROM personas WHERE activo = 1";
                                    $rst = UtilDB::ejecutaConsulta($sql);
                                    foreach($rst as $row)
                                    {
                                        echo("<option value=\""+$row['id']+"\">"+$row['nombre_completo']+"</option>");
                                    }
                                    $rst->closeCursor()
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txtRutaFoto">Ruta foto:</label>
                            <input type="text" name="txtRutaFoto" id="txtRutaFoto" placeholder="Ruta de la foto" value="<?php echo($e->getRutaFoto()); ?>" class="form-control"  maxlength="50" readonly/>
                        </div>
                        <div class="form-group">
                            <label for="txtExperiencia">Experiencia:</label>
                            <textarea name="txtExperiencia" id="txtExperiencia" placeholder="Experiencia" value="<?php echo($e->getExperiencia()); ?>" class="form-control"></textarea>                            
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
                            $sql .= "e.nombre AS especialidad, i.activo ";
                            $sql .= "FROM instructores AS i ";
                            $sql .= "INNER JOIN personas AS p ON p.id =i.cve_especialidad ";
                            $sql .= "INNER JOIN especialidades AS e ON e.id = i.cve_especialidad ";
                            $sql .= "WHERE p.activo = 1";
                            $rst = UtilDB::ejecutaConsulta($sql);
                            foreach ($rst as $row) {
                                ?>
                                <tr>
                                    <td><a href="javascript:void(0);" onclick="$('#txtCveInstructor').val(<?php echo($row['id']); ?>);recargar();"><?php echo($row['id']); ?></a></td>
                                    <td><?php echo($row['nombre_completo']); ?></td>
                                    <td><?php echo($row['especialidad']); ?></td>
                                    <td>Subir foto</td>
                                    <td>Cargar capacitaciones</td>
                                    <td><?php echo($row['activo'] == 1 ? "Si" : "No"); ?></td>                                    
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
        <script src="../js/php/cat_instructor.js"></script>
    </body>
</html>
