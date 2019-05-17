<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?php

$id_pedido = isset($_GET['id_pedido']) ? $_GET['id_pedido'] : null;
$email = isset($_GET['email']) ? $_GET['email'] : null;
$idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : null;
$nombreCompleto = isset($_GET['nombreCompleto']) ? $_GET['nombreCompleto'] : null;
$observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;
$estado = isset($_POST['estado']) ? $_POST['estado'] : null;


$nombreCompleto = preg_replace('([^A-Za-z0-9])', '', $nombreCompleto);

$datosPedido=array();
$datosPedido=obtenerPedidosId($id_pedido);

modificarEstado($id_pedido, $estado);

If ($observaciones){
	$fechaObs=date('d/m/Y');
	$observaciones=$datosPedido[5]."<br>".$fechaObs." | ".$observaciones;
	include ("connect.php");
	$sql = "UPDATE pedidos SET observaciones=? WHERE id_pedido=?";
	$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
	$stmt->bind_param('si', $observaciones, $id_pedido) or die ($mysqli->error);
	$stmt->execute();
}


echo $email."  **  ".$id_pedido."  **  ".$observaciones."  **  ".$estado."  **  ".$idUsuario."  **  ".$nombreCompleto;

enviarMailEstado($email, $id_pedido, $observaciones, $estado, $idUsuario, $nombreCompleto);

header("Location: pedido-detalle.php?id_pedido=$id_pedido");

?>
