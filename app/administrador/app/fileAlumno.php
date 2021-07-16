<?php 
    require("../../conexion.php");
    session_start();
    $idUsuario = $_SESSION['idUsuario'];
    $Sql = $pdo->prepare("SELECT * FROM alumnos WHERE idUsuario = :id");
    $Sql->execute(array(
        "id"    =>  $idUsuario
    ));
    $row = $Sql->fetch(PDO::FETCH_ASSOC);
    $usuario = $row['usuario'];
    $ruta = '../../repositorios/';

    //Vamos a concatenar los argumentos que necesito para la creacion correcta
    $paths = $ruta.''.$usuario;
    if(file_exists($paths)){
        echo "YA";
    }else{
        if(mkdir($paths, 0777, true)){
            //despues de comprobar que la carpeta se haya creado la insertamos en la base de datos como mera referencia

            $insert_file = $pdo->prepare("INSERT INTO directorios(directorio,id_usuario) VALUES (:dir,:id)");
            $result = $insert_file->execute(array(
                "dir"   =>  $paths,
                "id"    =>  $idUsuario
            ));
            if($result){
                echo 'OK';
            }else{
                echo 'NEL';
            }
        }else{
            echo "NO";
        }
        
    }
?>