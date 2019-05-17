<?php
/////////////// FUNCIONES SITIO ////////////////////////////////////
error_reporting(E_ALL);
ini_set('display_errors', '1');

setlocale(LC_MONETARY, 'en_US');


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



function obtenerColoresArticulo($codColorAux, $codTipo){

	include ("connect2.php");

	$sql = "SELECT DISTINCT(productmain.codColor), colores.nombreColor
			FROM productmain INNER JOIN colores ON 
			productmain.codColor = colores.codColor
			WHERE codTipo = ?";
	$stmt = $mysqli->prepare($sql);
	if(!$stmt->bind_param('i', $codTipo)) 
	{
	    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
	}

 	$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($codColor, $nombreColor);
	
	
    echo "<center>";
    while ($stmt->fetch()) { 
   	
    	echo "<img src='./img/colores/".$codColor.".jpg'><img src='./img/2px.gif'>";
    }
    echo "</center>";

}



function obtenerCategoria($codigo){
	
	include ("connect.php");

    $sql = "SELECT codCategoria FROM productoscategoria WHERE codigo = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('s', $codigo)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($codCategoria);
    $stmt->fetch();

	return $codCategoria;
}




function obtenerComboProvincias($provincia){

echo "<select class='selectForm' name='provincia' required>
	<option  value='Buenos Aires'>Buenos Aires</option>
	<option  value='Capital Federal'>Capital Federal</option>
	<option value='Catamarca'>Catamarca </option>
	<option value='Chaco'>Chaco </option>
	<option value='Chubut'>Chubut </option>
	<option value='Cordoba'>Cordoba</option>
	<option value='Corrientes'>Corrientes </option>
	<option value='Entre R&iacute;os'>Entre R&iacute;os</option>
	<option value='Formosa'>Formosa </option>
	<option value='Jujuy'>Jujuy</option>
	<option value='La Pampa'>La Pampa</option>
	<option value='La Rioja'>La Rioja </option>
	<option value='Mendoza'>Mendoza</option>
	<option value='Misiones'>Misiones</option>
	<option value='Neuquen'>Neuquen</option>
	<option value='Rio Negro'>Rio Negro</option>
	<option value='Salta'>Salta</option>
	<option  value='San Juan'>San Juan</option>
	<option  value='San Luis'>San Luis </option>
	<option  value='Santa Cruz'>Santa Cruz</option>
	<option  value='Santa Fe'>Santa Fe</option>
	<option value='Santiago del Estero'>Santiago del Estero</option>
	<option value='Tierra del Fuego'>Tierra del Fuego</option>
	<option value='Tucuman'>Tucuman</option>
</select>";

}

	        
function obtenerSlider($codCategoria){

	switch($codCategoria)
	{
		case "100":  echo "<img src='img/slider/slider-sillas.png'>"; break;
		case "110":  echo "<img src='img/slider/slider-mesas.png'>"; break;
		case "120":  echo "<img src='img/slider/slider-mesas-ratonas.png'>"; break;
		case "130":  echo "<img src='img/slider/slider-modulares.png'>"; break;
		case "140":  echo "<img src='img/slider/slider-banquetas.png'>"; break;
		case "150":  echo "<img src='img/slider/slider-sofas.png'>"; break;
		
	}
}



function obtenerImagenesDetalle($codigo){

    include ("connect.php");

	echo "<div class='tab-zoom'>
	      <!-- Tab panes -->
	        <div class='tab-content'>

	            <div id='imageBig' class='tab-pane fade in active'>
	                <div class='s_big'>
	                    <a href='http://www.vivreonline.com.ar/catalogo2018/".$codigo."BIG1.jpg' class='demo4'><img src='http://www.vivreonline.com.ar/catalogo2018/".$codigo."BIG1.jpg' alt=''></a>
	                </div>
	            </div>

	            <div id='imageBig' class='tab-pane fade'>
	                <div class='s_big'>
	                    <a href='http://www.vivreonline.com.ar/catalogo2018/".$codigo."BIG1.jpg' class='demo4'><img src='http://www.vivreonline.com.ar/catalogo2018/".$codigo."BIG1.jpg' alt=''></a>
	                </div>
	            </div>";
	            
	            for ($i = 1; $i < 12; $i++) { 
	                
	                $filename = 'http://www.vivreonline.com.ar/catalogo2018';
	                $filename = $filename.'/'.$codigo.'BIG'.$i.'.jpg';
	                if (fopen($filename, 'r')) { 

						echo "<div id='image".$i."' class='tab-pane fade'>
	                        <div class='s_big'>
	                            <a href='http://www.vivreonline.com.ar/catalogo2018/".$codigo."BIG".$i.".jpg' class='demo4'><img src='http://www.vivreonline.com.ar/catalogo2018/".$codigo."BIG".$i.".jpg' alt=''></a>
	                        </div>
	                    </div>";

					} 

	            }

	        echo "</div>
	        
	    </div>
	    <div class='thumnail-image fix tab-zoom'>
	            <ul class='tab-menu'>
	                
	                <li class='active'><a data-toggle='tab' href='#imageBig'><img alt='' src='http://www.vivreonline.com.ar/catalogo2018/<? echo $codigo; ?>BIG1.jpg'></a></li>";
	                
	                for ($i = 1; $i < 12; $i++) { 
	                    
	                    $filename = 'http://www.vivreonline.com.ar/catalogo2018';
	                    $filename = $filename.'/'.$codigo.'BIG'.$i.'.jpg';
	                    if (fopen($filename, 'r')) { 

	                            echo "<li><a data-toggle='tab' href='#image<? echo $i; ?>'><img alt='' src='http://www.vivreonline.com.ar/catalogo2018/".$codigo."BIG".$i.".jpg'></a></li>";


	                    } 

	                }
        echo "</ul>
    	</div>";


}


function obtenerImagenCatalogo($codigo){

    

    $filename = 'http://www.vivreonline.com.ar/catalogo2018';
    $filename = $filename.'/'.$codigo.'BIG1.jpg';

    if (fopen($filename, 'r')) {

    	echo "<img src='http://vivreonline.com.ar/catalogo2018/".$codigo."BIG1.jpg' alt='' />";

    }else{

		echo "<img src='http://vivreonline.com.ar/catalogo2018/sfoto.gif' alt='' />";

	}

}



