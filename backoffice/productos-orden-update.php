<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
include ("incFunction.php");
include ("connect.php");

$idProductosCategoria = isset($_GET['idProductosCategoria']) ? $_GET['idProductosCategoria'] : null;
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null; 



$sql = "DELETE FROM productoscategoria WHERE idProductosCategoria = ?";
$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('i', $idProductosCategoria) or die ($mysqli->error);
$stmt->execute();  

header("Location: producto-categoria2.php?codigo=$codigo&flag=1");
?>

</body>
</html>
