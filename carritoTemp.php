<?php session_start();?>
<?ob_start();?>
<?php include ("backoffice/connect.php");?>
<?php include ("backoffice/incFunction.php");?>

<?php

$id = isset($_POST['id']) ? $_POST['id'] : null;
$id = htmlspecialchars($id);
 	
$action = isset($_POST['action']) ? $_POST['action'] : null;
$action = htmlspecialchars($action);

$cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : null;
$cantidad = htmlspecialchars($cantidad);

$medida = isset($_POST['medida']) ? $_POST['medida'] : null;
$medida = htmlspecialchars($medida);

echo "_--_> ".$medida;

header("Location: carrito.php?id=$id&action=$action&cantidad=$cantidad&medida=$medida");
			
?>
