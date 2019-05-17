<?php session_start();?>
<?php ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>

<?php

$idNoticia = isset($_GET['idNoticia']) ? $_GET['idNoticia'] : null;
$idNoticia = htmlspecialchars($idNoticia);

$paso = isset($_GET['paso']) ? $_GET['paso'] : null;
$idArchivo = isset($_GET['idArchivo']) ? $_GET['idArchivo'] : null;


If ($paso=="Eliminar") {

include ("connect.php");
$sql = "DELETE FROM archivonews WHERE idArchivo= ?";
$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
$stmt->bind_param('i', $idArchivo) or die ($mysqli->error);
$stmt->execute();

}



$datos=array();
$datos=consultaNovedad($idNoticia);

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

<!-- CDN hosted by Cachefly -->
<script src="tinymce/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>

<script type="text/javascript">
    function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}



</script>

<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <?php include ("inc-menu.php");?>
            </div>

            <?php include ("inc-top.php");?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Blog Editar</h3>
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
                                 


                                      <div class="col-md-2">

                                        <!-- IMAGENES  -->
                                        <?php mostrarContenido($idNoticia, 6, 400); ?>
                                        <!-- FIN IMAGENES  -->        


                                        <!-- OTRAS IMAGENES  -->
                                              <?php mostrarContenido($idNoticia, 2, 900); ?>
                                        <!-- FIN OTRAS IMAGENES  -->
                                        


                                        <!-- VIDEO  -->
                                        <?php mostrarContenido($idNoticia, 5, 0); ?>
                                        <!-- FIN VIDEO -->
                                        <!-- OTROS VIDEOS  -->
                                        <?php mostrarContenido($idNoticia, 4, 0); ?>
                                        <!-- OTROS FIN VIDEOS  -->




                                            <!-- OTROS DESCARGAS  -->
                                              <?php mostrarContenido($idNoticia, 3, 0); ?>
                                             <!-- OTROS FIN DESCARGAS-->

                                        </div>

                                      <div class="col-md-10">

                                              <h3><?php echo $datos[2]; ?></h3>
                                              <h5><?php echo $datos[4]; ?></h5>
                                              
                                              

                                      </div> <!-- FIN col-md-8 -->






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

    <!-- daterangepicker -->
        <script type="text/javascript" src="js/moment.min2.js"></script>
        <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

</body>

</html>