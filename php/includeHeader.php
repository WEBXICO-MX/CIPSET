<?php
$path = "";

if (isset($origin) && $origin != "") {
    $path = "../";
}
?>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo($path); ?>index.php">Corporativo Integral para Soluciones en Tiempo (CIPSET)</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li <?php echo($origin == "" ? "class=\"active\"" : ""); ?>><a href="<?php echo($path); ?>index.php">Inicio</a></li>
                <li <?php echo($origin == "conocenos" ? "class=\"active\"" : ""); ?>><a href="<?php echo($path); ?>php/conocenos.php">Conócenos</a></li>
                <li class="dropdown <?php echo(($origin == "capacitacion" or $origin == "asesoria" or $origin == "proyectos" or $origin == "obras") ? "active" : ""); ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Servicios <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li <?php echo($origin == "capacitacion" ? "class=\"active\"" : ""); ?>><a href="#">Capacitación</a></li>
                        <li <?php echo($origin == "asesoria" ? "class=\"active\"" : ""); ?>><a href="#">Asesoría</a></li>
                        <li <?php echo($origin == "proyectos" ? "class=\"active\"" : ""); ?>><a href="#">Proyectos</a></li>
                        <li <?php echo($origin == "obras" ? "class=\"active\"" : ""); ?>><a href="#">Obras</a></li>
                    </ul>
                </li>
                <li <?php echo($origin == "galeria" ? "class=\"active\"" : ""); ?>><a href="<?php echo($path);?>php/galeria.php">Galería</a></li>
                <li <?php echo($origin == "otros" ? "class=\"active\"" : ""); ?>><a href="#about">Otros</a></li>
                <li <?php echo($origin == "contacto" ? "class=\"active\"" : ""); ?>><a href="<?php echo($path);?>php/contacto.php">Contacto</a></li>
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav>
