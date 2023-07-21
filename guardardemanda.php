<?php
header('Content-Type: text/html; charset=iso-8859-1');
session_start();
require "conection.php";

date_default_timezone_set('America/Mexico_City');
$hoy=date("Y-m-d H:i:s");

$empresa=$_POST["empresa"];
$tipodemanda=$_POST["tipodemanda"];
$fechapresentacion=$_POST["fechapresentacion"];
$folio=$_POST["folio"];
$demandado=$_POST["demandado"];
$demandante=$_POST["demandante"];
$asignadoa=$_POST["asignadoa"];
$fechaprevia=$_POST["fechaprevia"];
$fechaproxima=$_POST["fechaproxima"];
$estatus=$_POST["estatus"];
$observaciones=$_POST["observaciones"];

$sql="insert into juridico(
empresa,
tipodemanda,
fechapresentacion,
folio,
demandado,
demandante,
asignadoa,
fechaprevia,
fechaproxima,
estatus,
observaciones)

values('".$empresa."',
'".$tipodemanda."',
'".$fechapresentacion."',
'".$folio."',
'".$demandado."',
'".$demandante."',
'".$asignadoa."',
'".$fechaprevia."',
'".$fechaproxima."',
'".$estatus."',
'".$observaciones."')";
//echo $sql."<br>";
mysqli_query($mysqli,$sql) or die($sql);

$sql="insert into logjuridico values('$hoy','".$_SESSION["u"]."','Nueva demanda','$folio')";
mysqli_query($mysqli,$sql) or die($sql);

?>
<script language="javascript">window.location.href = 'actualizacion_info.php';</script>
