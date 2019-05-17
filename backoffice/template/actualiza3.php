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

$result = mysql_query("SELECT * FROM prodaux");

while ($row = mysql_fetch_array($result)) { 

	$cod1=$row["codigo"];


	$result2 = mysql_query("SELECT * FROM productmain WHERE codigo='$cod1'");

	If ($row2 = mysql_fetch_array($result2)) { 


		$result3 = mysql_query("UPDATE productmain SET estadovivre='1' WHERE codigo='$cod1'", $link);

		echo "UPDATE productmain SET estadovivre='1' WHERE codigo='$cod1'";
		echo "<br>";


	}else{

		$lista=$lista.$cod1."<br>";

	}

		
}


echo $lista;

?>
</BODY>
</HTML>
