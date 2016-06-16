<?php
$origin = "capacitacion";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CIPSET &#124; Contacto</title>
        <meta charset="UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../css/cipset.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include 'includeHeader.php'; ?>
        <div class="container">            
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1>Contacto</h1>
                    <img src="../img/contacto.jpg" alt="Contacto" class="img-responsive" style="margin:0 auto;"/><br/>
                    <form role="form" name="frmContacto" id="frmContacto" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-group">
                            <label for="txtNombre">Nombre completo:</label>
                            <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingrese su nombre completo" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="txtEmail">E-mail:</label>
                            <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ingrese su email" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="txtComentarios">Comentarios y/o sugerencias:</label><br/>
                            <textarea class="form-control" rows="4" cols="50" id="txtComentarios" name="txtComentarios" placeholder="Ingrese su comentario y/o sugerencia"></textarea>                         
                        </div>
                        <button type="submit" class="btn btn-success" id="btnGrabar" name="btnGrabar">Enviar</button>
                    </form>
                </div>
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="alert fade in" id="div_mensaje" style="display:none; margin-top: 25px;">
                        <a href="#" class="close" onclick="$('.alert').hide()" aria-label="close">&times;</a> 
                        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                        <span id="mensaje"></span>
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
        <hr>
        <?php include 'includeFooter.php'; ?>
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script>
            var url = "contacto_ajax.php";
            $(document).ready(function () {
                $.ajaxSetup({"cache": false});

                /* Limpiar la ventana modal para volver a usar*/
                $('body').on('hidden.bs.modal', '.modal', function () {
                    $(this).removeData('bs.modal');
                });

                $('#frmContacto').submit(function (e) {
                    e.preventDefault();

                    var json = JSON.stringify($('#frmContacto').serializeObject());
                    if (validar())
                    {
                        $('#myModal2').modal('show');
                        $.post(url, {"xAccion": 'enviarEmail', "datos": json}, function (data) {
                            if (data.resultado === 1)
                            {
                                $('#myModal2').modal('hide');
                                //window.location.replace("../index.php?");
                                limpiar();
                                $("#frmContacto").fadeOut();
                                $("#mensaje").html("<span>" + data.mensaje + "</span>");
                                $("#div_mensaje").removeClass("alert-success alert-info  alert-warning alert-danger");
                                $("#div_mensaje").addClass("alert-success");
                                $("#div_mensaje").fadeIn("slow");
                            }
                            else
                            {
                                $('#myModal2').modal('hide');
                                $("#mensaje").html("<span>" + data.mensaje + "</span>");
                                $("#div_mensaje").removeClass("alert-success alert-info  alert-warning alert-danger");
                                $("#div_mensaje").addClass("alert-danger");
                                $("#div_mensaje").fadeIn("slow");
                            }
                        }, 'json');
                    }
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

            function isValidEmailAddress(emailAddress) {
                var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                return pattern.test(emailAddress);
            }

            function validar()
            {
                var valido = true;
                var msg = "<ul>";

                if ($("#txtNombre").val() === "")
                {
                    valido = false;
                    msg += "<li>Ingrese su nombre</li>";

                }
                if (!isValidEmailAddress($("#txtEmail").val()))
                {
                    valido = false;
                    msg += "<li>Ingrese un email valido</li>";
                }
                if ($("#txtComentarios").val() === "")
                {
                    valido = false;
                    msg += "<li>Ingrese un comentario y/o sugerencia</li>";
                }

                msg += "</ul>";

                if (!valido)
                {
                    $("#mensaje").html("<strong>Información</strong> <span>" + msg + "</span>");
                    $("#div_mensaje").removeClass("alert-success alert-info  alert-warning alert-danger");
                    $("#div_mensaje").addClass("alert-info");
                    $("#div_mensaje").fadeIn("slow");
                }
                return valido;


            }

            function limpiar()
            {
                $("#txtNombre").val("");
                $("#txtEmail").val("");
                $("#txtComentarios").val("");
            }
        </script>
    </body>
</html>