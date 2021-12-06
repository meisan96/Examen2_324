<?php 
$_SESSION["frente"]=$_GET["frente"];
?>
<div class="alert alert-success" role="alert">
		
		<p class="mb-0">Fecha de Ingreso: <?php echo date("Y-m-d");?></p>
		<hr>
        <center>
		<div class="card" style="width:500px;">
			<div class="card-header">
				<h4 class="alert-heading">Estimado <?php echo $_SESSION['Nombre'];?></h4>
			<p>El frente <?php echo $_SESSION['frente'];?> ha sido registrado con exito para la convocatoria de CEI </p>
			</div>
		</div>
    </center>
	</div>