<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connectSC.php");?>
<?//php include ("seguridad.php");?>
<?
$idWeb=$_SESSION["idWeb"];
$idPautaSocial=$_SESSION["idPautaSocial"];
$idPauta=$_GET["idPauta"];
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

<script language="javascript" type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
    mode : "textareas"
});
</script>

<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>



</head>
<body class="nav-md">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.5&appId=729451193763551";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
                            <h3>Pauta | Marketing Digital</h3>
                            
                        </div>

                        <div class="title_right">

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

                        <? 
                        $result = mysql_query("Select * from pautamkd WHERE idPauta=$idPauta");
                        //echo "Select * from pautamkd WHERE idPauta=$idPauta";
                        $row = mysql_fetch_array($result); 
                        $direccion=$row["direccion"];    
                        $nombrePauta=$row["nombrePauta"];    

                        $result2 = mysql_query("Select * from pautarendimineto WHERE idPauta=$idPauta");


                        $row2 = mysql_fetch_array($result2); 
                        $presupuesto=$row2["L"];    
                        $alcance=$row2["G"];    
                        $resultado=$row2["E"];                            
                        $costo=$row2["I"];  
                        $inicio=$row2["A"];  
                        $fin=$row2["B"];  
                        $frecuencia=$row2["H"];  
                        $clics=$row2["O"];  
                        $costo = (float) $costo;

                        $costo = number_format($costo,2);
                        $frecuencia = number_format($frecuencia,2);


                        ?>

                            <div class="col-md-4">
                            
                            <? echo $direccion;?>

                                <br>
                                <hr>
                                <br>

                            </div>

                            <div class="col-md-8">

                                <div class="row">
                                    <div class="x_panel">
                                    <span class="count_top"><b>FECHA DE INICIO <?echo $inicio ?> | FECHA FIN <?echo $fin ?></b> </span>
                                </div>
                                </div>
<!-- top tiles -->
                <div class="row tile_count">
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-money"></i> Presupuesto</span>
                            <div class="count">$ <? echo $presupuesto; ?></div>
                            <!--<span class="count_bottom"><i class="green">4% </i> From last Week</span>-->
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Alcance</span>
                            <div class="count"><? echo $alcance; ?></div>
                            <span class="count_bottom"><a href="#" data-toggle="tooltip" title="Número de personas a las que se les mostró tu anuncio.">Número de personas...</a></span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Resultado</span>
                            <div class="count green"><? echo $resultado; ?></div>
                            <span class="count_bottom"><a href="#" data-toggle="tooltip" title="Número de acciones registradas como resultado de tu anuncio. Los resultados que se muestran aquí se basan en tu objetivo.">Número de acciones...</a></span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-money"></i> Costo</span>
                            <div class="count">$ <? echo $costo; ?></div>
                            <span class="count_bottom"><a href="#" data-toggle="tooltip" title="Importe promedio que pagaste por cada acción asociada a tu onjetivo">Importe promedio...</a></span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Frecuencia</span>
                            <div class="count"><? echo $frecuencia; ?></div>
                            <span class="count_bottom"><a href="#" data-toggle="tooltip" title="La frecuencia es el promedio de veces que se mostró tu anuncio a cada persona.">Promedio de veces...</a></span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Clics todos</span>
                            <div class="count"><? echo $clics; ?></div>
                            <span class="count_bottom"><a href="#" data-toggle="tooltip" title="Número total de clics en tu anuncio. Puede incluir clics para acceder a tu sitio web, Me gusta de la página, comentarios de publicaciones, respuestas a eventos o instalaciones de eventos.">Número total de clics...</a></span>
                        </div>
                    </div>

                </div>
                <!-- /top tiles -->
                    <?
                    $result3 = mysql_query("Select * from pautainteraccion WHERE idPauta=$idPauta");

                    //echo "Select * from pautainteraccion WHERE idPauta=$idPauta";


                        $row3 = mysql_fetch_array($result3); 
                        $megusta=(int) $row3["F"];    
                        $cometarios=(int) $row3["G"];    
                        $compartido=(int) $row3["H"];                            
                        $enlace=(int) $row3["I"];  
                        $megustapagina=(int) $row3["J"]; 

                        $total=$megusta+$cometarios+$compartido+$enlace+$megustapagina;

                        //echo $total;

                        $megustaP=($megusta*100)/$total;
                        $cometariosP=($cometarios*100)/$total;
                        $compartidoP=($compartido*100)/$total;
                        $enlaceP=($enlace*100)/$total;
                        $megustapaginaP=($megustapagina*100)/$total;

                        ?>
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Resultado interacción con la publicación</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                
                                <div class="widget_summary">
                                    <div class="w_left w_25">
                                        <span>Me gusta la publicación</span>
                                    </div>
                                    <div class="w_center w_55">
                                        <div class="progress">
                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <? echo $megustaP; ?>%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w_right w_20">
                                        <span><? echo $megusta; ?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="widget_summary">
                                    <div class="w_left w_25">
                                        <span>Comentarios de la publicación</span>
                                    </div>
                                    <div class="w_center w_55">
                                        <div class="progress">
                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <? echo $cometariosP; ?>%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w_right w_20">
                                        <span><? echo $cometarios; ?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="widget_summary">
                                    <div class="w_left w_25">
                                        <span>Veces que se compartió</span>
                                    </div>
                                    <div class="w_center w_55">
                                        <div class="progress">
                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <? echo $compartidoP; ?>%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w_right w_20">
                                        <span><? echo $compartido; ?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="widget_summary">
                                    <div class="w_left w_25">
                                        <span>Click en el enlace</span>
                                    </div>
                                    <div class="w_center w_55">
                                        <div class="progress">
                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <? echo $enlaceP; ?>%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w_right w_20">
                                        <span><? echo $enlace; ?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="widget_summary">
                                    <div class="w_left w_25">
                                        <span>Me gusta de la página</span>
                                    </div>
                                    <div class="w_center w_55">
                                        <div class="progress">
                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <? echo $megustapaginaP; ?>%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w_right w_20">
                                        <span><? echo $megustapagina; ?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

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