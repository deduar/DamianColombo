<?php session_start();?>
<?php ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<!DOCTYPE html>
<html lang="en">
<?php

$flagInicio = isset($_GET['flagInicio']) ? $_GET['flagInicio'] : null; 
$idProductoRelacionado = isset($_GET['idProductoRelacionado']) ? $_GET['idProductoRelacionado'] : null; 
$idProductMain = isset($_GET['idProductMain']) ? $_GET['idProductMain'] : null; 

$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null; 


$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null; 
$word = isset($_POST['word']) ? $_POST['word'] : null; 

$datosProducto=array();
$datosProducto=consultaProductoCod($codigo);
?>
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
                            <h3>Productos</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="productos-listar.php">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="word" placeholder="Código de producto...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Buscar</button>
                                       </span>
                                    </div>
                                </form>
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
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">
                                    <?php mostrarImagen($datosProducto[1]); ?>
                                </label>
                                
                                 <div class="col-md-10 col-sm-10 col-xs-12">
                                    <br><br><br>
                                    <h1><?php echo $datosProducto[1];?> | <i><?php echo $datosProducto[2];?></i></h1>
                                </div>
                            </div>

                            


                            <?php consultaProductoRel($codigo, $tipo, "backoffice"); ?>

                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="productos-relacionados.php?codigo=<?php echo $codigo;?>&idProductMain=<?php echo $idProductMain;?>&tipo=<?php echo $tipo;?>">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Código <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" required="required" name="word" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Agregar Producto</button>
                                    </div>
                                </div>
                            </form>     
                                    
                            <?php If ($flagInicio==1) {

                            }else{ ?>                                    

                                <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title"></th>
                                            <th class="column-title">Código</th>
                                            <th class="column-title">Descripción</th>
                                            <th class="column-title no-link last"><span class="nobr">Acción</span></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                <?php

                                $likeString = '%'.$word.'%';

                                include ("connect.php");
                                $sql  = "SELECT codigo, descripcion, idProductMain, precioLista, stock, flagNew, precioFinal FROM productmain WHERE codigo LIKE ?";       

                                $stmt = $mysqli->prepare($sql);
                                $stmt->bind_param('s', $likeString) or die($mysqli->error);
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($codigoB, $descripcion, $idProductMain, $precioLista, $stock, $flagNew, $precioFinal);
                                
                                $cont=1;

                                while ($stmt->fetch()) { ?>

                                        <tr class="even pointer">
                                            <td class=' '><div class=''><img src="../assets\images\productos/<?php echo $codigoB;?>BIG1.jpg" class='imagen-lista'></div></td>
                                            <td class=" "><?php echo $codigoB; ?></td>
                                            <td class=" "><?php echo $descripcion; ?></td>
                                            <td class=" last">
                                            
                                            <a href="productos-relacionados-insert.php?codigo=<?php echo $codigo;?>&codigoRel=<?php echo $codigoB;?>&idProductMain=<?php echo $idProductMain;?>&flagInicio=1&tipo=<?php echo $tipo;?>">Relacionar</a>


                                            </td>
                                        </tr>

                                <?php } ?>



                                    </tbody>

                                </table>

                            <?php } ?>

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