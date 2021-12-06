    <div class="alert alert-success" role="alert">
		<h4 class="alert-heading">Univ. <?php echo $_SESSION['Nombre'];?></h4>
		<p>Registra al tercer ejecutivo del frente <?php echo $_SESSION['frente'];?>..</p>
		<p class="mb-0">Fecha de Ingreso: <?php echo date("Y-m-d");?></p>
		<hr>
        <center>
		<div class="card" style="width:500px;">
			<div class="card-header">
				REGISTRO DE 3ER EJECUTIVO
			</div>
			<div class="card-body">
                <form method="POST" id="form" name="form" enctype="multipart/form-data" action="">
                <div class="form-row">
                    <div class="form-group col-md-8" style="float: left;">
                        <label for="inputId" style="float: left;">Matricula:</label>
                        <input type="text" class="form-control" id="mat" name="mat" placeholder="Ingrese matricula a seleccionar...">
                    </div> 
                    <div class="form-group col-md-4" style="float: right; padding-top: 25px;">
                        <input type="submit" class="btn btn-success" id="Buscar" name="Buscar" value="Buscar" >
                    </div>  
                </form>  
                <form method="POST" id="form" name="form" enctype="multipart/form-data" action="">
<?php
if (isset($_POST['Buscar'])) {
    $mat = $_POST["mat"];
    $sql = "SELECT * FROM estudiante WHERE matricula='".$mat."'";
    $res = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_array($res);
    if(isset($fila)){
?>    
<div class="form-row">
                    <div class="form-group col-md-11">
                        <label for="inputId" style="float: left;">Id:</label>
                        <input type="text" class="form-control" id="inputId" name="id" value=<?php echo $fila["id"];?>>
                    </div>
                    <div class="form-group col-md-11">
                        <label for="inputNombres" style="float: left;">Nombre(s):</label>
                        <input type="text" class="form-control" id="inputNombres" placeholder="Ingrese su nombre" name="Nombre" value="<?php echo $fila['nombre'];?>">
                    </div>
                    <div class="form-group col-md-11">
                        <label for="inputApellidos" style="float: left;">Apellido(s)</label>
                        <input type="text" class="form-control" id="inputApellidos" placeholder="Ingrese su apellido" name="Apellido" value="<?php echo $fila['apellido'];?>">
                    </div>
                    <div class="form-group col-md-11" >
                        <label for="inputCI" style="float: left;">Cédula de Identidad:</label>
                        <input type="text" class="form-control" id="inputCI" placeholder="Ingrese su CI" name="CI" value="<?php echo $fila['ci'];?>" >
                    </div>
                </div>    
<?php
    }else{
        echo '<script language="javascript">alert("Estudiante no ubicado.");</script>';
    }
}
?>
                    <br>
                    <br>
                    <div class="form-group col-md-4" style="padding-top: 25px;">
                        <input type="submit" class="btn btn-success" id="Registrar" name="Registrar" value="Registrar">
                    </div>
                </div>
                </form>
			</div>
		</div>
    </center>
	</div>
<?php
if (isset($_POST['Registrar'])) {
    $id = $_POST["id"];
    $sql = "UPDATE frente set 3er=$id where sigla='".$_SESSION["frente"]."'";
    $res = mysqli_query($conn, $sql);
    echo '<script language="javascript">alert("Registrado como 3er Ejecutivo.");</script>';
 }   
 ?>