<?php
	include("../codigos/registrar/visitante.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Formulario de Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../estilos/registrovisitantes.css" />
  </head>
  <body>
    <div class="container">
      <h1 class="form-title">Registar Visitantes</h1>
      <form method="post">
        <div class="main-user-info">
          <div class="user-input-box">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" />
          </div>
          <div class="user-input-box">
            <label for="fullName">Nombre</label>
            <input name="nombre" placeholder="Ingresa el nombre"/>
          </div>
          <div class="user-input-box">
            <label for="apellido_paterno">Apellido paterno</label>
            <input name="apellido_paterno" placeholder="Ingresa el apellido paterno"/>
          </div>
          <div class="user-input-box">
            <label for="apellido_materno">Apellido materno</label>
            <input name="apellido_materno" placeholder="Ingresa el apellido materno"/>
          </div>
          <div class="user-input-box">
            <label for="email">Email</label>
            <input  name="email" placeholder="Ingresa el correo electrónico"/>
          </div>
          <div class="user-input-box">
            <label for="entrada">Hora de entrada</label>
            <input type="time" name="entrada"/>
          </div>
          <div class="user-input-box">
            <label for="salida">Hora de salida</label>
            <input type="time" name="salida"/>
          </div>
        </div>
        <div class="form-submit-btn">
          <input type="submit" value="Registrar" name="registrarse">
        </div>
      </form>
    </div>
  </body>
</html>
