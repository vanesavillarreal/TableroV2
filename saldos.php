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
                                if($_SESSION['tipo'] == "saldos"){
                            ?>
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
                                                <a class="nav-link" href="register.html">Registro de Cambios</a>
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
                                <?php    
                                    }
                                ?>
                            </div>
                        </nav>
                    </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">SALDOS</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">CORPORATIVO</li>
                        </ol>
                        <form name="form1" method="post" class="row text-center justify-content-center mb-4">
                            <div class="col-xl-6 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="empresa" required onChange="document.form1.submit();">
                                        <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select empresa from saldos where tipo='normal'";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <option value="<?php echo $row["empresa"] ?>" <?php if($_POST["empresa"]==$row["empresa"])echo "selected"?>><?php echo $row["empresa"] ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Empresa</label>
                                </div>
                            </div>
                        </form>
                        <div class="row">     
                            <div class="col-sm-12 col-sm-offset-2">
                                <div class="card text-center justify-content-center mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Movimientos: General
                                    </div>
                                    <?php 
                                        $eempresa=$_POST["empresa"];
                                        if($eempresa=="")$eempresa="General";
                                        $xml_estatusq="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='0' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' yAxisMaxValue='100' numberprefix='$' >";
                                        
                                        $query = "select sum(saldo) as cant from saldos where 1=1 $filtro and tipo='normal'";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria="SALDOS HOY";
                                            $cant=$row['cant'];
                                            $xml_estatusq = $xml_estatusq . "<set label='$categoria' value='$cant' />";
                                            }
                                                    
                                        $query = "select sum(saldo) as cant from saldos where 1=1 $filtro and tipo='pagos'";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria="PAGOS HOY";
                                            $cant=$row['cant'];
                                            $xml_estatusq = $xml_estatusq . "<set label='$categoria' value='$cant' />";
                                            }
                                                    
                                        $query = "select sum(saldo) as cant from saldos where 1=1 $filtro and tipo='cuentaspp'";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria="CUENTAS POR PAGAR DIA SIGUIENTE";
                                            $cant=$row['cant'];
                                            $xml_estatusq = $xml_estatusq . "<set label='$categoria' value='$cant' />";
                                            }

                                        $query = "select sum(saldo) as cant from saldos where 1=1 $filtro and tipo='nominasem'";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria="NÓMINA SEMANAL";
                                            $cant=$row['cant'];
                                            $xml_estatusq = $xml_estatusq . "<set label='$categoria' value='$cant' />";
                                            }
                                                    
                                        $query = "select sum(saldo) as cant from saldos where 1=1 $filtro and tipo='nominaquin'";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria="NÓMINA QUINCENAL";
                                            $cant=$row['cant'];
                                            $xml_estatusq = $xml_estatusq . "<set label='$categoria' value='$cant' />";
                                            }
                                                    
                                        $query = "select sum(saldo) as cant from saldos where 1=1 $filtro and tipo='imss'";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria="IMSS";
                                            $cant=$row['cant'];
                                            $xml_estatusq = $xml_estatusq . "<set label='$categoria' value='$cant' />";
                                            }
                                                    
                                        $query = "select sum(saldo) as cant from saldos where 1=1 $filtro and tipo='impuestos'";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria="IMPUESTOS FEDERALES Y ESTATALES";
                                            $cant=$row['cant'];
                                            $xml_estatusq = $xml_estatusq . "<set label='$categoria' value='$cant' />";
                                            }
                                                    
                                        $query = "select sum(saldo) as cant from saldos where 1=1 $filtro and tipo='disponible'";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria="SALDO DISPONIBLE";
                                            $cant=$row['cant'];
                                            $xml_estatusq = $xml_estatusq . "<set label='$categoria' value='$cant' />";
                                            }
                                                    
                                                    
                                        $xml_estatusq=$xml_estatusq."</chart>";
                                        ?>
                                        
                                        <script type="text/javascript">
                                            FusionCharts.ready(  function  () { 
                                                var myChart =  new FusionCharts({"type" : "column2d","renderAt" : "xml_estatusq","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusq ?>"});
                                                myChart.render();
                                            });
                                        </script>
                                        
                                        <div id="xml_estatusq">Cargando...</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="card col-sm-6 mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Saldos hoy
                                    </div>
                                    <?php 
                                        $xml_estatusqsdf="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' yAxisMaxValue='100' numberprefix='$' >";
                                        
                                        $query = "select empresa as categoria,sum(saldo) as cant from saldos where 1=1 and tipo='normal' group by empresa";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria=strtoupper($row['categoria']);
                                            $cant=$row['cant'];
                                            $xml_estatusqsdf = $xml_estatusqsdf . "<set label='$categoria' value='$cant'  />";
                                            }
                                                    
                                        $xml_estatusqsdf=$xml_estatusqsdf."</chart>";
                                        ?>
                                        
                                        <script type="text/javascript">
                                            FusionCharts.ready(  function  () { 
                                                var myChart =  new FusionCharts({"type" : "bar2d","renderAt" : "xml_estatusqsdf","width" : "100%","height" : "384","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusqsdf ?>"});
                                                myChart.render();
                                            });
                                        </script>
                                        
                                        <div id="xml_estatusqsdf">Cargando...</div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Pagos hoy
                                    </div>
                                        <?php 
                                        $xml_estatusqsdfskfhdfjh="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' yAxisMaxValue='100' numberprefix='$' >";
                                        
                                        $query = "select empresa as categoria,sum(saldo) as cant from saldos where 1=1 and tipo='pagos' group by empresa";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria=strtoupper($row['categoria']);
                                            $cant=$row['cant'];
                                            $xml_estatusqsdfskfhdfjh = $xml_estatusqsdfskfhdfjh . "<set label='$categoria' value='$cant'  />";
                                            }
                                                    
                                        $xml_estatusqsdfskfhdfjh=$xml_estatusqsdfskfhdfjh."</chart>";
                                        ?>
                                        
                                        <script type="text/javascript">
                                            FusionCharts.ready(  function  () { 
                                                var myChart =  new FusionCharts({"type" : "bar2d","renderAt" : "xml_estatusqsdfskfhdfjh","width" : "100%","height" : "384","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusqsdfskfhdfjh ?>"});
                                                myChart.render();
                                            });
                                        </script>
                                        
                                        <div id="xml_estatusqsdfskfhdfjh">Cargando...</div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Resumen de saldos diarios
                                    </div>
                                    <?php 
                                        $xml_estatus28="<chart bgcolor='FFFFFF' showvalues='0' showSum='1' bgalpha='0' canvasBgRatio='2' borderalpha='0' canvasborderalpha='0' useplotgradientcolor='0' plotborderalpha='0' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='25' legendbgcolor='#CCCCCC' legendbgalpha='20' legendborderalpha='0' legendshadow='0' numberprefix='$' >";
                                            
                                        $xml_estatus28=$xml_estatus28."<categories>";
                                                
                                            $query = "select distinct empresa as categoria from saldos where tipo in('normal','pagos','cuentaspp','nominasem','nominaquin','impuestos','disponible','imss')  order by empresa";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result))
                                                {
                                                     $categoria=$row['categoria'];
                                                    $xml_estatus28 = $xml_estatus28 . "<category label='$categoria' />";
                                                }

                                        $xml_estatus28=$xml_estatus28."</categories>";


                                        $xml_estatus28=$xml_estatus28."<dataset seriesName='Saldos Hoy'>";
                                    
                                        $query2 = "select distinct empresa as categoria from saldos where tipo in('normal','pagos','cuentaspp','nominasem','nominaquin','impuestos','disponible','imss')  order by empresa";
                                        $result2 = mysqli_query($mysqli,$query2);
                                            while($row2 = mysqli_fetch_assoc($result2))
                                                {
                                                    $categoria=$row2['categoria'];
                                        
                                                    $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='normal'";
                                                    $result = mysqli_query($mysqli,$query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                        {
                                                            $cant=$row['cant'];
                                                            $nomostrar="";
                                                            if($cant==0)$nomostrar="showValue='0'";
                                                            $taxml_estus28=$xml_estatus28."<set $nomostrar value='$cant'  />";
                                                        }
                                
                                                }
                                    
                                            $xml_estatus28=$xml_estatus28."</dataset>";

                                            $xml_estatus28=$xml_estatus28."<dataset seriesName='Cuentas por pagar día siguiente'>";
                                    
                                            $query2 = "select distinct empresa as categoria from saldos where tipo in('normal','pagos','cuentaspp','nominasem','nominaquin','impuestos','disponible','imss')  order by empresa";
                                            $result2 = mysqli_query($mysqli,$query2);
                                                while($row2 = mysqli_fetch_assoc($result2))
                                                    {
                                                        $categoria=$row2['categoria'];
                                        
                                                        $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='cuentaspp'";
                                                        $result = mysqli_query($mysqli,$query);
                                                        while($row = mysqli_fetch_assoc($result))
                                                            {
                                                                $cant=$row['cant'];
                                                                $nomostrar="";
                                                                if($cant==0)$nomostrar="showValue='0'";
                                                                $xml_estatus28=$xml_estatus28."<set $nomostrar value='$cant'  />";
                                                            }
                                        
                                                    }
                                    
                                            $xml_estatus28=$xml_estatus28."</dataset>";

                                            $xml_estatus28=$xml_estatus28."<dataset seriesName='Nómina semanal'>";
                                    
                                            $query2 = "select distinct empresa as categoria from saldos where tipo in('normal','pagos','cuentaspp','nominasem','nominaquin','impuestos','disponible','imss')  order by empresa";
                                            $result2 = mysqli_query($mysqli,$query2);
                                            while($row2 = mysqli_fetch_assoc($result2))
                                                {
                                                    $categoria=$row2['categoria'];
                                        
                                                    $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='nominasem'";
                                                    $result = mysqli_query($mysqli,$query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                    {
                                                        $cant=$row['cant'];
                                                        $nomostrar="";
                                                        if($cant==0)$nomostrar="showValue='0'";
                                                        $xml_estatus28=$xml_estatus28."<set $nomostrar value='$cant'  />";
                                                    }
                                        
                                                }
                                    
                                            $xml_estatus28=$xml_estatus28."</dataset>";

                                            $xml_estatus28=$xml_estatus28."<dataset seriesName='Nómina quincenal'>";
                                    
                                            $query2 = "select distinct empresa as categoria from saldos where tipo in('normal','pagos','cuentaspp','nominasem','nominaquin','impuestos','disponible','imss')  order by empresa";
                                            $result2 = mysqli_query($mysqli,$query2);
                                                while($row2 = mysqli_fetch_assoc($result2))
                                                    {
                                                        $categoria=$row2['categoria'];
                                        
                                                        $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='nominaquin'";
                                                        $result = mysqli_query($mysqli,$query);
                                                        while($row = mysqli_fetch_assoc($result))
                                                            {
                                                                $cant=$row['cant'];
                                                                $nomostrar="";
                                                                if($cant==0)$nomostrar="showValue='0'";
                                                                $xml_estatus28=$xml_estatus28."<set $nomostrar value='$cant'  />";
                                                            }
                                        
                                                    }
                                    
                                            $xml_estatus28=$xml_estatus28."</dataset>";

                                            $xml_estatus28=$xml_estatus28."<dataset seriesName='IMSS'>";
                                    
                                            $query2 = "select distinct empresa as categoria from saldos where tipo in('normal','pagos','cuentaspp','nominasem','nominaquin','impuestos','disponible','imss')  order by empresa";
                                            $result2 = mysqli_query($mysqli,$query2);
                                                while($row2 = mysqli_fetch_assoc($result2))
                                                    {
                                                        $categoria=$row2['categoria'];
                                        
                                                        $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='imss'";
                                                        $result = mysqli_query($mysqli,$query);
                                                        while($row = mysqli_fetch_assoc($result))
                                                            {
                                                                $cant=$row['cant'];
                                                                $nomostrar="";
                                                                if($cant==0)$nomostrar="showValue='0'";
                                                                $xml_estatus28=$xml_estatus28."<set $nomostrar value='$cant'  />";
                                                            }
                                        
                                                    }
                                    
                                            $xml_estatus28=$xml_estatus28."</dataset>";

                                            $xml_estatus28=$xml_estatus28."<dataset seriesName='Impuestos federales y estatales'>";
                                    
                                            $query2 = "select distinct empresa as categoria from saldos where tipo in('normal','pagos','cuentaspp','nominasem','nominaquin','impuestos','disponible','imss')  order by empresa";
                                            $result2 = mysqli_query($mysqli,$query2);
                                            while($row2 = mysqli_fetch_assoc($result2))
                                                {
                                                    $categoria=$row2['categoria'];
                                        
                                                    $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='impuestos'";
                                                    $result = mysqli_query($mysqli,$query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                        {
                                                            $cant=$row['cant'];
                                                            $nomostrar="";
                                                            if($cant==0)$nomostrar="showValue='0'";
                                                            $xml_estatus28=$xml_estatus28."<set $nomostrar value='$cant'  />";
                                                        }
                                        
                                                }
                                    
                                            $xml_estatus28=$xml_estatus28."</dataset>";

                                            $xml_estatus28=$xml_estatus28."<dataset seriesName='Saldo disponible'>";
                                    
                                            $query2 = "select distinct empresa as categoria from saldos where tipo in('normal','pagos','cuentaspp','nominasem','nominaquin','impuestos','disponible','imss')  order by empresa";
                                            $result2 = mysqli_query($mysqli,$query2);
                                                while($row2 = mysqli_fetch_assoc($result2))
                                                    {
                                                        $categoria=$row2['categoria'];
                                        
                                                        $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='disponible'";
                                                        $result = mysqli_query($mysqli,$query);
                                                        while($row = mysqli_fetch_assoc($result))
                                                            {
                                                                $cant=$row['cant'];
                                                                $nomostrar="";
                                                                if($cant==0)$nomostrar="showValue='0'";
                                                                $xml_estatus28=$xml_estatus28."<set $nomostrar value='$cant'  />";
                                                            }
                                        
                                                        }
                                    
                                        $xml_estatus28=$xml_estatus28."</dataset>";



                                                                    
                                        $xml_estatus28=$xml_estatus28."</chart>";
                                    ?>
                                            
                                    <script type="text/javascript">
                                        FusionCharts.ready(  function  () { 
                                            var myChart =  new FusionCharts({"type" : "stackedcolumn2d","renderAt" : "xml_estatus28","width" : "100%","height" : "500","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatus28 ?>"});
                                            myChart.render();
                                        });
                                    </script>
                                            
                                    <div id="xml_estatus28">Cargando...</div>
                                </div>
			                </div>
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Cŕeditos
                                    </div>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <?php 
                                                $xml_estatusds="<chart bgcolor='FFFFFF' showvalues='0' showSum='1' bgalpha='0' canvasBgRatio='2' borderalpha='0' canvasborderalpha='0' useplotgradientcolor='0' plotborderalpha='0' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='25' legendbgcolor='#CCCCCC' legendbgalpha='20' legendborderalpha='0' legendshadow='0' numberprefix='$' >";
                                                
                                                $xml_estatusds=$xml_estatusds."<categories>";
                                                    
                                                    $query = "select distinct empresa as categoria from saldos where tipo in('linea','deuda','disponiblebancario')  order by empresa";
                                                    $result = mysqli_query($mysqli,$query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                        {
                                                        $categoria=$row['categoria'];
                                                        $xml_estatusds = $xml_estatusds . "<category label='$categoria' />";
                                                        }
                                    
                                                $xml_estatusds=$xml_estatusds."</categories>";
                                    
                                    
                                                    $xml_estatusds=$xml_estatusds."<dataset seriesName='Línea de crédito'>";
                                        
                                                        $query2 = "select distinct empresa as categoria from saldos where tipo in('linea','deuda','disponiblebancario')  order by empresa";
                                                        $result2 = mysqli_query($mysqli,$query2);
                                                        while($row2 = mysqli_fetch_assoc($result2))
                                                            {
                                                            $categoria=$row2['categoria'];
                                            
                                                            $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='linea'";
                                                            $result = mysqli_query($mysqli,$query);
                                                            while($row = mysqli_fetch_assoc($result))
                                                                {
                                                                $cant=$row['cant'];
                                                                $nomostrar="";
                                                                if($cant==0)$nomostrar="showValue='0'";
                                                                $xml_estatusds=$xml_estatusds."<set $nomostrar value='$cant' />";
                                                                }
                                            
                                                            }
                                        
                                                    $xml_estatusds=$xml_estatusds."</dataset>";
                                    
                                                    $xml_estatusds=$xml_estatusds."<dataset seriesName='Deuda'>";
                                        
                                                        $query2 = "select distinct empresa as categoria from saldos where tipo in('linea','deuda','disponiblebancario')  order by empresa";
                                                        $result2 = mysqli_query($mysqli,$query2);
                                                        while($row2 = mysqli_fetch_assoc($result2))
                                                            {
                                                            $categoria=$row2['categoria'];
                                            
                                                            $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='deuda'";
                                                            $result = mysqli_query($mysqli,$query);
                                                            while($row = mysqli_fetch_assoc($result))
                                                                {
                                                                $cant=$row['cant'];
                                                                $nomostrar="";
                                                                if($cant==0)$nomostrar="showValue='0'";
                                                                $xml_estatusds=$xml_estatusds."<set $nomostrar value='$cant'  />";
                                                                }
                                            
                                                            }
                                        
                                                    $xml_estatusds=$xml_estatusds."</dataset>";
                                    
                                                    $xml_estatusds=$xml_estatusds."<dataset seriesName='Disponible'>";
                                        
                                                        $query2 = "select distinct empresa as categoria from saldos where tipo in('linea','deuda','disponiblebancario')  order by empresa";
                                                        $result2 = mysqli_query($mysqli,$query2);
                                                        while($row2 = mysqli_fetch_assoc($result2))
                                                            {
                                                            $categoria=$row2['categoria'];
                                            
                                                            $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='disponiblebancario'";
                                                            $result = mysqli_query($mysqli,$query);
                                                            while($row = mysqli_fetch_assoc($result))
                                                                {
                                                                $cant=$row['cant'];
                                                                $nomostrar="";
                                                                if($cant==0)$nomostrar="showValue='0'";
                                                                $xml_estatusds=$xml_estatusds."<set $nomostrar value='$cant'  />";
                                                                }
                                            
                                                            }
                                        
                                                    $xml_estatusds=$xml_estatusds."</dataset>";
                                    
                                                                    
                                                $xml_estatusds=$xml_estatusds."</chart>";
                                                ?>
                                                
                                                <script type="text/javascript">
                                                    FusionCharts.ready(  function  () { 
                                                        var myChart =  new FusionCharts({"type" : "stackedbar2d","renderAt" : "xml_estatusds","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusds ?>"});
                                                        myChart.render();
                                                    });
                                                </script>
                                                
                                                <div id="xml_estatusds">Cargando...</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Créditos automotrices
                                    </div>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <?php 
                                                $xml_estatusds22="<chart bgcolor='FFFFFF' showvalues='0' showSum='1' bgalpha='0' canvasBgRatio='2' borderalpha='0' canvasborderalpha='0' useplotgradientcolor='0' plotborderalpha='0' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='25' legendbgcolor='#CCCCCC' legendbgalpha='20' legendborderalpha='0' legendshadow='0' numberprefix='$' >";
                                                
                                                $xml_estatusds22=$xml_estatusds22."<categories>";
                                                    
                                                    $query = "select distinct empresa as categoria from saldos where tipo in('saldoscreditos','pagomensual','tasa')  order by empresa";
                                                    $result = mysqli_query($mysqli,$query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                        {
                                                        $categoria=$row['categoria'];
                                                        $xml_estatusds22 = $xml_estatusds22 . "<category label='$categoria' />";
                                                        }
                                    
                                                $xml_estatusds22=$xml_estatusds22."</categories>";
                                    
                                    
                                                    $xml_estatusds22=$xml_estatusds22."<dataset seriesName='Saldos créditos'>";
                                        
                                                        $query2 = "select distinct empresa as categoria from saldos where tipo in('saldoscreditos','pagomensual','tasa')  order by empresa";
                                                        $result2 = mysqli_query($mysqli,$query2);
                                                        while($row2 = mysqli_fetch_assoc($result2))
                                                            {
                                                            $categoria=$row2['categoria'];
                                            
                                                            $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='saldoscreditos'";
                                                            $result = mysqli_query($mysqli,$query);
                                                            while($row = mysqli_fetch_assoc($result))
                                                                {
                                                                $cant=$row['cant'];
                                                                $nomostrar="";
                                                                if($cant==0)$nomostrar="showValue='0'";
                                                                $xml_estatusds22=$xml_estatusds22."<set $nomostrar value='$cant' />";
                                                                }
                                            
                                                            }
                                        
                                                    $xml_estatusds22=$xml_estatusds22."</dataset>";
                                    
                                                    $xml_estatusds22=$xml_estatusds22."<dataset seriesName='Pago mensual'>";
                                        
                                                        $query2 = "select distinct empresa as categoria from saldos where tipo in('saldoscreditos','pagomensual','tasa')  order by empresa";
                                                        $result2 = mysqli_query($mysqli,$query2);
                                                        while($row2 = mysqli_fetch_assoc($result2))
                                                            {
                                                            $categoria=$row2['categoria'];
                                            
                                                            $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='pagomensual'";
                                                            $result = mysqli_query($mysqli,$query);
                                                            while($row = mysqli_fetch_assoc($result))
                                                                {
                                                                $cant=$row['cant'];
                                                                $nomostrar="";
                                                                if($cant==0)$nomostrar="showValue='0'";
                                                                $xml_estatusds22=$xml_estatusds22."<set $nomostrar value='$cant'  />";
                                                                }
                                            
                                                            }
                                        
                                                    $xml_estatusds22=$xml_estatusds22."</dataset>";
                                    
                                                    $xml_estatusds22=$xml_estatusds22."<dataset seriesName='Tasa (porcentaje)'>";
                                        
                                                        $query2 = "select distinct empresa as categoria from saldos where tipo in('saldoscreditos','pagomensual','tasa')  order by empresa";
                                                        $result2 = mysqli_query($mysqli,$query2);
                                                        while($row2 = mysqli_fetch_assoc($result2))
                                                            {
                                                            $categoria=$row2['categoria'];
                                            
                                                            $query = "select saldo as cant from saldos where 1=1  and empresa='$categoria' and tipo='tasa'";
                                                            $result = mysqli_query($mysqli,$query);
                                                            while($row = mysqli_fetch_assoc($result))
                                                                {
                                                                $cant=$row['cant'];
                                                                //$nomostrar="";
                                                                //if($cant==0)$nomostrar="showValue='0'";
                                                                $xml_estatusds22=$xml_estatusds22."<set $nomostrar value='$cant'  />";
                                                                }
                                            
                                                            }
                                        
                                                    $xml_estatusds22=$xml_estatusds22."</dataset>";
                                    
                                                                    
                                                $xml_estatusds22=$xml_estatusds22."</chart>";
                                                ?>
                                                
                                                <script type="text/javascript">
                                                    FusionCharts.ready(  function  () { 
                                                        var myChart =  new FusionCharts({"type" : "stackedbar2d","renderAt" : "xml_estatusds22","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusds22 ?>"});
                                                        myChart.render();
                                                    });
                                                </script>
                                                
                                                <div id="xml_estatusds22">Cargando...</div>
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