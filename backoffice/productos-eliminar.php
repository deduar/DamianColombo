<?php session_start();?>
<?php ob_start();?>
<?php
include ("incFunction.php");
include ("connect.php");


$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$word = isset($_GET['word']) ? $_GET['word'] : null;

$sql = "DELETE FROM productmain WHERE codigo = ?";
$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('s', $codigo) or die ($mysqli->error);
$stmt->execute();  

$sql = "DELETE FROM productoscategoria WHERE codigo = ?";
$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('s', $codigo) or die ($mysqli->error);
$stmt->execute();  


header("Location: productos-listar.php?word=$word");


?>

