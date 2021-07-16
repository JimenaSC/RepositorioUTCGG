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
   fetchVersiones();



    //METODO DE ACTUALIZACION
   $(document).on('click', '.view_data', function(){  
        var repositorio_id = $(this).attr("id");
        console.log(repositorio_id);
        var action = 'viewVersiones';
        $.ajax({
            url: 'app/viewVersiones.php',
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
                    fetchVersiones();
                });
                
            }
        });
    });


    function fetchVersiones(){
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetchVersiones';
        $.ajax({
            url: 'app/fetchVersiones.php',
            method: 'POST',
            data:{action:action},
            success:function(response) {
                $('.filter_data').html(response);
            }
        })
    }
});