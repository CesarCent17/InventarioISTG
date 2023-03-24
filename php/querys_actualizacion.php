<?php

function update_prod($conexion, $nombre, $descripcion, $observaciones, $n_acta, $proceso_de_adquisicion, $año, $id_campus, $id_area_ubicacion, 
                    $id_origen_del_bien, $id_custodio, $id_estado_de_uso, $id_estado_fisico, $id_administrador, $id_tipo_acta, $id_prod){
    
    $sql = "UPDATE `producto`
            SET 
            `nombre` = ?,
            `descripcion` = ?,
            `observaciones` = ?,
            `#_acta` = ?,
            `proceso_de_adquisicion` = ?,
            `año` = ?,
            `id_campus` = ?,
            `id_area_ubicacion` = ?,
            `id_origen_del_bien` = ?,
            `id_custodio` = ?,
            `id_estado_de_uso` = ?,
            `id_estado_fisico` = ?,
            `id_administrador` = ?,
            `id_tipo_acta` = ?
            WHERE `id` = ?;";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("sssssssssssssss", $nombre, $descripcion, $observaciones, $n_acta, $proceso_de_adquisicion, $año, $id_campus, $id_area_ubicacion, 
    $id_origen_del_bien, $id_custodio, $id_estado_de_uso, $id_estado_fisico, $id_administrador, $id_tipo_acta, $id_prod);

    if ($stmt->execute() && $stmt->affected_rows == 1) {
        // La inserción se realizó correctamente
        // $last_inserted_id = mysqli_insert_id($conexion);
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
                        title: \'Actualización exitosa\',
                        text: \'El registro del bien se ha actualizado con éxito\',
                        confirmButtonText: \'OK\',
                        }).then((result) => { if (result.isConfirmed) {
                            window.location.href = \'../views/inventario.php\';
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
                        text: "Error al actualizar el registro",
                        confirmButtonText: "OK",
                        }).then((result) => { if (result.isConfirmed) {
                            window.location.href = "../views/inventario.php";
                        }
                        });
                </script>
            </body>
            </html>';

        echo $html;
    }
}

?>