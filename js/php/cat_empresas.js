function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveEmpresa").val("0");
    $("#cmbSectorProductivo").val("0");
    $("#txtNombre").val("");
    $("#frmEmpresa").submit();
}

function grabar()
{
    $("#xAccion").val("grabar");
    $("#frmEmpresa").submit();

}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmEmpresa").submit();

}