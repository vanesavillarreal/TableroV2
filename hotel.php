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

    //current date
    $datetimeString = date('Y-m-d');
    $datetime = new DateTime($datetimeString);
    $mes = $datetime->format('m'); //setear con mes actual
    $anio = $datetime->format('Y');
    if($_POST["anio"]<>"")$anio=$_POST["anio"];
    if($_POST["mes"]<>"")$mes=$_POST["mes"];
    
    $meses = array(
        1 => 'enero',
        2 => 'febrero',
        3 => 'marzo',
        4 => 'abril',
        5 => 'mayo',
        6 => 'junio',
        7 => 'julio',
        8 => 'agosto',
        9 => 'septiembre',
        10 => 'octubre',
        11 => 'noviembre',
        12 => 'diciembre'
    );  
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
                        <h1 class="mt-4">INDICADORES</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">HOTEL</li>
                        </ol>
                        <form name="form1" method="post" class="row mb-4">
                            <div class="col-xl-6 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="anio" required id="floatingSelectGrid" onChange="document.form1.submit();">
                                        <option value="2022" <?php if($anio=="2022")echo "selected"?>>2022</option>
                                        <option value="2023" <?php if($anio=="2023")echo "selected"?>>2023</option>
                                    </select>
                                    <label for="floatingSelectGrid">Año</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="mes" required onChange="document.form1.submit();">
                                    <option value="<?php echo intval($mes) ?>">
                                        <?php 
                                            echo ucfirst($meses[intval($mes)]);
                                        ?>
                                    </option>
                                            <?php 
                                                $query ="SELECT distinct MONTH(fecha) AS mes
                                                    FROM hotel 
                                                    ORDER BY mes";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                        <option value="<?php echo $row["mes"] ?>" <?php                        
                                            $nombreMes = $meses[$row["mes"]];
                                            if($_POST["mes"]==$row["mes"])echo "selected"?>><?php echo ucfirst($nombreMes) ?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <label for="floatingSelectGrid">Mes</label>
                                </div>
                            </div>
                        </form>
                        <div class="row">     
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-bar me-1"></i>
                                            Tarifa promedio diaria
                                        </div>
                                    <?php 
                                        $fechas = [];
                                        $dia = 0;
                                        $primerDiaDelMes = new DateTime("{$anio}-{$mes}-01");
                                        $siguienteMes = clone $primerDiaDelMes;
                                        $siguienteMes->modify('+1 month');
                                        while($primerDiaDelMes < $siguienteMes){
                                            $fechas[] = $primerDiaDelMes->format('Y-m-d');
                                            $primerDiaDelMes->modify('+1 day');
                                        }
                                        $xml_estatus28="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' yAxisMaxValue='100' numberprefix='$' >";
                                        $ultimo_dia = end($fechas);
                                        $sql = "SELECT DAY(fecha) AS dia, tarifa_promedio
                                        FROM hotel
                                        WHERE fecha BETWEEN '$fechas[0]' AND '$ultimo_dia'";
                                        //echo $sql;
                                        $result = mysqli_query($mysqli,$sql);
                                                while($row = mysqli_fetch_assoc($result))
                                                    {
                                                        $day = $row["dia"];
                                                        $tarifaPromedio = $row["tarifa_promedio"];
                                                        $xml_estatus28 = $xml_estatus28 . "<set label='$day' value='$tarifaPromedio' link='N-listahotel.php?mes=$mes&anio=$anio' />";
                                                    }
                                            
                                        $xml_estatus28=$xml_estatus28."</chart>";
                                        echo $xml_estatus28;
                                    ?>
                                    <script type="text/javascript">
                                        FusionCharts.ready(  function  () { 
                                            var myChart =  new FusionCharts({"type" : "column2d","renderAt" : "xml_estatus28","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatus28 ?>"});
                                            myChart.render();
                                        });
                                    </script>
                                    <div id="xml_estatus28">Cargando...</div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Ingresos diarios
                                    </div>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <?php 
                                                $xml_estatusq="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' yAxisMaxValue='100' numberprefix='$' >";
                                                
                                                $sql = "SELECT DAY(fecha) AS dia, ingresos
                                                FROM hotel
                                                WHERE fecha BETWEEN '$fechas[0]' AND '$ultimo_dia'";
                                                $result = mysqli_query($mysqli,$sql);
                                                    while($row = mysqli_fetch_assoc($result))
                                                    {
                                                        $day = $row["dia"];
                                                        $ingresos = $row["ingresos"];
                                                        $xml_estatusq = $xml_estatusq . "<set label='$day' value='$ingresos' link='N-listahotel.php?mes=$mes&anio=$anio' />";
                                                    }
                                                                
                                                $xml_estatusq=$xml_estatusq."</chart>";
                                                echo $xml_estatusq;
                                                ?>
                                                
                                                <script type="text/javascript">
                                                    FusionCharts.ready(  function  () { 
                                                        var myChart =  new FusionCharts({"type" : "column2d","renderAt" : "xml_estatusq","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusq ?>"});
                                                        myChart.render();
                                                    });
                                                </script>
                                                
                                                <div id="xml_estatusq">Cargando...</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        
                            
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-bar me-1"></i>
                                            % Ocupación diaria
                                        </div>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <?php 

                                                $xml_estatusds="<chart caption='' bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' yAxisMaxValue='100' numbersuffix='%' >";

                                                $sql = "SELECT DAY(fecha) AS dia, porcentaje_ocupacion
                                                        FROM hotel
                                                        WHERE fecha BETWEEN '$fechas[0]' AND '$ultimo_dia'";
                                                $result = mysqli_query($mysqli,$sql);
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    $day = $row["dia"];
                                                    $porcetajeDeOcupacion = $row["porcentaje_ocupacion"];
                                                    $xml_estatusds = $xml_estatusds . "<set label='$day' value='$porcetajeDeOcupacion' link='N-listahotel.php?mes=$mes&anio=$anio' />";
                                                }
                                                            
                                                $xml_estatusds=$xml_estatusds."</chart>";
                                                echo $xml_estatusds;
                                                ?>
                                                
                                                <script type="text/javascript">
                                                    FusionCharts.ready(  function  () { 
                                                        var myChart =  new FusionCharts({"type" : "column2d","renderAt" : "xml_estatusds","width" : "100%","height" : "600","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusds ?>"});
                                                        myChart.render();
                                                    });
                                                </script>
                                                
                                                <div id="xml_estatusds">Cargando...</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
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