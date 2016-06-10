<?php
session_start();
if (isset($_SESSION['cve_usuario'])) {
    header('Location:home.php');
    return;
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CIPSET &#124; Corporativo Integral para Soluciones en Tiempo &#124; Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h3 class="text-center">CIPSET &#124; Corporativo Integral para Soluciones en Tiempo</h3>
                    <form name="frmLogin" id="frmLogin" action="<?php echo($_SERVER['PHP_SELF']); ?>" role="form" method="post">
                        <div class="form-group">
                            <label for="txtLogin">Login:</label>
                            <input type="text" name="txtLogin" id="txtLogin" placeholder="Login" class="form-control"  maxlength="15"/>
                        </div>
                        <div class="form-group">
                            <label for="txtPassword">Password:</label>
                            <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" class="form-control" maxlength="15"/>
                        </div>
                        <button type="submit" class="btn btn-block btn-success" id="btnGrabar" name="btnGrabar">Acceder</button>
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
        </div>
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../js/php/login.js"></script>
    </body>
</html>
