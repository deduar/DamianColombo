<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?
$email=$_POST['email'];
$password=$_POST['password'];

$random2=$_POST['random2'];
$pass=$_POST['pass'];



echo $pass;
echo "---";
echo $random2;
echo "<BR><BR>";
$flagPass=0;

If ($random2 == 1 and ($pass=="YIJ4" or $pass=="yij4")) { 
	$flagPass=1;
}
If ($random2 == 2 and ($pass == "B61C" or $pass == "b61c")) {
	$flagPass=1;
}
If ($random2 == 3 and ($pass == "DBBK" or $pass == "dbbk")) {
	$flagPass=1;
}
If ($random2 == 4 and ($pass == "DXWW" or $pass == "dxww")) {
	$flagPass=1;
}
If ($random2 == 5 and ($pass == "8JGW" or $pass == "8jgw")) {
	$flagPass=1;
}
If ($random2 == 6 and ($pass == "G89C" or $pass == "g89c")) {
	$flagPass=1;
}

echo "FlagPass >>".$flagPass;

echo "<br>";

$result = mysql_query("SELECT * FROM claves where email='$email' AND password='$password'", $link);

echo "SELECT * FROM usuarios where email='$email' AND password='$password'";
echo "<br>";
$pass=$row["password"];
echo "<br>";
echo "Password: ".$pass;
echo "<br>";

If (($row = mysql_fetch_array($result)) and ($flagPass == 1)) { 

	$_SESSION["security"]="FF56YU235";
	$_SESSION["idUsuario"]=$row["idUsuario"];
	$_SESSION["nombreUsuario"]=$row["nombre"];
	$_SESSION["nivel"]=$row["nivel"];
	$_SESSION["idUsuarioTicket"]=$row["idUsuarioTicket"];	

	header("Location: home.php");

	
}Else{


  header("Location: index.php?flag=1");	


}
?>

<?php include ("incBottom.php");?>


