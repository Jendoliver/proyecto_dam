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
    <?php require "navbarsearch.php"; ?>
    <div class="container-fluid">
        <div class="row"><br><br><br><br><br></div> <!-- WARRAPOP SIII WARRAPOP NAO -->
        <div class="row">
            <?php
            $buscar=$_POST["busqueda"];
            selectBusqueda($buscar);
            ?>
        </div>
    </div>
</body>
</html>