function listarArticulos($codigoAux, $codTipo){


If ($codTipo<>0){
	include ("connect2.php");

    $sql  = "SELECT codigo, descripcion FROM productmain WHERE codTipo = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $codTipo) or die($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($codigo, $descripcion);
    $flag=0;
    $cont=0;
    while ($stmt->fetch()) { 

        If($flag==0){
            echo "<h5 class='wg-title margen-top'><b>OTROS COLORES DISPONIBLES</b></h4>";
            $flag=1;
        }
        If($codigoAux<>$codigo){
        	$cont++;
	         echo "<div class='col-md-6 col-xs-6 col-sm-6'>
			            <a href='product-detail.php?codigo=".$codigo."'>
			                <img class='attachment' src='http://www.vivreonline.com.ar/catalogo2018/".$codigo."BIG1.jpg' alt='".$descripcion."'>
			            </a>
				    </div>";

			If($cont==2){
				echo "<div class='col-md-12 col-xs-12 col-sm-12'>
					<hr>
					</div>";
				$cont=0;
			}
           }
    }
    If($flag==1){

    }
 }

}




function comboColorArticulo($codColorAux, $codTipo){

	include ("connect2.php");

	$sql = "SELECT DISTINCT(productmain.codColor), colores.nombreColor
			FROM productmain INNER JOIN colores ON 
			productmain.codColor = colores.codColor
			WHERE codTipo = ?";
	$stmt = $mysqli->prepare($sql);
	if(!$stmt->bind_param('i', $codTipo)) 
	{
	    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
	}

 	$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($codColor, $nombreColor);
	
	echo "<select class='email s-email s-wid' onchange='redireccion()'>
	<option>Elegir Color</option>";
    
    while ($stmt->fetch()) { 
    	If($codColor==$codColorAux){
	    	echo "<option selected >".$nombreColor."</option>";
	    } else {
	        echo "<option>".$nombreColor."</option>";
	    }

    }

	echo "</select>";

}




function consultaArticulo($codigo){

    include ("connect2.php");
    
    $sql = "SELECT idProductMain, codTipo, codColor, principal, descripcion, descripcionLarga, detalle, medidas, ancho, profundidad, alturaAsiento, alturaTotal, color, flagMayorista, catalogo, orden, ordenoutlet, ordenNegocios, site, estadooutlet, estadovivre, preciolistaoutlet, precioactualoutlet, preciolistavivre, preciovivre, preciolistanegocios, precionegocios, datooutlet, tipooutlet, agotadooutlet, agotadoonline, destacadovivre, destacadonegocios, destacadooutlet, ordenDestVivre, ordenDestNeg, ordenDestOutlet, contador, landing, codigo, cuerpos, plazas, largo FROM productmain WHERE codigo = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('s', $codigo)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idProductMain, $codTipo, $codColor, $principal, $descripcion, $descripcionLarga, $detalle, $medidas, $ancho, $profundidad, $alturaAsiento, $alturaTotal, $color, $flagMayorista, $catalogo, $orden, $ordenoutlet, $ordenNegocios, $site, $estadooutlet, $estadovivre, $preciolistaoutlet, $precioactualoutlet, $preciolistavivre, $preciovivre, $preciolistanegocios, $precionegocios, $datooutlet, $tipooutlet, $agotadooutlet, $agotadoonline, $destacadovivre, $destacadonegocios, $destacadooutlet, $ordenDestVivre, $ordenDestNeg, $ordenDestOutlet, $contador, $landing, $codigo, $cuerpos, $plazas, $largo);
    $stmt->fetch();
    $datos = array($idProductMain, $codTipo, $codColor, $principal, $descripcion, $descripcionLarga, $detalle, $medidas, $ancho, $profundidad, $alturaAsiento, $alturaTotal, $color, $flagMayorista, $catalogo, $orden, $ordenoutlet, $ordenNegocios, $site, $estadooutlet, $estadovivre, $preciolistaoutlet, $precioactualoutlet, $preciolistavivre, $preciovivre, $preciolistanegocios, $precionegocios, $datooutlet, $tipooutlet, $agotadooutlet, $agotadoonline, $destacadovivre, $destacadonegocios, $destacadooutlet, $ordenDestVivre, $ordenDestNeg, $ordenDestOutlet, $contador, $landing, $codigo, $cuerpos, $plazas, $largo);
    return $datos;
}


function consultaArticuloId($id){

    include ("connect2.php");
    
    $sql = "SELECT codigo, codTipo, codColor, principal, descripcion, descripcionLarga, detalle, medidas, ancho, profundidad, alturaAsiento, alturaTotal, color, flagMayorista, catalogo, orden, ordenoutlet, ordenNegocios, site, estadooutlet, estadovivre, preciolistaoutlet, precioactualoutlet, preciolistavivre, preciovivre, preciolistanegocios, precionegocios, datooutlet, tipooutlet, agotadooutlet, agotadoonline, destacadovivre, destacadonegocios, destacadooutlet, ordenDestVivre, ordenDestNeg, ordenDestOutlet, contador, landing FROM productmain WHERE idProductMain = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $id)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($codigo, $codTipo, $codColor, $principal, $descripcion, $descripcionLarga, $detalle, $medidas, $ancho, $profundidad, $alturaAsiento, $alturaTotal, $color, $flagMayorista, $catalogo, $orden, $ordenoutlet, $ordenNegocios, $site, $estadooutlet, $estadovivre, $preciolistaoutlet, $precioactualoutlet, $preciolistavivre, $preciovivre, $preciolistanegocios, $precionegocios, $datooutlet, $tipooutlet, $agotadooutlet, $agotadoonline, $destacadovivre, $destacadonegocios, $destacadooutlet, $ordenDestVivre, $ordenDestNeg, $ordenDestOutlet, $contador, $landing);
    $stmt->fetch();
    $datos = array($codigo, $codTipo, $codColor, $principal, $descripcion, $descripcionLarga, $detalle, $medidas, $ancho, $profundidad, $alturaAsiento, $alturaTotal, $color, $flagMayorista, $catalogo, $orden, $ordenoutlet, $ordenNegocios, $site, $estadooutlet, $estadovivre, $preciolistaoutlet, $precioactualoutlet, $preciolistavivre, $preciovivre, $preciolistanegocios, $precionegocios, $datooutlet, $tipooutlet, $agotadooutlet, $agotadoonline, $destacadovivre, $destacadonegocios, $destacadooutlet, $ordenDestVivre, $ordenDestNeg, $ordenDestOutlet, $contador, $landing);
    return $datos;
}

