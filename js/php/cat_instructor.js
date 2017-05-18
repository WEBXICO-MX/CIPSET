function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveInstructor").val("0");
    $("#txtNombre").val("");
    $("#frmInstructor").submit();
}

function grabar()
{
    $("#xAccion").val("grabar");
    $("#frmInstructor").submit();

}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmInstructor").submit();

}