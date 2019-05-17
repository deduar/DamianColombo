<?
include ("incFunction.php");
$link=mysql_connect("200.58.127.193", "cx000166_advivre", "65Polonia");
mysql_select_db("cx000166_vivre", $link); 


$estado=$_GET['estado'];

$result = mysql_query("Select * from usuarioMay where estado=$estado order by fecha DESC");

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition:  filename=\"X2003.XLS\";");

/*
$filename = "myFile.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
*/


echo "<table border=1>" ;
echo "<TR> 
<td>Nombre</TD>
<td>Email</TD>
</TR>";

while ($row = mysql_fetch_array($result)) { 

	$nombre=$row["nombre"];						
	$email=$row["email"];

	$fecha=@cambiaf_a_normal($fecha);


	echo "<TR> 
	  <td>".$nombre."</TD>
	  <TD>".$email."</TD>
	</TR>";
}
?>

