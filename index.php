<?php
require_once 'class/UtilDB.php';
$origin = "";
$sql = "";
$rst = NULL;
$html = "";
$count = 0;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo</title>
        <meta charset="UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="css/cipset.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include './php/includeHeader.php'; ?>
        <div class="container">            
            <div class="row row-offcanvas row-offcanvas-right">
                <div class="col-xs-12 col-sm-12">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-success btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>
                    <div class="jumbotron">
                        <h1>Sitio web en construcción</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <?php
                                $sql = "SELECT * FROM categorias_capacitaciones WHERE activo = 1";
                                $rst = UtilDB::ejecutaConsulta($sql);

                                if ($rst->rowCount() > 0) {
                                    foreach ($rst as $row) {
                                        $html .="<div class=\"col-sm-6 col-md-4 col-lg-4\">";
                                        $html .="<h2>" . $row['nombre'] . "</h2>";
                                        $html .="<img src=\"" . $row['img'] . "\" alt=\"" . $row['nombre'] . "\" class=\"img-responsive\"/><br/>";
                                        $html .=$row['descripcion'];
                                        $html .="<p><a class=\"btn btn-success\" href=\"php/capacitaciones.php?i=" . $row['id'] . "\" role=\"button\"><span class=\"glyphicon glyphicon-calendar\" style=\"font-size: 1.5em\"></span> Ver capacitaciones &raquo;</a></p>";
                                        $html .="<hr>";
                                        $html .="</div>";
                                        $count++;

                                        if ($count % 2 == 0) {
                                            $html .="<div class=\"clearfix visible-sm-block\"></div>";
                                        }
                                        if ($count % 3 == 0) {
                                            $html .="<div class=\"clearfix visible-md-block\"></div>";
                                            $html .="<div class=\"clearfix visible-lg-block\"></div>";
                                        }
                                    }

                                    echo($html);
                                    $html = "";
                                    $count = 0;
                                } else {
                                    
                                }
                                $rst->closeCursor();
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Perforación petrolera</h1><hr>
                                </div>
                                <?php
                                $sql = "SELECT * FROM categorias_capacitaciones WHERE activo = 1 AND id IN (6,7,8)";
                                $rst = UtilDB::ejecutaConsulta($sql);

                                if ($rst->rowCount() > 0) {
                                    foreach ($rst as $row) {
                                        $html .="<div class=\"col-sm-6 col-md-4 col-lg-4\">";
                                        $html .="<h2>" . $row['nombre'] . "</h2>";
                                        $html .="<img src=\"" . $row['img'] . "\" alt=\"" . $row['nombre'] . "\" class=\"img-responsive\"/><br/>";
                                        $html .=$row['descripcion'];
                                        $html .="<p><a class=\"btn btn-success\" href=\"php/capacitaciones.php?i=" . $row['id'] . "\" role=\"button\"><span class=\"glyphicon glyphicon-calendar\" style=\"font-size: 1.5em\"></span> Ver capacitaciones &raquo;</a></p>";
                                        $html .="<hr>";
                                        $html .="</div>";
                                        $count++;

                                        if ($count % 2 == 0) {
                                            $html .="<div class=\"clearfix visible-sm-block\"></div>";
                                        }
                                        if ($count % 3 == 0) {
                                            $html .="<div class=\"clearfix visible-md-block\"></div>";
                                            $html .="<div class=\"clearfix visible-lg-block\"></div>";
                                        }
                                    }

                                    echo($html);
                                    $html = "";
                                    $count = 0;
                                } else {
                                    
                                }
                                $rst->closeCursor();
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php include './php/includeFooter.php'; ?>
                </div>
            </div>
        </div>    
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
