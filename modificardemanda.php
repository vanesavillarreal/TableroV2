<?php
session_start();
require "conection.php";

date_default_timezone_set('America/Mexico_City');
$hoy=date("Y-m-d H:i:s");

$id=$_POST["id"];
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

$sql="update juridico set 
empresa='".$empresa."',
tipodemanda='".$tipodemanda."',
fechapresentacion='".$fechapresentacion."',
folio='".$folio."',
demandado='".$demandado."',
demandante='".$demandante."',
asignadoa='".$asignadoa."',
fechaprevia='".$fechaprevia."',
fechaproxima='".$fechaproxima."',
estatus='".$estatus."',
observaciones='".$observaciones."'
where id='$id'";
//echo $sql."<br>";
mysqli_query($mysqli,$sql) or die($sql);

$sql="insert into logjuridico values('$hoy','".$_SESSION["u"]."','Modificar demanda','$folio')";
mysqli_query($mysqli,$sql) or die($sql);

?>
<script language="javascript">window.location.href = 'actualizacion_info.php';</script>
