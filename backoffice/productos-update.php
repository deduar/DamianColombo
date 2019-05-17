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

$idProductMain = isset($_POST['idProductMain']) ? $_POST['idProductMain'] : null;
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$tipoArticulo = isset($_POST['tipoArticulo']) ? $_POST['tipoArticulo'] : null;
$descripcionLarga = isset($_POST['descripcionLarga']) ? $_POST['descripcionLarga'] : null;
$stock = isset($_POST['stock']) ? $_POST['stock'] : null;
$medida = isset($_POST['medida']) ? $_POST['medida'] : null;
$codMetal = isset($_POST['codMetal']) ? $_POST['codMetal'] : null;
$pesoMetal = isset($_POST['pesoMetal']) ? $_POST['pesoMetal'] : null;
$codPiedra = isset($_POST['codPiedra']) ? $_POST['codPiedra'] : null;
$cortePiedra = isset($_POST['cortePiedra']) ? $_POST['cortePiedra'] : null;
$pesoPiedra = isset($_POST['pesoPiedra']) ? $_POST['pesoPiedra'] : null;
$colorPiedra = isset($_POST['colorPiedra']) ? $_POST['colorPiedra'] : null;
$purezaPiedra = isset($_POST['purezaPiedra']) ? $_POST['purezaPiedra'] : null;
$codpiedra2 = isset($_POST['codpiedra2']) ? $_POST['codpiedra2'] : null;
$pesoPiedra2 = isset($_POST['pesoPiedra2']) ? $_POST['pesoPiedra2'] : null;
$colorPiedra2 = isset($_POST['colorPiedra2']) ? $_POST['colorPiedra2'] : null;
$purezaPiedra2 = isset($_POST['purezaPiedra2']) ? $_POST['purezaPiedra2'] : null;
$certificado = isset($_POST['certificado']) ? $_POST['certificado'] : null;
$precioLista = isset($_POST['precioLista']) ? $_POST['precioLista'] : null;
$precioFinal = isset($_POST['precioFinal']) ? $_POST['precioFinal'] : null;
$palabrasClaves = isset($_POST['palabrasClaves']) ? $_POST['palabrasClaves'] : null;
$urlCorta = isset($_POST['urlCorta']) ? $_POST['urlCorta'] : null;
$destacado = isset($_POST['destacado']) ? $_POST['destacado'] : null;
$catalogo = isset($_POST['catalogo']) ? $_POST['catalogo'] : null;
$flagNew = isset($_POST['flagNew']) ? $_POST['flagNew'] : null;
$labelDescuento = isset($_POST['labelDescuento']) ? $_POST['labelDescuento'] : null;
$certificado2 = isset($_POST['certificado2']) ? $_POST['certificado2'] : null;

$diamond1 = isset($_POST['diamond1']) ? $_POST['diamond1'] : null;
$shape1 = isset($_POST['shape1']) ? $_POST['shape1'] : null;
$carat1 = isset($_POST['carat1']) ? $_POST['carat1'] : null;
$colourGrade1 = isset($_POST['colourGrade1']) ? $_POST['colourGrade1'] : null;
$clarityGrade1 = isset($_POST['clarityGrade1']) ? $_POST['clarityGrade1'] : null;
$symmetry1 = isset($_POST['symmetry1']) ? $_POST['symmetry1'] : null;
$colorOrigin1 = isset($_POST['colorOrigin1']) ? $_POST['colorOrigin1'] : null;
$colorDistribution1 = isset($_POST['colorDistribution1']) ? $_POST['colorDistribution1'] : null;
$diamond2 = isset($_POST['diamond2']) ? $_POST['diamond2'] : null;
$shape2 = isset($_POST['shape2']) ? $_POST['shape2'] : null;
$carat2 = isset($_POST['carat2']) ? $_POST['carat2'] : null;
$colourGrade2 = isset($_POST['colourGrade2']) ? $_POST['colourGrade2'] : null;
$clarityGrade2 = isset($_POST['clarityGrade2']) ? $_POST['clarityGrade2'] : null;
$symmetry2 = isset($_POST['symmetry2']) ? $_POST['symmetry2'] : null;
$colorOrigin2 = isset($_POST['colorOrigin2']) ? $_POST['colorOrigin2'] : null;
$colorDistribution2 = isset($_POST['colorDistribution2']) ? $_POST['colorDistribution2'] : null;
$descripcionCertificado = isset($_POST['descripcionCertificado']) ? $_POST['descripcionCertificado'] : null;

