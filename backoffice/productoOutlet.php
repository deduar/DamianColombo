<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?
$idProductMain=$_GET['idProductMain'];

$result = mysql_query("Select * From productmain where idProductMain=$idProductMain");
$row = mysql_fetch_array($result);

$codigo=$row["codigo"];
$descripcion=$row["descripcion"];
$descripcionLarga=$row["descripcionLarga"];
$estadovivre=$row["estadovivre"];
$catalogo=$row["catalogo"];
$estadooutlet=$row["estadooutlet"];

$datooutlet=$row["datooutlet"];
$agotadooutlet=$row["agotadooutlet"];
$preciolistaoutlet=$row["preciolistaoutlet"];
$precioactualoutlet=$row["precioactualoutlet"];


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
<?
$word=$_POST["word"];
$result = mysql_query("Select * from productmain where codigo like '%$word%' order by codigo");
?>

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
                            <h3>Productos</h3>
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



                                        <form name=calform method="post" action="productos-update.php" class="form-horizontal form-label-left">
                                            <input type="hidden" name="idProductMain" value="<? echo $idProductMain;?>" />

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><img src="http://www.vivreonline.com.ar/catalogo/<? echo $codigo;?>.jpg"></label>
                                            
                                             <div class="col-md-9 col-sm-9 col-xs-12">
                                                <br><br><center><h1><? echo $codigo;?> | <? echo $descripcion;?></h1></center>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">DESCRIPCION <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <? echo $descripcionLarga;?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">VISUALIZACION WEBS</label>

                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="estadooutlet" value="1" <? If ($estadooutlet==1) {?>checked<? } ?>> VIVRE OUTLET</label>
                                                </div>                                                

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">VIVRE OUTLET | Precio Tachado</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="preciolistaoutlet" class="form-control" value="<? echo $preciolistaoutlet; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">VIVRE OUTLET | Precio Actual</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="precioactualoutlet" class="form-control" value="<? echo $precioactualoutlet; ?>">
                                            </div>
                                        </div>

                                      <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">VIVRE OUTLET</label>

                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="agotadooutlet" value="1" <? If ($agotadooutlet==1) {?>checked<? } ?> > AGOTADO</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="datooutlet" value="1" <? If ($datooutlet=='1') {?>checked<? } ?>> 2x1 </label>
                                                </div>
                                            </div>
                                        </div>                                        
 


                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                
                                                <button type="submit" class="btn btn-success">   Actualizar   </button>
                                            </div>
                                        </div>

                                    </form>




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