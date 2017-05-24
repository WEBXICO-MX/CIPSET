function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveEspecialidad").val("0");
    $("#txtNombre").val("");
    $("#frmEspecialidad").submit();
}

function validar()
{
    var valido = true;
    var msg = "";

    if ($("#txtNombre").val() === "")
    {
        msg += "Ingrese el nombre de la especialidad por favor.";
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
    if (validar()) {
        $("#xAccion").val("grabar");
        $("#frmEspecialidad").submit();
    }
}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmEspecialidad").submit();

}