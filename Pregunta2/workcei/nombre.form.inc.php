    <div class="alert alert-success" role="alert">
		<h4 class="alert-heading">Univ. <?php echo $_SESSION['Nombre'];?></h4>
		<p>Registra el Nombre del Frente y una sigla.</p>
		<p class="mb-0">Fecha de Ingreso: <?php echo date("Y-m-d");?></p>
		<hr>
        <center>
		<div class="card" style="width:500px;">
			<div class="card-header">
				REGISTRO DE FRENTE
			</div>
			<div class="card-body">
                <form method="POST" id="form" name="form" enctype="multipart/form-data" action="">
                <div class="form-row">
                    <div class="form-group col-md-11">
                        <label for="inputId" style="float: left;">Sigla del frente:</label>
                        <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Ingrese la sigla del frente">
                    </div>
                    <br>
                    <div class="form-group col-md-11">
                        <label for="inputNombres" style="float: left;">Nombre del frente:</label>
                        <input type="text" class="form-control" id="inputNombres" placeholder="Ingrese el nombre del frente" name="nombre" >
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
    $sigla = $_POST["sigla"];
    $nombre = $_POST["nombre"];
    $_SESSION["frente"] = $sigla;
    $sql = "SELECT * FROM frente WHERE nombre='".$nombre."' or sigla='".$sigla."'";
    $res = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_array($res);
    if(isset($fila)){
        echo '<script language="javascript">alert("Nombre o sigla ya usado.");</script>';
    }else{
        $sql = "INSERT INTO frente(nombre, sigla) VALUES ('".$nombre."', '".$sigla."')";
        $resCab = mysqli_query($conn, $sql);
        echo '<script language="javascript">alert("Nombre y Sigla de Frente registrado. Continue con los siguiente pasos.");</script>';
    }
}
    ?>