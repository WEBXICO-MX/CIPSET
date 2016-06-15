<?php
session_start();

if (!isset($_SESSION['dominio']) or !isset($_SESSION['cve_usuario'])) {
    header('Location:login.php');
    return;
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo</title>
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <?php include './includeHeader2.php'; ?>
            <div class="row">
                <div class="col-md-12">
                    <table style="width: 50%; margin: 0 auto; text-align: center">
                        <thead>
                            <tr>
                                <td><h2>Catálogos</h2></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="cat_categorias_capacitaciones.php">Categorias de capacitación</a></td>
                            </tr>
                            <tr>
                                <td><a href="cat_capacitaciones.php">Capacitaciones</a></td>
                            </tr>
                            <tr>
                                <td><a href="cat_calendario_capacitaciones.php">Calendario
                                        de Capacitaciones</a></td>
                            </tr>
                            <tr>
                                <td><a href="cat_empresas.php">Empresas</a></td>
                            </tr>
                            <tr>
                                <td><a href="cat_sectores_productivos.php">Sectores
                                        Productivos</a></td>
                            </tr>
                            <tr>
                                <td><a href="cat_estatus.php">Estatus</a></td>
                            </tr>
                            <tr>
                                <td><a href="cat_tipos_capacitaciones.php">Tipo
                                        Capacitaciones</a></td>
                            </tr>
                            <tr>
                                <td><a href="cat_tipos_medios_comunicacion.php">
                                        Tipo Medios de Comunicación</a></td>
                            </tr>
                            <tr>
                                <td><a href="cat_usuarios.php">
                                        Usuarios</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />

                    <table style="width: 50%; margin: 0 auto; text-align: center">
                        <thead>
                            <tr>
                                <td><h2>Procesos</h2></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="mailbox.php">Ir a buzón</a>&nbsp;&nbsp; <span class="glyphicon glyphicon-envelope" style="font-size: 35px;"></span></td>
                            </tr>
                        </tbody>
                    </table><br />
                </div>
            </div>
            <div class="row">
                <?php include './includeFooter.php'; ?>
            </div>
        </div>
    </body>
</html>
