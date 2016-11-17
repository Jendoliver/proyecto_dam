<?php //CONFIRMAR REGISTRO
    if(strlen($_POST["register_phone"])==9)
    { //COMPROBACIÓN TELÉFONO VÁLIDA
        session_start();
        $_SESSION["localname"] = $_POST["register_localname"];
        $_SESSION["address"] = $_POST["register_address"];
        $_SESSION["capacity"] = $_POST["register_capacity"];
        $_SESSION["style"] = $_POST["register_style"];
        $_SESSION["phone"] = $_POST["register_phone"];
        header('Location: ../html/registro_exito.html');
    }
    else
    {
        $message = "Introduce un teléfono válido";
        echo "<script type='text/javascript'>
        alert('$message');
        window.location = '../html/registro_garito.html';
        </script>";
    }
?>