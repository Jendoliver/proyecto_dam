<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PRUEBA FILE</title>
</head>
<body>
    <?php
    if(isset($_POST))
    {
            $tempFile = $_FILES['pic']['tmp_name'];    
            echo $tempFile;
            	$destDir  = '/front_end/img/users/';
            $fichero_subido = $destDir . basename($_FILES['pic']['name']);
    	
    		$destName = uniqid() . '_' . $_FILES['pic']['name'];
    		$destFile = $destDir . $destName;

    		// El archivo está ahora en la destinacion con un nombre unico 
    
    		if (move_uploaded_file($_FILES['pic']['tmp_name'], $$destFile)) {
                echo "El fichero es válido y se subió con éxito.\n";
            } else {
                echo "¡Posible ataque de subida de ficheros!\n";
            }
    		
    		
    }
    ?>
    <form action="" method="POST">
        <input type="file" name="pic" id="pic" value="hi">
        <input type="submit">
    </form>
</body>
</html>