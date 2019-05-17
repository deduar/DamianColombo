<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?
$id_pedido=$_POST['id_pedido'];
$cont=$_POST["cont"];



	for ($a = 1; $a <= $cont; $a+=1) {
		$aux1="id_detpedido".$a;
		$aux2="cantidad".$a;
		$aux3="precio".$a;		
		//$var=$$aux1;
		$var=$_POST[$aux1];
		$var2=$_POST[$aux2];
		$var3=$_POST[$aux3];

			If ($var2 != "") {
				$result = mysql_query("UPDATE det_pedidos SET cantidad=$var2 WHERE id_detpedido=$var", $link);
				echo "UPDATE det_pedidos SET cantidad=$var2 WHERE id_detpedido=$var";
			}

			If ($var3 != "") {
				$result = mysql_query("UPDATE det_pedidos SET precio=$var3 WHERE id_detpedido=$var", $link);
				echo "UPDATE det_pedidos SET precio=$var3 WHERE id_detpedido=$var";
			}

	}


	header("Location: pedido-detalle.php?id_pedido=$id_pedido");	
?>

