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

$result3 = mysql_query("UPDATE productmain SET codTipo='0', codColor='0', principal='0', ancho='0', largo='0', profundidad='0', alturaAsiento='0', alturaTotal='0', cuerpos='0', plazas='0', diametro='0'", $link);


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

		$result3 = mysql_query("UPDATE productmain SET codTipo='$d', codColor='$e', principal='$b', ancho='$g', largo='$k', profundidad='$h', alturaAsiento='$i', alturaTotal='$j', cuerpos='$m', plazas='$l', diametro='$n' WHERE codigo='$f'", $link);

		echo "_______> UPDATE productmain SET codTipo='$d', codColor='$e', principal='$b', ancho='$g', largo='$k', profundidad='$h', alturaAsiento='$i', alturaTotal='$j', cuerpos='$m', plazas='$l', diametro='$n' WHERE codigo='$f'";
		echo "<br>";


	}else{

		$lista=$lista.$f."<br>";

	}

		
}


echo "NO se actulizaron:<br>". $lista;

?>
</BODY>
</HTML>
