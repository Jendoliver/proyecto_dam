/* global $*/
var prevcontent;
$(document).ready(function()
{
    $(".modifyconcert").click(modifyConcert);
    $(".deleteconcert").click(deleteConcert);
})

function modifyConcert()
{
    prevcontent = $("#concerts").html();
    var idconcert = $(this).parent("td").attr("id");
    $("#concerts").html(
    "<div class='col-md-12'>"+
        "<div class='well'>"+
            "<h3>Modificar un concierto</h3>"+
            "<div class='container-fluid'>"+
                "<form action='/src/back_end/updater.php' method='POST'>"+
                    "<input type='hidden' name='idconcert' value='"+idconcert+"'>"+
                    "<div class='form-group'>"+
                        "<label for='date'>Nueva fecha del concierto:</label>"+
                        "<input id='datepicker' type='text' class='form-control' name='concertdate' placeholder='Haz clic aquí...' required>"+
                    "</div>"+
                    "<div class='form-group'>"+
                        "<label for='date'>Nueva remuneración del concierto por grupo:</label>"+
                        "<input type='num' class='form-control' name='cash' placeholder='€' min='0' required>"+
                    "</div>"+
                    "<div class='row'>"+
                        "<div class='col-md-6'>"+
                            "<button type='submit' name='modificar_concierto' class='btn btn-success btn-block'>Modificar concierto</button>"+
                        "</div>"+ 
                        "<div class='col-md-6'>"+ 
                            "<button id='cancelmodify' class='btn btn-danger btn-block'>Cancelar</button>"+
                        "</div>"+
                    "</div>"+
                "</form>"+
            "</div>"+
       "</div>"+
   "</div>"
    );
    $( "#datepicker" ).datepicker({ minDate: 0 });
    $( "#datepicker" ).datepicker( "option", "dateFormat", 'yy-mm-dd' );
    $("#cancelmodify").click(cancelmodify);
}

function deleteConcert()
{
    var idconcert = $(this).parent("td").attr("id");
    $("#idconcert-modal").attr("value", idconcert);
}

function cancelmodify()
{
    $("#concerts").empty();
    $("#concerts").html(prevcontent);
    $( "#datepicker" ).datepicker({ minDate: 0 });
    $( "#datepicker" ).datepicker( "option", "dateFormat", 'yy-mm-dd' );
}