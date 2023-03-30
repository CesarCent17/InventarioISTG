<?php
require('mysqli_conexion.php');
require('querys_ver_detalle.php');
require('querys_inventario.php');

session_start();
if(!isset($_SESSION['usuario'])) {
    // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
    header("Location: ../views/login.php");
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_prod = htmlspecialchars(trim($_POST['id_prod']));
        $prod = obtener_producto_por_id($conexion, $id_prod);
        $array_codigo_de_producto = obtener_array_codigo_de_producto($conexion, $id_prod);

        $nombre = $prod['nombre'];
        $descripcion = $prod['descripcion'];
        $observaciones = $prod['observaciones'];
        $campus = obtener_campus_por_id($conexion, $id_prod);
        $estado_fisico = obtener_estado_fisico($conexion, $id_prod);
        $area_de_ubicacion = obtener_ubicacion_por_id($conexion, $id_prod);
        $codigoISTG = $array_codigo_de_producto[0]['codigo'];

        $bien = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'observaciones' => $observaciones,
            'campus' => $campus,
            'estado_fisico' => $estado_fisico,
            'area_de_ubicacion' => $area_de_ubicacion,
            'codigoISTG' => $codigoISTG
        );
?>
<form id="form-bien" action="report/actas/acta.php" method="post">
  <input type="hidden" name="bien" value="<?php echo htmlspecialchars(serialize($bien)); ?>">
</form>
<script>
  document.getElementById('form-bien').submit();
</script>
<?php
    }
   
}

?>

