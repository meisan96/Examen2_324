    <div class="alert alert-success" role="alert">
		<h4 class="alert-heading">Univ. <?php echo $_SESSION['Nombre'];?></h4>
		<p>Los Datos de su frente <?php echo $_SESSION['frente'];?> .</p>
		<p class="mb-0">Fecha de Ingreso: <?php echo date("Y-m-d");?></p>
		<hr>
        <center>
		<div class="card" style="width:500px;">
			<div class="card-header">
				FRENTE <?php echo $_SESSION["frente"]." - ".$nom;?>
			</div>
			<div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-11">
                        <label for="inputId" style="float: left;">1er Ejecutivo:<?php echo $nombre1." ".$apellidos1." ".$matricula1; ?></label>
                        <label for="inputId" style="float: left;">2do Ejecutivo:<?php echo $nombre2." ".$apellidos2." ".$matricula2; ?></label>
                        <label for="inputId" style="float: left;">3er Ejecutivo:<?php echo $nombre3." ".$apellidos3." ".$matricula3; ?></label>
                        <label for="inputId" style="float: left;">Archivo: <?php echo $arc; ?></label>
                        
                    </div>
                    <
                </div>
			</div>
		</div>
    </center>
	</div>