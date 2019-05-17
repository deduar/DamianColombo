<?php session_start();?>
<?php ob_start();?>
<?php include ("incFunction.php");



$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$codigoRel = isset($_GET['codigoRel']) ? $_GET['codigoRel'] : null;
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null;
$idProductMain = isset($_GET['idProductMain']) ? $_GET['idProductMain'] : null;


include ("connect.php");
$sql = "DELETE FROM productosrelacionados where codigo=? AND codigoRel=?";
$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('ss', $codigo, $codigoRel) or die ($mysqli->error);
$stmt->execute();

include ("connect.php");
$sql = "INSERT INTO productosrelacionados (codigo, codigoRel, tipo) VALUES (?, ?, ?)";

echo "INSERT INTO productosrelacionados (codigo, codigoRel, tipo) VALUES ($codigo, $codigoRel, $tipo)";


$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('ssi', $codigo, $codigoRel, $tipo) or die ($mysqli->error);
$stmt->execute();


header("Location: productos-relacionados.php?codigo=$codigo&codigoRel=$codigoRel&idProductMain=$idProductMain&flagInicio=1&tipo=$tipo");


?>
