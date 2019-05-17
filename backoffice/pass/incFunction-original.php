<?php

/*
error_reporting(E_ALL);
ini_set('display_errors', '1');
*/

/////////////// FUNCIONES DASHBOARD ////////////////////////////////////

function totalContactos($idWeb){

	switch($idWeb)
	{
		case 1:  
			$link=mysql_connect("200.58.127.193", "cx000166_advivre", "65Polonia");
			mysql_select_db("cx000166_vivre", $link); 		
			$resp = mysql_query ("Select count(*) as totalContacto from outletpersonas");
			break;
		case 5:  
			$link=mysql_connect("200.58.127.193", "cx000166_advivre", "65Polonia");
			mysql_select_db("cx000166_vivre", $link); 		
			$resp = mysql_query ("Select count(*) as totalContacto from usuarios");
			break;		
		case 2:  
			$link=mysql_connect("200.58.127.193", "cx000166_forvis", "89Panama12");
			mysql_select_db("cx000166_forvis", $link);  		
			$resp = mysql_query ("Select count(*) as totalContacto from personas");
			break;					
		case 6:  
			$link=mysql_connect("200.58.127.193", "cx000166_advivre", "65Polonia");
			mysql_select_db("cx000166_vivre", $link);  		
			$resp = mysql_query ("Select count(*) as totalContacto from onlinepersonas");
			break;								
	}

	$row3 = mysql_fetch_array($resp);
	echo $row3["totalContacto"];
}



function totalGoogle($idWeb){
$link=mysql_connect("200.58.127.193", "cx000166_admi12", "Panama90");
mysql_select_db("cx000166_desarrollo", $link); 
	
$fecha=date('Y/m/d'); 
$mes=date("m", strtotime($fecha));
$anio=date("Y", strtotime($fecha));
$mes--;
    If ($mes==0) {
        $mes=12;
        $anio--;
    }

    
    $resp = mysql_query("SELECT SUM(total) as totalGoogle FROM pautaGoogle WHERE idWeb = $idWeb AND MONTH(fecha)=$mes AND YEAR(FECHA)=$anio");  
	$row3 = mysql_fetch_array($resp);
	$row3["totalGoogle"];
	echo $row3["totalGoogle"];
}


function totalPauta($idWeb, $idPautaSocial, $comercial){

	$link=mysql_connect("200.58.127.193", "cx000166_admi12", "Panama90");
	mysql_select_db("cx000166_desarrollo", $link); 

	$resp = mysql_query ("Select count(*) as totalPauta from pautamkd where (idWeb=$idWeb AND idPautaSocial=$idPautaSocial AND comercial= $comercial)");
	$row3 = mysql_fetch_array($resp);
	$row3["totalPauta"];
	echo $row3["totalPauta"];
}


function iconoPauta($idPautaSocial){

	switch($idPautaSocial)
	{
		case 1:  $icon="facebook.png"; break;
		case 3:  $icon="mailing.png"; break;
	}
	echo "<img src='images/".$icon."'><p><a href='#' data-toggle='modal' data-target=#myModal".$cont.">Ver Post</a></p>"; 	
}


/////////////// FIN FUNCIONES DASHBOARD ////////////////////////////////////



function verEstadoUsuario($estado){
	switch($estado)
	{
		case "0":  echo "DESACTIVO"; break;
		case "1":  echo "ACTIVO"; break;	
		case "2":  echo "NO ES MAYORISTA"; break;
	}
}


function mostrarDescripcion($codigo){

	$resp = mysql_query ("SELECT * FROM productmain WHERE codigo='$codigo'");
	$row3 = mysql_fetch_array($resp);

	$codigo=strtoupper($row3["codigo"]);
	$descripcion=$row3["descripcion"];
	$descripcionLarga=$row3["descripcionLarga"];

	echo "<div class='row'>
	    <div class='col-md-6'><IMG SRC='../catalogo/".$codigo.".jpg' border=0></div>
	    <div class='col-md-6'><h4>".$codigo."</h4><h5>".$descripcion."</h5><h5>".$descripcionLarga."</h5>
	    </div></div>";

}

