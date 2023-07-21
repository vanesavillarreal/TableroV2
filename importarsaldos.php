<?php
    session_start();
    require 'conection.php';

    $nombre = $_SESSION['nombre'];

    $sql = "select tipo,nombre,email from usuarios where usuario='".$_SESSION['tipo']."'";
    $resultado = $mysqli->query($sql);

    while($row = mysqli_fetch_assoc($result))
	{
	$permiso = $row['tipo'];
	$nombre = $row['nombre'];
	$email = $row['email'];
	}

    date_default_timezone_set('America/Mexico_City');
    $fecha333=substr(strftime("%Y-%m-%d %H:%M:%S",time()),0,10);
    $hora333=substr(strftime("%Y-%m-%d %H:%M:%S",time()),11,8);
    $query333 = "insert into termometro values('".$_SESSION['u']."','".$fecha333."','".$hora333."','".basename(__FILE__, '.php')."')";
    mysqli_query($mysqli,$query333);

    if($_POST["empresa"]<>"")$filtro=$filtro." and empresa='".$_POST["empresa"]."'";

    $semana="";
    if($_POST["empresa"]<>"")$empresa=$_POST["empresa"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tablero</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
        <script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <style>
            .card{
                padding-left: 0px;
                padding-right: 0px;
            }
            form{
                display: flex;
                flex-direction: column;
                padding: 10px;
            }
            label{
                align-self: flex-start;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="main.php">Tablero</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $nombre ?><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Corporativo
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="saldos.php">Saldos</a>
                                    <a class="nav-link" href="importarsaldos.php">Actualización de datos</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="row" style="justify-content: center;">
                            <div class="card col-sm-6 my-4">
                                <div class="card-header text-center">
                                    Saldos
                                </div>
                                <form name="form1" method="post" action="read3.php" enctype="multipart/form-data">
                                    <label class="mb-2">Archivo (Excel)</label>
                                    <input type="file" name="filed1" class="form-control" required>
                                    
                                    <div class="row">&nbsp;</div>

                                    <input class="btn btn-success" type="submit" value="Importar">
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>