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

$result = mysql_query("SELECT * FROM `TABLE 23`");

while ($row = mysql_fetch_array($result)) { 

	$email=$row["email"];

	$result2 = mysql_query("SELECT * FROM usuarios WHERE email='$email'");

	If ($row2 = mysql_fetch_array($result2)) { 

		echo "Eliminar: ". $email."<br>";

	}

		
}

?>
</BODY>
</HTML>
