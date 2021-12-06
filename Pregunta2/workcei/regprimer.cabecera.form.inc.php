<?php
    $nombre = "";
    $apellidos = "";
    $ci = "";
    $matricula = "";
    $fechaNac = "";
    $direccion = "";
    $sql = "SELECT * FROM estudiante WHERE Id=".$_SESSION["IdUser"];
    $resCab = mysqli_query($conn, $sql);
    $filCab = mysqli_fetch_array($resCab);
    if(isset($filCab)){
        $nombre = $filCab["nombre"];
        $apellidos = $filCab["apellido"];
        $ci = $filCab["ci"];
        $matricula = $filCab["matricula"];
        $fechaNac = $filCab["fecha_nac"];
        $direccion = $filCab["direccion"];
    }
?>