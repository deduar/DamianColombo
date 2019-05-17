<?php include ("incFunction.php");?>
<?
srand(time());
$random2 = (rand()%7);


If ($random2==0) {
	$random2=1;
}

$usuario=$_POST['usuario'];
$password=$_POST['password'];
$flagAct=$_GET['flagAct'];
$flag=$_GET["flag"];



?>
<html>
<head>
<title>VIVRE</title>
<link rel="stylesheet" href="estilos.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="JAVA.JS"></SCRIPT>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td colspan="2" bgcolor="#acd335" class="topBackOffice"><p>VIVRE</p>
    <p>&nbsp;</p></td>
  </tr>  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>
            <p>&nbsp;</p>
            <table width="56%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td class="TableTDBackoffice"><p>Se enviaron los datos de acceso a su e-mail, gracias. <a href="index.php">Acceder</a></p></td>
              </tr>
            </table>
</td>
        </tr>
      </table>    </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

