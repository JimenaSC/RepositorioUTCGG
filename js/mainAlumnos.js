$(document).ready(function(){
    console.log('JQUERY is working');
    

   //METODO DE INSERCCION DE SERVICIOS
   $('#formlg').on("submit", function(event){  
    event.preventDefault();  
    if($('#alumno').val() == "")  
     {  
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            
          });
          
          Toast.fire({
            type: 'error',
            title: 'El nombre del Alumno es requerido!'
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
            title: 'Apellido Paterno es requerido'
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
     }else if($('#cuatri').val() == ''){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            
          });
          
          Toast.fire({
            type: 'error',
            title: 'El cuatrimestre es requerida'
          });
     }else {
        $.ajax({
            url:"app/scvSingup.php",  
                method:"POST",  
                data:$('#formlg').serialize(),  
                beforeSend:function(){  
                  $('#btnform').val("Registrando...");  
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
                    $('#btnform').val("Registrar");  
                  }else 
                        if(data == 'OK'){
                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Registro exitoso!',
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
                              $('#btnform').val("Registrar");  
                        }
                        $('#formlg')[0].reset();

                }
            })
        }
    });


});