<?php session_start(); ?>
<!-- HEADER DE LOS PERFILES VISITADOS (imagenes) -->
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header id="header">

                    <div class="slider">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img src="http://placehold.it/1200x400/F34336/F34336&text=EL MEJOR PERFIL">
                                </div>
                                <div class="item">
                                    <img src="http://placehold.it/1200x400/20BFA9/ffffff&text=SIEMPRE CHULIANDO STREET">
                                </div>
                                <div class="item">
                                    <img src="http://placehold.it/1200x400/FF0000/ffffff&text=SIEMPRE AL LORO">
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="fa fa-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="fa fa-angle-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <!--slider-->
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a id="img-profile" class="navbar-brand" href="#"><img id="profilepic" class="img-responsive" src="img/user_image.png"></a>
                            <span class="user-name"><?php echo $_SESSION["publicnamevisit"]; ?></span> <!-- PUBLICNAME -->
                            <span class="site-description"><?php echo "@".$_SESSION["usernamevisit"]; ?></span> <!-- USERNAME -->
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="mainNav">
                            <ul class="nav main-menu navbar-nav">
                                <?php if($_SESSION["usertypevisit"] != 1)
                                { if($_SESSION["usertypevisit"] == 2) $table = "banda";
                                    else if($_SESSION["usertypevisit"] == 3) $table = "local"; 
                                ?>
                                <li> <!-- LIKE BUTTON -->
                                    <form action="<?php echo $insertor ?>" method="POST">
                                        <input type="hidden" name="userfan" value="<?php echo $_SESSION["username"]; ?>">
                                        <input type="hidden" name="userperfil" value="<?php echo $_SESSION["usernamevisit"]; ?>">
                                        <div class="navbar-brand">
                                            <button class="btn btn-primary btn-xs" type="submit" name="valorar_perfil">
                                            <?php if(votoExiste($_SESSION["username"], $_SESSION["usernamevisit"], $table)) 
                                                    echo "<img class='img-responsive' src='$imgdislike'></img> No mola..."; 
                                                else echo "<img class='img-responsive' src='$imglike'></img> ¡Me mola!"; 
                                            ?></button>
                                        </div>
                                    </form>
                                </li>
                                <?php } ?>
                                <li><a href="#">Fotos</a></li>
                                <li><a href="#">Vídeos</a></li>
                            </ul>

                            <ul class="nav  navbar-nav navbar-right">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>

                </header>
                <!--/#HEADER-->
            </div>
        </div>
    </div>
</div>