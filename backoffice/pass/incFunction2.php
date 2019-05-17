<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

function encriptar($string, $key)
{
    $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_URANDOM );
    mcrypt_generic_init($td, $key, $iv);
    $encrypted_data_bin = mcrypt_generic($td, $string);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    $encrypted_data_hex = bin2hex($iv).bin2hex($encrypted_data_bin);
    return $encrypted_data_hex;
}
 
function desencriptar($encrypted_data_hex, $key)
{
    $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
    $iv_size_hex = mcrypt_enc_get_iv_size($td)*2;
    $iv = pack("H*", substr($encrypted_data_hex, 0, $iv_size_hex));
    $encrypted_data_bin = pack("H*", substr($encrypted_data_hex, $iv_size_hex));
    mcrypt_generic_init($td, $key, $iv);
    $decrypted = mdecrypt_generic($td, $encrypted_data_bin);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    return $decrypted;
}



function resultadoConsultaProducto($word){
    include ("connect2.php");
    
    $likeString = '%'.$word.'%';

    $sql = "SELECT idProductMain, codigo, descripcion, precionegocios FROM productmain";
    $stmt = $mysqli->prepare($sql);
    

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idProductMain, $codigo, $descripcion, $precionegocios);




        echo"<div class='table-responsive'>
            <table class='table table-hover'>
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>";
        
        while ($stmt->fetch()) { 
        
            echo"<tr>
                
                <td><b>".$codigo."</b></td>
                <td>".$descripcion."</td>
                <td><b>".$precionegocios."</b></td>
                <td><a href='carrito.php?idProductMain=".$idProductMain."'> Agregar</a></td>
               
            </tr>";
        }
            
        echo "        </tbody>
            </table>
        </div>";

}



////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////




function obtenerArchivoPreview($id){

    include ("connect.php");

    $sql  = "SELECT id_pedido_item_detalle FROM pedido_item_detalle WHERE idPedido = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id) or die($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($id_pedido_item_detalle);
    $stmt->fetch();
    
    include ("connect.php");

    $sql  = "SELECT idArchivo, id, nombreArchivo, textoArchivo FROM archivos WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id_pedido_item_detalle) or die($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($idArchivo, $id, $nombreArchivo, $textoArchivo);
    If ($stmt->fetch()) { 

        $archivo = $nombreArchivo;
        $trozos = explode(".", $archivo);
        $extension = end($trozos);

        If ($extension == "pdf"){
            echo "<iframe src='http://docs.google.com/gview?url=http://www.newbag.com.ar/backoffice2/main/archivos/".$nombreArchivo."&embedded=true#:0.page.20' width='100%' height='300' frameborder='2'></iframe>";
        }

        If ($extension == "jpg"){
            echo "<img src='archivos/".$nombreArchivo."' class='img-responsive'>";
        }

    }
        
}

function obtenerArchivoPreviewPrint($id){

    include ("connect.php");

    $sql  = "SELECT id_pedido_item_detalle FROM pedido_item_detalle WHERE idPedido = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id) or die($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($id_pedido_item_detalle);
    $stmt->fetch();
    
    include ("connect.php");

    $sql  = "SELECT idArchivo, id, nombreArchivo, textoArchivo FROM archivos WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id_pedido_item_detalle) or die($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($idArchivo, $id, $nombreArchivo, $textoArchivo);
    If ($stmt->fetch()) { 

        $archivo = $nombreArchivo;
        $trozos = explode(".", $archivo);
        $extension = end($trozos);

        If ($extension == "pdf"){
            echo "<iframe src='http://docs.google.com/gview?url=http://www.newbag.com.ar/backoffice2/main/archivos/".$nombreArchivo."&embedded=true#:0.page.20' width='200' height='350' frameborder='2'></iframe>";
        }

        If ($extension == "jpg"){
            echo "<img src='archivos/".$nombreArchivo."' class='img-responsive'>";
        }

    }
        
}


function obtenerArchivo($id){

    include ("connect.php");

    $sql  = "SELECT idArchivo, id, nombreArchivo, textoArchivo FROM archivos WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id) or die($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($idArchivo, $id, $nombreArchivo, $textoArchivo);
    echo "<h4>Archivos </h4>";
    while ($stmt->fetch()) { 
        echo "<div class='col-sm-3'>";
        //<iframe src='http://docs.google.com/gview?url=http://www.newbag.com.ar/backoffice2/main/archivos/".$nombreArchivo."&embedded=true#:0.page.20' width='300' height='200' frameborder='2'></iframe>
        
            echo $textoArchivo;
        echo "</div>
        <div class='col-sm-2'>
            <a href='archivos/".$nombreArchivo."' target='_blank' class='btn btn-info m-r-15' role='button'>Descargar</a>
        </div>
        <div class='col-sm-7'>
            <a href='pedido-item-archivo-eliminar.php?idArchivo=".$idArchivo."' class='btn btn-danger waves-effect waves-light' role='button'>Eliminar</a>
        </div>";
        echo "<div class='row'><hr></div>";
        
    }
        echo "<br><br>";
}


function formularioArchivo($id){

    echo "<h4>Adjuntar Archivo </h4>
    <form action='pedido-item-archivos.php' method='post' enctype='multipart/form-data' name='form1'  class='form-horizontal form-label-left'>
    <input type='hidden' name='id' value='".$id."'>

    <div class='form-group'>
    <label class='control-label col-md-1 col-sm-1 col-xs-12'>Titulo: </label>
    <div class='col-md-11 col-sm-11 col-xs-12'>
    <textarea class='form-control' name='textoArchivo' rows='1'></textarea>
    </div>
    </div>

    <div class='form-group'>
    <label class='control-label col-md-1 col-sm-1 col-xs-12'>Archivo: </label>
    <div class='col-md-11 col-sm-11 col-xs-12'>
    <input type='file' name='archivo' id='archivo' class='input'>
    </div>
    </div>


    <div class='ln_solid'></div>
    <div class='form-group'>
    <div class='col-md-11 col-sm-11 col-xs-12 col-md-offset-1'>
    <button type='submit' class='btn btn-success'>Agregar</button>
    </div>
    </div>
    </form>";
}

function enlaceActualizacion($estado, $idPedido, $nivel, $estadoPagos){
	switch($estado)
	    {
	        case "0":  

                If ($nivel==100 OR  $nivel==0){
                    echo  "<a href='pedido-insumos.php?idPedido=".$idPedido."' class='btn btn-primary btn-lg btn-block'>Actualizar </a>"; 
                }
                break;
	        
	        case "1":  
	        	If ($nivel==100 OR $nivel==0){
	        		echo  "<a href='pedido-insumos.php?idPedido=".$idPedido."' class='btn btn-primary btn-lg btn-block'>Actualizar Insumos</a>"; 
	        	}
	        	break;

	        case "2":  

                If ($nivel==100 OR $nivel==1){
                    echo  "<a href='pedido-programacion.php?idPedido=".$idPedido."' class='btn btn-primary btn-lg btn-block'>Actualizar Programación</a>"; 
                }
                    break;
	        case "3":  
                If ($nivel==100 OR $nivel==2){
                    echo  "<a href='pedido-impresion.php?idPedido=".$idPedido."' class='btn btn-primary btn-lg btn-block'>Actualizar Impresión</a>"; 
                }
                break;
	        case "4":  
                If ($nivel==100 OR $nivel==1){
                    echo  "<a href='pedido-produccion.php?idPedido=".$idPedido."' class='btn btn-primary btn-lg btn-block'>Actualizar Producción</a>"; 
                }
                    break;
	        case "5":  
                If ($nivel==100 OR $nivel==4){
                    echo  "<a href='pedido-deposito.php?idPedido=".$idPedido."' class='btn btn-primary btn-lg btn-block'>Actualizar Depósito</a>"; 
                }
                break;
	        case "6":  
                If ($nivel==100 OR $nivel==4){
                    echo  "<a href='pedido-entrega.php?idPedido=".$idPedido."' class='btn btn-primary btn-lg btn-block'>Actualizar Entrega</a>"; 
                }
                break;

            case "7":  
                    if ($estadoPagos==1){
                        echo  "<a href='#' class='btn btn-primary btn-lg btn-block'>Pedido Finalizado</a>"; 
                    }else{
                        echo  "<a href='#' class='btn btn-primary btn-lg btn-block'>Pedido Pendiente de Pagos</a>"; 
                    }


                    break;
            
	        
	    }



}
function bolsaNombre($tipoBolsa){

    switch($tipoBolsa)
        {
            case "1":  $titBolsa = "BOLSA TROQUELADA CON FUELLE INFERIOR"; break;
            case "2":  $titBolsa = "BOLSA SIN FUELLE CON MANIJA"; break;    
            case "3":  $titBolsa = "BOLSA CUADRADA"; break;
            case "4":  $titBolsa = "BOLSA TROQUELADA SIN FUELLE"; break;
            case "5":  $titBolsa = "BOLSA CON FUELLE INFERIOR Y MANIJA"; break; 
            case "6":  $titBolsa = "MOCHILA"; break;
            case "7":  $titBolsa = "CIERRE AJUSTABLE"; break;
            case "8":  $titBolsa = "CAMISETA"; break;
        }

    return $titBolsa;
}