function datosEntrega($idEntrega){

	$resultB = mysql_query("SELECT * FROM entrega WHERE idEntrega=$idEntrega");

	

	$rowB = mysql_fetch_array($resultB);

	$direccionEntrega=$rowB["direccion"];
	$localidadEntrega=$rowB["localidad"];
	$provinciaEntrega=$rowB["provincia"];	
	$cpEntrega=$rowB["cp"]; 

	echo $direccionEntrega." - ".$localidadEntrega." - ".$provinciaEntrega." - ".$cpEntrega;
}


function datosExpreso($idExpreso){

	$resultE = mysql_query("SELECT * FROM expreso WHERE idExpreso=$idExpreso");
	$rowE = mysql_fetch_array($resultE);

	$direccionExpreso=$rowE["direccion"];
	$localidadExpreso=$rowE["localidad"];
	$provinciaExpreso=$rowE["provincia"];	
	$cpExpreso=$rowE["cp"]; 
	$nombreExpreso=$rowE["nombreExpreso"]; 
	$codTelefonoExpreso=$rowE["codTelefono"]; 
	$telefonoExpreso=$rowE["telefono"]; 

	echo $nombreExpreso." - ".$direccionExpreso." - ".$localidadExpreso." - ".$provinciaExpreso." - ".$telefonoExpreso;
}

function mostrarCarrito($id){
    echo "<p class='btn-add'><i class='fa fa-shopping-cart'></i><a href='carrito.php?id=".$id."&action=add' class='hidden-sm'> Agregar al Carrito</a></p>";
}

function mostrarCarritoNoLogin($id){
	//echo "<p class='btn-add'><i class='fa fa-shopping-cart'></i><a href='carrito.php?id=".$id."&action=add' class='hidden-sm'> Agregar al Carrito</a></p>";
    echo "<p class='btn-add'><i class='fa fa-shopping-cart'></i><a href='login.php?aviso=1' class='hidden-sm'> Agregar al Carrito</a></p>";
}


function total($tipoEstado){


	$resultD = mysql_query("SELECT COUNT(estado) as total FROM pedidos where estado=$tipoEstado");
	$rowD = mysql_fetch_array($resultD);
	$totalA=$rowD["total"];	
	echo $totalA;
}

function extension($nombreArchivo){

	$totalCadena = strlen($nombreArchivo);
    $pos = $totalCadena-3;
	$ext = substr($nombreArchivo, $pos, $totalCadena);
	echo $ext;
} 


function verEstado($estado){
	switch($estado)
	{
		case "0": return $estadoVer = "BANDEJA DE ENTRADA"; break;
		case "1": return $estadoVer = "PRESUPUESTADO"; break;	
		case "2": return $estadoVer = "EN PROCESO"; break;
		case "3": return $estadoVer = "DESPACHADO"; break;
		case "4": return $estadoVer = "ENTREGADO"; break;
		case "5": return $estadoVer = "RECHAZADA"; break;									
	
	}
}
function cambiafechamysqlini($fecha_nom){
ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha_nom, $mifechauno);
$fechana=$mifechauno[3]."-".$mifechauno[2]."-".$mifechauno[1];
return $fechana;
}

function cambiaf_a_normal($fecha){
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
} 

function devuelveMes($fecha_nom){
ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha_nom, $mifechauno);
$fechana=$mifechauno[2];
return $fechana;
}

function devuelveAnio($fecha_nom){
ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha_nom, $mifechauno);
$fechana=$mifechauno[3];
return $fechana;
}

function devuelveDia($fecha_nom){
ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha_nom, $mifechauno);
$fechana=$mifechauno[1];
return $fechana;
}

function compara_fechas($fecha1,$fecha2)
{
      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
              list($dia1,$mes1,$año1)=split("/",$fecha1);

	  if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
              list($dia1,$mes1,$año1)=split("-",$fecha1);
        if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
              list($dia2,$mes2,$año2)=split("/",$fecha2);
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
              list($dia2,$mes2,$año2)=split("-",$fecha2);
        $dif = mktime(0,0,0,$mes1,$dia1,$año1) - mktime(0,0,0, $mes2,$dia2,$año2);
        return ($dif);                         
}

