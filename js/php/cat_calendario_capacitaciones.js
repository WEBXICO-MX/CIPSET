$(document).ready(function () {

    $(".date-picker").datepicker({yearRange: "-0:+10", changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});
});

function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCalendarioCapacitacion").val("0");
    $("#cmbCategoriaCapacitacion").val("0");
    $("#cmbTipoCapacitacion").val("0");
    $("#txtNombre").val("");
    $("#txtDescripcion").val("");
    $("#frmCapacitacion").submit();
}

function validar()
{
    var valido = true;
    var msg = "";
    
    if ($("#cmbCapacitacion").val() === "0")
    {
        msg += "Seleccione una capacitación\n";
        valido = false;
    }
    if ($("#txtFechaInicio").val() === "")
    {
        msg += "Ingrese una fecha de inicio\n";
        valido = false;
    }
    if ($("#txtFechaFin").val() === "")
    {
        msg += "Ingrese una fecha fin\n";
        valido = false;
    }

    if (!valido)
    {
        alert(msg);
    }
    return valido;

}

function grabar()
{
    if (validar())
    {
        $("#xAccion").val("grabar");
        $("#frmCapacitacion").submit();
    }
}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmCapacitacion").submit();

}