function verEstado($estado, $estadoPagos){
	switch($estado)
	{
		case "0":  $estadoVista = "ALTA PEDIDO"; break;
		case "1":  $estadoVista = "PENDIENTE INSUMOS"; break;	
		case "2":  $estadoVista = "PENDIENTE PROGRAMACION"; break;
		case "3":  $estadoVista = "PENDIENTE IMPRESION"; break;
		case "4":  $estadoVista = "PENDIENTE PRODUCCION"; break;	
		case "5":  $estadoVista = "PENDIENTE DEPOSITO"; break;
		case "6":  $estadoVista = "PENDIENTE ENTREGA"; break;
		case "7":  
                If($estadoPagos==1){
                    $estadoVista = "FINALIZADO"; 
                }else{
                    $estadoVista = "PENDIENTE PAGOS"; 
                }
                break;
        
	}
	return $estadoVista;
}


function consultaPersona($idPersona){
	include ("connect.php");
    $sql = "SELECT nombres, apellidos FROM personas WHERE idPersona = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPersona)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
	$stmt->bind_result($nombres, $apellidos);
	

	If ($stmt->fetch()){
		echo "<h6><small>Responsable: ".$nombres." ".$apellidos."</small></h6>";
	} else {
		echo "<h6><small>Responsable: No hay datos.</small></h6>";
		
	}

}

function consultaEntrega($idPedido){
	include ("connect.php");
    $sql = "SELECT idPedidoEntrega, idPersona, fechaEntrega, remito, fecha, unidades, flete, observaciones FROM pedido_entrega WHERE idPedido = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
	$stmt->bind_result($idPedidoEntrega, $idPersona, $fechaEntrega, $remito, $fecha, $unidades, $flete, $observaciones);



    
    
    $flag=0;
    while ($stmt->fetch()) { 
        If ($flag==0){
            echo "<div class='white-box'>
            <div class='row'>
                <div class='col-sm-12 col-xs-12'>
                        <h2>ENTREGA</h2>";
            $flag=1;
        }

        echo "<div class='col-sm-12 col-xs-12'>
        <p class='text-info'>Fecha Entrega: ".cambiaf_a_normal($fechaEntrega)."</p>
        <p class='text-info'>Remito: ".$remito."</p>
        <p class='text-info'>Unidades: ".$unidades."</p>
        <p class='text-info'>Flete: ".$flete."</p>
        <p class='text-info'>Observaciones: ".$observaciones."</p>";
        consultaPersona($idPersona);
        
        If ($_SESSION['nivel']==100 OR $_SESSION['nivel']==4){ 
            echo "<a href='pedido-entrega-edit.php?idPedido=".$idPedido."&idPedidoEntrega=".$idPedidoEntrega."' class='btn btn-outline btn-info'>Editar</a>";

        }
        echo "<hr>
        </div>";
    }
    If ($flag==1){
        echo "            </div>

        </div>
        </div> ";
    }

}

function consultaEntregaPrint($idPedido){
    include ("connect.php");
    $sql = "SELECT idPedidoEntrega, idPersona, fechaEntrega, remito, fecha, unidades, flete, observaciones FROM pedido_entrega WHERE idPedido = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPedidoEntrega, $idPersona, $fechaEntrega, $remito, $fecha, $unidades, $flete, $observaciones);



    
    
    
    while ($stmt->fetch()) { 

            echo " 
            <h3>ENTREGA</h3>";


        echo "
        Fecha Entrega: ".cambiaf_a_normal($fechaEntrega)."</br>
        Remito: ".$remito."</br>
        Unidades: ".$unidades."</br>
        Flete: ".$flete."</br>
        Observaciones: ".$observaciones."</br>";
    

        consultaPersona($idPersona);

    }

}


function consultaDeposito($idPedido){
	include ("connect.php");
    $sql = "SELECT idPedidoDeposito, idPersona, depositoSector, depositoSeccion, fechaDeposito, observaciones FROM pedido_deposito WHERE idPedido = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
	$stmt->bind_result($idPedidoDeposito, $idPersona, $depositoSector, $depositoSeccion, $fechaDeposito, $observaciones);
	$stmt->fetch();
	$datos = array($idPedidoDeposito, $idPersona, $depositoSector, $depositoSeccion, $fechaDeposito, $observaciones);
	return $datos;
}

function consultaProduccion($idPedido){
	include ("connect.php");
    $sql = "SELECT idPedidoProduccion, idPersona, fechaProduccionFin, fechaProduccion, unidades, observaciones FROM pedido_produccion WHERE idPedido = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
	$stmt->bind_result($idPedidoProduccion, $idPersona, $fechaProduccionFin, $fechaProduccion, $unidades, $observaciones);
	$stmt->fetch();
	$datos = array($idPedidoProduccion, $idPersona, $fechaProduccionFin, $fechaProduccion, $unidades, $observaciones);
	return $datos;
}

function consultaFacturacion($idPedido){
    include ("connect.php");
    $sql = "SELECT idPedidoFacturacion, idPersona, fechaFacturacion, fechaFactura, factura, observaciones, importe FROM pedido_facturacion WHERE idPedido = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPedidoFacturacion, $idPersona, $fechaFacturacion, $fechaFactura, $factura, $observaciones, $importe);

    
    $cont=0;
    $flag=0;
    
    while ($stmt->fetch()) { 
        
        If ($cont==0){
        $flag=1;
        echo "<div class='white-box'>
            <div class='row'>
                <div class='col-sm-12 col-xs-12'>
                        <h2>FACTURACION</h2>";
        }

        echo "<div class='col-sm-12 col-xs-12'>
        <p class='text-info'>Fecha Factura: ".cambiaf_a_normal($fechaFactura)."</p>
        <p class='text-info'>Factura: ".$factura."</p>
        <p class='text-info'><b>Importe: ".$importe."</b></p>
        <p class='text-info'>Observaciones: ".$observaciones."</p>";
        consultaPersona($idPersona);
        
        If ($_SESSION['nivel']==100 OR $_SESSION['nivel']==6){ 
            
            echo "<a href='pedido-facturacion-edit.php?idPedido=".$idPedido."&idPedidoFacturacion=".$idPedidoFacturacion."' class='btn btn-outline btn-info'>Editar</a>  <a href='pedido-facturas-eliminar.php?idPedido=".$idPedido."&idPedidoFacturacion=".$idPedidoFacturacion."' class='btn btn-warning waves-effect waves-light' onclick='return confirma_delete();'>Eliminar</a>";
        } 
        echo "<hr>";
        echo "</div>";
        $cont++;
    }
    If ($flag==1){
    echo "            </div>

        
        </div>
        </div> ";
    }

}





