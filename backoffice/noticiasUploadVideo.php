<?php include ("connect.php");


$tipo2 = isset($_GET['tipo']) ? $_GET['tipo'] : null;
$id2 = isset($_GET['id']) ? $_GET['id'] : null;


$flag = isset($_POST['flag']) ? $_POST['flag'] : null;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;
$texto = isset($_POST['texto']) ? $_POST['texto'] : null;
$ver = isset($_POST['ver']) ? $_POST['ver'] : null;


if($flag==1) {

        $idModulo=0;
        include ("connect.php");
        $sql = "INSERT INTO archivonews (nombreArchivo,tipo, id,idModulo,textoArchivo, ver) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql) or die ($mysqli->error);
        $stmt->bind_param('siiisi', $codigo, $tipo, $id, $idModulo, $texto, $ver) or die ($mysqli->error);
        $stmt->execute();



?>

<SCRIPT LANGUAGE="JavaScript">
	<!--
	window.opener.location.reload();
	window.close();
	//-->
</SCRIPT> 

<?php } ?>
<html>
<head>
<title>U</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="estilos.css" type="text/css">
</head>

<body><br>


                      <table width="100%" border="0" cellspacing="2" cellpadding="2" class="unnamed1">
                        <tr> 
                          <td width="32%" height="0" class="TableTDBackoffice"><img src="images/videoYouTube.jpg" width="560" height="484" border="1"></td>
                          <td width="68%" height="0" valign="top" class="TableTDBackoffice">
                            <p>&nbsp;</p>
                            <form action="noticiasUploadVideo.php" method="post" enctype="multipart/form-data" name="form1">

                            <input type="hidden" name="tipo" value="<?php echo $tipo2; ?>">
                            <input type="hidden" name="id" value="<?php echo $id2; ?>">
                            <input type="hidden" name="flag" value="1">
                            <table width="100%" border="0">
                              <tr>
                                <td width="23%" class="TableTDBackoffice"><strong>C&oacute;digo Video YouTube</strong></td>
                                <td width="22%" class="TableTDBackoffice"><input type="text" name="codigo" class="input" size="20" id="codigo"></td>
                                <td width="55%" class="TableTDBackoffice"><input name="ver" type="checkbox" id="ver" value="1" checked>
Visualizar</td>
                              </tr>
                              <tr>
                                <td class="TableTDBackoffice"><strong>Descripci&oacute;n:</strong></td>
                                <td colspan="2" class="TableTDBackoffice"><input type="text" name="texto" class="input" size="25" id="texto"></td>
                              </tr>
                              <tr>
                                <td class="TableTDBackoffice">&nbsp;</td>
                                <td colspan="2" class="TableTDBackoffice"><input type="submit" value="Subir archivo" class="boton" name="submit"></td>
                              </tr>
                            </table></form>
                            <p>&nbsp; </p>
                          </td>
                        </tr>
                      </table>



</body>
</html>