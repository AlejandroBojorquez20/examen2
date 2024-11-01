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
    $titulo = $_POST['titulo'];
    $direccion = $_POST['direccion'];
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];
    $metrosCuadrados = $_POST['metrosCuadrados'];
    $descripcion = $_POST['descripcion'];
    
    $consulta = "INSERT INTO propiedades (id_vendedor, titulo, direccion, precio, tipo, metrosCuadrados, descripcion) 
                 VALUES ('$id_vendedor', '$titulo', '$direccion', '$precio', '$tipo', '$metrosCuadrados', '$descripcion')";
    
    if(mysqli_query($conexion, $consulta)) {
        $mensaje = "¡Propiedad registrada correctamente!";
    } else {
        $mensaje = "Error al registrar la propiedad: " . mysqli_error($conexion);
    }
}

// Obtener lista de vendedores
$consulta_vendedores = "SELECT * FROM vendedores ORDER BY apellido";
$resultado_vendedores = mysqli_query($conexion, $consulta_vendedores);
?>

<html>
<head>
    <title>Registrar Propiedad</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <p class="menu">
        <a href="registrar_vendedor.php">Registrar Vendedor</a> |
        <a href="registrar_propiedad.php">Registrar Propiedad</a> |
        <a href="registrar_venta.php">Registrar Venta</a>
    </p>

    <h1>Registrar Nueva Propiedad</h1>

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
            Título de la propiedad: <br>
            <input type="text" name="titulo" required>
        </p>

        <p>
            Dirección: <br>
            <input type="text" name="direccion" required>
        </p>

        <p>
            Precio: <br>
            <input type="text" name="precio" required>
        </p>

        <p>
            Tipo de propiedad: <br>
            <select name="tipo" required>
                <option value="">Seleccione tipo</option>
                <option value="Casa">Casa</option>
                <option value="Apartamento">Apartamento</option>
            </select>
        </p>

        <p>
            Metros cuadrados: <br>
            <input type="text" name="metrosCuadrados" required>
        </p>

        <p>
            Descripción: <br>
            <textarea name="descripcion" rows="4" cols="50" required></textarea>
        </p>

        <p>
            <input type="submit" name="enviar" value="Guardar Propiedad">
        </p>
    </form>

</body>
</html>

<?php
mysqli_close($conexion);
?>