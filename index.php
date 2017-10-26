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
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div id="miGaleria" class="carousel slide" data-ride="carousel" data-interval="4000">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#miGaleria" data-slide-to="0" class="active"></li>
                            <li data-target="#miGaleria" data-slide-to="1"></li>
                            <li data-target="#miGaleria" data-slide-to="2"></li>
                            <li data-target="#miGaleria" data-slide-to="3"></li>
                            <li data-target="#miGaleria" data-slide-to="4"></li>
                            <li data-target="#miGaleria" data-slide-to="5"></li>
                            <li data-target="#miGaleria" data-slide-to="6"></li>
                            <li data-target="#miGaleria" data-slide-to="7"></li>
                            <li data-target="#miGaleria" data-slide-to="8"></li>
                            <li data-target="#miGaleria" data-slide-to="9"></li>
                            <li data-target="#miGaleria" data-slide-to="10"></li>
                            <li data-target="#miGaleria" data-slide-to="11"></li>
                            <li data-target="#miGaleria" data-slide-to="12"></li>
                            <li data-target="#miGaleria" data-slide-to="13"></li>
                            <li data-target="#miGaleria" data-slide-to="14"></li>
                            <li data-target="#miGaleria" data-slide-to="15"></li>
                            <!--<li data-target="#miGaleria" data-slide-to="16"></li>
                            <li data-target="#miGaleria" data-slide-to="17"></li>
                            <li data-target="#miGaleria" data-slide-to="18"></li>
                            <li data-target="#miGaleria" data-slide-to="19"></li>
                            <li data-target="#miGaleria" data-slide-to="20"></li>
                            <li data-target="#miGaleria" data-slide-to="21"></li>
                            <li data-target="#miGaleria" data-slide-to="22"></li>
                            <li data-target="#miGaleria" data-slide-to="23"></li>
                            <li data-target="#miGaleria" data-slide-to="24"></li>
                            <li data-target="#miGaleria" data-slide-to="25"></li>-->
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <!--<div class="item active">
                                <img src="img/galeria/01/IMG-20160511-WA0000-min.jpg" alt="imagen 01" class="img-responsive"/>
                            </div>-->

                            <div class="item active">
                                <img src="img/galeria/01/IMG-20160511-WA0001-min.jpg" alt="imagen 02" class="img-responsive"/>
                            </div>

                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0002-min.jpg" alt="imagen 03" class="img-responsive"/>
                            </div>

                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0003-min.jpg" alt="imagen 04" class="img-responsive"/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0004-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0005-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0006-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0007-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0008-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0009-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0010-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0011-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0012-min.jpg" alt=""/>
                            </div>
                            <!--<div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0013-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0014-min.jpg" alt=""/>
                            </div>-->
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0015-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0016-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0017-min.jpg" alt=""/>
                            </div>
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0018-min.jpg" alt=""/>
                            </div>
                            <!--<div class="item">
                                   <img src="img/galeria/01/IMG-20160511-WA0025-min.jpg" alt=""/>
                            </div>-->
                            <div class="item">
                                <img src="img/galeria/01/IMG-20160511-WA0026-min.jpg" alt=""/>
                            </div>                         
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#miGaleria" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#miGaleria" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <?php
                                $sql = "SELECT * FROM categorias_capacitaciones WHERE activo = 1 AND id IN (1,2,3,4,5)";
                                $rst = UtilDB::ejecutaConsulta($sql);

                                if ($rst->rowCount() > 0) {
                                    foreach ($rst as $row) {
                                        $html .= "<div class=\"col-sm-6 col-md-4 col-lg-4\">";
                                        $html .= "<h2>" . $row['nombre'] . "</h2>";
                                        $html .= "<img src=\"" . $row['img'] . "\" alt=\"" . $row['nombre'] . "\" class=\"img-responsive\"/><br/>";
                                        $html .= $row['descripcion'];
                                        $html .= "<p><a class=\"btn btn-success\" href=\"php/capacitaciones.php?i=" . $row['id'] . "\" role=\"button\"><span class=\"glyphicon glyphicon-calendar\" style=\"font-size: 1.5em\"></span> Ver capacitaciones &raquo;</a></p>";
                                        $html .= "<hr>";
                                        $html .= "</div>";
                                        $count++;

                                        if ($count % 2 == 0) {
                                            $html .= "<div class=\"clearfix visible-sm-block\"></div>";
                                        }
                                        if ($count % 3 == 0) {
                                            $html .= "<div class=\"clearfix visible-md-block\"></div>";
                                            $html .= "<div class=\"clearfix visible-lg-block\"></div>";
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
                                        $html .= "<div class=\"col-sm-6 col-md-4 col-lg-4\">";
                                        $html .= "<h2>" . $row['nombre'] . "</h2>";
                                        $html .= "<img src=\"" . $row['img'] . "\" alt=\"" . $row['nombre'] . "\" class=\"img-responsive\"/><br/>";
                                        $html .= $row['descripcion'];
                                        $html .= "<p><a class=\"btn btn-success\" href=\"php/capacitaciones.php?i=" . $row['id'] . "\" role=\"button\"><span class=\"glyphicon glyphicon-calendar\" style=\"font-size: 1.5em\"></span> Ver capacitaciones &raquo;</a></p>";
                                        $html .= "<hr>";
                                        $html .= "</div>";
                                        $count++;

                                        if ($count % 2 == 0) {
                                            $html .= "<div class=\"clearfix visible-sm-block\"></div>";
                                        }
                                        if ($count % 3 == 0) {
                                            $html .= "<div class=\"clearfix visible-md-block\"></div>";
                                            $html .= "<div class=\"clearfix visible-lg-block\"></div>";
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
