<?php session_start();?>
<?php ob_start();
//print "<pre>"; print_r($_SESSION); print "</pre>\n";
include ("backoffice/connect.php");
include ("backoffice/incFunction.php");
if(isset($_SESSION['carro'])){
	if(isset($_SESSION['idUsuario'])){
		$idUsuario=$_SESSION['idUsuario'];
		$email=$_SESSION["email"];
		$nombreCompleto=$_SESSION["nombre"];
	}else{
		include ("backoffice/connect.php");
		$email=$_SESSION["email"];
		$nombre=$_SESSION["nombre"];
		$apellido=$_SESSION["apellido"];
		$telefono=$_SESSION["telefono"];
		$direccion=$_SESSION["direccion"];
		$localidad=$_SESSION["localidad"];
		$provincia=$_SESSION["provincia"];
		$cp=$_SESSION["cp"];
		$nombreCompleto=$nombre." ".$apelllido;
		$tipo=0;
		$estado=0;
		$sql = "INSERT INTO usuarios (nombre, apellido,  email, direccion, localidad, cp, provincia, telefono, estado, tipo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
		$stmt->bind_param('ssssssssii', $nombre, $apellido, $email, $direccion, $localidad, $cp, $provincia, $telefono, $estado, $tipo) or die ($mysqli->error);
		$stmt->execute();
		$result    = $mysqli->query("SELECT MAX(idUsuario) as max FROM usuarios");
		$row       = $result->fetch_assoc();
		$idUsuario = $row["max"];


	}


	$observaciones = isset($_SESSION['observaciones']) ? $_SESSION['observaciones'] : null;

	$fecha=date('Y/m/d');
	$hora=date("H:i:sa");

	$estado="EN PROCESO";
	$idEntrega=0;

	$sql = "INSERT INTO pedidos (idUsuario, fecha, hora, observacionesCliente, estado) VALUES (?, ?, ?, ?, ?)";
	$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
	$stmt->bind_param('issss', $idUsuario, $fecha, $hora, $observaciones, $estado) or die ($mysqli->error);
	$stmt->execute();
	$stmt->close();


	unset($_SESSION['observaciones']);

	$result    = $mysqli->query("SELECT MAX(id_pedido) as max FROM pedidos");
	$row       = $result->fetch_assoc();
	$id_pedido = $row["max"];

	echo "--> SELECT MAX(id_pedido) as max FROM pedidos<br>";

	foreach($_SESSION['carro'] as $id => $x){

		echo "Paso<br>";

		$medida="";
		$datosProducto=array();
		$datosProducto=consultaArticuloId($id);
		$cantidad=(float)$x;


		$precioAux=($datosProducto[18]*$datosProducto[19])/100;
		$precio=$datosProducto[18]-$precioAux;

		$precioTotal=$precio*$cantidad;

		//$medida=$_SESSION['medida'][$id];

		$medida = isset($_SESSION['medida'][$id]) ? $_SESSION['medida'][$id] : 0;


		$sql = "INSERT INTO det_pedidos (id_pedido, id, cantidad, precio, medida) VALUES (?, ?, ?, ?, ?)";

		echo "INSERT INTO det_pedidos (id_pedido, id, cantidad, precio, medida) VALUES ($id_pedido, $id, $x, $precio, $medida)";

		$stmt_ped = $mysqli->prepare($sql) or die ($mysqli->error);
		$stmt_ped->bind_param('iiids', $id_pedido, $id, $x, $precio, $medida) or die ($mysqli->error);
		$stmt_ped->execute();
		$stmt_ped->close();


		/////////Actualiza Stock ///////////////////////

		$stock=consultaStock($id);

		$stock=$stock-$x;


		$sql = "UPDATE productmain SET stock=? WHERE idProductMain=?";

		$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
		$stmt->bind_param('ii', $stock, $id) or die ($mysqli->error);
		$stmt->execute();

		/////////Fin Actualiza Stock ///////////////////////


	}

	enviarMailEstado($email, $id_pedido, $observaciones, $estado, $idUsuario, $nombreCompleto);

	enviarMailCompra($email, $id_pedido, $observaciones, $estado, $idUsuario, $nombreCompleto);

	unset($_SESSION['carro']);
	unset($_SESSION['medida']);

	$email=encriptar($email, $enc33);
	$id_pedido=encriptar($id_pedido, $enc33);


	header("Location: pedido-confirmacion.php?flagEstado=1&ger=$email&sd=$id_pedido");


	/*if($send){
	echo "Envio";
	header("Location: pedido-confirmacion.php?flagEstado=1&email=$email");
}
else{
echo "No Envio";
//header("Location: pedido-confirmacion.php?flagEstado=1&email=$email");
}*/

} else {



	header("Location: login-error");
}

//print "<pre>"; print_r($_SESSION); print "</pre>\n";

?>