function consultaPagos($idPedido){
    include ("connect.php");
    //$sql = "SELECT idPedidoPago, idPersona, fechaPago, fechaPagoTent, fechaPagoReal, recibo, observaciones FROM pedido_pagos WHERE idPedido = ?";

    $sql  = "SELECT idPedidoPago, pedido_pagos.idPersona, fechaPago, fechaPagoTent, fechaPagoReal, recibo, pedido_pagos.observaciones, importe, pedidos.estadoPagos FROM pedido_pagos INNER JOIN pedidos ON pedido_pagos.idPedido = pedidos.idPedido WHERE pedido_pagos.idPedido = ?";

    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPedidoPago, $idPersona, $fechaPago, $fechaPagoTent, $fechaPagoReal, $recibo, $observaciones, $importe, $estadoPagos);

    $flag=0;
    
    while ($stmt->fetch()) { 
        
        If ($flag==0){

            echo "<div class='white-box'>
            <div class='row'>
                <div class='col-sm-12 col-xs-12'>
                        <h2>PAGOS</h2>";
            $flag=1;
        }

        echo "<div class='col-sm-12 col-xs-12'>
        <p class='text-info'>Fecha Pago Prevista: ".cambiaf_a_normal($fechaPagoTent)."</p>
        <p class='text-info'>Fecha Pago Real: ".cambiaf_a_normal($fechaPagoReal)."</p>
        <p class='text-info'>Recibo: ".$recibo."</p>
        <p class='text-info'><b>Importe: $".$importe."</b></p>
        <p class='text-info'>Observaciones: ".$observaciones."</p>";
        consultaPersona($idPersona);
         
        If ($_SESSION['nivel']==100 OR $_SESSION['nivel']==6){ 
            echo "<a href='pedido-pagos-edit.php?idPedido=".$idPedido."&idPedidoPago=".$idPedidoPago."' class='btn btn-outline btn-info'>Editar</a> <a href='pedido-pagos-eliminar.php?idPedido=".$idPedido."&idPedidoPago=".$idPedidoPago."' class='btn btn-warning waves-effect waves-light' onclick='return confirma_delete();'>Eliminar</a>";
        } 
        echo "<hr>";
        echo "</div>";
    }
    If ($flag==1){

        echo "            </div>
        </div>
        </div> ";
    }
}



function consultaImpresion($idPedido){
	include ("connect.php");
    $sql = "SELECT idPedidoImpresion, idPersona, fechaImpresionFin, fechaImpresion, unidades, observaciones FROM pedido_impresion WHERE idPedido = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
	$stmt->bind_result($idPedidoImpresion, $idPersona, $fechaImpresionFin, $fechaImpresion, $unidades, $observaciones);
	$stmt->fetch();
	$datos = array($idPedidoImpresion, $idPersona, $fechaImpresionFin, $fechaImpresion, $unidades, $observaciones);
	return $datos;
}

function consultaProgramacion($idPedido){
	include ("connect.php");
    $sql = "SELECT idPedidoProgramacion, idPersona, programacionImpresion, programacionConfeccion, fechaProgramacion, observaciones FROM pedido_programacion WHERE idPedido = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
	$stmt->bind_result($idPedidoProgramacion, $idPersona, $programacionImpresion, $programacionConfeccion, $fechaProgramacion, $observaciones);
	$stmt->fetch();
	$datos = array($idPedidoProgramacion, $idPersona, $programacionImpresion, $programacionConfeccion, $fechaProgramacion, $observaciones);
	return $datos;
}

function consultaInsumos($idPedido){
	include ("connect.php");
    $sql = "SELECT idPedidoInsumo, idPersona, insumosTela, insumosManija, insumosTintas, insumosPolimero, fechaInsumosPedido, fechaInsumos, observaciones FROM pedido_insumos WHERE idPedido = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
	$stmt->bind_result($idPedidoInsumo, $idPersona, $insumosTela, $insumosManija, $insumosTintas, $insumosPolimero, $fechaInsumosPedido, $fechaInsumos, $observaciones);
	$stmt->fetch();
	$datos = array($idPedidoInsumo, $idPersona, $insumosTela, $insumosManija, $insumosTintas, $insumosPolimero, $fechaInsumosPedido, $fechaInsumos, $observaciones);
	return $datos;
}




function consultaEmpresa($idEmpresa){
	include ("connect.php");
    $sql = "SELECT nombre, cuit, direccion, localidad, provincia, pais, telefono, email, web, tipo, idRubro FROM empresas WHERE idEmpresa = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idEmpresa)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
	$stmt->bind_result($nombre, $cuit, $direccion, $localidad, $provincia, $pais, $telefono, $email, $web, $tipo, $idRubro);
	$stmt->fetch();
	$datos = array($nombre, $cuit, $direccion, $localidad, $provincia, $pais, $telefono, $email, $web, $tipo, $idRubro);
	return $datos;
}


function consulta_pedido($idPedido){
	include ("connect.php");
    $sql  = "SELECT precio, idEmpresa, idMarca, fechaPedido, fechaEntrega, observaciones, idPersona, fecha, estado, estadoPagos, embalaje, direccionEntrega, vendedor FROM pedidos WHERE idPedido=?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
	$stmt->bind_result($precio, $idEmpresa, $idMarca, $fechaPedido, $fechaEntrega, $observaciones, $idPersona, $fecha, $estado, $estadoPagos, $embalaje, $direccionEntrega, $vendedor);
	$stmt->fetch();
	$datos = array($precio, $idEmpresa, $idMarca, $fechaPedido, $fechaEntrega, $observaciones, $idPersona, $fecha, $estado, $estadoPagos, $embalaje, $direccionEntrega, $vendedor);
	return $datos;
}


