<?php

function insert_area_de_ubicacion($conexion, $direccion){
    $sql = "INSERT INTO `area_ubicacion`
                (
                `direccion`)
            values (
            ?);";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error de consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $direccion);

    if ($stmt->execute() && $stmt->affected_rows == 1) {
        // La inserción se realizó correctamente
        // echo "El registro ha sido insertado correctamente en la tabla campus.";
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
                        text: \'El registro del Área de Ubicación se ha realizado con éxito\',
                        confirmButtonText: \'OK\',
                        }).then((result) => { if (result.isConfirmed) {
                            window.location.href = \'../views/area_de_ubicacion.php\';
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
                            window.location.href = "../views/area_de_ubicacion.php";
                        }
                        });
                </script>
            </body>
            </html>';

        echo $html;
    }
    
    }



// function eliminar_campus($conexion, $id_campus){
//     $sql = "DELETE
//     FROM `campus`
//     WHERE `id` = ?;";

//     $stmt = $conexion->prepare($sql);
//     if (!$stmt) {
//         die("Error de consulta: " . $conexion->error);
//     }
//     $stmt->bind_param("i", $id_campus);
//     if (!$stmt->execute()) {
//         die("Error al eliminar el campus: " . $stmt->error);
//     }  
// }

// function get_campus_id($conexion, $id_campus){
//     $sql = "SELECT
//                 `id`,
//                 `nombre`,
//                 `direccion`
//             FROM `campus`
//             WHERE `id` = ? LIMIT 1;";
//     $stmt = $conexion->prepare($sql);
//     if (!$stmt) {
//         die("Error de consulta: " . $conexion->error);
//     }
//     $stmt->bind_param("s", $id_campus);
//     $stmt->execute();
//     $resultado = $stmt->get_result();

//     $fila = $resultado->fetch_assoc();
//     return $fila;
// }

// function update_campus($conexion, $nombre, $direccion, $id_campus){
//     $sql = "UPDATE `campus`
//             SET 
//             `nombre` = ?,
//             `direccion` = ?
//             WHERE `id` = ?;";

//     $stmt = $conexion->prepare($sql);
//     if (!$stmt) {
//     die("Error de consulta: " . $conexion->error);
//     }
//     $stmt->bind_param("sss", $nombre, $direccion, $id_campus);

//     if ($stmt->execute() && $stmt->affected_rows == 1) {
    
//     // echo "El registro ha sido insertado correctamente en la tabla producto.";
//     $html = '<!DOCTYPE html>
//         <html lang="en">
//         <head>
//             <meta charset="UTF-8">
//             <meta http-equiv="X-UA-Compatible" content="IE=edge">
//             <meta name="viewport" content="width=device-width, initial-scale=1.0">
//             <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
//             <link rel="stylesheet" href="../css/normalize.css">
//             <link rel="stylesheet" href="../css/sweetalert2.css">
//             <link rel="stylesheet" href="../css/material.min.css">
//             <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
//             <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
//             <link rel="stylesheet" href="../css/main.css">
//             <link rel="stylesheet" href="../css/style.css">
        
//             <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
//             <script>window.jQuery || document.write(\'<script src="../js/jquery-1.11.2.min.js"><\\/script>\')</script>
//             <script src="../js/material.min.js" ></script>
//             <script src="../js/sweetalert2.min.js" ></script>
//             <script src="../js/jquery.mCustomScrollbar.concat.min.js" ></script>
//             <script src="../js/main.js" ></script>
//             <title>Registro Exitoso</title>
//         </head>
//         <body>
//             <script>
//                 Swal.fire({
//                     icon: \'success\',
//                     title: \'Actualización exitosa\',
//                     text: \'El campus se ha actualizado con éxito\',
//                     confirmButtonText: \'OK\',
//                     }).then((result) => { if (result.isConfirmed) {
//                         window.location.href = \'../views/campus.php\';
//                     }
//                     });
//             </script>
            
//         </body>
//         </html>';
//         echo $html;
//     } else {
//     // Hubo un error al realizar la inserción
//     // echo "Error al insertar el registro: " . $stmt->error;
//     $html = '<!DOCTYPE html>
//         <html lang="en">
//         <head>
//             <meta charset="UTF-8">
//             <meta http-equiv="X-UA-Compatible" content="IE=edge">
//             <meta name="viewport" content="width=device-width, initial-scale=1.0">
//             <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
//             <link rel="stylesheet" href="../css/normalize.css">
//             <link rel="stylesheet" href="../css/sweetalert2.css">
//             <link rel="stylesheet" href="../css/material.min.css">
//             <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
//             <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
//             <link rel="stylesheet" href="../css/main.css">
//             <link rel="stylesheet" href="../css/style.css">

//             <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
//             <script>window.jQuery || document.write(\'<script src="../js/jquery-1.11.2.min.js"><\\/script>\')</script>
//             <script src="../js/material.min.js" ></script>
//             <script src="../js/sweetalert2.min.js" ></script>
//             <script src="../js/jquery.mCustomScrollbar.concat.min.js" ></script>
//             <script src="../js/main.js" ></script>
//             <title>Error</title>
//         </head>
//         <body>
//             <script>
//                 Swal.fire({
//                     icon: "error",
//                     title: "Error",
//                     text: "Error al actualizar el registro",
//                     confirmButtonText: "OK",
//                     }).then((result) => { if (result.isConfirmed) {
//                         window.location.href = "../views/campus.php";
//                     }
//                     });
//             </script>
//         </body>
//         </html>';

//     echo $html;
//     }
// }
?>