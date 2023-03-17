<?php
function obtener_producto_por_id($conexion, $id){
    $sql = "SELECT
                `id`,
                `nombre`,
                `descripcion`,
                `observaciones`,
                `acta_de_donacion`,
                `#_acta`,
                `año`,
                `id_campus`,
                `id_area_ubicacion`,
                `id_origen_del_bien`,
                `id_custodio`,
                `id_proceso_de_adquisicion`,
                `id_estado_de_uso`,
                `id_estado_fisico`
            FROM `inventorioistg`.`producto`
            WHERE `id` = ?;";
   
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $id);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();
    return $fila;
}

function obtener_origen($conexion, $id){
    $sql = "SELECT odb.`origen`
            FROM `producto` AS p
            INNER JOIN `origen_del_bien` AS odb
            ON p.`id_origen_del_bien` = odb.`id`
            WHERE p.`id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $origen = $fila['origen'];
    } else {
        // $origen = "No se encontró el origen correspondiente al ID proporcionado.";
        $origen = "";

    }
    return $origen;
}

function obtener_custodio($conexion, $id){
    $sql = 'SELECT CONCAT(cu.`nombre`," ",cu.`apellido`) AS custodio
            FROM `producto` AS p
            INNER JOIN `custodio` AS cu 
            ON p.`id_custodio` = cu.`id`
            WHERE p.`id` = ?;';

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
        // $custodio = "No se encontró el custodio correspondiente al ID proporcionado.";
        $custodio = "";

    }
    return $custodio;
}

function obtener_proceso_adquisicion($conexion, $id){
    $sql = 'SELECT pda.`proceso`
            FROM `producto` AS p
            INNER JOIN `proceso_de_adquisicion` AS pda
            ON p.`id_proceso_de_adquisicion` = pda.`id`
            WHERE p.`id` = ?;';

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $proceso = $fila['proceso'];
    } else {
        // $proceso = "No se encontró el proceso correspondiente al ID proporcionado.";
        $proceso = "";

    }
    return $proceso;
}

function obtener_estado_uso($conexion, $id){
    $sql = 'SELECT eu.estado
            FROM `producto` AS p
            INNER JOIN `estado_de_uso` AS eu
            ON p.`id_estado_de_uso` = eu.`id`
            WHERE p.`id` = ?;';

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $estado = $fila['estado'];
    } else {
        // $estado = "No se encontró el estado de uso correspondiente al ID proporcionado.";
        $estado = '';
    }
    return $estado;
}

function obtener_estado_fisico($conexion, $id){
    $sql = 'SELECT ef.`estado`
            FROM `producto` AS p
            INNER JOIN `estado_fisico` AS ef
            ON p.`id_estado_fisico` = ef.`id`
            WHERE p.`id` = ?;';

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $estado = $fila['estado'];
    } else {
        // $estado = "No se encontró el estado fisico correspondiente al ID proporcionado.";
        $estado = '';
    }
    return $estado;
}

function eliminar_prod($conexion, $id){
    $sql = "DELETE
        FROM `inventorioistg`.`producto`
        WHERE `id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        die("Error al eliminar el producto: " . $stmt->error);
    }  
}
?>