function consulta_item_pedido($idPedido){
    include ("connect.php");

    $sql = "SELECT id_pedido_item_detalle, tipoBolsa, cantidad, descripcion, precio, logo, tamAlto, tamAncho, tamFuelle, tamFuelleInferior, friselinaGramaje, friselinaColor, manijaColor, manijaLargo, cordonColor, cordonLargo, cordonEspesor, tipoImpLaminado, serigrafiaColor, flexoColor1, flexoColor2, flexoColor3, flexoColor4, necesidadImpresionTela, necesidadImpresionManija, necesidadImpresionTintas, necesidadImpresionTipo, observaciones FROM pedido_item_detalle WHERE idPedido = ?";

    $stmt2= $mysqli->prepare($sql);
    if(!$stmt2->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt2->execute();
    $stmt2->store_result();
    $stmt2->bind_result($id_pedido_item_detalle, $tipoBolsa, $cantidad, $descripcion, $precio, $logo, $tamAlto, $tamAncho, $tamFuelle, $tamFuelleInferior, $friselinaGramaje, $friselinaColor, $manijaColor, $manijaLargo, $cordonColor, $cordonLargo, $cordonEspesor, $tipoImpLaminado, $serigrafiaColor, $flexoColor1, $flexoColor2, $flexoColor3, $flexoColor4, $necesidadImpresionTela, $necesidadImpresionManija, $necesidadImpresionTintas, $necesidadImpresionTipo, $observaciones);
    $stmt2->fetch();
    $datos = array($id_pedido_item_detalle, $tipoBolsa, $cantidad, $descripcion, $precio, $logo, $tamAlto, $tamAncho, $tamFuelle, $tamFuelleInferior, $friselinaGramaje, $friselinaColor, $manijaColor, $manijaLargo, $cordonColor, $cordonLargo, $cordonEspesor, $tipoImpLaminado, $serigrafiaColor, $flexoColor1, $flexoColor2, $flexoColor3, $flexoColor4, $necesidadImpresionTela, $necesidadImpresionManija, $necesidadImpresionTintas, $necesidadImpresionTipo, $observaciones);
    return $datos;    

}


function resultadoItemsPedido($idPedido, $idPersona){
	include ("connect.php");

    $sql = "SELECT id_pedido_item_detalle, tipoBolsa, cantidad, descripcion, precio, logo, tamAlto, tamAncho, tamFuelle, tamFuelleInferior, friselinaGramaje, friselinaColor, manijaColor, manijaLargo, cordonColor, cordonLargo, cordonEspesor, tipoImpLaminado, serigrafiaColor, flexoColor1, flexoColor2, flexoColor3, flexoColor4, necesidadImpresionTela, necesidadImpresionManija, necesidadImpresionTintas, necesidadImpresionTipo, observaciones, polimero FROM pedido_item_detalle WHERE idPedido = ?";

    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id_pedido_item_detalle, $tipoBolsa, $cantidad, $descripcion, $precio, $logo, $tamAlto, $tamAncho, $tamFuelle, $tamFuelleInferior, $friselinaGramaje, $friselinaColor, $manijaColor, $manijaLargo, $cordonColor, $cordonLargo, $cordonEspesor, $tipoImpLaminado, $serigrafiaColor, $flexoColor1, $flexoColor2, $flexoColor3, $flexoColor4, $necesidadImpresionTela, $necesidadImpresionManija, $necesidadImpresionTintas, $necesidadImpresionTipo, $observaciones, $polimero);

	$flag=0;
		If ($stmt->fetch()) { 
            $flag=1;
            echo "<div class='white-box'>
                            <div class='row'>
                                <div class='col-sm-3'>
                                    <h2><b>".$descripcion."</b></h2>
                                    <h4>".bolsaNombre($tipoBolsa)."</h4>
                                    <h2>Cantidad</h2>
                                    <h1><b>".$cantidad."</b></h1>
                                    <hr>";
                                    If ($_SESSION["nivel"]==100 OR $_SESSION["nivel"]==0){ 
                                        echo "<a class='btn btn-warning waves-effect waves-light' href='pedido-item-editar.php?tipoBolsa=".$tipoBolsa."&id_pedido_item_detalle=".$id_pedido_item_detalle."'>Modificar</a>
                                            <a class='btn btn-danger waves-effect waves-light' href='pedido-item-eliminar.php?id_pedido_item_detalle=".$id_pedido_item_detalle."'>Eliminar</a>";
                                    }
                                echo "</div>
                                <div class='col-sm-3'>
                                    <h2>Tamaño</h2>
                                    <p><i class='ti-arrows-vertical'></i> Alto <b>".$tamAlto."</b></p>
                                    <p><i class='ti-arrows-horizontal'></i> Ancho <b>".$tamAncho."</b></p>";
                                    If ($tipoBolsa==1) {
                                        echo "<p><i class='ti-split-v-alt'></i> Fuelle <b>".$tamFuelle."</b></p>";
                                    }
                                    If ($tipoBolsa==3 OR $tipoBolsa==8) {
                                        echo "<p><i class='ti-split-v-alt'></i> Fuelle Lateral <b>".$tamFuelle."</b></p>";
                                    }
                                    If ($tipoBolsa==3 OR $tipoBolsa==5) {
                                        echo "<p><i class='ti-split-v-alt'></i> Fuelle Inferior <b>".$tamFuelleInferior."</b></p>";
                                    }
                                    echo "<hr>";
                                    If ($tipoBolsa==2 OR $tipoBolsa==5 OR $tipoBolsa==3) {
                                        echo "<h2>Manija</h2>
                                        <p><i class='ti-layout-grid3'></i> Color <b>".$manijaColor."</b></p>
                                        <p><i class=' ti-back-right'></i> Largo <b>".$manijaLargo."</b></p>
                                        ";
                                    } else {
                                        echo "<h2>Manija</h2>
                                        <p>Troquelada</p>
                                        ";
                                    }

                                    If ($tipoBolsa==7 OR $tipoBolsa==6) {
                                        echo "<hr><h2>Cordón</h2>
                                        <p><i class='ti-layout-grid3'></i> Cordón Color <b>".$cordonColor."</b></p>
                                        <p><i class=' ti-back-right'></i> Cordon Largo cm. <b>".$cordonLargo."</b></p>
                                        <p><i class=' ti-back-right'></i> Cordon Espesor <b>".$cordonEspesor."</b></p>";
                                    }

                                echo "</div>
                                <div class='col-sm-3'>
                                    <h2>Friselina Bolsa</h2>
                                    <p><i class='ti-arrows-vertical'></i> Gramaje <b>".$friselinaGramaje."</b></p>
                                    <p><i class='ti-layout-grid3'></i> Color <b>".$friselinaColor."</b></p>
                                    
                                    <hr>                                

                                    <h2>Necesidades / Impresión</h2>
                                    <p><i class='ti-layers-alt'></i> Tela <b>".$necesidadImpresionTela."</b></p>  
                                    <p><i class='ti-arrows-vertical'></i> Manija <b>".$necesidadImpresionManija."</b></p>
                                    <p><i class='ti-paint-bucket '></i> Tintas en Kg. <b>".$necesidadImpresionTintas."</b></p> 


                                    
                                </div>
                                
                                <div class='col-sm-3'>
                                    <h2>Tipo Impresión</h2>
                                    <p><i class='ti-arrows-vertical'></i> Tipo: <b>".$tipoImpLaminado."</b></p>
                                    <p><i class='ti-layout-grid3'></i> Serigrafia Color: <b>".$serigrafiaColor."</b></p>
                                    <p><i class='ti-layout-grid3'></i> Flexografía Color: <b>".$flexoColor1."</b></p>
                                    <p><i class='ti-layout-grid3'></i> Flexografía Color: <b>".$flexoColor2."</b></p>
                                    <p><i class='ti-layout-grid3'></i> Flexografía Color: <b>".$flexoColor3."</b></p>
                                    <p><i class='ti-layout-grid3'></i> Flexografía Color: <b>".$flexoColor4."</b></p>
                                    <hr>
                                    <h2>Logo Newbag</h2>
                                    <p><b>";
                                    If ($logo==1) {
                                        echo "SI";
                                    } else {
                                        echo "NO";
                                    }
                                    echo "</b></p>

                                </div>

                            </div>
                            <hr>
                            <div class='row'>
                             
                                <div class='col-sm-3'>
                                    <h2>Descripción</h2>
                                    <p>".$descripcion."</p>
                                </div>
                                <div class='col-sm-3'>
                                    <h2>Observaciones</h2>
                                    <p>".$observaciones."</p>
                                </div>";
                                If ($_SESSION["nivel"]==100 OR $_SESSION["nivel"]==0 OR $_SESSION["nivel"]==6){ 
                                echo "<div class='col-sm-3'>
                                    <h2>Precio por Unidad</h2>
                                    <h2><b>$ ".$precio."</b></h2>
                                </div>                                
                                <div class='col-sm-3'>
                                    <h2>Precio Polimero</h2>
                                    <h2><b>$ ".$polimero."</b></h2>
                                </div>";
                                }
                            echo "</div><hr>";
                            obtenerArchivo($id_pedido_item_detalle);
                            formularioArchivo($id_pedido_item_detalle);
                    echo "</div>";

                    

                   
        } else {

                        echo "<div class='white-box'>
                            <h2>AGREGAR DETALLE DEL PEDIDO</h2>
                          <div class='panel-group' id='accordion-test-1'>";
                            echo "<div class='panel panel-success'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'> <a data-toggle='collapse' data-parent='#accordion-test-1' href='#collapseCinco-1' class='collapsed' aria-expanded='false'> BOLSA CON FUELLE INFERIOR Y MANIJA </a> </h4>
                                </div>
                                <div id='collapseCinco-1' class='panel-collapse collapse'>
                                    <div class='panel-body'>";
                                        include ('inc-detalle05.php');
                                echo "    </div>
                                </div>
                            </div>";
                            echo "<div class='panel panel-success'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'> <a data-toggle='collapse' data-parent='#accordion-test-1' href='#collapseTwo-1' class='collapsed' aria-expanded='false'> BOLSA SIN FUELLE CON MANIJA </a> </h4>
                                </div>
                                <div id='collapseTwo-1' class='panel-collapse collapse '>
                                    <div class='panel-body'>";
                                            include ('inc-detalle02.php');
                                echo "    </div>
                                </div>";
                            echo "</div>";
                            echo "<div class='panel panel-success'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'> <a data-toggle='collapse' data-parent='#accordion-test-1' href='#collapseOne-1' aria-expanded='false' class='collapsed'> BOLSA TROQUELADA CON FUELLE INFERIOR </a> </h4>
                                </div>
                                <div id='collapseOne-1' class='panel-collapse collapse'>
                                    <div class='panel-body'>";
                                        include ('inc-detalle01.php');
                                echo "    </div>
                                </div>
                            </div>";
                            echo "<div class='panel panel-success'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'> <a data-toggle='collapse' data-parent='#accordion-test-1' href='#collapseFour-1' class='collapsed' aria-expanded='false'> BOLSA TROQUELADA SIN FUELLE </a> </h4>
                                </div>
                                <div id='collapseFour-1' class='panel-collapse collapse'>
                                    <div class='panel-body'>";
                                        include ('inc-detalle04.php');
                                echo "  </div>
                                </div>
                            </div>";

                            
                            
                            echo "<div class='panel panel-success'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'> <a data-toggle='collapse' data-parent='#accordion-test-1' href='#collapseThree-1' class='collapsed' aria-expanded='false'> BOLSA CUADRADA </a> </h4>
                                </div>
                                <div id='collapseThree-1' class='panel-collapse collapse'>
                                    <div class='panel-body'>";
                                        include ('inc-detalle03.php');
                                echo "    </div>
                                </div>
                            </div>";
                            
                            echo "<div class='panel panel-success'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'> <a data-toggle='collapse' data-parent='#accordion-test-1' href='#collapseSeis-1' class='collapsed' aria-expanded='false'> MOCHILA </a> </h4>
                                </div>
                                <div id='collapseSeis-1' class='panel-collapse collapse'>
                                    <div class='panel-body'>";
                                        include ('inc-detalle06.php');
                                echo "     </div>
                                </div>
                            </div>";
                            echo "<div class='panel panel-success'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'> <a data-toggle='collapse' data-parent='#accordion-test-1' href='#collapseSiete-1' class='collapsed' aria-expanded='false'> CIERRE AJUSTABLE </a> </h4>
                                </div>
                                <div id='collapseSiete-1' class='panel-collapse collapse'>
                                    <div class='panel-body'>";
                                        include ('inc-detalle06.php');
                                echo "     </div>
                                </div>
                            </div>";
                            echo "<div class='panel panel-success'>
                                <div class='panel-heading'>
                                    <h4 class='panel-title'> <a data-toggle='collapse' data-parent='#accordion-test-1' href='#collapseOcho-1' class='collapsed' aria-expanded='false'> CAMISETA </a> </h4>
                                </div>
                                <div id='collapseOcho-1' class='panel-collapse collapse'>
                                    <div class='panel-body'> ";
                                        include ('inc-detalle08.php');
                                 echo "   </div>
                                </div>
                            </div>";

                        echo "</div>";

        }

        consultaPersona($idPersona);

        if ($flag==1){
            echo "<div class='white-box'>
            <a class='btn btn-info m-r-15' role='button' href='pedido.php?idPedido=".$idPedido."'>Finalizar</a>
            </div>";  
        }


}

