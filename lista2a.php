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
<html lang="es">
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
            if($_GET["socio"]<>"")$filtro=$filtro." and socio='".$_GET["socio"]."'";
            if($_GET["anio"]<>"")$filtro=$filtro." and left(fecharecibido,4)='".$_GET["anio"]."'";
            if($_GET["mes"]<>"")$filtro=$filtro." and left(fecharecibido,7)='".$_GET["mes"]."'";
            if($_GET["sucursal"]<>"")$filtro=$filtro." and sucursal='".$_GET["sucursal"]."'";
            if($_GET["estadopago"]<>"")$filtro=$filtro." and estadopago='".$_GET["estadopago"]."'";
        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="card my-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            CARTERA VENCIDA - STRUCTURALL
                        </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>NÚmero</th>
                                            <th>Socio</th>
                                            <th>Recibido</th>
                                            <th>Vencimiento</th>
                                            <th>Sucursal</th>
                                            <th>Estado pago</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $total=0;
                                            $query = "select * from facturas where estado='Publicado' $filtro and datediff(left(now(),10),fechavencimiento)>=90 and estadopago<>'pagado'";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <tr>
                                            <td nowrap><?php echo $row["numero"] ?></td>
                                            <td><?php echo $row["socio"] ?></td>
                                            <td nowrap><?php echo $row["fecharecibido"] ?></td>
                                            <td nowrap><?php echo $row["fechavencimiento"] ?></td>
                                            <td><?php echo $row["sucursal"] ?></td>
                                            <td><?php echo $row["estadopago"] ?></td>
                                            <td>$<?php echo formatMoney($row["total"],true) ?></td>
                                        </tr>
                                        <?php 
                                            $total=$total+$row["total"];
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