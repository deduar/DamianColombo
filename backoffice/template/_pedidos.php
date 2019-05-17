<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?

$estado=$_GET['estado'];


$result = mysql_query("SELECT * FROM pedidos where (estado=0 and fecha >= date_sub(curdate(), interval 2 month)) ORDER BY fecha DESC");
$result1 = mysql_query("SELECT * FROM pedidos where (estado=1 and fecha >= date_sub(curdate(), interval 2 month)) ORDER BY fecha DESC");
$result2 = mysql_query("SELECT * FROM pedidos where (estado=2 and fecha >= date_sub(curdate(), interval 2 month)) ORDER BY fecha DESC");
$result3 = mysql_query("SELECT * FROM pedidos where (estado=3 and fecha >= date_sub(curdate(), interval 2 month)) ORDER BY fecha DESC");
$result4 = mysql_query("SELECT * FROM pedidos where (estado=4 and fecha >= date_sub(curdate(), interval 2 month)) ORDER BY fecha DESC");
$result5 = mysql_query("SELECT * FROM pedidos where (estado=5 and fecha >= date_sub(curdate(), interval 2 month)) ORDER BY fecha DESC");

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
                            <h3>Pedidos</h3>
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
                                <br><br>
<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!-- BEGIN CONTENIDO ////////////////////////////////////////////////////// -->                                
<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!--/////////////////////////////////////////////////////////////////////// -->                                   

                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">BANDEJA DE ENTRADA</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">PRESUPUESTADO</a>
                                            </li>
                                            <li role="presentation"  class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">EN PROCESO</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">DESPACHADO</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">ENTREGADO</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#tab_content6" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">RECHAZAD</a>
                                            </li>                                                                                                                                    
                                        </ul>
                                        <div id="myTabContent" class="tab-content">

                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="profile-tab">
                                                       <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                                            <thead>
                                                                <tr class="headings">
                                                                    <th class="column-title">Fecha Pedido</th>
                                                                    <th class="column-title">Raz&oacute;n</th>
                                                                    <th class="column-title">Cliente</th>
                                                                    <th class="column-title">Nombre Fantas&iacute;a</th>
                                                                    <th class="column-title"><strong>Nro. Pedido</strong></th>
                                                                    <th class="column-title">E-mail</th>
                                                                    <th class="column-title">Estado</th>
                                                                    <th class="column-title no-link last"><span class="nobr">Acción</span></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                              <? while ($row = mysql_fetch_array($result)) { 
                                                                                  
                                                                  $id_pedido=$row["id_pedido"];
                                                                  $idUsuarioMay=$row["idUsuario"];
                                                                  $fecha=$row["fecha"];                           
                                                                  $estado=$row["estado"];
                                                                  $cliente=$row["cliente"];
                                                                  
                                                                  
                                                                  $resultB = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
                                                                  $row2 = mysql_fetch_array($resultB);

                                                                  $nombre=$row2["nombre"];
                                                                  $email=$row2["email"];
                                                                  $telefono=$row2["telefono"];  
                                                                  $razon=$row2["razon"];    
                                                                  $nombreFantasia=$row2["nombreFantasia"];
                                                                  $corredor=$row2["corredor"];
                                                 
                                                                  $estadoVer=verEstado($estado);
                                                            ?>
                                                                    <tr class="even pointer">
                                                                        <td class=" "><b><? echo cambiaf_a_normal($fecha); ?></b></td>
                                                                        <td class=" "><? echo strtoupper($razon); ?><? If($corredor==1){ ?> <span class="texto-rojo"> (Corredor)</span> <? } ?></td>
                                                                        <td class=" "><? echo strtoupper($cliente); ?></td>
                                                                        <td class=" "><? echo strtoupper($nombreFantasia); ?></td>
                                                                        <td class=" "><strong><? echo $id_pedido; ?></strong></td>
                                                                        <td class=" "><b><? echo strtolower($email); ?></b></td>
                                                                        <td class=" "><strong><? echo $estadoVer; ?></strong></div></td>
                                                                        <td class=" last">
                                                                            <a href='pedido-detalle.php?id_pedido=<? echo $id_pedido; ?>'>Acceder</a>
                                                                            </td>
                                                                    </tr>
                                                                           
                                                                 <?}?>
                                                            </tbody>

                                                        </table>
                                            </div>

                                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                                       <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                                            <thead>
                                                                <tr class="headings">
                                                                    <th class="column-title">Fecha Pedido</th>
                                                                    <th class="column-title">Raz&oacute;n</th>
                                                                    <th class="column-title">Cliente</th>
                                                                    <th class="column-title">Nombre Fantas&iacute;a</th>
                                                                    <th class="column-title"><strong>Nro. Pedido</strong></th>
                                                                    <th class="column-title">E-mail</th>
                                                                    <th class="column-title">Estado</th>
                                                                    <th class="column-title no-link last"><span class="nobr">Acción</span></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                              <? while ($row = mysql_fetch_array($result1)) { 
                                                                                  
                                                                  $id_pedido=$row["id_pedido"];
                                                                  $idUsuarioMay=$row["idUsuario"];
                                                                  $fecha=$row["fecha"];                           
                                                                  $estado=$row["estado"];
                                                                  $cliente=$row["cliente"];
                                                                  
                                                                  
                                                                  $resultB = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
                                                                  $row2 = mysql_fetch_array($resultB);

                                                                  $nombre=$row2["nombre"];
                                                                  $email=$row2["email"];
                                                                  $telefono=$row2["telefono"];  
                                                                  $razon=$row2["razon"];    
                                                                  $nombreFantasia=$row2["nombreFantasia"];
                                                                  $corredor=$row2["corredor"];
                                                 
                                                                  $estadoVer=verEstado($estado);
                                                            ?>
                                                                    <tr class="even pointer">
                                                                        <td class=" "><b><? echo cambiaf_a_normal($fecha); ?></b></td>
                                                                        <td class=" "><? echo strtoupper($razon); ?><? If($corredor==1){ ?> <span class="texto-rojo"> (Corredor)</span> <? } ?></td>
                                                                        <td class=" "><? echo strtoupper($cliente); ?></td>
                                                                        <td class=" "><? echo strtoupper($nombreFantasia); ?></td>
                                                                        <td class=" "><strong><? echo $id_pedido; ?></strong></td>
                                                                        <td class=" "><b><? echo strtolower($email); ?></b></td>
                                                                        <td class=" "><strong><? echo $estadoVer; ?></strong></div></td>
                                                                        <td class=" last">
                                                                            <a href='pedido-detalle.php?id_pedido=<? echo $id_pedido; ?>'>Acceder</a>
                                                                            </td>
                                                                    </tr>
                                                                           
                                                                 <?}?>
                                                            </tbody>

                                                        </table>
                                            </div>
                                            
                                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                                       <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                                            <thead>
                                                                <tr class="headings">
                                                                    <th class="column-title">Fecha Pedido</th>
                                                                    <th class="column-title">Raz&oacute;n</th>
                                                                    <th class="column-title">Cliente</th>
                                                                    <th class="column-title">Nombre Fantas&iacute;a</th>
                                                                    <th class="column-title"><strong>Nro. Pedido</strong></th>
                                                                    <th class="column-title">E-mail</th>
                                                                    <th class="column-title">Estado</th>
                                                                    <th class="column-title no-link last"><span class="nobr">Acción</span></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                              <? while ($row = mysql_fetch_array($result2)) { 
                                                                                  
                                                                  $id_pedido=$row["id_pedido"];
                                                                  $idUsuarioMay=$row["idUsuario"];
                                                                  $fecha=$row["fecha"];                           
                                                                  $estado=$row["estado"];
                                                                  $cliente=$row["cliente"];
                                                                  
                                                                  
                                                                  $resultB = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
                                                                  $row2 = mysql_fetch_array($resultB);

                                                                  $nombre=$row2["nombre"];
                                                                  $email=$row2["email"];
                                                                  $telefono=$row2["telefono"];  
                                                                  $razon=$row2["razon"];    
                                                                  $nombreFantasia=$row2["nombreFantasia"];
                                                                  $corredor=$row2["corredor"];
                                                 
                                                                  $estadoVer=verEstado($estado);
                                                            ?>
                                                                    <tr class="even pointer">
                                                                        <td class=" "><b><? echo cambiaf_a_normal($fecha); ?></b></td>
                                                                        <td class=" "><? echo strtoupper($razon); ?><? If($corredor==1){ ?> <span class="texto-rojo"> (Corredor)</span> <? } ?></td>
                                                                        <td class=" "><? echo strtoupper($cliente); ?></td>
                                                                        <td class=" "><? echo strtoupper($nombreFantasia); ?></td>
                                                                        <td class=" "><strong><? echo $id_pedido; ?></strong></td>
                                                                        <td class=" "><b><? echo strtolower($email); ?></b></td>
                                                                        <td class=" "><strong><? echo $estadoVer; ?></strong></div></td>
                                                                        <td class=" last">
                                                                            <a href='pedido-detalle.php?id_pedido=<? echo $id_pedido; ?>'>Acceder</a>
                                                                            </td>
                                                                    </tr>
                                                                           
                                                                 <?}?>
                                                            </tbody>

                                                        </table>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                                                       <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                                            <thead>
                                                                <tr class="headings">
                                                                    <th class="column-title">Fecha Pedido</th>
                                                                    <th class="column-title">Raz&oacute;n</th>
                                                                    <th class="column-title">Cliente</th>
                                                                    <th class="column-title">Nombre Fantas&iacute;a</th>
                                                                    <th class="column-title"><strong>Nro. Pedido</strong></th>
                                                                    <th class="column-title">E-mail</th>
                                                                    <th class="column-title">Estado</th>
                                                                    <th class="column-title no-link last"><span class="nobr">Acción</span></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                              <? while ($row = mysql_fetch_array($result3)) { 
                                                                                  
                                                                  $id_pedido=$row["id_pedido"];
                                                                  $idUsuarioMay=$row["idUsuario"];
                                                                  $fecha=$row["fecha"];                           
                                                                  $estado=$row["estado"];
                                                                  
                                                                  
                                                                  $resultB = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
                                                                  $row2 = mysql_fetch_array($resultB);

                                                                  $nombre=$row2["nombre"];
                                                                  $email=$row2["email"];
                                                                  $telefono=$row2["telefono"];  
                                                                  $razon=$row2["razon"];    
                                                                  $nombreFantasia=$row2["nombreFantasia"];                                                                                                                
                                                 
                                                                  $estadoVer=verEstado($estado);
                                                            ?>
                                                                    <tr class="even pointer">
                                                                        <td class=" "><b><? echo cambiaf_a_normal($fecha); ?></b></td>
                                                                        <td class=" "><? echo strtoupper($razon); ?></td>
                                                                        <th class="column-title">Nombre Cliente</th>
                                                                        <td class=" "><? echo strtoupper($nombre); ?></td>
                                                                        <td class=" "><? echo strtoupper($nombreFantasia); ?></td>
                                                                        <td class=" "><strong><? echo $id_pedido; ?></strong></td>
                                                                        <td class=" "><b><? echo strtolower($email); ?></b></td>
                                                                        <td class=" "><strong><? echo $estadoVer; ?></strong></div></td>
                                                                        <td class=" last">
                                                                            <a href='pedido-detalle.php?id_pedido=<? echo $id_pedido; ?>'>Acceder</a>
                                                                            </td>
                                                                    </tr>
                                                                           
                                                                 <?}?>
                                                            </tbody>

                                                        </table>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                                                       <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                                            <thead>
                                                                <tr class="headings">
                                                                    <th class="column-title">Fecha Pedido</th>
                                                                    <th class="column-title">Raz&oacute;n</th>
                                                                    <th class="column-title">Nombre Cliente</th>
                                                                    <th class="column-title">Nombre Fantas&iacute;a</th>
                                                                    <th class="column-title"><strong>Nro. Pedido</strong></th>
                                                                    <th class="column-title">E-mail</th>
                                                                    <th class="column-title">Estado</th>
                                                                    <th class="column-title no-link last"><span class="nobr">Acción</span></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                              <? while ($row = mysql_fetch_array($result4)) { 
                                                                                  
                                                                  $id_pedido=$row["id_pedido"];
                                                                  $idUsuarioMay=$row["idUsuario"];
                                                                  $fecha=$row["fecha"];                           
                                                                  $estado=$row["estado"];
                                                                  
                                                                  
                                                                  $resultB = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
                                                                  $row2 = mysql_fetch_array($resultB);

                                                                  $nombre=$row2["nombre"];
                                                                  $email=$row2["email"];
                                                                  $telefono=$row2["telefono"];  
                                                                  $razon=$row2["razon"];    
                                                                  $nombreFantasia=$row2["nombreFantasia"];                                                                                                                
                                                 
                                                                  $estadoVer=verEstado($estado);
                                                            ?>
                                                                    <tr class="even pointer">
                                                                        <td class=" "><b><? echo cambiaf_a_normal($fecha); ?></b></td>
                                                                        <td class=" "><? echo strtoupper($razon); ?></td>
                                                                        <td class=" "><? echo strtoupper($nombre); ?></td>
                                                                        <td class=" "><? echo strtoupper($nombreFantasia); ?></td>
                                                                        <td class=" "><strong><? echo $id_pedido; ?></strong></td>
                                                                        <td class=" "><b><? echo strtolower($email); ?></b></td>
                                                                        <td class=" "><strong><? echo $estadoVer; ?></strong></div></td>
                                                                        <td class=" last">
                                                                            <a href='pedido-detalle.php?id_pedido=<? echo $id_pedido; ?>'>Acceder</a>
                                                                            </td>
                                                                    </tr>
                                                                           
                                                                 <?}?>
                                                            </tbody>

                                                        </table>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="profile-tab">
                                                       <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                                            <thead>
                                                                <tr class="headings">
                                                                    <th class="column-title">Fecha Pedido</th>
                                                                    <th class="column-title">Raz&oacute;n</th>
                                                                    <th class="column-title">Nombre Cliente</th>
                                                                    <th class="column-title">Nombre Fantas&iacute;a</th>
                                                                    <th class="column-title"><strong>Nro. Pedido</strong></th>
                                                                    <th class="column-title">E-mail</th>
                                                                    <th class="column-title">Estado</th>
                                                                    <th class="column-title no-link last"><span class="nobr">Acción</span></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                              <? while ($row = mysql_fetch_array($result5)) { 
                                                                                  
                                                                  $id_pedido=$row["id_pedido"];
                                                                  $idUsuarioMay=$row["idUsuario"];
                                                                  $fecha=$row["fecha"];                           
                                                                  $estado=$row["estado"];
                                                                  
                                                                  
                                                                  $resultB = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
                                                                  $row2 = mysql_fetch_array($resultB);

                                                                  $nombre=$row2["nombre"];
                                                                  $email=$row2["email"];
                                                                  $telefono=$row2["telefono"];  
                                                                  $razon=$row2["razon"];    
                                                                  $nombreFantasia=$row2["nombreFantasia"];                                                                                                                
                                                 
                                                                  $estadoVer=verEstado($estado);
                                                            ?>
                                                                    <tr class="even pointer">
                                                                        <td class=" "><b><? echo cambiaf_a_normal($fecha); ?></b></td>
                                                                        <td class=" "><? echo strtoupper($razon); ?></td>
                                                                        <td class=" "><? echo strtoupper($nombre); ?></td>
                                                                        <td class=" "><? echo strtoupper($nombreFantasia); ?></td>
                                                                        <td class=" "><strong><? echo $id_pedido; ?></strong></td>
                                                                        <td class=" "><b><? echo strtolower($email); ?></b></td>
                                                                        <td class=" "><strong><? echo $estadoVer; ?></strong></div></td>
                                                                        <td class=" last">
                                                                            <a href='pedido-detalle.php?id_pedido=<? echo $id_pedido; ?>'>Acceder</a>
                                                                            </td>
                                                                    </tr>
                                                                           
                                                                 <?}?>
                                                            </tbody>

                                                        </table>
                                            </div>                                                                                                                                    
                                        </div>
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