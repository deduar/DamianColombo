<?php session_start();?>
<? ob_start(); ?>
<?php include ("connect.php");?>
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<?
$email=$_POST['email'];

$random2=$_POST['random2'];
$pass=$_POST['pass'];


$flagPass=0;

If ($random2 == 1 and ($pass=="YIJ4" or $pass=="yij4")) { 
	$flagPass=1;
}
If ($random2 == 2 and ($pass == "B61C" or $pass == "b61c")) {
	$flagPass=1;
}
If ($random2 == 3 and ($pass == "DBBK" or $pass == "dbbk")) {
	$flagPass=1;
}
If ($random2 == 4 and ($pass == "DXWW" or $pass == "dxww")) {
	$flagPass=1;
}
If ($random2 == 5 and ($pass == "8JGW" or $pass == "8jgw")) {
	$flagPass=1;
}
If ($random2 == 6 and ($pass == "G89C" or $pass == "g89c")) {
	$flagPass=1;
}

$result = mysql_query("SELECT * FROM claves where email='$email'", $link);


If (($row = mysql_fetch_array($result)) and ($flagPass == 1)) { 

	$nombre=$row["nombre"];
	$password=$row["password"];

	$body="<style type='text/css'>
				body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }
			</style>
			<div style='font-family: Verdana,Arial,Helvetica,sans-serif; font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; line-height: 1.35em; font-size-adjust: none; font-stretch: normal;'>
				<table style='margin-top: 10px; font-family: Verdana,Arial,Helvetica,sans-serif; font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; line-height: 1.35em; font-size-adjust: none; font-stretch: normal; margin-bottom: 10px;' width='98%' border='0' cellpadding='0' cellspacing='0'>
					<tbody>
						<tr>
							<td valign='top' align='center'>
							
								<!-- [ header starts here] -->
								<table width='650' border='0' cellpadding='0' cellspacing='0'>
									<tbody>
										<tr>
											<td valign='top' align='left'>VIVRE ONLINE</td>
										</tr>
									</tbody>
								</table>
								
								<!-- [ middle starts here] -->
								<table width='650' border='0' cellpadding='0' cellspacing='0'>
									<tbody>
										<tr>
											<td valign='top' align='left'>
											  <p>
												  <strong>".$nombre."</strong>:<br />
											  </p>
												<table width='100%' border='0' cellpadding='0' cellspacing='0'>
													<thead>
														<tr>
															<th align='left' bgcolor='#d9e5ee' style='padding: 5px 9px 6px; line-height: 1em;'>Recuperaci&oacute;n de password.</th>
														</tr>
												  </thead>
													<tbody>
														<tr>
															 <td width='18%' valign='top' style='padding: 7px 9px 9px; background: #f8f7f5 none repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;'><p><br>Su password de acceso es: <b>".$password."</b><b><br>
															 Acceso Backend: <A HREF='http://www.vivreonline.com.ar/backoffice'>http://www.vivreonline.com.ar/backoffice</A>
															 
															 <br><br><b>Si tiene problemas para ingresar a su cuenta escribanos a: <A HREF='mailto:info@sconsulting.com.ar'>info@sconsulting.com.ar</A>. <br><br>
															 </td>
															 
														</tr>
														<tr>
															 <td width='18%' valign='top' style='padding: 7px 9px 9px; background: #f8f7f5 none repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;'>
							Remedios de Escalada de San Martin 630 - CABA<BR>
							info@vivreonline.com.ar<BR>
							(5411) 4582-5331 / 4582-7983<BR>
							Lunes a Viernes de 8:30 a 17:30<BR>
							Feriados Cerrado.<BR>
							www.facebook.com/vivrenegocios<BR>
													         </td>
															 
														</tr>															
													</tbody>
											  </table>
								<br />
								<br /></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>";


		$destino=$email;




		//////////// ENVIA EMAIL
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
		$mail->Subject="Recuperaci&oacute;n de password.";


		$mail->Body=$body; // mensaje
		$enviar = $mail->Send(); // envia el correo

		if($enviar){echo "OK";}else{echo "ERROR";}



	   header("Location: loginRecovery3.php");	

}Else{

	If ($flagPass == 1) {

	   header("Location: loginRecovery.php?flag=2");	

	} Else {

	   header("Location: loginRecovery.php?flag=1");	

	}

}
?>

</body>
</HTML>


