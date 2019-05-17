<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?
$boton="Ingresar";
$tipo=$_GET["tipo"];
$idUsuarioMay=$_GET["idUsuarioMay"];


If ($tipo!="Agregar") {

        $result = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
        $row = mysql_fetch_array($result);

//      $idUsuarioMay=$row["idUsuarioMay"]; 
        $nombre=$row["nombre"]; 
        $estado=$row["estado"];                 
        $password=$row["password"];         
        $razon=$row["razon"];
        $nombreFantasia=$row["nombreFantasia"];
        $codTelefono=$row["codTelefono"];
        $codCelular=$row["codCelular"];
                         
        $direccion=$row["direccion"]; 
        $localidad=$row["localidad"]; 
        $provincia=$row["provincia"];               
        $telefono=$row["telefono"];
        $celular=$row["celular"];       
        $cuit=$row["cuit"];             
        $website=$row["website"];                       
        $email=$row["email"];
        $estado=$row["estado"];
        $boton="Modificar";
}Else{
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $cad = "";
        for($i=0;$i<4;$i++) {
        $cad .= substr($str,rand(0,62),1);
        }
        $password=$cad;
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
                            <h3>Usuarios</h3>
                        </div>
<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="usuarios-listar.php">
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    
                                    <input type="text" class="form-control" name="word" placeholder="Nombre usuario...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Buscar</button>
                        
                        </span>
                                </div>
                            </div></form>
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

                                      
                                      <form name=calform method="post" action="usuariosUpdate.php" class="form-horizontal form-label-left">

                                        <INPUT TYPE="hidden" name="flag" value="<? echo $boton; ?>">
                                        <INPUT TYPE="hidden" name="idUsuarioMay" value="<? echo $idUsuarioMay; ?>">
                                        <INPUT TYPE="hidden" name="estadoAux" value="<? echo $estado; ?>">
                                        <INPUT TYPE="hidden" name="origen" value="<? echo $origen; ?>">

                                        

                                        <div class="form-group">
                                                                                        
                                             <div class="col-md-9 col-sm-9 col-xs-12">
                                                <br><br><center><h1><? echo strtoupper($nombre);?>  <? echo strtoupper($nombreFantasia);?></h1></center>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NOMBRE</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" name="nombre" class="form-control" value="<? echo $nombre;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">ESTADO</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                
                                                <input type="radio" name="estado" value="1" <? If ($estado==1) { ?>checked<?}?>>
                                                ACTIVO 
                                                <input type="radio" name="estado" value="0" <? If ($estado==0) { ?>checked<?}?>>
                                                DESACTIVO 
                                                <input type="radio" name="estado" value="2" <? If ($estado==2) { ?>checked<?}?>>
                                                NO ES MAYORISTA 
                                            </div>
                                        </div>                      
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">RAZON <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="razon" type="text" class="form-control" id="razon" value="<? echo $razon;?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NOMBRE DE FANTASIA</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input name="nombreFantasia" type="text" class="form-control" id="nombreFantasia" value="<? echo $nombreFantasia;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">PASSWORD</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input name="password" type="text" class="form-control" id="password" value="<? echo $password;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">E-MAIL</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input name="email" type="text" class="form-control" id="email" value="<? echo $email;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">DIRECCION</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input name="direccion" type="text" class="form-control" id="direccion" value="<? echo $direccion;?>">
                                            </div>
                                        </div>

                                    
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">LOCALIDAD</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input name="localidad" type="text" class="form-control" id="localidad" value="<? echo $localidad;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">PROVINCIA</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input name="provincia" type="text" class="form-control" id="provincia" value="<? echo $provincia;?>">
                                            </div>
                                        </div>

                                   
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">TELEFONO</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input name="codTelefono" type="text" class="form-control" id="codTelefono" value="<? echo $codTelefono;?>" size="6">
                                                - 
                                                <input name="telefono" type="text" class="form-control" value="<? echo $telefono;?>">
                                            </div>
                                        </div>


                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">MOVIL</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input name="codCelular" type="text" class="form-control" id="codCelular" value="<? echo $codCelular;?>" size="6">
                                                -
                                                <input name="celular" type="text" class="form-control" id="celular" value="<? echo $celular;?>" size="20">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">CUIT</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input name="cuit" type="text" class="form-control" id="cuit" value="<? echo $cuit;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">WEB</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                 <input name="website" type="text" class="form-control" id="website" value="<? echo $website;?>">
                                            </div>
                                        </div>



                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                
                                                <button type="submit" class="btn btn-success"><? echo $boton;?></button>
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