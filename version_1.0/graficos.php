<?php include('codigos/graficos.php');?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cuadro de mando Integral</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="estilos/grafico.css" />
</head>
<body>
<div class="encabezado">
<h1>cantidad de personas en la universidad<?php echo$personasUniversiad?>  </h1>
<h1>Cantidad de alumnos que ha entrado<?php echo$entradasDocentes?>  </h1>
</div>


<div class="containerg">
<div class="containerg">
<div class="flex-container">
    <div class="container">
        <div class="grafico">
            <canvas id="graficoBarras1" class="grafico"></canvas>
        </div>
        <div class="grafico">
            <canvas id="graficoBarras2" class="grafico"></canvas>
        </div>
    </div>
    <div class="container">
        <div class="grafico">
            <canvas id="graficoBarras3" class="grafico"></canvas>
        </div>
        <div class="graficopastel">
            <canvas id="graficoPastel" class="grafico"></canvas>
        </div>
    </div>
</div>
<div class="containerg">
    <div class="formulario">
    
        <h2>Formulario</h2>
    <form method='post'>
        <input type="date" id="fechaRegistro" placeholder="Fecha de Registro">


        <select name="grafico1">
            <option value="1">entradas/salidas/pendientes</option>
            <option value="3">tipo de sangre</option>
            <option value="2">personas en la universidad</option>
            <option value="4">total de reportes</option>
            <option value="5">hombres y mujeres</option>
            <option value="6">CARRERA</option>
            <option value="7">CUATRIMESTRE</option>
            <option value="8">UPSRJ</option>
        </select>

        <select name="grafico2">
        <option value="1">entradas/salidas/pendientes</option>
            <option value="3">tipo de sangre</option>
            <option value="2">personas en la universidad</option>
            <option value="4">total de reportes</option>
            <option value="5">hombres y mujeres</option>
            <option value="6">CARRERA</option>
            <option value="7">CUATRIMESTRE</option>
            <option value="8">UPSRJ</option>
        </select>

        <select name="grafico3">
        <option value="1">entradas/salidas/pendientes</option>
            <option value="3">tipo de sangre</option>
            <option value="2">personas en la universidad</option>
            <option value="4">total de reportes</option>
            <option value="5">hombres y mujeres</option>
            <option value="6">CARRERA</option>
            <option value="7">CUATRIMESTRE</option>
            <option value="8">UPSRJ</option>
        </select>

        <select name="grafico4">
        <option value="1">entradas/salidas/pendientes</option>
            <option value="3">tipo de sangre</option>
            <option value="2">personas en la universidad</option>
            <option value="4">total de reportes</option>
            <option value="5">hombres y mujeres</option>
            <option value="6">CARRERA</option>
            <option value="7">CUATRIMESTRE</option>
            <option value="8">UPSRJ</option>
        </select>
        <input class="button" type="submit" value="graficar" name="graficar">
        </form>
    </div>
</div>
</div>
</div>
</body>
<script>
// Funciones para generar datos aleatorios
function generarDatosAleatorios(cantidad) {
    var datos = [];
    for (var i = 0; i < cantidad; i++) {
        datos.push(Math.floor(Math.random() * 100) + 1); // Números aleatorios entre 1 y 100
    }
    return datos;
}


// Configuración de gráficos de barras
var ctx1 = document.getElementById('graficoBarras1').getContext('2d');
var ctx2 = document.getElementById('graficoBarras2').getContext('2d');
var ctx3 = document.getElementById('graficoBarras3').getContext('2d');
var ctxPastel = document.getElementById('graficoPastel').getContext('2d');


var graficoBarras1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: [<?php echo $labelgrafic1; ?>],
        datasets: [{
            label: name1,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            data:  datosgrafic1,
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


var graficoBarras2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: [<?php echo $labelgrafic2; ?>],
        datasets: [{
            label: name2,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            data: datosgrafic2,
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


var graficoBarras3 = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels:[<?php echo $labelgrafic3; ?>],
        datasets: [{
            label: name3,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            data: datosgrafic3
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
// Configuración del gráfico de pastel
var graficoPastel = new Chart(ctxPastel, {
    type: 'pie',
    data: {
        labels: [<?php echo $labelgrafic4; ?>],
        datasets: [{
            label: name4,
            backgroundColor: ['red', 'blue', 'green', 'yellow', 'orange', 'purple', 'cyan', 'magenta', 'lime', 'teal', 'pink', 'indigo', 'brown', 'gray', 'black'],
            borderColor: 'rgba(255, 255, 255, 1)',
            borderWidth: 1,
            data: datosgrafic4
        }]
    },
    options: {
        responsive: true
    }
});
</script>
</head>
</html>