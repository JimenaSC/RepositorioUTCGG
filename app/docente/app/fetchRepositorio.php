<?php
    require('../../conexion.php');
    session_start();
    $idUsuario = $_SESSION['idUsuario'];
    try {
        sleep(2);
        $query = "";
        if(isset($_POST["action"]))
        {
            $query .= "SELECT re.idRepositorio,re.nombre as repositorio,concat(al.nombre,' ',al.app,' ',al.apm) as nombre,cr.carrera,pr.tipo
            ,re.nvlproyecto
            from repositorios as re
            inner join alumnos as al on al.idUsuario = re.id_usuario
            inner join carrera as cr on cr.idCarrera = al.idCarrera
            inner join proyecto as pr on pr.idProyecto = re.id_proyecto
            WHERE al.id_tipoUsuario = '3'";
            if(isset($_POST["carrera"])){
                $brand_filter = implode("','", $_POST["carrera"]);
                
                $query .= "
                    && cr.idCarrera IN('".$brand_filter."')
                ";
            }
            if(isset($_POST["tipo"])){
                $brand_filter = implode("','", $_POST["tipo"]);
                
                $query .= "
                    && re.id_proyecto IN('".$brand_filter."')
                ";
            }
            if(isset($_POST["nivel"])){
                $brand_filter = implode("','", $_POST["nivel"]);
                
                $query .= "
                    AND re.nvlproyecto IN('".$brand_filter."')
                ";
            }

            $stm = $pdo->prepare($query);
            $result = $stm->execute(array(
                "id"    =>  $idUsuario
            ));
            if(!$result){
                die('Query failed in fetch Usuarios');
            }
            $total_row = $stm->rowCount();
            $output = '';
            if($total_row > 0)
	        {
                #Imprimimos por pantalla lo que se va a realizar
                $output .= '
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="text-align: center;" >Repositorio</th>
                            <th style="text-align: center;" class="">Usuario</th>
                            <th style="text-align: center;" >Carrera</th>
                            <th style="text-align: center;" >Nivel</th>
                            <th style="text-align: center;" >Tipo</th>
                            <th style="text-align: center;" width="19%">Aciones</th>
                        </tr>
                    </thead>
                    <tbody>
                ';

                #Seguimos con el fetch de los resultados
                while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                    $output .= '
                    <tr>
                    <td style="text-align: center;" > '. utf8_encode($row['repositorio'])  .' </td>
                    <td style="text-align: center;" class=""> '. utf8_encode($row['nombre']) .' </td>
                    <td style="text-align: center;" > '. utf8_encode($row['carrera']) .' </td>
                    <td style="text-align: center;" > '. utf8_encode($row['nvlproyecto']) .' </td>
                    <td style="text-align: center;" > '. utf8_encode($row['tipo']) .' </td>
                    
                    <td>
                    
                        <button type="button" name="edit" value="Cargar" id=" '. $row["idRepositorio"] .' " class="btn btn-info btn-xs edit_data"><i class="fas fa-upload"></i> Cargar</button>
                        <button type="button" name="view" value="Ver" id=" '. $row["idRepositorio"] .' " class="btn btn-success btn-xs view_data"><i class="fas fa-eye"></i> Ver</button>
                    </td>  
                    
                    
                </tr>
                
                    ';
                }
                $output .= '
                    </tbody>
                </table>';
            }else{
                echo '<br><br><div class="alert alert-danger text-center"><h3><i class="fas fa-exclamation-triangle"></i> No se encontraron resultados <i class="fas fa-exclamation-triangle"></i></h3></div>';
            }
            

            echo $output;

        }
        
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>
