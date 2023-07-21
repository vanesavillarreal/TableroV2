<?php 
date_default_timezone_set('America/Mexico_City');
session_start();
require "conection.php";

$fecha=substr(strftime("%Y-%m-%d %H:%M:%S",time()),0,10);
$hora=substr(strftime("%Y-%m-%d %H:%M:%S",time()),11,8);

$query = "SELECT usuario FROM usuarios WHERE usuario='".$_POST["usuario"]."' and password='".$_POST["password"]."'";
$result = mysqli_query($mysqli,$query) or die('Intentar más tarde..');
if(mysqli_num_rows($result)>0)
	{
	$_SESSION['u']=$_POST["usuario"];

	$query = "insert into termometro values('".$_POST["usuario"]."','".$fecha."','".$hora."','".basename(__FILE__, '.php')."')";
	mysqli_query($mysqli,$query);

	$query = "select tipo from usuarios where usuario='".$_POST["usuario"]."'";
	$result = mysqli_query($mysqli,$query);
	while($row = mysqli_fetch_assoc($result))
	 	{
		if($row['tipo']=="dashboard")
			//$pagina="menu.php";
			$pagina="main.php";
		if($row['tipo']=="upload")
			$pagina="dashboardg.php";
		if($row['tipo']=="pyl")
			$pagina="index.php?acceso=denegado";
		if($row['tipo']=="rentals")
			$pagina="index.php?acceso=denegado";
		if($row['tipo']=="juridico")
			$pagina="dashboard9.php";
		if($row['tipo']=="saldos")
			$pagina="dashboard7.php";
		}
	header("location:$pagina");
	}
else
	header("location:index.php?acceso=denegado");
?>
