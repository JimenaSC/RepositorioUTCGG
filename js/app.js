function cambiarClase() {
    let siteNav = document.getElementById('site-nav');
    siteNav.classList.toggle('site-nav-open');
    let menuOpen = document.getElementById('menu-toggle');
    menuOpen.classList.toggle('menu-open');

}



// window.onload = function() {
//     window.location.hash = "no-back-button";
//     window.location.hash = "Again-No-back-button" //chrome

//     window.onhashchange = function() {
//         window.location.hash = "no-back-button";
//     }

// }

//Código para Datables



//$('#example').DataTable(); //Para inicializar datatables de la manera más simple



$(document).ready(function() {

    $('#example').DataTable({

        //para cambiar el lenguaje a español

        "language": {

            "lengthMenu": "Mostrar _MENU_ registros",

            "zeroRecords": "No se encontraron resultados",

            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",

            "infoFiltered": "(filtrado de un total de _MAX_ registros)",

            "sSearch": "Buscar:",

            "oPaginate": {

                "sFirst": "Primero",

                "sLast": "Último",

                "sNext": "Siguiente",

                "sPrevious": "Anterior"

            },

            "sProcessing": "Procesando...",

        }

    });

});

$(document).ready(function() {
    $('#example').DataTable();
});





$(document).ready(function() {

    $('#versiones').DataTable({

        //para cambiar el lenguaje a español

        "language": {

            "lengthMenu": "Mostrar _MENU_ registros",

            "zeroRecords": "No se encontraron resultados",

            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",

            "infoFiltered": "(filtrado de un total de _MAX_ registros)",

            "sSearch": "Buscar:",

            "oPaginate": {

                "sFirst": "Primero",

                "sLast": "Último",

                "sNext": "Siguiente",

                "sPrevious": "Anterior"

            },

            "sProcessing": "Procesando...",

        }

    });

});
$(document).ready(function() {
    $('#versiones').DataTable();
});

// scrip para la interaccion con elemento selectbox

const select = document.querySelector('#select');
const opciones = document.querySelector('#opciones');
const contenidoSelect = document.querySelector('#select .contenido-select');
const hiddenInput = document.querySelector('#inputSelect');

document.querySelectorAll('#opciones > .opcion').forEach((opcion) => {
    opcion.addEventListener('click', (e) => {
        e.preventDefault();
        contenidoSelect.innerHTML = e.currentTarget.innerHTML;
        select.classList.toggle('active');
        opciones.classList.toggle('active');
        hiddenInput.value = e.currentTarget.querySelector('.titulo').innerHTML;

    });

});



select.addEventListener('click', () => {
    select.classList.toggle('active');
    opciones.classList.toggle('active');

});