function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveTipoMedioComunicacion").val("0");
    $("#txtNombre").val("");
    $("#frmTipoMedioComunicacion").submit();
}

function grabar()
{
    $("#xAccion").val("grabar");
    $("#frmTipoMedioComunicacion").submit();

}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmTipoMedioComunicacion").submit();

}