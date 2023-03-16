<?php
function obtener_ids_productos($conexion){
    $sql = "SELECT p.`id` FROM `producto` AS p;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_ids_productos[] = $fila;
    }
    return $array_ids_productos;
}

function obtener_ids_usuarios_activos($conexion){
    $sql = "SELECT u.`id` FROM `usuario` AS u WHERE u.`activo`=1;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_ids_usuarios_activos[] = $fila;
    }
    return $array_ids_usuarios_activos;
}

function obtener_ult_prod($conexion){
    $sql = "SELECT DATE_FORMAT(prod.`fecha_registro`, '%d %b %Y %H:%i:%s') AS fecha_registro,
                   prod.`nombre`, 
                   prod.`id_usuario`
            FROM producto AS prod
            ORDER BY prod.`fecha_registro` DESC
            LIMIT 5;
            ";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_ult_prod[] = $fila;
    }
    return $array_ult_prod;
}

function obtener_usuario_producto($conexion, $id){
    $sql = 'SELECT CONCAT(us.`nombre`," ",us.`apellido`) AS usuario
            FROM `producto` AS prod
            INNER JOIN `usuario` AS us 
            ON prod.`id_usuario` = us.`id`
            WHERE us.`id` = ?;';

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
    die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
    $usuario_producto = $fila['usuario'];
    } else {
    $usuario_producto = "No se encontró el usuario_producto correspondiente al ID proporcionado.";
    }
    return $usuario_producto;
}

function obtener_ult_us($conexion, $array_ult_prod){
    $array_ult_us = array();
    for($i = 0; $i < count($array_ult_prod); $i++){
        $id = $array_ult_prod[$i]['id_usuario'];
        $array_usuario_producto = obtener_usuario_producto($conexion, $id);
        array_push($array_ult_us, $array_usuario_producto);
        }
    return $array_ult_us;
    print_r($array_ult_us);
    }
?>