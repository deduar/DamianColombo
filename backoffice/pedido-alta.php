<?php session_start();?>
<?ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("connect.php");?>
<?php include ("seguridad.php");?>
<?
$tipo=$_GET['tipo'];
$id_pedido=$_GET['id_pedido'];


$result = mysql_query("SELECT * FROM `pedidos` where id_pedido=$id_pedido");
$row = mysql_fetch_array($result);
$descuentoTotal=$row["descuentoTotal"];
$fecha=$row["fecha"];
$estado=$row["estado"];
$estadoEnvio=$row["estadoEnvio"];
$idUsuarioMay=$row["idUsuario"];
$idUsuario=$row["idUsuario"];
$estadoPrecio=$row["estadoPrecio"];
$observacionesVer=$row["observaciones"];

$idEntrega=$row["idEntrega"];
$idExpreso=$row["idExpreso"];
$cliente=$row["cliente"];

echo $idExpreso;

$result2 = mysql_query("Select * from usuarioMay where idUsuarioMay=$idUsuarioMay");
$row2 = mysql_fetch_array($result2);
$razon=$row2["razon"];
$nombreFantasia=$row2["nombreFantasia"];    
$nombre=$row2["nombre"];
$email=$row2["email"];
$telefono=$row2["telefono"];       
$codTelefono=$row2["codTelefono"];          


