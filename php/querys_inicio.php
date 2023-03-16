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

?>