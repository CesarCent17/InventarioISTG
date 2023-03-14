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
    



?>