<?php // MAIL FUNCTIONS AND CONSTANTS php mailer <- 
require "bbdd_lib.php";
require "constants.php";
if(isset($_POST["recu"]))
{
$use=$_POST["username"];
error_reporting( E_ALL & ~( E_NOTICE | E_STRICT | E_DEPRECATED ) ); //Aquí se genera un control de errores "NO BORRAR NI SUSTITUIR"
require_once "Mail.php"; //Aquí se llama a la función mail "NO BORRAR NI SUSTITUIR"
$userpass= rand( 10000000, 99999999 );

$to = selectemail($use);//Aquí definimos quien recibirá el formulario
$from = 'milkman@lalechemusic.com'; //Aquí definimos que cuenta mandará el correo, generalmente perteneciente al mismo dominio
$host = 'smtp.lalechemusic.com'; //Aquí definimos cual es el servidor de correo saliente desde el que se enviaran los correos
$username = 'milkman@lalechemusic.com'; //Aqui se define el usuario de la cuenta de correo
$password = 'a53318214M!'; //Aquí se define la contraseña de la cuenta de correo que enviará el mensaje
$subject = 'Tu password de lalechemusic'; //Aquí se define el asunto del correo
$body = "Tu password ahora es ".$userpass."<br> Te recomendamos que renueves tu password y elimines este correo una vez renovada<br><a href='http://lalechemusic.com/front_end/index.php'>Go to lalechemusic</a>"; //Aquí se define el cuerpo de correo


//A partir de aquí empleamos la función mail para enviar el formulario 
$headers = array ('From' => $from,'To' => $to,'Subject' => $subject);
$smtp = Mail::factory('smtp',array ('host' => $host,'auth' => true,'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $body);

updatePass($use, $userpass);
echo "Mensaje enviado desde lalechemusic a ". $to ;
header('Location: http://lalechemusic.com/front_end/index.php');
}
if(isset($_POST["sendauto"]))
{

error_reporting( E_ALL & ~( E_NOTICE | E_STRICT | E_DEPRECATED ) ); //Aquí se genera un control de errores "NO BORRAR NI SUSTITUIR"
require_once "Mail.php"; //Aquí se llama a la función mail "NO BORRAR NI SUSTITUIR"

$to = 'milkman@lalechemusic.com';//Aquí definimos quien recibirá el formulario
$from = 'milkman@lalechemusic.com'; //Aquí definimos que cuenta mandará el correo, generalmente perteneciente al mismo dominio
$host = 'smtp.lalechemusic.com'; //Aquí definimos cual es el servidor de correo saliente desde el que se enviaran los correos
$username = 'milkman@lalechemusic.com'; //Aqui se define el usuario de la cuenta de correo
$password = 'a53318214M!'; //Aquí se define la contraseña de la cuenta de correo que enviará el mensaje
$subject = $_POST["asunto"]; //Aquí se define el asunto del correo
$body = $_POST["contenido"]; //Aquí se define el cuerpo de correo

//A partir de aquí empleamos la función mail para enviar el formulario 
$headers = array ('From' => $from,'To' => $to,'Subject' => $subject);
$smtp = Mail::factory('smtp',array ('host' => $host,'auth' => true,'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $body);

echo "Mensaje enviado desde lalechemusic a ". $to ;
header('Location: http://lalechemusic.com/front_end/index.php');
}
function selectemail($username)
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT email FROM usuario WHERE username = '$username'";
    if($res = mysqli_query($con, $query))
    {
         $res = mysqli_query($con, $query);
         $row = mysqli_fetch_assoc($res);
         extract($row);
         return $email;
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
        return "error";
    }
}
function updatePass($username, $pass)
{
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $update = "UPDATE usuario SET pass = '$pass' WHERE username = '$username';";
    $con = conectar($GLOBALS['db']);
    mysqli_query($con, $update);
    desconectar($con);
    return 1;
}
?>