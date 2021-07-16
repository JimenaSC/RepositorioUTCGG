<?php
    include('app/conexion.php');
    session_start();
    //session_destroy();
    if(isset($_SESSION["idUsuario"])){
        header("Location: app/welcome.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/iconUT.png" type="image/x-icon">
    <title>Registro ||  Repositorio</title>
    <!-- Styles CSS -->
    
    <link rel="stylesheet" href="css/main2.css">
    <link rel="stylesheet" href="css/boo2.css">
</head>
<body>
    <div class="error">
        <span>Ha habido un error al registrarte</span>
    </div>

    <div class="modal-dialog text-center">
        <div class="col-sm-12 main">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <img src="img/logout2.png" alt="UserExample">
                </div>
                <form  method="POST" id="formlg" class="form-group col-12">
                    <div class="form-group">
                        <input type="text" name="alumno" id="alumno" class="form-control" placeholder="Nombre (s) / name" >
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <input type="text" name="app" id="app" class="form-control" placeholder="Apellido Paterno / Lastname" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <input type="text" name="apm" id="apm" class="form-control" placeholder="Apellido Materno / Lastname" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <input type="text" name="user" id="user" class="form-control" placeholder="Usuario / User" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <input type="password" name="pass" id="pass" class="form-control" placeholder="Contraseña / Password" >
                        </div>
                    </div>
                    <div class="form-row">
                                <div class="form-group col-md-6">
                                    
                                    <select name="carrera" id="carrera" class="form-control carrera">
                                        <option value="">Selecciona una Carrera</option>
                                        <?php
                                            $query = $pdo->prepare("SELECT * FROM carrera");
                                            $query->execute();
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        ?>   
                                            <option value="<?php echo $row['idCarrera']?>"><?php echo utf8_encode($row['carrera'])?></option>  
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    
                                    <select name="cuatri" id="cuatri" class="form-control cuatri">
                                        <option value="">Selecciona un Cuatrimestre</option>
                                        <?php
                                            $query = $pdo->prepare("SELECT * FROM cuatrimestre");
                                            $query->execute();
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        ?>   
                                            <option value="<?php echo $row['idCuatrimestre']?>"><?php echo utf8_encode($row['cuatrimestre'])?></option>  
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                    <div class="form-group" >
                        <input type="submit" style="font-weight: 600;" value="Registrarse" class="form-control btn btn-success"  id="btnform">
                    </div>
                    <p style="color: #232729; font-size: 13px;">¿Ya tienes una cuenta? <span><a style="color: #00BD00;" href="index.php"> Inicia Aquí</a></span></p>
                </form>
            </div>
        </div>
    </div>



    <!-- SCRIPTS -->
    <script src="js/jquery.js"></script>
    <script src="js/sweetalert.js"></script>
    <script src="js/mainAlumnos.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>