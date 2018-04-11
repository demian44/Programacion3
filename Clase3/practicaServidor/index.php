<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="accion.php" method="POST"  enctype="multipart/form-data">

    <input type="text" name="name" value="Demian"> 
    <input type="text" name="surname" value="Boullon">
    <input type="text" name="age" value="29">
    <input type="text" name="file" value="1">
    <br><br>
    <input type="submit" name="cargar" value="cargar">
    <input type="submit" name="cargar" value="modificar">
    <input type="submit" name="cargar" value="eliminar">
    <input type="file" name="archivo" id="archivo">
    
</form>
</body>
</html>