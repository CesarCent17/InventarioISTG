<?php
require('../php/mysqli_conexion.php');
require('../php/querys_inventario.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Codigos</title>
</head>
<body>
    <form action="consultar_codigo_test.php" method="post">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id">
        <button type="submit">Consultar</button>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id =  trim($_POST['id']);
            $array_codigo_de_producto = obtener_array_codigo_de_producto($conexion, $id);
            // print_r($array_codigos);
            echo '<pre>';
            print_r($array_codigo_de_producto);
            echo '</pre>';

            echo $array_codigo_de_producto[0]['codigo'].'<br>';
            if(isset($array_codigo_de_producto[1]['codigo'])){
                echo $array_codigo_de_producto[1]['codigo'];
            }
        }
    ?>
</body>
</html>