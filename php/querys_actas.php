<?php

function obtener_custodio_administrativo_por_id($conexion, $id){
    $sql = "SELECT
                `id`,
                concat(`nombre`,' ',`apellido`) as nombres_completos,
                `cedula`
            from `administrador` 
            WHERE `id` = ?
            limit 1;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $custodio_administrativo = $fila;
    } else {
        $custodio_administrativo = "";
    }
    return $custodio_administrativo;
}

function obtener_receptor_por_id($conexion, $id){
    $sql = "SELECT
                `id`,
                concat(`nombre`,' ',`apellido`) as nombres_completos,
                `cedula`
            from `custodio` 
            WHERE `id` = ?
            limit 1;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $receptor = $fila;
    } else {
        $receptor = "";
    }
    return $receptor;
}




?>