function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveTipoCapacitacion").val("0");
    $("#txtNombre").val("");
    $("#frmTipoCapacitacion").submit();
}

function grabar()
{
    $("#xAccion").val("grabar");
    $("#frmTipoCapacitacion").submit();

}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmTipoCapacitacion").submit();

}