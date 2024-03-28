<?php
    date_default_timezone_set('America/Mexico_City');
// Establecer la conexión a la base de datos
if (!isset($_SESSION)) {
  session_start();
}
$conexion = new mysqli("localhost", "root", "", "basedatos2");
$credencial= $_SESSION['credencial']; 
// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipoEmergencia = $_POST['emergency_type'];
    $descripcion = $_POST['description'];

    // Preparar la consulta SQL para insertar los datos en la tabla reportes
    $sql_insert = "INSERT INTO reporte (credencial,emergencia,descripcion,observacion , fecha, hora, estado) VALUES ('$credencial','1','$tipoEmergencia', '$descripcion', CURDATE(), CURTIME(), 'Sin Atender')";

    // Ejecutar la consulta de inserción
    if ($conexion->query($sql_insert) === TRUE) {
        echo "Emergencia reportada exitosamente<br>";
    } else {
        echo "Error al reportar la emergencia: " . $conexion->error . "<br>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar Emergencia</title>
    <link rel="stylesheet" href="../estilos/incidenciasemergencias.css">
</head>
<body>
    <section class="container">
        <div>
            <h1>Reportar Emergencia</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="emergency_type">Tipo de Emergencia:</label>
                <select name="emergency_type" id="emergency_type">
                    <option value="incendio">Incendio</option>
                    <option value="accidente">Accidente</option>
                    <option value="robo">Robo</option>
                    <option value="salud">Emergencia de Salud</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
                <label for="description">Descripción:</label>
                <textarea name="description" id="description" rows="6" placeholder="Describe la emergencia"></textarea>
                <button type="submit">Reportar</button>
            </form>
        </div>
    </section>
</body>
</html>
<?php
// Cerrar la conexión
$conexion->close();
?>
