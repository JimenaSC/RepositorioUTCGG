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

    
    //VERIFICAR SI ESTA LA CARPETA DEL USUARIO
    $idUsuario = $_SESSION['idUsuario'];
    $Sql = $pdo->prepare("SELECT * FROM usuario WHERE idUsuario = :id");
    $Sql->execute(array(
        "id"    =>  $idUsuario
    ));
    //TRAER LOS DATOS QUE SE NECESITAN PARA VERIFICAR SI EXISTE UNA CARPETA CON EL NOMBRE
    $row = $Sql->fetch(PDO::FETCH_ASSOC);
    $usuarioAdministrativo = $row['usuario'];
    $usuario =  $_POST['alumnoRepositorio'];
    //comprobacion del alumno que llega por el post
    $compro = $pdo->prepare("SELECT * FROM alumnos WHERE usuario  = :us");
    $compro->execute(array(
        "us"    =>  $usuario
    ));
    $rowUs = $compro->fetch(PDO::FETCH_ASSOC);
    $userRegistro = $rowUs['idUsuario'];

    $ruta = '../repositorios/';
    //Vamos a concatenar los argumentos que necesito para la creacion correcta
    $pathUser = $ruta.''.$usuario;

    //Traemos los POST normales
    $nameRepositories   =   $_POST['nrepositorio'];
    $description        =   $_POST['descripcion'];
    $tipoProyecto       =   $_POST['tipoproyecto'];
    $idRepositorio      =   $_POST['repositorio_id'];
    $nvlproyecto        =   $_POST['nvlproyecto'];
    $version            =   $_POST['version'];
    $integrantes        = $_POST['item_service'];
    $integrantesString = implode(",", $integrantes);

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
    /*
        echo 10*MB."----------102662-----<br>";
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
                                echo "<script>
                                    alert('Ya existe un repositorio con este nombre');
                                    window.history.go(-1);
                                </script>";
                                exit;
                            }else{
                                if(mkdir($pathRepositorio, 0777, true)){
                                    if(mkdir($pathVersion, 0777, true)){
                                        if(move_uploaded_file($systemFile, $PathSystem)){
                                            move_uploaded_file($tecnicoFile, $Pathtecnico);
                                            move_uploaded_file($usuarioFile, $Pathusuario);
                                            //CREAMOS EL QUERY DESPUES DE PASAR TODOS LOS ARCHIVOS Y DEJARLOS EN EL SERVIDOR
                                            $insert_repositorie = $pdo->prepare("INSERT INTO repositorios (nombre,descripcion,filesystem,mtecnico,musuario,id_proyecto,id_usuario,version,nvlproyecto,usermodify,integrantes) 
                                            VALUES (:nombre,:descripcion,:filesystem,:mtecnico,:musuario,:id_proyecto,:id_usuario,:version,:nvlproyecto,:usermodify,:integrantes)");
                                            //REALIZAR EL QUERY Y SUBIR A LA BD
                                            $result = $insert_repositorie->execute(array(
                                                "nombre"        =>  $nameRepositories,
                                                "descripcion"   =>  $description,
                                                "filesystem"    =>  $PathSystem,
                                                "mtecnico"      =>  $Pathtecnico,
                                                "musuario"      =>  $Pathusuario,
                                                "id_proyecto"   =>  $tipoProyecto,
                                                "id_usuario"    =>  $userRegistro,
                                                "nvlproyecto"   =>  $nvlproyecto,
                                                "version"       =>  $version,
                                                "usermodify"    =>  $usuarioAdministrativo ,
                                                "integrantes"   =>  $integrantesString
                                            ));
    
                                            if($result){
                                                sleep(2);
                                                echo "<script>
                                                Swal.fire({
                                                    position: 'center',
                                                    type: 'success',
                                                    title: 'Repositorio Subido Satisfactoriamente',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                                window.history.go(-1);
                                                </script>";
                                                exit;
                                                
    
                                            }else{
                                                
                                                echo "<script>
                                                alert('Ha habido un error para subir el archivo');
                                                window.history.go(-1);
                                                </script>";
                                                exit;
                                                
                                            }
                                        }else{
                                            
                                            echo "<script>
    
                                                alert('Problemas al mover el repositorio al servidor');
                                                window.history.go(-1);
                                            </script>";
                                            exit;
                                        }
                                    }else{
                                        echo "<script>
                                        alert('No se pudo Crear Carpeta para la version');
                                        window.history.go(-1);
                                        </script>";
                                    exit;
                                    }
                                    
                                }else{

                                    echo "<script>
                                        alert('No se pudo Crear Carpeta para el repositorio');
                                        window.history.go(-1);
                                        </script>";
                                    exit;
                                }
                            }
                        }else{
                            
                            echo "<script>
                                alert('Carpeta principal de usuario, no creada');    
                                window.history.go(-1);
                            </script>";
                            exit;
                        }
                        
                    }else{
                        
                        echo "<script>
                            alert('Extensión de archivo no soportada, Favor Verificar 1');
                            window.history.go(-1);
                            </script>";
                        exit;
                    }
                }else{
                    
                    echo "<script>
                        alert('Extensión de archivo no soportada, Favor Verificar 2');
                        window.history.go(-1);
                    </script>";
                    exit;
                }
            }else{
                
                echo "<script>
                    alert('Extensión de archivo no soportada, Favor Verificar 3');
                    window.history.go(-1);
                </script>";
                exit;
            }
        }else{
            echo "MAYOR";
            echo "<script>
                alert('El sistema pesa mas de 100MB, favor de verificarlo');
                window.history.go(-1);
            </script>";
            exit;
        }
    }catch (PDOException $e) {
	    print "¡Error!: " . $e->getMessage() . "<br/>";
	    die("Error");
	}
    
?>
