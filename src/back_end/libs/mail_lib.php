<?php // MAIL FUNCTIONS AND CONSTANTS php mailer <- 
    $SUPPORT_MAIL = "jandol1996@hotmail.com";
    require "constants.php";
    function send_confirmation_mail($to, $username)
    {
        $title = "LALECHEMUSIC.COM";
        $msg = '
        <html>
            <head>
                <title>Recuperacion de contraseña</title>
            </head>
            <body bgcolor="#FFEEAA">
                <p>Your account has been successfully created. 
                Please now proceed to click <a href="https://proyecto_transversal_dam_plix-jandol.c9users.io/confirmaccount.php?username='.echo $username.'">HERE</a> to confirm your account.
            </body>
        </html>
        ';
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'To: '.$to."\r\n";
        $headers .= 'From: Melee Trivial Support <kys@noreply.com>' . "\r\n";
        
        if(!(mail($to,$title,$msg,$headers)))
        {
            $message = "ERROR ENVIANDO MAIL";
            echo "<script type='text/javascript'>
            alert('$message');
            window.location = '$lastpage';
            </script>";
        }
        echo "KE PASA PALURDO";
    }
?>