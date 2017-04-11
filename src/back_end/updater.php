<?php

require "libs/updates_lib.php";

if(isset($_POST["aceptar_banda"])) // Caso aceptar banda
{
    extract($_POST);
    if(updateConcertStatus($idconcierto, $userbanda, 1))
        bandAccepted();
}

else if(isset($_POST["rechazar_banda"])) // Caso rechazar banda
{
    extract($_POST);
    if(updateConcertStatus($idconcierto, $userbanda, 0))
        bandNotAccepted();
}

else if(isset($_POST["modificar_perfil_local"])) //modificar perfil, falta front_end
{
    extract($_POST);

    if(updateLocalStatus($username, $publicname, $pass2, $email, $telefon, $web, $aforo, $direccion))
        perfilModificat();
    }
}
else if(isset($_POST["modificar_perfil_fan"])) //modificar perfil, falta front_end
{
    extract($_POST);
    if(updateFanStatus($username, $publicname, $pass2, $email))
        perfilModificat();
    }
}
else if(isset($_POST["modificar_perfil_banda"])) //modificar perfil, falta front_end
{
    extract($_POST);
    if(updateBandaStatus($username, $publicname, $pass2, $email, $telefon, $web, $aforo, $direccion))
        perfilModificat();
    }
}