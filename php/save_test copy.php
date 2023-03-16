<?php

    require('mysqli_conexion.php');
    require('insert_product.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $descripcion =  $_POST['descripcion'];
        $observaciones =  $_POST['observaciones'];
        $acta_de_donacion = $_POST['acta_de_donacion'];   
        $n_acta = $_POST['numero_de_acta'];
        $año = $_POST['anio'];
        $id_campus = $_POST['campus'];
        $id_area_ubicacion = $_POST['area_de_ubicacion'];
        $id_origen_del_bien = $_POST['origen_del_bien'];
        $id_custodio = $_POST['custodio'];
        $id_proceso_de_adquisicion = $_POST['proceso_de_adquisicion'];
        $id_estado_de_uso = $_POST['estado_de_uso'];
        $id_estado_fisico = $_POST['estado_fisico'];

        //Registrar producto
        $id_producto = insert_prod($conexion, $nombre, $descripcion, $observaciones, $acta_de_donacion, $n_acta, $año, $id_campus, $id_area_ubicacion, 
                    $id_origen_del_bien, $id_custodio, $id_proceso_de_adquisicion, $id_estado_de_uso, $id_estado_fisico);

        //Capturar codigos en un array
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

        header('Location: ../views/bien.php'); // redirige al usuario a la página original
        exit;
}
?>