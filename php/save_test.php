<?php

    require('mysqli_conexion.php');
    require('insert_product.php');
    session_start();
    $id_usuario = $_SESSION['usuario']['id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['campus']) && !empty($_POST['area_de_ubicacion'])) {
            // Todos los campos están completos, puedes continuar con el proceso
            // Requeridos
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $id_campus = $_POST['campus'];
            $id_area_ubicacion = $_POST['area_de_ubicacion'];

            $nombre = strtoupper($nombre);
            $descripcion = strtoupper($descripcion);

            // Opcionales
            $observaciones = trim($_POST['observaciones']) === '' ? NULL : trim($_POST['observaciones']);
            $observaciones = strtoupper($observaciones);
            $n_acta = trim($_POST['numero_de_acta']) === '' ? NULL : trim($_POST['numero_de_acta']);
            $proceso_de_adquisicion = trim($_POST['proceso_de_adquisicion']) === '' ? NULL : trim($_POST['proceso_de_adquisicion']);
            $año = trim($_POST['anio']) === '' ? NULL : trim($_POST['anio']);
            $id_origen_del_bien = trim($_POST['origen_del_bien']) === '' ? NULL : trim($_POST['origen_del_bien']);
            $id_custodio = trim($_POST['custodio']) === '' ? NULL : trim($_POST['custodio']);
            $id_estado_de_uso = trim($_POST['estado_de_uso']) === '' ? NULL : trim($_POST['estado_de_uso']);
            $id_estado_fisico = trim($_POST['estado_fisico']) === '' ? NULL : trim($_POST['estado_fisico']);
            $id_administrador = trim($_POST['administrador']) === '' ? NULL : trim($_POST['administrador']);
            $id_tipo_acta = trim($_POST['tipo_acta']) === '' ? NULL : trim($_POST['tipo_acta']);


            $id_producto = insert_prod($conexion, $nombre, $descripcion, $observaciones, $n_acta, $proceso_de_adquisicion, $año, $id_campus, $id_area_ubicacion, 
            $id_origen_del_bien, $id_custodio, $id_estado_de_uso, $id_estado_fisico, $id_usuario, $id_administrador, $id_tipo_acta);
            
            // Capturar codigos en un array
            $array_codigo_ISTG = array();
            $array_codigo = array();
            $codigoISTG = '';
            $codigoAdicional = '';

            
            if($_POST['codigoISTG'] != ''){
                $codigoISTG = $_POST['codigoISTG'];
                $array_codigo_ISTG["id_institucion"] = 1;
                $array_codigo_ISTG["codigo"] = $codigoISTG;
                array_push($array_codigo, $array_codigo_ISTG);
            }
            $array_codigo_adicional = array();
            if($_POST['codigoSENESCYT/SECAP/COLEGIO'] != ''){
                $codigoAdicional = $_POST['codigoSENESCYT/SECAP/COLEGIO'];
                $array_codigo_adicional["id_institucion"] = 2;
                $array_codigo_adicional["codigo"] = $codigoAdicional;
                array_push($array_codigo, $array_codigo_adicional);
            }

            //Registrar en la tabla codigo_institucion
            $array_id_codigo_registrado = array();
            for($i = 0; $i < count($array_codigo); $i++){
                $id_institucion = $array_codigo[$i]['id_institucion'];
                $codigo = $array_codigo[$i]['codigo'];
                $id = insert_codeinst_and_get_last_id($conexion, $id_institucion, $codigo);
                array_push($array_id_codigo_registrado, $id);
            };

            //Registrar en la tabla codigo_producto
            for($i = 0; $i < count($array_id_codigo_registrado); $i++){
                $id_codigo_institucion = $array_id_codigo_registrado[$i];
                insert_codeprod($conexion, $id_codigo_institucion, $id_producto);
            }
                        
        } else {
            // Al menos uno de los campos está vacío, muestra un mensaje de error
            echo "Por favor completa todos los campos requeridos (4).";
            // header('Location: ../views/bien.php'); // redirige al usuario a la página original
            // exit;
        }
}
?>