$(document).ready(function(){
    console.log('JQUERY WORKS');
    $('#formlg').submit(function(e){

        const postData = {
            user:   $('#userform').val(),
            pass:   $('#passform').val(),
            typeuser:   $('#typeuser').val()
        }
        $('#btnform').val('Procesando...');
        $.post('app/scvLogin.php',postData, function(response){
            //  console.log(response);
            const task = JSON.parse(response);
            if(task.bandera == true) {
                if (task.tipo=='Docente') {
                    location='app/docente/index.php';
                }else if (task.tipo=='Alumno') {
                    location='app/alumno/index.php';
                }else if (task.tipo=='Administrador') {
                    location='app/administrador/index.php';
                }
            } else {
                $('.error').slideDown('slow');
                  setTimeout(function(){
                  $('.error').slideUp('slow');
                },3000);
                $('#btnform').val('Iniciar Sesión');
            }
        })
        e.preventDefault();
        
    })
});