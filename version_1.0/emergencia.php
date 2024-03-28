<?php
date_default_timezone_set('America/Mexico_City');

// Establecer la conexión a la base de datos
session_start();
$conexion = new mysqli("localhost", "root", "", "basedatos2");
$credencial = isset($_SESSION['credencial']) ? $_SESSION['credencial'] : '';

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesar acciones de los botones
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $consecutivo = $conexion->real_escape_string($_POST['consecutivo']);
        
        if ($action == 'en_proceso') {
            $sql_update = "UPDATE reporte SET estado = 'En Proceso' WHERE consecutivo = '$consecutivo'";
        } elseif ($action == 'atendida') {
            $sql_update = "UPDATE reporte SET estado = 'Atendida' WHERE consecutivo = '$consecutivo'";
        } elseif ($action == 'eliminar') {
            $sql_delete = "DELETE FROM reporte WHERE consecutivo = '$consecutivo'";
        }

        if ($action != 'eliminar') {
            if ($conexion->query($sql_update) === TRUE) {
                echo "success";
            } else {
                echo "Error al actualizar el estado: " . $conexion->error;
            }
        } else {
            if ($conexion->query($sql_delete) === TRUE) {
                echo "success";
            } else {
                echo "Error al eliminar el reporte: " . $conexion->error;
            }
        }
        exit(); // Termina el script después de procesar la solicitud AJAX
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar Emergencia</title>
    <link rel="stylesheet" href="estilos/EmergenciaStyles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Función para procesar acciones de los botones
            $(".action-button").click(function() {
                var action = $(this).data('action');
                var consecutivo = $(this).closest('tr').data('consecutivo');

                $.ajax({
                    type: "POST",
                    url: "emergencia.php",
                    data: {
                        action: action,
                        consecutivo: consecutivo
                    },
                    success: function(response) {
                        if (response == "success") {
                            // Actualizar la fila afectada sin recargar la página
                            location.reload(); // Recargar la página para mostrar los cambios actualizados
                        } else {
                            alert(response); // Mostrar mensaje de error si la solicitud AJAX falla
                        }
                    }
                });
            });
        });
    </script>
</head>
<body>
    <section class="container">
        <div class="emergency_container">
            <table>
                <tr>
                    <th>Consecutivo</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Descripción</th>
                    <th>Observación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                <?php
                // Consultar los reportes junto con los datos del usuario correspondiente
                $sql_select = "SELECT r.consecutivo, u.nombre, u.apellido_paterno, u.apellido_materno, u.email, u.tipo, r.fecha, r.hora, r.descripcion, r.observacion, r.estado FROM reporte r INNER JOIN usuarios u ON r.credencial = u.credencial WHERE r.emergencia = '1'";
                $resultado = $conexion->query($sql_select);

                if ($resultado && $resultado->num_rows > 0) {
                    // Mostrar cada reporte con los datos del usuario en una fila en la tabla
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr data-consecutivo='" . $fila["consecutivo"] . "'>";
                        echo "<td>" . $fila["consecutivo"] . "</td>";
                        echo "<td>" . $fila["nombre"] . "</td>";
                        echo "<td>" . $fila["apellido_paterno"] . "</td>";
                        echo "<td>" . $fila["apellido_materno"] . "</td>";
                        echo "<td>" . $fila["email"] . "</td>";
                        echo "<td>" . $fila["tipo"] . "</td>";
                        echo "<td>" . $fila["fecha"] . "</td>";
                        echo "<td>" . $fila["hora"] . "</td>";
                        echo "<td>" . $fila["descripcion"] . "</td>";
                        echo "<td>" . $fila["observacion"] . "</td>";
                        echo "<td class='" . str_replace(" ", "", $fila["estado"]) . "'>" . $fila["estado"] . "</td>";
                        echo "<td>";
                        echo "<button class='action-button' data-action='en_proceso'>En Proceso</button>";
                        echo "<button class='action-button' data-action='atendida'>Atendida</button>";
                        echo "<button class='action-button' data-action='eliminar'>Eliminar</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No hay emergencias reportadas</td></tr>";
                }
                ?>
            </table>
        </div>
    </section>
</body>
</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
