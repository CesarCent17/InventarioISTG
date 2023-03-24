<?php

function consultarListaUsuarios($conexion){
    $sql = "SELECT * FROM `usuario`;";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_usuarios[] = $fila;
    }
    
    return $array_usuarios;
}

function actualizarEstadoUsuario($conexion, $id_usuario, $estado){
    $sql = "UPDATE 
	`inventorioistg`.`usuario` 
    SET 
        `activo` = ? 
    WHERE 
        `id` = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("ss", $estado, $id_usuario);
    $stmt->execute();
    $booleano = 0;
    if ($conexion->affected_rows > 0) {
        // echo "La consulta se realizó correctamente. Se actualizaron " . $conexion->affected_rows . " filas.";
        $booleano = 1;
    } else {
        echo "La consulta no se realizó correctamente.";
    }
    return $booleano;

}

function getCampus($conexion){
    $sql= "SELECT `id`, `nombre`, `direccion` FROM `campus`;";
    $array_campus = array();
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_campus[] = $fila;
    }
    
    return $array_campus;
}

function getAreaDeUbicacion($conexion){
    $sql= "SELECT `id`, `direccion` FROM `area_ubicacion`;";
    $array_area_de_ubicacion = array();
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_area_de_ubicacion[] = $fila;
    }
    
    return $array_area_de_ubicacion;
}

function getOrigen($conexion){
    $sql= "SELECT `id`, `origen` FROM `origen_del_bien`;";
    $array_origen_del_bien = array();
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_origen_del_bien[] = $fila;
    }
    
    return $array_origen_del_bien;
}

function getCustodio($conexion){
    $sql = "SELECT `id`, CONCAT(`nombre`, ' ', `apellido`) AS nombres_completos FROM `custodio`;";
    $array_custodio = array();
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_custodio[] = $fila;
    }
    
    return $array_custodio;
}

function getCustodioDocente($conexion){
    $sql = "SELECT
                `id`,
                `cedula`,
                `nombre`,
                `apellido`
            FROM `custodio`;";
    $array_custodio_docente = array();
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_custodio_docente[] = $fila;
    }
    
    return $array_custodio_docente;
}

function getAdministrador($conexion){
    $sql= "SELECT `id`, CONCAT(`nombre`, ' ', `apellido`) AS nombres_completos FROM `administrador`;";
    $array_administrador = array();
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_administrador[] = $fila;
    }
    
    return $array_administrador;
}

function getEstadoDeUso($conexion){
    $sql= "SELECT `id`, `estado` FROM `estado_de_uso`;";
    $array_estado_de_uso = array();
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_estado_de_uso[] = $fila;
    }
    
    return $array_estado_de_uso;
}

function getEstadoFisico($conexion){
    $sql= "SELECT `id`, `estado` FROM `estado_fisico`;";
    $array_estado_fisico = array();
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_estado_fisico[] = $fila;
    }
    return $array_estado_fisico;
}

function getTipoActa($conexion){
    $sql = "SELECT `id`,`descripcion` FROM `tipo_acta`;";
    $array_tipo_acta = array();
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $array_tipo_acta[] = $fila;
    }
    return $array_tipo_acta;
}



?>