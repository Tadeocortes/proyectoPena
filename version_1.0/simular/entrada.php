<?php
include("codigos/entradabase.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="EntradaGeneral.css">
    <title>General</title>
</head>
<body>
    <h1>Entrada general</h1>
    <section>
        <div class="ImputTexts">
            <form method="post">
                <input type="text" name="credencial" placeholder="Credencial">
                <input type="submit" value="Registrar" name="registrarse">
            </form>
        </div>
    </section>
</body>

<script>
     // Función para mostrar el mensaje
     function mostrarMensaje() {
        alert("Gracias por pasar entrada");
    }

    // Obtener el botón por su clase
    var boton = document.querySelector(".mi-boton");

    // Agregar un evento al botón para llamar a la función mostrarMensaje cuando se haga clic
    boton.addEventListener("click", mostrarMensaje);
</script>
</html>
