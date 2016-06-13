<?php 
$origin = "capacitacion";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CIPSET &#124; Calendario</title>
        <meta charset="UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="bower_components/jquery-ui/themes/sunny/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/cipset.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include './php/includeHeader.php'; ?>
        <div class="container">            
            <div class="row">
                <div class="col-md-12">
                    <h1>Calendario de capacitaciones</h1><br/>
                </div>
                <div class="col-md-10 col-md-offset-1" id="datepicker">

                </div>
            </div>
        </div>
        <hr>
        <?php include './php/includeFooter.php'; ?>
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                //$.ajaxSetup({cache: false});

                $('#datepicker').datepicker({
                        numberOfMonths: [3, 4],
                        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                        dateFormat: "dd/mm/yy",
                        minDate: new Date(2016, 0, 1),
                        maxDate: new Date(2016, 11, 31)
                    });
            });
        </script>
    </body>
</html>