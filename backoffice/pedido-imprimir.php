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
$estado=$row["estado"];
$estadoEnvio=$row["estadoEnvio"];
$idUsuarioMay=$row["idUsuario"];

$result2 = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
$row2 = mysql_fetch_array($result2);
$razon=$row2["razon"];
$nombreFantasia=$row2["nombreFantasia"];    
$nombre=$row2["nombre"];
$email=$row2["email"];
$telefono=$row2["telefono"];                




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

<script language="JavaScript" type="text/JavaScript">

<!--
function MM_openBrWindow(theURL,winName,features)) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body >

    <div class="container body">


        <div class="main_container">


            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>


                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

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
                            <div class="x_panel" >
                                <h1 class="page-header">Pedido <? echo $id_pedido; ?></h1>
                                <? If ($flag==1) { ?>
                                    <div id="signalert2" style="display:show; margin-top:0px;" class="alert alert-success">
                                        Se envio el pedido valorizado.
                                    </div>    
                                    <? } ?>
                                <? If ($flag==2) { ?>
                                    <div id="signalert2" style="display:show; margin-top:0px;" class="alert alert-warning">
                                        Error no se envio el pedido valorizado, intente nuevamente.
                                    </div> 
                                <? } ?>                                   
                                <br><br>

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
                                                            <li><i class="fa fa-phone"></i><? echo $telefono; ?></li>
                                                            <li><i class="fa fa-phone"></i><? echo $email; ?></li>

                                                        </ul>
                                                    </div>
                                                    <div class="right col-xs-5 text-center">
                                                        <img src="images/img.jpg" alt="" class="img-circle img-responsive">
                                                    </div>
                                                </div>
                                               
                                            </div>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <form name=calform method="post" action="pedidos-enviar-valor-send.php?id_pedido=<? echo $id_pedido; ?>" onSubmit="return checkrequired(this)">
                                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title">Código</th>
                                                <th class="column-title">Descripción</th>
                                                <th class="column-title">Cantidad</th>
                                                <th class="column-title">Precio</th>
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
                                                  $estado=$row["estado"];     
                                                  $precio=$row["precio"];     
                                                  $id_detpedido=$row["id_detpedido"];     
                                                  $descripcion=$row2["descripcion"];

                                                  
                                                  $totalProd=$precio*$cantidad;
                                                                                                                                                                                          
                                              
                                              
                                                if ($cont%2==0) { 
                                                    $est="TrBackoffice"; 
                                                } else { 
                                                    $est="TrBackofficeB"; 
                                                } 
                                              ?>
                                                <tr class="even pointer">


                                                    <td class=" "><? echo $row["codigo"]; ?></td>
                                                    <td class=" "><? echo $row["descripcion"]; ?></td>
                                                    <td class=" "><? echo $row["cantidad"]; ?></td>
                                                    <td class=" ">$ <? echo money_format('%(#10n', $precio);?></td>              
                                                    <td class=" ">$ <? echo money_format('%(#10n', $totalProd);?></td>           
                                                </tr>
                                            <? 
                                            $totalProd2=$totalProd2+$totalProd;
                                            $cont++;
                                            } 
                                            
                                            $iva=($totalProd2*21)/100;
                                            $total=$totalProd2+$iva;
                                            ?>
                                                <tr class="even pointer">
                                                    <td class=" "></td>
                                                    <td class=" "></td>
                                                    <td class=" ">SUB-TOTAL</td>
                                                    <td class=" "></td>              
                                                    <td class=" ">$ <? echo money_format('%(#10n', $totalProd2);?></td>           
                                                </tr>
                                                <tr class="even pointer">
                                                    <td class=" "></td>
                                                    <td class=" "></td>
                                                    <td class=" ">IVA</td>
                                                    <td class=" "></td>              
                                                    <td class=" ">$ <? echo money_format('%(#10n', $iva);?></td>           
                                                </tr>             
                                                <tr class="even pointer">
                                                    <td class=" "></td>
                                                    <td class=" "></td>
                                                    <td class=" ">TOTAL</td>
                                                    <td class=" "></td>              
                                                    <td class=" "><strong>$ <? echo money_format('%(#10n', $total);?></strong></td>           
                                                </tr>                                                                                            
                                        </tbody>

                                    </table>   
                                        <br><br>
                                        <textarea name="observaciones" class="form-control" rows="3" placeholder="Observaciones..."></textarea>
                                        <br>
                                        <button type="submit" class="btn btn-success">Enviar Cotización</button>
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

</body>

</html>