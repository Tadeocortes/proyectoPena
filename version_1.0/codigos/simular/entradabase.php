<?php     date_default_timezone_set('America/Mexico_City');
// Establecer la conexión con la base de datos
if(isset($_POST['registrarse'])) {
$conexion = new mysqli("localhost", "root", "", "basedatos2");

// Verificar si hay errores de conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
// Obtener la fecha y hora actuales
$fechaActual = date('Y-m-d');
$horaActual = date('H:i:s');
$credencial = $_POST['credencial'];
$sql = "INSERT INTO entradas (credencial, fecha, hora) VALUES ('$credencial', '$fechaActual', '$horaActual')";

// Ejecutar la consulta y verificar si fue exitosa
if ($conexion->query($sql) === TRUE) {
    echo "Datos insertados correctamente.";
} else {
    echo "Error al insertar los datos: " . $conexion->error;
}


// Cerrar la conexión con la base de datos
$conexion->close();
}   
?>
