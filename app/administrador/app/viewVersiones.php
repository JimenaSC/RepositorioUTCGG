<?php
    require('../../conexion.php');
    session_start();
    $idUsuario = $_SESSION['idUsuario'];
    try {
        $idRepositorio = $_POST["repositorio_id"];
        $query = "";
        if(isset($_POST["action"]))
        {
            $sqlUsuario = $pdo->prepare("SELECT * FROM repositorios WHERE idRepositorio = :idrepo");
            $sqlUsuario->execute(array(
                "idrepo" => $idRepositorio
            ));
            $roz = $sqlUsuario->fetch(PDO::FETCH_ASSOC);
            $id_us = $roz['id_usuario'];
            $name_repo =  $roz['nombre'];

            $query .= "SELECT * FROM repositoriochanges WHERE id_usuario = :idus AND nombre = :name_repo";

            $stm = $pdo->prepare($query);
            $result = $stm->execute(array(
                "idus"   =>  $id_us,
                "name_repo" =>  $name_repo
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
                            <th>Archivos</th>
                            <th class="">version</th>
                            <th class="">Modificación</th>
                            <th class="">Hora</th>
                            
                            <th>Descargar</th>

                            
                        </tr>
                    </thead>
                    <tbody>
                ';

                #Seguimos con el fetch de los resultados
                while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                    $nombreArchivo = explode("/", $row['filesystem']);
                    $nombreTecnico = explode("/", $row['mtecnico']);
                    $nombreUsuario = explode("/", $row['musuario']);
                    $output .= '
                    <tr>
                        <td> '. $nombreArchivo[5] .' </td>
                        <td class=""> '. utf8_encode($row['version']) .' </td>
                        <td class=""> '. utf8_encode($row['usermodify']) .' </td>
                        <td class=""> '. utf8_encode($row['timechange']) .' </td>
                        <td><a href="'. $row["filesystem"] .'" class="btn btn-info btn-xs" download><span class="fa fa-download"></span></a></td>
                    </tr>
                    ';
                    $output .= '
                    <tr>
                        <td> '. $nombreTecnico[5] .' </td>
                        <td class=""> '. utf8_encode($row['version']) .' </td>
                        <td class=""> '. utf8_encode($row['usermodify']) .' </td>
                        <td class=""> '. utf8_encode($row['timechange']) .' </td>
                        
                        <td><a href="'. $row["mtecnico"] .'" class="btn btn-info btn-xs" download><span class="fa fa-download"></span></a></td>
                        
                        
                    </tr>
                    ';
                    $output .= '
                    <tr>
                        <td> '. $nombreUsuario[5] .' </td>
                        <td class=""> '. utf8_encode($row['version']) .' </td>
                        <td class=""> '. utf8_encode($row['usermodify']) .' </td>
                        <td class=""> '. utf8_encode($row['timechange']) .' </td>
                        <td><a href="'. $row["musuario"] .'" class="btn btn-info btn-xs" download><span class="fa fa-download"></span></a></td>
                        
                        
                    </tr>
                    <tr>
                        <td class=""> '.'<h5>Commit: </h5>'. utf8_encode($row['comment']) .' </td>
                        <td class="">  </td>
                        
                        <td class="">  </td>
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
