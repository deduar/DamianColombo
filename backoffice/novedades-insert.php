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

$fechaDesde = date('Y-m-d');
$fechaHasta = date('Y-m-d');

include ("connect.php");

$sql = "INSERT INTO noticias (fechaDesde, fechaHasta, titulo, bajada, descripcion) VALUES (?, ?, ?, ?, ?)";

echo "INSERT INTO INSERT INTO noticias (fechaDesde, fechaHasta, titulo, bajada, descripcion) VALUES ($fechaDesde, $fechaHasta, $titulo, $bajada, $descripcion)";

$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('sssss', $fechaDesde, $fechaHasta, $titulo, $bajada, $descripcion) or die ($mysqli->error);
$stmt->execute();

include ("connect.php");
$result    = $mysqli->query("SELECT MAX(idNoticia) as max FROM noticias");
$row       = $result->fetch_assoc();
$idNoticia = $row["max"];   


header("Location: novedades-agregar-version.php?idNoticia=$idNoticia");


?>


</BODY>
</HTML>
