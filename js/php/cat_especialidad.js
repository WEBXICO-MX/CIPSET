function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveEspecialidad").val("0");
    $("#txtNombre").val("");
    $("#frmEspecialidad").submit();
}

function grabar()
{
    $("#xAccion").val("grabar");
    $("#frmEspecialidad").submit();

}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmEspecialidad").submit();

}