If ($tipo==1) {
  $result = mysql_query("SELECT * FROM pedidos WHERE id_pedido=$id_pedido", $link);
  $row = mysql_fetch_array($result);
  $observaciones2=$row["observaciones"];
    
  $estado=$_POST['estado'];

  $result = mysql_query("UPDATE pedidos SET estado='$estado' WHERE id_pedido=$id_pedido", $link);
  

    If ($_POST['observaciones']){
      
      $observaciones=$_POST['observaciones'];   
      $fechaObs=date('d/m/Y'); 

      $observaciones=$observaciones2."<br>".$fechaObs." | ".$observaciones;

      $result = mysql_query("UPDATE pedidos SET observaciones='$observaciones' WHERE id_pedido=$id_pedido", $link);

    }
    
  
    
     switch ($estado) {
            case 2:
                $estadoD="EN PROCESO";
                enviarMail($estadoD, $email, $id_pedido, $observaciones,$estado, $idUsuarioMay);
                break;
            case 3:
                $estadoD="DESPACHADO";
                enviarMail($estadoD, $email, $id_pedido, $observaciones,$estado, $idUsuarioMay);        
                break;                      
            case 4:
                $estadoD="ENTREGADO";
                enviarMail($estadoD, $email, $id_pedido, $observaciones,$estado, $idUsuarioMay);
                break;

            case 5:
                $estadoD="RECHAZADO";
                enviarMail($estadoD, $email, $id_pedido, $observaciones,$estado, $idUsuarioMay);
                break;
            }
  
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
                            <h3>Pedido</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <?//php include ("inc-buscar-producto.php");?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" >
                                <h1 class="page-header">Pedido <? echo $id_pedido; ?></h1>

<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!-- BEGIN CONTENIDO ////////////////////////////////////////////////////// -->                                
<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!--/////////////////////////////////////////////////////////////////////// -->                                   
<!--/////////////////////////////////////////////////////////////////////// -->  
                                <div class="col-md-4 col-sm-4 col-xs-12">


                                            <div class="well profile_view">
                                                <div class="col-sm-12">
                                                    <h4 class="brief"><i><? echo $razon; ?></i></h4>
                                                    <div class="left col-xs-7">
                                                        <h2><? echo $nombre; ?></h2>
                                                        <p><? echo $nombreFantasia; ?></p>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-phone"></i>(<? echo $codTelefono; ?>) <? echo $telefono; ?></li>
                                                            <li><i class="fa fa-phone"></i><? echo $email; ?></li>

                                                        </ul>
                                                    </div>
                                                    <div class="right col-xs-5 text-center">
                                                        <img src="images/img.jpg" alt="" class="img-circle img-responsive">
                                                    </div>
                                                </div>
                                               
                                            </div>

                                           


                                            <? //If ($estadoEnvio == 0) { ?>
<!--
                                                No se envio la cotizaci&oacute;n<br>
                                                 <a href="pedido-detalle-enviar.php?id_pedido=<? //echo $id_pedido; ?>" class="btn btn-primary">Enviar Cotización</a>
-->
                                            <?// }else{ ?>
                                            <!--

                                                Ya se envio la cotizaci&oacute;n<br>
                                                <a href="pedido-detalle-enviar.php?id_pedido=<? //echo $id_pedido; ?>" class="btn btn-primary">Re-enviar Cotización</a>
--> 
                                            <? //} ?>                                

                                            <br><br>
            
                                            <a href="pedido-imprimir2.php?id_pedido=<? echo $id_pedido; ?>" class="btn btn-primary">Imprimir</a>
<br><br>


                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <form name=calform method="post" action="pedido-detalle.php?id_pedido=<? echo $id_pedido; ?>&tipo=1" onSubmit="return checkrequired(this)">
                                       <input name="estado" class="flat" type="radio"  id="radio" value="0"  <? If ($estado==0){?>checked="checked" <? } ?>/>
                                        BANDEJA DE ENTRADA
                                        <input name="estado" class="flat" type="radio"  id="radio5" value="1"  <? If ($estado==1){?>checked="checked" <? } ?>/>
                                        PRESUPUESTADO
                                        <input name="estado" class="flat" type="radio" id="radio2" value="2"  <? If ($estado==2){?>checked="checked" <? } ?>/>
                                        EN PROCESO
                                        <input type="radio" class="flat" name="estado" id="radio3" value="3" <? If ($estado==3){?> checked="checked" <? } ?>/>
                                        DESPACHADO
                                        <input type="radio" class="flat" name="estado" id="radio4" value="4" <? If ($estado==4){?> checked="checked" <? } ?>/>
                                        ENTREGADO
                                        <input type="radio" class="flat" name="estado" id="radio4" value="5" <? If ($estado==5){?> checked="checked" <? } ?>/>
                                        RECHAZADO  
                                        <br><br>
                                        <textarea class="form-control" rows="3" name="observaciones" placeholder="Observaciones..."></textarea><br>
                                        <button type="submit" class="btn btn-success">Actualizar Estado</button>
                                    </form>
                                        <hr>
                                          <? If ($cliente) { ?>
                                            <p><b>Pedido del cliente: <? echo $cliente; ?></b></p>  
                                          <? } ?>
                                        <hr>
                                         <p><b>Observaciones:</b> <? echo $observacionesVer; ?></p>
                                         <hr>
                                         <b>Domicilio de Entrega:</b> <? datosEntrega($idEntrega); ?><br>

                                          <? If ($idExpreso != 0) { ?>
                                            <b>Expreso:</b> <? datosExpreso($idExpreso); ?><br>  
                                          <? } ?>
                                        <hr>

                        <!--//////////////////////////////////////////////////////////////////////////////////////////-->
                        <!--//////////////////////////////////////////////////////////////////////////////////////////-->
                        <!--//////////////////////////////////////////////////////////////////////////////////////////-->
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">                        
                                <div class="single-log-info login-ul">

                                    <!-- Primer Boton -->
                                    <h2><b>Domicilio de Entrega</b></h2>
                                    <div>
                                        <? 
                                          $resultB = mysql_query("SELECT * FROM entrega WHERE idUsuarioMay=$idUsuario", $link);
                                            while ($rowB = mysql_fetch_array($resultB)) { 
                                              $idEntrega=$rowB["idEntrega"];
                                              $direccion=$rowB["direccion"];
                                              $localidad=$rowB["localidad"];
                                              $provincia=$rowB["provincia"];  
                                              $cp=$rowB["cp"]; 
                                              ?>
                                              <p><input type="radio" name="idEntrega" id="idEntrega" value="<? echo $idEntrega; ?>">  <? echo $direccion." - ".$localidad." - ".$cp." - ".$provincia; ?> | <b> <a href="#">Eliminar</a></b> </p>
                                            <? } ?>
                                            


                                            <hr>
                                            <h3>Agregar una nueva dirección</h3>
                                            <br>
                                        
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <label>Dirección <sup>*</sup></label>
                                                    <div class="input-text">
                                                        <input type="text" name="direccion">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <label>Localidad <sup>*</sup></label>
                                                    <div class="input-text">
                                                        <input type="text" name="localidad">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="input-text">
                                                        <label>Provincia <sup>*</sup></label><br>
                                                        <select class="selectpicker" data-live-search="true" name="provincia">
                                                
                                                              <option data-tokens="Buenos Aires" value="Buenos Aires">Buenos Aires</option>
                                                              <option data-tokens="Capital Federal" value="Capital Federal">Capital Federal</option>
                                                              <option data-tokens="Catamarca" value="Catamarca">Catamarca </option>
                                                              <option data-tokens="Chaco" value="Chaco">Chaco </option>
                                                              <option data-tokens="Chubut" value="Chubut">Chubut </option>
                                                              <option data-tokens="Cordoba" value="Cordoba">Cordoba</option>
                                                              <option data-tokens="Corrientes" value="Corrientes">Corrientes </option>
                                                              <option data-tokens="Entre R&iacute;os" value="Entre R&iacute;os">Entre R&iacute;os</option>
                                                              <option data-tokens="Formosa" value="Formosa">Formosa </option>
                                                              <option data-tokens="Jujuy" value="Jujuy">Jujuy</option>
                                                              <option data-tokens="La Pampa" value="La Pampa">La Pampa</option>
                                                              <option data-tokens="La Rioja" value="La Rioja">La Rioja </option>
                                                              <option data-tokens="Mendoza" value="Mendoza">Mendoza</option>
                                                              <option data-tokens="Misiones" value="Misiones">Misiones</option>
                                                              <option data-tokens="Neuquen" value="Neuquen">Neuquen</option>
                                                              <option data-tokens="Rio Negro" value="Rio Negro">Rio Negro</option>
                                                              <option data-tokens="Salta" value="Salta">Salta</option>
                                                              <option data-tokens="San Juan" value="San Juan">San Juan</option>
                                                              <option data-tokens="San Luis" value="San Luis">San Luis </option>
                                                              <option data-tokens="Santa Cruz" value="Santa Cruz">Santa Cruz</option>
                                                              <option data-tokens="Santa Fe" value="Santa Fe">Santa Fe</option>
                                                              <option data-tokens="Santiago del Estero" value="Santiago del Estero">Santiago del Estero</option>
                                                              <option data-tokens="Tierra del Fuego" value="Tierra del Fuego">Tierra del Fuego</option>
                                                              <option data-tokens="Tucuman" value="Tucuman">Tucuman</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <label>Codigo Postal <sup>*</sup></label>
                                                    <div class="input-text">
                                                        <input type="text" name="cp">
                                                    </div>
                                                </div>
                                            </div>
                                                
                                    </div>
                                    <!-- Primer Boton -->
                                </div>
                            
                            </div>

                            <div class="col-xs-12 col-sm-6">    
                                <div class="single-log-info login-ul">
                                                
                                    <!-- Segundo Boton -->
                                    <h2><b>Expreso:</b></h2>
                                    <div>

                                            <input type="radio" name="idExpreso" id="idExpreso" value="0" >  <label> Sin Expreso</label><br>

                                          <? $resultE = mysql_query("SELECT * FROM expreso WHERE idUsuarioMay=$idUsuario", $link);
                                            while ($rowE = mysql_fetch_array($resultE)) { 
                                              $idExpreso=$rowE["idExpreso"];
                                              $direccion2=$rowE["direccion"];
                                              $localidad2=$rowE["localidad"];
                                              $provincia2=$rowE["provincia"]; 
                                              $cp2=$rowE["cp"]; 
                                              $nombreExpreso=$rowE["nombreExpreso"]; 
                                              $codTelefono=$rowE["codTelefono"]; 
                                              $telefono=$codTelefono."-".$rowE["telefono"];      
                                              ?>
                                              <p><input type="radio" name="idExpreso" id="idExpreso" value="<? echo $idExpreso; ?>" > <? echo $nombreExpreso." - ".$codTelefono." - ".$telefono." - ".$direccion2." - ".$localidad2." - ".$cp2." - ".$provincia2; ?> | <b> <a href="#">Eliminar</a></b></p>

                                            <? } ?>
                                            

                                        
                                            <hr>
                                            <h3>Agregar Nuevo Expreso</h3>
                                        <br>
                                        
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 col-md-8">
                                                    <label>Nombre Expreso <sup>*</sup></label>
                                                    <div class="input-text">
                                                        <input type="text" name="nombreExpreso">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                    <label>Cód+Teléfono <sup>*</sup></label>
                                                    <div class="input-text">
                                                        <input type="text" name="telefonoExpreso">
                                                    </div>
                                                </div>
                                            </div>                                          

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 col-md-8">
                                                    <label>Dirección <sup>*</sup></label>
                                                    <div class="input-text">
                                                        <input type="text" name="direccionExpreso">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                    <label>Localidad <sup>*</sup></label>
                                                    <div class="input-text">
                                                        <input type="text" name="localidadExpreso">
                                                    </div>
                                                </div>
                                            </div>
                                                            
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 col-md-8">
                                                    <div class="input-text">
                                                        <label>Provincia<sup>*</sup></label>
                                                        <select class="selectpicker" data-live-search="true" name="provinciaExpreso">
                                                
                                                              <option data-tokens="Buenos Aires" value="Buenos Aires">Buenos Aires</option>
                                                              <option data-tokens="Capital Federal" value="Capital Federal">Capital Federal</option>
                                                              <option data-tokens="Catamarca" value="Catamarca">Catamarca </option>
                                                              <option data-tokens="Chaco" value="Chaco">Chaco </option>
                                                              <option data-tokens="Chubut" value="Chubut">Chubut </option>
                                                              <option data-tokens="Cordoba" value="Cordoba">Cordoba</option>
                                                              <option data-tokens="Corrientes" value="Corrientes">Corrientes </option>
                                                              <option data-tokens="Entre R&iacute;os" value="Entre R&iacute;os">Entre R&iacute;os</option>
                                                              <option data-tokens="Formosa" value="Formosa">Formosa </option>
                                                              <option data-tokens="Jujuy" value="Jujuy">Jujuy</option>
                                                              <option data-tokens="La Pampa" value="La Pampa">La Pampa</option>
                                                              <option data-tokens="La Rioja" value="La Rioja">La Rioja </option>
                                                              <option data-tokens="Mendoza" value="Mendoza">Mendoza</option>
                                                              <option data-tokens="Misiones" value="Misiones">Misiones</option>
                                                              <option data-tokens="Neuquen" value="Neuquen">Neuquen</option>
                                                              <option data-tokens="Rio Negro" value="Rio Negro">Rio Negro</option>
                                                              <option data-tokens="Salta" value="Salta">Salta</option>
                                                              <option data-tokens="San Juan" value="San Juan">San Juan</option>
                                                              <option data-tokens="San Luis" value="San Luis">San Luis </option>
                                                              <option data-tokens="Santa Cruz" value="Santa Cruz">Santa Cruz</option>
                                                              <option data-tokens="Santa Fe" value="Santa Fe">Santa Fe</option>
                                                              <option data-tokens="Santiago del Estero" value="Santiago del Estero">Santiago del Estero</option>
                                                              <option data-tokens="Tierra del Fuego" value="Tierra del Fuego">Tierra del Fuego</option>
                                                              <option data-tokens="Tucuman" value="Tucuman">Tucuman</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                    <label>Codigo Postal <sup>*</sup></label>
                                                    <div class="input-text">
                                                        <input type="text" name="cpExpreso">
                                                    </div>
                                                </div>
                                            </div>                      

                                    </div>
                                    <!-- Segundo Boton -->
                                </div>
                            </div>
                        </div>



                        <!--//////////////////////////////////////////////////////////////////////////////////////////-->
                        <!--//////////////////////////////////////////////////////////////////////////////////////////-->
                        <!--//////////////////////////////////////////////////////////////////////////////////////////-->




                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <form id="form2" name="form2" method="post" action="pedido-modificar.php">
                                    <input type="hidden" name="id_pedido" value="<? echo $id_pedido; ?>">
                                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th width="1%" class="column-title">Imagen</th>
                                                <th width="10%" class="column-title">Código</th>
                                                <th width="25%" class="column-title">Descripción</th>
                                                <th width="12%" class="column-title">Cantidad</th>
                                                <th width="12%" class="column-title">Precio Unitario</th>
                                                <th width="12%" class="column-title">Desc.</th>
                                                <th width="12%" class="column-title">Sub Total</th>
                                                <th width="16%" class="column-title no-link last"><span class="nobr">Acción</span></th>
                                            </tr>

                                        </thead>

                                        <tbody>

                                              <? 

                                                $cont=1;
                                                $result = mysql_query("SELECT * FROM det_pedidos INNER JOIN productmain ON det_pedidos.id = productmain.idProductMain  WHERE det_pedidos.id_pedido=$id_pedido ORDER BY productmain.codigo");

                                                $total=0;
                                                

                                                while ($row = mysql_fetch_array($result)) { 

                                                              $codigo=$row["codigo"];
                                                              $cantidad=$row["cantidad"];
                                                              $fecha=$row["fecha"];
                                                              $descuento=$row["descuento"];
                                                              $estado=$row["estado"];
                                                              $precio=$row["precio"];
                                                              $subtotal=$cantidad*$precio;
                                                              If ($descuento>0){

                                                                $descuento2=($subtotal*$descuento)/100;
                                                                $subtotal=$subtotal-$descuento2;

                                                              }
                                                                $id_detpedido=$row["id_detpedido"];     
                                                                $descripcion=$row2["descripcion"];

                                                                $total=$total+$subtotal;

                                                                $totalProd2=$totalProd2+$subtotal;
                                          
                                                             ?>
                                                             <input type="hidden" name="id_detpedido<? echo $cont; ?>" value="<? echo $id_detpedido; ?>">
                                                            <tr class="even pointer">
                                                                <td class=" " with="2%"><IMG SRC='../catalogo/<? echo trim ($codigo);?>.jpg' class='img-responsive' border='0'></td>      
                                                                <td class=" "><? echo $row["codigo"]; ?></td>
                                                                <td class=" "><? echo $row["descripcion"]; ?></td>
                                                                <td class=" last">
                                                                    <input name="cantidad<? echo $cont; ?>" type="text" id="cantidad" value="<? echo $cantidad; ?>" size="5" maxlength="5" onkeyUp='return ValNumero(this);'>
                                                                </td>
                                                                <td class=" ">
                                                                    $<input name="precio<? echo $cont; ?>" type="text" id="precio" value="<? echo $precio; ?>" size="5" maxlength="12">
                                                                </td>
                                                                <td class=" last">
                                                                    <input name="desc<? echo $cont; ?>" type="text" value="<? echo $descuento; ?>" size="2" maxlength="2" onkeyUp='return ValNumero(this);'> <b>%</b>
                                                                </td>                                                                
                                                                <td class=" ">
                                                                    $ <? echo money_format('%(#10n', $subtotal);?>
                                                                </td>                                                    
                                                                <td class=" ">
                                                                    <a href='_pedido-eliminar.php?id_detpedido=<? echo $id_detpedido; ?>&id_pedido=<? echo $id_pedido; ?>'>Eliminar</a>
                                                                </td>
                                                            </tr>
                                                       
                                             <?
                                             
                                             $cont=$cont+1;
                                         }
                                        $subTotalPedido=$totalProd2;

                                        $descuentoTotal2=($totalProd2*$descuentoTotal)/100;
                                        $totalProd2=$totalProd2-$descuentoTotal2;
                                        $iva=($totalProd2*21)/100;
                                        $total=$totalProd2+$iva;
                                        

                                        ?>
                                        <tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" ">DESCUENTO S/TOTAL %</td>
                                            <td class=" "></td>              
                                            <td class=" "><input name="descuentoTotal" type="text" value="<? echo $descuentoTotal; ?>" size="2" maxlength="2" onkeyUp='return ValNumero(this);'> <b>%</b></td>       
                                            <td></td>    
                                        </tr>
                                         <tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" ">SUB-TOTAL</td>
                                            <td class=" "></td>              
                                            <td class=" ">$ <? echo money_format('%(#10n', $subTotalPedido);?></td>       
                                            <td></td>    
                                        </tr>
                                        <tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" ">DESCUENTO S/TOTAL</td>
                                            <td class=" "></td>              
                                            <td class=" ">- ($ <? echo money_format('%(#10n', $descuentoTotal2);?>)</td>       
                                            <td></td>    
                                        </tr>                                        
                                        <tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" ">IVA</td>
                                            <td class=" "></td>              
                                            <td class=" ">$ <? echo money_format('%(#10n', $iva);?></td>           
                                            <td></td>
                                        </tr>             
                                        <tr>
                                            <td class=" "></td>
                                            <td class=" "></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" ">TOTAL</td>
                                            <td class=" "></td>              
                                            <td class=" "><strong>$ <? echo money_format('%(#10n', $total);?></strong></td>           
                                            <td></td>
                                        </tr>                                                                                  

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><a href="pedidos-agregar.php?id_pedido=<? echo $id_pedido; ?>" class="btn btn-primary">Agregar Producto</a> <a href="pedido-detalle-enviar.php?id_pedido=<? echo $id_pedido; ?>" class="btn btn-primary">Enviar Presupuesto</a></td>
                                                <td></td>
                                                <td></td>
                                                <td></td><td></td>
                                                <td></td>
                                                <input type="hidden" name="cont" value="<? echo $cont; ?>"> 
                                                <td><button type="submit" class="btn btn-success">Actualizar</button></td>
                                            </tr>
                                        </tfoot>
                                    </table>  
                                    </form>                                  
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
    <script src="js/JAVA.JS"></script>

</body>

</html>