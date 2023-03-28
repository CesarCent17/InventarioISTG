<?php

function obtener_bienes_registrados($conexion){
    $array_bienes_registrados =  array();
    $sql = "SELECT
                `id`,
                `nombre`,
                `descripcion`,
                `id_campus`,
                `id_area_ubicacion`,
                `#_acta`,
                `proceso_de_adquisicion`,
                `año`,
                `observaciones`
            FROM 
                `producto`
            WHERE
                `oculto` = 0";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        array_push($array_bienes_registrados, $fila);
    }
    return $array_bienes_registrados;
}


function obtener_bienes_descartados($conexion){
    $array_bienes_descartados =  array();
    $sql = "SELECT
                `id`,
                `nombre`,
                `descripcion`,
                `id_campus`,
                `id_area_ubicacion`
            FROM 
                `producto`
            WHERE
                `oculto` = 1";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        array_push($array_bienes_descartados, $fila);
    }
    return $array_bienes_descartados;
}

function obtener_array_campus($conexion, $array_bienes_registrados){
    $array_campus = array();
    for($i = 0; $i < count($array_bienes_registrados) ; $i++){
        $id = $array_bienes_registrados[$i]['id'];
        $campus = obtener_campus_por_id($conexion, $id);
        array_push($array_campus, $campus);
    }
    return $array_campus;
}


function obtener_array_origen($conexion, $array_bienes_registrados){
    $array_origen = array();
    for($i = 0; $i < count($array_bienes_registrados) ; $i++){
        $id = $array_bienes_registrados[$i]['id'];
        $origen = obtener_origen_por_id($conexion, $id);
        array_push($array_origen, $origen);
    }
    return $array_origen;
}

function obtener_array_administrador($conexion, $array_bienes_registrados){
    $array_administrador = array();
    for($i = 0; $i < count($array_bienes_registrados) ; $i++){
        $id = $array_bienes_registrados[$i]['id'];
        $administrador = obtener_administrador_por_id($conexion, $id);
        array_push($array_administrador, $administrador);
    }
    return $array_administrador;
}

function obtener_array_custodio($conexion, $array_bienes_registrados){
    $array_custodio = array();
    for($i = 0; $i < count($array_bienes_registrados) ; $i++){
        $id = $array_bienes_registrados[$i]['id'];
        $custodio = obtener_custodio_por_id($conexion, $id);
        array_push($array_custodio, $custodio);
    }
    return $array_custodio;
}

function obtener_array_tipo_acta($conexion, $array_bienes_registrados){
    $array_tipo_acta = array();
    for($i = 0; $i < count($array_bienes_registrados) ; $i++){
        $id = $array_bienes_registrados[$i]['id'];
        $tipo_acta = obtener_tipo_acta_por_id($conexion, $id);
        array_push($array_tipo_acta, $tipo_acta);
    }
    return $array_tipo_acta;
}

function obtener_array_estado_uso($conexion, $array_bienes_registrados){
    $array_estado_de_uso = array();
    for($i = 0; $i < count($array_bienes_registrados) ; $i++){
        $id = $array_bienes_registrados[$i]['id'];
        $estado_de_uso = obtener_estado_de_uso_por_id($conexion, $id);
        array_push($array_estado_de_uso, $estado_de_uso);
    }
    return $array_estado_de_uso;
}


function obtener_array_estado_fisico($conexion, $array_bienes_registrados){
    $array_estado_fisico = array();
    for($i = 0; $i < count($array_bienes_registrados) ; $i++){
        $id = $array_bienes_registrados[$i]['id'];
        $estado_fisico = obtener_estado_fisico_por_id($conexion, $id);
        array_push($array_estado_fisico, $estado_fisico);
    }
    return $array_estado_fisico;
}


