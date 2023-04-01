<?php
	require('../php/mysqli_conexion.php');
	require('../php/querys_inventario.php');
	require('../php/utils_query.php');
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
	<title>Actas | ISTG</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/sweetalert2.css">
	<link rel="stylesheet" href="../css/material.min.css">
	<link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/style_select2.css">

  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/select2.min.css">
  <script src="../js/select2.min.js"></script>
	<script src="../js/material.min.js" ></script>
	<script src="../js/sweetalert2.min.js" ></script>
	<script src="../js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="../js/main.js" ></script>
	<script src="../js/mostrarInputNuevoCodigo.js" ></script>
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
				<i class="zmdi zmdi-desktop-mac"></i><span class="hide-on-tablet">&nbsp; ACTAS</span>
			</div>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">

					<!-- INICIO -->
					<?php
						require('nav_lateral_opciones.php');
						$rol = $_SESSION['rol'];
						if($rol == 'Administrador'){
							require('nav_lateral_admin.php');
						}	
					?>
				</ul>
			</nav>
		</div>
	</section>

	<!-- pageContent -->

	<!-- Formulario Acta de Entrega a Recepción -->
	<form class="mdl-grid" action="../php/proceso_acta_recepcion.php" method="post" style="max-width: 550px; margin-left:850; margin-top: 55px;">

		<div class="mdl-card__title" >
				<h2 class="mdl-card__title-text">Acta de Entrega a Recepción</h2>
		</div>
		
		<!-- <div class="mdl-cell mdl-cell--6-col"> -->
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <select class="mdl-textfield__input js-bien" id="BuscadorBien" name="bien" required>
                    <option value=""></option>
                    <?php
					$array_bienes_registrados = obtener_bienes_registrados($conexion);
					$array_resultado = obtener_codigos_prod($conexion, $array_bienes_registrados);

                    $html = '';
                    for($i = 0; $i < count($array_bienes_registrados); $i++){
						$bien1 = 'ID: '.$array_bienes_registrados[$i]['id'].' | '.$array_bienes_registrados[$i]['nombre'].' | '.$array_resultado[$i][0]['codigo'];
						$bien = $array_bienes_registrados[$i]['nombre'].' | ID: '.$array_bienes_registrados[$i]['id'];

                        $html.= '<option value="'.$array_bienes_registrados[$i]['id'].'">'.$bien1.'</option>' ;
                    }
                    echo $html;
                    ?>
                </select>
                <label class="mdl-textfield__label" for="bien">Bien Registrado</label>
            </div>

			
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="n_acta" name="n_acta" required>
              <label class="mdl-textfield__label" for="n_acta"># Acta</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
            </div>
         
        <!-- </div> -->


            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <select class="mdl-textfield__input" id="administrador" name="administrador" required>
                <option value=""></option>
                <?php
                $array_administrador = getAdministrador($conexion);
                echo "<script> console.log(" . json_encode($array_administrador) . "); </script>";

                $html = '';
                for($i = 0; $i < count($array_administrador); $i++){
                    $html.= '<option value="'.$array_administrador[$i]['id'].'">'.$array_administrador[$i]['nombres_completos'].'</option>' ;
                }
                echo $html;
                ?>
              </select>
              <label class="mdl-textfield__label" for="administrador">Custodio Administrativo</label>
			  <span class="mdl-textfield__error">Este campo es requerido</span>
            </div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <select class="mdl-textfield__input js-example-basic-single" id="BuscadorCustodio" name="receptor" required>
                    <option value=""></option>
					<?php
                    $array_custodio = getCustodio($conexion);
                    echo "<script> console.log(" . json_encode($array_custodio) . "); </script>";

                    $html = '';
                    for($i = 0; $i < count($array_custodio); $i++){
                        $html.= '<option value="'.$array_custodio[$i]['id'].'">'.$array_custodio[$i]['nombres_completos'].'</option>' ;
                    }
                    echo $html;
                    ?>
                </select>
                <label class="mdl-textfield__label" for="receptor">Receptor</label>
            </div>
		
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="cargo_receptor" name="cargo_receptor" required>
              <label class="mdl-textfield__label" for="cargo_receptor">Cargo del Receptor</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
            </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-disabled">
		<select class="mdl-textfield__input" id="campus" name="campus" required>
                <option value=""></option>
				
                <?php
                $array_campus = getCampus($conexion);
                $html = '';
                for($i = 0; $i < count($array_campus); $i++){
                    $html.= '<option value="'.$array_campus[$i]['direccion'].'">'.$array_campus[$i]['nombre'].'</option>' ;
                }
                echo $html;
				
                ?>
              </select>
              <label class="mdl-textfield__label" for="campus">Campus</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
        </div>
       
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" style="margin-top: 20px;">
			Generar
		</button>
	</form>


	<!-- Formulario Acta de Donación -->
	<form class="mdl-grid" action="../php/proceso_acta_donacion.php" method="post" style="max-width: 550px; margin-left:850; margin-top: 55px;">

		<div class="mdl-card__title" >
				<h2 class="mdl-card__title-text">Acta de Donación</h2>
		</div>
		
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <select class="mdl-textfield__input js-bien" id="" name="bien" required>
                    <option value=""></option>
                    <?php
					$array_bienes_registrados = obtener_bienes_registrados($conexion);
					$array_resultado = obtener_codigos_prod($conexion, $array_bienes_registrados);

                    $html = '';
                    for($i = 0; $i < count($array_bienes_registrados); $i++){
						$bien1 = 'ID: '.$array_bienes_registrados[$i]['id'].' | '.$array_bienes_registrados[$i]['nombre'].' | '.$array_resultado[$i][0]['codigo'];
						$bien = $array_bienes_registrados[$i]['nombre'].' | ID: '.$array_bienes_registrados[$i]['id'];

                        $html.= '<option value="'.$array_bienes_registrados[$i]['id'].'">'.$bien1.'</option>' ;
                    }
                    echo $html;
                    ?>
                </select>
                <label class="mdl-textfield__label" for="bien">Bien Registrado</label>
            </div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="n_acta" name="n_acta" required>
              <label class="mdl-textfield__label" for="n_acta"># Acta</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
            </div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="nombre_donante" name="nombre_donante" required>
              <label class="mdl-textfield__label" for="nombre_donante">Nombres Completos del Donante</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
            </div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<input class="mdl-textfield__input" type="text" id="cedula_donante" name="cedula_donante" required maxlength="10">
					<label class="mdl-textfield__label" for="cedula_donante">Cédula del Donante</label>
					<span class="mdl-textfield__error">Este campo es requerido</span>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="cargo_donante" name="cargo_donante" required>
              <label class="mdl-textfield__label" for="cargo_donante">Cargo del Donante</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
            </div>

       
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" style="margin-top: 20px;">
			Generar
		</button>
	</form>

