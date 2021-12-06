<?php
	session_start();
	include "conexion.inc.php";
	$sql = "SELECT * FROM seguimiento WHERE fecha_fin IS NULL AND Id=".$_SESSION["IdUser"];
	$resultado = mysqli_query($conn, $sql);
	include "cabecera.inc.php";
?>
	<div class="alert alert-success" role="alert">
		<h4 class="alert-heading">Bienvenido <?php echo $_SESSION['Nombre'];?></h4>
		<p>Centro de seguimiento en la inscripcion de Frentes para la CEI.</p>
		<p class="mb-0">Fecha de Ingreso: <?php echo date("Y-m-d");?></p>
		<hr>
		<div class="card text-center">
			<div class="card-header">
				SEGUIMIENTO DE PROCESOS
			</div>
			<div class="card-body">
				<table class="table table-hover">
					<caption>Lista de procesos inconclusos.</caption>
					<thead class="thead-dark">
						<tr>
							<th scope="col">Flujo</th>
							<th scope="col">Proceso</th>
							<th scope="col">Acción</th>	
						</tr>
					</thead>
					<tbody>
<?php
	while ($fila = mysqli_fetch_array($resultado)){
		echo "<tr>";
		echo "<td>".$fila["flujo"]."</td>";
		echo "<td>".$fila["proceso"]."</td>";
		echo "<td><a class='btn btn-success' role='button' href='motor.php?flujo=".$fila["flujo"]."&proceso=".$fila["proceso"]."'>Continuar</a></td>";
		echo "</tr>";
	}
?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="card text-center">
			<div class="card-header">
				SEGUIMIENTO DE PROCESOS
			</div>
			<div class="card-body">
				<table class="table table-hover">
					<caption>Lista de procesos concluido.</caption>
					<thead class="thead-dark">
						<tr>
							<th scope="col">Flujo</th>
							<th scope="col">Proceso</th>
							<th scope="col">Acción</th>	
						</tr>
					</thead>
					<tbody>
<?php
	$sql1 = "SELECT * FROM seguimiento WHERE proceso='F' AND Id=".$_SESSION["IdUser"];
	$resultado1 = mysqli_query($conn, $sql1);
	while ($fila1 = mysqli_fetch_array($resultado1)){
		echo "<tr>";
		echo "<td>".$fila1["flujo"]."</td>";
		echo "<td>".$fila1["proceso"]."</td>";
		echo "<td><a class='btn btn-success' role='button' href='motor.php?flujo=".$fila1["flujo"]."&proceso=".$fila1["proceso"]."&frente=WTF'>Aceptado</a></td>";
		echo "</tr>";
	}
?>
					</tbody>
				</table>
			</div>
		</div>


	</div>
	<center>
		<form method = "GET" action="controlflujo.php">
			<input type="text" name="flujo_seleccionado" value="F1" hidden /> 
			<input type="submit" value="Nuevo Frente" name="Nuevo" class="btn btn-primary" />
			<a class="btn btn-danger" role="button" href="salir.php">Salir</a>
		</form>
	</center>
	
	
<?php
	include "pie.inc.php";
?>