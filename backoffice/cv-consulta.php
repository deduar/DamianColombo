<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
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
                            <h3>Productos</h3>
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
                                <br><br>
<!-- BEGIN CONTENIDO ////////////////////////////////////////////////////// -->                                
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="productos-listar.php">
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
                                                <button type="submit" class="btn btn-success">Buscar</button>
                                            </div>
                                        </div>
                                    </form>

<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="cvFindTodos.php">

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Apellido</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input name="apellido" size="60" type="text" required="required"  class="form-control col-md-7 col-xs-12">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Provincia</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <select name="provincia" class="input2">
                      <option value="Region">Seleccionar Provincia</option>
                      <option <? If($row["provincia"]=="ZONA OESTE - GBA"){ ?>selected="selected"<? } ?> value="ZONA OESTE - GBA">ZONA OESTE - GBA</option>
                      <option <? If($row["provincia"]=="ZONA SUR - GBA"){ ?>selected="selected"<? } ?> value="ZONA SUR - GBA">ZONA SUR - GBA</option>
                      <option <? If($row["provincia"]=="ZONA NORTE - GBA"){ ?>selected="selected"<? } ?> value="ZONA NORTE - GBA">ZONA NORTE - GBA</option>
                      <option <? If($row["provincia"]=="Buenos Aires"){ ?>selected="selected"<? } ?> value="Buenos Aires">Prov. Buenos Aires</option>
                      <option <? If($row["provincia"]=="Capital Federal"){ ?>selected="selected"<? } ?> value="Capital Federal">Capital Federal</option>
                      <option <? If($row["provincia"]=="Catamarca"){ ?>selected="selected"<? } ?> value="Catamarca">Catamarca </option>
                      <option <? If($row["provincia"]=="Chaco"){ ?>selected="selected"<? } ?> value="Chaco">Chaco </option>
                      <option <? If($row["provincia"]=="Chubut"){ ?>selected="selected"<? } ?> value="Chubut">Chubut </option>
                      <option <? If($row["provincia"]=="Cordoba"){ ?>selected="selected"<? } ?> value="Cordoba">Cordoba</option>
                      <option <? If($row["provincia"]=="Corrientes"){ ?>selected="selected"<? } ?> value="Corrientes">Corrientes </option>
                      <option value="Entre R&iacute;os">Entre R&iacute;os</option>
                      <option <? If($row["provincia"]=="Formosa"){ ?>selected="selected"<? } ?> value="Formosa">Formosa </option>
                      <option <? If($row["provincia"]=="Jujuy"){ ?>selected="selected"<? } ?> value="Jujuy">Jujuy</option>
                      <option <? If($row["provincia"]=="La Pampa"){ ?>selected="selected"<? } ?> value="La Pampa">La Pampa</option>
                      <option <? If($row["provincia"]=="La Rioja"){ ?>selected="selected"<? } ?> value="La Rioja">La Rioja </option>
                      <option <? If($row["provincia"]=="Mendoza"){ ?>selected="selected"<? } ?> value="Mendoza">Mendoza</option>
                      <option <? If($row["provincia"]=="Misiones"){ ?>selected="selected"<? } ?> value="Misiones">Misiones</option>
                      <option <? If($row["provincia"]=="Neuquen"){ ?>selected="selected"<? } ?> value="Neuquen">Neuquen</option>
                      <option <? If($row["provincia"]=="Rio Negro"){ ?>selected="selected"<? } ?> value="Rio Negro">Rio Negro</option>
                      <option <? If($row["provincia"]=="Salta"){ ?>selected="selected"<? } ?> value="Salta">Salta</option>
                      <option <? If($row["provincia"]=="San Juan"){ ?>selected="selected"<? } ?> value="San Juan">San Juan</option>
                      <option <? If($row["provincia"]=="San Luis"){ ?>selected="selected"<? } ?> value="San Luis">San Luis </option>
                      <option <? If($row["provincia"]=="Santa Cruz"){ ?>selected="selected"<? } ?> value="Santa Cruz">Santa Cruz</option>
                      <option <? If($row["provincia"]=="Santa Fe"){ ?>selected="selected"<? } ?> value="Santa Fe">Santa Fe</option>
                      <option <? If($row["provincia"]=="Santiago del Estero"){ ?>selected="selected"<? } ?> value="Santiago del Estero">Santiago del Estero</option>
                      <option <? If($row["provincia"]=="Tierra del Fuego"){ ?>selected="selected"<? } ?> value="Tierra del Fuego">Tierra del Fuego</option>
                      <option <? If($row["provincia"]=="Tucuman"){ ?>selected="selected"<? } ?> value="Tucuman">Tucuman</option>
                    </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Puesto</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="row">
            <div class="col-md-6">
            
                <input type="checkbox" name="area1" value="1"> Administración y Finanzas<br>
                <input type="checkbox" name="area2" value="1"> Compras<br>
                <input type="checkbox" name="area3" value="1"> Depósito<br>
                <input type="checkbox" name="area4" value="1"> Logistica<br>
                <input type="checkbox" name="area5" value="1"> Sanidad<br>
                <input type="checkbox" name="area6" value="1"> Cocina<br>
            </div>
            <div class="col-md-6">
                <input type="checkbox" name="area7" value="1"> RRHH<br>
                <input type="checkbox" name="area8" value="1"> Carnicerias<br>
                <input type="checkbox" name="area9" value="1"> Verduleria<br>
                <input type="checkbox" name="area10" value="1"> Cajas/Reposición<br>
                <input type="checkbox" name="area11" value="1"> Fiambrería<br>
                <input type="checkbox" name="area12" value="1"> Otras áreas
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sexo</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <span>Femenino</span> <input name="sexo" type="radio" value="Femenino"> | <span>Masculino</span> <input name="sexo" value="Masculino" type="radio" > 
    </div>
</div>
<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <button type="submit" class="btn btn-success">Buscar</button>
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