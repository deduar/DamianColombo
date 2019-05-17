<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");
include ("connect.php");?>
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
$precioDolar = isset($_POST['precioDolar']) ? $_POST['precioDolar'] : null;
$idDolar=1;

$sql = "UPDATE dolar SET precioDolar=? WHERE idDolar=?";
$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('di', $precioDolar, $idDolar) or die ($mysqli->error);
$stmt->execute();

header("Location: dolar.php");
?>
</BODY>
</HTML>
