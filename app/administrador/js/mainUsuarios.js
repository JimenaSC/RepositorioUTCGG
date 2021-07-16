$(document).ready(function(){
    console.log('JQUERY is working');
    
    $('#add').click(function(){  
        $('#insert').val("Insertar");  
        $('#insert_form')[0].reset();  
        $('#administrador_id').val('');
        //$('#pass').prop('type','password');
   }); 


   //METODO DE INSERCCION DE SERVICIOS
   $('#insert_form').on("submit", function(event){  
    event.preventDefault();  
    if($('#administrador').val() == "")  
     {  
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            
          });
          
          Toast.fire({
            type: 'error',
            title: 'El nombre del administrador es requerido!'
          });
     }else if($('#app').val() == ''){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            
          });
          
          Toast.fire({
            type: 'error',
            title: 'Apellido Paterno'
          });
     }else if($('#user').val() == '' && $('#pass').val() == ''){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            
          });
          
          Toast.fire({
            type: 'error',
            title: 'Usuario y contraseña es Requerido'
          });
     }else if($('#carrera').val() == ''){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            
          });
          
          Toast.fire({
            type: 'error',
            title: 'La carrera es requerida'
          });
     }else {
        $.ajax({
            url:"app/insertUsuario.php",  
                method:"POST",  
                data:$('#insert_form').serialize(),  
                beforeSend:function(){  
                        $('#insert').val("Inserting...");  
                },  
                success:function(data){ 
                  console.log(data); 
                        if(data == 'EXIST'){
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
                            title: 'Ya hay un registro con el mismo usuario'
                          })
                        }else
                        if(data == 'OK'){
                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Administrador Agregado Satisfactoriamente',
                                showConfirmButton: false,
                                timer: 1500
                            });
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
                        $('#insert_form')[0].reset();
                        $('#add_data_Modal').modal('hide'); 
                        fetchUsuarios(); 
                        $('#administrador_id').val('');
                }
            })
        }
    });

    //METODO DE ELIMINAR LOS DATOS
   $(document).on('click', '.delete_data', function(){  
        Swal.fire({
            title: 'Estas Seguro que desea Eliminar al docente?',
            text: "No podrás revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
            if (result.value) {
                var administrador_id = $(this).attr("id");
                console.log(administrador_id);
                $.post('app/deleteUsuario.php', {administrador_id} , function(response) {
                    if(response  == 'OK'){
                        Swal.fire(
                            'Eliminado!',
                            'El Administrador Ha sido Eliminado.',
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
                    fetchUsuarios();
                });
                
            }
        });
    });
    

    //METODO DE ACTUALIZACION
   $(document).on('click', '.edit_data', function(){  
        var administrador_id = $(this).attr("id");
        //$('#pass').prop('type','hidden');
        console.log(administrador_id);
        $.ajax({  
            url:"app/updateUsuario.php",  
            method:"POST",  
            data:{administrador_id:administrador_id},  
            dataType:"json",  
            success:function(data){  
                //console.log(data);
                $('#docente').val(data[0].nombre);  
                $('#app').val(data[0].app);  
                $('#apm').val(data[0].apm);
                $('#user').val(data[0].usuario);
                $('#pass').val(data[0].pass);
                $('#carrera').val(data[0].idCarrera);
                $('#administrador_id').val(data[0].idUsuario);  
                $('#insert').val("Update");
                $('#add_data_Modal').modal('show');  
            }  
        });  
    });


    
    
    function fetchUsuarios(){
      $('.filter_data').html('<div id="loading" style="" ></div>');
      var action = 'fetchUsuario';
      $.ajax({
          url: 'app/fetchUsuario.php',
          method: 'POST',
          data:{action:action},
          success:function(response) {
              $('.filter_data').html(response);
          }
      })
    }
    

});