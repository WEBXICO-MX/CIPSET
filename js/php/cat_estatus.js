function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveEstatus").val("0");
    $("#txtNombre").val("");
    $("#frmEstatus").submit();
}

function grabar()
{
    $("#xAccion").val("grabar");
    $("#frmEstatus").submit();

}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmEstatus").submit();

}