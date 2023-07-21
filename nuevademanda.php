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
                                    NUEVA DEMANDA
                                </div>
                            </div>
                            <div class="card-body">
                                <form name="form1" method="post" action="guardardemanda.php">
                                    <table>
                                        <tbody>
											<tr><td><strong>Empresa</strong></td><td><input type="text" class="form-control input-sw" name="empresa" value="" required></td></tr>
											<tr><td><strong>Tipo de demanda</strong></td><td><input type="text" class="form-control input-sw" name="tipodemanda" value="" required></td></tr>
											<tr><td><strong>Fecha de presentación</strong></td><td><input type="date" class="form-control input-sw" name="fechapresentacion" value="" required></td></tr>
											<tr><td><strong>Folio</strong></td><td><input type="text" class="form-control input-sw" name="folio" value="" required></td></tr>
											<tr><td><strong>Demandado</strong></td><td><input type="text" class="form-control input-sw" name="demandado" value="" required></td></tr>
											<tr><td><strong>Demandante</strong></td><td><input type="text" class="form-control input-sw" name="demandante" value="" required></td></tr>
											<tr><td><strong>Asignado a</strong></td><td><input type="text" class="form-control input-sw" name="asignadoa" value="" required></td></tr>
											<tr><td><strong>Fecha previa de presentación</strong></td><td><input type="date" class="form-control input-sw" name="fechaprevia" value="" ></td></tr>
											<tr><td><strong>Fecha de próxima audiencia</strong></td><td><input type="date" class="form-control input-sw" name="fechaproxima" value="" ></td></tr>
											<tr><td width="135"><strong>Estatus</strong></td><td colspan="2">
												<select class="form-control input-sm" name="estatus">
													<option value=""></option>
													<option value="EN PREPARACION" <?php if($_POST["estatus"]=="EN PREPARACION")echo "selected"?>>EN PREPARACION</option>
													<option value="EN PROCESO" <?php if($_POST["estatus"]=="EN PROCESO")echo "selected"?>>EN PROCESO</option>
													<option value="PRESENTADA" <?php if($_POST["estatus"]=="PRESENTADA")echo "selected"?>>PRESENTADA</option>
													<option value="NOTIFICADA" <?php if($_POST["estatus"]=="NOTIFICADA")echo "selected"?>>NOTIFICADA</option>
													<option value="CONTESTADA" <?php if($_POST["estatus"]=="CONTESTADA")echo "selected"?>>CONTESTADA</option>
													<option value="ETAPA PROBATORIA" <?php if($_POST["estatus"]=="ETAPA PROBATORIA")echo "selected"?>>ETAPA PROBATORIA</option>
													<option value="SENTENCIA DEFINITIVA" <?php if($_POST["estatus"]=="SENTENCIA DEFINITIVA")echo "selected"?>>SENTENCIA DEFINITIVA</option>
													<option value="APELACION" <?php if($_POST["estatus"]=="APELACION")echo "selected"?>>APELACION</option>
													<option value="AMPARO" <?php if($_POST["estatus"]=="AMPARO")echo "selected"?>>AMPARO</option>
													<option value="RECURSOS DIVERSOS" <?php if($_POST["estatus"]=="RECURSOS DIVERSOS")echo "selected"?>>RECURSOS DIVERSOS</option>
												</select>
											</td></tr>
											<tr><td><strong>Observaciones</strong></td><td><textarea rows="4" class="form-control input-sw" name="observaciones" required></textarea></td></tr>

											<tr><td colspan="3"><input type="submit" class="btn btn-success float-start" value="Agregar"><a href="actualizacion_info.php" class="btn btn-danger float-end">Cancelar</a></td></tr>
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