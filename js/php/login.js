var url = "login_ajax.php";

$(document).ready(function () {
    $('#frmLogin').submit(function (e) {
        e.preventDefault();

        var json = JSON.stringify($('#frmLogin').serializeObject());

        if (validar())
        {
            $("#mensaje").html("<span>Procesando ...</span>");
            $("#div_mensaje").removeClass("alert-success alert-info  alert-warning alert-danger");
            $("#div_mensaje").addClass("alert-success");
            $("#div_mensaje").fadeIn("slow");
            $.post(url, {"xAccion": 'grabar', "datos": json}, function (data) {
                if (data.resultado === 1)
                {
                    window.location.replace("home.php");
                }
                else
                {
                    $("#mensaje").html("<strong>Advertencia</strong> <span>" + data.mensaje + "</span>");
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

function validar()
{
    var valido = true;
    var msg = "<ul>";

    if ($("#txtLogin").val() === "")
    {
        valido = false;
        msg += "<li>Ingrese su login</li>";

    }
    if ($("#txtPassword").val() === "")
    {
        valido = false;
        msg += "<li>Ingrese su password</li>";

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