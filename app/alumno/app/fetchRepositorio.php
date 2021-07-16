<?php
    require('../../conexion.php');
    session_start();
    $idUsuario = $_SESSION['idUsuario'];
    try {
        sleep(2);
        $query = "";
        if(isset($_POST["action"]))
        {
            $query .= "SELECT * FROM repositorios WHERE id_usuario = :id ";

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
                            <th class="">Descripcion</th>
                            <th>Nivel</th>
                            
                            <th>Cargar</th>
                            <th>Visualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                ';

                #Seguimos con el fetch de los resultados
                while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                    $output .= '
                    <tr>
                    <td> '. utf8_encode($row['nombre'])  .' </td>
                    <td class=""> '. utf8_encode($row['descripcion']) .' </td>
                    <td> '. utf8_encode($row['nvlproyecto']) .' </td>
                    
                    <td><input type="button" name="edit" value="Cargar" id=" '. $row["idRepositorio"] .' " class="btn btn-info btn-xs edit_data" /></td>  
                    <td><input type="button" name="delete" value="Visualizar" id=" '. $row["idRepositorio"] .' " class="btn btn-success btn-xs view_data" /></td>  
                    
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
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>
