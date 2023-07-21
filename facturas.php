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

    if($_POST["anio"]<>"")$filtro=$filtro." and left(fecharecibido,4)='".$_POST["anio"]."'";
    if($_POST["mes"]<>"")$filtro=$filtro." and left(fecharecibido,7)='".$_POST["mes"]."'";
    if($_POST["sucursal"]<>"")$filtro=$filtro." and sucursal='".$_POST["sucursal"]."'";
    if($_POST["socio"]<>"")$filtro=$filtro." and socio='".$_POST["socio"]."'";

    $mes="";
    $sucursal="";
    $socio="";
    if($_POST["anio"]<>"")$anio=$_POST["anio"];
    if($_POST["mes"]<>"")$mes=$_POST["mes"];
    if($_POST["sucursal"]<>"")$sucursal=$_POST["sucursal"];
    if($_POST["socio"]<>"")$socio=$_POST["socio"];
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
                        <h1 class="mt-4">FACTURAS</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">STRUCTURALL</li>
                        </ol>
                        <form name="form1" method="post" class="row mb-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="anio" required id="floatingSelectGrid" onChange="document.form1.submit();">
                                        <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct left(fecharecibido,4) as anio from facturas where estado='Publicado' and left(fecharecibido,4)<>'' $filtro order by left(fecharecibido,4)";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <option value="<?php echo $row["anio"] ?>" <?php if($_POST["anio"]==$row["anio"])echo "selected"?>><?php echo $row["anio"] ?></option>
                                            <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Año</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="mes" required onChange="document.form1.submit();">
                                        <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct left(fecharecibido,7) as mes from facturas where estado='Publicado' and left(fecharecibido,7)<>'' $filtro order by left(fecharecibido,7)";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <option value="<?php echo $row["mes"] ?>" <?php if($_POST["mes"]==$row["mes"])echo "selected"?>><?php echo $row["mes"] ?></option>
                                            <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Mes</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="sucursal" required onChange="document.form1.submit();">
                                    <option value="">-- TODOS --</option>
                                    <?php 
                                        $query = "select distinct sucursal from facturas where estado='Publicado' $filtro order by sucursal";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <option value="<?php echo $row["sucursal"] ?>" <?php if($_POST["sucursal"]==$row["sucursal"])echo "selected"?>><?php echo $row["sucursal"] ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Sucursal</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="socio" required onChange="document.form1.submit();">
                                    <option value="">-- TODOS --</option>
                                    <?php 
                                        $query = "select distinct socio from facturas where estado='Publicado' $filtro order by socio";
                                        $result = mysqli_query($mysqli,$query);
                                        while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <option value="<?php echo $row["socio"] ?>" <?php if($_POST["socio"]==$row["socio"])echo "selected"?>><?php echo $row["socio"] ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Socio</label>
                                </div>
                            </div>
                        </form>
                        <div class="row">     
                            <div class="col-sm-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fa-solid fa-chart-pie"></i>
                                        Estado pago
                                    </div>
                                    <?php 
                                    $xml_estatus2dhg="<chart bgcolor='FFFFFF' palette='1' showvalues='1' showpercentvalues='1' borderalpha='20' showplotborder='0' showlegend='1' showlabels='0' legendborder='1' legendposition='bottom' enablesmartlabels='1' use2dlighting='0' showshadow='0' legendbgcolor='#CCCCCC' legendbgalpha='20' legendborderalpha='0' legendshadow='0' legendnumcolumns='4' >";
                                    
                                    $query = "select estadopago as categoria,sum(total) as cant from facturas where estado='Publicado' $filtro group by estadopago";
                                    $result = mysqli_query($mysqli,$query);
                                    while($row = mysqli_fetch_assoc($result))
                                        {
                                        $categoria=strtoupper($row['categoria']);
                                        $cant=$row['cant'];
                                        $xml_estatus2dhg = $xml_estatus2dhg . "<set label='$categoria' value='$cant' link='N-lista2.php?estadopago=$categoria&mes=$mes&sucursal=$sucursal&socio=$socio&anio=$anio' />";
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

                            <div class="col-sm-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Pendiente por cobrar
                                    </div>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <?php 
                                                $xml_estatusqyuy="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' numberprefix='$' >";
                                                
                                                $query = "select sucursal as categoria,sum(total) as cant from facturas where estado='Publicado' $filtro group by sucursal";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $categoria1=strtoupper($row['categoria']);
                                                    $categoria=substr($categoria1,1,3);
                                                    $cant=sprintf("%.0f",$row['cant']);
                                                    $xml_estatusqyuy = $xml_estatusqyuy . "<set label='$categoria' value='$cant' link='N-lista2.php?sucursal=$categoria1&mes=$mes&socio=$socio&anio=$anio' />";
                                                    }
                                                            
                                                $xml_estatusqyuy=$xml_estatusqyuy."</chart>";
                                                ?>
                                                
                                                <script type="text/javascript">
                                                    FusionCharts.ready(  function  () { 
                                                        var myChart =  new FusionCharts({"type" : "bar2d","renderAt" : "xml_estatusqyuy","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusqyuy ?>"});
                                                        myChart.render();
                                                    });
                                                </script>
                                                
                                                <div id="xml_estatusqyuy">Cargando...</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        
                            
                            <div class="col-sm-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Proyección de cobranza
                                    </div>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <?php 
                                                $xml_estatusqyu="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' numberprefix='$' >";
                                                    
                                                $query = "select sucursal as categoria,sum(total) as cant from facturas where estado='Publicado' and estadopago='Pagado' $filtro group by sucursal";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $categoria1=strtoupper($row['categoria']);
                                                    $categoria=substr($categoria1,1,3);
                                                    $cant=sprintf("%.0f",$row['cant']);
                                                    $xml_estatusqyu = $xml_estatusqyu . "<set label='$categoria' value='$cant' link='N-lista2.php?sucursal=$categoria1&mes=$mes&socio=$socio&estadopago=Pagado&anio=$anio' />";
                                                    }
                                                                
                                                $xml_estatusqyu=$xml_estatusqyu."</chart>";
                                                ?>
                                                    
                                                <script type="text/javascript">
                                                    FusionCharts.ready(  function  () { 
                                                        var myChart =  new FusionCharts({"type" : "bar2d","renderAt" : "xml_estatusqyu","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusqyu ?>"});
                                                        myChart.render();
                                                    });
                                                </script>
                                                    
                                                <div id="xml_estatusqyu">Cargando...</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
			                </div>
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-bar me-1"></i>
                                            Ingresos totales facturados
                                        </div>
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <?php 

                                                    $xml_estatusds="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' numberprefix='$' >";
                                                    
                                                    $query = "select left(fecharecibido,7) as categoria,sum(total) as cant from facturas where estado='Publicado' and left(fecharecibido,7)<>'' $filtro group by left(fecharecibido,7) order by left(fecharecibido,7)";
                                                    $result = mysqli_query($mysqli,$query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                        {
                                                        $categoria=strtoupper($row['categoria']);
                                                        $cant=sprintf("%.0f",$row['cant']);
                                                        $xml_estatusds = $xml_estatusds . "<set label='$categoria' value='$cant' link='N-lista2.php?mes=$categoria&sucursal=$sucursal&socio=$socio&anio=$anio' />";
                                                        }
                                                                
                                                    $xml_estatusds=$xml_estatusds."</chart>";
                                                    ?>
                                                    
                                                    <script type="text/javascript">
                                                        FusionCharts.ready(  function  () { 
                                                            var myChart =  new FusionCharts({"type" : "column2d","renderAt" : "xml_estatusds","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusds ?>"});
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
                                        Top clientes facturados
                                    </div>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <?php 

                                                $xml_estatusdssd="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' yAxisMaxValue='100' numberprefix='$' >";
                                                    
                                                $query = "select socio as categoria,sum(total) as cant from facturas where estado='Publicado' $filtro group by socio order by sum(total) desc limit 10";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result))
                                                    {
                                                        $categoria=strtoupper($row['categoria']);
                                                        $cant=sprintf("%.0f",$row['cant']);
                                                        $xml_estatusdssd = $xml_estatusdssd . "<set label='$categoria' value='$cant' link='N-lista2.php?socio=$categoria&mes=$mes&sucursal=$sucursal&anio=$anio' />";
                                                    }
                                                                
                                                $xml_estatusdssd=$xml_estatusdssd."</chart>";
                                                ?>
                                                    
                                                <script type="text/javascript">
                                                    FusionCharts.ready(  function  () { 
                                                        var myChart =  new FusionCharts({"type" : "bar2d","renderAt" : "xml_estatusdssd","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusdssd ?>"});
                                                        myChart.render();
                                                    });
                                                </script>
                                                    
                                                <div id="xml_estatusdssd">Cargando...</div>
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
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>