var url = "mailbox_ajax2.php";

$(document).ready(function () {
    $.ajaxSetup({
        cache: false
    });

    getBuzon("#sectionA");

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href");
        getBuzon(target);
    });

    /* Limpiar la ventana modal para volver a usar*/
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });

    $('#myModal').on('shown.bs.modal', function (e) {
        $('#frmMailbox').submit(function (e) {
            e.preventDefault();

            var json = JSON.stringify($('#frmMailbox').serializeObject());
            $.post(url, {"xAccion": 'cambiarStatus', "datos": json}, function (data) {
                if (data.resultado === 1)
                {
                    $('#myModal').modal('hide');
                    $("#mensaje").html("<span>" + data.mensaje + "</span>");
                    $("#div_mensaje").removeClass("alert-success alert-info  alert-warning alert-danger");
                    $("#div_mensaje").addClass("alert-success");
                    $("#div_mensaje").fadeIn("slow");
                    var tgt = getTarget(data.estatus);
                    getBuzon(tgt);
                }
                else
                {
                    $('#myModal').modal('hide');
                    $("#mensaje").html("<span>" + data.mensaje + "</span>");
                    $("#div_mensaje").removeClass("alert-success alert-info  alert-warning alert-danger");
                    $("#div_mensaje").addClass("alert-danger");
                    $("#div_mensaje").fadeIn("slow");
                }
            }, 'json');
        });
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

function getBuzon(target) {
    var status = getStatus(target);
    $.ajax({
        url: "mailbox_ajax.php?st=" + status,
        error: function (data) {
            alert("There was a problem");
        },
        success: function (data) {
            $(target).html(data);
        }
    });
}

function changeStatus(status) {
    $("#xCveEstatus").val(status);
    return true;
}

function getStatus(target) {
    var status = 0;
    switch (target) {
        case "#sectionA":
            status = 1;
            break;
        case "#sectionB":
            status = 2;
            break;
        case "#sectionC":
            status = 3;
            break;
        case "#sectionD":
            status = 4;
            break;
        case "#sectionE":
            status = 5;
            break;
        default:
            status = 0;

    }

    return status;

}

function getTarget(status) {
    var target = "";
    switch (status) {
        case 1:
            target = "#sectionA";
            break;
        case 2:
            target = "#sectionB";
            break;
        case 3:
            target = "#sectionC";
            break;
        case 4:
            target = "#sectionD";
            break;
        case 5:
            target = "#sectionE";
            break;
        default:
            target = "#sectionA";

    }

    return target;

}