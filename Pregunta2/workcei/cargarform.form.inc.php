    <div class="alert alert-success" role="alert">
		<h4 class="alert-heading">Univ. <?php echo $_SESSION['Nombre'];?></h4>
		<p>Registra el respaldo digital de los representantes del frente en un solo archivo de imagen o pdf.</p>
		<p class="mb-0">Fecha de Ingreso: <?php echo date("Y-m-d");?></p>
		<hr>
        <center>
		<div class="card" style="width:500px;">
			<div class="card-header">
				SUBIR RESPALDO DIGITAL
			</div>
			<div class="card-body">
                <form method="POST" id="form" name="form" enctype="multipart/form-data" action="">
                <div class="form-row">
                    <div class="form-group col-md-11">
                        <label for="inputId" style="float: left;">Archivo:</label>
                        <input type="file" class="form-control" id="file" name="file" >
                    </div>
                    <br>
                    <div class="form-group col-md-4">
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
    $id = $_FILES['file']['name'];
    $sql = "UPDATE frente set arch='$id' where sigla='".$_SESSION["frente"]."'";
    $res = mysqli_query($conn, $sql);
    echo '<script language="javascript">alert("Registrado.");</script>';
}
    ?>