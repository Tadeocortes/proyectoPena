<?php
if(isset($_POST['registrarse'])) {
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "basedatos2");
    
    // Verificar la conexión
    if($conexion === false){
        die("ERROR: No se pudo conectar. " . mysqli_connect_error());
    }
    
    // Recuperar los datos del formulario
    $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $apellido_paterno = mysqli_real_escape_string($conexion, $_POST['apellido_paterno']);
    $apellido_materno = mysqli_real_escape_string($conexion, $_POST['apellido_materno']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $entrada = mysqli_real_escape_string($conexion, $_POST['entrada']);
    $salida = mysqli_real_escape_string($conexion, $_POST['salida']);
    
    // Query para insertar datos en la tabla
    $query = "INSERT INTO visitantes (fecha, nombre, apellido_paterno, apellido_materno, email, entrada, salida) VALUES ('$fecha', '$nombre', '$apellido_paterno', '$apellido_materno', '$email', '$entrada', '$salida')";
    
    // Ejecutar el query
    if(mysqli_query($conexion, $query)){
        echo "Registro exitoso.";
    } else{
        echo "ERROR: No se pudo ejecutar $query. " . mysqli_error($conexion);
    }
    
    // Cerrar la conexión
    mysqli_close($conexion);
}
?>
