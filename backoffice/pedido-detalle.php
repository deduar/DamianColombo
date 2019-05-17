<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?php
$id_pedido = isset($_GET['id_pedido']) ? $_GET['id_pedido'] : null;
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null;

$datosPedido=array();
$datosPedido=obtenerPedidosId($id_pedido);

$datos=array();
$datos=consultaUsuario($datosPedido[1]);

$estado=$datosPedido[3];
$enc33 = "kalo_as56";
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
                                <?//php include ("inc-buscar-producto.php");?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" >
                                <h1 class="page-header">Pedido <?php echo $id_pedido; ?></h1>

<!--/////////////////////////////////////////////////////////////////////// -->
<!-- BEGIN CONTENIDO ////////////////////////////////////////////////////// -->
<!--/////////////////////////////////////////////////////////////////////// -->
<!--/////////////////////////////////////////////////////////////////////// -->
<!--/////////////////////////////////////////////////////////////////////// -->
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                          <?php
                                          $enc33 = "kalo_as56";
                                          $datos[3] = desencriptar($datos[3], $enc33);
                                          $datos[4] = desencriptar($datos[4], $enc33);
                                          $datos[11] = desencriptar($datos[11], $enc33);
                                          //$datos[5] = desencriptar($datos[5], $enc33);
                                          $datos[7] = desencriptar($datos[7], $enc33);
                                          $datos[8] = desencriptar($datos[8], $enc33);
                                          $nombreCompleto=$datos[3]." ".$datos[4];
                                          ?>
                                            <div class="well profile_view">
                                                <div class="col-sm-12">
                                                    <h4 class="brief"><i><b><?php echo strtoupper($datos[3])?> <?php echo strtoupper($datos[4]);?></b></i></h4>
                                                    <div class="left col-xs-7">
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-phone"></i> <?php echo $datos[11];?></li>
                                                            <li><i class="fa fa-mail"></i> <?php echo $datos[5];?></li>
                                                            <li><?php echo $datos[7];?></li>
                                                            <li><?php echo $datos[8];?></li>
                                                            <li><?php echo $datos[9];?> - <?php echo $datos[10];?></li>
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



                                            <!--<a href="pedido-imprimir2.php?id_pedido=<?php //echo $id_pedido; ?>" class="btn btn-primary">Imprimir</a>-->
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <form name=calform method="post" action="pedido-estado.php?id_pedido=<?php echo $id_pedido; ?>&email=<?php echo $datos[5]; ?>&idUsuario=<?php echo $datos[0]; ?>&nombreCompleto=<?php echo $datos[3];?>" onSubmit="return checkrequired(this)">
                                       <input name="estado" class="flat" type="radio"  id="radio" value="EN PROCESO"  <?php If ($estado=="EN PROCESO"){?>checked="checked" <?php } ?>/>
                                        EN PROCESO
                                        <!-- <input name="estado" class="flat" type="radio"  id="radio5" value="CONFIRMADO"  <?//php If ($estado=="CONFIRMADO"){?>checked="checked" <?//php } ?>/>
                                        CONFIRMADO -->
                                        <input name="estado" class="flat" type="radio" id="radio2" value="EN TALLER"  <?php If ($estado=="EN TALLER"){?>checked="checked" <?php } ?>/>
                                        EN TALLER
                                        <input type="radio" class="flat" name="estado" id="radio3" value="PREPARACION P/ENVIO" <?php If ($estado=="PREPARACION P/ENVIO"){?> checked="checked" <?php } ?>/>
                                        PREPARACION P/ENVIO
                                        <input type="radio" class="flat" name="estado" id="radio4" value="DESPACHADO" <?php If ($estado=="DESPACHADO"){?> checked="checked" <?php } ?>/>
                                        DESPACHADO
                                        <input type="radio" class="flat" name="estado" id="radio4" value="ENTREGADO" <?php If ($estado=="ENTREGADO"){?> checked="checked" <?php } ?>/>
                                        ENTREGADO
                                        <input type="radio" class="flat" name="estado" id="radio4" value="CANCELADO" <?php If ($estado=="CANCELADO"){?> checked="checked" <?php } ?>/>
                                        CANCELADO
                                        <br><br>
                                        <textarea class="form-control" rows="3" name="observaciones" placeholder="Observaciones..."></textarea><br>
                                        <button type="submit" class="btn btn-success">Actualizar Estado</button>
                                    </form>

                                    <?php If($datosPedido[5]){?>
                                        <hr>
                                         <p><b>Observaciones:</b> <?php echo $datosPedido[5]; ?></p>
                                    <?php } ?>


                                        <hr>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <form id="form2" name="form2" method="post" action="pedido-modificar.php">
                                    <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">
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

                                              <?php

                                                    include ("connect.php");
                                                    $sql = "SELECT id_detpedido, id_pedido, id, cantidad, precio, precioDolar, medida FROM det_pedidos WHERE id_pedido = ?";

                                                    $stmt = $mysqli->prepare($sql);
                                                    if(!$stmt->bind_param('i', $id_pedido))
                                                    {
                                                        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
                                                    }

                                                    $stmt->execute();
                                                    $stmt->store_result();
                                                    $stmt->bind_result($id_detpedido, $id_pedido, $id, $cantidad, $precio, $precioDolar, $medida);

                                                    $subtotal=0;
                                                    $total=0;
                                                    $cont=1;

                                                    while ($stmt->fetch()) {

                                                        $datosArticulo=array();
                                                        $datosArticulo=consultaArticuloId($id);

                                                        $subtotal=$cantidad*$precio;
                                                        $total=$total+$subtotal;
                                                             ?>

                                                             <input type="hidden" name="id_detpedido<? echo $cont; ?>" value="<? echo $id_detpedido; ?>">
                                                            <tr class="even pointer">
                                                                <td class=" " with="2%"><IMG SRC='../assets/images/productos/<?php echo $datosArticulo[1]; ?>BIG1.jpg' class='img-responsive' border='0'></td>
                                                                <td class=" "><?php echo $datosArticulo[1]; ?></td>
                                                                <td class=" "><?php echo $datosArticulo[2]; ?></td>
                                                                <td class=" last">
                                                                    <b><?php echo $cantidad; ?></b>
                                                                </td>
                                                                <td class=" ">
                                                                    U&#36D <?php echo $precio; ?>
                                                                </td>
                                                                <td class=" last">
                                                                    <!--<input name="desc<? //echo $cont; ?>" type="text" value="<? //echo $descuento; ?>" size="2" maxlength="2" onkeyUp='return ValNumero(this);'> <b>%</b>-->
                                                                </td>
                                                                <td class=" ">
                                                                    U&#36D <?php echo $subtotal;?>
                                                                </td>
                                                                <td class=" ">
                                                                    <!-- <a href='_pedido-eliminar.php?id_detpedido=<? echo $id_detpedido; ?>&id_pedido=<? echo $id_pedido; ?>'>Eliminar</a> -->
                                                                </td>
                                                            </tr>

                                             <?php

                                             $cont=$cont+1;
                                         }

                                        ?>

                                         <!--<tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" ">SUB-TOTAL</td>
                                            <td class=" "></td>
                                            <td class=" ">$ <? //echo money_format('%(#10n', $subTotalPedido);?></td>
                                            <td></td>
                                        </tr>-->

                                        <!--<tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" ">IVA</td>
                                            <td class=" "></td>
                                            <td class=" ">$ <?// echo money_format('%(#10n', $iva);?></td>
                                            <td></td>
                                        </tr>-->
                                        <tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" "><h3>TOTAL</h3></td>
                                            <td class=" "></td>
                                            <td class=" "><h3><strong>U&#36D <?php echo $total;?></strong></h3></td>
                                            <td></td>
                                        </tr>

                                        </tbody>
                                        <tfoot>
                                            <!--<tr>
                                                <td><a href="pedidos-agregar.php?id_pedido=<? //echo $id_pedido; ?>" class="btn btn-primary">Agregar Producto</a> <a href="pedido-detalle-enviar.php?id_pedido=<? //echo $id_pedido; ?>" class="btn btn-primary">Enviar Presupuesto</a></td>
                                                <td></td>
                                                <td></td>
                                                <td></td><td></td>
                                                <td></td>
                                                <input type="hidden" name="cont" value="<? //echo $cont; ?>">
                                                <td><button type="submit" class="btn btn-success">Actualizar</button></td>
                                            </tr>-->
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
