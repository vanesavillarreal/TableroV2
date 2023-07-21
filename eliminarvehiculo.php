<?php
header('Content-Type: text/html; charset=iso-8859-1');
session_start();
require "conection.php";

date_default_timezone_set('America/Mexico_City');
$hoy=date("Y-m-d H:i:s");

$sql="delete from vehiculos where id='".$_GET["id"]."'";
mysqli_query($mysqli,$sql) or die($sql);

?>
<script language="javascript">window.location.href = 'actualizacion_info_vehiculos.php';</script>