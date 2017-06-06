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
    <title>Recuperar contraseña</title>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <img class="navbar-brand" id="logo" src="<?php echo $logo ?>"></img>
                    <a class="navbar-brand" href="index.php">La Leche Music</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">IDIOMAS
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><img src=img/spanish.png> Español</img></a>
                                <li><a href="#"><img src=img/catalan.png> Catalán</img></a>
                                <li><a href="#"><img src=img/english.png> Inglés</img></a>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- MAIN REGISTRO -->
        <div id="recovery" class="row">
            <div class="col-md-3" style="text-align: center"><img class="cowa img-responsive" src="img/logo_big_inverted.png"/></div>
            <div class="col-md-6"><br><br>
                <h1 style="text-align: center">Recuperar contraseña</h1>
                <div class="well">
                    <form id="login-form" action="../back_end/libs/mail_lib.php" method="POST">
			    		<div id="div-login-msg">
                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-login-msg">Introduce tu nombre de usuario:</span>
                        </div>
			    		<input id="login_username" class="form-control" type="text" placeholder="Usuario" name="username" required>
    		    	    <button type="submit" name="recu" class="btn btn-success btn-sm btn-block">Recuperar</button>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-6"><img class="cowa img-responsive" src="img/logo_big_inverted.png"/></div>
                    <div class="col-md-6"><img class="cowa img-responsive" src="img/logo_big.png"/></div>
                </div>
            </div>
            <div class="col-md-3" style="text-align: center"><img class="cowa img-responsive" src="img/logo_big.png"/></div>
        </div>
        <footer></footer> <!-- HAY QUE INCLUIR EL FOOTER -->
    </div>
</body>
</html>+