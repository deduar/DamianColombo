<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");


$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$codigoRel = isset($_GET['codigoRel']) ? $_GET['codigoRel'] : null;
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null;
$idProductMain = isset($_GET['idProductMain']) ? $_GET['idProductMain'] : null;

$idProductoRelacionado = isset($_GET['idProductoRelacionado']) ? $_GET['idProductoRelacionado'] : null;


include ("connect.php");
$sql = "DELETE FROM productosrelacionados where idProductoRelacionado=?";
$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('i', $idProductoRelacionado) or die ($mysqli->error);
$stmt->execute();


header("Location: productos-relacionados.php?codigo=$codigo&idProductMain=$idProductMain&flagInicio=1&tipo=$tipo");

?>