function titTop($titulo){

echo "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='1%' height='39'><img src='images/boxTit1.gif' width='10' height='31'></td><td width='98%'><table width='100%' border='0' cellpadding='0' cellspacing='0'><tr><td bgcolor='#E6E6E6'><img src='images/pix.gif' width='1' height='1'></td></tr><tr><td><table width='100%' border='0' cellpadding='0' cellspacing='0'><tr><td width='3' bgcolor='#F7F7F7'><img src='images/pix.gif' width='1' height='29'></td><td width='25' bgcolor='#F7F7F7'><img src='images/iconTIt.gif' width='20' height='21'></td><td width='715' bgcolor='#F7F7F7'><span class='titulo'>".$titulo."</span></td></tr></table></td></tr><tr><td bgcolor='#E6E6E6'><img src='images/pix.gif' width='1' height='1'></td></tr></table></td><td width='1%'><img src='images/boxTit2.gif' width='10' height='31'></td></tr></table>";
	
}

function menu($txt, $tipo)
{

	switch ($tipo) {
	case 2:
        echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td class='TableTDCabeceraBackoffice'>
	<table><tr><td width='80%'>". $txt ."</td>
    <td width='20%' align='right'>
            <table width='280' border='0' cellpadding='0' cellspacing='1' align='right'><tr><td  class='link'><div align='center'><a href='admin.asp'>Inicio</a></div></td><td width='100' class='link'><div align='center'><a href='javascript:history.back();'>Volver</a></div></td><td class='link'><div align='center'><a href='javascript:print()'>Imprimir</a></div></td></tr></table>
	</td>
</tr>
</table>
</td>
</tr>
</table>";
		break;

    case 1:
		echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' class='TableTDCabeceraBackoffice' align='center'><tr><td width='52%'>". $txt ."</td><td width='48%'><table width='260' border='0' align='right' cellpadding='0' cellspacing='1'><tr><td class='link'><div align='center'><a href='javascript:history.back();'>Volver</a></div></td></tr></table></td></tr></table>";
		break;

    case 0:
		echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' class='TableTDCabeceraBackoffice' align='center'><tr><td width='52%'>". $txt ."</td><td width='48%'><table width='180' border='0' cellpadding='0' cellspacing='1' align='right'><tr><td  class='link'><div align='center'><a href='home.php'>Inicio</a></div></td><td class='link'><div align='center'><a href='productos-consultar.php'>Volver</a></div></td></tr></table></td></tr></table>";
		break;

    case 4:
		echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' class='TableTDCabeceraBackoffice' align='center'><tr><td width='52%'><b>". $txt ."</b></td></tr></table>";
		break;
				
	}


}

function carrito()
{
  If ($_SESSION["registro"]){

    $registro=$_SESSION["registro"];
    $estado=$_SESSION["estado"];    

  
    $sql = mysql_query ("SELECT count(*) as total FROM presupuestos WHERE registro=$registro");

   If ($row = mysql_fetch_array($sql)) { 

   	if ($estado<2) {
	    echo "<A HREF='/carrito-checkout.php'>VER CARRITO PEDIDOS</A> | <img src='/images/icon-carrito.png'> ".$row["total"]." PRODUCTOS<br><br>";
	 }

  }
}
}

function labelusuario()
{
  If ($_SESSION["nombre"]) {
    echo "Usuario: ".$_SESSION["nombre"]."| <A HREF='/cuenta.php'>Estado de Cuenta</A>";
  }
}


