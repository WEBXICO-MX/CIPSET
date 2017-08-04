function agregarCapacitacion(xCveCapacitacion, xCapacitacion, xCveInstructor, xInstructor, xSeAgrega) {
    if (confirm('¿Desea ' + (xSeAgrega ? 'AGREGAR' : 'ELIMINAR') + ' la capacitación "' + xCapacitacion + '" al instructor "' + xInstructor + '"?'))
    {
        $.post("cat_instructores_capacitaciones_ajax.php", {"xAccion": "grabar", "xCveCapacitacion": xCveCapacitacion, "xCveInstructor": xCveInstructor, "xSeAgrega": xSeAgrega}, function (data) {
            if (parseInt(data) !== 0)
            {
                getTablaCapacitaciones(xCveInstructor);
                alert('Capacitación "' + xCapacitacion + '" '+(xSeAgrega ? 'agregada' : 'eliminada')+' con exito al instructor "' + xInstructor + '"');

            }
        });
    } else
    {
    }
}

function getTablaCapacitaciones(xCveInstructor) {
    $("#div_resultado").html("<img src=\"../img/ajax-loading.gif\" width=\"20\" height=\"21\" alt=\"Cargando\"/> Cargando ...");
    $("#div_resultado").load("cat_instructores_capacitaciones_ajax.php", {"xAccion": "getTablaCapacitaciones", "xCveInstructor": xCveInstructor}, function () {
        $('#tabla-intructores-capacitaciones').DataTable({"order": [[0, "desc"]]});
    });
}