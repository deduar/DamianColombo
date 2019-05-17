<?php session_start();?>
<?ob_start();?>
<?
srand(time());
$movie = (rand()%18);


If ($movie==0) {
	$movie=1;
}

srand(time());
$random2 = (rand()%7);

If ($random2==0) {
	$random2=1;
}
$usuario=$_POST['usuario'];
$password=$_POST['password'];
$flagAct=$_GET['flagAct'];
$flag=$_GET['flag'];
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIVRE ON LINE</title>
<link rel="stylesheet" href="estilos.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="JAVA.JS"></SCRIPT>
<script language="JavaScript" src="picker.js"></script>
<script language="JavaScript" type="text/JavaScript">

<!--
function MM_openBrWindow(theURL,winName,features)) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<link rel="stylesheet" href="http://www.sconsultinghost.com.ar/adminNew/estilos.css" type="text/css">
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js' type='text/javascript'/></script>

<style type="text/css">
<!--

BODY{
   background: #000000 url(http://www.sconsulting.com.ar/images/bg<?echo $movie;?>.jpg) no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;


}
   
</style>

</head>
<body>

  </p>
  <p>&nbsp;</p>
<p>&nbsp;</p>
  <p>&nbsp;</p>
<FORM METHOD=POST ACTION="loginRecovery2.php">
  <p>
    <input type="hidden" name="random2" value="<? echo $random2; ?>">
<div class="transbox2">
  <p><strong>VIVRE | RECUPERAR PASSWORD</strong> <br>
    <br>
  </p>
  <p>Se enviaron los datos de acceso a su e-mail, gracias. <a href="index.php">Acceder</a></p>

  </div>
<div class="logo"><img src="http://www.sconsultinghost.com.ar/adminNew/images/logo-sconsulting.gif" alt=""/>
</div>
</form>
<p>&nbsp;</p>
</body>
</html>

