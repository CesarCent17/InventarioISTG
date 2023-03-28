<?php
    require('../php/mysqli_conexion.php');
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
	<title>Agregar Bien | ISTG</title>
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
				<i class="zmdi zmdi-desktop-mac"></i><span class="hide-on-tablet">&nbsp; AGREGAR BIEN</span>
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
											<a href="docentes.php" class="full-width">
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

	<section class="full-width pageContent">
	<div style="text-align: center; margin-top: 20px" >
		<h5 class="mdl-color-text--primary">Ingresar Nuevo Bien</h5>
  </div>

	<!-- Form -->
      <form class="mdl-grid" action="../php/save_test.php" method="post" style="max-width: 800px; margin: 0 auto;">

          <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="nombre" name="nombre" required>
              <label class="mdl-textfield__label" for="nombre">Nombre General</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
            </div>
          </div>

          <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="descripcion" name="descripcion" required>
              <label class="mdl-textfield__label" for="descripcion">Descripción</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
            </div>
          </div>

        
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
              <select class="mdl-textfield__input" id="campus" name="campus" required>
                <option value=""></option>
                <?php
                $array_campus = getCampus($conexion);
                echo "<script> console.log(" . json_encode($array_campus) . "); </script>";

                $html = '';
                for($i = 0; $i < count($array_campus); $i++){
                    $html.= '<option value="'.$array_campus[$i]['id'].'">'.$array_campus[$i]['nombre'].'</option>' ;
                }
                echo $html;
                ?>
              </select>
              <label class="mdl-textfield__label" for="campus">Campus</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
            </div>
          </div>


          <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <select class="mdl-textfield__input" id="area_de_ubicacion" name="area_de_ubicacion" required>
                <option value=""></option>
                <?php
                $array_area_de_ubicacion = getAreaDeUbicacion($conexion);
                echo "<script> console.log(" . json_encode($array_area_de_ubicacion) . "); </script>";

                $html = '';
                for($i = 0; $i < count($array_area_de_ubicacion); $i++){
                    $html.= '<option value="'.$array_area_de_ubicacion[$i]['id'].'">'.$array_area_de_ubicacion[$i]['direccion'].'</option>' ;
                }
                echo $html;
                ?>
              </select>
              <label class="mdl-textfield__label" for="area_de_ubicacion">Área de ubicación</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
          </div>
        </div>


        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="codigoISTG" name="codigoISTG" required>
              <label class="mdl-textfield__label" for="codigo">Código ISTG</label>
              <span class="mdl-textfield__error">Este campo es requerido</span>
            </div>
          
          <div style="margin-top: 10px;">
            <p style="display: inline-block; margin-right: 10px; font-size:14px">¿Deseas agregar otro código?</p>
            <a href="#" class="mdl-color-text--primary" style="display: inline-block; margin-left: 10px; font-size:14px" onclick="mostrarInputNuevoCodigo()">Agregar Código Adicional</a>
          </div>

          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label oculto div-codigoSENESCYT/SECAP/COLEGIO" id=divCodigo>
              <input class="mdl-textfield__input" type="text" id="codigoSENESCYT/SECAP/COLEGIO" name="codigoSENESCYT/SECAP/COLEGIO">
              <label class="mdl-textfield__label" for="codigo">Código SENESCYT/SECAP/COLEGIO </label>
          </div>
        </div>


        <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <select class="mdl-textfield__input" id="administrador" name="administrador">
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
              <label class="mdl-textfield__label" for="administrador">Administrador</label>
            </div>
          </div>

          <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <select class="mdl-textfield__input js-example-basic-single" id="BuscadorCustodio" name="custodio">
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
                <label class="mdl-textfield__label" for="custodio">Custodio</label>
            </div>
        </div>



          <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <select class="mdl-textfield__input" id="origen_del_bien" name="origen_del_bien">
                <option value=""></option>
                <?php
                $array_origen_del_bien = getOrigen($conexion);
                echo "<script> console.log(" . json_encode($array_origen_del_bien) . "); </script>";

                $html = '';
                for($i = 0; $i < count($array_origen_del_bien); $i++){
                    $html.= '<option value="'.$array_origen_del_bien[$i]['id'].'">'.$array_origen_del_bien[$i]['origen'].'</option>' ;
                }
                echo $html;
                ?>
              </select>
              <label class="mdl-textfield__label" for="origen_del_bien">Origen del bien</label>
            </div>
          </div>

          <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <select class="mdl-textfield__input" id="estado_de_uso" name="estado_de_uso">
                <option value=""></option>
                <?php
                $array_estado_de_uso = getEstadoDeUso($conexion);
                echo "<script> console.log(" . json_encode($array_estado_de_uso) . "); </script>";

                $html = '';
                for($i = 0; $i < count($array_estado_de_uso); $i++){
                    $html.= '<option value="'.$array_estado_de_uso[$i]['id'].'">'.$array_estado_de_uso[$i]['estado'].'</option>' ;
                }
                echo $html;
                ?>
              </select>
              <label class="mdl-textfield__label" for="estado_de_uso">Estado de uso</label>
            </div>
          </div>

          <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <select class="mdl-textfield__input" id="estado_fisico" name="estado_fisico">
                <option value=""></option>
                <?php
                $array_estado_fisico = getEstadoFisico($conexion);
                echo "<script> console.log(" . json_encode($array_estado_fisico) . "); </script>";

                $html = '';
                for($i = 0; $i < count($array_estado_fisico); $i++){
                    $html.= '<option value="'.$array_estado_fisico[$i]['id'].'">'.$array_estado_fisico[$i]['estado'].'</option>' ;
                }
                echo $html;
                ?>
              </select>
              <label class="mdl-textfield__label" for="estado_fisico">Estado físico</label>
            </div>
          </div>

          <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select class="mdl-textfield__input" id="tipo_acta" name="tipo_acta">
                <option value=""></option>
                <?php
                $array_tipo_acta = getTipoActa($conexion);

                $html = '';
                for($i = 0; $i < count($array_tipo_acta); $i++){
                    $html.= '<option value="'.$array_tipo_acta[$i]['id'].'">'.$array_tipo_acta[$i]['descripcion'].'</option>' ;
                }
                echo $html;
                ?>
              </select>
              <label class="mdl-textfield__label" for="tipo_acta">Tipo de Acta</label>
            </div>
          </div>

          <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="proceso_de_adquisicion" name="proceso_de_adquisicion">
              <label class="mdl-textfield__label" for="proceso_de_adquisicion">Proceso de adquisición</label>
            </div>
          </div>

          <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <textarea class="mdl-textfield__input" type="text" rows= "3" id="observaciones" name="observaciones"></textarea>
              <label class="mdl-textfield__label" for="observaciones">Observaciones</label>
            </div>
          </div>
        
        <div class="mdl-cell mdl-cell--12-col">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary" type="submit">
              Guardar 
            </button>
        </div>

    </form>
	</section>

	
</body>
</html>

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
        return 'Seleccione un Custodio';
      }
      // Si se encuentra una coincidencia, se muestra normalmente
      return data.text;
    }
  });
    
});
</script>


