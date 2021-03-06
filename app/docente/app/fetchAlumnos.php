<?php
    require('../../conexion.php');
    try {
        sleep(2);
        $query = "";
        if(isset($_POST["action"]))
        {
            $query = "SELECT us.idUsuario, concat(us.nombre,' ', us.app ,' ' , us.apm) as nombre, tp.descripcion as tipoUsuario, cr.carrera, cua.cuatrimestre, cua.nivel from alumnos as  us
                        inner join tipousuario as tp on tp.idtipoUsuario = us.id_tipoUsuario
                        inner join carrera as cr on cr.idCarrera = us.idCarrera
                        inner join cuatrimestre as cua on cua.idCuatrimestre = us.id_cuatrimestre
                        WHERE tp.descripcion = 'Alumno'
            ";
        
    
            if(isset($_POST["carrera"])){
                $brand_filter = implode("','", $_POST["carrera"]);
                
                $query .= "
                    && cr.idCarrera IN('".$brand_filter."')
                ";
            }

            if(isset($_POST["cuatri"])){
                $cuatri_filter = implode("','", $_POST["cuatri"]);
                
                $query .= "
                    && cua.idCuatrimestre IN('".$cuatri_filter."')
                ";
            }


            $stm = $pdo->prepare($query);
            $result = $stm->execute();
            if(!$result){
                die('Query failed in fetch Docentes');
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
                            <th style="text-align: center;" >Nombre</th>
                            <th style="text-align: center;" >Carrera</th>
                            <th style="text-align: center;" >Cuatrimestre</th>
                            <th style="text-align: center;" >Nivel</th>
                            <th style="text-align: center;" >Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                ';

                #Seguimos con el fetch de los resultados
                while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                    $output .= '
                    <tr>
                    <td style="text-align: center;" > '. utf8_encode($row['nombre'])  .' </td>
                    <td style="text-align: center;" > '. utf8_encode($row['carrera']) .' </td>
                    <td style="text-align: center;" > '. utf8_encode($row['cuatrimestre']) .' </td>
                    <td style="text-align: center;" > '. utf8_encode($row['nivel']) .' </td>
                    
                    
                    <td style="text-align: center;" >
                        <button style="color:#138496" type="button" name="edit" value="Editar" id=" '. $row["idUsuario"] .' " class="btn  btn-xs edit_data"> <i class="fas fa-pencil-alt"></i></button>
                    </td>
                    
                    
                    
                </tr>
                    ';
                }
                $output .= '
                    </tbody>
                </table>';
            }else{
                echo '<div class="alert alert-danger text-center"><h3><i class="fas fa-exclamation-triangle"></i> No se encontraron resultados <i class="fas fa-exclamation-triangle"></i></h3> </div>';
            }
            

            echo $output;

        }
        
    } catch (PDOException $e) {
        print "??Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>

<!--
<td>
    <input type="button" name="edit" value="Editar" id=" '. $row["idUsuario"] .' " class="btn btn-info btn-xs edit_data"/> 
</td>  
-->

<!--
<td>
    <span class="btn btn-info">
        <i class="fas fa-pencil-alt"></i> <input type="button" name="edit" value="Editar" id=" '. $row["idUsuario"] .' " class="btn btn-info btn-xs edit_data"/>
    </span>                 
</td>
-->