function obtener_estado_fisico_por_id($conexion, $id){
    $sql = "SELECT `estado_fisico`.`estado`
            FROM `producto` AS p
            INNER JOIN `estado_fisico` ON p.`id_estado_fisico` = estado_fisico.`id`
            WHERE p.`id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $estado_fisico = $fila['estado'];
    } else {
        $estado_fisico = "";
    }
    return $estado_fisico;
}

function obtener_estado_de_uso_por_id($conexion, $id){
    $sql = "SELECT `estado_de_uso`.`estado`
            FROM `producto` AS p
            INNER JOIN `estado_de_uso` ON p.`id_estado_de_uso` = estado_de_uso.`id`
            WHERE p.`id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $estado_de_uso = $fila['estado'];
    } else {
        $estado_de_uso = "";
    }
    return $estado_de_uso;
}



function obtener_tipo_acta_por_id($conexion, $id){
    $sql = "SELECT ta.`descripcion`
            FROM `producto` AS p
            INNER JOIN `tipo_acta` AS ta ON p.`id_tipo_acta` = ta.`id`
            WHERE p.`id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $tipo_acta = $fila['descripcion'];
    } else {
        $tipo_acta = "";
    }
    return $tipo_acta;
}


function obtener_custodio_por_id($conexion, $id){
    $sql = "SELECT CONCAT(cu.nombre,' ',cu.apellido) AS custodio 
            FROM `producto` AS p
            INNER JOIN `custodio` AS cu ON p.`id_custodio` = cu.`id`
            WHERE p.`id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $custodio = $fila['custodio'];
    } else {
        $custodio = "";
    }
    return $custodio;
}


function obtener_administrador_por_id($conexion, $id){
    $sql = "SELECT CONCAT(adm.nombre,' ',adm.apellido) AS administrador 
            FROM `producto` AS p
            INNER JOIN `administrador` AS adm ON p.`id_administrador` = adm.`id`
            WHERE p.`id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $administrador = $fila['administrador'];
    } else {
        $administrador = "";
    }
    return $administrador;
}


function obtener_origen_por_id($conexion, $id){
    $sql = "SELECT odb.`origen` 
            FROM `producto` AS p
            INNER JOIN `origen_del_bien` AS odb ON p.`id_origen_del_bien` = odb.`id`
            WHERE p.`id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $campus = $fila['origen'];
    } else {
        $campus = "";
    }
    return $campus;
}

function obtener_campus_por_id($conexion, $id){
    $sql = "SELECT c.`nombre` AS campus
            FROM `producto` AS p
            INNER JOIN `campus` AS c ON p.`id_campus` = c.`id`
            WHERE p.`id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $campus = $fila['campus'];
    } else {
        $campus = "";
    }
    return $campus;
}

function obtener_array_ubicacion($conexion, $array_bienes_registrados){
    $array_ubicacion = array();
    for($i = 0; $i < count($array_bienes_registrados) ; $i++){
        $id = $array_bienes_registrados[$i]['id'];
        $ubicacion = obtener_ubicacion_por_id($conexion, $id);
        array_push($array_ubicacion, $ubicacion);
    }
    return $array_ubicacion;
}

function obtener_ubicacion_por_id($conexion, $id){
    $sql = "SELECT au.`direccion` AS ubicacion
            FROM `producto` AS p
            INNER JOIN `area_ubicacion` AS au ON p.`id_area_ubicacion` = au.`id`
            WHERE p.`id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $ubicacion = $fila['ubicacion'];
    } else {
        $ubicacion = "";
    }
    return $ubicacion;

}

function obtener_array_codigo_de_producto($conexion, $id){
    $sql = 'SELECT 
                cp.`id_producto` AS "id_producto",
                ci.`codigo` AS "codigo"
            FROM 
                `codigo_producto` AS cp
                INNER JOIN `codigo_institucion` AS ci
                ON cp.`id_codigo_institucion` = ci.`id`
            WHERE 
                `id_producto` = ?;';

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_codigo_de_producto[] = $fila;
    }
    return $array_codigo_de_producto;
}

function obtener_codigos_prod($conexion, $array_bienes_registrados){
    $array_resultado = array();
    for($i = 0; $i < count($array_bienes_registrados) ; $i++){
        $id = $array_bienes_registrados[$i]['id'];
        $array_codigo_de_producto = obtener_array_codigo_de_producto($conexion, $id);
        array_push($array_resultado, $array_codigo_de_producto);
    }
    return $array_resultado;
}



?>