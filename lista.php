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
                if($_GET["anio"]<>"")$filtro=$filtro." and anio='".$_GET["anio"]."'";
                if($_GET["semana"]<>"")$filtro=$filtro." and semana='".$_GET["semana"]."'";
                if($_GET["sucursal"]<>"")$filtro=$filtro." and sucursal='".$_GET["sucursal"]."'";
                if($_GET["ubicacion"]<>"")$filtro=$filtro." and ubicacion='".$_GET["ubicacion"]."'";
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="card my-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                OCUPACIÓN - STRUCTURALL
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Año</th>
                                            <th>Semana</th>
                                            <th>Tipo de unidad</th>
                                            <th>Número de serie</th>
                                            <th>Unidad</th>
                                            <th>Razón social</th>
                                            <th>Sucursal</th>
                                            <th>Renta mensual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $total=0;
                                            $query = "select * from cobranza where ubicacion='RENTA' $filtro";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <tr>
                                            <td ><?php echo $row["anio"] ?></td>
                                            <td ><?php echo $row["semana"] ?></td>
                                            <td ><?php echo $row["tipodeunidad"] ?></td>
                                            <td ><?php echo $row["numerodeserie"] ?></td>
                                            <td ><?php echo $row["ubicacion"] ?></td>
                                            <td ><?php echo $row["razonsocial"] ?></td>
                                            <td ><?php echo $row["sucursal"] ?></td>
                                            <td>$<?php echo formatMoney($row["rentamensual"],true) ?></td>
                                        </tr>
                                        <?php 
                                            $total=$total+$row["rentamensual"];
                                            }
                                        ?>
                                        <tr>
                                            <td style="text-align: right" colspan="6"><strong>TOTAL</strong></td>
                                            <td style="text-align: right"><strong>$<?php echo formatMoney($total,true) ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
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