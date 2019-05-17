<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");
include ("connect.php");?>

<?php 

$categorias = isset($_GET['categorias']) ? $_GET['categorias'] : null; 
$idProductosCategoria = isset($_GET['idProductosCategoria']) ? $_GET['idProductosCategoria'] : null; 
$orden = isset($_POST['orden']) ? $_POST['orden'] : null; 





$sql = "UPDATE productoscategoria SET orden=? WHERE idProductosCategoria=?";
	$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
	$stmt->bind_param('ii', $orden, $idProductosCategoria) or die ($mysqli->error);
	$stmt->execute();

	

header("Location: productos-listar-orden.php?categorias=$categorias&flag=1");

?>

