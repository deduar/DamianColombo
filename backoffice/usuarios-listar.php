<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?

$result = mysql_query("Select * from usuarioMay where estado=1 order by nombre");
$result2 = mysql_query("Select * from usuarioMay where estado=0 order by nombre");
?>
<?
$word=$_POST["word"];
If ($_POST["word"]){
    $result = mysql_query("Select * from usuarioMay where nombre like '%$word%' OR nombreFantasia like '%$word%' OR razon like '%$word%' OR email like '%$word%' order by nombre");
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
                            <h3>Seleccionar Usuario</h3>
                        </div>
<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="usuarios-listar.php">
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                
                                <div class="input-group">
                                    
                                    <input type="text" class="form-control" name="word" minlength="5" placeholder="Nombre usuario...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Buscar</button>
                        
                        </span>
                                </div>
                            </div>
                        </div></form>
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
                                    <?php If ($_POST["word"]){ ?>
                                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                                       <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                                            <thead>
                                                                <tr class="headings">
                                                                    <th class="column-title">Usuario</th>
                                                                    <th class="column-title">Nombre Fantas&iacute;a</th>
                                                                    <th class="column-title">E-mail</th>
                                                                    <th class="column-title">Estado</th>
                                                                    <th class="column-title no-link last"><span class="nobr">Acción</span></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                              <? while ($row = mysql_fetch_array($result)) { 
                                                                                  
                                                                  $nombre=$row["nombre"];
                                                                  $email=$row["email"];
                                                                  $telefono=$row["telefono"];  
                                                                  $razon=$row["razon"];    
                                                                  $nombreFantasia=$row["nombreFantasia"];
                                                                  $idUsuarioMay=$row["idUsuarioMay"];
                                                                  $estado=$row["estado"];

                                                            ?>
                                                                    <tr class="even pointer">
                                                                        <td class=" "><? echo strtoupper($nombre); ?></td>
                                                                        <td class=" "><? echo strtoupper($nombreFantasia); ?></td>
                                                                        <td class=" "><strong><? echo $email; ?></strong></td>
                                                                        <td class=" "><strong><? verEstadoUsuario($estado); ?></strong></div></td>
                                                                        <td class=" last">
                                                                            <a href='pedido-alta-update.php?idUsuario=<? echo $idUsuarioMay; ?>'>Generar Pedido</a> | <a href='usuario-editar.php?idUsuarioMay=<? echo $idUsuarioMay; ?>'>Acceder</a>
                                                                            </td>
                                                                    </tr>
                                                                           
                                                                 <?}?>
                                                            </tbody>

                                                        </table>
                                            </div>
                                            
                                    <?php }?>                                                                                                                            
                        


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