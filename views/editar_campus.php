<?php
	require('../php/mysqli_conexion.php');
	require('../php/utils_query.php');
	require('../php/querys_campus.php');
    session_start();

	 // Verificamos que el usuario esté iniciado sesión
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: login.php");
    } else {
         // Si el metodo es diferente a post lo redirigimos al index
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header("Location: ../index.php");
        } else {
            //Si el usuario tiene una sesion
            $usuario = $_SESSION['usuario'];
            $rol = $_SESSION['rol'];
            if($rol == "Administrador"){
							$id_campus = $_POST['id_campus'];
							$campus = get_campus_id($conexion, $id_campus);
                            echo "<script> console.log(" . json_encode($usuario) . "); </script>";		
                        } 
            else {
                header("Location: ../index.php");
            }
		

		}
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Campus | ISTG</title>
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
						<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="background-color: #F44336">Cerrar sesión</button>
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
				<i class="zmdi zmdi-desktop-mac"></i><span class="hide-on-tablet">&nbsp; EDITAR CAMPUS</span>
			</div>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">

					<!-- INICIO -->
					<?php
						require('nav_lateral_opciones.php');
						$rol = $_SESSION['rol'];
						if($rol == 'Administrador'){
							$html = '
									<li class="full-width divider-menu-h"></li>
										<li class="full-width">
										<a href="bienes_descartados.php" class="full-width">
										<div class="navLateral-body-cl">
										<i class="zmdi zmdi-tag-close"></i>
										</div>
										<div class="navLateral-body-cr hide-on-tablet">
										BIENES DESCARTADOS
										</div>
										</a>
									</li>

									<li class="full-width divider-menu-h"></li>
         								<li class="full-width">
											<a href="usuarios.php" class="full-width">
												<div class="navLateral-body-cl">
												<i class="zmdi zmdi-account"></i>
												</div>
												<div class="navLateral-body-cr hide-on-tablet">
												USUARIOS
												</div>
											</a>
										</li>
										
										<li class="full-width divider-menu-h"></li>
         								<li class="full-width">
											<a href="campus.php" class="full-width">
												<div class="navLateral-body-cl">
												<i class="zmdi zmdi-balance"></i>
												</div>
												<div class="navLateral-body-cr hide-on-tablet">
												CAMPUS
												</div>
											</a>
										</li>
										
										<li class="full-width divider-menu-h"></li>
         								<li class="full-width">
											<a href="area_de_ubicacion.php" class="full-width">
												<div class="navLateral-body-cl">
												<i class="zmdi zmdi-pin"></i>
												</div>
												<div class="navLateral-body-cr hide-on-tablet">
												ÁREA DE UBICACIÓN
												</div>
											</a>
										</li>
										
										<li class="full-width divider-menu-h"></li>
         								<li class="full-width">
											<a href="campus.php" class="full-width">
												<div class="navLateral-body-cl">
												<i class="zmdi zmdi-account"></i>
												</div>
												<div class="navLateral-body-cr hide-on-tablet">
												DOCENTES
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
	<form class="mdl-grid" action="../php/actualizar_campus.php" method="post" style="max-width: 550px; margin-left:600; margin-top: 55px">

		<div class="mdl-card__title" >
				<h2 class="mdl-card__title-text">Editar Campus</h2>
		</div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-disabled">
				<?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $html = ' <input class="mdl-textfield__input" type="text" id="id_campus" name="id_campus" required value="'.$campus['id'].' "readonly>';
		 			echo $html;
                }	
				?>
              <label class="mdl-textfield__label" for="id_campus">ID</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
        </div>
       

		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $html = '<input class="mdl-textfield__input" type="text" id="nombre" name="nombre" value="'.$campus['nombre'].'"required>';
                    echo $html;
                }   
            ?>
			<label class="mdl-textfield__label" for="nombre">Nombre</label>
			<span class="mdl-textfield__error">Este campo es requerido</span>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $html = '<input class="mdl-textfield__input" type="text" id="direccion" name="direccion" value="'.$campus['direccion'].' "required>';
                    echo $html;
                }   
            ?>
			<label class="mdl-textfield__label" for="direccion">Dirección</label>
			<span class="mdl-textfield__error">Este campo es requerido</span>
		</div>
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" style="margin-top: 20px;">
			Actualizar
		</button>
	</form>
</body>
</html>