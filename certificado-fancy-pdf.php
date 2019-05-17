<?php session_start();?>
<?ob_start();?>
<?php include ("backoffice/incFunction.php");?>
<?php
require('fpdf/fpdf.php');

$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$codigo = htmlspecialchars($codigo);

$datosCertificado=array();
$datosCertificado=consultarCertificado($codigo);


$datosArticulo=array();
$datosArticulo=consultaArticuloCodigo($codigo);

$datosArticulo[25] = isset($datosArticulo[25]) ? $datosArticulo[25] : "-";

class PDF extends FPDF
{
    function insertarTxt($dato, $x, $y)
    {
            $this->SetXY($x, $y);
            $this->Cell(20,3,$dato,0);
    }

    // function insertarImagen($codigo, $x, $y)
    // {
    //
    //     $url_imagen="http://vivre.com.ar/catalogo/catalogo2018-marca/".$codigo."BIG1.jpg";
    //     //If(file_exists($url_imagen)){
    //         $this->Image($url_imagen, $x, $y, 35 , 28,'JPG', 'www.vivrenegocios.com.ar');
    //     /*}else{
    //         $url_imagen="http://www.vivreonline.com.ar/catalogo/sin-foto.jpg";
    //         $this->Image($url_imagen, $x, $y, 35 , 38,'JPG', 'www.vivrenegocios.com.ar');
    //     }*/
    // }
    //
    // function insertarImagenBlanco($codigo, $x, $y)
    // {
    //
    //     $url_imagen="http://vivre.com.ar/catalogo/catalogo2018-marca/sin-foto.jpg";
    //     //If(file_exists($url_imagen)){
    //         $this->Image($url_imagen, $x, $y, 35 , 28,'JPG', 'www.vivrenegocios.com.ar');
    //     /*}else{
    //         $url_imagen="http://www.vivreonline.com.ar/catalogo/sin-foto.jpg";
    //         $this->Image($url_imagen, $x, $y, 35 , 38,'JPG', 'www.vivrenegocios.com.ar');
    //     }*/
    // }


}

$xGrupo1=27;
$xGrupo2=55;
$x2=95;

$pdf = new PDF();
$pdf->AddPage();

$pdf->Image('assets/certificados/img/top.jpg',20,8,-300);
$pdf->Ln(20);
$pdf->SetFont('Helvetica','',10);

$x=25;
$y=40;
$texto=$datosCertificado[2];
$pdf->insertarTxt($texto, $x, $y);

$pdf->SetFont('Helvetica','',8);

If ($datosCertificado[3]){
  $y=$y+7;
  $pdf->insertarTxt("Shape", $xGrupo1, $y);
  $pdf->insertarTxt($datosCertificado[3], $xGrupo2, $y);

  // Linea 1
  $y=$y+3;
  $pdf->line($xGrupo1,$y,$x2,$y);
}

If ($datosCertificado[4]){
  $y=$y+1;
  $pdf->insertarTxt("Carat", $xGrupo1, $y);
  $pdf->insertarTxt($datosCertificado[4], $xGrupo2, $y);

  // Linea 2
  $y=$y+3;
  $pdf->line($xGrupo1,$y,$x2,$y);
}
If ($datosCertificado[5]){
  $y=$y+1;
  $pdf->insertarTxt("Colour Grade", $xGrupo1, $y);
  $pdf->insertarTxt($datosCertificado[5], $xGrupo2, $y);
  // Linea 3
  $y=$y+3;
  $pdf->line($xGrupo1,$y,$x2,$y);
}
If ($datosCertificado[6]){
  $y=$y+1;
  $pdf->insertarTxt("Clarity Grade", $xGrupo1, $y);
  $pdf->insertarTxt($datosCertificado[6], $xGrupo2, $y);
  // Linea 4
  $y=$y+3;
  $pdf->line($xGrupo1,$y,$x2,$y);
}

If ($datosCertificado[7]){
  $y=$y+1;
  $pdf->insertarTxt("Simmetry", $xGrupo1, $y);
  $pdf->insertarTxt($datosCertificado[7], $xGrupo2, $y);
  // Linea 5
  $y=$y+3;
  $pdf->line($xGrupo1,$y,$x2,$y);
}

If ($datosCertificado[8]){
  $y=$y+1;
  $pdf->insertarTxt("Color Origin", $xGrupo1, $y);
  $pdf->insertarTxt($datosCertificado[8], $xGrupo2, $y);
  // Linea 6
  $y=$y+3;
  $pdf->line($xGrupo1,$y,$x2,$y);
}

