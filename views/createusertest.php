<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User Test</title>
</head>
<body>
    <form action="createusertest.php" method="post">
        <p>Crear Usuarios</p>
        <label for="nombres">Nombre(s)</label>
        <input type="text" id="nombres" name="nombres"><br>

        <label for="apellidos">Apellido(s)</label>
        <input type="text" id="apellidos" name="apellidos"><br>

        <label for="email">Email</label>
        <input type="email" id="email" name="email"><br>

        <label for="cedula">Cedula</label>
        <input type="text" id="cedula" name="cedula"><br>

        <label for="contrasena">Contrasena</label>
        <input type="text" id="contrasena" name="contrasena"><br>
        <input type="submit" value="Guardar">
    </form>
    <?php
        require('../php/mysqli_conexion.php');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nombre = $_POST['nombres'];
            $apellido = $_POST['apellidos'];
            $email = $_POST['email'];
            $cedula = $_POST['cedula'];
            $contrasena = $_POST['contrasena'];

            $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);
            
             $sql = "INSERT INTO `inventorioistg`.`usuario`
                        (
                            `nombre`,
                            `apellido`,
                            `cedula`,
                            `contraseña`,
                            `email`
                        )
                    VALUES 
                        (
                            ?,
                            ?,
                            ?,
                            ?,
                            ?
                        );";
            
            // Crear un objeto de consulta preparada
            $stmt = $conexion->prepare($sql);
            // Verificar si se creó correctamente la consulta preparada
            if (!$stmt) {
                die("Error de consulta: " . $conexion->error);
            }
            $stmt->bind_param("sssss", $nombre, $apellido, $cedula, $contrasena_encriptada, $email);
            $stmt->execute();

            if($stmt->affected_rows == 1){
                echo $stmt->affected_rows;
                echo "Usuario creado correctamente!";
                exit();
            }
            else{
                echo "Error al crear el usuario :c";
            }
        }          
    ?>
</body>
</html>

