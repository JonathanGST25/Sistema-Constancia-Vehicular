<?php

include("./php/conexion.php");

$conexion->set_charset("utf8");
$sql = "SELECT * FROM Delegaciones ORDER BY delegacionNombre ASC";
$result = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="http://noantecedentespenales.guerrero.gob.mx:8075/citas/images/logo_fiscalia.ico">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="./style.css" rel="stylesheet">
	<title>Servicio de citas para la Constancia de Identificación Vehicular - Site</title>
</head>

<body>

	<div class="container-fluid">
		<div class="card-header">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
					<img src="./img/logo_fiscalia.png" style="width: 100px; display: inline-block" />
					<br />
					<div style="display: inline-block">
						<h2 style="color: #014799; font-weight: 1000">
							FISCALÍA GENERAL
						</h2>
						<h4 style="color: #014799; font-weight: bold">
							DEL ESTADO DE GUERRERO
						</h4>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div id="content">
				<div class="container">
					<br />
					<h3 class="text-center">
						Seleccione su delegación correspondiente para realizar su cita
						para trámite de CONSTANCIA DE IDENTIFICACIÓN VEHICULAR
					</h3>
					<br />
					<div class="row">
						<?php
						if ($result) {
							while ($consulta = mysqli_fetch_array($result)) {
						?>
								<!-- ACAPULCO -->
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-center">
									<img src="./img/logo_fiscalia.png" style="width: 90px" />
									<br />
									<a href="./citas.php?idDelegacion=<?php echo $consulta['delegacionId'] ?>" class="h4 card-title text-primary text-center">
										<?php echo $consulta['delegacionNombre'] ?>
									</a>
									<br />
									<br />
									<br />
									<br />
								</div>
						<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<div class="card-footer text-muted text-center">
			Copyright © 2023 <br />
			Todos los derechos reservados
		</div>
	</div>

</body>

</html>