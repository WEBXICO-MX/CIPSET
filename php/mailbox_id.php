<?php
require_once '../class/UtilDB.php';
require_once '../class/RegistroCapacitacion.php';

$id = isset($_GET['id']) ? ((int) $_GET['id']) : 0;

$registro = new RegistroCapacitacion($id);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Status: <?php echo($registro->getEstatusId()->getNombre());?></h4>
</div>
<div class="modal-body">
    <div class="te">
        <h2>Información del curso</h2>
        <p>
            <b>Nombre capacitación:</b>
            <?php echo($registro->getCalendarioCapacitacionId()->getCapacitacionId()->getNombre());?>
        </p>
        <p>
            <b>Fecha(s) de capacitación:</b> Fecha inicio:
            <?php echo($registro->getCalendarioCapacitacionId()->getFechaInicio());?> |
            Fecha
            fin:<?php echo($registro->getCalendarioCapacitacionId()->getFechaFin());?>
        </p>
        <h2>Información del registro</h2>
        <p>
            <b>Tipo:</b>
            <?php echo($registro->getCalendarioCapacitacionId()->getCapacitacionId()->getTipoCapacitacionId()->getNombre());?>
        </p>
        <p>
            <b>Sector productivo:</b>
            <?php echo($registro->getEmpresaId()->getSectorProductivoId()->getNombre());?>
        </p>
        <p>
            <b>Institución/Empresa:</b> <?php echo($registro->getEmpresaId()->getNombre());?>
        </p>
        <p>
            <b>Nombre:</b> <?php echo($registro->getPersonaId()->getNombre());?>
        </p>
        <p>
            <b>Apellido paterno:</b> <?php echo($registro->getPersonaId()->getApPaterno());?>
        </p>
        <p>
            <b>Apellido materno:</b> <?php echo($registro->getPersonaId()->getApMaterno());?>
        </p>
        <p>
            <b>Fecha de nacimiento:</b> <?php echo($registro->getPersonaId()->getFechaNacimiento());?>
        </p>
        <p>
            <b>Sexo:</b> <?php echo($registro->getPersonaId()->getSexo());?>
        </p>
        <c:choose>
            <c:when test="${!empty listMedioComunicacion}">
                <ul>
                    <c:forEach items="${listMedioComunicacion}" var="medioComunicacion">
                        <li>${ medioComunicacion.tipo_medio_comunicacion_id.nombre}:
                            ${ medioComunicacion.valor}</li>
                    </c:forEach>
                </ul>
            </c:when>
            <c:otherwise>
                <p>No hay medios de comunicación</p>
            </c:otherwise>
        </c:choose>

        <c:url var="addAction" value="/registroscapacitaciones/create"></c:url>
        <div class="form-group">
            <form:form action="${addAction}" commandName="registroCapacitacion">
                <form:hidden path="id" value="${ registroCapacitacion.id}" />
                <form:hidden path="calendario_capacitacion_id.id"	value="${ registroCapacitacion.calendario_capacitacion_id.id}" />
                <form:hidden path="tipo_inscripcion_id.id"			value="${ registroCapacitacion.tipo_inscripcion_id.id}" />
                <form:hidden path="persona_id.id"					value="${ registroCapacitacion.persona_id.id}" />
                <form:hidden path="empresa_id.id"					value="${ registroCapacitacion.empresa_id.id}" />
                <form:hidden path="status_id.id"					value="${ registroCapacitacion.status_id.id}"  id="cambiar_status_status"/>
                <form:hidden path="fecha_registro"					value="${ registroCapacitacion.fecha_registro}" />
                <form:hidden path="fecha_modificacion"				value="${ date}" />
                <form:hidden path="activo" value="${ registroCapacitacion.activo}" />
                <p></p>
                <c:choose>
                    <c:when test="${registroCapacitacion.status_id.id == 1}">

                        <input type="submit" id="btn_cambiar_status"
                               value="Cambiar estatus a 'Revisado'" class="btn btn-success"
                               tabindex="10"
                               onclick="if (confirm('¿Está seguro de cambiar el estatus del registroCapacitacion a Revisado?')) {
                                                                    return changeStatus(2);
                                                                } else {
                                                                    return false;
                                                                }" />

                    </c:when>
                    <c:when test="${registroCapacitacion.status_id.id == 2}">
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
                    </c:when>
                    <c:when test="${registroCapacitacion.status_id.id == 3}">
                        <input type="submit" id="btn_cambiar_status"
                               value="Cambiar estatus a 'Histórico'" class="btn btn-success"
                               tabindex="10"
                               onclick="if (confirm('¿Está seguro de cambiar el estatus del registroCapacitacion a Histórico?')) {
                                                                    return changeStatus(4);
                                                                } else {
                                                                    return false;
                                                                }" />
                    </c:when>

                </c:choose>

            </form:form>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>