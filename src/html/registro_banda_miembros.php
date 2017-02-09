<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Regístrate en La Leche Music</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body class="bodyregistro">
    <div class="container">
    	<header></header> <!-- HAY QUE INCLUIR EL HEADER -->
        <div>
            <!-- Begin # Register Form -->
            <form class="form-container" action="../php/confirm_registro_banda_miembros.php" method="POST">
                <div>
                    <span id="text-register-msg">Danos información sobre los miembros de tu banda...</span>
                </div>
    			<?php
    			session_start();
    			$memnum = $_SESSION["memnum"];
    			for($i=0; $i<$memnum; $i++)
    			{
    			    echo "<input id='register_membername' class='form-control' type='text' placeholder='Nombre del miembro' name='membername[]' required/>";
    			    echo "<input id='register_memberape' class='form-control' type='text' placeholder='Apellido del miembro' name='memberape[]' required/>";
    			    echo "<input id='register_instrument' class='form-control' type='text' placeholder='Instrumento del miembro' name='memberinstrument[]' required/>";
    			    echo "<input id='register_memberage'class='form-control' type='number' placeholder='Edad del miembro' name='memberage[]' required/>";
    			    echo "<br>";
    			}
    			?>
    		</div>
    	    <div id="submitbutton">
                <button type="submit" class="myButton">Terminar</button>
            </div>
            </form>
            <!-- End # Register Form -->
        </div>
        <footer></footer> <!-- HAY QUE INCLUIR EL FOOTER -->
    </div>
</body>
</html>