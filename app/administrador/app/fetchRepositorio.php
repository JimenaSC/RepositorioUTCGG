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
                            <th>Repositorio</th>
                            <th class="">Usuario</th>
                            <th>carrera</th>
                            <th>Nivel</th>
                            <th>Tipo</th>
                            <th>Cargar</th>
                            <th>Visualizar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                ';

                #Seguimos con el fetch de los resultados
                while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                    $output .= '
                    <tr>
                    <td> '. utf8_encode($row['repositorio'])  .' </td>
                    <td class=""> '. utf8_encode($row['nombre']) .' </td>
                    <td> '. utf8_encode($row['carrera']) .' </td>
                    <td> '. utf8_encode($row['nvlproyecto']) .' </td>
                    <td> '. utf8_encode($row['tipo']) .' </td>
                    
                    <td><input type="button" name="edit" value="Cargar" id=" '. $row["idRepositorio"] .' " class="btn btn-info btn-xs edit_data" /></td>  
                    <td><input type="button" name="view" value="Visualizar" id=" '. $row["idRepositorio"] .' " class="btn btn-success btn-xs view_data" /></td>  
                    <td><input type="button" name="delete" value="Eliminar" id=" '. $row["idRepositorio"] .' " class="btn btn-danger btn-xs delete_data" /></td>  
                    
                </tr>
                    ';
                }
                $output .= '
                    </tbody>
                </table>';
            }else{
                echo '<div class="alert alert-danger text-center"><h3>No data found</h3></div>';
            }
            

            echo $output;

        }
        
    } catch (PDOException $e) {
        print "??Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>