If ($datosCertificado[9]){
  $y=$y+1;
  $pdf->insertarTxt("Color Distribution", $xGrupo1, $y);
  $pdf->insertarTxt($datosCertificado[9], $xGrupo2, $y);
}
////////////////////////////////////////////////////////////////
// Segundo Grupo de Diamantes
////////////////////////////////////////////////////////////////

If ($datosCertificado[10]){

  $pdf->SetFont('Helvetica','',10);

  $x=25;
  $y=80;
  $texto=$datosCertificado[10];
  $pdf->insertarTxt($texto, $x, $y);

  $pdf->SetFont('Helvetica','',8);
  $x=27;

  If ($datosCertificado[11]){
    $y=$y+7;
    $pdf->insertarTxt("Shape", $xGrupo1, $y);
    $x=47;
    $pdf->insertarTxt($datosCertificado[11], $xGrupo2, $y);
    // Linea 1
    $y=$y+3;
    $pdf->line($xGrupo1,$y,$x2,$y);
  }
  If ($datosCertificado[12]){
    $y=$y+1;
    $pdf->insertarTxt("Carat", $xGrupo1, $y);
    $pdf->insertarTxt($datosCertificado[12], $xGrupo2, $y);
    // Linea 2
    $y=$y+3;
    $pdf->line($xGrupo1,$y,$x2,$y);
  }
  If ($datosCertificado[13]){
    $y=$y+1;
    $pdf->insertarTxt("Colour Grade", $xGrupo1, $y);
    $pdf->insertarTxt($datosCertificado[13], $xGrupo2, $y);

    // Linea 3

    $y=$y+3;
    $pdf->line($xGrupo1,$y,$x2,$y);
  }
  If ($datosCertificado[14]){
    $y=$y+1;
    $pdf->insertarTxt("Clarity Grade", $xGrupo1, $y);
    $pdf->insertarTxt($datosCertificado[14], $xGrupo2, $y);

    // Linea 4

    $y=$y+3;
    $pdf->line($xGrupo1,$y,$x2,$y);
  }
  If ($datosCertificado[15]){
    $y=$y+1;
    $pdf->insertarTxt("Simmetry", $xGrupo1, $y);
    $pdf->insertarTxt($datosCertificado[15], $xGrupo2, $y);

    // Linea 5

    $y=$y+3;
    $pdf->line($xGrupo1,$y,$x2,$y);
  }
  If ($datosCertificado[16]){
    $y=$y+1;
    $pdf->insertarTxt("Color Origin", $xGrupo1, $y);
    $pdf->insertarTxt($datosCertificado[16], $xGrupo2, $y);

    // Linea 6

    $y=$y+3;
    $pdf->line($xGrupo1,$y,$x2,$y);
  }
  If ($datosCertificado[17]){
    $y=$y+1;
    $pdf->insertarTxt("Color Distribution", $xGrupo1, $y);
    $pdf->insertarTxt($datosCertificado[17], $xGrupo2, $y);
  }
} else {
  $y=111;
}

//////////////////////////////////////////////////
// ADDITIONAL INFORMATION
///////////////////////////////////////////////////

$pdf->SetFont('Helvetica','',10);
$x=25;
$y=121;
$pdf->insertarTxt("ADDITIONAL INFORMATION", $x, $y);

$pdf->SetFont('Helvetica','',8);
$y=$y+4;
$pdf->insertarTxt("Graded as mounting permits. Measurements approx. ", $x, $y);


///////////////////////////////////////////////////
// DESCRIPCION / IMAGEN PRODUCTO / PIE DERECHO
///////////////////////////////////////////////////

$pdf->SetFont('Helvetica','',10);

$x=110;
$y=40;
$pdf->insertarTxt("DESCRIPTION", $x, $y);

$imgProducto="assets/certificados/productos/".$codigo."BIG1.jpg";
$pdf->Image($imgProducto,105,50,0);
$pdf->SetFont('Helvetica','',7);
$y=$y+7;
$pdf->SetXY($x, $y);
$pdf->MultiCell(80, 5, utf8_encode($datosArticulo[25]));
///////////////////////////////////////////////////
// FOOTER
///////////////////////////////////////////////////

