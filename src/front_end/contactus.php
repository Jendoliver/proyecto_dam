<!doctype html>
<html lang="en">
<?php require "../back_end/libs/selects_lib.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="<?php echo $favicon ?>" type="image/x-icon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- SMOOTH SCROLLING -->
    <script src="js/smoothiexxx.js"></script>
    <!-- MEMBERS ECHO SCRIPT -->
    <script src="js/members.js"></script>
    <!-- FORM VALIDATION -->
    <script src="js/libs/jquery.validate.min.js"></script>
    <script src="js/validation.js"></script>
    <title>Contacta con La Leche Music</title>
</head>
<body>
    <?php
    if(!auth())
        errorNotLogged();
    else
    { ?>
    <?php require "navbarlogged.php"; ?>
    <div class="container-fluid">
        
        <div class="container">
            <div id="msg" class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h1 style="text-align: center">Envia tu mensaje</h1>
                    <div class="well">
                        <form id="regfan" action="../back_end/libs/mail_libs.php" method="POST">
                            <div class="form-group">
                                <label for="asunto">Asunto del mensaje:</label>
                                <input type="text" class="form-control" name="asunto">
                            </div>
                            <input type="hidden" name="asunto">
                            <input type="hidden" name="asunto">
                            <div class="form-group">
                                <label for="contenido">Contenido:</label>
                                <input type="text" class="form-control" name="contenido">
                            </div>
                            <button type="submit" name="sendauto" class="btn btn-success btn-block">enviar mensaje</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <footer></footer>
    </div>
    <?php }?>
</body>
</html>