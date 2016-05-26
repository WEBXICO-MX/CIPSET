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
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Corporativo Integral para Soluciones en Tiempo (CIPSET)</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="#about">Conócenos</a></li>
                        <li class="dropdown active">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Servicios <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Capacitación</a></li>
                                <li><a href="#">Asesoría</a></li>
                                <li><a href="#">Proyectos</a></li>
                                <li><a href="#">Obras</a></li>
                            </ul>
                        </li>
                        <li><a href="galeria.php">Galería</a></li>
                        <li><a href="#about">Otros</a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div><!-- /.container -->
        </nav>
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
        <footer>
            <p class="text-center">&copy; Copyright <?php echo date("Y"); ?> | Corporativo Integral para Soluciones en Tiempo | Powered By <a href="http://webxico.blogspot.mx/" target="_blank">WEBXICO</a></p>
        </footer>
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