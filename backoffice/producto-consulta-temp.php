<?php session_start();?>
<?php ob_start();

include ("incFunction.php");
include ("connect.php");


$word = isset($_POST['word']) ? $_POST['word'] : null;  

$_SESSION["word"]=$word;

header("Location: productos-listar.php");
?>
