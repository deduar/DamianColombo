<?php session_start();?>
<?ob_start();?>

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
	
	include ("backoffice/connect.php");

    $sql  = "SELECT cod, des, des2 FROM correccionacentos";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($cod, $des, $des2);


    while ($stmt->fetch()) { 

    	include ("backoffice/connect.php");
    	
    	$cod=utf8_encode($cod);
    	$des=utf8_encode($des);
    	$des2=utf8_encode($des2);

		$sql2 = "UPDATE productmain SET descripcionLarga=?, descripcion=? WHERE codigo=?";

		echo "UPDATE productmain SET descripcionLarga='$des', descripcion='$des2' WHERE codigo='$cod'";
		echo "<br>";

		$stmt2 = $mysqli->prepare($sql2) or die ($mysqli->error);
		$stmt2->bind_param('sss', $des, $des2, $codigo) or die ($mysqli->error);
		$stmt2->execute();

                
    }

?>
</BODY>
</HTML>
