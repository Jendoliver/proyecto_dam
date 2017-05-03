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
    <?php session_start();
    if(!auth()) { $_SESSION["usertype"] = 0; }
        require "navbarlogged.php"; ?>
    <?php require "navbarlogged.php";  } ?>
    <div class="container-fluid">
        <div class="row"><br><br><br><br><br></div>
        <div class="row"> <!-- APROXIMACIÓN -->
        
            <?php
            $buscar=$_POST["busqueda"];
            selectBusqueda($buscar);
            ?>
            <!--
            <div class="col-md-3">
                <h3>Perfil de Jendoliver (fan)</h3>
                <form action="../back_end/selector.php" method="POST">
                    <input type="hidden" name="username" value="jendoliver">
                    <input type="hidden" name="usertype" value="fan">
                    <input class="btn btn-success" type="submit" name="visitProfile" value="Visitar">
                </form>
            </div>
            <div class="col-md-3">
                <h3>Perfil de Fénix Oficial (banda)</h3>
                <form action="../back_end/selector.php" method="POST">
                    <input type="hidden" name="username" value="fenixheavymetal">
                    <input type="hidden" name="usertype" value="banda">
                    <input class="btn btn-success" type="submit" name="visitProfile" value="Visitar">
                </form>
            </div>
            <div class="col-md-3">
                <h3>Perfil de Anuard (fan)</h3>
                <form action="../back_end/selector.php" method="POST">
                    <input type="hidden" name="username" value="guimaso">
                    <input type="hidden" name="usertype" value="fan">
                    <input class="btn btn-success" type="submit" name="visitProfile" value="Visitar">
                </form>
            </div>
            <div class="col-md-3">
                <h3>Perfil de Bóveda Marina (garito)</h3>
                <form action="../back_end/selector.php" method="POST">
                    <input type="hidden" name="username" value="bovedamarina">
                    <input type="hidden" name="usertype" value="local">
                    <input class="btn btn-success" type="submit" name="visitProfile" value="Visitar">
                </form>
            </div>-->
        </div>
        <?php //getProfilesLike($_POST["q"]); ?> <!-- ESTO SERÍA LA BÚSQUEDA REAL -->
    </div>
    
</body>
</html>