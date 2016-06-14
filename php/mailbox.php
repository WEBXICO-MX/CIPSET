<?php
session_start();

if (!isset($_SESSION['cve_usuario'])) {
    header('Location:login.php');
    return;
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Buzón</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!-- Cuerpo -->
        <div class="container">
            <?php include './footer.php'; ?>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="alert fade in" id="div_mensaje" style="display:none; margin-top: 25px;">
                        <a href="#" class="close" onclick="$('.alert').hide()" aria-label="close">&times;</a> 
                        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                        <span id="mensaje"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="bs-example">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#sectionA" data-toggle="tab"><span
                                        class="glyphicon glyphicon-certificate"></span> Nuevos</a></li>
                            <li><a href="#sectionB" data-toggle="tab"><span
                                        class="glyphicon glyphicon-check"></span> Revisados</a></li>
                            <li><a href="#sectionC" data-toggle="tab"><span
                                        class="glyphicon glyphicon glyphicon-education"></span>
                                    Inscritos</a></li>
                            <li><a href="#sectionE" data-toggle="tab"><span
                                        class="glyphicon glyphicon-header"></span> No inscritos</a></li>
                            <li><a href="#sectionD" data-toggle="tab"><span
                                        class="glyphicon glyphicon-hand-down"></span> Histórico</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="sectionA" class="tab-pane fade in active"></div>
                            <div id="sectionB" class="tab-pane fade"></div>
                            <div id="sectionC" class="tab-pane fade"></div>
                            <div id="sectionD" class="tab-pane fade"></div>
                            <div id="sectionE" class="tab-pane fade"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cuerpo -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../js/php/mailbox.js"></script>
    </body>
</html>