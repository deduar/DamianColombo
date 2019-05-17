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

$result = mysql_query("SELECT * FROM auxArticulos");

while ($row = mysql_fetch_array($result)) { 

	$codTipo=$row["a"];
	$codColor=$row["b"];
	$codigo=$row["c"];
	$d=$row["d"];
	$e=$row["e"];
	

	$result2 = mysql_query("SELECT * FROM productmain WHERE codigo='$codigo'");

	If ($row2 = mysql_fetch_array($result2)) { 

		//$result3 = mysql_query("UPDATE productmain SET codTipo=$codTipo, codColor=$codColor, diametro='$d', alturaTotal='$e' WHERE codigo='$codigo'", $link);

		echo "---> UPDATE productmain SET codTipo=$codTipo, codColor=$codColor, diametro='$d', alturaTotal='$e' WHERE codigo='$codigo'";
		echo "<br>";


	}else{

		$lista=$lista.$codigo."<br>";

	}

		
}


echo "NO se actulizaron:<br>". $lista;

?>
</BODY>
</HTML>
