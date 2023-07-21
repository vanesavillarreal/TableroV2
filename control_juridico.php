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
    if($_POST["asignadoa"]<>"")$filtro=$filtro." and asignadoa='".$_POST["asignadoa"]."'";
    if($_POST["estatus"]<>"")$filtro=$filtro." and estatus='".$_POST["estatus"]."'";
    if($_POST["aniomes"]<>"")$filtro=$filtro." and aniomes='".$_POST["aniomes"]."'";

    $empresa="";
    $asignadoa="";
    $estatus="";
    $aniomes="";
    if($_POST["empresa"]<>"")$empresa=$_POST["empresa"];
    if($_POST["asignadoa"]<>"")$asignadoa=$_POST["asignadoa"];
    if($_POST["estatus"]<>"")$estatus=$_POST["estatus"];
    if($_POST["aniomes"]<>"")$aniomes=$_POST["aniomes"];
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
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">CONTROL JURÍDICO DE DEMANDAS</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">CORPORATIVO</li>
                        </ol>
                        <form name="form1" method="post" class="row mb-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="estatus" required id="floatingSelectGrid" onChange="document.form1.submit();">
                                        <option value="">-- TODOS --</option>
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
                                    <label for="floatingSelectGrid">Estatus</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="asignadoa" required onChange="document.form1.submit();">
                                        <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct asignadoa from juridico where 1=1 $filtro order by asignadoa";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                        <option value="<?php echo $row["asignadoa"] ?>" <?php if($_POST["asignadoa"]==$row["asignadoa"])echo "selected"?>><?php echo strtoupper($row["asignadoa"]) ?></option>
                                            <?php }?>
                                        <option value="DAVID GONZALEZ" <?php if($_POST["estatus"]=="DAVID GONZALEZ")echo "selected"?>>DAVID GONZALEZ</option>
                                        <option value="WENDY PINO" <?php if($_POST["estatus"]=="WENDY PINO")echo "selected"?>>WENDY PINO</option>
                                        <option value="GABRIELA GOMEZ" <?php if($_POST["estatus"]=="GABRIELA GOMEZ")echo "selected"?>>GABRIELA GOMEZ</option>
                                    </select>
                                    <label for="floatingSelectGrid">Asignado a</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="aniomes" required onChange="document.form1.submit();">
                                    <option value="">-- TODOS --</option>
                                    <?php 
                                        $query = "select distinct aniomes from juridico where fechaproxima<>'' $filtro order by aniomes";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <option value="<?php echo $row["aniomes"] ?>" <?php if($_POST["aniomes"]==$row["aniomes"])echo "selected"?>><?php echo strtoupper($row["aniomes"]) ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Fecha de próxima audi.</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="empresa" required onChange="document.form1.submit();">
                                    <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct empresa from juridico where 1=1 $filtro order by empresa";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                    <option value="<?php echo $row["empresa"] ?>" <?php if($_POST["empresa"]==$row["empresa"])echo "selected"?>><?php echo strtoupper($row["empresa"]) ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Empresa</label>
                                </div>
                            </div>
                        </form>
                        <div class="row">     
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Demandas por estatus
                                    </div>
                                    <?php 
                                        $xml_estatus2dhg="<chart bgcolor='FFFFFF' palette='1' showvalues='1' showpercentvalues='1' borderalpha='20' showplotborder='0' showlegend='1' showlabels='0' legendborder='1' legendposition='bottom' enablesmartlabels='1' use2dlighting='0' showshadow='0' legendbgcolor='#CCCCCC' legendbgalpha='20' legendborderalpha='0' legendshadow='0' legendnumcolumns='2' >";
                                        
                                        $query = "select estatus as categoria,count(*) as cant from juridico where 1=1 $filtro group by estatus";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria=strtoupper($row['categoria']);
                                            $cant=$row['cant'];
                                            $xml_estatus2dhg = $xml_estatus2dhg . "<set label='$categoria' value='$cant' link='N-lista9.php?estatus=$categoria&asignadoa=$asignadoa&aniomes=$aniomes&empresa=$empresa' />";
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

                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Demandas por asignación
                                    </div>
                                    <?php 
                                        $xml_estatusds="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10'  >";
                                        
                                        $query = "select asignadoa as categoria,count(*) as cant from juridico where 1=1 $filtro group by asignadoa";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria=strtoupper($row['categoria']);
                                            $cant=$row['cant'];
                                            $xml_estatusds = $xml_estatusds . "<set label='$categoria' value='$cant' link='N-lista9.php?asignadoa=$categoria&empresa=$empresa&aniomes=$aniomes&estatus=$estatus' />";
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
                                        Demandas con próxima audiencia
                                    </div>
                                    <?php 
                                        $xml_estatusds2="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10'  >";

                                        $query = "select aniomes as categoria,count(*) as cant from juridico where fechaproxima<>'' $filtro group by aniomes";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            $categoria=strtoupper($row['categoria']);
                                            $cant=$row['cant'];
                                            $xml_estatusds2 = $xml_estatusds2 . "<set label='$categoria' value='$cant' link='N-lista9.php?aniomes=$categoria&empresa=$empresa&asignadoa=$asignadoa&estatus=$estatus' />";
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
                                        Demandas por empresa
                                    </div>
                                    <?php 
                                        $xml_estatusq="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' >";
                                        
                                        $query = "select distinct empresa as categoria,count(*) as cant from juridico where 1=1 $filtro group by empresa order by empresa";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                            $categoria=strtoupper($row['categoria']);
                                            $cant=$row['cant'];
                                            $xml_estatusq = $xml_estatusq . "<set label='$categoria' value='$cant' link='N-lista9.php?empresa=$categoria&asignadoa=$asignadoa&aniomes=$aniomes&estatus=$estatus' />";
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