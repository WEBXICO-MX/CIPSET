<?php

require_once '../class/UtilDB.php';
require_once '../class/SectorProductivo.php';
require_once '../class/Empresa.php';
require_once '../class/Usuario.php';
require_once '../class/TipoCapacitacion.php';
require_once '../class/CategoriaCapacitacion.php';
require_once '../class/Capacitacion.php';
require_once '../class/CalendarioCapacitacion.php';
require_once '../class/TipoMedioComunicacion.php';
require_once '../class/MedioComunicacion.php';
require_once '../class/Persona.php';
require_once '../class/Estatus.php';
require_once '../class/RegistroCapacitacion.php';

$resultado = "";
$obj = json_decode($_POST['datos']);
$xAccion = $_POST['xAccion'];
$count = 0;

if ($xAccion == "grabarEmpresa") {
    $empresa = new Empresa();
    $empresa->setNombre($obj->{'txtNombreEmpresa'});
    $empresa->setSectorProductivoId(new SectorProductivo((int) $obj->{'cmbSectorProductivo'}));
    $empresa->setActivo(true);
    $count = $empresa->grabar();
    if ($count > 0) {
        $resultado = "{\"resultado\":1,\"mensaje\":\"Empresa registrada con éxito\",\"empresa_id\":" . ($empresa->getId()) . "}";
    } else {
        $resultado = "{\"resultado\":0,\"mensaje\":\"Empresa no registrada\"}";
    }
} else if ($xAccion == "grabarRegistroCapacitacion") {
    $persona = new Persona();
    $persona->setNombre($obj->{'txtNombre'});
    $persona->setApPaterno($obj->{'txtPaterno'});
    $persona->setApMaterno($obj->{'txtMaterno'});
    $persona->setFechaNacimiento($obj->{'txtFechaNacimiento'});
    $persona->setSexo($obj->{'rdSexo'});
    $persona->setActivo(true);
    $count = $persona->grabar();
    if ($count > 0) {
        $medio1 = new MedioComunicacion();
        $medio1->setPersonaId($persona);
        $medio1->setTipoMedioComunicacionId(new TipoMedioComunicacion(1)); //Email
        $medio1->setValor($obj->{'txtEmail'});
        $medio1->setActivo(true);
        $medio1->grabar();

        $medio2 = new MedioComunicacion();
        $medio2->setPersonaId($persona);
        $medio2->setTipoMedioComunicacionId(new TipoMedioComunicacion(2)); //Celular
        $medio2->setValor($obj->{'txtCelular'});
        $medio2->setActivo(true);
        $medio2->grabar();

        $registro = new RegistroCapacitacion();
        $registro->setCalendarioCapacitacionId(new CalendarioCapacitacion((int) $obj->{'xCveCalendarioCapacitacion'}));
        $registro->setPersonaId($persona);
        $registro->setEmpresaId(new Empresa((int) $obj->{'cmbEmpresa'}));
        $registro->setEstatusId(new Estatus(1)); //Nuevos
        $registro->setActivo(true);
        $count = $registro->grabar();
        if ($count > 0) {
            $to = $medio1->getValor();
            $subject = 'CIPSET - Corporativo Integral para Soluciones en Tiempo';
            $message = "Se ha registrado con éxito a la capacitación ".$registro->getCalendarioCapacitacionId()->getCapacitacionId()->getNombre()." con fecha de inicio: ".$registro->getCalendarioCapacitacionId()->getFechaInicio().", pronto nos pondremos en contacto con usted, muchas gracias.";
            $headers = "From: contacto@cipset.com.mx" . "\r\n" .
                    "Reply-To: weiss.uttab@gmail.com" . "\r\n" .
                    "X-Mailer: PHP/" . phpversion();

            $send = mail($to, $subject, $message, $headers);

            $resultado = "{\"resultado\":1,\"mensaje\":\"Se ha registrado con éxito a la capacitación <strong>".$registro->getCalendarioCapacitacionId()->getCapacitacionId()->getNombre()."</strong> con fecha de inicio <strong>".$registro->getCalendarioCapacitacionId()->getFechaInicio()."</strong> , hemos enviado un email a la dirección de correo electrónico que nos proporciono, pronto nos pondremos en contacto con usted para mas información, muchas gracias.\"}";
        } else {
            $resultado = "{\"resultado\":0,\"mensaje\":\"Registro no realizado\"}";
        }
    } else {
        $resultado = "{\"resultado\":0,\"mensaje\":\"Persona no registrada\"}";
    }
} else if ($xAccion == "getComboEmpresas") {
    $sql = "SELECT * FROM empresas WHERE activo = 1 ORDER BY nombre";
    $rst = UtilDB::ejecutaConsulta($sql);
    foreach ($rst as $row) {
        echo("<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>");
    }
    echo("<option value='2016'>----- NO ENCUENTRO MI EMPRESA ----</option>");
    $rst->closeCursor();
    return;
} else {
    $resultado = "{\"resultado\":0,\"mensaje\":\"Acción no valida\"}";
}
echo($resultado);
