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
    { ?>
    <?php require "navbarlogged.php"; ?>
    <?php require "headerperfiles.php"; ?>
        <div class="container"> <!-- INICIO DEL MAIN CONTAINER -->
            <!-- BARRA DE BÚSQUEDA -->
            <div class="row"><br></div>
            <div id="publicity" class="row"><div class="col-md-12"><div class="well" style="text-align: center;">PUBLICIDAD</div></div></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="well">
                        <h3>Información personal</h3>
                        <?php session_start(); extract($_SESSION); ?>
                        <div><span class="glyphicon glyphicon-envelope"></span> Correo electrónico: <?php echo $email?></div>
                        <div><span class="glyphicon glyphicon-home"></span> Ciudad de residencia: <?php echo $poblacion?></div>
                        <div>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Modificar perfil
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <div class="modal-body">
                                    <form id="login-form" action="../back_end/updater.php" method="POST">
                                        <div id="div-login-msg">
                                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="text-login-msg">Actual password:</span>
                                        </div>
        				    		    <input class="form-control" type="password" placeholder="Old password" name="pass1" required>
        				    		    
        				    		    <div id="div-login-msg">
                                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="text-login-msg">Publicname:</span>
                                        </div>
        				    		    <input value="<?php echo $publicname?>" class="form-control" type="text" placeholder="Usuario" name="publicname">
        				    		    
        				    		    <div id="div-login-msg">
                                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="text-login-msg">New password:</span>
                                        </div>
        				    		    <input class="form-control" type="password" placeholder="Password" name="pass2" value="">
        				    		    <!--<input type="hidden"  name="pass3" value="<?php echo $pass?>">
        				    		    -->
        				    		    <div id="div-login-msg">
                                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="text-login-msg">Email:</span>
                                        </div>
        				    		    <input value="<?php echo $email?>" class="form-control" type="text" placeholder="Exemple@hotmail.com" name="email">
        				    		    
        				    		    <div id="div-login-msg">
                                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="text-login-msg">Ciudad:</span>
                                        </div>
        				    		    <select class="form-control" name="poblacion">
                                        <?php selectPoblacionMod($poblacion);?>
                                        </select>
        				    		    
        				    		    <input type="hidden"  name="username" value="<?php echo $username?>">
                		    	        <button type="submit" name="modificar_perfil_fan" class="btn btn-success btn-sm btn-block">Modificar</button>
                                    </form>
                		        </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <h3>Próximos conciertos de las bandas que te gustan</h3>
                        <div class="container-fluid">
                            <?php selectProximosConciertosLike($username)?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="well">
                        <h3>Conciertos que has valorado</h3>
                        <div class="container-fluid">
                            <?php selectConciertosValorados($username)?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- FIN DEL MAIN CONTAINER -->
        <?php require "footer.php" ?>
    </div>
    <?php } ?>
</body>