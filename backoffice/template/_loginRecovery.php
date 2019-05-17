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
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><? @menu("Recuperar Password",1); ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><FORM METHOD=POST ACTION="loginRecovery2.php">
            <input type="hidden" name="random2" value="<? echo $random2; ?>">
            <table width="56%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="18%" class="TableTDBackoffice">E-mail:</td>
                <td width="82%" class="TableTDBackoffice"><p>
                  <input name="email" type="text" class=input id="email" size="60"> 
                <? If ($flag==2) {?></p>
                  <p><font size="2" color="#FF0033">No coincide el e-mail en nuestra base de datos, intente nuevamente. </font></p>
                  <? } ?></td>
              </tr>
              <tr>
                <td class="TableTDBackoffice">&nbsp;</td>
                <td width="82%" class="TableTDBackoffice"><img src="pass/<? echo $random2; ?>.jpg" width="120" height="60" border="1"></td>
              </tr>
              <tr>
                <td class="TableTDBackoffice">Ingrese C&oacute;digo:</td>
                <td class="TableTDBackoffice"><input name="pass" type="text" class=input>
                  (Respete las may&uacute;sculas) </td>
              </tr>
              <tr>
                <td width="18%" class="TableTDBackoffice">&nbsp;</td>
                <td width="82%" class="TableTDBackoffice"><input type="submit" name="Submit" value="Ingresar" class=boton></td>
              </tr>
              <tr>
                <td class="TableTDBackoffice">&nbsp;</td>
                <td class="TableTDBackoffice"><p>
                  <? If ($flag==1) {?>
                </p>
                  <p><font size="2" color="#FF0033">C&oacute;digo incorrecto. </font></p>
                  <? } ?></td>
              </tr>
            </table>
          </form></td>
        </tr>
      </table>    </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