function listarArticulosDestacadados($tipoDestacado){


	include ("connect2.php");

	$destacado=1;

    $sql  = "SELECT productmain.codigo FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo WHERE (productmain.destacadovivre = ?) ORDER BY RAND() DESC";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $destacado) or die($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($codigo);

    while ($stmt->fetch()) { 

    	
    	$datosArticulo=array();
		$datosArticulo=consultaArticulo($codigo);

		$nombre = substr($datosArticulo[4], 0, 20);

    	echo "<div class='col-md-3'>
		    <div class='tb-product-item-inner tb2 pct-last'>
		        <span class='onsale two'>New</span>
		        <img src='http://vivreonline.com.ar/catalogo2018/".$codigo."BIG1.jpg' alt='' />
		        <a class='la-icon'  href='product-detail.php?codigo=".$codigo."' title='Ampliar'><i class='fa fa-eye'></i></a>
		        <div class='tb-content'>
		            <div class='tb-it'>
		                

		                    <div class='textoArticulo'>".$nombre."</div>

		                <div class='tb-product-wrap-price-rating'>
		                    <div class='tb-product-price font-noraure-3'>
		                        <div class='textoPrecio'>$2170.00</div>
		                    </div>
		                </div>
		                <div class='last-cart l-mrgn'>
		                    <a class='las5' href='carrito.php?id=".$datosArticulo[0]."&action=add'>Agregar al Carrito</a>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>";
 	}



}



/////////////// FIN FUNCIONES SITIO ////////////////////////////////////






/////////////// FUNCIONES DASHBOARD ////////////////////////////////////

function totalContactos($idWeb){

	switch($idWeb)
	{
		case 1:  
			$link=mysql_connect("200.58.127.193", "cx000166_advivre", "65Polonia");
			mysql_select_db("cx000166_vivre", $link); 		
			$resp = mysql_query ("Select count(*) as totalContacto from outletpersonas");
			break;
		case 5:  
			$link=mysql_connect("200.58.127.193", "cx000166_advivre", "65Polonia");
			mysql_select_db("cx000166_vivre", $link); 		
			$resp = mysql_query ("Select count(*) as totalContacto from usuarios");
			break;		
		case 2:  
			$link=mysql_connect("200.58.127.193", "cx000166_forvis", "89Panama12");
			mysql_select_db("cx000166_forvis", $link);  		
			$resp = mysql_query ("Select count(*) as totalContacto from personas");
			break;					
		case 6:  
			$link=mysql_connect("200.58.127.193", "cx000166_advivre", "65Polonia");
			mysql_select_db("cx000166_vivre", $link);  		
			$resp = mysql_query ("Select count(*) as totalContacto from onlinepersonas");
			break;								
	}

	$row3 = mysql_fetch_array($resp);
	echo $row3["totalContacto"];
}



function totalGoogle($idWeb){
$link=mysql_connect("200.58.127.193", "cx000166_admi12", "Panama90");
mysql_select_db("cx000166_desarrollo", $link); 
	
$fecha=date('Y/m/d'); 
$mes=date("m", strtotime($fecha));
$anio=date("Y", strtotime($fecha));
$mes--;
    If ($mes==0) {
        $mes=12;
        $anio--;
    }

    
    $resp = mysql_query("SELECT SUM(total) as totalGoogle FROM pautaGoogle WHERE idWeb = $idWeb AND MONTH(fecha)=$mes AND YEAR(FECHA)=$anio");  
	$row3 = mysql_fetch_array($resp);
	$row3["totalGoogle"];
	echo $row3["totalGoogle"];
}


function totalPauta($idWeb, $idPautaSocial, $comercial){

	$link=mysql_connect("200.58.127.193", "cx000166_admi12", "Panama90");
	mysql_select_db("cx000166_desarrollo", $link); 

	$resp = mysql_query ("Select count(*) as totalPauta from pautamkd where (idWeb=$idWeb AND idPautaSocial=$idPautaSocial AND comercial= $comercial)");
	$row3 = mysql_fetch_array($resp);
	$row3["totalPauta"];
	echo $row3["totalPauta"];
}


function iconoPauta($idPautaSocial){

	switch($idPautaSocial)
	{
		case 1:  $icon="facebook.png"; break;
		case 3:  $icon="mailing.png"; break;
	}
	echo "<img src='images/".$icon."'><p><a href='#' data-toggle='modal' data-target=#myModal".$cont.">Ver Post</a></p>"; 	
}


/////////////// FIN FUNCIONES DASHBOARD ////////////////////////////////////



function verEstadoUsuario($estado){
	switch($estado)
	{
		case "0":  echo "DESACTIVO"; break;
		case "1":  echo "ACTIVO"; break;	
		case "2":  echo "NO ES MAYORISTA"; break;
	}
}


function mostrarDescripcion($codigo){

	$resp = mysql_query ("SELECT * FROM productmain WHERE codigo='$codigo'");
	$row3 = mysql_fetch_array($resp);

	$codigo=strtoupper($row3["codigo"]);
	$descripcion=$row3["descripcion"];
	$descripcionLarga=$row3["descripcionLarga"];

	echo "<div class='row'>
	    <div class='col-md-6'><IMG SRC='../catalogo/".$codigo.".jpg' border=0></div>
	    <div class='col-md-6'><h4>".$codigo."</h4><h5>".$descripcion."</h5><h5>".$descripcionLarga."</h5>
	    </div></div>";

}

