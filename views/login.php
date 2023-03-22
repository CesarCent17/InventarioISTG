<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Iniciar Sesión | ISTG</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/sweetalert2.css">
	<link rel="stylesheet" href="../css/material.min.css">
	<link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="icon" type="image/x-icon" href="/logoISTG.ico">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="../js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="../js/material.min.js" ></script>
	<script src="../js/sweetalert2.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="../js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="../js/main.js" ></script>
</head>
<body class="cover" style="background-image: linear-gradient(to right top, #051937, #0b2753, #153770, #21468e, #3056ae);">
	<div class="container-login" style="width: 18%;">
		<p class="text-center" style="font-size: 110px;">
			<!-- <i class="zmdi zmdi-account-circle"></i> -->
            <img src="../assets/icons/logoISTG.ico" alt="Logo del ISTG" class="circle-img">
	    </p>

		</p>
		<p class="text-center text-condensedLight"></p>

		<form action="login.php" class="" method="post">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			    <input class="mdl-textfield__input" type="text" id="userName" name="cedula">
			    <label class="mdl-textfield__label" for="userName">Cédula </label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			    <input class="mdl-textfield__input" type="password" id="pass" name="contrasena" require>
			    <label class="mdl-textfield__label" for="pass">Contraseña</label>
			</div>
            <input type="submit" id="submit" value="Iniciar Sesión" class="mdl-button mdl-js-button mdl-js-ripple-effect" style="color: #162fbe; float:right;">
		</form>
	</div>

    <?php
    require('../php/mysqli_conexion.php');
    // Procesa los datos del formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cedula =  trim($_POST['cedula']);
        $contrasena =  trim($_POST['contrasena']);

        // Verifica si el usuario y la contraseña están vacíos
        if (empty($cedula) || empty($contrasena)) {
        // Mensaje de alerta
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Debes ingresar la cédula y la contraseña",
                })
                </script>';
        }
        else {
        // Autenticación del usuario
        // $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM `usuario` WHERE `cedula` = ? ";
        //Consulta preparada
        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            die("Error de consulta: " . $conexion->error);
        }
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if($resultado->num_rows == 1){
            $usuario = $resultado->fetch_assoc();
            //Verificar que el usuario tenga un estado ACTIVO
            if($usuario['activo']){
                // Verificamos si la contraseña coincide con la almacenada en la base de datos
                if(password_verify($contrasena, $usuario['contraseña'])){
                    session_start();
                    
                    //Consulta el ROL
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
                        $_SESSION['usuario'] = $usuario;
                        $_SESSION['rol'] = $rol;
                          
                        echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Inicio de sesión exitoso!',
                                    text: '¡Bienvenido!',
                                    confirmButtonText: 'OK',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '../index.php';
                                    }
                                });
                                </script>";
    
                    }
                    
                } else {
                        echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "La contraseña es incorrecta",
                        })
                        </script>';
                    }
            } else {
                // Si no si el usuario esta INACTIVO
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Su usuario se encuentra deshabilitado",
                })
                </script>';
            }
            //
            
        } else {
            // El usuario no existe
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "El usuario no existe",
                })
                </script>';
                }
            }
        }
    ?>
</body>
</html>