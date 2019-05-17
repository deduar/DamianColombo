<?php include ("../connect.php");?>
<?

$tipo2=$_GET['tipo'];
$id2=$_GET['id'];

$flag=$_POST['flag'];
$tipo=$_POST['tipo'];
$id=$_POST['id'];
$archivo=$_POST['archivo'];
$texto=$_POST['texto'];

if($flag==1) {

//*****************************************************************************************

function img_resize( $tmpname, $size, $save_dir, $save_name )
    {
    $save_dir .= ( substr($save_dir,-1) != "/") ? "/" : "";
        $gis       = GetImageSize($tmpname);
    $type       = $gis[2];
    switch($type)
        {
        case "1": $imorig = imagecreatefromgif($tmpname); break;
        case "2": $imorig = imagecreatefromjpeg($tmpname);break;
        case "3": $imorig = imagecreatefrompng($tmpname); break;
        default:  $imorig = imagecreatefromjpeg($tmpname);
        }

        $x = imageSX($imorig); //Devuelve el ancho
        $y = imageSY($imorig); //Devuelve el alto

        if($gis[0] <= $size)
        {
        $av = $x;
        $ah = $y;
        }
            else
        {

			$ah=($size*$y)/$x;
			$av=$size;

        }
        $im = imagecreate($av, $ah);
        $im = imagecreatetruecolor($av,$ah);
    if (imagecopyresampled($im,$imorig , 0,0,0,0,$av,$ah,$x,$y))
        if (imagejpeg($im, $save_dir.$save_name))
            return true;
            else
            return false;
    }

function img_resizeBig( $tmpname, $size, $save_dir, $save_name )
    {
    $save_dir .= ( substr($save_dir,-1) != "/") ? "/" : "";
        $gis       = GetImageSize($tmpname);
    $type       = $gis[2];
    switch($type)
        {
        case "1": $imorig = imagecreatefromgif($tmpname); break;
        case "2": $imorig = imagecreatefromjpeg($tmpname);break;
        case "3": $imorig = imagecreatefrompng($tmpname); break;
        default:  $imorig = imagecreatefromjpeg($tmpname);
        }

        $x = imageSX($imorig);
        $y = imageSY($imorig);
        if($gis[0] <= $size)
        {
        $av = $x;
        $ah = $y;
        }
            else
        {
            $yc = $y*1.3333333;
            $d = $x>$yc?$x:$yc;
            $c = $d>$size ? $size/$d : $size;
              $av = $x*$c;        //?????? ???????? ????????
              $ah = $y*$c;        //????? ???????? ????????
        }   
        $im = imagecreate($av, $ah);
        $im = imagecreatetruecolor($av,$ah);
    if (imagecopyresampled($im,$imorig , 0,0,0,0,$av,$ah,$x,$y))
        if (imagejpeg($im, $save_dir.$save_name))
            return true;
            else
            return false;
    }

//*****************************************************************************************


	if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
		copy($_FILES['archivo']['tmp_name'], $_FILES['archivo']['name']);
		$subio = true;
		
		$archivo=$_FILES['archivo']['name'];
		
	
	}
	
	if($subio) {
		
	/*	@img_resize($archivo , 460 , "small" , $archivo);
		@img_resizeBig($archivo , 1000 , "big" , $archivo);
*/


        $archivoAux=$id."-".$archivo;
        rename($archivo, $id."-".$archivo);


		$result = mysql_query("INSERT INTO archivonews (nombreArchivo,tipo, id,idModulo,textoArchivo) VALUES  ('$archivoAux', $tipo, $id,0,'$texto')", $link);

        echo "INSERT INTO archivonews (nombreArchivo,tipo, id,idModulo,textoArchivo) VALUES  ('$archivoAux', $tipo, $id,0,'$texto')";
				
		?>
        <SCRIPT LANGUAGE="JavaScript">
            window.opener.location.reload();
            window.close();
        </SCRIPT> 


<?	} else {
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
<form action="fileNewSecundarias.php" method="post" enctype="multipart/form-data" name="form1">
<input type="hidden" name="tipo" value="<? echo $tipo2; ?>">
<input type="hidden" name="id" value="<? echo $id2; ?>">
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