function datosEntrega($idEntrega){

	$resultB = mysql_query("SELECT * FROM entrega WHERE idEntrega=$idEntrega");

	

	$rowB = mysql_fetch_array($resultB);

	$direccionEntrega=$rowB["direccion"];
	$localidadEntrega=$rowB["localidad"];
	$provinciaEntrega=$rowB["provincia"];	
	$cpEntrega=$rowB["cp"]; 

	echo $direccionEntrega." - ".$localidadEntrega." - ".$provinciaEntrega." - ".$cpEntrega;
}


function datosExpreso($idExpreso){

	$resultE = mysql_query("SELECT * FROM expreso WHERE idExpreso=$idExpreso");
	$rowE = mysql_fetch_array($resultE);

	$direccionExpreso=$rowE["direccion"];
	$localidadExpreso=$rowE["localidad"];
	$provinciaExpreso=$rowE["provincia"];	
	$cpExpreso=$rowE["cp"]; 
	$nombreExpreso=$rowE["nombreExpreso"]; 
	$codTelefonoExpreso=$rowE["codTelefono"]; 
	$telefonoExpreso=$rowE["telefono"]; 

	echo $nombreExpreso." - ".$direccionExpreso." - ".$localidadExpreso." - ".$provinciaExpreso." - ".$telefonoExpreso;
}

function mostrarCarrito($id){
    echo "<p class='btn-add'><i class='fa fa-shopping-cart'></i><a href='carrito.php?id=".$id."&action=add' class='hidden-sm'> Agregar al Carrito</a></p>";
}

function mostrarCarritoNoLogin($id){
	//echo "<p class='btn-add'><i class='fa fa-shopping-cart'></i><a href='carrito.php?id=".$id."&action=add' class='hidden-sm'> Agregar al Carrito</a></p>";
    echo "<p class='btn-add'><i class='fa fa-shopping-cart'></i><a href='login.php?aviso=1' class='hidden-sm'> Agregar al Carrito</a></p>";
}


function total($tipoEstado){


	$resultD = mysql_query("SELECT COUNT(estado) as total FROM pedidos where estado=$tipoEstado");
	$rowD = mysql_fetch_array($resultD);
	$totalA=$rowD["total"];	
	echo $totalA;
}

function extension($nombreArchivo){

	$totalCadena = strlen($nombreArchivo);
    $pos = $totalCadena-3;
	$ext = substr($nombreArchivo, $pos, $totalCadena);
	echo $ext;
} 


function verEstado($estado){
	switch($estado)
	{
		case "0": return $estadoVer = "PENDIENTE VALORIZACION"; break;
		case "1": return $estadoVer = "PENDIENTE DE AUTORIZACION CLIENTE"; break;	
		case "2": return $estadoVer = "EN PROCESO"; break;
		case "3": return $estadoVer = "DESPACHADO"; break;
		case "4": return $estadoVer = "ENTREGADO"; break;
		case "5": return $estadoVer = "RECHAZADA"; break;									
	
	}
}

function verEstadoVivre($estado){
	switch($estado)
	{
		case "0": return $estadoVer = "PENDIENTE DE PAGO"; break;
		case "2": return $estadoVer = "EN PROCESO"; break;
		case "3": return $estadoVer = "DESPACHADO"; break;
		case "4": return $estadoVer = "ENTREGADO"; break;
		case "5": return $estadoVer = "RECHAZADA"; break;									
	
	}
}


function cambiafechamysqlini($fecha_nom){
ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha_nom, $mifechauno);
$fechana=$mifechauno[3]."-".$mifechauno[2]."-".$mifechauno[1];
return $fechana;
}

function cambiaf_a_normal($fecha){
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
} 

function devuelveMes($fecha_nom){
ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha_nom, $mifechauno);
$fechana=$mifechauno[2];
return $fechana;
}

function devuelveAnio($fecha_nom){
ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha_nom, $mifechauno);
$fechana=$mifechauno[3];
return $fechana;
}

function devuelveDia($fecha_nom){
ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha_nom, $mifechauno);
$fechana=$mifechauno[1];
return $fechana;
}

function compara_fechas($fecha1,$fecha2)
{
      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
              list($dia1,$mes1,$año1)=split("/",$fecha1);

	  if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
              list($dia1,$mes1,$año1)=split("-",$fecha1);
        if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
              list($dia2,$mes2,$año2)=split("/",$fecha2);
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
              list($dia2,$mes2,$año2)=split("-",$fecha2);
        $dif = mktime(0,0,0,$mes1,$dia1,$año1) - mktime(0,0,0, $mes2,$dia2,$año2);
        return ($dif);                         
}


