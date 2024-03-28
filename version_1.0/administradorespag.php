<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú lateral responsive - MagtimusPro</title>

    <link rel="stylesheet" href="estilos/menu.css">

    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>
<body id="body">
    
    <header>
        <div class="icon__menu">
            <i class="fas fa-bars" id="btn_open"></i>
        </div>
    </header>

    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <img class="logo-uni" src="https://upsrj.edu.mx/wp-content/uploads/2019/06/isoheartHistoria.png">
            <h3>UPSRJ</h3>
        </div>

        <div class="options__menu">	

            <a href="#"  class="selected" onclick="mostrarIframe('1')">
                <div class="option">
                    <i class="fas fa-home" title="erfil"></i>
                    <h4>Perfil</h4>
                </div>
            </a>

            <a href="#" class="selected">
                <div class="option" id="registro">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="Registro"></i>
                    <h4>Registro</h4>
                </div>
                <!-- Sub-botones del menú "Registro" -->
                <div class="submenu" id="submenu_registro">
                    <a onclick="mostrarIframe('2')">Alumnos</a>
                    <a onclick="mostrarIframe('3')">Docentes</a>
                    <a onclick="mostrarIframe('4')">Administrativos</a>
                    <a onclick="mostrarIframe('5')">Visitantes</a>
                </div>
            </a>
            
            <a href="#"onclick="mostrarIframe('6') " class="selected">
                <div class="option">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true" title="Cursos"></i>
                    <h4>Emergencias</h4>
                </div>
            </a>

            <a href="#"onclick="mostrarIframe('7')" class="selected">
                <div class="option" >
                    <i class="fa fa-bullhorn" aria-hidden="true" title="Blog"></i>
                    <h4>Incidentes</h4>
                </div>
            </a>

            <a href="#" onclick="mostrarIframe('8')" class="selected">
                <div class="option">
                    <i class="fa fa-bar-chart" aria-hidden="true" title="Contacto"></i>
                    <h4>CMI</h4>
                </div>
            </a>

            <a href="index.php">
                <div class="option">
                    <i class="fa fa-sign-out" aria-hidden="true" title="Nosotros"></i>
                    <h4>Salir</h4>
                </div>
            </a>

        </div>

    </div>

    <main>
        <iframe id="1" width="100%" height="690px" src="usuario.php"></iframe>
        <iframe id="2" style="display: none;" width="100%" height="690px" src="registro/alumno.php"></iframe>
        <iframe id="3" style="display: none;" width="100%" height="690px" src="registro/docente.php"></iframe>
        <iframe id="4" style="display: none;" width="100%" height="690px" src="registro/administrativo.php"></iframe>
        <iframe id="5" style="display: none;" width="100%" height="690px" src="registro/visitante.php"></iframe>
        <iframe id="6" style="display: none;" width="100%" height="690px" src="emergencia.php"></iframe>
        <iframe id="7" style="display: none;" width="100%" height="690px" src="incidencia.php"></iframe>
        <iframe id="8" style="display: none;" width="100%" height="690px" src="graficos.php"></iframe>
    </main>

    <script src="codigos/script.js"></script>
    <script>
        function mostrarIframe(id) {
            // Ocultar todos los iframes
            var iframes = document.querySelectorAll('iframe');
            for (var i = 0; i < iframes.length; i++) {
                iframes[i].style.display = 'none';
            }

            // Mostrar el iframe correspondiente al ID proporcionado
            var iframeToShow = document.getElementById(id);
            if (iframeToShow) {
                iframeToShow.style.display = 'block';
            }
        }
    </script>
</body>
</html>
   