<?php
function obtener_producto_por_id($conexion, $id){
    $sql = "SELECT
                `id`,
                `nombre`,
                `descripcion`,
                `observaciones`,
                `#_acta`,
                `proceso_de_adquisicion`,
                `año`
                -- `id_campus`,
                -- `id_area_ubicacion`,
                -- `id_origen_del_bien`,
                -- `id_custodio`,
                -- `id_estado_de_uso`,
                -- `id_estado_fisico`,
                -- `id_administrador`,
                -- `id_tipo_acta`
            FROM `producto`
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

function obtener_administrador($conexion, $id){
    $sql = "SELECT concat(`administrador`.`nombre`, ' ', `administrador`.`apellido`) as nombres_completos
            FROM `producto` AS p
            INNER JOIN `administrador`
            ON p.`id_administrador` = `administrador`.`id`
            WHERE p.`id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $administrador = $fila['nombres_completos'];
    } else {
        // $proceso = "No se encontró el proceso correspondiente al ID proporcionado.";
        $administrador = "";

    }
    return $administrador;
}

function obtener_tipo_acta($conexion, $id){
    $sql = "SELECT tda.descripcion 
            FROM `producto` AS p
            INNER JOIN `tipo_acta` as tda
            ON p.`id_tipo_acta` = `tda`.`id`
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
        // $proceso = "No se encontró el proceso correspondiente al ID proporcionado.";
        $tipo_acta = "";

    }
    return $tipo_acta;
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

function ocultar_prod($conexion, $id){
    $sql = "UPDATE `producto`
            SET `oculto` = '1'
            WHERE `id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        die("Error al ocultar el bien: " . $stmt->error);
    }  
}
?>

