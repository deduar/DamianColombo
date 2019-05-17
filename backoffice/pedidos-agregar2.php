<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?
$id_pedido=$_GET['id_pedido'];
$idProductMain=$_GET['idProductMain'];
$codigo=$_GET['codigo'];


$resultPrecio = mysql_query("SELECT * FROM negociosPrecio WHERE codigo='$codigo'"); 

echo "SELECT * FROM negociosPrecio WHERE codigo='$codigo'";
$row2 = mysql_fetch_array($resultPrecio);
$precio = $row2['precio'];


If ($precio){

	$result2 = mysql_query("INSERT INTO det_pedidos (id_pedido, id, cantidad, precio) VALUES ($id_pedido, $idProductMain, 1, $precio)");
	echo "INSERT INTO det_pedidos (id_pedido, id, cantidad, precio) VALUES ($id_pedido, $idProductMain, 1, $precio)";
	header("Location: pedido-detalle.php?id_pedido=$id_pedido&flagAgregar=1");	
}else{
	header("Location: pedido-detalle.php?id_pedido=$id_pedido&flagAgregar=2");	
}
?>




