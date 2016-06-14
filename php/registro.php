<?php
require_once '../class/UtilDB.php';

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
        <link href="../bower_components/jquery-ui/themes/smoothness/jquery-ui.min.css" rel="stylesheet"/>
        <link href="../css/cipset.css" rel="stylesheet"/>
        <style>
            #url_cambiar_empresa { font-size: 18px; font-weight: bold; display: none;}
        </style>
    </head>
    <body>
        <?php include 'includeHeader.php'; ?>
        <div class="container">            
            <div class="row row-offcanvas row-offcanvas-right">
                <div class="col-md-6 col-md-offset-3">
                    <form role="form" name="frmRegistroCapacitacion" id="frmRegistroCapacitacion" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                        </div>
                        <div class="form-group">
                            <label for="txtNombre">Nombre:</label>
                            <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Escriba su nombre" maxlength="50">
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
        </div>    
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script src="../bower_components/jquery-ui/ui/i18n/datepicker-es.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script>
                            var url = "registro_ajax.php";
                            $(document).ready(function () {
                                //$.ajaxSetup({"cache": false});

                                $(".date-picker").datepicker({yearRange: "-70:+0", changeMonth: true, changeYear: true, dateFormat: 'dd/mm/yy'});

                                /* Limpiar la ventana modal para volver a usar*/
                                $('body').on('hidden.bs.modal', '.modal', function () {
                                    $(this).removeData('bs.modal');
                                });

                                $("#cmbEmpresa").change(function () {
                                    var opc = this.value;
                                    if (opc === "2016")
                                    {
                                        $("#url_cambiar_empresa").fadeIn();
                                        $("#url_cambiar_empresa").focus();
                                    }
                                    else
                                    {
                                        $("#url_cambiar_empresa").fadeOut();
                                    }
                                });

                                $('#myModal').on('shown.bs.modal', function (e) {
                                    $('#frmRegistroEmpresa').submit(function (e) {
                                        e.preventDefault();

                                        var json = JSON.stringify($('#frmRegistroEmpresa').serializeObject());
                                        $.post(url, {"xAccion": 'grabarEmpresa', "datos": json}, function (data) {
                                            if (data.resultado === 1)
                                            {
                                                $('#myModal').modal('hide');
                                                $("#url_cambiar_empresa").fadeOut();
                                                $("#cmbEmpresa").html("");
                                                $("#cmbEmpresa").load(url, {"xAccion": "getComboEmpresas"}, function () {
                                                    $("#cmbEmpresa").focus();
                                                    $("#cmbEmpresa").val(data.empresa_id);
                                                });
                                            }
                                            else
                                            {
                                                $('#myModal').modal('hide');
                                                $("#url_cambiar_empresa").fadeOut();
                                                alert(data.mensaje);
                                            }
                                        }, 'json');
                                    });
                                });


                                $('#frmRegistroCapacitacion').submit(function (e) {
                                    e.preventDefault();

                                    var json = JSON.stringify($('#frmRegistroCapacitacion').serializeObject());
                                    $.post(url, {"xAccion": 'grabarRegistroCapacitacion', "datos": json}, function (data) {
                                        if (data.resultado === 1)
                                        {
                                           window.location.replace("../index.php?");        
                                        }
                                        else
                                        {
                                           alert(data.mensaje);
                                        }
                                    }, 'json');
                                });


                            });

                            $.fn.serializeObject = function ()
                            {
                                var o = {};
                                var a = this.serializeArray();
                                $.each(a, function () {
                                    if (o[this.name] !== undefined) {
                                        if (!o[this.name].push) {
                                            o[this.name] = [o[this.name]];
                                        }
                                        o[this.name].push(this.value || '');
                                    } else {
                                        o[this.name] = this.value || '';
                                    }
                                });
                                return o;
                            };
        </script>
    </body>
</html>