/*global $*/
// DATOS COMUNES
var usertype;
var publicname;
var email;
var poblacion;

// DATOS BANDA/LOCAL
var web;
var telefon;

// DATOS LOCAL
var direccion;

var noModify;

$(document).ready(function()
{
    // DATOS COMUNES GATHER
    usertype = $("#usertype").val();
    email = $("#email").html();
    poblacion = $("#poblacion").html();
    publicname = $(".user-name").html();
    
    // DATOS BANDA/LOCAL
    if(usertype > 1)
    {
        web = $("#web").html();
        telefon = $("#telefon").html();
        if(usertype == 3) direccion = $("#direccion").html(); // DATOS LOCAL
    }
    $("#modify").click(toggleModify);
});

function toggleModify()
{
    $("#modify").off();
    noModify = $("#personalinfo").html();
    $("#personalinfo h3").html("Modificar información");
    // Añadir input de publicname
    $("#publicname").append(
        "Nombre público: " +
        "<input type='text' class='form-control' name='publicname' value='"+publicname+"'>");
    
    // Añadir input de password
    $("#password").append(
        "Nueva contraseña: " +
        "<input type='password' class='form-control' name='newpass'>");
    
    // Convertir spans de datos en inputs
    $("#email").empty();
    $("#email").append("<input type='text' class='form-control' name='email' value='"+email+"'>");
    $("#poblacion").empty();
    $("#poblacion").append("<select id='poblaciones' class='form-control' name='poblacion'></select>"); // TODO: USAR POBLACION ACTUAL
    getCities();
    
    // DATOS BANDA/LOCAL
    if(usertype > 1)
    {
        $("#web").empty();
        $("#web").append("<input type='text' class='form-control' name='web' value='"+web+"'>");
        $("#telefon").empty();
        $("#telefon").append("<input type='text' class='form-control' name='telefon' value='"+telefon+"'>");
        if(usertype == 3)
        {
            $("#direccion").empty();
            $("#direccion").append("<input type='text' class='form-control' name='direccion' value='"+direccion+"'>");
        }
    }
    
    // Cambiar botones
    $("#buttons").empty();
    $("#buttons").append("<div><button class='btn btn-success btn-sm' data-toggle='modal' data-target='#passconfirm'>Confirmar</button>"+   
                            "     <button class='btn btn-danger btn-sm cancelmodify'>Cancelar</button></div>");
    $(".cancelmodify").click(removeModify);
}

function removeModify()
{
    $("#personalinfo").html(noModify).fadeIn(500);
    $("#modify").click(toggleModify);
}

function getCities()
{
	$.ajax({
            type: "POST",
            data: {'poblacion':poblacion},
            url: "js/getCities.php",
            success: function(response)
            {
                $('#poblaciones').html(response).fadeIn();
            }
    });
}