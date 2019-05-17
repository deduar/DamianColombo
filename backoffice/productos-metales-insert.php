<?php session_start();?>
<?php ob_start();?>
<?php include ("incFunction.php");

$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$codigoRelacionado  = isset($_GET['codigoRelacionado']) ? $_GET['codigoRelacionado'] : null;

echo "** ".$codigoRelacionado;
echo "<br>** ".$codigo;

include ("connect.php");
$sql = "DELETE FROM metalesrelacionados where codigo=? AND codigoRelacionado =?";
$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('ss', $codigo, $codigoRelacionado ) or die ($mysqli->error);
$stmt->execute();

include ("connect.php");
$sql = "INSERT INTO metalesrelacionados (codigo, codigoRelacionado) VALUES (?, ?)";

$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('ss', $codigo, $codigoRelacionado) or die ($mysqli->error);
$stmt->execute();



header("Location: productos-metales.php?codigo=$codigo&codigoRelacionado=$codigoRelacionado&flagInicio=1");


?>
