var url = "cat_instuctor_ajax.php";
$(document).ready(function () {

    $(".date-picker").datepicker({yearRange: "-80:+0", changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});
    $('[data-toggle="popover"]').popover({placement: 'top', html: true, trigger: 'click hover'});

    $("#cmbEspecialidad").change(function () {
        var opc = this.value;
        if (opc === "2017")
        {
            console.log("change");
            $("#url_agregar_especialidad").fadeIn();
            $("#url_agregar_especialidad").focus();
        } else
        {
            $("#url_agregar_especialidad").fadeOut();
        }
    });

    /* Limpiar la ventana modal para volver a usar*/
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });


    $('#myModal').on('shown.bs.modal', function (e) {
        $('#frmEspecialidad').submit(function (e) {
            e.preventDefault();

            var data = $('#frmEspecialidad').serialize();
            data += "&xAccion=grabarEspecialidad";
            if (validarEspecialidad())
            {
                $.post(url, data, function (data) {
                    if (data.resultado === 1)
                    {
                        $('#myModal').modal('hide');
                        $("#url_agregar_especialidad").fadeOut();
                        $("#cmbEspecialidad").html("");
                        $("#cmbEspecialidad").load(url, {"xAccion": "getComboEspecialidad"}, function () {
                            $("#cmbEspecialidad").focus();
                            $("#cmbEspecialidad").val(data.especialidad_id);
                            alert(data.mensaje);
                        });
                    } else
                    {
                        $('#myModal').modal('hide');
                        $("#url_agregar_especialidad").fadeOut();
                    }
                }, 'json');
            }
        });
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
    if (validar()) {
        $("#xAccion").val("grabar");
        $("#frmInstructor").submit();
    }
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

function validar()
{
    var valido = true;
    var msg = "";

    if ($("#txtNombre").val() === "")
    {
        msg += "* Ingrese el nombre del instructor por favor.\n";
        valido = false;
    }
    if ($("#txtPaterno").val() === "")
    {
        msg += "* Ingrese el apellido paterno del instructor por favor.\n";
        valido = false;
    }
    if ($("#txtMaterno").val() === "")
    {
        msg += "* Ingrese el apellido materno del instructor por favor.\n";
        valido = false;
    }
    if ($("#txtFechaNacimiento").val() === "")
    {
        msg += "* Ingrese la fecha del instructor por favor.\n";
        valido = false;
    }
    if ($(':radio[name="rdSexo"]:checked').length === 0)
    {
        msg += "* Seleccione un sexo por favor.\n";
        valido = false;

    }
    if ($("#cmbEspecialidad").val() === "")
    {
        msg += "* Seleccione alguna especialidad por favor.\n";
        valido = false;
    }

    if (!valido)
    {
        alert(msg);
    }

    return valido;

}

function validarEspecialidad()
{
    var valido = true;
    var msg = "";

    if ($("#txtNombre2").val() === "")
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