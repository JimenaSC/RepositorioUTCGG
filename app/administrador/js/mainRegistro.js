$(document).ready(function(){
    console.log("JQUERY WORKS");
    var bandera = false;

    $('#add').click(function(){  
        $('#insert').val("Insertar");  
        $('#insert_form')[0].reset();  
        $('#update_form')[0].reset();  
        $('#repositorio_id').val('');
        //$('#pass').prop('type','password');
   }); 
   $('.edit_data').click(function(){
        $('#update_form')[0].reset();
   });
   fetchRepositorio();



    //METODO DE ACTUALIZACION
   $(document).on('click', '.view_data', function(){  
        var repositorio_id = $(this).attr("id");
        var action = 'fetchRepositorio';
        $.ajax({
            url: 'app/viewRepositorio.php',
            method: 'POST',
            data:{action:action,repositorio_id:repositorio_id},
            success:function(response) {
                $('.view_repositories').html(response);
                $('#view_files_Modal').modal('show');  
            }
        })
    });
    //METODO DE ELIMINAR LOS DATOS
   $(document).on('click', '.delete_data', function(){  
        Swal.fire({
            title: 'Estas Seguro que desea ELIMINAR el repositorio?',
            text: "No podrás revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
            if (result.value) {
                var repositorio_id = $(this).attr("id");
                console.log(repositorio_id);
                //console.log(repositorio_id);
                $.post('app/deleteRepositorio.php', {repositorio_id} , function(response) {
                    console.log(response);
                    if(response  == 'OK'){
                        Swal.fire(
                            'Eliminado!',
                            'El Repositorio Ha sido Eliminado.',
                            'success'
                            )
                    }else{
                        
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            // timerProgressBar: true,
                            onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        
                        Toast.fire({
                            type: 'error',
                            title: 'Hubo un error al hacer la consulta'
                        })
                    }
                    fetchRepositorio();
                });
                
            }
        });
    });
   
   //METODO DE ACTUALIZACION
   $(document).on('click', '.edit_data', function(){  
    var repositorio_id = $(this).attr("id");
    
    //console.log(repositorio_id);
    $.ajax({  
        url:"app/updateRepositorio.php",  
        method:"POST",  
        data:{repositorio_id:repositorio_id},  
        dataType:"json",  
        success:function(data){  
            //console.log(data);
            var suma = parseInt(data[0].version)+parseInt(1);
            //console.log(suma);
            $('.nrepositorio').val(data[0].nombre);
            $('.version').val(suma); 
            $('.descripcion').val(data[0].descripcion);  
            
            $('.tipoproyecto').val(data[0].id_proyecto);
            $('.nvlproyecto').val(data[0].nvlproyecto);
            $('.repositorio_id').val(data[0].idRepositorio);  
            $('#insert').val("Update");
            $('#add_files_Modal').modal('show');  
        }  
    });  
    });

/* 
    //CREACION DE CARPETA PRINCIPAL
    $('.make_file').on('click',function(){
        var action = 'crear';
        $.post('app/fileAlumno.php', {action} , function(response) {
            if(response == 'YA')
            {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    
                });
                  
                Toast.fire({
                    type: 'error',
                    title: 'La carpeta ya ha sido creada, por favor verificar'
                });
            }else if(response == 'NO'){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    
                });
                  
                Toast.fire({
                    type: 'error',
                    title: 'Se ha generado un error al crear la carpeta'
                });
            }else if(response == 'NEL'){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    
                });
                  
                Toast.fire({
                    type: 'error',
                    title: 'Data Base Error Found!'
                });
            }else if(response == 'OK'){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    
                });
                  
                Toast.fire({
                    type: 'success',
                    title: 'La carpeta se ha creado satisfactoriamente'
                });
                
            }else{
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    
                });
                  
                Toast.fire({
                    type: 'error',
                    title: 'Error Found, please contact with support area!'
                });
            }
            window.location.reload(true);
        });
    });

*/

    function progressBar(){
        var progreso = 0;
        var idIterval = setInterval(function(){
            // Aumento en 10 el progeso
            progreso +=1;
            $('#bar').css('width', progreso + '%');
        
            //Si llegó a 100 elimino el interval
            if(progreso == 100){
                clearInterval(idIterval);
                bandera = true;
            }
        },10);
    }

    function fetchRepositorio(){
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetchRepositorio';
        $.ajax({
            url: 'app/fetchRepositorio.php',
            method: 'POST',
            data:{action:action},
            success:function(response) {
                $('.filter_data').html(response);
            }
        })
    }
});