function resultadoItemsPedidoPrint($idPedido, $idPersona){
    include ("connect.php");

    $sql = "SELECT id_pedido_item_detalle, tipoBolsa, cantidad, descripcion, precio, logo, tamAlto, tamAncho, tamFuelle, tamFuelleInferior, friselinaGramaje, friselinaColor, manijaColor, manijaLargo, cordonColor, cordonLargo, cordonEspesor, tipoImpLaminado, serigrafiaColor, flexoColor1, flexoColor2, flexoColor3, flexoColor4, necesidadImpresionTela, necesidadImpresionManija, necesidadImpresionTintas, necesidadImpresionTipo, observaciones FROM pedido_item_detalle WHERE idPedido = ?";

    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPedido)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id_pedido_item_detalle, $tipoBolsa, $cantidad, $descripcion, $precio, $logo, $tamAlto, $tamAncho, $tamFuelle, $tamFuelleInferior, $friselinaGramaje, $friselinaColor, $manijaColor, $manijaLargo, $cordonColor, $cordonLargo, $cordonEspesor, $tipoImpLaminado, $serigrafiaColor, $flexoColor1, $flexoColor2, $flexoColor3, $flexoColor4, $necesidadImpresionTela, $necesidadImpresionManija, $necesidadImpresionTintas, $necesidadImpresionTipo, $observaciones);

    $flag=0;
        If ($stmt->fetch()) { 
            $flag=1;
            echo "<hr><h3>Cantidad: <b>".$cantidad." | Tipo: </b>".bolsaNombre($tipoBolsa)."</h3>
            <table border=0 width=100%>
              <!-- Cabecera -->
              <tr>
                <th></th>   <!-- Celda de cabecera de la columna 1 -->
                <th></th>   <!-- Celda de cabecera de la columna 2 -->
                <th></th>   <!-- Celda de cabecera de la columna 2 -->
                <th></th>   <!-- Celda de cabecera de la columna 2 -->
                <th></th>   <!-- Celda de cabecera de la columna 2 -->
                <th></th>   <!-- Celda de cabecera de la columna 2 -->    
                
              </tr>
              <tr>
                                <td style='padding: 15px;' valign='top'>
                                        <h3>Tamaño</h2>
                                         Alto <b>".$tamAlto."</b><br>
                                         Ancho <b>".$tamAncho."</b><br>";
                                        If ($tipoBolsa==1) {
                                            echo " Fuelle <b>".$tamFuelle."</b><br>";
                                        }
                                        If ($tipoBolsa==3 OR $tipoBolsa==8) {
                                            echo " Fuelle Lateral <b>".$tamFuelle."</b><br>";
                                        }
                                        If ($tipoBolsa==3 OR $tipoBolsa==5) {
                                            echo " Fuelle Inferior <b>".$tamFuelleInferior."</b><br>";
                                        }
                                        echo "</td>
                                        <td style='padding: 15px;' valign='top'>";
                                            If ($tipoBolsa==2 OR $tipoBolsa==5 OR $tipoBolsa==3) {
                                                echo "<h3>Manija</h3>
                                                 Color <b>".$manijaColor."</b><br>
                                                 Largo <b>".$manijaLargo."</b><br>
                                                ";
                                            } else {
                                                echo "<h3>Manija</h3>
                                                <p>Troquelada<br>
                                                ";
                                            }
                                        echo "</td>
                                        <td style='padding: 15px;' valign='top'>";

                                        If ($tipoBolsa==7 OR $tipoBolsa==6) {
                                            echo "<hr><h3>Cordón</h3>
                                             Cordón Color <b>".$cordonColor."</b><br>
                                             Cordon Largo cm. <b>".$cordonLargo."</b><br>
                                             Cordon Espesor <b>".$cordonEspesor."</b><br>";
                                        }

                                        echo "</td>
                                        <td style='padding: 15px;' valign='top'>
                                            <h3>Friselina Bolsa</h3>
                                             Gramaje <b>".$friselinaGramaje."</b><br>
                                             Color <b>".$friselinaColor."</b><br>
                                    
                                        </td>                                
                                    <td style='padding: 15px;' valign='top'>
                                    <h3>Necesidades / Impresión</h3>
                                     Tela <b>".$necesidadImpresionTela."</b><br>  
                                     Manija <b>".$necesidadImpresionManija."</b><br>
                                     Tintas en Kg. <b>".$necesidadImpresionTintas."</b><br> 

                                </td>
                                <td style='padding: 15px;'  valign='top'>
                                <h3>Impresión</h3>
                                     Tipo: <b>".$tipoImpLaminado."</b><br>
                                     Serig Col <b>".$serigrafiaColor."</b><br>
                                    Flex Col <b>".$flexoColor1."</b><br>
                                    Flex Col <b>".$flexoColor2."</b><br>
                                    Flex Col <b>".$flexoColor3."</b><br>
                                    Flex Col <b>".$flexoColor4."</b><br>

                                </td>
                            </tr>
                        </table>

                        

                        <table border=0 width=100%>
                                      <!-- Cabecera -->
                                      <tr>
                                        <th></th>   <!-- Celda de cabecera de la columna 2 -->
                                        <th></th>   <!-- Celda de cabecera de la columna 2 -->    
                                        
                                      </tr>
                                      <tr>
                                        <td style='padding: 15px;'><h3>Observaciones</h3> ".$observaciones."<br>
                                        </td>
                                        
                                        
                                        <td style='padding: 15px;'>
                                                                            <h5>Logo Newbag</h5>
                                                                                <b>";
                                                                            If ($logo==1) {
                                                                                echo "SI";
                                                                            } else {
                                                                                echo "NO";
                                                                            }
                                                                            echo "</b><br>
                                                                        </td>

                                
                            </tr>

</table>";

                    

                   
        

        }

        //consultaPersona($idPersona);

        echo "<hr>";


}

