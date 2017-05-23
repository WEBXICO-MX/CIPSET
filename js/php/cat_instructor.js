$(document).ready(function () {

    $(".date-picker").datepicker({yearRange: "-80:+0", changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});
    $('[data-toggle="popover"]').popover({placement: 'top', html: true, trigger: 'click hover'});

    /* Limpiar la ventana modal para volver a usar*/
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
});

function limpiar()
{
    $("#xAccion").val("0");
    $("#txtCveInstructor").val("0");
    $("#txtNombre").val("");
    $("#txtPaterno").val("");
    $("#txtMaterno").val("");
    $("#txtFechaNacimiento").val("");
    $("#rdSexo").prop("checked", false);
    $("#cmbEspecialidad").val("0");
    $("#txtRutaFoto").val("");
    $("#txtExperiencia").val("");
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

function subir()
{
    if ($("#fileToUpload").val() !== "")
    {
        $("#xAccion2").val("upload");
        $("#frmUpload").submit();
    } else
    {
        alert("No ha seleccionado un archivo para subir.");
    }
}