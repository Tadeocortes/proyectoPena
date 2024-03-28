document.addEventListener('DOMContentLoaded', function() {
    // Eliminar la clase 'selected' de todos los enlaces
    var opcionesMenu = document.querySelectorAll('.options__menu a');
    opcionesMenu.forEach(function(opcion) {
        opcion.classList.remove('selected');
    });
    
    // Agregar la clase 'selected' al enlace de 'Perfil'
    var perfilLink = document.querySelector('.options__menu a[href="#"]');
    perfilLink.classList.add('selected');

    // Agregar event listeners para cambiar la clase 'selected' cuando se haga clic en un enlace
    opcionesMenu.forEach(function(opcion) {
        opcion.addEventListener('click', function() {
            quitarClaseSelected();
            this.classList.add('selected');
        });
    });
});

// Funcionalidad para mostrar/ocultar el submenú de "Registro"
document.getElementById('registro').addEventListener('click', function() {
    var submenu = document.getElementById('submenu_registro');
    if (submenu.style.display === 'block') {
        submenu.style.display = 'none';
    } else {
        submenu.style.display = 'block';
    }
});

// Event listener para agregar la clase "selected" al elemento de menú seleccionado
document.addEventListener('DOMContentLoaded', function() {
    var opcionesMenu = document.querySelectorAll('.options__menu .selected');
    opcionesMenu.forEach(function(opcion) {
        opcion.addEventListener('click', function() {
            quitarClaseSelected();
            this.classList.add('selected');
        });
    });
});

// Función para quitar la clase "selected" de todos los elementos del menú
function quitarClaseSelected() {
    var opcionesMenu = document.querySelectorAll('.options__menu .selected');
    opcionesMenu.forEach(function(opcion) {
        opcion.classList.remove('selected');
    });
}

//Ejecutar función en el evento click
document.getElementById("btn_open").addEventListener("click", open_close_menu);

//Declaramos variables
var side_menu = document.getElementById("menu_side");
var btn_open = document.getElementById("btn_open");
var body = document.getElementById("body");

//Evento para mostrar y ocultar menú
function open_close_menu(){
    body.classList.toggle("body_move");
    side_menu.classList.toggle("menu__side_move");
}

//Si el ancho de la página es menor a 760px, ocultará el menú al recargar la página
if (window.innerWidth < 760){
    body.classList.add("body_move");
    side_menu.classList.add("menu__side_move");
}

//Haciendo el menú responsive(adaptable)
window.addEventListener("resize", function(){
    if (window.innerWidth > 760){
        body.classList.remove("body_move");
        side_menu.classList.remove("menu__side_move");
    }

    if (window.innerWidth < 760){
        body.classList.add("body_move");
        side_menu.classList.add("menu__side_move");
    }
});

// Función para mostrar los iframes correspondientes
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