function listarProductos($codCategoria)
{
    include ("connect2.php");

	$catalogo=1;
	$principal=1;

	If ($codCategoria==50){

		$sql = "SELECT idProductMain, codigo, codColor, principal, descripcion, descripcionLarga, detalle, medidas, ancho, largo, profundidad, alturaAsiento, alturaTotal, cuerpos, diametro, color, flagMayorista, catalogo, orden, ordenoutlet, ordenNegocios, site, estadooutlet, estadovivre, preciolistaoutlet, precioactualoutlet, preciolistavivre, preciovivre, preciolistanegocios, precionegocios, datooutlet, tipooutlet, agotadooutlet, agotadoonline FROM productmain WHERE estadooutlet = ? ORDER BY codigo DESC";

		
			$stmt = $mysqli->prepare($sql);

		    if(!$stmt->bind_param('i', $catalogo)) 
		    {
		        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
		    }		
		    $stmt->execute();
    		$stmt->store_result();
    		$stmt->bind_result($idProductMain, $codigo, $codColor, $principal, $descripcion, $descripcionLarga, $detalle, $medidas, $ancho, $largo, $profundidad, $alturaAsiento, $alturaTotal, $cuerpos, $diametro, $color, $flagMayorista, $catalogo, $orden, $ordenoutlet, $ordenNegocios, $site, $estadooutlet, $estadovivre, $preciolistaoutlet, $precioactualoutlet, $preciolistavivre, $preciovivre, $preciolistanegocios, $precionegocios, $datooutlet, $tipooutlet, $agotadooutlet, $agotadoonline);

	}else{

		$sql = "SELECT idProductMain, productmain.codigo, tipoproducto.codTipo, codColor, principal, descripcion, descripcionLarga, detalle, medidas, ancho, largo, profundidad, alturaAsiento, alturaTotal, cuerpos, diametro, color, flagMayorista, catalogo, orden, ordenoutlet, ordenNegocios, site, estadooutlet, estadovivre, preciolistaoutlet, precioactualoutlet, preciolistavivre, preciovivre, preciolistanegocios, precionegocios, datooutlet, tipooutlet, agotadooutlet, agotadoonline, tipoproducto.nombreTipo FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo INNER JOIN tipoproducto ON productmain.codTipo = tipoproducto.codTipo WHERE (productmain.principal = ? AND productoscategoria.codCategoria = ? AND productmain.catalogo = ?) ORDER BY productmain.codigo DESC";

			$stmt = $mysqli->prepare($sql);

		    if(!$stmt->bind_param('iii', $principal, $codCategoria, $catalogo)) 
		    {
		        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
		    }
		    $stmt->execute();
    		$stmt->store_result();	
    		$stmt->bind_result($idProductMain, $codigo, $codTipo, $codColor, $principal, $descripcion, $descripcionLarga, $detalle, $medidas, $ancho, $largo, $profundidad, $alturaAsiento, $alturaTotal, $cuerpos, $diametro, $color, $flagMayorista, $catalogo, $orden, $ordenoutlet, $ordenNegocios, $site, $estadooutlet, $estadovivre, $preciolistaoutlet, $precioactualoutlet, $preciolistavivre, $preciovivre, $preciolistanegocios, $precionegocios, $datooutlet, $tipooutlet, $agotadooutlet, $agotadoonline, $nombreTipo);


	}


    

    

		echo "<div class='tab-content'>
            <div role='tabpanel' class='tab-pane active' id='home'>
                <div class='row'>
                    <div class='shop-tab'>";

                    while ($stmt->fetch()) {

                            /*
                            $nombre = strtoupper(substr($nombre, 0, 30));
                            
                            */
                        echo "<div class='col-md-3 col-lg-3 col-sm-6 col-xs-6'>
                            <div class='tb-product-item-inner tb2 pct-last'>";
                                
                                obtenerImagenCatalogo($codigo);

                                echo "<a class='la-icon'  href='product-detail.php?codigo=".$codigo."' title='Ampliar'><i class='fa fa-eye'></i></a>";
                                obtenerColoresArticulo($codColor, $codTipo);
                                echo "<div class='tb-content'>
                                    <div class='tb-it'>
                                        
                                        <div class='textoArticulo'>".$nombreTipo."</div>
                                        
                                        <!--<div class='tb-product-wrap-price-rating'>
                                            <div class='tb-product-price font-noraure-3'>
                                                <span class='amount'>".$preciolistavivre."</span>
                                                <span class='amount2 ana'>".$preciovivre."</span>
                                            </div>
                                        </div>-->
                                        <div>";
                                        	
                                        echo "</div>
                                        <div class='last-cart l-mrgn'>";

										
                                           
                                            echo "<a class='las4' href='product-detail.php?codigo=".$codigo."'>Ver Detalles</a>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>";
                            
                        echo "</div>";
                        
                        } 


                    echo "</div>
                </div>
            </div>
            
        </div>";

}


function obtenerMaxPrecio(){

    include ("connect2.php");
	$catalogo=1;

	$sql = "SELECT MAX(productmain.preciovivre) as precio FROM productmain WHERE (productmain.estadooutlet = ?)";

		$stmt = $mysqli->prepare($sql);

	    if(!$stmt->bind_param('i', $catalogo)) 
	    {
	        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
	    }
	    $stmt->execute();
		$stmt->store_result();	
		$stmt->bind_result($precio);
		$stmt->fetch();

    return $precio;
}

function obtenerMinPrecio(){

    include ("connect2.php");
	$catalogo=1;

	$sql = "SELECT MAX(productmain.preciovivre) as precio FROM productmain WHERE (productmain.estadooutlet = ?)";

		$stmt = $mysqli->prepare($sql);

	    if(!$stmt->bind_param('i', $catalogo)) 
	    {
	        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
	    }
	    $stmt->execute();
		$stmt->store_result();	
		$stmt->bind_result($precio);
		$stmt->fetch();

    return $precio;
}

function obtenerColores(){

    include ("connect2.php");
	$catalogo=1;

	$sql = "SELECT DISTINCT(productmain.codColor), colores.nombreColor FROM productmain INNER JOIN colores ON productmain.codColor = colores.codColor WHERE (productmain.estadooutlet = ?) ORDER BY productmain.codigo DESC";

		$stmt = $mysqli->prepare($sql);

	    if(!$stmt->bind_param('i', $catalogo)) 
	    {
	        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
	    }
	    $stmt->execute();
		$stmt->store_result();	
		$stmt->bind_result($codColor, $nombreColor);

    

		echo "<br>";
		$cont=0;
        while ($stmt->fetch()) {

        	echo "<input type='checkbox' name='codColor".$cont."' value=".$codColor."> ".$nombreColor."<br>";
        	$cont++;
        }
        
}


function obtenerCategorias(){

include ("connect2.php");
	$catalogo=1;

	$sql = "SELECT DISTINCT(categorias.nombre), categorias.codCategoria FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo INNER JOIN categorias ON productoscategoria.codCategoria = categorias.codCategoria WHERE (productmain.estadooutlet = ?) ORDER BY productmain.codigo DESC";

		$stmt = $mysqli->prepare($sql);

	    if(!$stmt->bind_param('i', $catalogo)) 
	    {
	        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
	    }
	    $stmt->execute();
		$stmt->store_result();	
		$stmt->bind_result($nombre, $codCategoria);

    

		echo "<br>";
		$cont=0;
        while ($stmt->fetch()) {

        	echo "<input type='checkbox' name='codCategoria".$cont."' value=".$codCategoria."> ".$nombre."<br>";
        	$cont++;
        }
        

}


