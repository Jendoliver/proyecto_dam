/*global $*/
var res="";
$(document).ready(init);
function init()
{
    $("#members").keyup(actmemnum);  
}

function actmemnum()
{
    var memnum = $("#members").val();
    var newmember = "<div class='form-group'>"
                        +"<label for='memname'>Nombre del miembro:</label>"
                        +"<input id='register_membername' class='form-control' type='text' placeholder='Pepito' name='membername[]'/>"
                    +"</div>"
                    +"<div class='form-group'>"
                        +"<label for='memape1'>Primer apellido del miembro:</label>"
                        +"<input id='register_memberape1' class='form-control' type='text' placeholder='Tru' name='memberape1[]'/>"
                    +"</div>"
                    +"<div class='form-group'>"
                        +"<label for='memape2'>Segundo apellido del miembro:</label>"
                        +"<input id='register_memberape2' class='form-control' type='text' placeholder='Jeviata' name='memberape2[]'/>"
                    +"</div>"
                    +"<div id='instruments' class='form-group'>"
                        +"<label for='meminst'>Instrumento del miembro:</label>"
                        +"<select class='form-control' name='memberinstrument[]'></select>"
                    +"</div>"
                    +"<div class='form-group'>"
                        +"<label for='memage'>Edad del miembro:</label>"
                        +"<input id='register_memberage' class='form-control' type='number' placeholder='66' name='memberage[]'/>"
                    +"</div>";
    res = "";

    for(var i=1; i<=memnum; i++)
    {
        res += "<h3>Información del miembro nº"+i+"</h3>";
        res += newmember;
    }
    $("#membersdiv").html(res);
    getInstruments();
}

function getInstruments()
{
    $("#instruments select").empty();
	$.ajax({
            type: "POST",
            url: "js/getInstruments.php",
            success: function(response)
            {
                $('#instruments select').html(response).fadeIn();
            }
    });
}