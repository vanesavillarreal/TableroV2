<?php
    session_start();
   // session_unset(); 
   // session_destroy(); 

    require "conection.php";
    
    if($_POST){
        
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $sql = "SELECT nombre, password, tipo, usuario FROM usuarios WHERE usuario = '$usuario'";
        $resultado = $mysqli->query($sql);
        $num = $resultado->num_rows;

        if($num > 0){
            $row =  $resultado->fetch_assoc();
            $password_bd = $row['password'];

            $pass_c = $password;

            if($password_bd == $pass_c){
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['tipo'] = $row['tipo'];

                if($_SESSION['tipo']== 'upload'){
                    header("Location: mainupload.php");
                }else{
                    header("Location: main.php");
                }
                
            }else{
                echo "La contraseña no coincide";
            }

        }else{
            echo "Acceso denegado";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Tablero</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/index.css">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body style="background: url(assets/img/PORTADA.png) no-repeat center center fixed;">
        <div id="layoutAuthentication">
            <div class="text-center" id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <img style="margin-top: 79px;" class="img-fluid" src="assets/img/LOGO-Q-1.png" alt="logo">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Iniciar Sesión</h3></div>
                                    <div class="card-body">
                                        <form name="form1" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="text" name="usuario" placeholder="Usuario" required/>
                                                <label for="inputEmail">Usuario</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password" required/>
                                                <label for="inputPassword">Contraseña</label>
                                            </div>
                                            <!--div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Recordar Contraseña</label>
                                            </div-->
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <!--a class="small" href="password.html">¿Olvidaste tu contraseña?</a-->
                                                <button type="submit" name="sumbit" class="btn btn-success" href="main.php">Iniciar Sesión</button>
                                                <?php if (isset($_GET['acceso'])) echo "<br><br><div class=\"alert alert-danger\">Acceso Denegado</div>"; ?>
                                            </div>
                                        </form>
                                    </div>
                                    <!--div class="card-footer text-center py-3">
                                        <div class="small"><a href="#">¿Necesitas una cuenta? ¡Registrate!</a></div>
                                    </div-->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
