<?php
$servername = "localhost";
$user = "root";
$password = "";
$database = "propiedadesVendidas";


$conexion = mysqli_connect($servername, $user, $password, $database);

if (!$conexion) {
    die("Error al conectar: " . mysqli_connect_error());
}
echo "Conexion exitosa";
mysqli_close($conexion);
?>