function listarProductosOutlet($codCategoria, $precioMin, $precioMax, $codColor)
{
	$cadena="";
	$cadena2="";
	$flag=0;
	$flag2=0;

	$flagConsulta=0;
	$flagConsulta2=0;
	
	for ($i=0;$i<count($codCategoria);$i++) { 

		$flagConsulta=1;

        If($flag==0){
        	$cadena="productoscategoria.codCategoria = ".$codCategoria[$i];
        	$flag=1;
        }else{
        	$cadena=$cadena." OR productoscategoria.codCategoria = ".$codCategoria[$i];
        }
    } 

    for ($i=0;$i<count($codColor);$i++) { 

    	$flagConsulta2=1;
    	
    	If($flag2==0){
        	$cadena2="productmain.codColor = ".$codColor[$i];
        	$flag2=1;
        }else{
        	$cadena2=$cadena2." OR productmain.codColor = ".$codColor[$i];
        }    
    } 

    If ($flagConsulta==1){
    	$cadena="AND (".$cadena.")";
    }

    If ($flagConsulta2==1){
    	$cadena2="AND (".$cadena2.")";
    }


	include ("connect.php");


	$result  = mysql_query("SELECT productmain.codigo FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productmain.estadooutlet = 1 ".$cadena." ".$cadena2." AND preciovivre >= $precioMin AND preciovivre <= $precioMax) ORDER BY productmain.codigo DESC");

	//echo "SELECT productmain.codigo FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productmain.estadooutlet = 1 ".$cadena." ".$cadena2." AND preciovivre >= $precioMin AND preciovivre <= $precioMax) ORDER BY productmain.codigo DESC";


	$cont=0;	

	while ($row = mysql_fetch_array($result)) {

		$codigo=$row["codigo"];

    	$cont++;
    	
    	$datosArticulo=array();
		$datosArticulo=consultaArticulo($codigo);

		$nombre = substr($datosArticulo[4], 0, 20);

		If ($cont==1){
			echo "<div class='row'>";
		}

    	echo "<div class='col-md-3 col-xs-6 col-sm-6'>
		    <div class='tb-product-item-inner tb2 pct-last'>";
		        
		        obtenerImagenCatalogo($codigo);

		        echo "<a class='la-icon'  href='product-detail.php?codigo=".$codigo."' title='Ampliar'><i class='fa fa-eye'></i></a>
		        <div class='tb-content'>
		            <div class='tb-it'>
		                

		                    <div class='textoArticulo'>".$nombre."</div>

		                <div class='tb-product-wrap-price-rating'>
		                    <div class='tb-product-price font-noraure-3'>
		                        <div class='textoPrecio'>$2170.00</div>
		                    </div>
		                </div>
		                <div class='last-cart l-mrgn'>
		                    <a class='las5' href='carrito.php?id=".$datosArticulo[0]."&action=add'>Comprar</a>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>";

		If ($cont==4){
			echo "</div>";
			$cont=0;
		}
 	}

}



function titTop($titulo){

echo "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='1%' height='39'><img src='images/boxTit1.gif' width='10' height='31'></td><td width='98%'><table width='100%' border='0' cellpadding='0' cellspacing='0'><tr><td bgcolor='#E6E6E6'><img src='images/pix.gif' width='1' height='1'></td></tr><tr><td><table width='100%' border='0' cellpadding='0' cellspacing='0'><tr><td width='3' bgcolor='#F7F7F7'><img src='images/pix.gif' width='1' height='29'></td><td width='25' bgcolor='#F7F7F7'><img src='images/iconTIt.gif' width='20' height='21'></td><td width='715' bgcolor='#F7F7F7'><span class='titulo'>".$titulo."</span></td></tr></table></td></tr><tr><td bgcolor='#E6E6E6'><img src='images/pix.gif' width='1' height='1'></td></tr></table></td><td width='1%'><img src='images/boxTit2.gif' width='10' height='31'></td></tr></table>";
	
}

function menu($txt, $tipo)
{

	switch ($tipo) {
	case 2:
        echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td class='TableTDCabeceraBackoffice'>
	<table><tr><td width='80%'>". $txt ."</td>
    <td width='20%' align='right'>
            <table width='280' border='0' cellpadding='0' cellspacing='1' align='right'><tr><td  class='link'><div align='center'><a href='admin.asp'>Inicio</a></div></td><td width='100' class='link'><div align='center'><a href='javascript:history.back();'>Volver</a></div></td><td class='link'><div align='center'><a href='javascript:print()'>Imprimir</a></div></td></tr></table>
	</td>
</tr>
</table>
</td>
</tr>
</table>";
		break;

    case 1:
		echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' class='TableTDCabeceraBackoffice' align='center'><tr><td width='52%'>". $txt ."</td><td width='48%'><table width='260' border='0' align='right' cellpadding='0' cellspacing='1'><tr><td class='link'><div align='center'><a href='javascript:history.back();'>Volver</a></div></td></tr></table></td></tr></table>";
		break;

    case 0:
		echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' class='TableTDCabeceraBackoffice' align='center'><tr><td width='52%'>". $txt ."</td><td width='48%'><table width='180' border='0' cellpadding='0' cellspacing='1' align='right'><tr><td  class='link'><div align='center'><a href='home.php'>Inicio</a></div></td><td class='link'><div align='center'><a href='productos-consultar.php'>Volver</a></div></td></tr></table></td></tr></table>";
		break;

    case 4:
		echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' class='TableTDCabeceraBackoffice' align='center'><tr><td width='52%'><b>". $txt ."</b></td></tr></table>";
		break;
				
	}


}

