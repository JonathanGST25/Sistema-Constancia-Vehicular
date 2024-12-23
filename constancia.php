<?php
if(session_start()){
	session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<link href="css/app.css" rel="stylesheet">
	<script src="./fullcalendar/jquery/jquery.min.js"></script>
	<script src="./css/boostrap.min.js"></script>
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">-->
	<link rel="stylesheet" href="./css/boostrap-icons/bootstrap-icons.css">

	<title>Identificación Vehicular | FGE</title>
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<h1 class="h2">Constancia de Identificación <br> Vehicular</h1>
										<img src="./img/icons/fge-icon.png" alt="" class="img-fluid Rounded-Corners" width="200" height="200" />
									</div>
									<form action="./php/iniciar_sesion.php" method="POST">
										<div class="mb-3">
											<label class="form-label">Usuario</label>
											<div class="input-group mb-3">
												<span class="input-group-text" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
												<input type="text" class="form-control form-control-lg" id="usuario" name="usuario" placeholder="Ingresa tu nombre de usuario" aria-label="Username" aria-describedby="basic-addon1">
											</div>
										</div>
										<div class="mb-2">
											<label class="form-label">Contraseña</label>
											<div class="input-group mb-3">
												<span class="input-group-text" id="basic-addon2"><i class="bi bi-shield-fill-exclamation"></i></span>
												<input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Ingresa tu contraseña" aria-label="contraseña" aria-describedby="basic-addon2">
											</div>

											<div class="mb-3">
												<label class="form-check">
												<input class="form-check-input" type="checkbox" onclick="verpassword()">Mostrar contraseña</input>
												
											</div>

											<div class="mb-3">
												<?php
												if (isset($_GET['login']) && isset($_GET['login']) == 'false') {
													echo '<div class="alert alert-danger" role="alert">
													Usuario o Contraseña incorrectos!
													</div>';
												}
												?>
											</div>
											

											<div class="text-center mt-3">
												<button type="submit" class="btn btn-lg btn-primary">Acceder</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
	<script>
		function verpassword() {
			var tipo = document.getElementById("password");
			if (tipo.type == "password") {
				tipo.type = "text";
			} else {
				tipo.type = "password";
			}
		}
	</script>
	<script src="js/app.js"></script>
	<script src="js/load_captcha.js"></script>
</body>

</html>