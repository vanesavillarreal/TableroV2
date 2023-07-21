<?php
session_start();
ini_set('memory_limit', '16288M');
set_time_limit(0);
require_once 'PHPExcel/IOFactory.php';

require "conection.php";

if($_FILES["filed1"]["tmp_name"]<>""){
$time=substr(time(),7,3);
$rand=rand(100,999);
$id2=$time.$rand;
move_uploaded_file($_FILES["filed1"]["tmp_name"],"fotos/".$id2.".".substr($_FILES["filed1"]["name"], strrpos($_FILES["filed1"]["name"], ".") + 1));
}

$filed="fotos/".$id2.".xlsx";

$objPHPExcel = PHPExcel_IOFactory::load("$filed");
$worksheet = $objPHPExcel->getSheet(0); 
//$highestRow = $worksheet->getHighestDataRow();

mysqli_query($mysqli,"set names utf8");

$highestRow=1000;

$semana=$_POST["semana"];
$anio=$_POST["anio"];

mysqli_query($mysqli,"delete from cobranza where semana='$semana' and anio='$anio'");

for ($row = 2; $row <= $highestRow; ++ $row)
	{
	$query="insert into cobranza(tipodeunidad,numerodeserie,ubicacion,sucursal,razonsocial,rentamensual,pp,importe,semana,anio) values(";
	for ($col = 1; $col <= 8; ++ $col)
		{
		$cell = $worksheet->getCellByColumnAndRow($col, $row);
		$val = $cell->getFormattedValue();
		$val = str_replace("'","",$val);
		$val = str_replace("$","",$val);
		$val = str_replace(",","",$val);
    	if($col==6 || $col==7 || $col==8)
        	{
        	if($val=="")$val="0";
        	}
		$query=$query."'$val',";
		}
	$query=$query."'$semana','$anio')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysqli_error());
	}

$sql="delete from cobranza where tipodeunidad='' or tipodeunidad is null";
mysqli_query($mysqli,$sql);

$query = "select count(*) as cont from cobranza where semana='$semana'";
$result = mysqli_query($mysqli,$query);
while($row = mysqli_fetch_assoc($result))
	$cont=$row["cont"];

mysqli_query($mysqli,"update cobranza set sucursal='JAL' where sucursal='GDL'");

?>
<script language="javascript">alert("<?php echo $cont ?> registros cargados");</script>
<script language="javascript">window.location.href = 'importar.php';</script>
