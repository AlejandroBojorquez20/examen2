<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "propiedadesVendidas");

if (!$conexion) {
    echo "Error en la conexión: " . mysqli_connect_error();
    exit;
}

// Verificar el envio del formulario
if(isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    
    $consulta = "INSERT INTO vendedores (nombre, apellido, email, telefono) 
                 VALUES ('$nombre', '$apellido', '$email', '$telefono')";
    
    if(mysqli_query($conexion, $consulta)) {
        $mensaje = "¡Vendedor registrado correctamente!";
    } else {
        $mensaje = "Error al registrar el vendedor: " . mysqli_error($conexion);
    }
}
?>

<html>
<head>
    <title>Registrar Vendedor</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <p class="menu">
        <a href="registrar_vendedor.php">Registrar Vendedor</a> |
        <a href="registrar_propiedad.php">Registrar Propiedad</a> |
        <a href="registrar_venta.php">Registrar Venta</a>
    </p>

    <h1>Registrar Nuevo Vendedor</h1>

    <?php
    if(isset($mensaje)) {
        echo "<p><b>$mensaje</b></p>";
    }
    ?>

    <form method="POST" action="">
        <p>
            Nombre: <br>
            <input type="text" name="nombre" required>
        </p>

        <p>
            Apellido: <br>
            <input type="text" name="apellido" required>
        </p>

        <p>
            Email: <br>
            <input type="email" name="email" required>
        </p>

        <p>
            Teléfono: <br>
            <input type="text" name="telefono" required>
        </p>

        <p>
            <input type="submit" name="enviar" value="Guardar Vendedor">
        </p>
    </form>

</body>
</html>