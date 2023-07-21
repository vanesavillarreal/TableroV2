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

    if($_POST["empresa"]<>"")$filtro=$filtro." and empresa='".$_POST["empresa"]."'";
    if($_POST["sede"]<>"")$filtro=$filtro." and sede='".$_POST["sede"]."'";
    if($_POST["departamento"]<>"")$filtro=$filtro." and departamento='".$_POST["departamento"]."'";
    if($_POST["area"]<>"")$filtro=$filtro." and area='".$_POST["area"]."'";

    $empresa="";
    $sede="";
    $departamento="";
    $area="";
    if($_POST["empresa"]<>"")$empresa=$_POST["empresa"];
    if($_POST["sede"]<>"")$empresa=$_POST["sede"];
    if($_POST["departamento"]<>"")$empresa=$_POST["departamento"];
    if($_POST["area"]<>"")$area=$_POST["area"];
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
                                    <!--a class="nav-link" href="#">P&L</a-->
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
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">NOMINA</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">CORPORATIVO</li>
                        </ol>
                        <form name="form1" method="post" class="row mb-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="empresa" required id="floatingSelectGrid" onChange="document.form1.submit();">
                                        <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct empresa from nominacorporativa where 1=1 $filtro order by empresa";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <option value="<?php echo $row["empresa"] ?>" <?php if($_POST["empresa"]==$row["empresa"])echo "selected"?>><?php echo strtoupper($row["empresa"]) ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Empresa</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="sede" required onChange="document.form1.submit();">
                                    <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct sede from nominacorporativa where sede<>'' $filtro order by sede";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                    						<option value="<?php echo $row["sede"] ?>" <?php if($_POST["sede"]==$row["sede"])echo "selected"?>><?php echo strtoupper($row["sede"]) ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Sede</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="departamento" required onChange="document.form1.submit();">
                                    <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct departamento from nominacorporativa where 1=1 $filtro order by departamento";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
						                <option value="<?php echo $row["departamento"] ?>" <?php if($_POST["departamento"]==$row["departamento"])echo "selected"?>><?php echo strtoupper($row["departamento"]) ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Departamento</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="area" required onChange="document.form1.submit();">
                                        <option value="">-- TODOS --</option>
                                            <?php 
                                                $query = "select distinct area from nominacorporativa where 1=1 $filtro order by area";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result)){
                                            ?>
						                    <option value="<?php echo $row["area"] ?>" <?php if($_POST["area"]==$row["area"])echo "selected"?>><?php echo strtoupper($row["area"]) ?></option>
                                            <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Área</label>
                                </div>
                            </div>
                        </form>
                        <div class="row">     
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-bar me-1"></i>
                                            Integración Nómina
                                        </div>
                                        <?php 
                                            $xml_estatus28b_b="<chart bgcolor='FFFFFF' showSum='0' bgalpha='0' canvasBgRatio='2' borderalpha='0' canvasborderalpha='0' useplotgradientcolor='0' plotborderalpha='0' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='25' legendbgcolor='#CCCCCC' legendbgalpha='20' legendborderalpha='0' legendshadow='0'>";
                                            
                                            $xml_estatus28b_b=$xml_estatus28b_b."<categories>";
                                                
                                                $query = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $categoria=$row['categoria'];
                                                    $xml_estatus28b_b = $xml_estatus28b_b . "<category label='$categoria' />";
                                                    }

                                            $xml_estatus28b_b=$xml_estatus28b_b."</categories>";


                                                $xml_estatus28b_b=$xml_estatus28b_b."<dataset seriesName='S. FISCAL'>";
                                    
                                                    $query2 = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                                    $result2 = mysqli_query($mysqli,$query2);
                                                    while($row2 = mysqli_fetch_assoc($result2))
                                                        {
                                                        $categoria=$row2['categoria'];
                                        
                                                        $query = "select round(sum(sfiscal),2) as cant from nominacorporativa where 1=1 $filtro and empresa='$categoria'";
                                                        $result = mysqli_query($mysqli,$query);
                                                        while($row = mysqli_fetch_assoc($result))
                                                            {
                                                            $cant=$row['cant'];
                                                            $nomostrar="";
                                                            if($cant==0)$nomostrar="showValue='0'";
                                                            $xml_estatus28b_b=$xml_estatus28b_b."<set $nomostrar value='$cant'  link='N-listanc8.php?empresa=$categoria&sede=$sede&departamento=$departamento&area=$area' />";
                                                            }
                                        
                                                        }
                                    
                                                $xml_estatus28b_b=$xml_estatus28b_b."</dataset>";


                                                $xml_estatus28b_b=$xml_estatus28b_b."<dataset seriesName='COMPLEMENTO S.'>";
                                    
                                                    $query2 = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                                    $result2 = mysqli_query($mysqli,$query2);
                                                    while($row2 = mysqli_fetch_assoc($result2))
                                                        {
                                                        $categoria=$row2['categoria'];
                                        
                                                        $query = "select round(sum(complementos),2) as cant from nominacorporativa where 1=1 $filtro and empresa='$categoria'";
                                                        $result = mysqli_query($mysqli,$query);
                                                        while($row = mysqli_fetch_assoc($result))
                                                            {
                                                            $cant=$row['cant'];
                                                            $nomostrar="";
                                                            if($cant==0)$nomostrar="showValue='0'";
                                                            $xml_estatus28b_b=$xml_estatus28b_b."<set $nomostrar value='$cant'  link='N-listanc9.php?empresa=$categoria&sede=$sede&departamento=$departamento&area=$area' />";
                                                            }
                                        
                                                        }
                                    
                                                $xml_estatus28b_b=$xml_estatus28b_b."</dataset>";

                                                $xml_estatus28b_b=$xml_estatus28b_b."<dataset seriesName='S. MENSUAL'>";
                                    
                                                    $query2 = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                                    $result2 = mysqli_query($mysqli,$query2);
                                                    while($row2 = mysqli_fetch_assoc($result2))
                                                        {
                                                        $categoria=$row2['categoria'];
                                        
                                                        $query = "select round(sum(salariomensualneto),2) as cant from nominacorporativa where 1=1 $filtro and empresa='$categoria'";
                                                        $result = mysqli_query($mysqli,$query);
                                                        while($row = mysqli_fetch_assoc($result))
                                                            {
                                                            $cant=$row['cant'];
                                                            $nomostrar="";
                                                            if($cant==0)$nomostrar="showValue='0'";
                                                            $xml_estatus28b_b=$xml_estatus28b_b."<set $nomostrar value='$cant'  link='N-listanc9.php?empresa=$categoria&sede=$sede&departamento=$departamento&area=$area' />";
                                                            }
                                        
                                                        }
                                    
                                                $xml_estatus28b_b=$xml_estatus28b_b."</dataset>";

                                                    
                                            $xml_estatus28b_b=$xml_estatus28b_b."</chart>";
                                            ?>
                                            
                                            <script type="text/javascript">
                                                FusionCharts.ready(  function  () { 
                                                    var myChart =  new FusionCharts({"type" : "stackedbar2d","renderAt" : "xml_estatus28b_b","width" : "100%","height" : "500","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatus28b_b ?>"});
                                                    myChart.render();
                                                });
                                            </script>
                                            
                                            <div id="xml_estatus28b_b">Cargando...</div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Personas con Prestaciones Adicionales
                                    </div>
                                    <?php 
                                        $xml_estatus28a="<chart bgcolor='FFFFFF' showSum='1' bgalpha='0' canvasBgRatio='2' borderalpha='0' canvasborderalpha='0' useplotgradientcolor='0' plotborderalpha='0' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='25' legendbgcolor='#CCCCCC' legendbgalpha='20' legendborderalpha='0' legendshadow='0'>";
                                        
                                        $xml_estatus28a=$xml_estatus28a."<categories>";
                                            
                                            $query = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result))
                                                {
                                                $categoria=$row['categoria'];
                                                $xml_estatus28a = $xml_estatus28a . "<category label='$categoria' />";
                                                }

                                        $xml_estatus28a=$xml_estatus28a."</categories>";


                                            $xml_estatus28a=$xml_estatus28a."<dataset seriesName='SEDE'>";
                                
                                                $query2 = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                                $result2 = mysqli_query($mysqli,$query2);
                                                while($row2 = mysqli_fetch_assoc($result2))
                                                    {
                                                    $categoria=$row2['categoria'];
                                    
                                                    $query = "select count(*) as cant from nominacorporativa where sede<>'' $filtro and empresa='$categoria'";
                                                    $result = mysqli_query($mysqli,$query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                        {
                                                        $cant=$row['cant'];
                                                        $nomostrar="";
                                                        if($cant==0)$nomostrar="showValue='0'";
                                                        $xml_estatus28a=$xml_estatus28a."<set $nomostrar value='$cant'  link='N-listanc3.php?empresa=$categoria&sede=$sede&departamento=$departamento&area=$area' />";
                                                        }
                                    
                                                    }
                                
                                            $xml_estatus28a=$xml_estatus28a."</dataset>";


                                            $xml_estatus28a=$xml_estatus28a."<dataset seriesName='VEH�CULO'>";
                                
                                                $query2 = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                                $result2 = mysqli_query($mysqli,$query2);
                                                while($row2 = mysqli_fetch_assoc($result2))
                                                    {
                                                    $categoria=$row2['categoria'];
                                    
                                                    $query = "select count(*) as cant from nominacorporativa where vehiculo='SI' $filtro and empresa='$categoria'";
                                                    $result = mysqli_query($mysqli,$query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                        {
                                                        $cant=$row['cant'];
                                                        $nomostrar="";
                                                        if($cant==0)$nomostrar="showValue='0'";
                                                        $xml_estatus28a=$xml_estatus28a."<set $nomostrar value='$cant'  link='N-listanc4.php?empresa=$categoria&sede=$sede&departamento=$departamento&area=$area' />";
                                                        }
                                    
                                                    }
                                
                                            $xml_estatus28a=$xml_estatus28a."</dataset>";

                                                
                                            $xml_estatus28a=$xml_estatus28a."<dataset seriesName='GASOLINA'>";
                                
                                                $query2 = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                                $result2 = mysqli_query($mysqli,$query2);
                                                while($row2 = mysqli_fetch_assoc($result2))
                                                    {
                                                    $categoria=$row2['categoria'];
                                    
                                                    $query = "select count(*) as cant from nominacorporativa where gasolina='SI' $filtro and empresa='$categoria'";
                                                    $result = mysqli_query($mysqli,$query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                        {
                                                        $cant=$row['cant'];
                                                        $nomostrar="";
                                                        if($cant==0)$nomostrar="showValue='0'";
                                                        $xml_estatus28a=$xml_estatus28a."<set $nomostrar value='$cant'  link='N-listanc5.php?empresa=$categoria&sede=$sede&departamento=$departamento&area=$area' />";
                                                        }
                                    
                                                    }
                                
                                            $xml_estatus28a=$xml_estatus28a."</dataset>";

                                                
                                            $xml_estatus28a=$xml_estatus28a."<dataset seriesName='CASA/DEPA'>";
                                
                                                $query2 = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                                $result2 = mysqli_query($mysqli,$query2);
                                                while($row2 = mysqli_fetch_assoc($result2))
                                                    {
                                                    $categoria=$row2['categoria'];
                                    
                                                    $query = "select count(*) as cant from nominacorporativa where casa='SI' $filtro and empresa='$categoria'";
                                                    $result = mysqli_query($mysqli,$query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                        {
                                                        $cant=$row['cant'];
                                                        $nomostrar="";
                                                        if($cant==0)$nomostrar="showValue='0'";
                                                        $xml_estatus28a=$xml_estatus28a."<set $nomostrar value='$cant'  link='N-listanc6.php?empresa=$categoria&sede=$sede&departamento=$departamento&area=$area' />";
                                                        }
                                    
                                                    }
                                
                                            $xml_estatus28a=$xml_estatus28a."</dataset>";

                                                
                                            $xml_estatus28a=$xml_estatus28a."<dataset seriesName='CELULAR'>";
                                
                                                $query2 = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                                $result2 = mysqli_query($mysqli,$query2);
                                                while($row2 = mysqli_fetch_assoc($result2))
                                                    {
                                                    $categoria=$row2['categoria'];
                                    
                                                    $query = "select count(*) as cant from nominacorporativa where celular='SI' $filtro and empresa='$categoria'";
                                                    $result = mysqli_query($mysqli,$query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                        {
                                                        $cant=$row['cant'];
                                                        $nomostrar="";
                                                        if($cant==0)$nomostrar="showValue='0'";
                                                        $xml_estatus28a=$xml_estatus28a."<set $nomostrar value='$cant'  link='N-listanc7.php?empresa=$categoria&sede=$sede&departamento=$departamento&area=$area' />";
                                                        }
                                    
                                                    }
                                
                                            $xml_estatus28a=$xml_estatus28a."</dataset>";

                                                
                                        $xml_estatus28a=$xml_estatus28a."</chart>";
                                        ?>
                                        
                                        <script type="text/javascript">
                                            FusionCharts.ready(  function  () { 
                                                var myChart =  new FusionCharts({"type" : "mscolumn2d","renderAt" : "xml_estatus28a","width" : "100%","height" : "500","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatus28a ?>"});
                                                myChart.render();
                                            });
                                        </script>
                                        
                                        <div id="xml_estatus28a">Cargando...</div>
                                </div>
                            </div>
                        
                            
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Costo Total
                                    </div>
                                    <?php 
                                    $xml_estatus28="<chart  caption='Costo Total' bgcolor='FFFFFF' showSum='1' bgalpha='0' canvasBgRatio='2' borderalpha='0' canvasborderalpha='0' useplotgradientcolor='0' plotborderalpha='0' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='25' legendbgcolor='#CCCCCC' legendbgalpha='20' legendborderalpha='0' legendshadow='0'>";
                                    
                                    $xml_estatus28=$xml_estatus28."<categories>";
                                        
                                        $query = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria=$row['categoria'];
                                            $xml_estatus28 = $xml_estatus28 . "<category label='$categoria' />";
                                            }

                                    $xml_estatus28=$xml_estatus28."</categories>";


                                        $xml_estatus28=$xml_estatus28."<dataset seriesName='SUELDO MENSUAL NETO'>";
                            
                                            $query2 = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                            $result2 = mysqli_query($mysqli,$query2);
                                            while($row2 = mysqli_fetch_assoc($result2))
                                                {
                                                $categoria=$row2['categoria'];
                                
                                                $query = "select round(sum(salariomensualneto),2) as cant from nominacorporativa where 1=1 $filtro and empresa='$categoria'";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $cant=$row['cant'];
                                                    $nomostrar="";
                                                    if($cant==0)$nomostrar="showValue='0'";
                                                    $xml_estatus28=$xml_estatus28."<set $nomostrar value='$cant'  link='N-listanc.php?empresa=$categoria&sede=$sede&departamento=$departamento&area=$area' />";
                                                    }
                                
                                                }
                            
                                        $xml_estatus28=$xml_estatus28."</dataset>";


                                        $xml_estatus28=$xml_estatus28."<dataset seriesName='COSTO TOTAL'>";
                            
                                            $query2 = "select distinct empresa as categoria from nominacorporativa where 1=1 $filtro order by empresa";
                                            $result2 = mysqli_query($mysqli,$query2);
                                            while($row2 = mysqli_fetch_assoc($result2))
                                                {
                                                $categoria=$row2['categoria'];
                                
                                                $query = "select round(sum(costototal),2) as cant from nominacorporativa where 1=1 $filtro and empresa='$categoria'";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $cant=$row['cant'];
                                                    $nomostrar="";
                                                    if($cant==0)$nomostrar="showValue='0'";
                                                    $xml_estatus28=$xml_estatus28."<set $nomostrar value='$cant'  link='N-listanc2.php?empresa=$categoria&sede=$sede&departamento=$departamento&area=$area' />";
                                                    }
                                
                                                }
                            
                                        $xml_estatus28=$xml_estatus28."</dataset>";

                                            
                                    $xml_estatus28=$xml_estatus28."</chart>";
                                    ?>
                                    
                                    <script type="text/javascript">
                                        FusionCharts.ready(  function  () { 
                                            var myChart =  new FusionCharts({"type" : "msbar2d","renderAt" : "xml_estatus28","width" : "100%","height" : "500","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatus28 ?>"});
                                            myChart.render();
                                        });
                                    </script>
                                    
                                    <div id="xml_estatus28">Cargando...</div>
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
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>