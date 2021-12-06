<?php
	include "conexion.inc.php";
    session_start();
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["password"];
    $res = mysqli_query($conn, "SELECT * FROM usuario WHERE user='".$usuario."' AND pass='".$contraseña."'");
	$fila = mysqli_fetch_array($res);
    echo "sas".$fila["id"];
	if(isset($fila)){
        $_SESSION['IdUser'] = $fila["id"];
        //$_SESSION['Rol'] = $fila["rol"];
		$res2 = mysqli_query($conn, "SELECT * FROM estudiante WHERE id='".$_SESSION['IdUser']."'");
		$fila2 = mysqli_fetch_array($res2);
        if(isset($fila2)){
			$_SESSION['Nombre'] = $fila2["nombre"]." ".$fila2["apellido"];
		}else{
			$_SESSION['Nombre'] = "Usuario Nuevo";
		}
        header("Location: bandeja.php");
    }else{
        echo "Error.";
    }
?>