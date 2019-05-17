<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?
$tipo=$_GET['tipo'];
$id_pedido=$_GET['id_pedido'];
$flag=$_GET['flag'];

$result = mysql_query("SELECT * FROM pedidos where id_pedido=$id_pedido");
$row = mysql_fetch_array($result);
$fecha=$row["fecha"];
$descuentoTotal=$row["descuentoTotal"];
$estado=$row["estado"];
$estadoEnvio=$row["estadoEnvio"];
$idUsuarioMay=$row["idUsuario"];
$idEntrega=$row["idEntrega"];
$idExpreso=$row["idExpreso"];
$observaciones=$row["observaciones"];
$cliente=$row["cliente"];

$result2 = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
$row2 = mysql_fetch_array($result2);
$razon=$row2["razon"];
$nombreFantasia=$row2["nombreFantasia"];    
$nombre=$row2["nombre"];
$email=$row2["email"];
$telefono=$row2["telefono"];                
$codTelefono=$row2["codTelefono"];      




If ($tipo==1) {
    $estado=$_POST['estado'];
    $result = mysql_query("UPDATE pedidos SET estado='$estado' WHERE id_pedido=$id_pedido", $link);
    
    /*switch ($estado) {
        
            case 0:
                $estadoD="PENDIENTE DE AUTORIZACION";
                enviarMail($estadoD, $email, $id_pedido,$estado);
                break;
            case 1:
                $estadoD="APROBADO";
                enviarMail($estadoD, $email, $id_pedido,$estado);       
                break;                      
            case 2:
                $estadoD="ENTREGADO";
                enviarMail($estadoD, $email, $id_pedido,$estado);
                break;

            case 3:
                $estadoD="RECHAZADO";
                enviarMail($estadoD, $email, $id_pedido,$estado);
                break;

            }
*/
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

   <title>Backoffice</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">


    <script src="js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
    
    <div class="col-md-12 col-sm-12 col-xs-12">

        <a href='javascript:window.print(); void 0;' class="btn btn-primary">Imprimir</a>
        <a href="javascript:history.back(1)" class="btn btn-primary">Volver</a>

        <div class="well profile_view">
            <div class="col-md-4">
                <h2><b>VIVRE NEGOCIOS</b></h2>
                <h4><b>Pedido: <? echo $id_pedido; ?></b></h4>
                <h4>Fecha: <? echo cambiaf_a_normal($fecha); ?></h4>
            
            </div>
            <div class="col-md-4">

                <h4 class="brief">Razón Social: <? echo strtoupper ($razon); ?></h4>
                <h4>Nombre: <? echo strtoupper ($nombre); ?></h4>
                <p>Nombre Fantasía: <b><? echo strtoupper ($nombreFantasia); ?></b></p>
                <ul class="list-unstyled">
                    <li><i class="fa fa-phone"></i> (<? echo $codTelefono; ?>) <? echo $telefono; ?></li>
                    <li><i class="fa fa-phone"></i> <? echo $email; ?></li>

                </ul>
            </div>
            <div class="col-md-4">
                
                  <? If ($cliente) { ?><hr>
                    <p><b>Pedido del cliente: <? echo $cliente; ?></b></p> 
                    <hr> 
                  <? } ?>
                  <? If ($idEntrega) { ?>
                    <b>Domicilio de Entrega:</b> <? datosEntrega($idEntrega); ?><br>
                  <? } ?>

                  <? If ($idExpreso != 0) { ?>
                    <b>Expreso:</b> <? datosExpreso($idExpreso); ?><br>  
                    <hr>
                  <? } ?>
                  <? If ($observaciones) { ?>                  
                    <p><b>Observaciones:</b> <? echo $observaciones; ?></p>
                  <? } ?>

            </div>
        </div>


        <table border="1">
            <thead>
                <tr class="headings">
                    <th class="column-title">Código</th>
                    <th class="column-title">Descripción</th>
                    <th class="column-title">Cantidad</th>
                    <th class="column-title">Precio</th>
                    <th class="column-title">Desc.</th>
                    <th class="column-title no-link last"><span class="nobr">Total Prod.</span></th>
                </tr>

            </thead>

            <tbody>
                  <?$totalPrecio=0;

                    $result = mysql_query("SELECT * FROM det_pedidos INNER JOIN productmain ON det_pedidos.id = productmain.idProductMain  WHERE det_pedidos.id_pedido=$id_pedido ORDER BY productmain.codigo");
                  $cont=1;
                  while ($row = mysql_fetch_array($result)) { 
                  
                      $codigo=$row["codigo"];
                      $cantidad=$row["cantidad"];                               
                      $fecha=$row["fecha"];  
                      $descuento=$row["descuento"];             
                      $estado=$row["estado"];     
                      $precio=$row["precio"];     
                      $subtotal=$cantidad*$precio;
                      If ($descuento>0){

                        $descuento2=($subtotal*$descuento)/100;
                        $subtotal=$subtotal-$descuento2;

                      }
                      $id_detpedido=$row["id_detpedido"];     
                      $descripcion=$row2["descripcion"];

                      
                    $total=$total+$subtotal; 
                    $totalProd2=$totalProd2+$subtotal;

                    if ($cont%2==0) { 
                        $est="TrBackoffice"; 
                    } else { 
                        $est="TrBackofficeB"; 
                    } 
                  ?>
                    <tr class="even pointer">
                        <td style="padding: 2px;"><? echo $row["codigo"]; ?></td>
                        <td style="padding: 2px;"><? echo substr($row["descripcion"], 0, 40); ?></td>
                        <td style="padding: 2px;"><? echo $row["cantidad"]; ?></td>
                        <td style="padding: 2px;">$ <? echo money_format('%(#10n', $precio);?></td>              
                        <td style="padding: 2px;"><? echo $descuento ;?> %</td>
                        <td  style="padding: 2px;">$ <? echo money_format('%(#10n', $subtotal);?></td>           
                    </tr>
                <? 
                 
                $cont++;
                } 
                
                $subTotalPedido=$totalProd2;
                $descuentoTotal2=($totalProd2*$descuentoTotal)/100;
                $totalProd2=$totalProd2-$descuentoTotal2;
                $iva=($totalProd2*21)/100;
                $total=$totalProd2+$iva;
                ?>
                <tr class="even pointer">
                        <td class=" "></td>
                        <td class=" "></td>
                        <td class=" "></td>
                        <td class=" ">DESCUENTO S/TOTAL %</td>
                        <td class=" "></td>              
                        <td class=" "><? echo $descuentoTotal; ?></td>           
                    </tr>


                    <tr class="even pointer">
                        <td class=" "></td>
                        <td class=" "></td>
                        <td class=" "></td>
                        <td class=" ">SUB-TOTAL</td>
                        <td class=" "></td>              
                        <td class=" ">$ <? echo money_format('%(#10n', $subTotalPedido);?></td>           
                    </tr>
                    <tr class="even pointer">
                        <td class=" "></td>
                        <td class=" "></td>
                        <td class=" "></td>
                        <td class=" ">DESCUENTO S/TOTAL</td>
                        <td class=" "></td>              
                        <td class=" ">- ($ <? echo money_format('%(#10n', $descuentoTotal2);?>)</td>           
                    </tr>  
                    <tr class="even pointer">
                        <td class=" "></td>
                        <td class=" "></td>
                        <td class=" "></td>
                        <td class=" ">IVA</td>
                        <td class=" "></td>              
                        <td class=" ">$ <? echo money_format('%(#10n', $iva);?></td>           
                    </tr>             
                    <tr class="even pointer">
                        <td class=" "></td>
                        <td class=" "></td>
                        <td class=" "></td>
                        <td class=" ">TOTAL</td>
                        <td class=" "></td>              
                        <td class=" "><strong>$ <? echo money_format('%(#10n', $total);?></strong></td>           
                    </tr>                                                                                            
            </tbody>

        </table>   


    </div>

</body>

</html>