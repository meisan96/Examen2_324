<?php
    $nombre = $_GET["Nombre"];
    $apellido = $_GET["Apellido"];
    $ci = $_GET["CI"];
    $fechaNac = $_GET["FechaNac"];
    $direccion = $_GET["Direccion"];
    $sql = "SELECT * FROM estudiante WHERE Id=".$_SESSION["IdUser"];
    $res = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_array($res);
    if(isset($fila)){
        $sql = "UPDATE estudiante SET nombre='".$nombre."', apellidos='".$apellido."', ci='".$ci."', fecha_nac='".$fechaNac."', direccion='".$direccion."' WHERE Id=".$_SESSION["IdUser"];
    }else{
        $sql = "INSERT INTO estudiante(Id, nombre, apellidos, ci, fecha_nac, direccion) VALUES (".$_SESSION["IdUser"].", '".$nombre."', '".$apellido."', '".$ci."', '".$fechaNac."', '".$direccion."')";
    }
    $resCab = mysqli_query($conn, $sql);
?>