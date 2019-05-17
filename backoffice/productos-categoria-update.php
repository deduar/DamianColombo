<?php
ob_start();
?>
<?php include ("incFunction.php");
include ("connect.php");?>

<?php


$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$categorias = isset($_POST['categorias']) ? $_POST['categorias'] : null;

$categorias2 = explode(" / ", $categorias);


$codCategoria = $categorias2[0];

$codSubCategoria = $categorias2[1];




$sql = "INSERT INTO productoscategoria (codigo, codCategoria, codSubCategoria) VALUES (?, ?, ?)";

$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('sii', $codigo, $codCategoria, $codSubCategoria) or die ($mysqli->error);
$stmt->execute();

header("Location: producto-categoria2.php?codigo=$codigo");

?>
