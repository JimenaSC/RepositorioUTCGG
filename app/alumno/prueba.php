<?php
    $carpte = '16307018';
    $ruta = '../repositorios/';
    $paths = $ruta.''.$carpte;
    echo $paths;
    if(file_exists($paths)){
        rmDir_rf($paths);
        
    }else{
        echo "La carpeta ya existe";
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
?>