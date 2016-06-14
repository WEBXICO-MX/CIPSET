<?php
require_once '../class/UtilDB.php';
require_once '../class/CategoriaCapacitacion.php';

$origin = "capacitacion";
$i = isset($_GET['i']) != NULL ? ((int) $_GET['i']):0;
$categoria = new CategoriaCapacitacion($i);

$sql = "";
$rst = NULL;
$rst2 = NULL;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CIPSET &#124; <?php echo($categoria->getNombre());?></title>
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
                    <h1><?php echo($categoria->getNombre());?></h1><br/>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="../img/desarrollo_humano.jpg" alt="<?php echo($categoria->getNombre());?>" class="img-responsive" style="margin: 0 auto;"/><br/>
                            <?php echo($categoria->getDescripcion());?>                            
                        </div>
                        <div class="col-md-6">
                        <?php
                        $sql = "SELECT tc.id,tc.nombre AS tipo FROM capacitaciones AS c INNER JOIN tipos_capacitaciones AS tc ON tc.id = c.tipo_capacitacion_id WHERE c.categoria_capacitacion_id = ".$categoria->getId()." AND c.activo = 1 GROUP BY tc.id,tc.nombre";
                        $rst = UtilDB::ejecutaConsulta($sql);
                        
                        if($rst->rowCount() > 0)
                        {
                            foreach($rst as $row)
                            {   echo("<h2>".$row['tipo']."(s)</h2>");
                                $sql = "SELECT * FROM capacitaciones WHERE activo = 1 AND categoria_capacitacion_id = ".$categoria->getId()." AND tipo_capacitacion_id = ".$row['id'];
                                $rst2 = UtilDB::ejecutaConsulta($sql);
                                if($rst2->rowCount() > 0)
                                {   echo("<ul>");
                                    foreach($rst2 as $row2)
                                    {
                                        echo("<li><a href=\"calendario.php?i=".$i."&c=".$row2['id']."\">".$row2['nombre']."</a></li>");
                                    }
                                    echo("</ul>");
                                }
                                else
                                {
                                    echo("<h2>No hay capacitaciones registradas en esta categoría por el momento</h2>");
                                }
                                $rst2->closeCursor();                            
                            }
                            
                        }
                        else
                        {
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