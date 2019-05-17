<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?
$id_detpedido=$_POST['id_detpedido'];
$cantidad=$_POST['cantidad'];
$id_pedido=$_POST['id_pedido'];

$result = mysql_query("UPDATE det_pedidos SET cantidad=$cantidad WHERE id_detpedido=$id_detpedido", $link);

header("Location: _pedidos-detalle.php?id_pedido=$id_pedido");	
?>

<?php include ("incBottom.php");?>


