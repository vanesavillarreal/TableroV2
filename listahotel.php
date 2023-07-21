<?php
session_start();
require "conection.php";

$query = "select tipo,nombre,email from usuarios where usuario='".$_SESSION['usuario']."'";
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
$query333 = "insert into termometro values('".$_SESSION['usuario']."','".$fecha333."','".$hora333."','".basename(__FILE__, '.php')."')";
mysqli_query($mysqli,$query333);


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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="card my-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                INDICADORES - HOTEL
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Total habitaciones</th>
                                            <th>Habitaciones vendidas</th>
                                            <th>Porcentaje de Ocupación</th>
                                            <th>Adultos</th>
                                            <th>Niños</th>
                                            <th>Tarifa Promedio</th>
                                            <th>Ingresos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $dia = $_GET['dia'] ?? '0';
                                            $mes = $_GET['mes'];
                                            $anio = $_GET['anio'];

                                            $fechas = [];
                                            if($dia == '0'){
                                                $primerDiaDelMes = new DateTime("{$anio}-{$mes}-01");
                                                $siguienteMes = clone $primerDiaDelMes;
                                                $siguienteMes->modify('+1 month');
                                                while($primerDiaDelMes < $siguienteMes){
                                                    $fechas[] = $primerDiaDelMes->format('Y-m-d');
                                                    $primerDiaDelMes->modify('+1 day');
                                                }
                                            }else{
                                                $fechas[] = "{$anio}-{$mes}-{$dia}";
                                            }
                                            $ultimo_dia = end($fechas);
                                            $sql = "SELECT DATE(fecha) AS fecha, habitaciones_vendidas, porcentaje_ocupacion, adultos, ninos, tarifa_promedio, ingresos 
                                                    FROM hotel 
                                                    WHERE fecha BETWEEN '$fechas[0]' AND '$ultimo_dia'";
                                            $result = mysqli_query($mysqli,$sql);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <tr>
                                            <td><?php echo $row["fecha"];?></td>
                                            <td>20</td>
                                            <td><?php echo $row["habitaciones_vendidas"] ?></td>
                                            <td><?php echo $row["porcentaje_ocupacion"] ?></td> 
                                            <td><?php echo $row["adultos"] ?></td>
                                            <td><?php echo $row["ninos"] ?></td>
                                            <td><?php echo formatMoney($row["tarifa_promedio"],true) ?></td>
                                            <td><?php echo formatMoney($row["ingresos"],true) ?></td>
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
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>