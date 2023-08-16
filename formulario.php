<!DOCTYPE html>

<!-- llamamos al archivo de conexion  -->
<?php include("conexion_sis.php") ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP Y SQL SERVER</title>
    <!-- BOOTSTRAP CORE CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="col-md-8 offset-md-2">
        <h1> CRUD CON PHP Y SQL SERVER</h1>

        <!-- CREACION DEL FORMULARIO -->
        <form method="POST" action="formulario.php">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control" placeholder="Escriba su nombre"><br />
            </div>
            <div class="form-group">
                <label>Contrasena:</label>
                <input type="text" name="passw" class="form-control" placeholder="Escriba su contrasena"><br />
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" class="form-control" placeholder="Escriba su correo electronico"><br />
            </div>
            <div class="form-group">
                <input type="submit" name="insert" class="btn btn-warning" value="Insertar datos"><br />
            </div>
            <br /><br /><br />

            <!-- esto es codigo php-->
            <?php
            if (isset($_POST['insert'])) {
                $usuario = $_POST['nombre'];
                $pass = $_POST['passw'];
                $email = $_POST['email'];

                $insertar = "INSERT INTO usuarios(usuario,password, email) values('$usuario', '$pass', 'email')";
                $ejecutar = sqlsrv_query($con, $insertar);

                if ($ejecutar) {
                    echo "<h3>Insertado Correctamente</h3>";
                }
                ;

            }
            ?>

            <div class="col-md-8 col-md-offset-2">
                <table class="table table-bordered table-responsive">
                    <tr>
                        <td>ID</td>
                        <td>Usuario</td>
                        <td>Password</td>
                        <td>Email</td>
                        <td>Accion</td>
                        <td>Accion</td>
                    </tr>

                    <!-- esto es codigo php-->
                    <?php
                    $consulta = "SELECT * FROM usuarios";

                    $ejecutar = sqlsrv_query($con, $consulta);

                    $i = 0;

                    while ($fila = sqlsrv_fetch_array($ejecutar)) {
                        $id = $fila['id'];
                        $usuario = $fila['usuario'];
                        $password = $fila['password'];
                        $email = $fila['email'];
                        $i++;



                        ?>

                        <tr align="center">
                            <td><?php echo $id; ?></td>
                            <td><?php echo $usuario; ?></td>
                            <td><?php echo $password; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><a href="formulario.php?editar=<?php echo $id; ?>">Editar</a></td>
                            <td><a href="formulario.php?borrar=<?php echo $id; ?>">borrar</a></td>
                            <td></td>
                        </tr>
                    <?php } ?> <!-- cerramos el ciclo while-->
                </table>
                </div>
        </form>
    </div>
    <?php
    if(isset($_GET['editar'])){
        include("editar.php");
    }  
    ?>

<?php
if (isset($_GET['borrar'])) {
    $borrar_id = $_GET['borrar'];

    $borrar = "DELETe  FROM usuarios WHERE  id='$borrar_id'";
    $ejecutar = sqlsrv_query($con, $borrar);

    if($ejecutar){
        echo "<script>alert('Datos Eliminados')</script>";
        echo "<script>window.open('formulario.php','self')</script>";
    }

   

  


}
?>



</body>
</html>