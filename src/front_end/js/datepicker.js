/*global $*/
$(document).ready(function()
{
    $( "#datepicker" ).datepicker({ minDate: 0 });
    $( "#datepicker" ).datepicker( "option", "dateFormat", 'yy-mm-dd' );
});