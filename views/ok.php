<?php
require('../php/mysqli_conexion.php');
require('../php/querys_ver_detalle.php');
echo "llegue afuera del if";



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $id = $_POST['id_prod'];
    echo "dentro del if";
    // echo "el id es: ".$id_prod;

    // $sql = "SELECT
    //             `id`,
    //             `nombre`,
    //             `descripcion`,
    //             `observaciones`,
    //             `acta_de_donacion`,
    //             `#_acta`,
    //             `año`,
    //             `id_campus`,
    //             `id_area_ubicacion`,
    //             `id_origen_del_bien`,
    //             `id_custodio`,
    //             `id_proceso_de_adquisicion`,
    //             `id_estado_de_uso`,
    //             `id_estado_fisico`
    //         FROM `inventorioistg`.`producto`
    //         WHERE `id` = ?;";
   
    // $stmt = $conexion->prepare($sql);
    // $stmt->bind_param("s", $id);
    // if (!$stmt) {
    //     die("Error de consulta: " . $conexion->error);
    // }
    // $stmt->execute();
    // $resultado = $stmt->get_result();
    // $fila = $resultado->fetch_assoc();
    // print_r($fila);

    $id_prod = $_POST['id_prod'];
	$prod = obtener_producto_por_id($conexion, $id_prod);
    print_r($prod);
    // $acta = $prod['#_acta'];
    $acta_de_donacion = $prod['acta_de_donacion'];

					echo gettype($acta_de_donacion);
					switch ($acta_de_donacion) {
						case '1':
							$acta_de_donacion = 'SI';
							break;
						case '0':
							$acta_de_donacion = 'NO';
							break;
						case NULL:
							$acta_de_donacion = '';
							break;
						default:
							$acta_de_donacion = '';
							break;
					}

    echo $acta_de_donacion;
    echo gettype(($acta_de_donacion));
    // print_r($prod);
    // echo "<script> console.log(". "Estoy aqui" ."); </script>";	
    // echo "<script> console.log(". $id_prod ."); </script>";		
 }		


?>