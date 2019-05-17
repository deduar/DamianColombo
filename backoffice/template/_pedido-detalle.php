<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?
$tipo=$_GET['tipo'];
$id_pedido=$_GET['id_pedido'];
$flagAgregar=$_GET['flagAgregar'];


$result = mysql_query("SELECT * FROM `pedidos` where id_pedido=$id_pedido");
$row = mysql_fetch_array($result);
$fecha=$row["fecha"];
$estado=$row["estado"];
$estadoEnvio=$row["estadoEnvio"];
$idUsuarioMay=$row["idUsuario"];
$estadoPrecio=$row["estadoPrecio"];
$observacionesVer=$row["observaciones"];

$idEntrega=$row["idEntrega"];
$idExpreso=$row["idExpreso"];
$cliente=$row["cliente"];

echo $idExpreso;

$result2 = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
$row2 = mysql_fetch_array($result2);
$razon=$row2["razon"];
$nombreFantasia=$row2["nombreFantasia"];    
$nombre=$row2["nombre"];
$email=$row2["email"];
$telefono=$row2["telefono"];       
$codTelefono=$row2["codTelefono"];          


If ($tipo==1) {
  $result = mysql_query("SELECT * FROM pedidos WHERE id_pedido=$id_pedido", $link);
  $row = mysql_fetch_array($result);
  $observaciones2=$row["observaciones"];
    
  $estado=$_POST['estado'];

    
  $observaciones=$_POST['observaciones'];   
  $fechaObs=date('d/m/Y'); 

  $observaciones=$observaciones2."<br>".$fechaObs." | ".$observaciones;
    
  $result = mysql_query("UPDATE pedidos SET estado='$estado', observaciones='$observaciones' WHERE id_pedido=$id_pedido", $link);
    
     switch ($estado) {
            case 2:
                $estadoD="EN PROCESO";
                enviarMail($estadoD, $email, $id_pedido, $observaciones,$estado, $idUsuarioMay);
                break;
            case 3:
                $estadoD="DESPACHADO";
                enviarMail($estadoD, $email, $id_pedido, $observaciones,$estado, $idUsuarioMay);        
                break;                      
            case 4:
                $estadoD="ENTREGADO";
                enviarMail($estadoD, $email, $id_pedido, $observaciones,$estado, $idUsuarioMay);
                break;

            case 5:
                $estadoD="RECHAZADO";
                enviarMail($estadoD, $email, $id_pedido, $observaciones,$estado, $idUsuarioMay);
                break;
            }
  
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

<script language="JavaScript" type="text/JavaScript">

<!--
function MM_openBrWindow(theURL,winName,features)) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <?php include ("inc-menu.php");?>
            </div>

           <!-- Top Nav -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/img.jpg" alt="">
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    
                                    <li>
                                        <a href="mailto:soporte@sconsulting.com.ar">Ayuda</a>
                                    </li>
                                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>


                        </ul>
                    </nav>
                </div>

            </div>
            <!-- top -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Pedido</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <?php include ("inc-buscar-producto.php");?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php if ($flagAgregar==2) { ?>
                                  <div id="signalert2" class="alert alert-warning">
                                        <p>Error, no se agrego el producto por falta de precio, intente nuevamente.</p>
                                  </div>
                            <?php } ?>
                            <?php if ($flagAgregar==1) { ?>
                                  <div id="signalert2" class="alert alert-success">
                                        <p>Se agrego correctamente el producto.</p>
                                  </div>
                            <?php } ?>                            

                            <div class="x_panel" >
                                <h1 class="page-header">Pedido <? echo $id_pedido; ?></h1>
<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!-- BEGIN CONTENIDO ////////////////////////////////////////////////////// -->                                
<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!--/////////////////////////////////////////////////////////////////////// -->  
                                <div class="col-md-4 col-sm-4 col-xs-12">


                                            <div class="well profile_view">
                                                <div class="col-sm-12">
                                                    <h4 class="brief"><i><? echo $razon; ?></i></h4>
                                                    <div class="left col-xs-7">
                                                        <h2><? echo $nombre; ?></h2>
                                                        <p><? echo $nombreFantasia; ?></p>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-phone"></i>(<? echo $codTelefono; ?>) <? echo $telefono; ?></li>
                                                            <li><i class="fa fa-phone"></i><? echo $email; ?></li>

                                                        </ul>
                                                    </div>
                                                    <div class="right col-xs-5 text-center">
                                                        <img src="images/img.jpg" alt="" class="img-circle img-responsive">
                                                    </div>
                                                </div>
                                               
                                            </div>

                                            <? //If ($estadoEnvio == 0) { ?>