$x=110;
$y=121;
$pdf->insertarTxt("General Conditions Apply", $x, $y);
$y=$y+4;
$pdf->insertarTxt("Visit: www.damiancolombo.com", $x, $y);

///////////////////////////////////////////////////
// REVERSO
///////////////////////////////////////////////////
///////////////////////////////////////////////////
///////////////////////////////////////////////////

$x=25;
$y=150;
$x2=185;
$pdf->SetFont('Helvetica','',11);
$pdf->insertarTxt("COLOUR", $x, $y);
$y=$y+5;
$pdf->line($x,$y,$x2,$y);
$y=158;
$pdf->Image('assets/certificados/img/diamantes.jpg',25,$y,0);
$pdf->SetFont('Helvetica','',8);
$y=$y+21;
$pdf->insertarTxt("Faint", 27, $y);
$pdf->insertarTxt("Very Light", 45, $y);
$pdf->insertarTxt("Light", 65, $y);
$pdf->insertarTxt("Fancy Light", 78, $y);
$pdf->insertarTxt("Fancy", 99, $y);
$pdf->insertarTxt("Fancy Dark", 114, $y);
$pdf->insertarTxt("Fancy", 136, $y);
$pdf->insertarTxt("Fancy", 152, $y);
$pdf->insertarTxt("Fancy", 169, $y);
$y=$y+4;
$pdf->insertarTxt("Intense", 136, $y);
$pdf->insertarTxt("Deep", 152, $y);
$pdf->insertarTxt("Vivid", 169, $y);

$y=175;


/////////////////////////////////////////////////////////////////
// CLARITY
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////

$y=$y+12;
$x2=185;

$pdf->SetFont('Helvetica','',11);
$pdf->insertarTxt("CLARITY", $x, $y);
$y=$y+5;
$pdf->line($x,$y,$x2,$y);
$y=$y+2;
$pdf->Image('assets/certificados/img/clarity1.png',25,$y,0);
$pdf->Image('assets/certificados/img/clarity2.png',52,$y,0);
$pdf->Image('assets/certificados/img/clarity3.png',79,$y,0);
$pdf->Image('assets/certificados/img/clarity4.png',106,$y,0);
$pdf->Image('assets/certificados/img/clarity5.png',133,$y,0);
$pdf->Image('assets/certificados/img/clarity6.png',160,$y,0);
$y=$y+20;
//
$pdf->SetFont('Helvetica','',8);
$y=$y+5;
$pdf->insertarTxt("FLAWLESS", 28, $y);
$pdf->insertarTxt("INTERNALLY", 54, $y);
$pdf->insertarTxt("VVS1 / VVS2", 81, $y);
$pdf->insertarTxt("VS1 / VS2", 110, $y);
$pdf->insertarTxt("SI1 / SI2", 138, $y);
$pdf->insertarTxt("I1 / I2 / I3", 165, $y);
$y=$y+5;
$pdf->insertarTxt("FLAWLESS", 55, $y);
$pdf->insertarTxt("Very Very", 84, $y);
$pdf->insertarTxt("Very Slightly", 109, $y);
$pdf->insertarTxt("Slightly", 139, $y);
$pdf->insertarTxt("Included", 165, $y);

$y=$y+5;
$pdf->insertarTxt("Slightly Included", 79, $y);
$pdf->insertarTxt("Included", 111, $y);
$pdf->insertarTxt("Included", 138, $y);


/////////////////////////////////////////////////////////////////
// SHAPE
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////

$y=$y+7;
$x2=185;

$pdf->SetFont('Helvetica','',11);
$pdf->insertarTxt("SHAPE", $x, $y);
$y=$y+5;
$pdf->line($x,$y,$x2,$y);
$y=$y+1;
$pdf->Image('assets/certificados/img/shape.png',25,$y,0);
$pdf->SetFont('Helvetica','',7);
$y=$y+20;
$pdf->insertarTxt("Round", 27, $y);
$pdf->insertarTxt("Princess", 42, $y);
$pdf->insertarTxt("Emerald", 57, $y);
$pdf->insertarTxt("Asscher", 75, $y);
$pdf->insertarTxt("Marquise", 90, $y);
$pdf->insertarTxt("Oval", 109, $y);
$pdf->insertarTxt("Radiant", 123, $y);
$pdf->insertarTxt("Pear", 142, $y);
$pdf->insertarTxt("Heart", 157, $y);
$pdf->insertarTxt("Cushion", 172, $y);



$pdf->Output();
?>
