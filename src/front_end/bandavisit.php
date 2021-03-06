<!doctype html>
<html lang="en">
<?php require "../back_end/libs/selects_lib.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profiles.css">
    <link rel="icon" href="<?php echo $favicon ?>" type="image/x-icon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/smoothiexxx.js"></script>
    <title>La Leche Music</title>
</head>

<body>
    <?php
    if(!auth())
        errorNotLogged();
    else
    { 
    if($_GET["u"] == $_SESSION["username"])
        header("Location: ".$_SESSION["home"]);
    $type = checkUserType($_GET["u"]);
    switch($type) // Patch to avoid accessing to a page without the user being of that type (really ugly)
    {
        case 1: header("Location: $fanpagevisit?u=".$_GET["u"]); break;
        case 2: getSession($_GET["u"], $type, 0); break;
        case 3: header("Location: $garitopagevisit?u=".$_GET["u"]); break;
        default: header("Location: ".$_SESSION["home"]);
    }
    ?>
    <?php require "navbarlogged.php"; ?>
    <?php require "headervisit.php"; ?>
        <div class="container"> <!-- INICIO DEL MAIN CONTAINER -->
            <!-- BARRA DE BÚSQUEDA -->
            <div class="row"><br></div>
            <div id="publicity" class="row"><div class="col-md-12"><div class="well" style="text-align: center;">PUBLICIDAD</div></div></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="well">
                        <h3>Información personal</h3>
                        <?php session_start(); extract($_SESSION); ?>
                        <div><span class="glyphicon glyphicon-envelope"></span> Correo electrónico: <?php echo $emailvisit?></div>
                        <div><span class="glyphicon glyphicon-home"></span> Ciudad de residencia: <?php echo $poblacionvisit?></div>
                        <div><span class="glyphicon glyphicon-globe"></span> Página web: <?php echo $webvisit?></div>
                        <div><span class="glyphicon glyphicon-phone-alt"></span> Teléfono de contacto: <?php echo $telvisit?></div>
                        <div><span class="glyphicon glyphicon-piggy-bank"></span> Valoración: <?php echo $valoracionvisit?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="well">
                        <h3>Solicitudes de conciertos enviadas</h3>
                        <div class="container">
                            <?php selectConciertosApuntado($usernamevisit) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="well">
                        <h3>Conciertos en los que <?php echo $publicnamevisit ?> ha sido aceptado</h3>
                        <div class="container">
                            <?php selectConciertosAceptado($usernamevisit) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- FIN DEL MAIN CONTAINER -->
        <?php require "footer.php" ?>
    </div>
    <?php } ?>
</body>