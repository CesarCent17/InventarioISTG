<?php
    require('mysqli_conexion.php');
    require('insert_product.php');
    require('querys_actualizacion.php');
    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['campus']) && !empty($_POST['area_de_ubicacion'])) {
                // Todos los campos están completos, puedes continuar con el proceso
                // Requeridos
                $id_prod = $_POST['id_prod'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $id_campus = $_POST['campus'];
                $id_area_ubicacion = $_POST['area_de_ubicacion'];
    
                // Opcionales
                $observaciones = trim($_POST['observaciones']) === '' ? NULL : trim($_POST['observaciones']);
                $n_acta = trim($_POST['numero_de_acta']) === '' ? NULL : trim($_POST['numero_de_acta']);
                $proceso_de_adquisicion = trim($_POST['proceso_de_adquisicion']) === '' ? NULL : trim($_POST['proceso_de_adquisicion']);
                $año = trim($_POST['anio']) === '' ? NULL : trim($_POST['anio']);
                $id_origen_del_bien = trim($_POST['origen_del_bien']) === '' ? NULL : trim($_POST['origen_del_bien']);
                $id_custodio = trim($_POST['custodio']) === '' ? NULL : trim($_POST['custodio']);
                $id_estado_de_uso = trim($_POST['estado_de_uso']) === '' ? NULL : trim($_POST['estado_de_uso']);
                $id_estado_fisico = trim($_POST['estado_fisico']) === '' ? NULL : trim($_POST['estado_fisico']);
                $id_administrador = trim($_POST['administrador']) === '' ? NULL : trim($_POST['administrador']);
                $id_tipo_acta = trim($_POST['tipo_acta']) === '' ? NULL : trim($_POST['tipo_acta']);
    
                update_prod($conexion, $nombre, $descripcion, $observaciones, $n_acta, $proceso_de_adquisicion, $año, $id_campus, $id_area_ubicacion, 
                $id_origen_del_bien, $id_custodio, $id_estado_de_uso, $id_estado_fisico, $id_administrador, $id_tipo_acta, $id_prod);
                              
            } else {
                // Al menos uno de los campos está vacío, muestra un mensaje de error
                echo "Por favor completa todos los campos requeridos (4).";
            }
            
        }
    }
?>