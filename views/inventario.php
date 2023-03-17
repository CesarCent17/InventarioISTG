<?php
	require('../php/mysqli_conexion.php');
	require('../php/querys_inventario.php');
    session_start();
	 // Verificamos que el usuario esté iniciado sesión
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
		$usuario = $_SESSION['usuario'];
    	echo "<script> console.log(" . json_encode($usuario) . "); </script>";
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inventario | ISTG</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/sweetalert2.css">
	<link rel="stylesheet" href="../css/material.min.css">
	<link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/style.css">
	<!-- <link rel="stylesheet" href="css/style.css"> -->
	<script src="https://kit.fontawesome.com/f342bdc8ac.js" crossorigin="anonymous"></script>	

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="../js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="../js/material.min.js" ></script>
	<script src="../js/sweetalert2.min.js" ></script>
	<script src="../js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="../js/main.js" ></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>

<!-- navBar -->
	<div class="full-width navBar">
		<div class="full-width navBar-options">
			<div class="mdl-tooltip" for="btn-menu">Menu</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
					
					<li class="text-condensedLight noLink" ><small>ISTG</small></li>
					<li class="noLink">
						<figure>
							<img src="../assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
						</figure>
					</li>

					<li class="noLink">
					<form action="../php/logout.php" method="post">
						<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Cerrar sesión</button>
					</form>
					</li>

				</ul>
			</nav>
		</div>
	</div>
	<!-- navLateral -->
	<section class="full-width navLateral">
		<div class="full-width navLateral-bg btn-menu"></div>
		<div class="full-width navLateral-body">
			<div class="full-width navLateral-body-logo text-center tittles">
				<i class="zmdi zmdi-close btn-menu"></i> Inventario 
			</div>
			<figure class="full-width" style="height: 77px;">
				<figcaption class="navLateral-body-cr hide-on-tablet">
					<span style="margin-left: 60px;">
						<b>Instituto Superior Tecnológico Guayaquil</b><br>
						<?php
							$nombrecompleto = $_SESSION['usuario']['nombre']." ".$_SESSION['usuario']['apellido'];
							$rol = $_SESSION['rol'];
							echo "<small>".$nombrecompleto."</small><br>";
							echo '<small>'. $rol . '</small>';

						?>
					</span>
				</figcaption>
			</figure>
			<div class="full-width tittles navLateral-body-tittle-menu">
				<i class="zmdi zmdi-desktop-mac"></i><span class="hide-on-tablet">&nbsp; INVENTARIO</span>
			</div>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">

					<!-- INICIO -->
					<li class="full-width">
						<a href="../home.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-home"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INICIO
							</div>
						</a>
					</li>

					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="bien.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-plus"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								AGREGAR BIEN
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="inventario.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-folder"></i>
							</div>
							
							<div class="navLateral-body-cr hide-on-tablet">
								INVENTARIO
							</div>
						</a>
					</li>
					<?php
						$rol = $_SESSION['rol'];
						if($rol == 'Administrador'){
							$html = '<li class="full-width divider-menu-h"></li>
         								<li class="full-width">
											<a href="usuarios.php" class="full-width">
												<div class="navLateral-body-cl">
												<i class="zmdi zmdi-account"></i>
												</div>
												<div class="navLateral-body-cr hide-on-tablet">
												USUARIOS
												</div>
											</a>
									</li>';
							echo $html;
						}	
					?>
				</ul>
			</nav>
		</div>
	</section>

	<!-- pageContent -->
	<div class="mdl-cell mdl-cell--12-col mdl-card">
		<div class="mdl-card__supporting-text" style="padding-left:440px; width: 100%">
			<div class="mdl-card__title">
				<h2 class="mdl-card__title-text">Bienes Registrados</h2>
			</div>
			<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" >
			<thead>
				<tr>
				<th class="mdl-data-table__cell--non-numeric">#</th>
				<th class="mdl-data-table__cell--non-numeric">Nombre General</th>
				<th class="mdl-data-table__cell--non-numeric">Descripción</th>
				<th class="mdl-data-table__cell--non-numeric">Campus</th>
				<th class="mdl-data-table__cell--non-numeric">Área de Ubicación</th>
				<th class="mdl-data-table__cell--non-numeric">Código ISTG</th>
				<th class="mdl-data-table__cell--non-numeric">Código Adicional</th>
				<th class="mdl-data-table__cell--non-numeric">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$array_bienes_registrados = obtener_bienes_registrados($conexion);
					$html = '';
					// echo "<script> console.log(". json_encode($array_bienes_registrados) ."); </script>";
					$array_campus = obtener_array_campus($conexion, $array_bienes_registrados);
					$array_ubicacion = obtener_array_ubicacion($conexion, $array_bienes_registrados);
					$array_resultado = obtener_codigos_prod($conexion, $array_bienes_registrados);
					$form_ver_detalles = '<form action="#" method="post" class="ver-detalles-eliminar">
												<button type="submit" class="form-button-icon fas fa-eye" value="6" name="hola"></button>
											</form>';
					$form_eliminar = '<form action="#" method="post" class="ver-detalles-eliminar">
												<button type="submit" class="form-button-icon fa-solid fa-trash" value="6" name="hola"></button>
											</form>';
						
					for($i = 0; $i < count($array_bienes_registrados); $i++){
						$codigo_adicional =  isset($array_resultado[$i][1]['codigo']) ? $array_resultado[$i][1]['codigo'] : '';
						$No = $i+1;
						$html .= '<tr>
									<td class="mdl-data-table__cell--non-numeric">'.$No.'</td>
									<td class="mdl-data-table__cell--non-numeric">'.$array_bienes_registrados[$i]['nombre'].'</td>
									<td class="mdl-data-table__cell--non-numeric">'.$array_bienes_registrados[$i]['descripcion'].'</td>
									<td class="mdl-data-table__cell--non-numeric">'.$array_campus[$i].'</td>
									<td class="mdl-data-table__cell--non-numeric">'.$array_ubicacion[$i].'</td>
									<td class="mdl-data-table__cell--non-numeric">'.$array_resultado[$i][0]['codigo'].'</td>
									<td class="mdl-data-table__cell--non-numeric">'.$codigo_adicional.'</td>
									<td class="mdl-data-table__cell--non-numeric">'.$form_ver_detalles.$form_eliminar.'</td>
								</tr> ';
					}
					echo $html;		
										
				?>
			</tbody>
			</table>
		</div>
	</div>
</body>
</html>