<!--
                                                No se envio la cotizaci&oacute;n<br>
                                                 <a href="pedido-detalle-enviar.php?id_pedido=<? //echo $id_pedido; ?>" class="btn btn-primary">Enviar Cotización</a>
-->
                                            <?// }else{ ?>
                                            <!--

                                                Ya se envio la cotizaci&oacute;n<br>
                                                <a href="pedido-detalle-enviar.php?id_pedido=<? //echo $id_pedido; ?>" class="btn btn-primary">Re-enviar Cotización</a>
--> 
                                            <? //} ?>                                

                                            <br><br>
            
                                            <a href="pedido-imprimir2.php?id_pedido=<? echo $id_pedido; ?>" class="btn btn-primary">Imprimir</a>
<br><br>


                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <form name=calform method="post" action="pedido-detalle.php?id_pedido=<? echo $id_pedido; ?>&tipo=1" onSubmit="return checkrequired(this)">
                                       <!-- <input name="estado" class="flat" type="radio" disabled id="radio" value="0"  <? If ($estado==0){?>checked="checked" <? } ?>/>
                                        PENDIENTE VALORIZACION
                                        <input name="estado" class="flat" type="radio" disabled id="radio5" value="1"  <? If ($estado==1){?>checked="checked" <? } ?>/>
                                        PENDIENTE DE AUTORIZACION CLIENTE-->
                                        <input name="estado" class="flat" type="radio" id="radio2" value="2"  <? If ($estado==2){?>checked="checked" <? } ?>/>
                                        EN PROCESO
                                        <input type="radio" class="flat" name="estado" id="radio3" value="3" <? If ($estado==3){?> checked="checked" <? } ?>/>
                                        DESPACHADO
                                        <input type="radio" class="flat" name="estado" id="radio4" value="4" <? If ($estado==4){?> checked="checked" <? } ?>/>
                                        ENTREGADO
                                        <input type="radio" class="flat" name="estado" id="radio4" value="5" <? If ($estado==5){?> checked="checked" <? } ?>/>
                                        RECHAZADO  
                                        <br><br>
                                        <textarea class="form-control" rows="3" name="observaciones" placeholder="Observaciones..."></textarea><br>
                                        <button type="submit" class="btn btn-success">Actualizar Estado</button>
                                    </form>
                                        <hr>
                                          <? If ($cliente) { ?>
                                            <p><b>Pedido del cliente: <? echo $cliente; ?></b></p>  
                                          <? } ?>
                                        <hr>
                                         <p><b>Observaciones:</b> <? echo $observacionesVer; ?></p>
                                         <hr>
                                         <b>Domicilio de Entrega:</b> <? datosEntrega($idEntrega); ?><br>

                                          <? If ($idExpreso != 0) { ?>
                                            <b>Expreso:</b> <? datosExpreso($idExpreso); ?><br>  
                                          <? } ?>
                                        <hr>                                    
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <form id="form2" name="form2" method="post" action="pedido-modificar.php">
                                    <input type="hidden" name="id_pedido" value="<? echo $id_pedido; ?>">
                                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th width="1%" class="column-title">Imagen</th>
                                                <th width="10%" class="column-title">Código</th>
                                                <th width="25%" class="column-title">Descripción</th>
                                                <th width="12%" class="column-title">Cantidad</th>
                                                <th width="12%" class="column-title">Precio Unitario</th>
                                                <th width="12%" class="column-title">Desc.</th>
                                                <th width="12%" class="column-title">Sub Total</th>
                                                <th width="16%" class="column-title no-link last"><span class="nobr">Acción</span></th>
                                            </tr>

                                        </thead>

                                        <tbody>

                                              <? 

                                                $cont=1;
                                                $result = mysql_query("SELECT * FROM det_pedidos INNER JOIN productmain ON det_pedidos.id = productmain.idProductMain  WHERE det_pedidos.id_pedido=$id_pedido ORDER BY productmain.codigo");

                                                $total=0;
                                                

                                                while ($row = mysql_fetch_array($result)) { 

                                                              $codigo=$row["codigo"];
                                                              $cantidad=$row["cantidad"];                                                         
                                                              $fecha=$row["fecha"];                           
                                                              $estado=$row["estado"];
                                                              $precio=$row["precio"];  
                                                              $subtotal=$cantidad*$precio;
                                                              
                                                                $id_detpedido=$row["id_detpedido"];     
                                                                $descripcion=$row2["descripcion"];

                                                                $total=$total+$subtotal;
                                          
                                                             ?>
                                                             <input type="hidden" name="id_detpedido<? echo $cont; ?>" value="<? echo $id_detpedido; ?>">
                                                            <tr class="even pointer">
                                                                <td class=" " with="2%"><IMG SRC='../catalogo/<? echo trim ($codigo);?>.jpg' class='img-responsive' border='0'></td>      
                                                                <td class=" "><? echo $row["codigo"]; ?></td>
                                                                <td class=" "><? echo $row["descripcion"]; ?></td>
                                                                <td class=" last">
                                                                    <input name="cantidad<? echo $cont; ?>" type="text" id="cantidad" value="<? echo $cantidad; ?>" size="5" maxlength="5" onkeyUp='return ValNumero(this);'>
                                                                </td>
                                                                <td class=" ">
                                                                    $<input name="precio<? echo $cont; ?>" type="text" id="precio" value="<? echo $precio; ?>" size="5" maxlength="12">
                                                                </td>
                                                                <td class=" last">
                                                                    <input name="desc<? echo $cont; ?>" type="text" value="<? echo $desc; ?>" size="2" maxlength="2" onkeyUp='return ValNumero(this);'> <b>%</b>
                                                                </td>                                                                
                                                                <td class=" ">
                                                                    $ <? echo money_format('%(#10n', $subtotal);?>
                                                                </td>                                                    
                                                                <td class=" ">
                                                                    <a href='_pedido-eliminar.php?id_detpedido=<? echo $id_detpedido; ?>&id_pedido=<? echo $id_pedido; ?>'>Eliminar</a>
                                                                </td>
                                                            </tr>
                                                       
                                             <?
                                             $totalProd2=$totalProd2+$subtotal;
                                             $cont=$cont+1;
                                         }
                                        $iva=($totalProd2*21)/100;
                                        $total=$totalProd2+$iva;
                                        ?>
                                        <tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" ">DESCUENTO S/TOTAL</td>
                                            <td class=" "></td>              
                                            <td class=" "><input name="descTotal" type="text" value="<? echo $descTotal; ?>" size="2" maxlength="2" onkeyUp='return ValNumero(this);'> <b>%</b></td>       
                                            <td></td>    
                                        </tr>

                                         <tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" ">SUB-TOTAL</td>
                                            <td class=" "></td>              
                                            <td class=" ">$ <? echo money_format('%(#10n', $totalProd2);?></td>       
                                            <td></td>    
                                        </tr>
                                        <tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" ">IVA</td>
                                            <td class=" "></td>              
                                            <td class=" ">$ <? echo money_format('%(#10n', $iva);?></td>           
                                            <td></td>
                                        </tr>             
                                        <tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" ">TOTAL</td>
                                            <td class=" "></td>              
                                            <td class=" "><strong>$ <? echo money_format('%(#10n', $total);?></strong></td>           
                                            <td></td>
                                        </tr>                                                                                  

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><a href="pedidos-agregar.php?id_pedido=<? echo $id_pedido; ?>" class="btn btn-primary">Agregar Producto</a></td>
                                                <td></td>
                                                <td></td>
                                                <td></td><td></td>
                                                <td></td>
                                                <input type="hidden" name="cont" value="<? echo $cont; ?>"> 
                                                <td><button type="submit" class="btn btn-success">Actualizar</button></td>
                                            </tr>
                                        </tfoot>
                                    </table>  
                                    </form>                                  
                                </div>                                

<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!-- END CONTENIDO ////////////////////////////////////////////////////// -->                                
<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!--/////////////////////////////////////////////////////////////////////// -->   
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right">Implementó | SConsulting.com.ar</p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>

    <script src="js/custom.js"></script>

    <!-- moris js -->
    <script src="js/moris/raphael-min.js"></script>
    <script src="js/moris/morris.js"></script>
    <script src="js/moris/example.js"></script>
    <script src="js/JAVA.JS"></script>

</body>

</html>