function carrito()
{
  If ($_SESSION["registro"]){

    $registro=$_SESSION["registro"];
    $estado=$_SESSION["estado"];    

  
    $sql = mysql_query ("SELECT count(*) as total FROM presupuestos WHERE registro=$registro");

   If ($row = mysql_fetch_array($sql)) { 

   	if ($estado<2) {
	    echo "<A HREF='/carrito-checkout.php'>VER CARRITO PEDIDOS</A> | <img src='/images/icon-carrito.png'> ".$row["total"]." PRODUCTOS<br><br>";
	 }

  }
}
}

function labelusuario()
{
  If ($_SESSION["nombre"]) {
    echo "Usuario: ".$_SESSION["nombre"]."| <A HREF='/cuenta.php'>Estado de Cuenta</A>";
  }
}


function enviarMail($estado,$destino,$id_pedido,$observaciones)
{
	$id_pedido2= base64_encode ($id_pedido);
	$idUsuario= base64_encode ($idUsuarioMay);


	$texto="<html>
		<head>
		  <title>Pedidos On Line</title>
		  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		  </head>
		<body style='padding:0; margin:0'>
		   <table border='0' cellspacing='0' cellpadding='30' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center; background:#fff' width='100%' align='center'><tr><td align='center' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center; background:#fff' width='100%'>
		    <table border='0' cellspacing='0' cellpadding='0' align='center' style='width:590px; margin:0 auto; text-align:center' width='590'><tr><td>
		      <table border='0' cellspacing='0' cellpadding='0' style='width:100%' width='100%'>
		        <tr>
		          <td><CENTER><a href='#'><img src='img/logo/logo-small.png' alt='VIVRE' style='display:block; border:0px'></a></CENTER></td>
		          
		        </tr>
		      </table>  
		      <br><br><br>";

		  If ($estado==1) {
		
			$texto=$texto."<br><br><h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:14px; line-height:10px; color:#ffffff; text-align:left'>

				Tu pedido esta valorizado, pod&eacute;s accceder a realizar el pago con tu tarjeta de cr&eacute;.</h3>";
		}

		If ($estado==2) {
		
			$texto=$texto."<h1 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:32px; line-height:40px; color:#000; text-align:center' align='center'>Se realizo el pago.</h1>";
		}

		If ($estado==3) {
		
			$texto=$texto."<br><br><h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:14px; line-height:10px; color:#ffffff; text-align:left'>Su pedido fue despachado exitosamente, gracias por utilizar nuestra web. <br>Por favor confirmar la recepci&oacute;n de su mercaderia <br><br>Controle su pedido.</h3>";
		}
		  


		  $texto=$texto."<h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:14px; line-height:40px; color:#000; text-align:center' align='center'>Pedido Nro. ".$id_pedido.", realizado por ".$_SESSION["nombre"]."</h3>

		    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
		      <tr>
		      <td style='color:#1d1e21; text-align:center' align='center'>

		        <table align='center' border='0' cellspacing='0' cellpadding='20'>
		          <tr><td width='162' height='40' style='height:40px; font-size:0px; line-height:0px'>&#160;</td></tr>
		          <tr>
		            <td align='center' style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:500; -webkit-border-radius:0px; -moz-border-radius:0px; border-radius:0px; background-color:#051127'><strong><a href='#' style='text-decoration:none; font-size:13px; display:block; color:#ffffff'>Para acceder al pedido hac&eacute; click aqu&iacute;.</a></strong></td>
		          </tr>
		          <tr><td style='height:40px; font-size:0px; line-height:0px' height='40'>&#160;</td></tr>
		        </table>

		      </td>
		    </tr>
		</table>  <hr></td></tr></table>  </td></tr></table>  
		</body>
		</html>";


	$nombreEmpresa="VIVRE";

//	$destino=$email;
	require("class.phpmailer.php");
	$mail=new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth=true;
	$mail->Host="mail.sconsulting.com.ar";
	$mail->Username="martin@sconsulting.com.ar"; // usuario correo remitente
	$mail->Password="poLonia45"; // contraseña correo remitente
	$mail->Port=25;
	$mail->From="martin@sconsulting.com.ar"; // correo remitente
	$mail->FromName="Vivre Negocios"; // nombre remitente
	$mail->AddAddress($destino); // destinatario
	$mail->IsHTML(true);
	$mail->Subject="PEDIDO NRO. ".$id_pedido;

	$mail->Body=$texto; // mensaje
	$enviar = $mail->Send(); // envia el correo

	return $enviar;



}

///////////////////////////////////////////////// BACKOFFICE ///////////////////////////////////////////////////////



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




function resultadoProductos($word, $origen){

    include ("connect.php");

    $likeString = '%' . $word . '%';

    $sql = "SELECT idProductMain, codigo, codTipo, codColor, principal, descripcion, descripcionLarga, detalle, medidas, ancho, largo, profundidad, alturaAsiento, alturaTotal, cuerpos, plazas, diametro, color, flagMayorista, catalogo, orden, ordenoutlet, ordenNegocios, estadovivre, preciolistavivre, preciovivre, preciolistanegocios, precionegocios, datooutlet, tipooutlet, agotadooutlet, agotadoonline, destacadovivre, destacadonegocios, ordenDestVivre, ordenDestNeg, contador, landing
		 FROM productmain WHERE codigo LIKE ? OR descripcion LIKE ?";

    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('ss', $likeString, $likeString)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
	

	echo"<table class='table table-striped responsive-utilities jambo_table bulk_action'>
	    <thead>
	        <tr class='headings'>
	            <th class='column-title'>Código</th>
	            <th class='column-title'>Descripción</th>
	            <th class='column-title no-link last'><span class='nobr'>Acción</span></th>
	        </tr>
	    </thead>
	    <tbody>";

	$stmt->bind_result($idProductMain, $codigo, $codTipo, $codColor, $principal, $descripcion, $descripcionLarga, $detalle, $medidas, $ancho, $largo, $profundidad, $alturaAsiento, $alturaTotal, $cuerpos, $plazas, $diametro, $color, $flagMayorista, $catalogo, $orden, $ordenoutlet, $ordenNegocios, $estadovivre, $preciolistavivre, $preciovivre, $preciolistanegocios, $precionegocios, $datooutlet, $tipooutlet, $agotadooutlet, $agotadoonline, $destacadovivre, $destacadonegocios, $ordenDestVivre, $ordenDestNeg, $contador, $landing);

	while ($stmt->fetch()) { 
		echo "<tr class='even pointer'>
                <td class=' '>".$codigo."</td>
                <td class=' '>".$descripcion."</td>
                <td class=' last'>";

                

                    echo "<a href='producto.php?idProductMain=".$idProductMain."'>Editar</a> | <a href='producto-categoria2.php?codigo=".$codigo."'>Asignar Categoria</a> | <a href='productos-eliminar.php?codigo=".$codigo."&word=".$word."&idProductMain=".$idProductMain."'>Eliminar</a> | Relacionar Productos: <a href='productos-relacionados.php?codigo=".$codigo."&word=".$word."&idProductMain=".$idProductMain."&flagInicio=1&web=1'>MINORISTA</a> | <a href='productos-relacionados.php?codigo=".$codigo."&word=".$word."&idProductMain=".$idProductMain."&flagInicio=1&web=2'>MAYORISTA</a>";
               
                //    <a href='productoOutlet.php?idProductMain=".$idProductMain."'>Editar</a>

                echo "</td>
            </tr>";
        
    }
            
        echo "</tbody>
	</table>";

}



