<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?

$idUsuario=$_GET['idUsuario'];
$fecha=date('Y/m/d');
$idEntrega=0;
$idExpreso=0;

$result2 = mysql_query("INSERT INTO pedidos (idUsuario, fecha, idEntrega, idExpreso, estado) VALUES ('$idUsuario', '$fecha', $idEntrega, $idExpreso, 0)");

$result = mysql_query("SELECT MAX(id_pedido) as max FROM pedidos WHERE idUsuario=$idUsuario", $link);
$row = mysql_fetch_array($result);

$id_pedido=$row["max"];

header("Location: pedido-detalle.php?id_pedido=$id_pedido");

?>