<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?


$idUsuarioMay=$_POST["idUsuarioMay"];
$flag=$_POST["flag"];

$fecha=date('Y/m/d'); 

$estado=$_POST["estado"];
$estadoAux=$_POST["estadoAux"];
$razon=$_POST['razon']; 
$nombreFantasia=$_POST['nombreFantasia']; 
$codTelefono=$_POST['codTelefono']; 
$codCelular=$_POST['codCelular']; 
$password=$_POST["password"]; 
$direccion=$_POST['direccion']; 
$localidad=$_POST['localidad']; 
$telefono=$_POST['telefono']; 
$email=$_POST['email']; 
$cuit=$_POST['cuit']; 
$nombre=$_POST['nombre'];
$provincia=$_POST['provincia'];
$celular=$_POST['celular'];
$website=$_POST['website'];


	If ($flag=="Ingresar" and $estado==1) {

		$result = mysql_query("INSERT INTO usuarioMay (fecha, fechaAlta, nombre, email, razon, nombreFantasia, password, direccion, localidad, provincia, codTelefono, telefono, codCelular, celular, cuit, website) VALUES ('$fecha', '$fecha', '$nombre', '$email',  '$razon', '$nombreFantasia', '$password', '$direccion', '$localidad', '$provincia', '$codTelefono', '$telefono', '$codCelular', '$celular', '$cuit', '$website')");
	}

  If ($flag=="Ingresar" and $estado==0) {

    $result = mysql_query("INSERT INTO usuarioMay (fecha, nombre, email, razon, nombreFantasia, password, direccion, localidad, provincia, codTelefono, telefono, codCelular, celular, cuit, website) VALUES ('$fecha', '$nombre', '$email',  '$razon', '$nombreFantasia', '$password', '$direccion', '$localidad', '$provincia', '$codTelefono', '$telefono', '$codCelular', '$celular', '$cuit', '$website')");
  }  




	If ($flag=="Modificar") {

      	If ($estadoAux==0 AND  $estado==1) {

            If ($fechaAlta=="0000-00-00"){

                $result = mysql_query("UPDATE usuarioMay SET nombre='$nombre', nombreFantasia='$nombreFantasia', razon='$razon', password='$password', email='$email', codTelefono='$codTelefono', codCelular='$codCelular', direccion='$direccion', localidad='$localidad', provincia='$provincia', telefono='$telefono', celular='$celular', cuit='$cuit', website='$website', estado=$estado where idUsuarioMay=$idUsuarioMay");

                echo "UPDATE usuarioMay SET nombre='$nombre', nombreFantasia='$nombreFantasia', razon='$razon', password='$password', email='$email', codTelefono='$codTelefono', codCelular='$codCelular', direccion='$direccion', localidad='$localidad', provincia='$provincia', telefono='$telefono', celular='$celular', cuit='$cuit', website='$website', estado=$estado where idUsuarioMay=$idUsuarioMay"; 



            }else{

                $result = mysql_query("UPDATE usuarioMay SET nombre='$nombre', fechaAlta='$fecha', nombreFantasia='$nombreFantasia', razon='$razon', password='$password', email='$email', codTelefono='$codTelefono', codCelular='$codCelular', direccion='$direccion', localidad='$localidad', provincia='$provincia', telefono='$telefono', celular='$celular', cuit='$cuit', website='$website', estado=$estado where idUsuarioMay=$idUsuarioMay");

                echo "UPDATE usuarioMay SET nombre='$nombre', fechaAlta='$fecha', nombreFantasia='$nombreFantasia', razon='$razon', password='$password', email='$email', codTelefono='$codTelefono', codCelular='$codCelular', direccion='$direccion', localidad='$localidad', provincia='$provincia', telefono='$telefono', celular='$celular', cuit='$cuit', website='$website', estado=$estado where idUsuarioMay=$idUsuarioMay";


            }




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
                            <td style='width:160px' width='160'><a href='http://www.sconsulting.com.ar' style='text-decoration:none'><img src='http://www.vivrenegocios.com.ar/img/freeze/logoPreview.png' alt='Vivre Negocios' style='display:block; border:0px'></a></td>
                            <td valign='bottom' style='text-align:right' align='right'><h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; margin:0; padding:0; font-size:15px; font-weight:400; color:#FFFFFF'>Hola ".$nombre."</h3></td>
                          </tr>
                        </table>  
                        <br><br><br>
                  <h1 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:32px; line-height:40px; color:#ffffff; text-align:left' align='left'>Novedades! Tus datos de acceso son:</h1>

                    <h1 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:15px; line-height:20px; color:#ffffff; text-align:left' align='center'>      <br>
                    <strong>Email: <a href='$email' style='text-decoration:none; font-size:15px; display:block; color:#ffffff'>".$email."</a><br>
                  Password: ".$password."</strong></h1>


                  <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                        <td style='color:#1d1e21; text-align:center' align='center'>

                          <table align='center' border='0' cellspacing='0' cellpadding='20'>
                            <tr><td width='162' height='40' style='height:40px; font-size:0px; line-height:0px'>&#160;</td></tr>
                            <tr>
                              <td align='center' style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:500; -webkit-border-radius:4px; -moz-border-radius:4px; border-radius:4px; background-color:#1EA858' bgcolor='#22be65'><strong><a href='http://www.vivrenegocios.com.ar/login.php' style='text-decoration:none; font-size:14px; display:block; color:#ffffff'>Para acceder hacé click aquí.</a></strong></td>
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
                            San Blas 1948 - CABA<BR>
                            info@vivreonline.com.ar<BR>
                            (5411) 4582-5331 / 4582-7983<BR>
                            Lunes a Viernes de 8:30 a 17:30<BR>
                            Feriados Cerrado.<BR>
                            www.facebook.com/vivrenegocios<BR>
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


              			
              			$destino=$email;

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
              	$mail->Subject="Datos de acceso a su cuenta";


              		$mail->Body=$texto; // mensaje
              		$enviar = $mail->Send(); // envia el correo

              		if($enviar){echo "OK";}else{echo "ERROR";}
       

        }else{

            $result = mysql_query("UPDATE usuarioMay SET nombre='$nombre', nombreFantasia='$nombreFantasia', razon='$razon', password='$password', email='$email', codTelefono='$codTelefono', codCelular='$codCelular', direccion='$direccion', localidad='$localidad', provincia='$provincia', telefono='$telefono', celular='$celular', cuit='$cuit', website='$website', estado=$estado where idUsuarioMay=$idUsuarioMay");

            
        }  



	}

header("Location: usuarios.php");

?>
