<?php

session_start();
unset($_SESSION['cve_usuario']);
unset($_SESSION['nombre']);
header('Location:login.php');
return;