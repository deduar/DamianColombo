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

$result = mysql_query("SELECT * FROM colores");

while ($row = mysql_fetch_array($result)) { 

	echo $codigo=$row["codColor"];
	echo " | ";
	echo $codigo=$row["nombreColor"];
	echo "<br>";
		
}


?>
</BODY>
</HTML>
