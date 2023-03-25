<?php

function obtener_bienes_registrados($conexion){
    $array_bienes_registrados =  array();
    $sql = "SELECT
                `id`,
                `nombre`,
                `descripcion`,
                `id_campus`,
                `id_area_ubicacion`
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
        $campus = "No se encontró el campus correspondiente al ID proporcionado.";
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
        $ubicacion = "No se encontró la ubicacion correspondiente al ID proporcionado.";
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