<?php
	$nom = "";
    $mi = "";
	$do = "";
	$er = "";
	$arc = "";
	$sql = "SELECT * FROM frente WHERE sigla='".$_SESSION["frente"]."'";
    $resCab = mysqli_query($conn, $sql);
    $filCab = mysqli_fetch_array($resCab);
    if(isset($filCab)){
    	$nom = $filCab["nombre"];
        $mi = $filCab["1er"];
        $do = $filCab["2do"];
        $er = $filCab["3er"];
        $arc = $filCab["arch"];
    }
    $nombre1 = "";
    $apellidos1 = "";
    $matricula1 = "";
	$nombre2 = "";
    $apellidos2 = "";
    $matricula2 = "";
    $nombre3 = "";
    $apellidos3 = "";
    $matricula3 = "";

    $sql1 = "SELECT * FROM estudiante WHERE Id=".$mi;
    $resCab1 = mysqli_query($conn, $sql1);
    $filCab1 = mysqli_fetch_array($resCab1);
    if(isset($filCab1)){
        $nombre1 = $filCab1["nombre"];
        $apellidos1 = $filCab1["apellido"];
        $matricula1 = $filCab1["matricula"];
    }
    $sql2 = "SELECT * FROM estudiante WHERE Id=".$do;
    $resCab2 = mysqli_query($conn, $sql2);
    $filCab2 = mysqli_fetch_array($resCab2);
    if(isset($filCab2)){
        $nombre2 = $filCab2["nombre"];
        $apellidos2 = $filCab2["apellido"];
        $matricula2 = $filCab2["matricula"];
    }
    $sql3 = "SELECT * FROM estudiante WHERE Id=".$er;
    $resCab3 = mysqli_query($conn, $sql3);
    $filCab3 = mysqli_fetch_array($resCab3);
    if(isset($filCab3)){
        $nombre3 = $filCab3["nombre"];
        $apellidos3 = $filCab3["apellido"];
        $matricula3 = $filCab3["matricula"];
    }
?>