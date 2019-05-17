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

	$a=$row["a"];
	$b=$row["b"];
	$c=$row["c"];
	$d=$row["d"];
	$e=$row["e"];
	$f=$row["f"];
	$g=$row["g"];
	$h=$row["h"];
	$i=$row["i"];
	$j=$row["j"];
	$k=$row["k"];
	$l=$row["l"];
	$m=$row["m"];
	$n=$row["n"];

	$result2 = mysql_query("SELECT * FROM productmain WHERE codigo='$f'");

	If ($row2 = mysql_fetch_array($result2)) { 

		//$result3 = mysql_query("UPDATE productmain SET principal=$auxPrincipal WHERE codigo='$codigo'", $link);

		echo "---> UPDATE productmain SET codTipo='$d', codColor='$e', principal='$b', ancho='$g', largo='$k', profundidad='$h', alturaAsiento='$i', alturaTotal='$j', cuerpos='$m', plazas='$l', diametro='$n' WHERE codigo='$f'";
		echo "<br>";


	}else{

		$lista=$lista.$f."<br>";

	}

		
}


echo "NO se actulizaron:<br>". $lista;

?>
</BODY>
</HTML>
