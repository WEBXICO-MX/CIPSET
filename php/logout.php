<?php
session_start();
unset($_SESSION['cve_usuario']);
unset($_SESSION['nombre']);
unset($_SESSION['dominio']);
header('Location:login.php');
return;