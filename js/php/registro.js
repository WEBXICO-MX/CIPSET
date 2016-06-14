var url = "registro_ajax.php";
$(document).ready(function () {
    $.ajaxSetup({"cache": false});

    $(".date-picker").datepicker({yearRange: "-75:+0", changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});
    /* Limpiar la ventana modal para volver a usar*/
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });

    $("#cmbEmpresa").change(function () {
        var opc = this.value;
        if (opc === "2016")
        {
            $("#url_cambiar_empresa").fadeIn();
            $("#url_cambiar_empresa").focus();
        }
        else
        {
            $("#url_cambiar_empresa").fadeOut();
        }
    });

    $('#myModal').on('shown.bs.modal', function (e) {
        $('#frmRegistroEmpresa').submit(function (e) {
            e.preventDefault();

            var json = JSON.stringify($('#frmRegistroEmpresa').serializeObject());
            if (validar2())
            {
                $.post(url, {"xAccion": 'grabarEmpresa', "datos": json}, function (data) {
                    if (data.resultado === 1)
                    {
                        $('#myModal').modal('hide');
                        $("#url_cambiar_empresa").fadeOut();
                        $("#cmbEmpresa").html("");
                        $("#cmbEmpresa").load(url, {"xAccion": "getComboEmpresas"}, function () {
                            $("#cmbEmpresa").focus();
                            $("#cmbEmpresa").val(data.empresa_id);
                        });
                    }
                    else
                    {
                        $('#myModal').modal('hide');
                        $("#url_cambiar_empresa").fadeOut();
                    }
                }, 'json');
            }
        });
    });


    $('#frmRegistroCapacitacion').submit(function (e) {
        e.preventDefault();

        var json = JSON.stringify($('#frmRegistroCapacitacion').serializeObject());
        if (validar())
        {
            $('#myModal2').modal('show');
            $.post(url, {"xAccion": 'grabarRegistroCapacitacion', "datos": json}, function (data) {
                if (data.resultado === 1)
                {
                    $('#myModal2').modal('hide');
                    //window.location.replace("../index.php?");
                    limpiar();
                    $("#frmRegistroCapacitacion").fadeOut();
                    $("#mensaje").html("<span>" + data.mensaje + "</span>");
                    $("#div_mensaje").removeClass("alert-success alert-info  alert-warning alert-danger");
                    $("#div_mensaje").addClass("alert-success");
                    $("#div_mensaje").fadeIn("slow");
                }
                else
                {
                    $('#myModal2').modal('hide');
                    $("#mensaje").html("<span>" + data.mensaje + "</span>");
                    $("#div_mensaje").removeClass("alert-success alert-info  alert-warning alert-danger");
                    $("#div_mensaje").addClass("alert-danger");
                    $("#div_mensaje").fadeIn("slow");
                }
            }, 'json');
        }
    });


});

$.fn.serializeObject = function ()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}

function validar()
{
    var valido = true;
    var msg = "<ul>";

    if ($("#txtNombre").val() === "")
    {
        valido = false;
        msg += "<li>Ingrese su nombre</li>";

    }
    if ($("#txtPaterno").val() === "")
    {
        valido = false;
        msg += "<li>Ingrese su apellido paterno</li>";

    }
    if ($("#txtMaterno").val() === "")
    {
        valido = false;
        msg += "<li>Ingrese su apellido materno</li>";

    }
    if ($("#txtFechaNacimiento").val() === "")
    {
        valido = false;
        msg += "<li>Ingrese su fecha de nacimiento</li>";
    }
    if ($(':radio[name="rdSexo"]:checked').length === 0)
    {
        valido = false;
        msg += "<li>Seleccione su sexo</li>";
    }
    if (!isValidEmailAddress($("#txtEmail").val()))
    {
        valido = false;
        msg += "<li>Ingrese un email valido</li>";
    }
    if ($("#txtCelular").val() === "")
    {
        valido = false;
        msg += "<li>Ingrese su número de celular</li>";
    }
    if ($("#cmbEmpresa").val() === "0" || $("#cmbEmpresa").val() === "2016")
    {
        valido = false;
        msg += "<li>Seleccione una empresa</li>";
    }

    msg += "</ul>";

    if (!valido)
    {
        $("#mensaje").html("<strong>Información</strong> <span>" + msg + "</span>");
        $("#div_mensaje").removeClass("alert-success alert-info  alert-warning alert-danger");
        $("#div_mensaje").addClass("alert-info");
        $("#div_mensaje").fadeIn("slow");
    }
    return valido;


}

function validar2()
{
    var valido = true;
    var msg = "<ul>";

    if ($("#txtNombreEmpresa").val() === "")
    {
        valido = false;
        msg += "<li>Ingrese el nombre de la empresa</li>";

    }
    if ($("#cmbSectorProductivo").val() === "0")
    {
        valido = false;
        msg += "<li>Seleccione un sector productivo</li>";
    }

    msg += "</ul>";

    if (!valido)
    {
        $("#mensaje2").html("<strong>Información</strong> <span>" + msg + "</span>");
        $("#div_mensaje2").removeClass("alert-success alert-info  alert-warning alert-danger");
        $("#div_mensaje2").addClass("alert-info");
        $("#div_mensaje2").fadeIn("slow");
    }
    return valido;
}

function limpiar()
{
    $("#txtNombre").val("");
    $("#txtPaterno").val("");
    $("#txtMaterno").val("");
    $("#txtFechaNacimiento").val("");
    $("#txtEmail").val("");
    $("#txtCelular").val("");
    $("#rdSexo").prop("checked", false);
    $("#cmbEmpresa").val("0");
}