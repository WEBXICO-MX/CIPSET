$(document).ready(function () {
    $('[data-toggle="popover"]').popover({placement: 'top', html: true, trigger: 'click hover'});

    /* Limpiar la ventana modal para volver a usar*/
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });

    CKEDITOR.replace("txtDescripcion");

});
function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveCapacitacion").val("0");
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

function subir()
{
    if ($("#fileToUpload").val() !== "")
    {
        $("#xAccion2").val("upload");
        $("#frmUpload").submit();
    }
    else
    {
        alert("No ha seleccionado un archivo para subir.");
    }
}