function resultadoPedidos($pedido, $tipoBusqueda){
	include ("connect.php");

    
    If ($tipoBusqueda==1){
        $likeString = '%'.$pedido.'%';

        $sql = "SELECT idPedido, idEmpresa, fechaPedido, fechaEntrega, precio, estado, inicioCompleto, estadoPagos FROM pedidos WHERE idPedido LIKE ? ORDER BY idPedido DESC";
        $stmt = $mysqli->prepare($sql);
        if(!$stmt->bind_param('s', $likeString)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }

    }
    If ($tipoBusqueda==2){

        If ($pedido==8){
            $estadoPagos=1;
            $estadoAux=7;
            $sql = "SELECT idPedido, idEmpresa, fechaPedido, fechaEntrega, precio, estado, inicioCompleto, estadoPagos FROM pedidos WHERE estado = ? AND estadoPagos = ?";
            $stmt = $mysqli->prepare($sql);
            if(!$stmt->bind_param('ii', $estadoAux, $estadoPagos)) 
            {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
            }


        }else{

            If ($pedido==0){
                $estadoAux=200;
                $sql = "SELECT idPedido, idEmpresa, fechaPedido, fechaEntrega, precio, estado, inicioCompleto, estadoPagos FROM pedidos WHERE estado <> ?";
                $stmt = $mysqli->prepare($sql);
                if(!$stmt->bind_param('i', $estadoAux)) 
                {
                    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
                }                
            }else{
                If ($pedido==7){

                    $estadoPagos=0;
                    $estado=7;

                    $sql = "SELECT idPedido, idEmpresa, fechaPedido, fechaEntrega, precio, estado, inicioCompleto, estadoPagos FROM pedidos WHERE (estadoPagos=? AND estado = ?)";    
                     $stmt = $mysqli->prepare($sql);
                    if(!$stmt->bind_param('ii', $estadoPagos, $estado)) 
                    {
                        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
                    }

                }else{
                    $sql = "SELECT idPedido, idEmpresa, fechaPedido, fechaEntrega, precio, estado, inicioCompleto, estadoPagos FROM pedidos WHERE estado = ?";    
                     $stmt = $mysqli->prepare($sql);
                    if(!$stmt->bind_param('i', $pedido)) 
                    {
                        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
                    }
                }
            }
        }

    }    
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPedido, $idEmpresa, $fechaPedido, $fechaEntrega, $precio, $estado, $inicioCompleto, $estadoPagos);




		echo"<div class='table-responsive'>
		    <table class='table table-hover'>
		        <thead>
		            <tr>
		                <th>Pedido</th>
		                <th>Fecha Pedido</th>
		                <th>Fecha Entrega</th>
                        <th>Bolsa</th>
		                <th>Empresa</th>";
                        If ($_SESSION["nivel"]==100 OR $_SESSION["nivel"]==0 OR $_SESSION["nivel"]==6){
		                  echo "<th>Precio Un.</th>";
                        }
		                echo "<th>Estado</th>
		                <th></th>
		                
		            </tr>
		        </thead>
		        <tbody>";
		
		while ($stmt->fetch()) { 
			$datosPedido=array();
			$datosPedido=consultaEmpresa($idEmpresa);
			$estadoVer=verEstado($estado, $estadoPagos);

            $datosItem=array();
            $datosItem=consulta_item_pedido($idPedido);

            //$idPedidoAux=encriptar($idPedido, "lost87ha");

            echo"<tr>
                
                <td><b>".$idPedido."</b></td>
                <td>".cambiaf_a_normal($fechaPedido)."</td>
                <td><b>".cambiaf_a_normal($fechaEntrega)."</b></td>
                <td><b>".$datosItem[3]."</b></td>
                <td>".strtoupper($datosPedido[0])."</td>";
                If ($_SESSION["nivel"]==100 OR $_SESSION["nivel"]==0 OR $_SESSION["nivel"]==6){
                    echo "<td> $ ".$datosItem[4]."</td>";
                }
                echo " <td><b>".$estadoVer."</b></td>
                <td>";
                If ($inicioCompleto==0){
                    echo "<a href='pedido-item-temp.php?idPedido=".$idPedido."'> Seleccionar</a>";
                }else{
                    echo "<a href='pedido.php?idPedido=".$idPedido."'> Seleccionar</a>";
                    echo " | <a href='pedido-print.php?idPedido=".$idPedido."' target='_blank'> Imprimir</a>";
                }
                If ($_SESSION["nivel"]==100){
                    echo " | <a href='pedido-eliminar.php?idPedido=".$idPedido."' onclick='return confirma_delete();'> Eliminar</a>";
                }
                echo "</td>
            </tr>";
        }
            
		echo "        </tbody>
		    </table>
		</div>";

}


function resultadoPedidosPorEmpresa($idEmpresa){
	include ("connect.php");

    
    $sql = "SELECT idPedido, fechaPedido, fechaEntrega, precio, estado, estadoPagos FROM pedidos WHERE idEmpresa = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idEmpresa)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPedido, $fechaPedido, $fechaEntrega, $precio, $estado, $estadoPagos);

		echo"<div class='table-responsive'>
		    <table class='table table-hover'>
		        <thead>
		            <tr>
		                <th>Pedido</th>
		                <th>Fecha Pedido</th>
		                <th>Fecha Entrega</th>";
		                If ($_SESSION["nivel"]==100 OR $_SESSION["nivel"]==0 OR $_SESSION["nivel"]==6){
                          echo "<th>Precio Un.</th>";
                        }
		                echo "<th>Estado</th>
		                <th></th>
		                
		            </tr>
		        </thead>
		        <tbody>";
		
		while ($stmt->fetch()) { 
            
            $datosItem=array();
            $datosItem=consulta_item_pedido($idPedido);

			$estadoVer=verEstado($estado, $estadoPagos);

            echo"<tr>
                
                <td><b>".$idPedido."</b></td>
                <td>".cambiaf_a_normal($fechaPedido)."</td>
                <td>".cambiaf_a_normal($fechaEntrega)."</td>";
                If ($_SESSION["nivel"]==100 OR $_SESSION["nivel"]==0 OR $_SESSION["nivel"]==6){
                echo "<td> $ ".$datosItem[4]."</td>";
                }
                echo "<td><b>".$estadoVer."</b></td>
                <td><a href='pedido.php?idPedido=".$idPedido."'> Seleccionar</a> </td>
            </tr>";
        }
            
		echo "        </tbody>
		    </table>
		</div>";

}



