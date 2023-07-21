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

    if($_POST["tipo"]<>"")$filtro=$filtro." and tipo='".$_POST["tipo"]."'";
    if($_POST["municipio"]<>"")$filtro=$filtro." and municipio='".$_POST["municipio"]."'";
    if($_POST["propietario"]<>"")$filtro=$filtro." and propietario='".$_POST["propietario"]."'";
    if($_POST["oportunidad"]<>"")$filtro=$filtro." and oportunidad='".$_POST["oportunidad"]."'";

    $tipo="";
    $municipio="";
    $propietario="";
    $oportunidad="";
    if($_POST["tipo"]<>"")$tipo=$_POST["tipo"];
    if($_POST["municipio"]<>"")$municipio=$_POST["municipio"];
    if($_POST["propietario"]<>"")$propietario=$_POST["propietario"];
    if($_POST["oportunidad"]<>"")$oportunidad=$_POST["oportunidad"];
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
                        <h1 class="mt-4">INVENTARIO DE PROPIEDADES</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">CORPORATIVO</li>
                        </ol>
                        <form name="form1" method="post" class="row mb-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="tipo" required id="floatingSelectGrid" onChange="document.form1.submit();">
                                    <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct tipo from propiedades where tipo<>'' $filtro order by tipo";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <option value="<?php echo $row["tipo"] ?>" <?php if($_POST["tipo"]==$row["tipo"])echo "selected"?>><?php echo strtoupper($row["tipo"]) ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Tipo</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="municipio" required onChange="document.form1.submit();">
                                        <option value="">-- TODOS --</option>
                                            <?php 
                                                $query = "select distinct municipio from propiedades where 1=1 $filtro order by municipio";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                        	<option value="<?php echo $row["municipio"] ?>" <?php if($_POST["municipio"]==$row["municipio"])echo "selected"?>><?php echo strtoupper($row["municipio"]) ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Municipio</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="propietario" required onChange="document.form1.submit();">
                                    <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct propietario from propiedades where propietario<>'' $filtro order by propietario";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                    <option value="<?php echo $row["propietario"] ?>" <?php if($_POST["propietario"]==$row["propietario"])echo "selected"?>><?php echo strtoupper($row["propietario"]) ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Propietario</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="oportunidad" required onChange="document.form1.submit();">
                                    <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct oportunidad from propiedades where oportunidad<>'' $filtro order by oportunidad";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                    <option value="<?php echo $row["oportunidad"] ?>" <?php if($_POST["oportunidad"]==$row["oportunidad"])echo "selected"?>><?php echo strtoupper($row["oportunidad"]) ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Oportunidad</label>
                                </div>
                            </div>
                        </form>
                        <div class="row">     
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Tipo
                                    </div>
                                    <?php 
                                        $xml_estatusds="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10'  >";
                                        
                                        $query = "select tipo as categoria,count(*) as cant from propiedades where 1=1 $filtro group by tipo";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria=strtoupper($row['categoria']);
                                            $cant=$row['cant'];
                                            $xml_estatusds = $xml_estatusds . "<set label='$categoria' value='$cant' />";
                                            }
                                                    
                                        $xml_estatusds=$xml_estatusds."</chart>";
                                        ?>
                                        
                                        <script type="text/javascript">
                                            FusionCharts.ready(  function  () { 
                                                var myChart =  new FusionCharts({"type" : "bar2d","renderAt" : "xml_estatusds","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusds ?>"});
                                                myChart.render();
                                            });
                                        </script>
                                        
                                        <div id="xml_estatusds">Cargando...</div>   
                                </div>
                            </div>   

                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Propietario
                                    </div>
                                    <?php 
                                        $xml_estatusds2="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10'  >";
                                        
                                        $query = "select propietario as categoria,count(*) as cant from propiedades where propietario<>'' $filtro group by propietario";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria=strtoupper($row['categoria']);
                                            $cant=$row['cant'];
                                            $xml_estatusds2 = $xml_estatusds2 . "<set label='$categoria' value='$cant'  />";
                                            }
                                                    
                                        $xml_estatusds2=$xml_estatusds2."</chart>";
                                    ?>
                                        
                                    <script type="text/javascript">
                                        FusionCharts.ready(  function  () { 
                                            var myChart =  new FusionCharts({"type" : "bar2d","renderAt" : "xml_estatusds2","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusds2 ?>"});
                                            myChart.render();
                                        });
                                    </script>
                                        
                                    <div id="xml_estatusds2">Cargando...</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                        Municipio
                                    </div>
                                    <?php 
                                        $xml_estatusq="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' >";
                                        
                                        $query = "select distinct municipio as categoria,count(*) as cant from propiedades where 1=1 $filtro group by municipio";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria=strtoupper($row['categoria']);
                                            $cant=$row['cant'];
                                            $xml_estatusq = $xml_estatusq . "<set label='$categoria' value='$cant'  />";
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

                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fa-solid fa-chart-pie"></i>
                                        Oportunidad
                                    </div>
                                    <?php 
                                        $xml_estatus2dhg="<chart bgcolor='FFFFFF' palette='1' showvalues='1' showpercentvalues='1' borderalpha='20' showplotborder='0' showlegend='1' showlabels='0' legendborder='1' legendposition='bottom' enablesmartlabels='1' use2dlighting='0' showshadow='0' legendbgcolor='#CCCCCC' legendbgalpha='20' legendborderalpha='0' legendshadow='0' legendnumcolumns='2' >";
                                        
                                        $query = "select oportunidad as categoria,count(*) as cant from propiedades where 1=1 $filtro group by oportunidad";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria=strtoupper($row['categoria']);
                                            $cant=$row['cant'];
                                            $xml_estatus2dhg = $xml_estatus2dhg . "<set label='$categoria' value='$cant'  />";
                                            }
                                                    
                                        $xml_estatus2dhg=$xml_estatus2dhg."</chart>";
                                    ?>
                                        
                                    <script type="text/javascript">
                                        FusionCharts.ready(  function  () { 
                                            var myChart =  new FusionCharts({"type" : "pie2d","renderAt" : "xml_estatus2dhg","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatus2dhg ?>"});
                                            myChart.render();
                                        });
                                    </script>
                                        
                                    <div id="xml_estatus2dhg">Cargando...</div>
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