$descripcionCertificado=limpiaCadena($descripcionCertificado);

//If ($_SESSION["nivel"]==0) {




	$sql = "UPDATE productmain SET codigo=?, descripcion=?, descripcionLarga=?, stock=?, medida=?, codMetal=?, pesoMetal=?, codPiedra=?, cortePiedra=?, pesoPiedra=?, colorPiedra=?, purezaPiedra=?, codpiedra2=?, pesoPiedra2=?, colorPiedra2=?, purezaPiedra2=?, certificado=?, precioLista=?, precioFinal=?, palabrasClaves=?, urlCorta=?, destacado=?, catalogo=?, flagNew=?, labelDescuento=?, certificado2=?, descripcionCertificado=?, tipoArticulo=? WHERE idProductMain=?";
	$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
	$stmt->bind_param('sssisisissssissssdissiiiiisii', $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew, $labelDescuento, $certificado2, $descripcionCertificado, $tipoArticulo, $idProductMain) or die ($mysqli->error);
	$stmt->execute();


	$sql = "DELETE FROM certificado WHERE codigo = ?";
	$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
	$stmt->bind_param('s', $codigo) or die ($mysqli->error);
	$stmt->execute();


	$sql = "INSERT INTO certificado (codigo, diamond1, shape1, carat1, colourGrade1, clarityGrade1, symmetry1, colorOrigin1, colorDistribution1, diamond2, shape2, carat2, colourGrade2, clarityGrade2, symmetry2, colorOrigin2, colorDistribution2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


	$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
	$stmt->bind_param('sssssssssssssssss', $codigo, $diamond1, $shape1, $carat1, $colourGrade1, $clarityGrade1, $symmetry1, $colorOrigin1, $colorDistribution1, $diamond2, $shape2, $carat2, $colourGrade2, $clarityGrade2, $symmetry2, $colorOrigin2, $colorDistribution2) or die ($mysqli->error);
	$stmt->execute();





	/*$result2 = mysql_query("Select * From negociosPrecio where codigo='$codigo'");

	If (mysql_fetch_array($result2)){

		$result = mysql_query("UPDATE negociosPrecio SET precio='$precionegocios', stock='$estado', fecha='$fecha' WHERE codigo='$codigo'", $link);

		echo "UPDATE negociosPrecio SET precio='$precionegocios', stock='$estado', fecha='$fecha' WHERE codigo='$codigo'";

	}else{

		$result = mysql_query("INSERT INTO negociosPrecio (codigo, precio, stock, fecha) VALUES ('$codigo', '$precionegocios', '$estado', '$fecha')", $link);

		echo "INSERT INTO negociosPrecio (codigo, precio, stock, fecha) VALUES ('$codigo', '$precionegocios', '$estado', '$fecha')";

	}*/


//}else{

		/*$result = mysql_query("UPDATE productmain SET estadooutlet='$estadooutlet', datooutlet='$datooutlet', agotadooutlet='$agotadooutlet', preciolistaoutlet='$preciolistaoutlet', precioactualoutlet='$precioactualoutlet', destacadooutlet='$destacadooutlet' WHERE idProductMain=$idProductMain", $link);

		echo "UPDATE productmain SET estadooutlet='$estadooutlet', datooutlet='$datooutlet', agotadooutlet='$agotadooutlet', preciolistaoutlet='$preciolistaoutlet', precioactualoutlet='$precioactualoutlet' WHERE idProductMain=$idProductMain";*/


//}


header("Location: producto.php?idProductMain=$idProductMain&flag=1");

?>
</BODY>
</HTML>
