<?php

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
	<title>Activos | ISTG</title>
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
						<a href="activos.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-plus"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								AGREGAR ACTIVO
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

	<section class="full-width pageContent">
	<div style="text-align: center; margin-top: 20px" >
		<h5 class="mdl-color-text--primary">Ingresar Nuevo Activo</h5>
  	</div>

						<!-- parte 1 -->
						<form class="mdl-grid" action="#" method="post" style="max-width: 800px; margin: 0 auto;">
  <div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="nombre" name="nombre">
      <label class="mdl-textfield__label" for="nombre">Nombre General</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="descripcion" name="descripcion">
      <label class="mdl-textfield__label" for="descripcion">Descripción</label>
    </div>
  </div>
  <!-- <div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="observaciones" name="observaciones">
      <label class="mdl-textfield__label" for="observaciones">Observaciones</label>
    </div>
  </div> -->
  <!-- <div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="acta_de_donacion" name="acta_de_donacion">
      <label class="mdl-textfield__label" for="acta_de_donacion">Acta de donación</label>
    </div>
  </div> -->
  <div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="number" id="numero_de_acta" name="numero_de_acta">
      <label class="mdl-textfield__label" for="numero_de_acta"># Acta</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="number" id="anio" name="anio">
      <label class="mdl-textfield__label" for="anio">Año</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <select class="mdl-textfield__input" id="campus" name="campus">
        <option value=""></option>
        <option value="Campus 1">Campus 1</option>
        <option value="Campus 2">Campus 2</option>
        <option value="Campus 3">Campus 3</option>
      </select>
      <label class="mdl-textfield__label" for="campus">Campus</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <select class="mdl-textfield__input" id="area_de_ubicacion" name="area_de_ubicacion">
        <option value=""></option>
		<!-- parte 2 -->
		<option value="Área 1">Área 1</option>
		<option value="Área 2">Área 2</option>
		<option value="Área 3">Área 3</option>
	</select>
  <label class="mdl-textfield__label" for="area_de_ubicacion">Área de ubicación</label>
</div>
</div>
  <div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="codigoISTG" name="codigoISTG">
      <label class="mdl-textfield__label" for="codigo">Código ISTG</label>
    </div>
	<!-- <div style="margin-top: 10px;">
    <p>¿Deseas agregar otro código?</p>
    <a href="#" class="mdl-color-text--primary">Agregar Código Adicional</a>
  	</div> -->
	  <div style="margin-top: 10px;">
		<p style="display: inline-block; margin-right: 10px; font-size:14px">¿Deseas agregar otro código?</p>
		<a href="#" class="mdl-color-text--primary" style="display: inline-block; margin-left: 10px; font-size:14px">Agregar Código Adicional</a>
	</div>

  </div>
  
  

  <div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <select class="mdl-textfield__input" id="origen_del_bien" name="origen_del_bien">
        <option value=""></option>
        <option value="Compra">Compra</option>
        <option value="Donación">Donación</option>
        <option value="Traspaso">Traspaso</option>
      </select>
      <label class="mdl-textfield__label" for="origen_del_bien">Origen del bien</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <select class="mdl-textfield__input" id="custodio" name="custodio">
        <option value=""></option>
        <option value="Custodio 1">Custodio 1</option>
        <option value="Custodio 2">Custodio 2</option>
        <option value="Custodio 3">Custodio 3</option>
      </select>
      <label class="mdl-textfield__label" for="custodio">Custodio</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <select class="mdl-textfield__input" id="proceso_de_adquisicion" name="proceso_de_adquisicion">
        <option value=""></option>
        <option value="Proceso 1">Proceso 1</option>
        <option value="Proceso 2">Proceso 2</option>
        <option value="Proceso 3">Proceso 3</option>
      </select>
      <label class="mdl-textfield__label" for="proceso_de_adquisicion">Proceso de adquisición</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <select class="mdl-textfield__input" id="estado_de_uso" name="estado_de_uso">
        <option value=""></option>
        <option value="Usado">Usado</option>
        <option value="Nuevo">Nuevo</option>
      </select>
      <label class="mdl-textfield__label" for="estado_de_uso">Estado de uso</label>
    </div>
  </div>

  <div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <select class="mdl-textfield__input" id="estado_fisico" name="estado_fisico">
        <option value=""></option>
        <option value="Bueno">Bueno</option>
        <option value="Regular">Regular</option>
        <option value="Malo">Malo</option>
      </select>
      <label class="mdl-textfield__label" for="estado_fisico">Estado físico</label>
    </div>
  </div>

  <!-- <div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <select class="mdl-textfield__input" id="estado_fisico" name="estado_fisico">
        <option value=""></option>
        <option value="Bueno">Bueno</option>
        <option value="Regular">Regular</option>
        <option value="Malo">Malo</option>
      </select>
      <label class="mdl-textfield__label" for="estado_fisico">Estado físico</label>
    </div>
  </div> -->

  <div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <textarea class="mdl-textfield__input" type="text" rows= "3" id="observaciones" name="observaciones"></textarea>
      <label class="mdl-textfield__label" for="observaciones">Observaciones</label>
    </div>
  </div>
  <!-- <div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="file" id="acta_de_donacion" name="acta_de_donacion">
      <label class="mdl-textfield__label" for="acta_de_donacion">Acta de donación</label>
    </div>
  </div> -->

  <div class="mdl-cell mdl-cell--6-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <select class="mdl-textfield__input" id="acta_de_donacion" name="acta_de_donacion">
        <option value=""></option>
        <option value="Si">Si</option>
        <option value="No">No</option>
      </select>
      <label class="mdl-textfield__label" for="estado_fisico">Acta de donación</label>
    </div>
  </div>

  <!-- <div class="mdl-cell mdl-cell--12-col">
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
      Enviar formulario
    </button>
  </div> -->
  <div class="mdl-cell mdl-cell--12-col">
  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary" type="submit">
    Guardar 
  </button>
</div>

</form>
	</section>

	
</body>
</html>