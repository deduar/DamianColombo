<?php session_start();?>
<? ob_start(); ?>
<?php include ("connect.php");?>


<?
$id_pedido=$_GET['id_pedido'];
$observaciones2=$_POST['observaciones'];

If ($id_pedido) {

	$fechaObs=date('d/m/Y');	
	
	$observaciones2=$fechaObs." | ".$observaciones2;

	

	$result = mysql_query("SELECT * FROM pedidos where id_pedido=$id_pedido");
	$row = mysql_fetch_array($result);
	$descuentoTotal=$row["descuentoTotal"];
	$fecha=$row["fecha"];
	$estado=$row["estado"];
	$estadoEnvio=$row["estadoEnvio"];
	$idUsuarioMay=$row["idUsuario"];
	$idEntrega=$row["idEntrega"];
	$idExpreso=$row["idExpreso"];

	$observaciones=$row["observaciones"]."<BR>".$observaciones2;

	$result2 = mysql_query("UPDATE pedidos SET observaciones='$observaciones', estadoPrecio='1' WHERE id_pedido=$id_pedido", $link);	
	
	If ($idEntrega){
		$resultB = mysql_query("SELECT * FROM entrega WHERE idEntrega=$idEntrega", $link);
		$rowB = mysql_fetch_array($resultB);
		$direccionEntrega=$rowB["direccion"];
		$localidadEntrega=$rowB["localidad"];
		$provinciaEntrega=$rowB["provincia"];	
		$cpEntrega=$rowB["cp"]; 
	}
	If ($idExpreso){
		$resultE = mysql_query("SELECT * FROM expreso WHERE idExpreso=$idExpreso", $link);
		$rowE = mysql_fetch_array($resultE);
		$direccionExpreso=$rowE["direccion"];
		$localidadExpreso=$rowE["localidad"];
		$provinciaExpreso=$rowE["provincia"];	
		$cpExpreso=$rowE["cp"]; 
		$nombreExpreso=$rowE["nombreExpreso"]; 
		$codTelefonoExpreso=$rowE["codTelefono"]; 
		$telefonoExpreso=$rowE["telefono"]; 
	}



	$fecha=date('Y/m/d');	

	$result = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
	$row2 = mysql_fetch_array($result);

	$nombre=$row2["nombre"]; 
	$estado=$row2["estado"]; 				
	$razon=$row2["razon"]; 
	$nombreFantasia=$row2["nombreFantasia"]; 	
	$telefono=$row2["telefono"];
	$email=$row2["email"];

	

	//$result = mysql_query("UPDATE presupuestos SET pedido=1 WHERE id_pedido=$id_pedido", $link);

	
	//$texto="<html><head><title>VIVRE</title><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'></head><body bgcolor=#FFFFFF text=#000000>NRO. PEDIDO: ".$id_pedido."00<br><br>Nombre: ".$requirednombre."<br>Raz&oacute;n Social: " .$razon."<br>CUT: ".$cuit."<br>Tel&eacute;fono: ".$telefono."<br>E-mail: ".$requiredemail."<br>Observaciones: ".$mensaje."<br><br>";
	
	$id_pedido2= base64_encode($id_pedido);
	$idUsuarioMay= base64_encode($idUsuarioMay);

	$texto="<html>
		<head>
		  <title>Pedidos On Line</title>
		  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		  </head>
		<body style='padding:0; margin:0'>
		   	<table border='0' cellspacing='0' cellpadding='30' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center; background:#f5f5f5' width='100%' align='center'>
		   		<tr>
		   			<td align='center' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center; background:#f5f5f5' width='100%'>

				   		<table border='0' cellspacing='0' cellpadding='0' align='center' style='width:590px; margin:0 auto; text-align:center' width='590'>
				   			<tr>
				   				<td>
						      		<table border='0' cellspacing='0' cellpadding='0' style='width:100%' width='100%'>
						        		<tr>
						          			<td style='width:160px' width='160'><a href='http://www.sconsulting.com.ar' style='text-decoration:none'><img src='http://www.vivrenegocios.com.ar/images/logo-small.png' alt='Vivre Negocios' style='display:block; border:0px'></a></td>
						          			<td valign='bottom' style='text-align:right' align='right'><h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; margin:0; padding:0; font-size:15px; font-weight:400; color:#000'>Hola, ".$nombre."</h3></td>
						        		</tr>
						      		</table>";



						      		$texto=$texto."<br><br><br>
						  			<h1 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:32px; line-height:40px; color:#000; text-align:center' align='center'>Tu pedido fue cotizado.</h1>
						  			<h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:14px; line-height:40px; color:#000; text-align:center' align='center'>Pedido Nro. ".$id_pedido."</h3>";


// TABLA PRESUPUESTO INICIO
									$texto=$texto."<table>
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Descripción</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Desc.</th>
                                                <th>Total Prod.</th>

                                            </tr>

                                        </thead>

                                        <tbody>";
                                                $totalPrecio=0;

                                                $result = mysql_query("SELECT * FROM det_pedidos INNER JOIN productmain ON det_pedidos.id = productmain.idProductMain  WHERE det_pedidos.id_pedido=$id_pedido ORDER BY productmain.codigo");
                                              $cont=1;
                                              $total=0;
                                              while ($row = mysql_fetch_array($result)) { 
                                              
                                                            $codigo=$row['codigo'];
                                                              $cantidad=$row['cantidad'];
                                                              $fecha=$row['fecha'];
                                                              $descuento=$row['descuento'];
                                                              $estado=$row['estado'];
                                                              $precio=$row['precio'];
                                                              $subtotal=$cantidad*$precio;
                                                              If ($descuento>0){

                                                                $descuento2=($subtotal*$descuento)/100;
                                                                $subtotal=$subtotal-$descuento2;

                                                              }
                                                                $id_detpedido=$row['id_detpedido'];     
                                                                $descripcion=$row2['descripcion'];

                                                                $total=$total+$subtotal;

                                                                $totalProd2=$totalProd2+$subtotal;                                                                                                          
                                              
                                              
                                             
                                                $texto=$texto."<tr'>


                                                    <td>".$codigo."</td>
                                                    <td>".$descripcion."</td>
                                                    <td>".$cantidad."</td>
                                                    <td>$ ".money_format('%(#10n', $precio)."</td>
                                                    <td>$ ".$descuento." %</td>

                                                    <td>$ ".money_format('%(#10n', $subtotal)."</td>           
                                                </tr>";
                                            $cont++;
                                            } 
                                            
                                            $subTotalPedido=$totalProd2;

                                            $descuentoTotal2=($totalProd2*$descuentoTotal)/100;
                                            $totalProd2=$totalProd2-$descuentoTotal2;
                                            $iva=($totalProd2*21)/100;
                                            $total=$totalProd2+$iva;

                                            $texto=$texto."<tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>DESCUENTO S/TOTAL %</td>
                                            <td></td>              
                                            <td>".$descuentoTotal." %</td>       
                                            <td></td>    
                                        </tr>
                                         <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>SUB-TOTAL</td>
                                            <td></td>              
                                            <td>$ ".money_format('%(#10n', $subTotalPedido)."</td>       
                                            <td></td>    
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>DESCUENTO S/TOTAL</td>
                                            <td></td>              
                                            <td>- ($ ".money_format('%(#10n', $descuentoTotal2).")</td>       
                                            <td></td>    
                                        </tr>                                        
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>IVA</td>
                                            <td></td>              
                                            <td>$ ".money_format('%(#10n', $iva)."</td>           
                                            <td></td>
                                        </tr>             
                                        <tr>

                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>TOTAL</td>
                                            <td></td>              
                                            <td><strong>$ ".money_format('%(#10n', $total)."</strong></td>           
                                            <td></td>
                                        </tr>                                                                                             
                                        </tbody>

                                    </table>"; 

                                    // TABLA PRESUPUESTO FIN


						    		$texto=$texto."
						    		<table width='100%' border='0' cellspacing='0' cellpadding='0'>
									    <tr>
										      <td style='color:#1d1e21; text-align:center' align='center'>

										        <table align='center' border='0' cellspacing='0' cellpadding='20'>
										          <tr><td width='162' height='40' style='height:40px; font-size:0px; line-height:0px'>&#160;</td></tr>
										          <tr>
										            <td align='center' style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:500; -webkit-border-radius:4px; -moz-border-radius:4px; border-radius:4px; background-color:#1EA858' bgcolor='#22be65'><strong><a href='http://www.vivrenegocios.com.ar/login2-validacion.php?idUsuario=".$idUsuarioMay."&id_pedido=".$id_pedido2."' style='text-decoration:none; font-size:14px; display:block; color:#ffffff'>Para acceder al pedido hacé click aquí.</a></strong></td>
										          </tr>
										          <tr><td style='height:40px; font-size:0px; line-height:0px' height='40'>&#160;</td></tr>
										        </table>

										      </td>
									    </tr>
									</table>  
								</td>
							</tr>
						</table>  
					</td>
				</tr>
			</table>  
			<table border='0' cellspacing='0' cellpadding='50' align='center' style='width:100%; margin:0 auto; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center' width='100%'>
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

		echo $texto;


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
	$mail->FromName = "Vivre Negocios";
	$mail->AddAddress($destino); // destinatario
	$mail->IsHTML(true);
	$mail->Subject=$nombre." tu pedido fue cotizado.";





		$mail->Body=$texto; // mensaje
		$enviar = $mail->Send(); // envia el correo

		if($enviar){
			echo "OK";
			$result = mysql_query("UPDATE pedidos SET estadoEnvio=1, estado=1 WHERE id_pedido=$id_pedido", $link);
			
			header("Location: pedido-detalle-enviar.php?id_pedido=$id_pedido&flag=1");
					
					
		}else{
			echo "ERROR";
			header("Location: pedido-detalle-enviar.php?id_pedido=$id_pedido&flag=2");
		}




	}



?>
