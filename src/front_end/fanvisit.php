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
    $type = checkUserType($_GET["u"]);
    switch($type) // Patch to avoid accessing to a page without the user being of that type (really ugly)
    {
        case 1: getSession($_GET["u"], $type, 0); break;
        case 2: header("Location: $bandpagevisit?u=".$_GET["u"]); break;
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
                <div class="col-md-6">
                    <div class="well">
                        <h3>Información personal</h3>
                        <?php session_start(); extract($_SESSION); ?>
                        <div><span class="glyphicon glyphicon-envelope"></span> Correo electrónico: <?php echo $emailvisit?></div>
                        <div><span class="glyphicon glyphicon-home"></span> Ciudad de residencia: <?php echo $poblacionvisit?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <h3>Próximos conciertos de las bandas que le gustan a <?php echo $publicnamevisit ?></h3>
                        <div class="container-fluid">
                            <?php selectProximosConciertosLike($usernamevisit) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="well">
                        <h3>Conciertos que <?php echo $publicnamevisit ?> ha valorado</h3>
                        <div class="container-fluid">
                            <?php selectConciertosValorados($usernamevisit) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- FIN DEL MAIN CONTAINER -->
        <?php require "footer.php" ?>
    </div>
    <?php } ?>
</body>