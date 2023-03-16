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
        // echo "El registro ha sido insertado correctamente. ID: " . $last_inserted_id;
    } else {
        // Hubo un error al realizar la inserción
        echo "Error al insertar el registro en la tabla codigo_institucion: " . $stmt->error;
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
        // echo "El registro ha sido insertado correctamente en la tabla codigo_producto.";
    } else {
        // Hubo un error al realizar la inserción
        echo "Error al insertar el registro en la tabla codigo_producto: " . $stmt->error;
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
        // echo "El registro ha sido insertado correctamente en la tabla producto.";
        $html = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <link rel="stylesheet" href="../css/normalize.css">
                <link rel="stylesheet" href="../css/sweetalert2.css">
                <link rel="stylesheet" href="../css/material.min.css">
                <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
                <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
                <link rel="stylesheet" href="../css/main.css">
                <link rel="stylesheet" href="../css/style.css">
            
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                <script>window.jQuery || document.write(\'<script src="../js/jquery-1.11.2.min.js"><\\/script>\')</script>
                <script src="../js/material.min.js" ></script>
                <script src="../js/sweetalert2.min.js" ></script>
                <script src="../js/jquery.mCustomScrollbar.concat.min.js" ></script>
                <script src="../js/main.js" ></script>
                <title>Registro Exitoso</title>
            </head>
            <body>
                <script>
                     Swal.fire({
                        icon: \'success\',
                        title: \'Registro exitoso\',
                        text: \'El registro del bien se ha realizado con éxito\',
                        confirmButtonText: \'OK\',
                        }).then((result) => { if (result.isConfirmed) {
                            window.location.href = \'../views/bien.php\';
                        }
                        });
                </script>
                
            </body>
            </html>';
            echo $html;
    } else {
        // Hubo un error al realizar la inserción
        // echo "Error al insertar el registro: " . $stmt->error;
        $html = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <link rel="stylesheet" href="../css/normalize.css">
                <link rel="stylesheet" href="../css/sweetalert2.css">
                <link rel="stylesheet" href="../css/material.min.css">
                <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
                <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
                <link rel="stylesheet" href="../css/main.css">
                <link rel="stylesheet" href="../css/style.css">

                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                <script>window.jQuery || document.write(\'<script src="../js/jquery-1.11.2.min.js"><\\/script>\')</script>
                <script src="../js/material.min.js" ></script>
                <script src="../js/sweetalert2.min.js" ></script>
                <script src="../js/jquery.mCustomScrollbar.concat.min.js" ></script>
                <script src="../js/main.js" ></script>
                <title>Error</title>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Error al insertar el registro",
                        confirmButtonText: "OK",
                        }).then((result) => { if (result.isConfirmed) {
                            window.location.href = "../views/bien.php";
                        }
                        });
                </script>
            </body>
            </html>';

        echo $html;
    }
    return $last_inserted_id;
}

?>