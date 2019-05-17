<?php session_start();?>
<?ob_start();?>
<?php include ("backoffice/incFunction.php");
include ("backoffice/connect.php");?>

<?php 

$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$codigo = htmlspecialchars($codigo);

$idUsuario=$_SESSION['idUsuario'];



$sql = "DELETE FROM wishlist WHERE (idUsuario = ? AND codigo = ?)";
$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('is', $idUsuario, $codigo) or die ($mysqli->error);
$stmt->execute();

header("Location: wishlist");

?>
