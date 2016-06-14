$(document).ready(function () {

    $(".date-picker").datepicker({yearRange: "-0:+10", changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});
});

function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCalendarioCapacitacion").val("0");
    $("#cmbCategoriaCapacitacion").val("0");
    $("#cmbTipoCapacitacion").val("0");
    $("#txtNombre").val("");
    $("#txtDescripcion").val("");
    $("#frmCapacitacion").submit();
}

function grabar()
{
    $("#xAccion").val("grabar");
    $("#frmCapacitacion").submit();

}

function recargar()
{
    $("#xAccion").val("recargar");
    $("#frmCapacitacion").submit();

}