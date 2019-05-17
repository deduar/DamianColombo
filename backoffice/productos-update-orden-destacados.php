<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");
include ("connect.php");?>

<?php 

$categorias = isset($_GET['categorias']) ? $_GET['categorias'] : null; 
$idProductosCategoria = isset($_GET['idProductosCategoria']) ? $_GET['idProductosCategoria'] : null; 
$ordenDestacado = isset($_POST['orden']) ? $_POST['orden'] : null; 

$sql = "UPDATE productoscategoria SET ordenDestacado=? WHERE idProductosCategoria=?";
	$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
	$stmt->bind_param('ii', $ordenDestacado, $idProductosCategoria) or die ($mysqli->error);
	$stmt->execute();

echo "-->UPDATE productoscategoria SET ordenDestacado=$ordenDestacado WHERE idProductosCategoria=$idProductosCategoria";
header("Location: productos-listar-orden-destacados.php?categorias=$categorias&flag=1");
?>

