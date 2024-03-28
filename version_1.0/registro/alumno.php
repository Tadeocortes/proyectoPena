<?php
	include("../codigos/registrar/alumno.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Responsive Registration Form</title>
    <meta name="viewport" content="width=device-width,
      initial-scale=1.0"/>
    <link rel="stylesheet" href="../estilos/registrodocente.css" />
  </head>
  <body>
    <h1></h1>
    <div class="container">
      <h1 class="form-title">Registar alumnos</h1>
      <form method="post">
        <div class="main-user-info">
          <div class="user-input-box">
            <label for="fullName">Nombre</label>
            <input name="n" placeholder="Ingresa el nombre"/>
          </div>
          <div class="user-input-box">
            <label for="username">Apellido paterno</label>
            <input name="ap" placeholder="Ingresa el apellido paterno"/>
          </div>
          <div class="user-input-box">
            <label for="username">Apellido materno</label>
            <input name="apellidom" placeholder="Ingresa el apellido materno"/>
          </div>
                <div class="user-input-box">
            <label for="username">Credencial</label>
            <input name="credencial" placeholder="Ingresa el numero de credencial"/>
          </div>
            <div class="user-input-box">
            <label for="username">Matricula</label>
            <input name="matricula" placeholder="Ingresa matricula"/>
          </div>
            <div class="user-input-box">
            <label for="username">Grupo</label>
            <input name="grupo" placeholder="Ingresa el Grupo"/>
          </div>
            <div class="user-input-box">
            <label for="username">Cuatrimestre</label>
            <input name="cuatrimestre" placeholder="Ingresa el cuatrimestre"/>
          </div>
          <div class="user-input-box">
          <label for="username">Carrera</label>
              <select name="Carrera">
                  <option value="Software">software</option>
                  <option value="robotica">robotica</option>
                  <option value="automotriz">automotriz</option>
                  <option value="metrologia">metrologia</option>
                  <option value="animacion y efectos visuales">animacion y efectos visuales</option>
              </select>
            </div>
          <div class="user-input-box">
            <label for="email">Email</label>
            <input  name="email" placeholder="Enter Email"/>
          </div>
          <div class="user-input-box">
            <label for="phoneNumber">Numero de seguro social</label>
            <input name="nss" placeholder="Ingresa el numero de seguro social"/>
          </div>
          <div class="user-input-box">
            <label for="password">Password</label>
            <input name="contraseña" placeholder="Enter Password"/>
          </div>
      <div class="user-input-box">
  <label for="password">Tipo de sangre</label>
    <select name="tipo_sangre">
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
    </select>
</div>
        </div>
      
        <div class="gender-details-box">
          <span class="gender-title">Genero</span>
          <div class="gender-category">
            <input type="radio" name="gender" value="hombre">
            <label for="hombre">Male</label>
            <input type="radio" name="gender" value="mujer">
            <label for="mujer">Female</label>
         
          
          </div>
           <span class="gender-title">Inclusion</span>
          <div class="gender-category">
            <input type="radio" name="inclusion" value=1>
            <label for="male">Si</label>
            <input type="radio" name="inclusion" value=0>
            <label for="female">No</label>
         
          
          </div>
          <span class="gender-title">Vigente</span>
          <div class="gender-category">
            <input type="radio" name="vigente" value=1>
            <label for="male">Si</label>
            <input type="radio" name="vigente" value=0>
            <label for="female">No</label>
         
          
          </div>
          </div>
       
        <div class="form-submit-btn">
        <input type="submit" value="Registrar" name="registrarse">
        </div>
      </form>
    </div>
  </body>
</html>