function resultadoEmpresas($empresa){

	include ("connect.php");
    $likeString = '%' . $empresa . '%';
    $sql = "SELECT idEmpresa, nombre, cuit FROM empresas WHERE nombre LIKE ? OR cuit LIKE ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('ss', $likeString, $likeString)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
		echo"<div class='table-responsive'>
		    <table class='table table-hover'>
		        <thead>
		            <tr>
		                <th>Empresa</th>
		                <th>CUIT</th>
		                <th></th>
		                
		            </tr>
		        </thead>
		        <tbody>";
		$stmt->bind_result($idEmpresa, $nombre, $cuit);
		while ($stmt->fetch()) { 
            echo"<tr>
                
                <td>".strtoupper($nombre)."</td>
                <td><span class='text-semibold'>".$cuit."</span> </td>
                <td><a href='pedido-alta-temp.php?idEmpresa=".$idEmpresa."&empresa=".$nombre."&cuit=".$cuit."'> Seleccionar</a> </td>
            </tr>";
        }
            
		echo "        </tbody>
		    </table>
		</div>";

}



function resultadoEmpresas2($empresa){
	include ("connect.php");
    $likeString = '%' . $empresa . '%';
    $sql = "SELECT idEmpresa, nombre, cuit FROM empresas WHERE nombre LIKE ? OR cuit LIKE ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('ss', $likeString, $likeString)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
		echo"<div class='table-responsive'>
		    <table class='table table-hover'>
		        <thead>
		            <tr>
		                <th>Empresa</th>
		                <th>CUIT</th>
		                <th></th>

		                
		            </tr>
		        </thead>
		        <tbody>";
		$stmt->bind_result($idEmpresa, $nombre, $cuit);
		while ($stmt->fetch()) { 
            echo"<tr>
                <td>".strtoupper($nombre)."</td>
                <td><span class='text-semibold'>".$cuit."</span> </td>
                <td><a href='empresa.php?idEmpresa=".$idEmpresa."&empresa=".$nombre."&cuit=".$cuit."'> Seleccionar</a>";

                If ($_SESSION['nivel']==100 OR $_SESSION['nivel']==0 OR $_SESSION['nivel']==6){ 
                    echo "<td><a href='empresa-editar.php?idEmpresa=".$idEmpresa."'> Editar</a> </td>";
                }
                echo "</td>";
                
            echo "</tr>";
        }
            
		echo "        </tbody>
		    </table>
		</div>";

}

