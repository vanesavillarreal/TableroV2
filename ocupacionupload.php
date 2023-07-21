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

    $anio="2023";
    if($_POST["anio"]<>"")$anio=$_POST["anio"];
    if($anio<>"")$filtro=$filtro." and anio='".$anio."'";
    if($_POST["semana"]<>"")$filtro=$filtro." and semana='".$_POST["semana"]."'";
    if($_POST["sucursal"]<>"")$filtro=$filtro." and sucursal='".$_POST["sucursal"]."'";
    if($_POST["ubicacion"]<>"")$filtro=$filtro." and ubicacion='".$_POST["ubicacion"]."'";

    $semana="";
    $sucursal="";
    $ubicacion="";
    if($_POST["anio"]<>"")$anio=$_POST["anio"];
    if($_POST["semana"]<>"")$semana=$_POST["semana"];
    if($_POST["sucursal"]<>"")$sucursal=$_POST["sucursal"];
    if($_POST["ubicacion"]<>"")$ubicacion=$_POST["ubicacion"];
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
                                    <a class="nav-link" href="ocupacionupload.php">Ocupación</a>
                                    <a class="nav-link" href="importar.php">Importar Datos</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">OCUPACIÓN</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">STRUCTURALL</li>
                        </ol>
                        <form name="form1" method="post" class="row mb-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="anio" required id="floatingSelectGrid" onChange="document.form1.submit();">
                                        <option value="2022" <?php if($anio=="2022")echo "selected"?>>2022</option>
                                        <option value="2023" <?php if($anio=="2023")echo "selected"?>>2023</option>
                                    </select>
                                    <label for="floatingSelectGrid">Año</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="semana" required onChange="document.form1.submit();">
                                        <option value="">-- TODOS --</option>
                                            <?php 
                                                $query = "select distinct semana from cobranza where 1=1 $filtro order by cast(semana as decimal)";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                        <option value="<?php echo $row["semana"] ?>" <?php if($_POST["semana"]==$row["semana"])echo "selected"?>><?php echo $row["semana"] ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Semana</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="sucursal" required onChange="document.form1.submit();">
                                    <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct sucursal from cobranza where 1=1 $filtro order by sucursal";
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
                                    <select class="form-select" id="floatingSelectGrid" name="ubicacion" required onChange="document.form1.submit();">
                                    <option value="">-- TODOS --</option>
                                        <?php 
                                            $query = "select distinct ubicacion from cobranza where 1=1 $filtro order by ubicacion";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                    <option value="<?php echo $row["ubicacion"] ?>" <?php if($_POST["ubicacion"]==$row["ubicacion"])echo "selected"?>><?php echo $row["ubicacion"] ?></option>
                                        <?php }?>
                                    </select>
                                    <label for="floatingSelectGrid">Unidad</label>
                                </div>
                            </div>
                        </form>
                        <div class="row">     
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-bar me-1"></i>
                                            Ocupación por semana
                                        </div>
                                   
                                
                                    <?php 
                                        $xml_estatus28="<chart bgcolor='FFFFFF' showSum='1' bgalpha='0' canvasBgRatio='2' borderalpha='0' canvasborderalpha='0' useplotgradientcolor='0' plotborderalpha='0' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='25' legendbgcolor='#CCCCCC' legendbgalpha='20' legendborderalpha='0' legendshadow='0'>";
                                        
                                        $xml_estatus28=$xml_estatus28."<categories>";
                                            
                                            $query = "select distinct semana as categoria from cobranza where 1=1 $filtro order by cast(semana as decimal)";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result))
                                                {
                                                $categoria=$row['categoria'];
                                                $xml_estatus28 = $xml_estatus28 . "<category label='$categoria' />";
                                                }

                                        $xml_estatus28=$xml_estatus28."</categories>";

                                        $xml_estatus28=$xml_estatus28."<dataset seriesName='RENTA'>";
        
                                        $query2 = "select distinct semana as categoria from cobranza where 1=1 $filtro order by cast(semana as decimal)";
                                        $result2 = mysqli_query($mysqli,$query2);
                                        while($row2 = mysqli_fetch_assoc($result2))
                                            {
                                            $categoria=$row2['categoria'];
                            
                                            $query = "select count(*) as cant from cobranza where 1=1 $filtro and semana='$categoria' and ubicacion='RENTA'";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result))
                                                {
                                                $cant=$row['cant'];
                                                $nomostrar="";
                                                if($cant==0)$nomostrar="showValue='0'";
                                                $xml_estatus28=$xml_estatus28."<set $nomostrar value='$cant' link='N-lista.php?semana=$categoria&ubicacion=RENTA&sucursal=$sucursal&anio=$anio' />";
                                                }
                            
                                            }
        
                                            $xml_estatus28=$xml_estatus28."</dataset>";
                                            $xml_estatus28=$xml_estatus28."<dataset seriesName='PATIO DEMOSTRACION'>";
            
                                            $query2 = "select distinct semana as categoria from cobranza where 1=1 $filtro order by cast(semana as decimal)";
                                            $result2 = mysqli_query($mysqli,$query2);
                                            while($row2 = mysqli_fetch_assoc($result2))
                                                {
                                                $categoria=$row2['categoria'];
                                
                                                $query = "select count(*) as cant from cobranza where 1=1 $filtro and semana='$categoria' and ubicacion='PATIO DEMOSTRACION'";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $cant=$row['cant'];
                                                    $nomostrar="";
                                                    if($cant==0)$nomostrar="showValue='0'";
                                                    $xml_estatus28=$xml_estatus28."<set $nomostrar value='$cant' link='N-lista.php?semana=$categoria&ubicacion=PATIO DEMOSTRACION&sucursal=$sucursal&anio=$anio' />";
                                                    }
                                
                                                }
                        
                                        $xml_estatus28=$xml_estatus28."</dataset>";
                                        $xml_estatus28=$xml_estatus28."<dataset seriesName='USO SUCURSAL'>";
            
                                        $query2 = "select distinct semana as categoria from cobranza where 1=1 $filtro order by cast(semana as decimal)";
                                        $result2 = mysqli_query($mysqli,$query2);
                                        while($row2 = mysqli_fetch_assoc($result2))
                                            {
                                            $categoria=$row2['categoria'];
                            
                                            $query = "select count(*) as cant from cobranza where 1=1 $filtro and semana='$categoria' and ubicacion='USO SUCURSAL'";
                                            $result = mysqli_query($mysqli,$query);
                                            while($row = mysqli_fetch_assoc($result))
                                                {
                                                $cant=$row['cant'];
                                                $nomostrar="";
                                                if($cant==0)$nomostrar="showValue='0'";
                                                $xml_estatus28=$xml_estatus28."<set $nomostrar value='$cant' link='N-lista.php?semana=$categoria&ubicacion=USO SUCURSAL&sucursal=$sucursal&anio=$anio' />";
                                                }
                            
                                            }
                        
                                        $xml_estatus28=$xml_estatus28."</dataset>";


                                        
                                        $xml_estatus28=$xml_estatus28."</chart>";
                                    ?>
                                    <script type="text/javascript">
                                        FusionCharts.ready(  function  () { 
                                            var myChart =  new FusionCharts({"type" : "stackedcolumn2d","renderAt" : "xml_estatus28","width" : "100%","height" : "340","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatus28 ?>"});
                                            myChart.render();
                                        });
                                    </script>
                                    <div id="xml_estatus28">Cargando...</div>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Ingresos totales por sucursal
                                    </div>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <?php 
                                                $xml_estatusq="<chart bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' yAxisMaxValue='100' numberprefix='$' >";
                                                
                                                $query = "select sucursal as categoria,sum(rentamensual) as cant from cobranza where ubicacion='RENTA' $filtro group by sucursal";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $categoria=strtoupper($row['categoria']);
                                                    $cant=$row['cant'];
                                                    $xml_estatusq = $xml_estatusq . "<set label='$categoria' value='$cant' link='N-lista.php?sucursal=$categoria&semana=$semana&ubicacion=$ubicacion&anio=$anio' />";
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
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        
                            
                            <div class="col-sm-4">
                                <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-bar me-1"></i>
                                            % Ocupación por semana
                                        </div>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <?php 

                                                $xml_estatusds="<chart caption='' bgalpha='0' showalternatevgridcolor='0' borderalpha='20' canvasborderalpha='0' theme='fint' useplotgradientcolor='0' plotborderalpha='10' placevaluesinside='1' captionpadding='20' showaxislines='1' axislinealpha='25' divlinealpha='10' yAxisMaxValue='100' numbersuffix='%' >";
                                                
                                                $query = "select semana as categoria,count(*) as cant from cobranza where ubicacion='RENTA' $filtro group by semana order by cast(semana as decimal)";
                                                $result = mysqli_query($mysqli,$query);
                                                while($row = mysqli_fetch_assoc($result))
                                                    {

                                                    $categoria=strtoupper($row['categoria']);

                                                    $queryo = "select count(*) as total from cobranza where semana='$categoria' and ubicacion<>'USO SUCURSAL' $filtro";
                                                    $resulto = mysqli_query($mysqli,$queryo);
                                                    while($rowo = mysqli_fetch_assoc($resulto))
                                                        $total = $rowo['total']; 
                                                    
                                                    $cant=($row['cant']/$total)*100;
                                                    $cant=sprintf("%.2f",$cant);
                                                    $xml_estatusds = $xml_estatusds . "<set label='$categoria' value='$cant' link='N-lista.php?semana=$categoria&ubicacion=$ubicacion&sucursal=$sucursal&anio=$anio' />";
                                                    }
                                                            
                                                $xml_estatusds=$xml_estatusds."</chart>";
                                                ?>
                                                
                                                <script type="text/javascript">
                                                    FusionCharts.ready(  function  () { 
                                                        var myChart =  new FusionCharts({"type" : "bar2d","renderAt" : "xml_estatusds","width" : "100%","height" : "600","dataFormat" : "xml","dataSource" : "<?php echo $xml_estatusds ?>"});
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
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>