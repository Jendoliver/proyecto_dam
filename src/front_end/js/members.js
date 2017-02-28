/*global $*/
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
                        +"<input id='register_membername' class='form-control' type='text' placeholder='Pepito' name='membername[]' required/>"
                    +"</div>"
                    +"<div class='form-group'>"
                        +"<label for='memape1'>Primer apellido del miembro:</label>"
                        +"<input id='register_memberape1' class='form-control' type='text' placeholder='Tru' name='memberape1[]' required/>"
                    +"</div>"
                    +"<div class='form-group'>"
                        +"<label for='memape2'>Segundo apellido del miembro:</label>"
                        +"<input id='register_memberape2' class='form-control' type='text' placeholder='Jeviata' name='memberape2[]' required/>"
                    +"</div>"
                    +"<div class='form-group'>"
                        +"<label for='meminst'>Instrumento del miembro:</label>"
                        +"<input id='register_instrument' class='form-control' type='text' placeholder='Bandurria' name='memberinstrument[]' required/>"
                    +"</div>"
                    +"<div class='form-group'>"
                        +"<label for='memage'>Edad del miembro:</label>"
                        +"<input id='register_memberage'class='form-control' type='number' placeholder='66' name='memberage[]' required/>"
                    +"</div>";
    var res = "";
    for(var i=1; i<=memnum; i++)
    {
        res += "<h3>Información del miembro nº"+i+"</h3>";
        res += newmember;
    }
    $("#membersdiv").html(res);
}