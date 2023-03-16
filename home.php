<?php
	require('php/mysqli_conexion.php');
	require('php/utils_query.php');
    session_start();

	 // Verificamos que el usuario esté iniciado sesión
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: views/login.php");
    } else {
		//Si el usuario tiene una sesion
		$usuario = $_SESSION['usuario'];
		$rol = $_SESSION['rol'];
		if($rol == "Administrador"){
                        $array_usuarios = consultarListaUsuarios($conexion);
                        $_SESSION['listaUsuarios'] = $array_usuarios;
						$listaUsuarios = $_SESSION['listaUsuarios'];
						echo "<script> console.log(" . json_encode($usuario) . "); </script>";
						echo "<script> console.log(" . json_encode($listaUsuarios) . "); </script>";
                    } 
		 else {
			$msg = "No tiene acceso a la lista de usuarios!";
    		echo "<script> console.log(" . json_encode($usuario) . "); </script>";
			echo "<script> console.log('" . $msg . "'); </script>";
		}
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inicio | ISTG</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- <link rel="icon" type="image/x-icon" href="/assets/icons/logoISTG.ico"> -->
	

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="js/material.min.js" ></script>
	<script src="js/sweetalert2.min.js" ></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="js/main.js" ></script>
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
							<img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
						</figure>
					</li>

					<li class="noLink">
					<form action="php/logout.php" method="post">
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
				<!-- <div class="navLateral-body-cl">
					<img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
				</div> -->
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
				<i class="zmdi zmdi-desktop-mac"></i><span class="hide-on-tablet">&nbsp; PAGINA PRINCIPAL</span>
			</div>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">

					<!-- INICIO -->
					<li class="full-width">
						<a href="home.php" class="full-width">
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
						<a href="views/bien.php" class="full-width">
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
						<a href="views/inventario.php" class="full-width">
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
											<a href="views/usuarios.php" class="full-width">
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
	<section class="full-width pageContent">
		<section class="full-width text-center" style="padding: 40px 0;">
			<h3 class="text-center tittles">¡Hola! Bienvenido/a al sistema de inventario</h3>
			<!-- Tiles -->
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						5<br>
						<small>Bienes Registrados</small>
					</span>
				</div>
				<i class="zmdi zmdi-storage tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						5<br>
						<small>Usuarios Activos</small>
					</span>
				</div>
				<i class="zmdi zmdi-accounts tile-icon"></i>
			</article>
			
		</section>

		<section class="full-width" style="padding: 0px 265px;">
			<div class="mdl-grid">
			  <div class="mdl-cell mdl-cell--12-col">
				<h4 class="tittles">Actividad Reciente</h4>					  
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
				  <thead>
					<tr>
					  <th class="mdl-data-table__cell--non-numeric" style="width: 30%;">Fecha</th>
					  <th class="mdl-data-table__cell--non-numeric" style="width: 45%;">Nombre General</th>
					  <th class="mdl-data-table__cell--non-numeric" style="width: 45%;">Usuario</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td class="mdl-data-table__cell--non-numeric" style="width: 30%;">2023-03-15</td>
					  <td class="mdl-data-table__cell--non-numeric" style="width: 45%;">Producto Agdgsg</td>
					  <td class="mdl-data-table__cell--non-numeric" style="width: 45%;">Usuario 1gdsgsgs</td>
					</tr>

					<tr>
						<td class="mdl-data-table__cell--non-numeric" style="width: 30%;">2023-03-15</td>
						<td class="mdl-data-table__cell--non-numeric" style="width: 45%;">Producto Agdgsg</td>
						<td class="mdl-data-table__cell--non-numeric" style="width: 45%;">Usuario 1gdsgsgs</td>
					  </tr>

					  <tr>
						<td class="mdl-data-table__cell--non-numeric" style="width: 30%;">2023-03-15</td>
						<td class="mdl-data-table__cell--non-numeric" style="width: 45%;">Producto Agdgsg</td>
						<td class="mdl-data-table__cell--non-numeric" style="width: 45%;">Usuario 1gdsgsgs</td>
					  </tr>

					  <tr>
						<td class="mdl-data-table__cell--non-numeric" style="width: 30%;">2023-03-15</td>
						<td class="mdl-data-table__cell--non-numeric" style="width: 45%;">Producto Agdgsg</td>
						<td class="mdl-data-table__cell--non-numeric" style="width: 45%;">Usuario 1gdsgsgs</td>
					  </tr>

					  <tr>
						<td class="mdl-data-table__cell--non-numeric" style="width: 30%;">2023-03-15</td>
						<td class="mdl-data-table__cell--non-numeric" style="width: 45%;">Producto Agdgsg</td>
						<td class="mdl-data-table__cell--non-numeric" style="width: 45%;">Usuario 1gdsgsgs</td>
					  </tr>
				  </tbody>
				</table>
			  </div>
			</div>
		  </section>
	</section>
	
</body>
</html>