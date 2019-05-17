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

	echo $codigo=$row["b"];
	echo "<br>";
	//$auxPrincipal=1;

	/*$result2 = mysql_query("SELECT * FROM productmain WHERE codigo='$codigo'");

	If ($row2 = mysql_fetch_array($result2)) { 

		$result3 = mysql_query("UPDATE productmain SET principal=$auxPrincipal WHERE codigo='$codigo'", $link);

		echo "---> UPDATE productmain SET principal=$auxPrincipal WHERE codigo='$codigo'";
		echo "<br>";


	}else{

		$lista=$lista.$codigo."<br>";

	}*/

		
}


//echo "NO se actulizaron:<br>". $lista;

?>
</BODY>
</HTML>
