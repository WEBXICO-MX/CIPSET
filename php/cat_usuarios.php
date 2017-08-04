<?php
require_once '../class/Usuario.php';
require_once '../class/UtilDB.php';
session_start();

 if (!isset($_SESSION['dominio']) or !isset($_SESSION['cve_usuario'])) {
  header('Location:login.php');
  return;
  } 

$usuario = new Usuario();
$count = NULL;
$sql = "";
$rst = NULL;

if (isset($_POST['txtCveUsuario'])) {
    if (((int) $_POST['txtCveUsuario']) != 0) {
        $usuario = new Usuario((int) $_POST['txtCveUsuario']);
    }
}


if (isset($_POST['xAccion'])) {
    if ($_POST['xAccion'] == 'grabar') {
        $usuario->setNombre($_POST['txtNombre']);
        $usuario->setLogin($_POST['txtLogin']);
        $usuario->setPassword($_POST['txtPassword']);
        $usuario->setActivo(isset($_POST['cbxActivo']) ? 1 : 0);
        $count = $usuario->grabar();
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
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Usuario(s)</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet"/> 
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="container">
            <?php include './includeHeader2.php'; ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <a href="home.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Atrás</a><br/>
                    <h3 class="text-center">Usuario(s)</h3>

                    <form name="frmUsuario" id="frmUsuario" action="<?php echo($_SERVER['PHP_SELF']); ?>" role="form" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                            <input type="hidden" class="form-control" id="txtCveUsuario" name="txtCveUsuario" value="<?php echo($usuario->getId()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtNombre">Nombre completo:</label>
                            <input type="text" name="txtNombre" id="txtNombre" placeholder="Ingrese un nombre completo" value="<?php echo($usuario->getNombre()); ?>" class="form-control"  maxlength="100"/>
                        </div>
                        <div class="form-group">
                            <label for="txtLogin">Login:</label>
                            <input type="text" name="txtLogin" id="txtLogin" placeholder="Ingrese un login" value="<?php echo($usuario->getLogin()); ?>" class="form-control"  maxlength="15"/>
                        </div>
                        <div class="form-group">
                            <label for="txtPassword">Password:</label>
                            <input type="password" name="txtPassword" id="txtPassword" value="<?php echo($usuario->getPassword()); ?>" class="form-control" maxlength="15"/>
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
                    <table id="tabla_usuarios" class="table table-bordered table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre completo</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM usuarios ORDER BY fecha_registro DESC";
                            $rst = UtilDB::ejecutaConsulta($sql);
                            foreach ($rst as $row) {
                                ?>
                                <tr>
                                    <th><a href="javascript:void(0);" onclick="$('#txtCveUsuario').val(<?php echo($row['id']); ?>);
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
        <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>        
        <script src="../js/php/cat_usuarios.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#tabla_usuarios').DataTable({responsive: true,
                    "order": [[0, "desc"]]
                });
            });
        </script>
    </body>
</html>
