<?php 
session_start();
ob_start();

include ("backoffice/incFunction.php");


$_SESSION["idUsuario"] = isset($_SESSION["idUsuario"]) ? $_SESSION["idUsuario"] : null;

$idUsuario = $_SESSION["idUsuario"];

$emailForm          = htmlspecialchars($_POST['email']);
$telefono       = htmlspecialchars($_POST['telefono']);
$direccion      = htmlspecialchars($_POST['direccion']);
$localidad      = htmlspecialchars($_POST['localidad']);
$cp             = htmlspecialchars($_POST['cp']);
$provincia      = htmlspecialchars($_POST['provincia']);


$flagUnion=0;

$direccion = encriptar($direccion, $enc33);
$localidad = encriptar($localidad, $enc33);
$telefono = encriptar($telefono, $enc33);
$provincia = encriptar($provincia, $enc33);

$flag="0";
////// CORROBORA QUE NO ESTE REGISTRADO EL EMAIL
include ("backoffice/connect.php");


echo "SELECT email, idUsuario FROM usuarios WHERE email = $emailForm AND idUsuario = $idUsuario";

$stmt   = $mysqli->prepare("SELECT email, idUsuario FROM usuarios WHERE email = ? AND idUsuario = ?");
$stmt->bind_param('si', $emailForm, $idUsuario);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($emailBase, $idUsuarioBase);

echo "<br>----> ".$emailBase." - ".$idUsuarioBase;

echo "<br>---------------> ".$idUsuario." - ".$idUsuarioBase;

If ($stmt->fetch()) { 
	
		$flag = "re=1";

		echo "Paso Usuaior distinto";
	
}

if ($flag=="0"){

	include ("backoffice/connect.php");

	$sql = "UPDATE usuarios SET email=?, direccion=?, localidad=?, cp=?, provincia=?, telefono=? WHERE idUsuario=?";
	$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
	$stmt->bind_param('ssssssi', $emailForm, $direccion, $localidad, $cp, $provincia, $telefono, $idUsuario) or die ($mysqli->error);
	$stmt->execute();
	header("Location: profile-edit");

	echo "<br> Updatea";

} else {

	echo "<br> Error";	
	header("Location: profile-edit-fail");
	
}
?>