function mostrarMarca($idMarca){

	include ("connect.php");
    $sql = "SELECT nombreMarca FROM marcas where idMarca=?";
    $stmt = $mysqli->prepare($sql);
    
    if(!$stmt->bind_param('i', $idMarca)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($nombreMarca);
	$stmt->fetch();

	echo $nombreMarca;
}


function comboMarcas($idEmpresa){

	include ("connect.php");
    $sql = "SELECT idMarca, nombreMarca FROM marcas where idEmpresa=?";
    $stmt = $mysqli->prepare($sql);
    
    if(!$stmt->bind_param('i', $idEmpresa)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) 
    {
        $stmt->bind_result($idMarca, $nombreMarca);
        echo "<select class='form-control' name='idMarca'>";
        while ($stmt->fetch()) {
			echo "<option value='".$idMarca."'>".$nombreMarca."</option>";
        }
        echo "</select>";
    } else {
    	echo "<br>No posee marcas asociadas.";
    }
}


function comboCantidad($campoItems){

        echo "<select class='form-control' name='".$campoItems."'>";
		echo "<option value='0'>0</option>";
		echo "<option value='1'>1</option>";
		echo "<option value='2'>2</option>";
		echo "<option value='3'>3</option>";
		echo "<option value='4'>4</option>";
		echo "<option value='5'>5</option>";
		echo "<option value='6'>6</option>";

		
        echo "</select>";
}


function comboVendedores($vendedor){

    $vendedores = array("Eric Viazzo","Iñigo Recalde","Laura Baños","Marcelo Savazzini","Nicolas Bianucci", "Carlos Azarola");
    $long = count($vendedores);

        echo "<select class='form-control' name='vendedor'>";

        for ($i=0; $i < $long ; $i++) { 
            echo "<option value='".$vendedores[$i]."'"; 
            If ($vendedor==$vendedores[$i]){
                echo "selected"; 
            }
            echo ">$vendedores[$i]</option>";
        }
       
        echo "</select>";
}


function comboColores($color, $campo){

    $colores = array("Blanco", "Negro", "Beige Lino", "Beige Arena", "Amarillo", "Naranja Fluo", "Verde Botella", "Verde Básico", "Verde Nilo", "Verde Claro", "Verde Fluo", "Marrón", "Gris Claro", "Rojo", "Violeta", "Rosa", "Celeste", "Azul Quirurgico", "Azul Medical", "Azul Marino");
    $long = count($colores);

        echo "<select class='form-control' name='".$campo."'>";

        for ($i=0; $i < $long ; $i++) { 
            echo "<option value='".$colores[$i]."'"; 
            If ($color==$colores[$i]){
                echo "selected"; 
            }
            echo ">$colores[$i]</option>";
        }
       
        echo "</select>";
}

function comboImpresion($campo){

        echo "<select class='form-control' name='".$campo."'>";
        echo "<option value='No Laminado'>No Laminado</option>";
        echo "<option value='Pre Laminado'>Pre Laminado</option>";
        echo "<option value='Laminado'>Laminado</option>";
        echo "</select>";
}

function comboImpresionEdit($tipoImpLaminado, $campo){

    $tipoLaminados = array("No Laminado", "Pre Laminado", "Laminado");
    $long = count($tipoLaminados);

     echo "<select class='form-control' name='".$campo."'>";

        for ($i=0; $i < $long ; $i++) { 
            echo "<option value='".$tipoLaminados[$i]."'"; 
            If ($tipoImpLaminado==$tipoLaminados[$i]){
                echo "selected"; 
            }
            echo ">$tipoLaminados[$i]</option>";
        }
       
        echo "</select>";


}


function campo($requerido, $tipo, $nombre, $etiqueta){
		If ($requerido == 1){
			echo "<input type='".$tipo."' name='".$nombre."' class='form-control' placeholder='".$etiqueta."' required>";
		}else{
			echo "<input type='".$tipo."' name='".$nombre."' class='form-control' placeholder='".$etiqueta."'>";
		}
}

function campoForm($max, $requerido, $tipo, $nombre, $etiqueta){
        If ($requerido == 1){
            echo "<input type='".$tipo."' name='".$nombre."' class='form-control' placeholder='".$etiqueta."' maxlength='".$max."' required>";
        }else{
            echo "<input type='".$tipo."' name='".$nombre."' class='form-control' placeholder='".$etiqueta."' maxlength='".$max."'>";
        }
}


function campoEdit($requerido, $tipo, $nombre, $valor, $etiqueta){
	
		If ($requerido == 1){
            echo "<input type='".$tipo."' name='".$nombre."' value='".$valor."' class='form-control' placeholder='".$etiqueta."' required>";
        }else{
            echo "<input type='".$tipo."' name='".$nombre."' value='".$valor."' class='form-control' placeholder='".$etiqueta."'>";
        }
	

}



	function consultas(){

		$sql = "INSERT INTO entrega (idUsuario, direccion, barrio, localidad, provincia, cp) VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $mysqli->prepare($sql) or die ($mysqli->error);
		$stmt->bind_param('isssss', $idUsuario, $direccion, $barrio, $localidad, $provincia, $cp) or die ($mysqli->error);
		$stmt->execute();



		$sql  = "SELECT estado,id_pedido,fecha, hora FROM pedidos where idUsuario=? ORDER BY fecha DESC";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i', $idUsuario) or die($mysqli->error);
		$stmt->execute();
		$stmt->bind_result($estado,$id_pedido,$fecha,$hora);

		while ($stmt->fetch()) { 
        
        }

	}


function productoInput($codigo, $codCategoria, $x){

	
	If ($codCategoria==21 OR $codCategoria==18 OR $codCategoria==5 OR $codCategoria==8){

		include ("backoffice/connect.php");

		$query="SELECT * FROM pesables_no WHERE codigo=$codigo AND codCategoria=$codCategoria";
		$result2 = $mysqli->query($query) or die($mysqli->error);  

		if ($row2 = $result2->fetch_assoc()) {
			echo "NO PESABLE";
			echo "<input type='text' name='cantidad' value='".$x."' size='2' onkeyUp='return ValNumero(this);'/>";
		}else{
			echo "PESABLE";
			echo "<input type='text' name='cantidad' value='".$x."' size='2'/>";
		}

	}else{

			echo "NO PESABLE";
			echo "<input type='text' name='cantidad' value='".$x."' size='2' onkeyUp='return ValNumero(this);'/>";

	}	
}



	function datosEntrega($idEntrega){

		echo "-------";

		$resultB = mysql_query("SELECT * FROM entrega WHERE idEntrega=$idEntrega");
		$rowB = mysql_fetch_array($resultB);
		$direccionEntrega=$rowB["direccion"];
		$localidadEntrega=$rowB["localidad"];
		$provinciaEntrega=$rowB["provincia"];	
		$cpEntrega=$rowB["cp"]; 
		echo $direccionEntrega." - ".$localidadEntrega." - ".$provinciaEntrega." - ".$cpEntrega;
	}


	function cambiafechamysqlini($fecha_nom){
		ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha_nom, $mifechauno);
		$fechana=$mifechauno[3]."-".$mifechauno[2]."-".$mifechauno[1];
		return $fechana;
	}

	function cambiaf_a_normal($fecha){
        
        $lafecha = date('d-m-Y', strtotime($fecha));
	    return $lafecha;
	} 

	function cambiafechamysqlini2($fecha_nom){
		ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha_nom, $mifechauno);
		$fechana=$mifechauno[3]."-".$mifechauno[1]."-".$mifechauno[2];
		return $fechana;
	}

    function cambiafechamysqlini4($fecha_nom){
        $lafecha = date('Y-m-d', strtotime($fecha_nom));
        return $lafecha;
    }


    function cambiafechamysqlini3($fecha_nom){

        $lafecha = date('m-d-Y', strtotime($fecha_nom));

        return $lafecha;
    }

	function enviarMail($estado,$destino,$id_pedido,$observaciones,$estadoV, $idUsuarioMay)
	{
		$id_pedido2= base64_encode ($id_pedido);
		$idUsuario= base64_encode ($idUsuarioMay);

		$texto="<html>
			<head>
			  <title>Pedidos On Line</title>
			  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
			  </head>
			<body style='padding:0; margin:0'>
			   <table border='0' cellspacing='0' cellpadding='30' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center; background:#333333' width='100%' align='center'><tr><td align='center' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center; background:#333333' width='100%'>
			    <table border='0' cellspacing='0' cellpadding='0' align='center' style='width:590px; margin:0 auto; text-align:center' width='590'><tr><td>
			      <table border='0' cellspacing='0' cellpadding='0' style='width:100%' width='100%'>
			        <tr>
			          <td style='width:160px' width='160'><a href='http://sd-1082695-h00003.ferozo.net' style='text-decoration:none'><img src='http://sd-1082695-h00003.ferozo.net/images/logo-small.jpg' alt='El Abastecedor' style='display:block; border:0px'></a></td>
			          <td valign='bottom' style='text-align:right' align='right'><h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; margin:0; padding:0; font-size:15px; font-weight:400; color:#FFFFFF'>Hola ".$nombre."</h3></td>
			        </tr>
			      </table>  
			      <br><br><br>";
			
			If ($estadoV==1) {
			
				$texto=$texto."<br><br><h2 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:32px; line-height:40px; color:#ffffff; text-align:center' align='center'>Novedades!
					Tu pedido esta valorizado, pod&eacute;s accceder a realizar el pago con tu tarjeta de cr&eacute;dito.</h2>
					<h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:14px; line-height:40px; color:#ffffff; text-align:center' align='center'>Pedido Nro. ".$id_pedido."</h3>";
			}else{

				$texto=$texto."<h1 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:32px; line-height:40px; color:#ffffff; text-align:center' align='center'>Novedades! Tu pedido esta ".$estado.".</h1>
			<h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:14px; line-height:40px; color:#ffffff; text-align:center' align='center'>Pedido Nro. ".$id_pedido."</h3>";

				If ($estadoV==3) {
				
					$texto=$texto."<br><br><h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:14px; line-height:10px; color:#ffffff; text-align:left'>Su pedido fue despachado exitosamente, gracias por utilizar nuestra web. <br>Por favor confirmar la recepci&oacute;n de su mercaderia <br><br>
					Controle su pedido.</h3>";
				}
			}
			
		    $texto=$texto."<table width='100%' border='0' cellspacing='0' cellpadding='0'>
			      <tr>
			      <td style='color:#1d1e21; text-align:center' align='center'>

			        <table align='center' border='0' cellspacing='0' cellpadding='20'>
			          <tr><td width='162' height='40' style='height:40px; font-size:0px; line-height:0px'>&#160;</td></tr>
			          <tr>
			            <td align='center' style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:500; -webkit-border-radius:4px; -moz-border-radius:4px; border-radius:4px; background-color:#1EA858' bgcolor='#22be65'><strong><a href='http://sd-1082695-h00003.ferozo.net/login2b.php?idUsuario=".$idUsuario."&id_pedido=".$id_pedido2."' style='text-decoration:none; font-size:14px; display:block; color:#ffffff'>Para acceder al pedido haga click aqu&iacute;.</a></strong></td>
			          </tr>
			          <tr><td style='height:40px; font-size:0px; line-height:0px' height='40'>&#160;</td></tr>
			        </table>

			      </td>
			    </tr>
			</table>  </td></tr></table>  </td></tr></table>  <table border='0' cellspacing='0' cellpadding='50' align='center' style='width:100%; margin:0 auto; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center' width='100%'>
			  <tr>
			    <td>
			    	<table border='0' cellspacing='0' cellpadding='0' width='590' style='margin: 0 auto;'>
			    		<tr>
			    			<td>
			            <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; padding-top:0px; padding-right:0px; padding-bottom:0px; padding-left:0px; margin-top:0px; margin-right:0px; margin-bottom:0px; margin-left:0px; font-size:12px; color:#253139; line-height:16px'>

			            </p>
			            
			              </td>
			          <td width='45' valign='top'><img src='http://static.issuu.com/mail/gui/facebook-button-discreet.gif' alt='Facebook' style='display:block; border:0px'></td>
			          </tr>
			      </table>
			    </td>
			  </tr>
			</table>
			</body>
			</html>";



		$nombreEmpresa="EL ABASTECEDOR";

	    
		require("class.phpmailer.php");
		$mail=new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth=true;
		$mail->Host="mail.sconsultinghost.com.ar";
	    $mail->Username="webform@sconsultinghost.com.ar"; // usuario correo remitente
	    $mail->Password="123456Ps"; // contraseña correo remitente
	    $mail->Port=25;
	    $mail->From="webform@sconsultinghost.com.ar"; // correo remitente
		$mail->FromName="EL ABASTECEDOR"; // nombre remitente
		$mail->AddAddress($destino); // destinatario
		$mail->IsHTML(true);
		$mail->Subject="PEDIDO NRO. ".$id_pedido;




			$mail->Body=$texto; // mensaje
			$enviar = $mail->Send(); // envia el correo

			if($enviar){echo "OK";}else{echo "ERROR";}
	}
?>