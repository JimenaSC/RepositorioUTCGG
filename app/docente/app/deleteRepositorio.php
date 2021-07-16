<?php
    require('../../conexion.php');
    if(isset($_POST['repositorio_id'])) {
        $id = $_POST['repositorio_id'];
        $output = '';
        $sql = $pdo->prepare("SELECT * FROM repositorios WHERE idRepositorio = :idRepo");
        $sql->execute(array(
            "idRepo"    =>  $id
        ));
        
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $nombreArchivo = explode("/", $row['filesystem']);
        $deletePath = '../'.$nombreArchivo[0].'/'.$nombreArchivo[1].'/'.$nombreArchivo[2].'/'.$nombreArchivo[3];
        //echo $deletePath;
        if(file_exists($deletePath)){
            $query = $pdo->prepare("DELETE FROM repositorios WHERE idRepositorio = :id");
            $result = $query->execute(array(
                "id"    =>  $id
            ));
            if(!$result) {
                die('Query Failed');
            }else{
                echo('OK');
            }
            rmDir_rf($deletePath);
        }else{
            echo "La carpeta ya no existe";
        }
    

        
    }


    function rmDir_rf($carpeta)
    {
      foreach(glob($carpeta . "/*") as $archivos_carpeta){             
        if (is_dir($archivos_carpeta)){
          rmDir_rf($archivos_carpeta);
        } else {
        unlink($archivos_carpeta);
        }
      }
      rmdir($carpeta);
    }