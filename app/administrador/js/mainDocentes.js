$(document).ready(function(){
    console.log('JQUERY is working');
    
    $('#add').click(function(){  
        $('#insert').val("Insertar");  
        $('#insert_form')[0].reset();  
        $('#docente_id').val('');
        //$('#pass').prop('type','password');
   }); 


   //METODO DE INSERCCION DE SERVICIOS
   $('#insert_form').on("submit", function(event){  
    event.preventDefault();  
    if($('#docente').val() == "")  
     {  
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            
          });
          
          Toast.fire({
            type: 'error',
            title: 'El nombre del docente es requerido!'
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
            url:"app/insertDocente.php",  
                method:"POST",  
                data:$('#insert_form').serialize(),  
                beforeSend:function(){  
                        $('#insert').val("Inserting...");  
                },  
                success:function(data){
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
                                title: 'Docente Agregado Satisfactoriamente',
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
                        fetchDocentes(); 
                        $('#docente_id').val('');
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
                var docente_id = $(this).attr("id");
                console.log(docente_id);
                $.post('app/deleteDocente.php', {docente_id} , function(response) {
                    if(response  == 'OK'){
                        Swal.fire(
                            'Eliminado!',
                            'El docente Ha sido Eliminado.',
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
                    fetchDocentes();
                });
                
            }
        });
    });
    

    //METODO DE ACTUALIZACION
   $(document).on('click', '.edit_data', function(){  
        var docente_id = $(this).attr("id");
        //$('#pass').prop('type','hidden');
        console.log(docente_id);
        $.ajax({  
            url:"app/updateDocente.php",  
            method:"POST",  
            data:{docente_id:docente_id},  
            dataType:"json",  
            success:function(data){  
                //   console.log(docente_id);
                $('#docente').val(data[0].nombre);  
                $('#app').val(data[0].app);  
                $('#apm').val(data[0].apm);
                $('#user').val(data[0].usuario);
                $('#pass').val(data[0].pass);
                $('#carrera').val(data[0].idCarrera);
                $('#docente_id').val(data[0].idUsuario);  
                $('#insert').val("Update");
                $('#add_data_Modal').modal('show');  
            }  
        });  
    });


    
    
    function fetchDocentes(){
      $('.filter_data').html('<div id="loading" style="" ></div>');
      var action = 'fetchDocente';
      $.ajax({
          url: 'app/fetchDocente.php',
          method: 'POST',
          data:{action:action},
          success:function(response) {
              $('.filter_data').html(response);
          }
      })
    }
    

});