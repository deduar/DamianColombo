<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");
include ("connect.php");?>
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<?php 


$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$bajada = isset($_POST['bajada']) ? $_POST['bajada'] : null;
$idNoticia = isset($_POST['idNoticia']) ? $_POST['idNoticia'] : null;


$sql = "UPDATE noticias SET titulo=?, bajada=?, descripcion=? WHERE idNoticia=?";
$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('sssi', $titulo, $bajada, $descripcion, $idNoticia) or die ($mysqli->error);
$stmt->execute();


header("Location: novedades-agregar-version.php?idNoticia=$idNoticia");

?>
</BODY>
</HTML>
