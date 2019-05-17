<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?php
$flag = isset($_GET['flag']) ? $_GET['flag'] : null; 

$categorias = isset($_GET['categorias']) ? $_GET['categorias'] : null;

$categorias2 = explode(" / ", $categorias);

$codCategoria = $categorias2[0];
$codSubCategoria = $categorias2[1];

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



                       <table class='table table-striped responsive-utilities jambo_table bulk_action'>
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
                            $catalogo=1;
                            $destacado=1;
                            $sql = "SELECT  idProductosCategoria, productmain.codigo, productmain.descripcion, ordenDestacado FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productoscategoria.codCategoria = ? AND productoscategoria.codSubCategoria = ? AND productmain.catalogo = ? AND productmain.destacado = ?) ORDER BY productoscategoria.ordenDestacado";

                            $stmt = $mysqli->prepare($sql);
                            if(!$stmt->bind_param('iiii', $codCategoria, $codSubCategoria, $catalogo, $destacado))
                            {
                            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
                            }


                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($idProductosCategoria, $codigo, $descripcion, $ordenDestacado);
                            $cont=1;

                            while ($stmt->fetch()) { ?>

                                    <tr class="even pointer">
                                        <td class=' '><div class=''><img src="../assets\images\productos/<?php echo $codigo;?>BIG1.jpg" class='imagen-lista'></div></td>
                                        <td class=" "><?php echo $codigo; ?></td>
                                        <td class=" "><?php echo utf8_encode($descripcion); ?></td>
                                        <td class=" last">
                                            <form method="post" action="productos-update-orden-destacados.php?categorias=<?php echo $categorias;?>&idProductosCategoria=<?php echo $idProductosCategoria;?>">
                                            <input type="text" name="orden" size="5" class="input" value="<?php echo $ordenDestacado;?>" />
                                            <input type="submit" name="Submit" value="Cambiar" class="boton" />
                                            </form>
                                            </td>
                                    </tr>
                                           
                                 <?php }?>
                            </tbody>

                        </table>

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