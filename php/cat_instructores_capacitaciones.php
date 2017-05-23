<?php
session_start();

if (!isset($_SESSION['dominio']) or ! isset($_SESSION['cve_usuario'])) {
    header('Location:login.php');
    return;
}
$cveInstructor = isset($_GET['i']) ? ((int) $_GET['i']) : 0;


if (isset($_POST['xAccion'])) {
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
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Instructores-capacitaciones</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/jquery-ui/themes/blitzer/jquery-ui.min.css" rel="stylesheet"/>
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
        <style>
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
                    <a href="cat_instuctor.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Atrás</a><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2" id="div_resultado">&nbsp;</div>
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
        <script src="../js/php/cat_instructores_capacitaciones.min.js"></script>
        <script>
            $(document).ready(function () {
                $.ajaxSetup({"cache": false});
                getTablaCapacitaciones(<?php echo($cveInstructor); ?>);
            });
        </script>
    </body>
</html>
