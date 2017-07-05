<?php

$resultado = "";
$obj = json_decode($_POST['datos']);
$xAccion = $_POST['xAccion'];
$send = false;

if ($xAccion == "enviarEmail") {
    $to = 'contacto@cipset.net';
    $subject = 'CIPSET - Corporativo Integral para Soluciones en Tiempo';
    $message = $obj->{'txtNombre'}." con email: ".$obj->{'txtEmail'}." y tel: ".$obj->{'txtTel'}.",comento lo siguiente:\n".$obj->{'txtComentarios'};
    $headers = "From: ".$obj->{'txtEmail'} . "\r\n" .
            "Reply-To: weiss.uttab@gmail.com" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

    $send = mail($to, $subject, $message, $headers);

    if ($send) {
        $resultado = "{\"resultado\":1,\"mensaje\":\"Comentario y/o sugerencia enviada con éxito\"}";
    } else {
        $resultado = "{\"resultado\":0,\"mensaje\":\"Comentario y/o sugerencia no enviado\"}";
    }
} else {
    $resultado = "{\"resultado\":0,\"mensaje\":\"Acción no valida\"}";
}
echo($resultado);
