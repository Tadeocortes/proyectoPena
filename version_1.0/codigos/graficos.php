<?php
include('codigos/conecion_base_db.php');
if (include("codigos/conecion_base_db.php")) {
    date_default_timezone_set('America/Mexico_City');
    $fecha_actual = date('Y-m-d');
    $consulta = "SELECT COUNT(*) AS total FROM entradas WHERE fecha = '$fecha_actual'";
    $resultado = mysqli_query($conex, $consulta);
    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        $entradasHoy = $fila['total'];
    }
    $consulta = "SELECT COUNT(*) AS total FROM salidas WHERE fecha = '$fecha_actual'";
    $resultado = mysqli_query($conex, $consulta);
    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        $salidasHoy = $fila['total'];
    }
    $personasUniversiad = $entradasHoy - $salidasHoy;
    $sql = "SELECT COUNT(*) AS cantidad_entradas FROM usuarios
        INNER JOIN entradas ON usuarios.credencial = entradas.credencial
        WHERE usuarios.tipo = 'alumno' AND  entradas.fecha like'$fecha_actual'";

    $resultado = mysqli_query($conex, $sql);
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $entradasAlumnos = $fila["cantidad_entradas"];
    }
    mysqli_free_result($resultado);
    $sql = "SELECT COUNT(*) AS cantidad_entradas FROM usuarios
        INNER JOIN entradas ON usuarios.credencial = entradas.credencial
        WHERE usuarios.tipo = 'docente' AND  entradas.fecha like'$fecha_actual'";

    $resultado = mysqli_query($conex, $sql);
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $entradasDocentes = $fila["cantidad_entradas"];
    }
    $consultaEntradasAdministrativos = "SELECT COUNT(*) AS cantidad_entradas FROM usuarios
    INNER JOIN entradas ON usuarios.credencial = entradas.credencial
    WHERE usuarios.tipo = 'administrativo' AND entradas.fecha = '$fecha_actual'";
$resultadoEntradasAdministrativos = mysqli_query($conex, $consultaEntradasAdministrativos);
if ($resultadoEntradasAdministrativos->num_rows > 0) {
$filaEntradasAdministrativos = $resultadoEntradasAdministrativos->fetch_assoc();
$entradasAdministrativos = $filaEntradasAdministrativos["cantidad_entradas"];
}
mysqli_free_result($resultadoEntradasAdministrativos);
$consultaUsuariosSangre = "SELECT tipo_sangre, COUNT(*) AS total FROM usuarios GROUP BY tipo_sangre";
$resultadoUsuariosSangre = mysqli_query($conex, $consultaUsuariosSangre);
$usuariosSangre = array();
if ($resultadoUsuariosSangre) {
    while ($filaUsuariosSangre = mysqli_fetch_assoc($resultadoUsuariosSangre)) {
        $usuariosSangre[$filaUsuariosSangre['tipo_sangre']] = $filaUsuariosSangre['total'];
    }
}
    // Consulta para obtener el total de reportes por fecha
    $consultaReportesFecha = "SELECT fecha, COUNT(*) AS total FROM reporte GROUP BY fecha";
    $resultadoReportesFecha = mysqli_query($conex, $consultaReportesFecha);
    $reportesFecha = array();
    if ($resultadoReportesFecha) {
        while ($filaReportesFecha = mysqli_fetch_assoc($resultadoReportesFecha)) {
            $reportesFecha[$filaReportesFecha['fecha']] = $filaReportesFecha['total'];
        }
    }
    mysqli_free_result($resultadoReportesFecha);
//consulta para saber cantidad de hombres hay en la universidad
$fecha_actual = date('Y-m-d');
$consulta = "SELECT COUNT(*) AS total FROM usuarios WHERE genero = 'hombre'";
$resultado = mysqli_query($conex, $consulta);
if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    $hombres = $fila['total'];
}
//consulta para saber cantidad de mujeres hay en la universidad
$fecha_actual = date('Y-m-d');
$consulta = "SELECT COUNT(*) AS total FROM usuarios WHERE genero = 'mujer'";
$resultado = mysqli_query($conex, $consulta);
if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    $mujeres = $fila['total'];
}
// Realizar la consulta para contar la cantidad de alumnos por carrera
$consultaAlumnosPorCarrera = "SELECT carrera, COUNT(*) AS total_alumnos FROM alumnos GROUP BY carrera";
$resultadoAlumnosPorCarrera = mysqli_query($conex, $consultaAlumnosPorCarrera);
$alumnosPorCarrera = array();

