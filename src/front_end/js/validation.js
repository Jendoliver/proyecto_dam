/* global $ */
$(document).ready(init);

function init()
{
    $("#registro_fan").click(validateFan);
    $("#registro_banda").click(validateBand);
    $("#registro_garito").click(validateBar);
}

function validateFan()
{
    $("#regfan").validate(
    {
        focusCleanup: true,
        rules: 
        {
            username: 
            {
                required: true,
                maxlength: 20
            },
            publicname: 
            {
                required: true,
                maxlength: 50
            },
            email:
            {
                required: true,
                maxlength: 100
            },
            poblacion: 
            {
                required: true
            },
            password: 
            {
                required: true,
                maxlength: 20
            },
            password_confirm:
            {
                equalTo: "#passwordfan"
            },
            pic:
            {
                extension: "jpg|png|jpeg"
            },
        },
        messages: 
        {
            username: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 20 caracteres</div>"
            },
            publicname: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 50 caracteres</div>"
            },
            email: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                email:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce una dirección de correo válida</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 100 caracteres</div>"
            },
            poblacion: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>"
            },
            password:
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 20 caracteres</div>"
            },
            password_confirm:
            {
                equalTo:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Las contraseñas no coinciden</div>"
            },
            pic:
            {
                extension: "<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> El tipo de archivo debe ser jpg, png o jpeg</div>"
            },
        }
    });
}

function validateBand()
{
    $("#regband").validate(
    {
        focusCleanup: true,
        rules: 
        {
            username: 
            {
                required: true,
                maxlength: 20
            },
            publicname: 
            {
                required: true,
                maxlength: 50
            },
            email:
            {
                required: true,
                maxlength: 100
            },
            poblacion: 
            {
                required: true
            },
            password: 
            {
                required: true,
                maxlength: 20
            },
            password_confirm:
            {
                equalTo: "#passwordband"
            },
            website:
            {
                required: false,
                maxlength: 150
            },
            telnum:
            {
                required: false,
                maxlength: 20
            },
            memnum:
            {
                required: true,
                min: 1,
                maxlength: 2
            },
            "membername[]":
            {
                required: true,
                maxlength: 20
            },
            "memberape1[]":
            {
                required: true,
                maxlength: 20
            },
            "memberape2[]":
            {
                required: true,
                maxlength: 20
            },
            "memberage[]":
            {
                required: true,
                max: 120
            }
             pic:
            {
                extension: "jpg|png|jpeg"
            },
        },
        messages: 
        {
            username: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 20 caracteres</div>"
            },
            publicname: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 50 caracteres</div>"
            },
            email: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                email:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce una dirección de correo válida</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 100 caracteres</div>"
            },
            poblacion: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>"
            },
            password:
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 20 caracteres</div>"
            },
            password_confirm:
            {
                equalTo:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Las contraseñas no coinciden</div>"
            },
            website:
            {
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 150 caracteres</div>"
            },
            telnum:
            {
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 20 caracteres</div>"
            },
            memnum:
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                min:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> ¿Tu banda no tiene miembros?</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> ¿Tanta peña, colega? Ahórrate algunos, anda...</div>",
            },
            "membername[]":
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 20 caracteres</div>"
            },
            "memberape1[]":
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 20 caracteres</div>"
            },
            "memberape2[]":
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 20 caracteres</div>"
            },
            "memberage[]":
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                max:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> ¡Menudo pureta! Quítate unos años, anda...</div>"
            },
             pic:
            {
                extension: "<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> El tipo de archivo debe ser jpg, png o jpeg</div>"
            },
        }
    });
}

function validateBar()
{
    $("#regbar").validate(
    {
        focusCleanup: true,
        rules: 
        {
            username: 
            {
                required: true,
                maxlength: 20
            },
            publicname: 
            {
                required: true,
                maxlength: 50
            },
            email:
            {
                required: true,
                maxlength: 100
            },
            poblacion: 
            {
                required: true
            },
            password: 
            {
                required: true,
                maxlength: 20
            },
            password_confirm:
            {
                equalTo: "#passwordbar"
            },
            website:
            {
                required: false,
                maxlength: 150
            },
            telnum:
            {
                required: false,
                maxlength: 20
            },
            direccion:
            {
                required: true,
                maxlength: 100
            },
            aforomax:
            {
                required: true,
                min: 1
            },
            telnum:
            {
                required: true,
                maxlength: 20
            }
             pic:
            {
                extension: "jpg|png|jpeg"
            },
        },
        messages: 
        {
            username: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 20 caracteres</div>"
            },
            publicname: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 50 caracteres</div>"
            },
            email: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                email:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce una dirección de correo válida</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 100 caracteres</div>"
            },
            poblacion: 
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>"
            },
            password:
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 20 caracteres</div>"
            },
            password_confirm:
            {
                equalTo:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Las contraseñas no coinciden</div>"
            },
            website:
            {
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 150 caracteres</div>"
            },
            telnum:
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 20 caracteres</div>"
            },
            direccion:
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                maxlength:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Introduce menos de 100 caracteres</div>"
            },
            aforomax:
            {
                required:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Campo requerido</div>",
                min:"<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> Pa ganar así prefiero no ganar</div>"
            },
             pic:
            {
                extension: "<div class='formalert'><span class='glyphicon glyphicon-chevron-right'></span> El tipo de archivo debe ser jpg, png o jpeg</div>"
            },
        }
    });
}