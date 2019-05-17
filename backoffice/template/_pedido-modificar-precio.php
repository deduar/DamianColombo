<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?
$id_pedido=$_POST['id_pedido'];
$id_detpedido=$_POST['id_detpedido'];
$precio=$_POST['precio'];

$result = mysql_query("UPDATE det_pedidos SET precio=$precio WHERE id_detpedido=$id_detpedido", $link);

header("Location: _pedidos-detalle.php?id_pedido=$id_pedido");	
?>

<?php include ("incBottom.php");?>


