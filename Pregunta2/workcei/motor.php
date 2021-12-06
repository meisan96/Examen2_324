<?php
    session_start();
    include "cabecera.inc.php";
    include "conexion.inc.php";
    $flujo = $_GET["flujo"];
    $proceso = $_GET["proceso"];
    $sql = "SELECT * FROM flujo_proceso WHERE flujo='$flujo' AND proceso='$proceso'";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_array($resultado);
    $formulario = $fila["formulario"];
    if($proceso != "F"){
        include $formulario.".cabecera.form.inc.php";
        include $formulario.".form.inc.php";
    }else{
        include "fin.php";
    }
    ?>
<form method="GET" action="controlador.php" enctype="multipart/form-data">
    <br/>
    <input type="hidden" value="<?php echo $flujo; ?>" name="flujo"/>
    <input type="hidden" value="<?php echo $proceso; ?>" name="proceso"/>
    <input type="hidden" value="<?php echo $formulario; ?>" name="formulario"/>
    <center>
        <?php
            if($proceso != 'P1'){
                echo "<input type='submit' value='Anterior' name='Anterior' class='btn btn-success'/>";
            }
            if($proceso != 'F'){
                echo '<input type="submit" value="Siguiente" name="Siguiente" class="btn btn-success"/>';
            }else{
                echo "<a class='btn btn-success' role='button' href='bandeja.php' >Volver a Bandeja</a>";
            }
        ?>
        
        <a class='btn btn-danger' role='button' href='salir.php'>Salir</a>
        
    </center>
</form>
<?php
    include "pie.inc.php";
?>