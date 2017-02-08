<?php
require_once '../class/UtilDB.php';
require_once '../class/TipoCapacitacion.php';
require_once '../class/CategoriaCapacitacion.php';
require_once '../class/Capacitacion.php';

$origin = "capacitacion";
$c = isset($_GET['c']) ? ((int) $_GET['c']) : 0;
$i = isset($_GET['i']) ? ((int) $_GET['i']) : 0;
$capacitacion = new Capacitacion($c);

$sql = "";
$rst = NULL;
$rst2 = NULL;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CIPSET &#124; Calendario del  <?php echo(strtolower($capacitacion->getTipoCapacitacionId()->getNombre())); ?> "<?php echo($capacitacion->getNombre()); ?>"</title>
        <meta charset="UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../bower_components/jquery-ui/themes/blitzer/jquery-ui.min.css" rel="stylesheet"/>
        <link href="../css/cipset.css" rel="stylesheet"/>
        <style>
            .inicio_curso a {
                background-image : url('../img/inicioDeCurso.png') !important;
                background-size:39px 28px !important;
                background-repeat:no-repeat !important;
                color: black !important;
                font-weight:bold !important;
            }

            div#datepicker > div { width:auto!important;}
        </style>
    </head>
    <body>
        <?php include 'includeHeader.php'; ?>
        <div class="container">            
            <div class="row">
                <div class="col-md-12">
                    <a href="capacitaciones.php?i=<?php echo($i); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Atrás</a><br/>
                </div>
                <div class="col-md-12">
                    <h1>Calendario del  <?php echo(strtolower($capacitacion->getTipoCapacitacionId()->getNombre())); ?> "<?php echo($capacitacion->getNombre()); ?>"</h1><br/>
                    <?php if($capacitacion->getImg() != "") { ?>
                    <img src="../<?php echo($capacitacion->getImg()); ?>" alt="<?php echo($capacitacion->getNombre()); ?>" class="img-responsive" style="margin:0 auto;"/><br/>
                    <?php } ?>
                        <?php echo($capacitacion->getDescripcion()); ?>
                        <h3 class="text-left">Iconografía:</h3>
                        <ul>
                            <li><img src="../img/inicioDeCurso.png" alt="Inicio del curso" style="width:46px; height: 33px;"/>  Inicio del curso</li>                        
                        </ul>
                    </div>
                    <div class="col-md-12" id="datepicker">

                    </div>
                </div>
            </div>
            <hr>
            <?php include 'includeFooter.php'; ?>
            <script src="../bower_components/jquery/dist/jquery.min.js"></script>
            <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
            <script src="../bower_components/jquery-ui/ui/i18n/datepicker-es.js"></script>
            <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <script>
                var rest1 = "getJsonCalendarioCapacitaciones.php?c=<?php echo($c); ?>";
                var availableDates = [];
                var json = null;

                //("0" + date.getDate()).slice(-2) PARA EL DIA        
                //("0" + (date.getMonth() + 1)).slice(-2) PARA EL MES
                function available(date) {
                    var mdy = date.getFullYear() + "-" + ("0" + (date.getMonth() + 1)).slice(-2) + "-" + ("0" + date.getDate()).slice(-2);
                    if ($.inArray(mdy, availableDates) !== -1) {
                        return [true, "inicio_curso"];
                    } else {
                        return[true, ""];
                    }
                }

                function buildLink(dateText, inst) {
                    for (var i = 0; i < json.length; i++)
                    {
                        if (dateText === json[i].fecha_inicio)
                        {
                            var url = "registro.php?i=<?php echo($i); ?>&c=<?php echo($c); ?>&cc=" + json[i].id;
                        window.location = url;
                        return;
                    }
                }

            }

            $(document).ready(function () {
                $.ajaxSetup({cache: false});

                $.getJSON(rest1, function (data) {
                    json = data;
                    $.each(data, function (i, value) {
                        availableDates.push(value.fecha_inicio);
                    });

                    $('#datepicker').datepicker({
                        numberOfMonths: [3, 4],
                        dateFormat: 'yy-mm-dd',
                        minDate: new Date(2017, 0, 1),
                        maxDate: new Date(2017, 11, 31),
                        beforeShowDay: available,
                        onSelect: buildLink
                    });
                });
            });

        </script>
    </body>
</html>