<?php
require_once '../class/UtilDB.php';
require_once '../class/Usuario.php';
require_once '../class/TipoCapacitacion.php';
require_once '../class/CategoriaCapacitacion.php';
require_once '../class/Capacitacion.php';
require_once '../class/CalendarioCapacitacion.php';

$i = isset($_GET['i']) ? ((int) $_GET['i']) : 0;
$c = isset($_GET['c']) ? ((int) $_GET['c']) : 0;
$cc = isset($_GET['cc']) ? ((int) $_GET['cc']) : 0;

$calendario = new CalendarioCapacitacion($cc);
$origin = "capacitacion";
$sql = "";
$rst = NULL;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Registro</title>
        <meta charset="UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../bower_components/jquery-ui/themes/blitzer/jquery-ui.min.css" rel="stylesheet"/>
        <link href="../css/cipset.css" rel="stylesheet"/>
        <style>
            #url_cambiar_empresa { font-size: 18px; font-weight: bold; display: none;}
            
            .ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
                color: #2660A9 !important;
            }
        </style>
    </head>
    <body>
        <?php include 'includeHeader.php'; ?>
        <div class="container">            
            <div class="row row-offcanvas row-offcanvas-right">
                <div class="col-md-12">
                    <a href="calendario.php?i=<?php echo($i);?>&c=<?php echo($c);?>" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Atrás</a><br/>
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <h3>Información de la capacitación</h3>
                    <p><strong>Nombre: </strong><?php echo($calendario->getCapacitacionId()->getNombre());?></p>
                    <p><strong>Tipo: </strong><?php echo($calendario->getCapacitacionId()->getTipoCapacitacionId()->getNombre());?></p>
                    <p><strong>Fecha inicio: </strong><?php echo($calendario->getFechaInicio());?> &#124; <strong>Fecha fin: </strong><?php echo($calendario->getFechaFin());?> </p>
                    <h3>Registro</h3>
                    <form role="form" name="frmRegistroCapacitacion" id="frmRegistroCapacitacion" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-group">
                            <label for="txtNombre">Nombre:</label>
                            <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Escriba su nombre" maxlength="50">
                            <input type="hidden" id="xCveCalendarioCapacitacion" name="xCveCalendarioCapacitacion" value="<?php echo($calendario->getId());?>">
                        </div>
                        <div class="form-group">
                            <label for="txtPaterno">Apellido paterno:</label>
                            <input type="text" class="form-control" id="txtPaterno" name="txtPaterno" placeholder="Escriba su apellido paterno" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="txtMaterno">Apellido materno:</label>
                            <input type="text" class="form-control" id="txtMaterno" name="txtMaterno" placeholder="Escriba su apellido materno" maxlength="50">
                        </div>
                        <div class="form-group">
                            <div class="date-form">
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label for="txtFechaNacimiento">Fecha de nacimiento:</label>
                                        <div class="controls">
                                            <div class="input-group">
                                                <input id="txtFechaNacimiento" name="txtFechaNacimiento" type="text" class="date-picker form-control"/>
                                                <label for="txtFechaNacimiento" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="radio-inline">
                                <input type="radio" name="rdSexo" value="M">Masculino
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="rdSexo" value="F">Femenino
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="txtEmail">E-mail:</label>
                            <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ingrese su email" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="txtCelular">Número de celular:</label>
                            <input type="text" class="form-control" id="txtCelular" name="txtCelular" placeholder="Ingrese su número celular" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="cmbEmpresa">Empresa:</label>
                            <select name="cmbEmpresa" id="cmbEmpresa" class="form-control">
                                <option value="0">----- Seleccione una opción -----</option>
                                <?php
                                $sql = "SELECT * FROM empresas WHERE activo = 1 ORDER BY nombre";
                                $rst = UtilDB::ejecutaConsulta($sql);
                                foreach ($rst as $row) {
                                    echo("<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>");
                                }
                                echo("<option value='2016'>----- NO ENCUENTRO MI EMPRESA ----</option>");
                                $rst->closeCursor();
                                ?>
                            </select><br/><a data-toggle="modal" data-target="#myModal" data-remote="cat_empresas2.php" href="javascript:void(0);" id="url_cambiar_empresa">Agregar empresa</a>
                        </div>
                        <button type="submit" class="btn btn-success" id="btnGrabar" name="btnGrabar">Enviar</button>
                    </form><br/>
                </div>
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="alert fade in" id="div_mensaje" style="display:none; margin-top: 25px;">
                        <a href="#" class="close" onclick="$('.alert').hide()" aria-label="close">&times;</a> 
                        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                        <span id="mensaje"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <?php include 'includeFooter.php'; ?>
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
            <div class="row" >
                <div class="col-sm-12">
                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                                    <h4 class="modal-title">CIPSET &#124; Corporativo Integral para Soluciones en Tiempo</h4>
                                </div>
                                <div class="modal-body">
                                    <img src="../img/ajax-loading.gif" alt="Loading"/> <strong>procesando ...</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script src="../bower_components/jquery-ui/ui/i18n/datepicker-es.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../js/php/registro.js"></script>
    </body>
</html>