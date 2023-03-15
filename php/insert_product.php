<?php

function insert_codeinst_and_get_last_id($conexion, $id_institucion, $codigo){
    $last_inserted_id = null;
    $sql = "INSERT INTO `inventorioistg`.`codigo_institucion`
                    (
                        `codigo`,
                        `id_institucion`
                    )
        VALUES      (
                        ?,
                        ?
                    );";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("ss", $codigo, $id_institucion);

    if ($stmt->execute() && $stmt->affected_rows == 1) {
        // La inserción se realizó correctamente
        $last_inserted_id = mysqli_insert_id($conexion); // Obtiene el último ID insertado
        echo "El registro ha sido insertado correctamente. ID: " . $last_inserted_id;
    } else {
        // Hubo un error al realizar la inserción
        echo "Error al insertar el registro: " . $stmt->error;
    }
    return $last_inserted_id;
}

function insert_codeprod($conexion, $id_codigo_institucion, $id_producto){
    $sql = "INSERT INTO `inventorioistg`.`codigo_producto`
                (
                    `id_codigo_institucion`,
                    `id_producto`
                 )
            VALUES (
                    ?,
                    ?
                    );
    ";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("ss", $id_codigo_institucion, $id_producto);

    if ($stmt->execute() && $stmt->affected_rows == 1) {
        // La inserción se realizó correctamente
        echo "El registro ha sido insertado correctamente en la tabla codigo_producto.";
    } else {
        // Hubo un error al realizar la inserción
        echo "Error al insertar el registro: " . $stmt->error;
    }
   
}

function insert_prod($conexion, $nombre, $descripcion, $observaciones, $acta_de_donacion, $n_acta, $año, $id_campus, $id_area_ubicacion, 
                    $id_origen_del_bien, $id_custodio, $id_proceso_de_adquisicion, $id_estado_de_uso, $id_estado_fisico){
    $last_inserted_id = null;

    $sql = "INSERT INTO `inventorioistg`.`producto`
                (
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
                )
            VALUES 
                (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                );";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("sssssssssssss",$nombre, $descripcion, $observaciones, $acta_de_donacion, $n_acta, $año, $id_campus, $id_area_ubicacion, 
    $id_origen_del_bien, $id_custodio, $id_proceso_de_adquisicion, $id_estado_de_uso, $id_estado_fisico);

    if ($stmt->execute() && $stmt->affected_rows == 1) {
        // La inserción se realizó correctamente
        $last_inserted_id = mysqli_insert_id($conexion);
        echo "El registro ha sido insertado correctamente en la tabla producto.";
    } else {
        // Hubo un error al realizar la inserción
        echo "Error al insertar el registro: " . $stmt->error;
    }
    return $last_inserted_id;
}

?>