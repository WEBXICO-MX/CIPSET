<?php
require_once '../class/UtilDB.php';
require_once '../class/Estatus.php';
require_once '../class/SectorProductivo.php';
require_once '../class/Empresa.php';
require_once '../class/Persona.php';
require_once '../class/Usuario.php';
require_once '../class/TipoCapacitacion.php';
require_once '../class/CategoriaCapacitacion.php';
require_once '../class/Capacitacion.php';
require_once '../class/CalendarioCapacitacion.php';
require_once '../class/RegistroCapacitacion.php';

$id = isset($_GET['id']) ? ((int) $_GET['id']) : 0;
$sql = "";
$rst = NULL;

$registro = new RegistroCapacitacion($id);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Status: <?php echo($registro->getEstatusId()->getNombre()); ?></h4>
</div>
<div class="modal-body">
    <div class="te">
        <h2>Información del curso</h2>
        <p>
            <b>Nombre capacitación:</b>
            <?php echo($registro->getCalendarioCapacitacionId()->getCapacitacionId()->getNombre()); ?>
        </p>
        <p>
            <b>Fecha(s) de capacitación:</b> Fecha inicio:
            <?php echo($registro->getCalendarioCapacitacionId()->getFechaInicio()); ?> |
            Fecha
            fin:<?php echo($registro->getCalendarioCapacitacionId()->getFechaFin()); ?>
        </p>
        <h2>Información del registro</h2>
        <p>
            <b>Tipo:</b>
            <?php echo($registro->getCalendarioCapacitacionId()->getCapacitacionId()->getTipoCapacitacionId()->getNombre()); ?>
        </p>
        <p>
            <b>Sector productivo:</b>
            <?php echo($registro->getEmpresaId()->getSectorProductivoId()->getNombre()); ?>
        </p>
        <p>
            <b>Institución/Empresa:</b> <?php echo($registro->getEmpresaId()->getNombre()); ?>
        </p>
        <p>
            <b>Nombre:</b> <?php echo($registro->getPersonaId()->getNombre()); ?>
        </p>
        <p>
            <b>Apellido paterno:</b> <?php echo($registro->getPersonaId()->getApPaterno()); ?>
        </p>
        <p>
            <b>Apellido materno:</b> <?php echo($registro->getPersonaId()->getApMaterno()); ?>
        </p>
        <p>
            <b>Fecha de nacimiento:</b> <?php echo($registro->getPersonaId()->getFechaNacimiento()); ?>
        </p>
        <p>
            <b>Sexo:</b> <?php echo($registro->getPersonaId()->getSexo()); ?>
        </p>
        <p>
            <b>Medios de comunicación:</b>
        </p>
        <?php
        $sql = "SELECT mc.id,tmc.nombre AS tipo, mc.valor FROM medios_comunicacion AS mc INNER JOIN tipos_medios_comunicacion AS tmc ON tmc.id = mc.tipo_medio_comunicacion_id WHERE mc.activo = 1 AND mc.persona_id = " . $registro->getPersonaId()->getId();
        $rst = UtilDB::ejecutaConsulta($sql);
        if ($rst->rowCount() > 0) {
            echo("<ul>");
            foreach ($rst as $row) {
                echo("<li>" . $row['tipo'] . ": " . $row['valor'] . "</li>");
            }
            echo("</ul>");
        } else {
            echo("<p>No hay medios de comunicación</p>");
        }
        $rst->closeCursor();
        ?>

        <div class="form-group">
            <form name="frmMailbox" id="frmMailbox" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="xCveRegistroCapacitacion" id="xCveRegistroCapacitacion" value="<?php echo($registro->getId()); ?>"/>
                <input type="hidden" name="xCveEstatus" id="xCveEstatus" value="0"/>
                <input type="hidden" name="xCveEstatusActual" id="xCveEstatusActual" value="<?php echo($registro->getEstatusId()->getId()); ?>"/>
                <?php if ($registro->getEstatusId()->getId() == 1) { ?>
                    <input type="submit" id="btn_cambiar_status"
                           value="Cambiar estatus a 'Revisado'" class="btn btn-success"
                           tabindex="10"
                           onclick="if (confirm('¿Está seguro de cambiar el estatus del registroCapacitacion a Revisado?')) {
                                               return changeStatus(2);
                                           } else {
                                               return false;
                                           }" />
                       <?php } ?>

                <?php if ($registro->getEstatusId()->getId() == 2) { ?>
                    <input type="submit" id="btn_cambiar_status"
                           value="Cambiar estatus a 'Inscrito'" class="btn btn-success"
                           tabindex="10"
                           onclick="if (confirm('¿Está seguro de cambiar el estatus del registroCapacitacion a Inscrito?')) {
                                               return changeStatus(3);
                                           } else {
                                               return false;
                                           }" />
                    <br>
                    <br>
                    <input type="submit" id="btn_cambiar_status4"
                           value="Cambiar estatus a 'No inscrito'" class="btn btn-info"
                           tabindex="11"
                           onclick="if (confirm('¿Está seguro de cambiar el estatus del registroCapacitacion a No inscrito?')) {
                                               return changeStatus(5);
                                           } else {
                                               return false;
                                           }" />
                       <?php } ?>
                       <?php if ($registro->getEstatusId()->getId() == 3) { ?>
                    <input type="submit" id="btn_cambiar_status"
                           value="Cambiar estatus a 'Histórico'" class="btn btn-success"
                           tabindex="10"
                           onclick="if (confirm('¿Está seguro de cambiar el estatus del registroCapacitacion a Histórico?')) {
                                               return changeStatus(4);
                                           } else {
                                               return false;
                                           }" />
                       <?php } ?>

            </form>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>