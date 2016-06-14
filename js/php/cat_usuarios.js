function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveUsuario").val("0");
    $("#txtNombre").val("");
    $("#txtLogin").val("");
    $("#txtPassword").val("");
    $("#frmUsuario").submit();
}

function grabar()
{
    $("#xAccion").val("grabar");
    $("#frmUsuario").submit();

}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmUsuario").submit();

}