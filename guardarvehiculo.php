<?php
header('Content-Type: text/html; charset=iso-8859-1');
session_start();
require "conection.php";

date_default_timezone_set('America/Mexico_City');
$hoy=date("Y-m-d H:i:s");

$query = "select max(id) as id from vehiculos";
$result = mysqli_query($mysqli,$query);
while($row = mysqli_fetch_assoc($result))
	$id=$row["id"]+1;

$c1=$_POST["c1"];
$c2=$_POST["c2"];
$c3=$_POST["c3"];
$c4=$_POST["c4"];
$c5=$_POST["c5"];
$c6=$_POST["c6"];
$c7=$_POST["c7"];
$c8=$_POST["c8"];
$c9=$_POST["c9"];
$c10=$_POST["c10"];
$c11=$_POST["c11"];
$c12=$_POST["c12"];
$c13=$_POST["c13"];
$c14=$_POST["c14"];
$c15=$_POST["c15"];
$c16=$_POST["c16"];
$c17=$_POST["c17"];
$c18=$_POST["c18"];
$c19=$_POST["c19"];
$c20=$_POST["c20"];
$c21=$_POST["c21"];
$c22=$_POST["c22"];

$sql="
insert into vehiculos values(
'".$id."',
'".$c1."',
'".$c2."',
'".$c3."',
'".$c4."',
'".$c5."',
'".$c6."',
'".$c7."',
'".$c8."',
'".$c9."',
'".$c10."',
'".$c11."',
'".$c12."',
'".$c13."',
'".$c14."',
'".$c15."',
'".$c16."',
'".$c17."',
'".$c18."',
'".$c19."',
'".$c20."',
'".$c21."',
'".$c22."')
";

//echo $sql;
mysqli_query($mysqli,$sql) or die($sql);

//return(0);
?>
<script language="javascript">window.location.href = 'actualizacion_info_vehiculos.php';</script>
