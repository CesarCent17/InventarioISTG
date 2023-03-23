<?php
	require('../php/mysqli_conexion.php');
	require('../php/utils_query.php');
    session_start();

	 // Verificamos que el usuario esté iniciado sesión
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: login.php");
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
			header("Location: ../index.php");
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
	<title>Inventario | ISTG</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/sweetalert2.css">
	<link rel="stylesheet" href="../css/material.min.css">
	<link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/style.css">

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
		<div class="full-width navBar-options" style="background-color: #21468e">
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
			<div class="full-width navLateral-body-logo text-center tittles" style="background-color: #21468e">
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
				<i class="zmdi zmdi-desktop-mac"></i><span class="hide-on-tablet">&nbsp; USUARIOS</span>
			</div>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">

					<!-- INICIO -->
					<li class="full-width">
						<a href="../index.php" class="full-width">
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
	<section class="full-width pageContent">
		<section class="full-width text-center" style="padding: 40px 0;">
			<h3 class="text-center tittles">Lista de usuarios</h3>
			<?php
						// require('../php/mysqli_conexion.php');
						
						function consultarRol($usuario, $conexion){
									$sql = "SELECT
										r.`descripcion`
									FROM
										`usuario` AS u
									INNER JOIN `usuario_rol` AS ur
									ON u.`id_usuario_rol` = ur.`id`
									INNER JOIN `rol` AS r
									ON ur.`id_rol` = r.`id`
						
									WHERE
									u.`id` = ?;";

									$id_usuario = $usuario['id'];
									$stmt = $conexion->prepare($sql);
									if (!$stmt) {
										die("Error de consulta: " . $conexion->error);
									}
									$stmt->bind_param("s", $id_usuario);
									$stmt->execute();
									$resultado = $stmt->get_result();

									if($resultado->num_rows == 1){
											$array_rol = $resultado->fetch_assoc();
											$rol = $array_rol['descripcion'];
										}
									return $rol;
								}
								
								$listaUsuarios = $_SESSION['listaUsuarios'];
								$arrayUsuarioRol = array();

								for($i = 0; $i < count($listaUsuarios); $i++) {
									$usuario = $listaUsuarios[$i];
									$rol = consultarRol($usuario, $conexion);
									$arrayUsuario = array("usuario" => $usuario, "rol" => $rol);
									array_push($arrayUsuarioRol, $arrayUsuario);
								}
								echo "<script> console.log(" . json_encode($arrayUsuarioRol) . "); </script>";

								$cantidadUsuarioRol = array();
								$administradores = 0;
								$usuariosgenerales = 0;
								for($i = 0; $i < count($arrayUsuarioRol); $i++){
									if($arrayUsuarioRol[$i]["rol"] == "Administrador"){
										$administradores++;
									} 
									if($arrayUsuarioRol[$i]["rol"] == "Usuario General"){
										$usuariosgenerales++;
									}
								}

								echo "<script> console.log('Hay ". $administradores ." Administrador(es)'); </script>";
								echo "<script> console.log('Hay ". $usuariosgenerales ." Usuario(s) General(es)'); </script>";


								$html = '<article class="full-width tile">
											<div class="tile-text">
												<span class="text-condensedLight">'
													
												.$administradores.'<br>
												<small>Administrador(es)</small>
												</span>
											</div>

											<i class="zmdi zmdi-account tile-icon"></i>
										</article>

										<article class="full-width tile">
											<div class="tile-text">
												<span class="text-condensedLight">'
													.$usuariosgenerales.'<br>
													<small>Usuario(s) General(es)</small>
												</span>
											</div>
											<i class="zmdi zmdi-account tile-icon"></i>
										</article>';
								echo $html;
						?>
			        <!-- Table -->
					<div class="mdl-grid">
    					<div class="mdl-cell mdl-cell--12-col">
							<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
								<thead>
									<tr>
										<th class="mdl-data-table__cell--non-numeric">Nombre de usuario</th>
										<th>Rol</th>
										<th>Estado</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$html = '';

										echo "<script> console.log('Hay ". count($listaUsuarios) ." Usuarios'); </script>";
										echo "<script> console.log('Hay ". json_encode($listaUsuarios) ." Usuarios'); </script>";

										//necesito la lista usuario rol
										$arrayUsuarioRol = array();

										for($i = 0; $i < count($listaUsuarios); $i++) {
											$usuario = $listaUsuarios[$i];
											$rol = consultarRol($usuario, $conexion);
											$arrayUsuario = array("usuario" => $usuario, "rol" => $rol);
											array_push($arrayUsuarioRol, $arrayUsuario);
										}
										echo "<script> console.log(" . json_encode($arrayUsuarioRol) . "); </script>";


										
										for($i = 0; $i < count($arrayUsuarioRol); $i++){
											$nombresCompletos = $arrayUsuarioRol[$i]['usuario']['nombre'].' '.$arrayUsuarioRol[$i]['usuario']['apellido'];
											$activo = $arrayUsuarioRol[$i]['usuario']['activo'];
											$estado = '';
											$boton = '';
											if($activo==0){
												$estado = 'Inactivo';
												$boton = '<button class="mdl-button mdl-js-button mdl-button--colored mdl-color--green mdl-color-text--white" type="submit" name="submit">Habilitar</button>';
												$form = '<form method="post" action="../php/actualizarEstadoUsuario.php">
											 			<input type="hidden" name="id_usuario" value="' . $arrayUsuarioRol[$i]['usuario']['id'] . '">
											 			<input type="hidden" name="nuevo_estado" value="1">
											 			' . $boton . '
														</form>';

											} elseif($activo==1){
												$estado = 'Activo';
												$boton = '<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--white mdl-color--red type="submit" name="submit">Deshabilitar</button>';
												$form = '<form method="post" action="../php/actualizarEstadoUsuario.php">
											 			<input type="hidden" name="id_usuario" value="' . $arrayUsuarioRol[$i]['usuario']['id'] . '">
											 			<input type="hidden" name="nuevo_estado" value="0">
											 			' . $boton . '
														</form>';
											}

											$html.='<tr>
											<td class="mdl-data-table__cell--non-numeric">'.$nombresCompletos.'</td>
											<td>'.$arrayUsuarioRol[$i]['rol'].'</td>
											<td>'.$estado.'</td>
											<td>'
												.$form.
												'</td>
											</tr>';
										}
										echo $html;
									?>
								</tbody>
							</table>
						</div>
					</div>
</section>
	
</body>
</html>