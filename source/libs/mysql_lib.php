<?php //MYSQL_LIB.PHP: DEFINICIÓN DE TODAS LAS FUNCIONES DE GESTIÓN CON LA BASE DE DATOS
    
    function alreadyExists($data, $table, $attrib) // FUNCIÓN PARA COMPROBAR SI EXISTE UN DATO EN UNA TABLA (devuelve bool)
    { // data = dato a encontrar, table = tabla en la que buscar, attrib = columna
        if(!($db = mysqli_connect("127.0.0.1", "jandol", "", "usuarios", 3306)))
            die("Error: No se pudo conectar");

        $query = "SELECT $attrib FROM $table WHERE $attrib = $data";
        $res = mysqli_query($db, $query);
        if(!($res))
            die("Error en la consulta");
            
        if (mysqli_num_rows($res)==0)
            return false;
        return true;
    }
    
?>