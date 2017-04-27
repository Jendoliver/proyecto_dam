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
        echo $_POST["f"];
        if($_POST["f"] == "")
            echo "EMPTY STRING";
    }
    ?>
    <form action="" method="POST">
        <input type="file" name="f" value="hi">
        <input type="submit">
    </form>
</body>
</html>