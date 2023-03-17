<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/f342bdc8ac.js" crossorigin="anonymous"></script>
    

</head>
<body>
<!-- <button class="mdl-button mdl-js-button mdl-button--icon">
    	
		<i class="fa-sharp fa-solid fa-eye"></i>
  </button> -->

  <!-- <button class="mdl-button mdl-js-button mdl-button--icon">
  <i class="fas fa-eye"></i>
</button> -->
<!-- <form action="" >
    <button type="submit" class="form-button-icon"><a href="#" class="fas fa-eye"></a></button>
</form> -->

<form action="icon.php" method="post" class="ver-detalles-eliminar">
    <button type="submit" class="form-button-icon fas fa-eye" value="6" name="hola"></button>
</form>

<form action="icon.php" method="post" class="ver-detalles-eliminar">
    <button type="submit" class="form-button-icon fas fa-eye" value="6" name="hola"></button>
</form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // $valor = $_SESSION['rol'];
        $valor = $_POST['hola'];
        echo $valor;
    }

?>

</body>
</html>