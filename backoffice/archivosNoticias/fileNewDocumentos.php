<?php include ("../connect.php");

$tipo2 = isset($_GET['tipo']) ? $_GET['tipo'] : null;
$id2 = isset($_GET['id']) ? $_GET['id'] : null;


$flag = isset($_POST['flag']) ? $_POST['flag'] : null;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;
$texto = isset($_POST['texto']) ? $_POST['texto'] : null;
$archivo = isset($_POST['archivo']) ? $_POST['archivo'] : null;


if($flag==1) {


	if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
		copy($_FILES['archivo']['tmp_name'], $_FILES['archivo']['name']);
		$subio = true;
		
		$archivo=$_FILES['archivo']['name'];
		
	
	}
	
	if($subio) {


		$idModulo=0;
        include ("../connect.php");
        $sql = "INSERT INTO archivonews (nombreArchivo,tipo, id,idModulo,textoArchivo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql) or die ($mysqli->error);
        $stmt->bind_param('siiis', $archivoAux, $tipo, $id, $idModulo, $texto) or die ($mysqli->error);
        $stmt->execute();


				
		?>



<SCRIPT LANGUAGE="JavaScript">
	<!--
	window.opener.location.reload();
	window.close();
	//-->
</SCRIPT>


<?php	} else {
		echo "El archivo no se pudo subir intente mas tarde.";	
	}

	die();

} ?>
<html>
<head>
<title>U</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos.css" type="text/css">
</head>

<body>
<form action="fileNewDocumentos.php" method="post" enctype="multipart/form-data" name="form1">
<input type="hidden" name="tipo" value="<?php echo $tipo2; ?>">
<input type="hidden" name="id" value="<?php echo $id2; ?>">
<input type="hidden" name="flag" value="1">


                      <table width="80%" border="0" cellspacing="2" cellpadding="2" class="unnamed1">
                        <tr> 
                          <td width="28%" class="TableTDBackoffice">Archivo | </td>
                          <td width="72%" class="TableTDBackoffice"> 
                            <input type="file" name="archivo" id="archivo" class="input">
                          </td>
                        </tr>
                        <tr> 
                          <td width="28%" height="0" class="TableTDBackoffice">Texto |</td>
                          <td width="72%" height="0" class="TableTDBackoffice">
                            <input type="text" name="texto" class="input" size="40">
                          </td>
                        </tr>
                        <tr> 
                          <td width="28%" height="0" class="TableTDBackoffice">&nbsp;</td>
                          <td width="72%" height="0" class="TableTDBackoffice">
                            <input type="submit" value="Subir archivo" class="boton" name="submit">
                          </td>
                        </tr>
                      </table>


</form>
</body>
</html>