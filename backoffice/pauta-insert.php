<?
ob_start();
?>
<?php include ("incFunction.php");
include ("connectSC.php");?>
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<?php 


$fechaAlta=$_POST['fechaAlta'];
$direccion=$_POST['direccion'];
$descripcion=$_POST['descripcion'];
$tipoPauta=$_POST['tipoPauta'];
$idWeb=$_POST['idWeb'];
$fecha=date('Y/m/d'); 
$fechaAlta=date('Y/m/d'); 


//$direccion=str_replace('"','\'',$direccion);


$result = mysql_query("INSERT INTO pautamkd (fecha, fechaAlta, direccion, descripcion, tipoPauta, idWeb) VALUES ('$fecha', '$fechaAlta', '$direccion', '$descripcion', '$tipoPauta', '$idWeb')", $link);


echo "INSERT INTO pautamkd (fecha, fechaAlta, direccion, descripcion, tipoPauta, idWeb) VALUES ('$fecha', '$fechaAlta', '$direccion', '$descripcion', '$tipoPauta', '$idWeb')";


//header("Location: pauta-agregar.php");

?>
</BODY>
</HTML>
