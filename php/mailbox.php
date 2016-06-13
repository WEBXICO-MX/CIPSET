<?php
session_start();
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
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    cache: false
                });

                getBuzon("#sectionA");

                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    var target = $(e.target).attr("href");
                    getBuzon(target);
                });

                /* Limpiar la ventana modal para volver a usar*/
                $('body').on('hidden.bs.modal', '.modal', function () {
                    $(this).removeData('bs.modal');
                });

            });

            function getBuzon(target) {
                var status = getStatus(target);
                $.ajax({
                    url: "mailbox_ajax.php?st=" + status,
                    error: function (data) {
                        alert("There was a problem");
                    },
                    success: function (data) {
                        $(target).html(data);
                    }
                });
            }

            function changeStatus(status) {
                $("#cambiar_status_status").val(status);
                return true;
            }

            function getStatus(target) {
                var status = 0;
                switch (target) {
                    case "#sectionA":
                        status = 1;
                        break;
                    case "#sectionB":
                        status = 2;
                        break;
                    case "#sectionC":
                        status = 3;
                        break;
                    case "#sectionD":
                        status = 4;
                        break;
                    case "#sectionE":
                        status = 5;
                        break;
                    default:
                        status = 0;

                }

                return status;

            }
        </script>
    </body>
</html>