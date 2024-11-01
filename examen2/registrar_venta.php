<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "propiedadesVendidas");

if (!$conexion) {
    echo "Error en la conexión: " . mysqli_connect_error();
    exit;
}

// Verificar el envio del formulario
if(isset($_POST['enviar'])) {
    $id_vendedor = $_POST['id_vendedor'];
    $id_propiedad = $_POST['id_propiedad'];
    $fecha_venta = $_POST['fecha_venta'];
    
    // Insertar la venta en la tabla ventas
    $consulta = "INSERT INTO ventas (id_vendedor, id_propiedad, fecha_venta) 
                 VALUES ('$id_vendedor', '$id_propiedad', '$fecha_venta')";
    
    if(mysqli_query($conexion, $consulta)) {
        // Actualización del estado de la propiedad a "vendida"
        $actualizar = "UPDATE propiedades SET estado = 'vendida' WHERE id_propiedad = '$id_propiedad'";
        mysqli_query($conexion, $actualizar);
        $mensaje = "¡Venta registrada correctamente!";
    } else {
        $mensaje = "Error al registrar la venta: " . mysqli_error($conexion);
    }
}

// Obtener lista de vendedores
$consulta_vendedores = "SELECT * FROM vendedores ORDER BY apellido";
$resultado_vendedores = mysqli_query($conexion, $consulta_vendedores);

// Obtener lista de propiedades disponibles
$consulta_propiedades = "SELECT * FROM propiedades WHERE estado = 'disponible'";
$resultado_propiedades = mysqli_query($conexion, $consulta_propiedades);
?>

<html>
<head>
    <title>Registrar Venta</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <p class="menu">
        <a href="registrar_vendedor.php">Registrar Vendedor</a> |
        <a href="registrar_propiedad.php">Registrar Propiedad</a> |
        <a href="registrar_venta.php">Registrar Venta</a>
    </p>

    <h1>Registrar Nueva Venta</h1>

    <?php
    if(isset($mensaje)) {
        echo "<p><b>$mensaje</b></p>";
    }
    ?>

    <form method="POST" action="">
        <p>
            Vendedor: <br>
            <select name="id_vendedor" required>
                <option value="">Seleccione un vendedor</option>
                <?php
                while($vendedor = mysqli_fetch_array($resultado_vendedores)) {
                    echo "<option value='" . $vendedor['id_vendedor'] . "'>" . 
                         $vendedor['nombre'] . " " . $vendedor['apellido'] . 
                         "</option>";
                }
                ?>
            </select>
        </p>

        <p>
            Propiedad: <br>
            <select name="id_propiedad" required>
                <option value="">Seleccione una propiedad</option>
                <?php
                while($propiedad = mysqli_fetch_array($resultado_propiedades)) {
                    echo "<option value='" . $propiedad['id_propiedad'] . "'>" . 
                         $propiedad['titulo'] . " - " . $propiedad['direccion'] . 
                         " ($" . $propiedad['precio'] . ")" .
                         "</option>";
                }
                ?>
            </select>
        </p>

        <p>
            Fecha de venta (yyyy-mm-dd): <br>
            <input type="text" name="fecha_venta" required>
        </p>

        <p>
            <input type="submit" name="enviar" value="Registrar Venta">
        </p>
    </form>

</body>
</html>

<?php
mysqli_close($conexion);
?>