<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?
$id_pedido=$_GET['id_pedido'];
$id_detpedido=$_GET['id_detpedido'];

$result = mysql_query("DELETE FROM det_pedidos WHERE id_detpedido=$id_detpedido", $link);

header("Location: pedido-detalle.php?id_pedido=$id_pedido");	
?>

<?php include ("incBottom.php");?>


