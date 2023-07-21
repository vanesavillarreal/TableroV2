<?php
session_start();
require 'conection.php';

$nombre = $_SESSION['nombre'];
$sql = "select tipo,nombre,email from usuarios where usuario='".$_SESSION['nombre']."'";

$resultado = $mysqli->query($sql);

while($row = mysqli_fetch_assoc($result))
{
$permiso = $row['tipo'];
$nombre = $row['nombre'];
}

date_default_timezone_set('America/Mexico_City');
$fecha333=substr(strftime("%Y-%m-%d %H:%M:%S",time()),0,10);
$hora333=substr(strftime("%Y-%m-%d %H:%M:%S",time()),11,8);
$query333 = "insert into termometro values('".$_SESSION['nombre']."','".$fecha333."','".$hora333."','".basename(__FILE__, '.php')."')";
mysqli_query($mysqli,$query333);

if ($nombre != $_SESSION['nombre'] || $nombre == "")
header("location:index.php");

$query = "select * from vehiculos limit 1";
$result = mysqli_query($mysqli,$query);
while($row = mysqli_fetch_assoc($result))
	{
	$colObj1 = mysqli_fetch_field_direct($result,1);$n1 = $colObj1->name;
	$colObj2 = mysqli_fetch_field_direct($result,2);$n2 = $colObj2->name;
	$colObj3 = mysqli_fetch_field_direct($result,3);$n3 = $colObj3->name;
	$colObj4 = mysqli_fetch_field_direct($result,4);$n4 = $colObj4->name;
	$colObj5 = mysqli_fetch_field_direct($result,5);$n5 = $colObj5->name;
	$colObj6 = mysqli_fetch_field_direct($result,6);$n6 = $colObj6->name;
	$colObj7 = mysqli_fetch_field_direct($result,7);$n7 = $colObj7->name;
	$colObj8 = mysqli_fetch_field_direct($result,8);$n8 = $colObj8->name;
	$colObj9 = mysqli_fetch_field_direct($result,9);$n9 = $colObj9->name;
	$colObj10 = mysqli_fetch_field_direct($result,10);$n10 = $colObj10->name;
	$colObj11 = mysqli_fetch_field_direct($result,11);$n11 = $colObj11->name;
	$colObj12 = mysqli_fetch_field_direct($result,12);$n12 = $colObj12->name;
	$colObj13 = mysqli_fetch_field_direct($result,13);$n13 = $colObj13->name;
	$colObj14 = mysqli_fetch_field_direct($result,14);$n14 = $colObj14->name;
	$colObj15 = mysqli_fetch_field_direct($result,15);$n15 = $colObj15->name;
	$colObj16 = mysqli_fetch_field_direct($result,16);$n16 = $colObj16->name;
	$colObj17 = mysqli_fetch_field_direct($result,17);$n17 = $colObj17->name;
	$colObj18 = mysqli_fetch_field_direct($result,18);$n18 = $colObj18->name;
	$colObj19 = mysqli_fetch_field_direct($result,19);$n19 = $colObj19->name;
	$colObj20 = mysqli_fetch_field_direct($result,20);$n20 = $colObj20->name;
	$colObj21 = mysqli_fetch_field_direct($result,21);$n21 = $colObj21->name;
	$colObj22 = mysqli_fetch_field_direct($result,22);$n22 = $colObj22->name;
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
        <title>Tablero</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
        <script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
        <script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <style>
            a:link, a:visited {
                color: inherit;
                text-decoration: inherit;
				color: white;
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
                            <?php
                                if($_SESSION['tipo'] == "structurall"){
                            ?>
                                 <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                                    Structurall
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="ocupacion.php">Ocupación</a>
                                        <a class="nav-link" href="facturas.php">Facturas</a>
                                        <a class="nav-link" href="cartera.php">Cartera Vencida</a>
                                        <a class="nav-link" href="rentals.php">Rentals</a>

                                    </nav>
                                </div>
                            <?php
                                }
                            ?>
                            <?php
                                if($_SESSION['tipo'] == "dashboard"){
                            ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                                Structurall
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="ocupacion.php">Ocupación</a>
                                    <a class="nav-link" href="facturas.php">Facturas</a>
                                    <a class="nav-link" href="cartera.php">Cartera Vencida</a>
                                    <a class="nav-link" href="rentals.php">Rentals</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Corporativo
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="saldos.php">Saldos</a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Control Jurídico de Demandas
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="control_juridico.php">Control Jurídico de Demandas</a>
                                            <a class="nav-link" href="actualizacion_info.php">Actualización de información</a>
                                            <a class="nav-link" href="registro_cambios.php">Registro de Cambios</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Inventario de vehículos y propiedades
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="vehiculos.php">Vehículos</a>
                                            <a class="nav-link" href="propiedades.php">Propiedades</a>
                                            <a class="nav-link" href="actualizacion_info_vehiculos.php">Actualización de inf. vehículos</a>
                                            <a class="nav-link" href="actualizacion_info_propiedades.php">Actualización de inf. propiedades</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link" href="nomina_corporativa.php">Nómina</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOperadora" aria-expanded="false" aria-controls="collapseOperadora">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-hotel"></i></div>
                                    Operadora de Hoteles SONOT
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseOperadora" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="hotel.php">
                                        <div class="sb-nav-link-icon">
                                            <i class="fa-solid fa-hotel"></i>
                                        </div>
                                        Hotel
                                    </a>
                                    <a class="nav-link" href="restaurante.php"> 
                                        <div class="sb-nav-link-icon">
                                            <i class="fa-solid fa-utensils"></i>
                                        </div>
                                        Restaurante
                                    </a>
                                </nav>
                            </div>
                        </div>
                        <?php    
                            }
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="card my-4">
                            <div class="card-header row" >
                                <div class="col-sm-6">
                                    <i class="fas fa-table me-1"></i>
                                    NUEVO VEHÍCULO
                                </div>
                            </div>
                            <div class="card-body">
                                <form name="form1" method="post" action="guardarvehiculo.php">
                                    <table>
                                        <tbody>
                                            <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
                                            <tr><td><strong><?php echo $n1 ?></strong></td><td><input type="text" class="form-control input-sw" name="c1" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n2 ?></strong></td><td><input type="text" class="form-control input-sw" name="c2" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n3 ?></strong></td><td><input type="text" class="form-control input-sw" name="c3" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n4 ?></strong></td><td><input type="text" class="form-control input-sw" name="c4" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n5 ?></strong></td><td><input type="text" class="form-control input-sw" name="c5" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n6 ?></strong></td><td><input type="text" class="form-control input-sw" name="c6" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n7 ?></strong></td><td><input type="text" class="form-control input-sw" name="c7" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n8 ?></strong></td><td><input type="text" class="form-control input-sw" name="c8" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n9 ?></strong></td><td><input type="text" class="form-control input-sw" name="c9" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n10 ?></strong></td><td><input type="text" class="form-control input-sw" name="c10" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n11 ?></strong></td><td><input type="text" class="form-control input-sw" name="c11" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n12 ?></strong></td><td><input type="text" class="form-control input-sw" name="c12" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n13 ?></strong></td><td><input type="text" class="form-control input-sw" name="c13" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n14 ?></strong></td><td><input type="text" class="form-control input-sw" name="c14" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n15 ?></strong></td><td><input type="text" class="form-control input-sw" name="c15" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n16 ?></strong></td><td><input type="text" class="form-control input-sw" name="c16" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n17 ?></strong></td><td><input type="text" class="form-control input-sw" name="c17" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n18 ?></strong></td><td><input type="text" class="form-control input-sw" name="c18" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n19 ?></strong></td><td><input type="text" class="form-control input-sw" name="c19" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n20 ?></strong></td><td><input type="text" class="form-control input-sw" name="c20" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n21 ?></strong></td><td><input type="text" class="form-control input-sw" name="c21" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n22 ?></strong></td><td><input type="text" class="form-control input-sw" name="c22" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n23 ?></strong></td><td><input type="text" class="form-control input-sw" name="c23" value=""> </td></tr>
                                            <tr><td><strong><?php echo $n24 ?></strong></td><td><input type="text" class="form-control input-sw" name="c24" value=""> </td></tr>

											<tr><td colspan="3"><input type="submit" class="btn btn-success float-start" value="Agregar"><a href="actualizacion_info_vehiculos.php" class="btn btn-danger float-end">Cancelar</a></td></tr>
                                        </tbody>
                                    </table>
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
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>