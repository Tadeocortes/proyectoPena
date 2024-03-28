<?php
// Verificar si se ha enviado el formulario
date_default_timezone_set('America/Mexico_City');
if(isset($_POST['registrarse'])) {
    // Establecer conexión con la base de datos
    $conexion = new mysqli("localhost","root","","basedatos2");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    // Preparar los datos para insertar en la base de datos
    $credencial = $_POST['credencial'];
    $nombre = $_POST['n'];
    $apellido_paterno = $_POST['ap'];
    $apellido_materno = $_POST['apellidom'];
    $genero = $_POST['gender'];
    $email = $_POST['email'];
    $tipo_sangre = $_POST['tipo_sangre'];
    $nss = $_POST['nss'];
    $vigente = isset($_POST['vigente']) ? $_POST['vigente'] : 0; // Verifica si se marcó "Si" para vigente
    $contraseña = $_POST['contraseña'];
    $tipo = "administrativo";
    $num_empleado = $_POST['num_empleado'];
    $adscripcion = $_POST['adscripcion'];

    // Preparar la sentencia SQL para insertar datos en la tabla usuarios
    $sql_usuarios = "INSERT INTO usuarios (credencial, nombre, apellido_paterno, apellido_materno, genero, email, tipo_sangre, nss, vigente, contraseña, tipo) VALUES ('$credencial', '$nombre', '$apellido_paterno', '$apellido_materno', '$genero', '$email', '$tipo_sangre', '$nss', '$vigente', '$contraseña', '$tipo')";

    // Ejecutar la sentencia SQL para insertar en la tabla usuarios
    if ($conexion->query($sql_usuarios) === TRUE) {
        // Preparar la sentencia SQL para insertar datos en la tabla docentes
        $sql_docentes = "INSERT INTO administrativos (credencial, num_empleado, adscripcion) VALUES ('$credencial', '$num_empleado', '$adscripcion')";

        // Ejecutar la sentencia SQL para insertar en la tabla docentes
        if ($conexion->query($sql_docentes) === TRUE) {
            echo "Registro exitoso";
        } else {
            // Si hay un error en la tabla docentes, eliminar el registro insertado en la tabla usuarios
            $conexion->query("DELETE FROM usuarios WHERE credencial = '$credencial'");
            echo "Error al registrar en la tabla docentes: " . $conexion->error;
        }
    } else {
        echo "Error al registrar en la tabla usuarios: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
