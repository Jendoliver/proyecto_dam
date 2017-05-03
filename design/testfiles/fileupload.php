<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PRUEBA FILE</title>
</head>
<body>
    <?php
    require "/home/ubuntu/workspace/src/back_end/libs/constants.php";
    
    if(isset($_POST))
    {
            //$tempFile = $_FILES['pic']['tmp_name'];    
            //echo $tempFile;
            $destDir  = $imgroute;
            
            
            //CORRECTA CON RELATIVA ../../src/front_end/img/users/
            //patch absolutosrc/front_end/img/users/
            //$PATH =  /home/ubuntu/workspace/;
            
            $destName = uniqid() . '_' . $_FILES['pic']['name'];

            $fichero_subido = $destDir.basename($destName);
    	
    	//	
    	//	$destFile = $destDir . $destName;

    		// El archivo está ahora en la destinacion con un nombre unico 
    
    		if (move_uploaded_file($_FILES['pic']['tmp_name'], $fichero_subido)) {
                echo "El fichero es válido y se subió con éxito.\n";
            } else {
                echo "¡Posible ataque de subida de ficheros!\n";
            }
    		
    		
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="pic"  id="pic" value="hi">
        <input type="submit">
    </form>
</body>
</html>