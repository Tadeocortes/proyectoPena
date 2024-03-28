<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="estilos/estilousuario.css">
</head>
<body>

<div class="container">
    <div class="user-info">
        <div class="user-photo"></div>
        <h2>Información del Usuario</h2>
<?php
session_start();
include('codigos/conecion_base_db.php');
$credencial= $_SESSION['credencial']; 
if(include("codigos/conecion_base_db.php")){
	$consulta="SELECT *FROM usuarios where credencial like'$credencial'";
	$resultado=mysqli_query($conex,$consulta);
	if($resultado){
		while ($row=$resultado->fetch_array()) {
            $_SESSION['credencial']=$row['credencial'];
			$nombre=$row['nombre'];
            $ap=$row['apellido_paterno'];
            $am=$row['apellido_materno'];
            $genero=$row['genero'];
            $email=$row['email'];
            $tipo_sangre=$row['tipo_sangre'];
            $nss=$row['nss'];
            $vigente=$row['vigente'];
            $tipo=$row['tipo'];
		}
	}
}
if($tipo=="alumno"){
    $consulta="SELECT *FROM alumnos where credencial like'$credencial'";
	$resultado=mysqli_query($conex,$consulta);
    while ($row=$resultado->fetch_array()) {
	if($resultado){
        $matricula=$row['matricula'];
        $grupo=$row['grupo'];
        $cuatrimestre=$row['cuatrimestre'];
        $carrera=$row['carrera'];
        $inclusion=$row['inclusion'];
        ?>
        <p><strong>matricula:</strong><?php echo $matricula?></p>
        <p><strong>Grupo:</strong><?php echo $grupo?></p>
        <p><strong>cuatrimestre:</strong><?php echo $cuatrimestre ?></p>
        <p><strong>Carrera:</strong><?php echo $carrera?></p>
        <p><strong>Inclusión:</strong><?php if($inclusion){echo "si";}else{echo"no";}?></p>
        <?php
    }
}
}else if($tipo=='docente'){
    $consulta="SELECT *FROM docentes where credencial like'$credencial'";
	$resultado=mysqli_query($conex,$consulta);
	if($resultado){
        while ($row=$resultado->fetch_array()) {
        $num_empleado=$row['num_empleado'];
        $adscripcion=$row['adscripcion'];}}
        ?>
        <p><strong>Numero de empleado:</strong><?php echo $num_empleado?></p>
        <p><strong>Adscripcion:</strong><?php echo $adscripcion?></p>
        <?php
}else if($tipo=='administrativos'){
    $consulta="SELECT *FROM administrativos where credencial like'$credencial'";
	$resultado=mysqli_query($conex,$consulta);
    while ($row=$resultado->fetch_array()) {
	if($resultado){
        $num_empleado=$row['num_empleados'];
        $adscripcion=$row['adscripcion'];
        ?>
        <p><strong>Numero de empleado:</strong><?php echo $num_empleado?></p>
        <p><strong>Adscripcion:</strong><?php echo $adscripcion?></p>
        <?php
}}}
?>
        <p><strong>Nombre:</strong><?php echo $nombre?> <?php echo $ap?> <?php echo $am?></p>
        <p><strong>Correo Electrónico:</strong><?php echo $email?></p>
        <p><strong>Genero:</strong><?php echo $genero?></p>
        <p><strong>Tipo de sangre:</strong><?php echo $tipo_sangre?></p>
        <p><strong>NSS:</strong><?php echo $nss?></p>
        <p><strong>Tipo:</strong><?php echo $tipo?></p>
        <p><strong>vigente:</strong><?php if($vigente){echo "si";}else{echo"no";}?></p>   
    </div>
    <button onclick="window.location.href='reporte/incidencias.php'"class="button1">Reportar Incidencia</button>
    <button onclick="window.location.href='reporte/emergencias.php'" class="button2">Reportar Emergencia</button>
</div>

<footer>
    <p>Universidad Politecnica de Santa Rosa.</p>
</footer>

</body>
</html>

