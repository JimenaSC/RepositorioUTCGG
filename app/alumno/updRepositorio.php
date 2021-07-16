<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<script src="../../js/jquery.js"></script>
<script src="js/sweetalert.js"></script>
</body>
</html>
<?php
    require('../conexion.php');
    session_start();

    if(!isset($_SESSION["idUsuario"])){
        header("Location: ../welcome.php");
    }

    $idUsuario = $_SESSION['idUsuario'];
    //VERIFICAR SI ESTA LA CARPETA DEL USUARIO
    $idUsuario = $_SESSION['idUsuario'];
    $Sql = $pdo->prepare("SELECT * FROM alumnos WHERE idUsuario = :id");
    $Sql->execute(array(
        "id"    =>  $idUsuario
    ));
    //TRAER LOS DATOS QUE SE NECESITAN PARA VERIFICAR SI EXISTE UNA CARPETA CON EL NOMBRE
    $row = $Sql->fetch(PDO::FETCH_ASSOC);
    $usuario = $row['usuario'];
    $ruta = '../repositorios/';
    //Vamos a concatenar los argumentos que necesito para la creacion correcta
    $pathUser = $ruta.''.$usuario;

    //Traemos los POST normales
    $nameRepositories   =   $_POST['nrepositorio'];

    $idRepositorio      =   $_POST['repositorio_id'];
    
    $version            =   $_POST['version'];

    $comment            =   $_POST['commit'];

    //Creamos una ruta para crear carpetas de los nombres de los repositorios
    $pathRepositorio = $pathUser.'/'.$nameRepositories;
    $pathVersion = $pathRepositorio.'/version'.$version;

    //Recepcion de Archivos de systema
    $systemName =   strtolower($_FILES['fsistema']['name']);    $systemFile =   $_FILES['fsistema']['tmp_name'];
	$systemSize =   $_FILES['fsistema']['size'];                $systemType =   $_FILES['fsistema']['type'];
    $PathSystem =   $pathVersion."/".$systemName;
    
    //Recepcion de archivos de M_Tecnico
    $tecnicoName =   strtolower($_FILES['mtecnico']['name']);   $tecnicoFile =   $_FILES['mtecnico']['tmp_name'];
	$tecnicoSize =   $_FILES['mtecnico']['size'];               $tecnicoType =   $_FILES['mtecnico']['type'];
    $Pathtecnico =   $pathVersion."/".$tecnicoName;
    
    //Recepcion de archivos de M_usuario //Convertimos el nombre en minusculas todo
    $usuarioName =   strtolower($_FILES['musuario']['name']);   $usuarioFile =   $_FILES['musuario']['tmp_name'];
	$usuarioSize =   $_FILES['musuario']['size'];               $usuarioType =   $_FILES['musuario']['type'];
    $Pathusuario =   $pathVersion."/".$usuarioName;
    
    //RECEPCION DE ARCHIVOS CORRECTOS
    /*echo 10*MB."----------102662-----<br>";
    echo $systemFile . '<br>' . $systemName. '<br>' .$systemSize. '<br>' .$systemType. '<br>' . $PathSystem .'<br>';
    echo"-------------------------------------------- <br>";
    echo $tecnicoFile . '<br>' . $tecnicoName. '<br>' .$tecnicoSize. '<br>' .$tecnicoType. '<br>' . $Pathtecnico .'<br>';
    echo"-------------------------------------------- <br>";
    echo $usuarioFile . '<br>' . $usuarioName. '<br>' .$usuarioSize. '<br>' .$usuarioType. '<br>' . $Pathusuario .'<br>';
    */    

    //Preparación de valoores para subir los archivos
    
    try {
        if($systemSize < 105124962){
            if($systemType == 'application/x-zip-compressed' || $systemType == 'application/octet-stream'){
                if($tecnicoType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $tecnicoType == 'application/msword' || $tecnicoType == 'application/pdf'){
                    if($usuarioType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $usuarioType == 'application/msword' || $usuarioType == 'application/pdf'){
                        if(file_exists($pathUser)){
                            if(file_exists($pathRepositorio)){
                                if(mkdir($pathVersion, 0777, true)){
                                    if(move_uploaded_file($systemFile, $PathSystem)){
                                        move_uploaded_file($tecnicoFile, $Pathtecnico);
                                        move_uploaded_file($usuarioFile, $Pathusuario);
                                        //CREAMOS EL QUERY DESPUES DE PASAR TODOS LOS ARCHIVOS Y DEJARLOS EN EL SERVIDOR
                                        $sql = $pdo->prepare("UPDATE repositorios SET
                                        filesystem  =   :filesystem,
                                        mtecnico    =   :mtecnico,
                                        musuario    =   :musuario,
                                        version     =   :version,
                                        usermodify  =   :usermodify,
                                        comment     =   :comment
                                        WHERE idRepositorio =   :idRepositorio ");
                                        
                                        //REALIZAR EL QUERY Y SUBIR A LA BD
                                        $resultado = $sql->execute(array(
                                            "filesystem"    =>  $PathSystem,
                                            "mtecnico"      =>  $Pathtecnico,
                                            "musuario"      =>  $Pathusuario,
                                            "version"       =>  $version,
                                            "idRepositorio" =>  $idRepositorio,
                                            "usermodify"    =>  $usuario,
                                            "comment"       =>  $comment
                                        ));

                                        if($resultado){
                                            echo "<script>
                                            Swal.fire({
                                                position: 'center',
                                                type: 'success',
                                                title: 'Repositorio Actualizado Satisfactoriamente',
                                                showConfirmButton: false,
                                                timer: 1500
                                            });
                                            
                                            </script>";
                                            
                                            sleep(1);
                                            header("Location: registroRepositorio.php");
    
                                        }else{
                                            
                                            
                                            
                                            echo "<script>
                                            alert('Ha habido un error para subir el archivo');
                                            
                                            </script>";
                                            sleep(1);
                                            header("Location: registroRepositorio.php");
                                            
                                    }
                                }else{
                                    echo "No creado";
                                }
                                
                                }else{
                                    
                                    echo "<script>

                                        alert('Problemas al mover el repositorio al servidor');
                                        
                                    </script>";
                                    sleep(1);
                                    header("Location: registroRepositorio.php");
                                }
                                
                            }else{
                                echo "<script>
                                    alert('No existe el directorio, favor de verificarlo con un administrador');
                                    
                                </script>";
                                sleep(1);
                                header("Location: registroRepositorio.php");
                            }
                        }else{
                            
                            echo "<script>
                                alert('Carpeta principal de usuario, no creada');    
                                
                            </script>";
                            sleep(1);
                            header("Location: registroRepositorio.php");
                        }
                        
                    }else{
                        
                        echo "<script>
                            alert('Extensión de archivo no soportada, Favor Verificar');
                            
                            </script>";
                        sleep(1);
                        header("Location: registroRepositorio.php");
                    }
                }else{
                    
                    echo "<script>
                        alert('Extensión de archivo no soportada, Favor Verificar');
                        
                    </script>";
                    sleep(1);
                    header("Location: registroRepositorio.php");
                }
            }else{
                
                echo "<script>
                    alert('Extensión de archivo no soportada, Favor Verificar');
                    
                </script>";
                sleep(1);
                header("Location: registroRepositorio.php");
            }
        }else{
            echo "MAYOR";
            echo "<script>
                alert('El sistema pesa mas de 100MB, favor de verificarlo');
                
            </script>";
            sleep(1);
            header("Location: registroRepositorio.php");
        }
    }catch (PDOException $e) {
	    print "¡Error!: " . $e->getMessage() . "<br/>";
	    die("Error");
	}
    
?>
