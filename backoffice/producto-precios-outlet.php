<?php include ("incFunction.php");?>
<?php include ("connect.php");?><?
    //require("class.phpmailer.php");

$flag=$_POST['flag'];
$archivo=$_POST['archivo'];
$texto=$_POST['texto'];
$idWeb=$_POST['idWeb'];


if($flag==1) {


$nombreArchivo = basename($_FILES['archivo']['name']);
$uploaddir = '/home/vivre/public_html/backoffice/';
$uploadfile = $uploaddir.basename($_FILES['archivo']['name']);


if (move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadfile)) {


        $subio = true;
        
        //$archivo=$HTTP_POST_FILES['archivo']['name'];
    }
    
    if($subio) {
        
        $result = mysql_query("UPDATE productmain SET estadooutlet=0", $link);

      //  echo "SUBIO ARCHIVO 2 >>>> <br>";

        $fila = 1;
        if (($gestor = fopen($nombreArchivo, "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                $numero = count($datos);
                //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
                $fila++;
                //for ($c=0; $c < $numero; $c++) {
                   // echo $datos[$c] . "<br />\n";

                    $var1=$datos[0];
                    $var2=$datos[1];

               // }
                
           //     echo "INSERT INTO negociosPrecioBorrar (codigo, precio, stock, fecha) VALUES ('$var1', '$var2', '$var3', '$fecha')";

           
           $result = mysql_query("UPDATE productmain SET precioactualoutlet='$var2', estadooutlet=1 WHERE codigo='$var1'", $link);

            
          //  echo "<br>";
            }
            $flag2=1;
            fclose($gestor);
        }



    } else {
        $flag2=2;
        echo "El archivo no se pudo subir intente mas tarde.";  
    }

  //  die();

} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Backoffice VIVRE</title>

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
                            <h3>Productos | Actualización Precios VIVRE OUTLET</h3>
                        </div>

                        <!-- <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
  
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" >
                                <? If ($flag2==1) { ?>
                                    <div id="signalert2" style="display:show; margin-top:0px;" class="alert alert-success">
                                        Se actualizaron correctamente los precios.
                                    </div>    
                                    <? } ?>

                                <? If ($flag2==2) { ?>
                                    <div id="signalert2" style="display:show; margin-top:0px;" class="alert alert-danger">
                                        El archivo no se pudo subir intente mas tarde.
                                    </div>    
                                    <? } ?>

                                <br><br>
<!-- BEGIN CONTENIDO ////////////////////////////////////////////////////// -->                                

<h4>Atención, carateristicas del archivo:</h4>
<ul>
    <li>Formato CSV <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">¿Cómo exporto a formato CSV?</button></li>
    <li>Codigo | Precio </li>
</ul>
</ul>


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <img src="images/ayudaCsv.jpg">
    </div>
  </div>
</div>

                <form action="producto-precios-outlet.php" method="post" enctype="multipart/form-data" name="form1"  class="form-horizontal form-label-left">
                <input type="hidden" name="tipo" value="<? echo $tipo2; ?>">
                <input type="hidden" name="id" value="<? echo $id2; ?>">
                <input type="hidden" name="flag" value="1">


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Archivo: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="file" name="archivo" id="archivo" class="input">
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </div>
                </form>

<!-- END CONTENIDO ////////////////////////////////////////////////////// -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->
                <footer>
                    <div class="">
                            <p class="pull-right">Implementó | SConsulting.com.ar</p>
                        </p>
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