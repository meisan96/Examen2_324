<?php
    $flujo = $_GET["flujo_seleccionado"];
    session_start();
    include "conexion.inc.php";
    $sql = "INSERT INTO seguimiento(flujo, proceso, Id, fecha_ini, fecha_fin) VALUES('".$flujo."','P1',".$_SESSION["IdUser"].",'2021/05/30',null)";
    $resultado = mysqli_query($conn, $sql);
    header("Location: motor.php?flujo=$flujo&proceso=P1");
?>
