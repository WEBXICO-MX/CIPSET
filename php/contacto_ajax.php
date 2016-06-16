<?php

$resultado = "";
$obj = json_decode($_POST['datos']);
$xAccion = $_POST['xAccion'];
$send = false;

if ($xAccion == "enviarEmail") {
    $to = 'contacto@cipset.com.mx';
    $subject = 'CIPSET - Corporativo Integral para Soluciones en Tiempo';
    $message = $obj->{'txtNombre'}." con email: ".$obj->{'txtEmail'}.", comento lo siguiente:\n".$obj->{'txtComentarios'};
    $headers = "From: ".$obj->{'txtEmail'} . "\r\n" .
            "Reply-To: weiss.uttab@gmail.com" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

    $send = mail($to, $subject, $message, $headers);

    if ($send) {
        $resultado = "{\"resultado\":1,\"mensaje\":\"Email enviado con éxito\"}";
    } else {
        $resultado = "{\"resultado\":0,\"mensaje\":\"Email no enviado\"}";
    }
} else {
    $resultado = "{\"resultado\":0,\"mensaje\":\"Acción no valida\"}";
}
echo($resultado);
