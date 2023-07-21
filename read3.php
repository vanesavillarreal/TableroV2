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
mysqli_query($mysqli,"truncate table saldos");

$fecha="hoy";

for ($row = 4; $row <= 18; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(3, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'normal','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 4; $row <= 18; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(2, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'pagos','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 4; $row <= 18; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(4, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'cuentaspp','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 4; $row <= 18; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(5, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'nominasem','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 4; $row <= 18; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(6, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'nominaquin','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 4; $row <= 18; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(7, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'imss','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 4; $row <= 18; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(8, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'impuestos','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 4; $row <= 18; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(9, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'disponible','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 25; $row <= 31; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(2, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'linea','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 25; $row <= 31; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(3, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'deuda','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 25; $row <= 31; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(4, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'disponiblebancario','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 36; $row <= 42; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(2, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'saldoscreditos','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 36; $row <= 42; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(3, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'pagomensual','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

for ($row = 36; $row <= 42; ++ $row)
	{
	$query="insert into saldos(empresa,saldo,tipo,fecha) values(";

	$cell = $worksheet->getCellByColumnAndRow(1, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$cell = $worksheet->getCellByColumnAndRow(4, $row);
	$val = $cell->getFormattedValue();
	$val = str_replace("'","",$val);
	$val = str_replace("$","",$val);
	$val = str_replace(",","",$val);
	$query=$query."'$val',";

	$query=$query."'tasa','$fecha')";
	//echo $row."|",$cont."|".$query."<br>";
	mysqli_query($mysqli,$query)or die(mysql_error());
	}

?>
<script language="javascript">alert("Archivo cargado");</script>
<script language="javascript">window.location.href = 'importarsaldos.php';</script>
