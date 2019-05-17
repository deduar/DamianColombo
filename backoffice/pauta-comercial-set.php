<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");
include ("connectSC.php");?>
<?php

$idWeb=$_GET['idWeb'];
$idPautaSocial=$_GET['idPautaSocial'];

$_SESSION["idWeb"]=$idWeb;
$_SESSION["idPautaSocial"]=$idPautaSocial;


echo $_SESSION["idPautaSocial"];

header("Location: pauta-comercial-listar.php");

?>