function consultaProducto($idProductMain){

	include ("connect.php");

    $sql = "SELECT idProductMain, codigo, codTipo, codColor, principal, descripcion, descripcionLarga, detalle, medidas, ancho, largo, profundidad, alturaAsiento, alturaTotal, cuerpos, plazas, diametro, color, flagMayorista, catalogo, orden, ordenoutlet, ordenNegocios, estadovivre, preciolistavivre, preciovivre, preciolistanegocios, precionegocios, datooutlet, tipooutlet, agotadooutlet, agotadoonline, destacadovivre, destacadonegocios, ordenDestVivre, ordenDestNeg, contador, landing FROM productmain WHERE idProductMain = ?";


    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idProductMain)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();

	$stmt->bind_result($idProductMain, $codigo, $codTipo, $codColor, $principal, $descripcion, $descripcionLarga, $detalle, $medidas, $ancho, $largo, $profundidad, $alturaAsiento, $alturaTotal, $cuerpos, $plazas, $diametro, $color, $flagMayorista, $catalogo, $orden, $ordenoutlet, $ordenNegocios, $estadovivre, $preciolistavivre, $preciovivre, $preciolistanegocios, $precionegocios, $datooutlet, $tipooutlet, $agotadooutlet, $agotadoonline, $destacadovivre, $destacadonegocios, $ordenDestVivre, $ordenDestNeg, $contador, $landing);

	$stmt->fetch();

	$datos = array($idProductMain, $codigo, $codTipo, $codColor, $principal, $descripcion, $descripcionLarga, $detalle, $medidas, $ancho, $largo, $profundidad, $alturaAsiento, $alturaTotal, $cuerpos, $plazas, $diametro, $color, $flagMayorista, $catalogo, $orden, $ordenoutlet, $ordenNegocios, $estadovivre, $preciolistavivre, $preciovivre, $preciolistanegocios, $precionegocios, $datooutlet, $tipooutlet, $agotadooutlet, $agotadoonline, $destacadovivre, $destacadonegocios, $ordenDestVivre, $ordenDestNeg, $contador, $landing);

	return $datos;
}



function consultaPrecioMayorista($codigo){

	include ("connect.php");

    $sql = "SELECT idNegociosPrecio, codigo, precio, stock, bultos, fecha FROM negociosPrecio WHERE codigo = ?";


    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $codigo)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();

	$stmt->bind_result($idNegociosPrecio, $codigo, $precio, $stock, $bultos, $fecha);

	$stmt->fetch();

	$datos = array($idNegociosPrecio, $codigo, $precio, $stock, $bultos, $fecha);

	return $datos;
}




function mostrarImagen($codigo){

    $filename = "http://www.vivre.com.ar/catalogo/catalogo2018";
    $filename = $filename."/".$codigo."BIG1.jpg";
    if (fopen($filename, 'r')) {

		echo "<img src='http://www.vivre.com.ar/catalogo/catalogo2018-marca/".$codigo."BIG1.jpg' class='img-responsive'>";

    }else{ 

    	echo "<img src='http://www.vivre.com.ar/catalogo/catalogo2018/sin-foto.gif' class='img-responsive'>";

    }


}




function comboColoresArticulo($codColorAux){

	include ("connect.php");
		$flag=0;
	    $sql = "SELECT nombreColor, codColor FROM colores ORDER BY nombreColor";
	    $stmt = $mysqli->prepare($sql);
	    
	    $stmt->execute();
	    $stmt->store_result();
	    $stmt->bind_result($nombreColor, $codColor);

	    echo "<select class='form-control' name='codColor'>";

	    while ($stmt->fetch()) { 

	        echo "<option value='".$codColor."'"; 
	        If ($codColorAux==$codColor){
	            echo "selected"; 
	            $flag=1;
	        }
	        echo ">".strtoupper($nombreColor)."</option>";
	    }
	    If ($flag==0){
	    	echo "<option value='0' selected>SELECCIONAR COLOR</option>";
	    }
	    echo "</select>";
	}



function comboTipoArticulo($codTipoAux){

	include ("connect.php");
	$flag=0;

	    $sql = "SELECT nombreTipo, codTipo FROM tipoproducto ORDER BY nombreTipo";
	    $stmt = $mysqli->prepare($sql);
	    
	    $stmt->execute();
	    $stmt->store_result();
	    $stmt->bind_result($nombreTipo, $codTipo);

	    echo "<select class='form-control' name='codTipo'>";

	    while ($stmt->fetch()) { 

	        echo "<option value='".$codTipo."'"; 
	        If ($codTipoAux==$codTipo){
	            echo "selected"; 
	            $flag=1;
	        }
	        echo ">".strtoupper($nombreTipo)."</option>";
	    }
	    If ($flag==0){
	    	echo "<option value='0' selected>SELECCIONAR COLOR</option>";
	    }
	    echo "</select>";
	}	



?>
