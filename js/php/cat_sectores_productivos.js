function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveSectorProductivo").val("0");
    $("#txtNombre").val("");
    $("#frmSectorProductivo").submit();
}

function grabar()
{
    $("#xAccion").val("grabar");
    $("#frmSectorProductivo").submit();

}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmSectorProductivo").submit();

}