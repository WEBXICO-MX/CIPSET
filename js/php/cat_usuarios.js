function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveUsuario").val("0");
    $("#txtNombre").val("");
    $("#txtLogin").val("");
    $("#txtPassword").val("");
    $("#frmUsuario").submit();
}

function validar()
{
    var valido = true;
    var msg = "";

    if ($("#txtNombre").val() === "")
    {
        msg += "Ingrese un nombre completo al usuario\n";
        valido = false;
    }
    if ($("#txtLogin").val() === "")
    {
        msg += "Ingrese un login al usuario\n";
        valido = false;
    }
    if ($("#txtPassword").val() === "")
    {
        msg += "Ingrese un password al usuario\n";
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
        $("#frmUsuario").submit();
    }

}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmUsuario").submit();

}