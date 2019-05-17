<?php session_start();?>
<?ob_start();?>
<?php include ("connect.php");?>
<?php include ("incFunction.php");?>
<?

$flag=$_POST['flag'];
$archivo=$_POST['archivo'];
$flag2=$_GET['flag2'];

if($flag==1) {

    $idPauta=$_POST['idPauta'];

    if (is_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'])) {
        copy($HTTP_POST_FILES['archivo']['tmp_name'], $HTTP_POST_FILES['archivo']['name']);
        $subio = true;
        
        $archivo=$HTTP_POST_FILES['archivo']['name'];
    }
    
    if($subio) {

        echo "SUBIO ARCHIVO>>>> <br>";

        error_reporting(E_ALL ^ E_NOTICE);
        require_once 'excel_reader2.php';
        $data = new Spreadsheet_Excel_Reader($archivo);

        $celdas = $data->sheets[0]['cells'];
        $i=2;
        
        echo "Pasoooo<br>";

        $result = mysql_query("DELETE FROM negociosPrecioBorrar", $link);


        while($celdas[$i][1]!="")
        {   
            echo "Pasoooo While<br>";
            $var1=$celdas[$i][1];
            $var2=$celdas[$i][2];
            $var3=$celdas[$i][3];
            $var4=$celdas[$i][4];

            echo "---> ".$var4;
            echo "<br>";

            If ($var4) {
                $fecha=@cambiafechamysqlini($var4);
            }else{
                $fecha="0000/00/00";
            }

            echo $fecha;
            echo "<br>";



//          ECHO $var1."-".$var2."-".$var3."<br>";
            echo "INSERT INTO negociosPrecioBorrar (codigo, precio, stock, fecha) VALUES ('$var1', '$var2', '$var3', '$fecha')";

            $result = mysql_query("INSERT INTO negociosPrecioBorrar (codigo, precio, stock, fecha) VALUES ('$var1', '$var2', '$var3', '$fecha')", $link);

            
            echo "<br>";

            $i++;
        }

            
        ?>




<?  
    //header("Location: producto-precios.php?flag2=1");

} else {


  //  header("Location: producto-precios.php?flag2=2");
        
    }

    die();

} ?>

<?php include ("seguridad.php");?>
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
                            <h3>Productos | Actualización Precios Vivre Negocios</h3>
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
    <li>Formato XLS</li>
    <li>Codigo | Precio | Stock | Fecha </li>
    <li>Formato Fecha AAAA/MM/DD</li>
</ul>
</ul>


                        <form action="_producto-precios.php" method="post" enctype="multipart/form-data" name="form1"  class="form-horizontal form-label-left">
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