// Procesar los resultados de la consulta
if ($resultadoAlumnosPorCarrera) {
    while ($filaAlumnosPorCarrera = mysqli_fetch_assoc($resultadoAlumnosPorCarrera)) {
        $alumnosPorCarrera[$filaAlumnosPorCarrera['carrera']] = $filaAlumnosPorCarrera['total_alumnos'];
    }
}
}
if (isset($_POST['graficar'])) {
    if(isset($_POST['grafico1'])) {
        $grafic1 = $_POST['grafico1'];
        switch ($grafic1) {
            case 1: 
                $labelgrafic1 = "'Entrada', 'salidas', 'pendientes'";
                ?>
                <script>
                    var name1="personas en la universidad el dia <?php echo $fecha_actual?>"
                    var datosgrafic1 = [<?php echo $entradasHoy . ',' . $salidasHoy . ',' . ($entradasHoy - $salidasHoy); ?>];
                </script>
                <?php
            break;
            case 2: 
                $labelgrafic1 = "'alumnos', 'docentes', 'administrativos'";
                ?>
                <script>
                    var name1="personas en la universidad el dia <?php echo $fecha_actual?>"
                    var datosgrafic1 = [<?php echo $entradasAlumnos . ',' . $entradasDocentes . ',' . $entradasAdministrativos; ?>];
                </script>
                <?php
            break;
            case 3: 
                $labelgrafic1 = "'O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'";
                ?>
                <script>
                    var name1="Cantidad de usuarios por tipo de sangre el día <?php echo $fecha_actual?>"
                    var datosgrafic1 = [<?php echo implode(',', $usuariosSangre); ?>];
                </script>
                <?php
            break;
            case 4:
                $labelgrafic1 = "'Reportes'";
                $consultaReportesFecha = "SELECT fecha, COUNT(*) AS total FROM reporte GROUP BY fecha";
                $resultadoReportesFecha = mysqli_query($conex, $consultaReportesFecha);
                $reportesFecha = array();
                if ($resultadoReportesFecha) {
                    while ($filaReportesFecha = mysqli_fetch_assoc($resultadoReportesFecha)) {
                        $reportesFecha[$filaReportesFecha['fecha']] = $filaReportesFecha['total'];
                    }
                }
                ?>
                <script>
                    var name1 = "Total de reportes por fecha";
                    var datosgrafic1 = [<?php echo implode(',', $reportesFecha); ?>];
                </script>
                <?php
                break;
                case 5: 
                    $labelgrafic1 = "'hombres', 'mujeres'";
                    ?>
                    <script>
                        var name1="hombres y mujeres <?php echo $fecha_actual?>"
                        var datosgrafic1 = [<?php echo $hombres . ',' . $mujeres; ?>];
                    </script>
                    <?php
                break;
                case 6:
                    $consultaAlumnosPorCarrera = "SELECT carrera, COUNT(*) AS total_alumnos FROM alumnos GROUP BY carrera";
                    $resultadoAlumnosPorCarrera = mysqli_query($conex, $consultaAlumnosPorCarrera);
                    $datosgrafic1 = array();
                    $labelgrafic1 = '';
                    while ($fila = mysqli_fetch_assoc($resultadoAlumnosPorCarrera)) {
                        $labelgrafic1 .= "'" . $fila['carrera'] . "', "; // Generar etiquetas
                        $datosgrafic1[] = $fila['total_alumnos']; // Almacenar datos
                    }
                    $labelgrafic1 = rtrim($labelgrafic1, ", "); // Eliminar la última coma
                    ?>
                    <script>
                        var name1 = "Cantidad de alumnos por carrera el día <?php echo $fecha_actual?>";
                        var datosgrafic1 = [<?php echo implode(',', $datosgrafic1); ?>];
                        var labelgrafic1 = [<?php echo $labelgrafic1; ?>];
                    </script>
                    <?php
                    break;
                    case 7:
                        $consultaAlumnosPorCuatrimestre = "SELECT cuatrimestre, COUNT(*) AS total_alumnos FROM alumnos GROUP BY cuatrimestre";
                        $resultadoAlumnosPorCuatrimestre = mysqli_query($conex, $consultaAlumnosPorCuatrimestre);
                        $datosgrafic1 = array();
                        $labelgrafic1 = '';
                        while ($fila = mysqli_fetch_assoc($resultadoAlumnosPorCuatrimestre)) {
                            $labelgrafic1 .= "'" . $fila['cuatrimestre'] . "', "; // Generar etiquetas
                            $datosgrafic1[] = $fila['total_alumnos']; // Almacenar datos
                        }
                        $labelgrafic1 = rtrim($labelgrafic1, ", "); // Eliminar la última coma
                        ?>
                        <script>
                            var name1 = "Cantidad de alumnos por cuatrimestre el día <?php echo $fecha_actual?>";
                            var datosgrafic1 = [<?php echo implode(',', $datosgrafic1); ?>];
                            var labelgrafic1 = [<?php echo $labelgrafic1; ?>];
                        </script>
                        <?php
                        break;
                        case 8:
                            $consultaUsuariosPorTipo = "SELECT tipo, COUNT(*) AS total_usuarios FROM usuarios GROUP BY tipo";
                            $resultadoUsuariosPorTipo = mysqli_query($conex, $consultaUsuariosPorTipo);
                            $datosgrafic1 = array();
                            $labelgrafic1 = '';
                            while ($fila = mysqli_fetch_assoc($resultadoUsuariosPorTipo)) {
                                $labelgrafic1 .= "'" . $fila['tipo'] . "', "; // Generar etiquetas
                                $datosgrafic1[] = $fila['total_usuarios']; // Almacenar datos
                            }
                            $labelgrafic1 = rtrim($labelgrafic1, ", "); // Eliminar la última coma
                            ?>
                            <script>
                                var name1 = "UPSRJ INTEGRANTES REGISTRADOS";
                                var datosgrafic1 = [<?php echo implode(',', $datosgrafic1); ?>];
                                var labelgrafic1 = [<?php echo $labelgrafic1; ?>];
                            </script>
                            <?php
                            break;
                        
        }
    } else {
        // En caso de que 'grafico1' no esté definido en $_POST, establece un valor predeterminado
        $labelgrafic1 = "'Entradas', 'salidas', 'pendientes'";
    }
    if(isset($_POST['grafico2'])) {
        $grafic2 = $_POST['grafico2'];
        switch ($grafic2) {
            case 1: 
                $labelgrafic2 = "'Entrada', 'salidas', 'pendientes'";
                ?>
                <script>
                    var name2="personas en la universidad el dia <?php echo $fecha_actual?>"
                    var datosgrafic2 = [<?php echo $entradasHoy . ',' . $salidasHoy . ',' . ($entradasHoy - $salidasHoy); ?>];
                </script>
                <?php
            break;
            case 2: 
                $labelgrafic2 = "'alumnos', 'docentes', 'administrativos'";
                ?>
                <script>
                    var name2="personas en la universidad el dia <?php echo $fecha_actual?>"
                    var datosgrafic2 = [<?php echo $entradasAlumnos . ',' . $entradasDocentes . ',' . $entradasAdministrativos; ?>];
                </script>
                <?php
            break;
            case 3: 
                $labelgrafic2 = "'O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'";
                ?>
                <script>
                    var name2="Cantidad de usuarios por tipo de sangre el día <?php echo $fecha_actual?>"
                    var datosgrafic2 = [<?php echo implode(',', $usuariosSangre); ?>];
                </script>
                <?php
            break;
            case 4:
                $labelgrafic2 = "'Reportes'";
                $consultaReportesFecha = "SELECT fecha, COUNT(*) AS total FROM reporte GROUP BY fecha";
                $resultadoReportesFecha = mysqli_query($conex, $consultaReportesFecha);
                $reportesFecha = array();
                if ($resultadoReportesFecha) {
                    while ($filaReportesFecha = mysqli_fetch_assoc($resultadoReportesFecha)) {
                        $reportesFecha[$filaReportesFecha['fecha']] = $filaReportesFecha['total'];
                    }
                }
                ?>
                <script>
                    var name2 = "Total de reportes por fecha";
                    var datosgrafic2 = [<?php echo implode(',', $reportesFecha); ?>];
                </script>
                <?php
                break;
                case 5: 
                    $labelgrafic2 = "'hombres', 'mujeres'";
                    ?>
                    <script>
                        var name2="hombres y mujeres <?php echo $fecha_actual?>"
                        var datosgrafic2 = [<?php echo $hombres . ',' . $mujeres; ?>];
                    </script>
                    <?php
                break;
                case 6:
                    $consultaAlumnosPorCarrera = "SELECT carrera, COUNT(*) AS total_alumnos FROM alumnos GROUP BY carrera";
                    $resultadoAlumnosPorCarrera = mysqli_query($conex, $consultaAlumnosPorCarrera);
                    $datosgrafic2 = array();
                    $labelgrafic2 = '';
                    while ($fila = mysqli_fetch_assoc($resultadoAlumnosPorCarrera)) {
                        $labelgrafic2 .= "'" . $fila['carrera'] . "', "; // Generar etiquetas
                        $datosgrafic2[] = $fila['total_alumnos']; // Almacenar datos
                    }
                    $labelgrafic2 = rtrim($labelgrafic2, ", "); // Eliminar la última coma
                    ?>
                    <script>
                        var name2 = "Cantidad de alumnos por carrera el día <?php echo $fecha_actual?>";
                        var datosgrafic2 = [<?php echo implode(',', $datosgrafic2); ?>];
                        var labelgrafic2 = [<?php echo $labelgrafic2; ?>];
                    </script>
                    <?php
                    break;
                    case 7:
                        $consultaAlumnosPorCuatrimestre = "SELECT cuatrimestre, COUNT(*) AS total_alumnos FROM alumnos GROUP BY cuatrimestre";
                        $resultadoAlumnosPorCuatrimestre = mysqli_query($conex, $consultaAlumnosPorCuatrimestre);
                        $datosgrafic2 = array();
                        $labelgrafic2 = '';
                        while ($fila = mysqli_fetch_assoc($resultadoAlumnosPorCuatrimestre)) {
                            $labelgrafic2 .= "'" . $fila['cuatrimestre'] . "', "; // Generar etiquetas
                            $datosgrafic2[] = $fila['total_alumnos']; // Almacenar datos
                        }
                        $labelgrafic2 = rtrim($labelgrafic2, ", "); // Eliminar la última coma
                        ?>
                        <script>
                            var name2 = "Cantidad de alumnos por cuatrimestre el día <?php echo $fecha_actual?>";
                            var datosgrafic2 = [<?php echo implode(',', $datosgrafic2); ?>];
                            var labelgrafic2 = [<?php echo $labelgrafic2; ?>];
                        </script>
                        <?php
                        break;
                        case 8:
                            $consultaUsuariosPorTipo = "SELECT tipo, COUNT(*) AS total_usuarios FROM usuarios GROUP BY tipo";
                            $resultadoUsuariosPorTipo = mysqli_query($conex, $consultaUsuariosPorTipo);
                            $datosgrafic2 = array();
                            $labelgrafic2 = '';
                            while ($fila = mysqli_fetch_assoc($resultadoUsuariosPorTipo)) {
                                $labelgrafic2 .= "'" . $fila['tipo'] . "', "; // Generar etiquetas
                                $datosgrafic2[] = $fila['total_usuarios']; // Almacenar datos
                            }
                            $labelgrafic2 = rtrim($labelgrafic2, ", "); // Eliminar la última coma
                            ?>
                            <script>
                                var name2 = "UPSRJ INTEGRANTES REGISTRADOS";
                                var datosgrafic2 = [<?php echo implode(',', $datosgrafic2); ?>];
                                var labelgrafic2 = [<?php echo $labelgrafic2; ?>];
                            </script>
                            <?php
                            break;
                        
        }
    } else {
        // En caso de que 'grafico2' no esté definido en $_POST, establece un valor predeterminado
        $labelgrafic2 = "'Entradas', 'salidas', 'pendientes'";
    }
    if(isset($_POST['grafico3'])) {
        $grafic3 = $_POST['grafico3'];
        switch ($grafic3) {
            case 1: 
                $labelgrafic3 = "'Entrada', 'salidas', 'pendientes'";
                ?>
                <script>
                    var name3="personas en la universidad el dia <?php echo $fecha_actual?>"
                    var datosgrafic3 = [<?php echo $entradasHoy . ',' . $salidasHoy . ',' . ($entradasHoy - $salidasHoy); ?>];
                </script>
                <?php
            break;
            case 2: 
                $labelgrafic3 = "'alumnos', 'docentes', 'administrativos'";
                ?>
                <script>
                    var name3="personas en la universidad el dia <?php echo $fecha_actual?>"
                    var datosgrafic3 = [<?php echo $entradasAlumnos . ',' . $entradasDocentes . ',' . $entradasAdministrativos; ?>];
                </script>
                <?php
            break;
            case 3: 
                $labelgrafic3 = "'O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'";
                ?>
                <script>
                    var name3="Cantidad de usuarios por tipo de sangre el día <?php echo $fecha_actual?>"
                    var datosgrafic3 = [<?php echo implode(',', $usuariosSangre); ?>];
                </script>
                <?php
            break;
            case 4:
                $labelgrafic3 = "'Reportes'";
                $consultaReportesFecha = "SELECT fecha, COUNT(*) AS total FROM reporte GROUP BY fecha";
                $resultadoReportesFecha = mysqli_query($conex, $consultaReportesFecha);
                $reportesFecha = array();
                if ($resultadoReportesFecha) {
                    while ($filaReportesFecha = mysqli_fetch_assoc($resultadoReportesFecha)) {
                        $reportesFecha[$filaReportesFecha['fecha']] = $filaReportesFecha['total'];
                    }
                }
                ?>
                <script>
                    var name3 = "Total de reportes por fecha";
                    var datosgrafic3 = [<?php echo implode(',', $reportesFecha); ?>];
                </script>
                <?php
                break;
                case 5: 
                    $labelgrafic3 = "'hombres', 'mujeres'";
                    ?>
                    <script>
                        var name3="hombres y mujeres <?php echo $fecha_actual?>"
                        var datosgrafic3 = [<?php echo $hombres . ',' . $mujeres; ?>];
                    </script>
                    <?php
                break;
                case 6:
                    $consultaAlumnosPorCarrera = "SELECT carrera, COUNT(*) AS total_alumnos FROM alumnos GROUP BY carrera";
                    $resultadoAlumnosPorCarrera = mysqli_query($conex, $consultaAlumnosPorCarrera);
                    $datosgrafic3 = array();
                    $labelgrafic3 = '';
                    while ($fila = mysqli_fetch_assoc($resultadoAlumnosPorCarrera)) {
                        $labelgrafic3 .= "'" . $fila['carrera'] . "', "; // Generar etiquetas
                        $datosgrafic3[] = $fila['total_alumnos']; // Almacenar datos
                    }
                    $labelgrafic3 = rtrim($labelgrafic3, ", "); // Eliminar la última coma
                    ?>
                    <script>
                        var name3 = "Cantidad de alumnos por carrera el día <?php echo $fecha_actual?>";
                        var datosgrafic3 = [<?php echo implode(',', $datosgrafic3); ?>];
                        var labelgrafic3 = [<?php echo $labelgrafic3; ?>];
                    </script>
                    <?php
                    break;
                    case 7:
                        $consultaAlumnosPorCuatrimestre = "SELECT cuatrimestre, COUNT(*) AS total_alumnos FROM alumnos GROUP BY cuatrimestre";
                        $resultadoAlumnosPorCuatrimestre = mysqli_query($conex, $consultaAlumnosPorCuatrimestre);
                        $datosgrafic3 = array();
                        $labelgrafic3 = '';
                        while ($fila = mysqli_fetch_assoc($resultadoAlumnosPorCuatrimestre)) {
                            $labelgrafic3 .= "'" . $fila['cuatrimestre'] . "', "; // Generar etiquetas
                            $datosgrafic3[] = $fila['total_alumnos']; // Almacenar datos
                        }
                        $labelgrafic3 = rtrim($labelgrafic3, ", "); // Eliminar la última coma
                        ?>
                        <script>
                            var name3 = "Cantidad de alumnos por cuatrimestre el día <?php echo $fecha_actual?>";
                            var datosgrafic3 = [<?php echo implode(',', $datosgrafic3); ?>];
                            var labelgrafic3 = [<?php echo $labelgrafic3; ?>];
                        </script>
                        <?php
                        break;
                        case 8:
                            $consultaUsuariosPorTipo = "SELECT tipo, COUNT(*) AS total_usuarios FROM usuarios GROUP BY tipo";
                            $resultadoUsuariosPorTipo = mysqli_query($conex, $consultaUsuariosPorTipo);
                            $datosgrafic3 = array();
                            $labelgrafic3 = '';
                            while ($fila = mysqli_fetch_assoc($resultadoUsuariosPorTipo)) {
                                $labelgrafic3 .= "'" . $fila['tipo'] . "', "; // Generar etiquetas
                                $datosgrafic3[] = $fila['total_usuarios']; // Almacenar datos
                            }
                            $labelgrafic3 = rtrim($labelgrafic3, ", "); // Eliminar la última coma
                            ?>
                            <script>
                                var name3 = "UPSRJ INTEGRANTES REGISTRADOS";
                                var datosgrafic3 = [<?php echo implode(',', $datosgrafic3); ?>];
                                var labelgrafic3 = [<?php echo $labelgrafic3; ?>];
                            </script>
                            <?php
                            break;
                        
        }
    } else {
        // En caso de que 'grafico3' no esté definido en $_POST, establece un valor predeterminado
        $labelgrafic3 = "'Entradas', 'salidas', 'pendientes'";
    }
    if(isset($_POST['grafico4'])) {
        $grafic4 = $_POST['grafico4'];
        switch ($grafic4) {
            case 1: 
                $labelgrafic4 = "'Entrada', 'salidas', 'pendientes'";
                ?>
                <script>
                    var name4="personas en la universidad el dia <?php echo $fecha_actual?>"
                    var datosgrafic4 = [<?php echo $entradasHoy . ',' . $salidasHoy . ',' . ($entradasHoy - $salidasHoy); ?>];
                </script>
                <?php
            break;
            case 2: 
                $labelgrafic4 = "'alumnos', 'docentes', 'administrativos'";
                ?>
                <script>
                    var name4="personas en la universidad el dia <?php echo $fecha_actual?>"
                    var datosgrafic4 = [<?php echo $entradasAlumnos . ',' . $entradasDocentes . ',' . $entradasAdministrativos; ?>];
                </script>
                <?php
            break;
            case 3: 
                $labelgrafic4 = "'O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'";
                ?>
                <script>
                    var name4="Cantidad de usuarios por tipo de sangre el día <?php echo $fecha_actual?>"
                    var datosgrafic4 = [<?php echo implode(',', $usuariosSangre); ?>];
                </script>
                <?php
            break;
            case 4:
                $labelgrafic4 = "'Reportes'";
                $consultaReportesFecha = "SELECT fecha, COUNT(*) AS total FROM reporte GROUP BY fecha";
                $resultadoReportesFecha = mysqli_query($conex, $consultaReportesFecha);
                $reportesFecha = array();
                if ($resultadoReportesFecha) {
                    while ($filaReportesFecha = mysqli_fetch_assoc($resultadoReportesFecha)) {
                        $reportesFecha[$filaReportesFecha['fecha']] = $filaReportesFecha['total'];
                    }
                }
                ?>
                <script>
                    var name4 = "Total de reportes por fecha";
                    var datosgrafic4 = [<?php echo implode(',', $reportesFecha); ?>];
                </script>
                <?php
                break;
                case 5: 
                    $labelgrafic4 = "'hombres', 'mujeres'";
                    ?>
                    <script>
                        var name4="hombres y mujeres <?php echo $fecha_actual?>"
                        var datosgrafic4 = [<?php echo $hombres . ',' . $mujeres; ?>];
                    </script>
                    <?php
                break;
                case 6:
                    $consultaAlumnosPorCarrera = "SELECT carrera, COUNT(*) AS total_alumnos FROM alumnos GROUP BY carrera";
                    $resultadoAlumnosPorCarrera = mysqli_query($conex, $consultaAlumnosPorCarrera);
                    $datosgrafic4 = array();
                    $labelgrafic4 = '';
                    while ($fila = mysqli_fetch_assoc($resultadoAlumnosPorCarrera)) {
                        $labelgrafic4 .= "'" . $fila['carrera'] . "', "; // Generar etiquetas
                        $datosgrafic4[] = $fila['total_alumnos']; // Almacenar datos
                    }
                    $labelgrafic4 = rtrim($labelgrafic4, ", "); // Eliminar la última coma
                    ?>
                    <script>
                        var name4 = "Cantidad de alumnos por carrera el día <?php echo $fecha_actual?>";
                        var datosgrafic4 = [<?php echo implode(',', $datosgrafic4); ?>];
                        var labelgrafic4 = [<?php echo $labelgrafic4; ?>];
                    </script>
                    <?php
                    break;
                    case 7:
                        $consultaAlumnosPorCuatrimestre = "SELECT cuatrimestre, COUNT(*) AS total_alumnos FROM alumnos GROUP BY cuatrimestre";
                        $resultadoAlumnosPorCuatrimestre = mysqli_query($conex, $consultaAlumnosPorCuatrimestre);
                        $datosgrafic4 = array();
                        $labelgrafic4 = '';
                        while ($fila = mysqli_fetch_assoc($resultadoAlumnosPorCuatrimestre)) {
                            $labelgrafic4 .= "'" . $fila['cuatrimestre'] . "', "; // Generar etiquetas
                            $datosgrafic4[] = $fila['total_alumnos']; // Almacenar datos
                        }
                        $labelgrafic4 = rtrim($labelgrafic4, ", "); // Eliminar la última coma
                        ?>
                        <script>
                            var name4 = "Cantidad de alumnos por cuatrimestre el día <?php echo $fecha_actual?>";
                            var datosgrafic4 = [<?php echo implode(',', $datosgrafic4); ?>];
                            var labelgrafic4 = [<?php echo $labelgrafic4; ?>];
                        </script>
                        <?php
                        break;
                        case 8:
                            $consultaUsuariosPorTipo = "SELECT tipo, COUNT(*) AS total_usuarios FROM usuarios GROUP BY tipo";
                            $resultadoUsuariosPorTipo = mysqli_query($conex, $consultaUsuariosPorTipo);
                            $datosgrafic4 = array();
                            $labelgrafic4 = '';
                            while ($fila = mysqli_fetch_assoc($resultadoUsuariosPorTipo)) {
                                $labelgrafic4 .= "'" . $fila['tipo'] . "', "; // Generar etiquetas
                                $datosgrafic4[] = $fila['total_usuarios']; // Almacenar datos
                            }
                            $labelgrafic4 = rtrim($labelgrafic4, ", "); // Eliminar la última coma
                            ?>
                            <script>
                                var name4 = "UPSRJ INTEGRANTES REGISTRADOS";
                                var datosgrafic4 = [<?php echo implode(',', $datosgrafic4); ?>];
                                var labelgrafic4 = [<?php echo $labelgrafic4; ?>];
                            </script>
                            <?php
                            break;
                        
        }
    } else {
        // En caso de que 'grafico4' no esté definido en $_POST, establece un valor predeterminado
        $labelgrafic4 = "'Entradas', 'salidas', 'pendientes'";
    }

}

?>