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
    <script src="js/smoothiexxx.js"></script>
    <script src="js/members.js"></script>
    <title>Regístrate en La Leche Music</title>
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
                    <a class="navbar-brand" href="index.php">La Leche Music</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="#fans">SOY UN FAN</a></li>
                        <li><a href="#bandas">SOY UNA BANDA</a></li>
                        <li><a href="#garitos">TENGO UN GARITO</a></li>
                    </ul>
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
        <!-- CAROUSEL DE IMAGENES A MODIFICAR PARA ADECUARLO AL REGISTRO-->
        <div id="carousel-head" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-head" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-head" data-slide-to="1"></li>
                <li data-target="#carousel-head" data-slide-to="2"></li>
            </ol>
    
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="img/concierto.jpg" alt="New York" width="1200" height="700">
                    <div class="carousel-caption">
                        <h3>EL FAN</h3>
                        <p>¿Eres un fan en busca de sus músicos favoritos? ¡Descubre donde actúan!</p>
                    </div>      
                </div>
    
                <div class="item">
                    <img src="img/bandas.jpg" alt="Chicago" width="1200" height="700">
                    <div class="carousel-caption">
                        <h3>LA BANDA</h3>
                        <p>¿Eres una banda en busca de garitos donde actuar?</p>
                    </div>      
                </div>
        
                <div class="item">
                    <img src="img/garitos.jpg" alt="Los Angeles" width="1200" height="700">
                    <div class="carousel-caption">
                        <h3>EL GARITO</h3>
                        <p>¿Eres un garito en busca de los amantes de la música y el bebercio?</p>
                    </div>      
                </div>
            </div>
    
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#carousel-head" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-head" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        
        <!-- MAIN REGISTRO -->
        <div class="container">
            <!-- REGISTRO FANS -->
            <div id="fans" class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h1 style="text-align: center">¿Eres un fan?</h1>
                    <div class="well">
                        <form action="../back_end/insertor.php" method="POST">
                            <div class="form-group">
                                <label for="username">Nombre de usuario:</label>
                                <input type="text" class="form-control" name="username" placeholder="elmejorfan" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label for="publicname">Nombre público <em>(cómo te conoce la gente)</em>:</label>
                                <input type="text" class="form-control" name="publicname" placeholder="Moshpitter 666" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico:</label>
                                <input type="email" class="form-control" name="email" placeholder="speedking@gmail.com" maxlength="100" required>
                            </div>
                            <div class="form-group">
                                <label for="poblacion">Ciudad de residencia:</label>
                                <select class="form-control" name="poblacion">
                                    <?php selectPoblaciones() ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pass">Contraseña:</label>
                                <input type="password" class="form-control" name="password" placeholder="lml" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label for="passconf">Confirmar contraseña:</label>
                                <input type="password" class="form-control" name="password_confirm" placeholder="lml" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label for="pic">¡Una foto de tí! <em>(opcional)</em></label> <!-- POR IMPLEMENTAR -->
                                <input type="text" class="form-control" name="pic" placeholder="Próximamente" maxlength="11">
                            </div>
                            <button type="submit" name="registro_fan" class="btn btn-success btn-block">¡Quiero conocer los mejores garitos y bandas!</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <!-- REGISTRO BANDAS -->
            <div id="bandas" class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h1 style="text-align: center">¿Eres una banda?</h1>
                    <div class="well">
                        <form action="../back_end/insertor.php" method="POST">
                            <h3>Información de la cuenta</h3>
                            <div class="form-group">
                                <label for="username">Nombre de usuario <em>(el que usas para iniciar sesión)</em>:</label>
                                <input type="text" class="form-control" name="username" placeholder="rocknroll" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico:</label>
                                <input type="email" class="form-control" name="email" placeholder="speedking@gmail.com" maxlength="100" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">Contraseña:</label>
                                <input type="password" class="form-control" name="password" placeholder="007" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label for="passconf">Confirmar contraseña:</label>
                                <input type="password" class="form-control" name="password_confirm" placeholder="007" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label for="pic">¡Una foto de vosotros! <em>(opcional)</em></label> <!-- POR IMPLEMENTAR -->
                                <input type="text" class="form-control" name="pic" placeholder="Introduce la defensa del Pokémon PAAAAAAAAAAARDO" maxlength="11">
                            </div>
                            <h3>Información de la banda</h3>
                            <div class="form-group">
                                <label for="publicname">Nombre de la banda <em>(así lo verá la gente en tu perfil)</em>:</label>
                                <input type="text" class="form-control" name="publicname" placeholder="Fénix" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label for="poblacion">Ciudad de residencia:</label>
                                <select class="form-control" name="poblacion">
                                    <?php selectPoblaciones() ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bandstyle">Estilo de la banda <em>(opcional, luego podrás especificar más)</em>:</label>
                                <select class="form-control" name="idgenero">
                                    <?php selectGeneros() ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="website">Página web de la banda <em>(¡si tenéis!)</em>:</label>
                                <input type="text" class="form-control" name="website" placeholder="www.avedefuego.com" maxlength="150">
                            </div>
                            <div class="form-group">
                                <label for="telnum">Número de teléfono de la banda <em>(opcional)</em>:</label>
                                <input type="text" class="form-control" name="telnum" placeholder="rocknroll" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label for="memnum">Número de miembros:</label>
                                <input id="members" type="number" min="1" maxlength="2" class="form-control" name="memnum" placeholder="rocknroll" required>
                            </div>
                            <div id="membersdiv"></div>
                            <button type="submit" name="registro_banda" class="btn btn-success btn-block">¡Quiero que me escuchen por todo el mundo!</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <!-- REGISTRO GARITOS -->
            <div id="garitos" class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h1 style="text-align: center">¿Tienes un garito?</h1>
                    <div class="well">
                        <form action="../back_end/insertor.php" method="POST">
                            <h3>Información de la cuenta</h3>
                            <div class="form-group">
                                <label for="username">Nombre de usuario <em>(el que usas para iniciar sesión)</em>:</label>z
                                <input type="text" class="form-control" name="username" placeholder="rocknroll" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico:</label>
                                <input type="email" class="form-control" name="email" placeholder="speedking@gmail.com" maxlength="100" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">Contraseña:</label>
                                <input type="password" class="form-control" name="password" placeholder="007" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label for="passconf">Confirmar contraseña:</label>
                                <input type="password" class="form-control" name="password_confirm" placeholder="007" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label for="pic">¡Una foto de tu garito! <em>(opcional)</em></label> <!-- POR IMPLEMENTAR -->
                                <input type="text" class="form-control" name="pic" placeholder="Introduce la defensa del Pokémon PAAAAAAAAAAARDO" maxlength="11">
                            </div>
                            <h3>Información del garito</h3>
                            <div class="form-group">
                                <label for="publicname">Nombre del garito <em>(así lo verá la gente en tu perfil)</em>:</label>
                                <input type="text" class="form-control" name="publicname" placeholder="Bóveda" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label for="garitostyle">Estilo más común <em>(opcional, luego podrás especificar más)</em>:</label>
                                <select class="form-control" name="idgenero">
                                    <?php selectGeneros() ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección del garito:</label>
                                <input type="text" class="form-control" name="direccion" placeholder="Calle Roc Boronat, 33" maxlength="100" required>
                            </div>
                            <div class="form-group">
                                <label for="poblacion">Ciudad:</label>
                                <select class="form-control" name="poblacion">
                                    <?php selectPoblaciones() ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="aforomax">Aforo máximo:</label>
                                <input type="number" class="form-control" name="aforomax" placeholder="To kiski" maxlength="20">
                            </div>
                            <div class="form-group">
                                <label for="website">Página web del garito <em>(¡si tenéis!)</em>:</label>
                                <input type="text" class="form-control" name="website" placeholder="www.avedefuego.com" maxlength="150">
                            </div>
                            <div class="form-group">
                                <label for="telnum">Número de teléfono del responsable del garito:</label>
                                <input type="text" class="form-control" name="telnum" placeholder="Y que no sea falso, tronco" maxlength="20" required>
                            </div>
                            <button type="submit" name="registro_garito" class="btn btn-success btn-block">¡Quiero que vengan a tocar grandes músicos a mi garito!</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <footer></footer> <!-- HAY QUE INCLUIR EL FOOTER -->
    </div>
</body>
</html>