function enviarMail($estado,$destino,$id_pedido,$observaciones,$estadoV, $idUsuarioMay)
{
	$id_pedido2= base64_encode ($id_pedido);
	$idUsuario= base64_encode ($idUsuarioMay);

	$texto="<html>
		<head>
		  <title>Pedidos On Line</title>
		  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		  </head>
		<body style='padding:0; margin:0'>
		   <table border='0' cellspacing='0' cellpadding='30' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center; background:#333333' width='100%' align='center'><tr><td align='center' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center; background:#333333' width='100%'>
		    <table border='0' cellspacing='0' cellpadding='0' align='center' style='width:590px; margin:0 auto; text-align:center' width='590'><tr><td>
		      <table border='0' cellspacing='0' cellpadding='0' style='width:100%' width='100%'>
		        <tr>
		          <td style='width:160px' width='160'><a href='http://www.sconsulting.com.ar' style='text-decoration:none'><img src='http://www.vivrenegocios.com.ar/images/logoPreview.png' alt='Vivre Negocios' style='display:block; border:0px'></a></td>
		          <td valign='bottom' style='text-align:right' align='right'><h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; margin:0; padding:0; font-size:15px; font-weight:400; color:#FFFFFF'>Hola ".$nombre."</h3></td>
		        </tr>
		      </table>  
		      <br><br><br>
		<h1 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:32px; line-height:40px; color:#ffffff; text-align:center' align='center'>Novedades! Tu pedido esta ".$estado.".</h1>
		<h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:14px; line-height:40px; color:#ffffff; text-align:center' align='center'>Pedido Nro. ".$id_pedido."</h3>";
		
		If ($estadoV==1) {
		
			$texto=$texto."<br><br><h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:14px; line-height:10px; color:#ffffff; text-align:left'>

				Tu pedido esta valorizado, pod&eacute;s accceder a realizar el pago con tu tarjeta de cr&eacute;.</h3>";
		}

		If ($estadoV==3) {
		
			$texto=$texto."<br><br><h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:14px; line-height:10px; color:#ffffff; text-align:left'>Su pedido fue despachado exitosamente, gracias por utilizar nuestra web. <br>Por favor confirmar la recepci&oacute;n de su mercaderia <br><br>Controle su pedido.</h3>";
		}
		
	    $texto=$texto."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
		      <tr>
		      <td style='color:#1d1e21; text-align:center' align='center'>

		        <table align='center' border='0' cellspacing='0' cellpadding='20'>
		          <tr><td width='162' height='40' style='height:40px; font-size:0px; line-height:0px'>&#160;</td></tr>
		          <tr>
		            <td align='center' style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:500; -webkit-border-radius:4px; -moz-border-radius:4px; border-radius:4px; background-color:#1EA858' bgcolor='#22be65'><strong><a href='http://www.vivrenegocios.com.ar/login2b.php?idUsuario=".$idUsuario."&id_pedido=".$id_pedido2."' style='text-decoration:none; font-size:14px; display:block; color:#ffffff'>Para acceder al pedido haga click aquí.</a></strong></td>
		          </tr>
		          <tr><td style='height:40px; font-size:0px; line-height:0px' height='40'>&#160;</td></tr>
		        </table>

		      </td>
		    </tr>
		</table>  </td></tr></table>  </td></tr></table>  <table border='0' cellspacing='0' cellpadding='50' align='center' style='width:100%; margin:0 auto; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center' width='100%'>
		  <tr>
		    <td>
		    	<table border='0' cellspacing='0' cellpadding='0' width='590' style='margin: 0 auto;'>
		    		<tr>
		    			<td>
		            <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; padding-top:0px; padding-right:0px; padding-bottom:0px; padding-left:0px; margin-top:0px; margin-right:0px; margin-bottom:0px; margin-left:0px; font-size:12px; color:#253139; line-height:16px'>

		            </p>
		            
		              </td>
		          <td width='45' valign='top'><img src='http://static.issuu.com/mail/gui/facebook-button-discreet.gif' alt='Facebook' style='display:block; border:0px'></td>
		          </tr>
		      </table>
		    </td>
		  </tr>
		</table>
		</body>
		</html>";



	$nombreEmpresa="VIVRE";

//	$destino=$email;
	require("class.phpmailer.php");
	$mail=new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth=true;
	$mail->Host="mail.vivrenegocios.com.ar";
	$mail->Username="info@vivrenegocios.com.ar"; // usuario correo remitente
	$mail->Password="Panama12"; // contraseña correo remitente
	$mail->Port=25;
	$mail->From="info@vivrenegocios.com.ar"; // correo remitente
	$mail->FromName="Vivre Negocios"; // nombre remitente
	$mail->AddAddress($destino); // destinatario
	$mail->IsHTML(true);
	$mail->Subject="PEDIDO NRO. ".$id_pedido;




		$mail->Body=$texto; // mensaje
		$enviar = $mail->Send(); // envia el correo

		if($enviar){echo "OK";}else{echo "ERROR";}
}
?>
