<?php
require_once '../class/UtilDB.php';
require_once '../class/CategoriaCapacitacion.php';
//require_once '../class/ChromePhp.php';

$origin = "capacitacion";
$i = isset($_GET['i']) != NULL ? ((int) $_GET['i']) : 0;
$categoria = new CategoriaCapacitacion($i);

$sql = "";
$rst = NULL;
$rst2 = NULL;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CIPSET &#124; <?php echo($categoria->getNombre()); ?></title>
        <meta charset="UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../css/cipset.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include 'includeHeader.php'; ?>
        <div class="container">            
            <div class="row">
                <div class="col-md-12">
                    <h1><?php echo($categoria->getNombre()); ?></h1><br/>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="../<?php echo($categoria->getImg()); ?>" alt="<?php echo($categoria->getNombre()); ?>" class="img-responsive" style="margin: 0 auto;"/><br/>
                            <?php echo($categoria->getDescripcion()); ?>                            
                        </div>
                        <div class="col-md-6">
                            <?php
                            $sql = "SELECT tc.id,tc.nombre AS tipo FROM capacitaciones AS c INNER JOIN tipos_capacitaciones AS tc ON tc.id = c.tipo_capacitacion_id WHERE c.categoria_capacitacion_id = " . $categoria->getId() . " AND c.activo = 1 GROUP BY tc.id,tc.nombre";
                            $rst = UtilDB::ejecutaConsulta($sql);

                            if ($rst->rowCount() > 0) {
                                foreach ($rst as $row) {
                                    echo("<h2>" . $row['tipo'] . "(s)</h2>");
                                    $sql = "SELECT c.id,c.nombre, count(cc.capacitacion_id) AS calendario ";
                                    $sql .= "FROM capacitaciones AS c ";
                                    $sql .= "LEFT JOIN calendarios_capacitaciones AS cc ON cc.capacitacion_id = c.id AND cc.activo = 1 ";
                                    $sql .= "WHERE c.activo = 1 AND c.categoria_capacitacion_id = " . $categoria->getId() . " AND c.tipo_capacitacion_id = " . $row['id'];
                                    $sql .= " GROUP BY c.id,c.nombre,cc.capacitacion_id ";
                                    $sql .= "ORDER BY c.nombre";

                                    $rst2 = UtilDB::ejecutaConsulta($sql);

                                    if ($rst2->rowCount() > 0) {
                                        echo("<ul>");
                                        foreach ($rst2 as $row2) {
                                            if ($row2['calendario'] > 0) {
                                                echo("<li><a href=\"calendario.php?i=" . $i . "&c=" . $row2['id'] . "\"><strong>" . $row2['nombre'] . "</strong></a> <img src=\"../img/Map-Marker-Push-Pin-1-Right-Pink-icon.png\" alt=\"Tiene Calendario de capacitaciones\"></li>");
                                            } else {
                                                echo("<li><a href=\"calendario.php?i=" . $i . "&c=" . $row2['id'] . "\"><strong>" . $row2['nombre'] . "</strong></a></li>");
                                            }
                                        }
                                        echo("</ul>");
                                    } else {
                                        echo("<h2>No hay capacitaciones registradas en esta categoría por el momento</h2>");
                                    }
                                    $rst2->closeCursor();
                                }
                            } else {
                                echo("<h2>No hay capacitaciones registradas por el momento</h2>");
                            }

                            $rst->closeCursor();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php include 'includeFooter.php'; ?>
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>