<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");


$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$codigoRelacionado = isset($_GET['codigoRelacionado']) ? $_GET['codigoRelacionado'] : null;

$idMetalesRelacionados = isset($_GET['idMetalesRelacionados']) ? $_GET['idMetalesRelacionados'] : null;


include ("connect.php");
$sql = "DELETE FROM metalesrelacionados where idMetalesRelacionados=?";
$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('i', $idMetalesRelacionados) or die ($mysqli->error);
$stmt->execute();


header("Location: productos-metales.php?codigo=$codigo&flagInicio=1");

?>
