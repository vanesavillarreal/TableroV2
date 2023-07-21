<?php
session_start();
require "conection.php";

date_default_timezone_set('America/Mexico_City');
$hoy=date("Y-m-d H:i:s");

$query = "select folio from juridico where id='".$_GET["id"]."'";
$result = mysqli_query($mysqli,$query);
while($row = mysqli_fetch_assoc($result))
	$folio=$row["folio"];

$sql="insert into logjuridico values('$hoy','".$_SESSION["u"]."','Eliminar demanda','$folio')";
mysqli_query($mysqli,$sql) or die($sql);

$sql="delete from juridico where id='".$_GET["id"]."'";
mysqli_query($mysqli,$sql) or die($sql);

?>
<script language="javascript">window.location.href = 'actualizacion_info.php';</script>