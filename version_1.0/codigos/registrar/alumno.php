<?php     date_default_timezone_set('America/Mexico_City');
// Verificar si se ha enviado el formulario
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
    $vigente = $_POST['vigente'];
    $contraseña = $_POST['contraseña'];
    $tipo = "alumno";
    $matricula = $_POST['matricula'];
    $inclusion = $_POST['inclusion'];
    $grupo = $_POST['grupo'];
    $cuatrimestre = $_POST['cuatrimestre'];
    $carrera = $_POST['Carrera'];

    // Preparar la sentencia SQL para insertar datos en la tabla usuarios
    $sql_usuarios = "INSERT INTO usuarios (credencial, nombre, apellido_paterno, apellido_materno, genero, email, tipo_sangre, nss, vigente, contraseña, tipo) VALUES ('$credencial', '$nombre', '$apellido_paterno', '$apellido_materno', '$genero', '$email', '$tipo_sangre', '$nss', '$vigente', '$contraseña', '$tipo')";

    // Ejecutar la sentencia SQL para insertar en la tabla usuarios
    if ($conexion->query($sql_usuarios) === TRUE) {
        // Preparar la sentencia SQL para insertar datos en la tabla alumnos
        $sql_alumnos = "INSERT INTO alumnos (credencial, matricula, inclusion, grupo, cuatrimestre, carrera) VALUES ('$credencial', '$matricula', '$inclusion', '$grupo', '$cuatrimestre', '$carrera')";

        // Ejecutar la sentencia SQL para insertar en la tabla alumnos
        if ($conexion->query($sql_alumnos) === TRUE) {
            echo "Registro exitoso";
        } else {
            // Eliminar el registro insertado en la tabla usuarios si hay un error en la tabla alumnos
            $conexion->query("DELETE FROM usuarios WHERE credencial = '$credencial'");
            echo "Error al registrar en la tabla alumnos: " . $conexion->error;
        }
    } else {
        echo "Error al registrar en la tabla usuarios: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
