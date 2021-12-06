<?php
	session_start();
	include "conexion.inc.php";
	$flujo = $_GET["flujo"];
	$proceso = $_GET["proceso"];
	$formulario = $_GET["formulario"];
	include $formulario.".controlador.form.inc.php";
	if (isset($_GET["Siguiente"])){
		$sql = "SELECT * FROM flujo_proceso WHERE flujo='$flujo' AND proceso='$proceso'";
		$resultado = mysqli_query($conn, $sql);
		$fila = mysqli_fetch_array($resultado);
		$proceso_siguiente = $fila["proceso_sig"];

		$sql = "SELECT * FROM seguimiento WHERE flujo='$flujo' AND proceso='$proceso' AND fecha_fin IS NULL AND id=".$_SESSION["IdUser"];
		$resultado = mysqli_query($conn, $sql);
		$fila = mysqli_fetch_array($resultado);
		$nro = $fila["nro"];
		if(isset($fila)){
			$sql = "UPDATE seguimiento SET fecha_fin='".date("Y-m-d")."' WHERE flujo='$flujo' AND proceso='$proceso' AND nro='".$fila['nro']."' AND Id=".$_SESSION["IdUser"];			
			$res = mysqli_query($conn, $sql);
			if($proceso_siguiente != "F"){
				$sql6 = "INSERT INTO seguimiento(flujo, proceso, Id, fecha_ini, fecha_fin) VALUES('".$flujo."','".$proceso_siguiente."',".$_SESSION["IdUser"].",'".date('Y-m-d')."',null)";
    			$resultado6 = mysqli_query($conn, $sql6);
    		}else{
    			$sql6 = "INSERT INTO seguimiento(flujo, proceso, Id, fecha_ini, fecha_fin) VALUES('".$flujo."','".$proceso_siguiente."',".$_SESSION["IdUser"].",'".date('Y-m-d')."','".date('Y-m-d')."')";
    			$resultado6 = mysqli_query($conn, $sql6);
    		}
		}else{
			$sql2 = "SELECT * FROM seguimiento WHERE flujo='$flujo' AND proceso='$proceso' AND fecha_fin IS NOT NULL AND id=".$_SESSION["IdUser"];
			$resultado2 = mysqli_query($conn, $sql2);
			$fila2 = mysqli_fetch_array($resultado2);
			if(!isset($fila2)){
				$sql = "INSERT INTO seguimiento (flujo, proceso, Id, fecha_ini, fecha_fin) VALUES ('$flujo','$proceso',".$_SESSION["IdUser"].",'".date('Y-m-d')."','".date('Y-m-d')."')";
				$res = mysqli_query($conn, $sql);
			}
		}
		header("Location: motor.php?flujo=$flujo&proceso=$proceso_siguiente");
	}else if(isset($_GET["Anterior"])){
		$sql = "SELECT * FROM flujo_proceso WHERE flujo='$flujo' AND proceso_sig='$proceso'";
		$resultado = mysqli_query($conn, $sql);
		$fila = mysqli_fetch_array($resultado);
		$proceso = $fila["proceso"];
		header("Location: motor.php?flujo=$flujo&proceso=$proceso");
	}else{
		$sql = "SELECT * FROM seguimiento WHERE flujo='$flujo' AND proceso='$proceso' AND fecha_fin IS NULL AND Id=".$_SESSION["IdUser"];
		$resultado = mysqli_query($conn, $sql);
		$fila = mysqli_fetch_array($resultado);
		if(!isset($fila)){
			$sql = "INSERT INTO seguimiento (flujo, proceso, Id, fecha_ini, fecha_fin) VALUES ('$flujo','$proceso',".$_SESSION["IdUser"].",'".date('Y-m-d')."',NULL)";
			$res = mysqli_query($conn, $sql);
		}
		/*session_unset();
		session_destroy();
		header("Location: index.php");*/
	}
?>
