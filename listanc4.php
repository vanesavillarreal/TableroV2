<?php
session_start();
require "conection.php";

$query = "select tipo,nombre,email from usuarios where usuario='".$_SESSION['u']."'";
$result = mysqli_query($mysqli,$query);
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

//if ($permiso<>"upload")
//	header("location:index.php");

function formatMoney($number,$fractional=false){if($fractional){$number=sprintf('%.2f',$number);}while(true){$replaced=preg_replace('/(-?\d+)(\d\d\d)/','$1,$2',$number);if($replaced!=$number){$number=$replaced;}else{break;}}return $number;}

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
        <script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
            <?php 
                if($_GET["empresa"]<>"")$filtro=$filtro." and empresa='".$_GET["empresa"]."'";
                if($_GET["sede"]<>"")$filtro=$filtro." and sede='".$_GET["sede"]."'";
                if($_GET["departamento"]<>"")$filtro=$filtro." and departamento='".$_GET["departamento"]."'";
                if($_GET["area"]<>"")$filtro=$filtro." and area='".$_GET["area"]."'";
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="card my-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                NÓMINA - CORPORATIVO
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Empresa</th>
                                            <th>Sede</th>
                                            <th>Nombre</th>
                                            <th>Departamento</th>
                                            <th>Área</th>
                                            <th>Puesto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query = "select * from nominacorporativa where vehiculo='SI' $filtro";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <tr>
                                            <td ><?php echo $row["empresa"] ?></td>
                                            <td ><?php echo $row["sede"] ?></td>
                                            <td ><?php echo $row["nombre"] ?></td>
                                            <td ><?php echo $row["departamento"] ?></td>
                                            <td ><?php echo $row["area"] ?></td>
                                            <td ><?php echo $row["puesto"] ?></td>
                                        </tr>
                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>