</body>
</html>


<script>
   $(document).ready(function() {
    $('.js-bien').select2();

    $('.js-bien').select2({
    // Otras opciones de configuración aquí
    language: {
      noResults: function () {
        return 'No se encontraron resultados';
      },
      searching: function () {
        return 'Buscando...';
      }
    },
    templateResult: function (data) {
      // Si se encuentra una coincidencia, se muestra normalmente
      if (data.loading) {
        // Si se está buscando, se muestra un mensaje de "Buscando..."
        return data.text;
      }
      // Si no se encuentra una coincidencia, se muestra un mensaje personalizado
      if (data.id === '') {
        return 'Seleccione un Registro';
      }
      // Si se encuentra una coincidencia, se muestra normalmente
      return data.text;
    }
  });
    
});
</script>


<script>
   $(document).ready(function() {
    $('.js-example-basic-single').select2();

    $('.js-example-basic-single').select2({
    // Otras opciones de configuración aquí
    language: {
      noResults: function () {
        return 'No se encontraron resultados';
      },
      searching: function () {
        return 'Buscando...';
      }
    },
    templateResult: function (data) {
      // Si se encuentra una coincidencia, se muestra normalmente
      if (data.loading) {
        // Si se está buscando, se muestra un mensaje de "Buscando..."
        return data.text;
      }
      // Si no se encuentra una coincidencia, se muestra un mensaje personalizado
      if (data.id === '') {
        return 'Seleccione un Registro';
      }
      // Si se encuentra una coincidencia, se muestra normalmente
      return data.text;
    }
  });
    
});
</script>
