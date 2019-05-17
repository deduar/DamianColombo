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

////////////////////////////////////////////////////////////////////////////////
// COLOMBO /////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////


function mostrarPiedra($codPiedra){

    include ("connect.php");
    $flag=0;

            $sql = "SELECT codPiedra, tipoPiedra FROM piedras WHERE codPiedra = ?";

                $stmt = $mysqli->prepare($sql);
                if(!$stmt->bind_param('i', $codPiedra))
                {
                    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
                }
            
               $stmt->execute();
                $stmt->bind_result($codPiedra, $tipoPiedra);
                $stmt->fetch();



            echo $tipoPiedra;

    }   



function mostrarMetal($codMetal){

    include ("connect.php");
    $flag=0;

    $sql = "SELECT codMetal, nombreMetal FROM metales WHERE codMetal = ?";

        $stmt = $mysqli->prepare($sql);
        if(!$stmt->bind_param('i', $codMetal))
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
    
    $stmt->execute();
    $stmt->bind_result($codMetal, $nombreMetal);
    $stmt->fetch();


    echo $nombreMetal;

}  




function consultaProductoRel($codigo, $tipo, $origen){

    include ("connect.php");
    $catalogo=1;

    $sql = "SELECT idProductoRelacionado, codigoRel FROM productosrelacionados WHERE codigo = ? AND tipo = ?";

        $stmt = $mysqli->prepare($sql);
        if(!$stmt->bind_param('si', $codigo, $tipo))
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
    
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idProductoRelacionado, $codigoRel);

    $cont=1;
    $flag=0;

    If ($origen == 'detalle'){

            

            while ($stmt->fetch()) { 
                $cont++;
               
                If ($flag == 0){
                    
                    echo "<br><br>
                    <div class='featured-product-area'>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-12'>
                                    <div class='section-title'>
                                        <h2>Productos Similares</h2>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>

                                <div class='tab-content'>
                                <ul class='row'> ";
                    $flag=1;
                }

                $datosProducto=array();
                $datosProducto=consultaProductoCod($codigoRel);

                itemProducto($datosProducto[1], $datosProducto[2], $datosProducto[0], $datosProducto[18], $cont, $datosProducto[4], 0, $datosProducto[19]);

            }

            If ($flag == 1){

                            echo "</ul>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>";
            }


    }else{

                    echo "<table class='table table-striped responsive-utilities jambo_table bulk_action'>
                        <thead>
                            <tr class='headings'>
                                <th class='column-title'>Código</th>
                                <th class='column-title'>Descripción</th>
                                <th class='column-title no-link last'><span class='nobr'>Acción</span></th>
                            </tr>
                        </thead>

                        <tbody>";


                    while ($stmt->fetch()) { 
                        $flag=1;

                        
                         
                            $datosProducto=array();
                            $datosProducto=consultaProductoCod($codigoRel);

                            
                            
                                                    
                            echo "<tr class='even pointer'>
                                <td class=' '>".$datosProducto[1]."</td>
                                <td class=' '>".$datosProducto[2]."</td>
                                <td class=' last'>
                                <a href='productos-relacionados-eliminar.php?idProductMain=".$datosProducto[0]."&idProductoRelacionado=".$idProductoRelacionado."&codigo=".$datosProducto[1]."&tipo=".$tipo."'>Eliminar</a>


                                            </td>
                                        </tr>";
                                               
                    }
                    
                    echo "</tbody>
                            </table>";
    }
}




function productosBuscar($search){

    $likeString = '%'.$search.'%';

    include ("connect.php");
    $estado=1;
    $sql  = "SELECT codigo, descripcion, idProductMain, precioLista, stock, flagNew, precioFinal FROM productmain WHERE descripcion LIKE ? OR descripcionLarga LIKE ? OR codigo LIKE ?";       
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sss', $likeString, $likeString, $likeString) or die($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($codigo, $descripcion, $idProductMain, $precioLista, $stock, $flagNew, $precioFinal);
    
    $cont=1;

    while ($stmt->fetch()) {

        itemProducto($codigo, $descripcion, $idProductMain, $precioLista, $cont, $stock, $flagNew, $precioFinal);

        $cont++;

    }

}



function cambiaf_a_normal($fecha){
        
        $lafecha = date('d-m-Y', strtotime($fecha));
        return $lafecha;
    } 


function verEstado($estado){
    switch($estado)
    {
        case "1": return $estadoVer = "EN PROCESO"; break;
        case "2": return $estadoVer = "DESPACHADO"; break;
        case "3": return $estadoVer = "ENTREGADO"; break;
        case "4": return $estadoVer = "RECHAZADO"; break;                                   
    
    }
}



function consultaUsuario($idUsuario){

    include ("connect.php");

    $sql = "SELECT idUsuario, fecha, fechaAlta, nombre, apellido, email, password, direccion, localidad, provincia, cp, telefono, cuit, estado, flagNews FROM usuarios WHERE idUsuario = ?";

    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idUsuario)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($idUsuario, $fecha, $fechaAlta, $nombre, $apellido, $email, $password, $direccion, $localidad, $provincia, $cp, $telefono, $cuit, $estado, $flagNews);

    $stmt->fetch();

    $datos = array($idUsuario, $fecha, $fechaAlta, $nombre, $apellido, $email, $password, $direccion, $localidad, $provincia, $cp, $telefono, $cuit, $estado, $flagNews);

    return $datos;
}





function listarWishlist($idUsuario){

    include ("connect.php");
    $catalogo=1;

    

    $sql = "SELECT idProductMain, productmain.codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew FROM productmain INNER JOIN wishlist ON productmain.codigo = wishlist.codigo  WHERE (wishlist.idUsuario = ? AND productmain.catalogo = ?) ORDER BY productmain.codigo DESC";

        $stmt = $mysqli->prepare($sql);
        if(!$stmt->bind_param('ii', $idUsuario, $catalogo))
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
    
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew);


    $cont=1;

    $flag=0;
    
    

    while ($stmt->fetch()) { 

        $flag=1;

    echo "<div class='row'>";
        echo "<div class='col-lg-3'>";
                    obtenerImagenesDetalle($codigo);
        echo "</div>";
        echo "<div class='col-lg-1'>";
        echo "</div>";
        echo "<div class='col-lg-8'>";

                    echo"<div class='product-single-content'>
                        <h3>".utf8_encode($descripcion)."</h3>";
                        echo "<p>".utf8_encode($descripcionLarga)."<br><br><span class='text-cod'> Código Producto: ".$codigo." </span></p>";
                        echo "<div class='rating-wrap fix'>";

                            calculoPrecio('wishlist', $codigo, $precioLista, $precioFinal, 0);
                           
                        echo "</div>
                        <div class='featured-product-content'>
                            <div  class='item-opciones'>
                            <ul>
                                    <li><a href='product-detail.php?codigo=".$codigo."'><i class='fa fa-eye'></i></a></li>";
                                    validaBotonStock($codigo);
                            echo "</ul>
                            </div>
                        </div>
                        <br>
                    <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class='addthis_inline_share_toolbox_525e'></div>
                    </div>
                </div>
            </div>";
            echo "<div class='wishlist-hr'>
                            <div class='row'>
                                
                                
                                </div>
                        </div>";
        

        $cont++;
    }
    
    If ($flag==0){

        echo "<div class='row'>
                <div class='col-lg-4'>
                    <h4>No tiene articulos en su Wishlist.</h4>
                </div>
            </div>";



    }

}



function calculoPrecio($origen, $codigo, $precioLista, $precioFinal, $cantidad){

    $precioAux=($precioLista*$precioFinal)/100;
    $precio=$precioLista-$precioAux;
    $precioTotal=$precio*$cantidad;

    switch ($origen) {
        case "itemProducto":
            echo "<br><p>Precio Lista: <span class='tachado'>U&#36D ".$precioLista."</span></p>
            <p>Descuento: ".$precioFinal."%</p>
            <h5>U&#36D ".$precio."</h5>";
            break;

        case "wishlist":

            echo "<h3 class='pull-left'>U&#36D ".$precio."</h3>";
            break;

        case "carrito-lista":
            echo "<td class='total'>U&#36D ".$precioTotal."</td>";
            break;

        case "carrito-lista-unidad":
            echo "<td class='ptice'>U&#36D ".$precio."</td>";
            break;

        case "checkout":
            echo "<div class='col-lg-3 col-md-3'>U&#36D ".$precioTotal."</div>";
            break;

        case "menu":
            echo "<p>U&#36D ".$precioTotal."</p>";
            break;

        case "detalle":
            echo "Precio Lista: <span class='tachado'>U&#36D ".$precioLista."</span><br>
            <b>Descuento: ".$precioFinal."%</b><br><br>
            <div class='rating-wrap fix'>
                <h3 class='pull-left'>U&#36D ".$precioTotal."</h3>
            </div>";
            break;
    }
}


function validaBotonStock($codigo){

    $datosArticulo=array();
    $datosArticulo=consultaArticuloCodigo($codigo);

    $stock = $datosArticulo[4];
    $idProductMain = $datosArticulo[0];

    If ($stock >= 1){
        echo "<li><a href='carrito.php?id=".$idProductMain."&action=add'><i class='fa fa-shopping-bag'></i></a></li>";
    }

}



function obtenerSubCategoria($codigo) {

    include ("connect.php");
    $sql = "SELECT codSubCategoria FROM productoscategoria WHERE codigo = ?";

    $stmt = $mysqli->prepare($sql);

    if(!$stmt->bind_param('s', $codigo)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($codSubCategoria);
    $stmt->fetch();

    return $codSubCategoria;

}


function obtenerCategorias($codCategoria, $codSubCategoria) {

    include ("connect.php");

    $sql = "SELECT categoria, subCategoria FROM categorias INNER JOIN subcategorias ON categorias.codCategoria = subcategorias.codCategoria  WHERE (subcategorias.codCategoria = ? AND subcategorias.codSubCategoria = ?)";

    $stmt = $mysqli->prepare($sql);

    if(!$stmt->bind_param('ii', $codCategoria, $codSubCategoria)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($categoria, $subCategoria);

    $stmt->fetch();

    $datos = array(utf8_encode($categoria), utf8_encode($subCategoria));

    return $datos;
}


function comboMedidas($medidas, $codSubCategoria, $id, $origen){



    $flag=0;
    

    If ($codSubCategoria==1 OR $codSubCategoria==5 OR $codSubCategoria==6) {

        $medida = explode(" / ", $medidas);

        $total=count($medida);
        echo "Seleccionar Medida: ";
        echo "<select class='form-control' name='medida'>";

        

        for ($i=1; $i <= $total ; $i++) { 

            
            If  ($_SESSION['medida'][$id]){

                $flag=1;

                //$_SESSION['medida'][$id] = isset($_SESSION['medida'][$id]) ? $_SESSION['medida'][$id] : null;
                //echo $medida[$i]." / ".$_SESSION['medida'][$id];

                If ($medida[$i]) {
                    If ($medida[$i] == $_SESSION['medida'][$id]) {

                        echo "<option value='".$medida[$i]."' selected><b> ".$medida[$i]."</b></option>";

                    } else {

                        echo "<option value='".$medida[$i]."'><b> ".$medida[$i]."</b></option>";                
                    } 
                }

            } else {            

                echo "<option value='".$medida[$i]."'><b> ".$medida[$i]."</b></option>";
                
            }

        }

        echo "</select><br>";

        If ($origen='carrito'){
            If ($flag==0){
                $_SESSION['medida'][$id]=$medida[1];
                $flag=1;
            }
        }

    } else {

        //echo "<p>".utf8_encode($medidas)."</p>";

    }

}


function obtenerTitulo($codCategoria, $codSubCategoria){

    switch ($codCategoria) {
        case "2":
            switch ($codSubCategoria) {
                case "1":
                    echo "Joyería / Anillos";
                    break;
                case "2":
                    echo "Joyería / Aros";
                    break;
                case "3":
                    echo "Joyería / Pulseras";
                    break;
                case "4":
                    echo "Joyería / Collares";
                    break;
            }
            break;
        case "1":
            echo "Alta Joyería";
            break;
        case "3":
            switch ($codSubCategoria) {
                case "5":
                    echo "Joyería / Anillos de Compromiso";
                    break;
                case "6":
                    echo "Joyería / Alianzas";
                    break;
                case "7":
                    echo "Joyería / Día de Bodas";
                    break;
            }
            break;
    }



}


function campo($max, $requerido, $tipo, $nombre, $etiqueta, $estilo){
        If ($requerido == 1){
            echo "<input type='".$tipo."' name='".$nombre."' class='".$estilo."' placeholder='".$etiqueta."' maxlength='".$max."' required>";
        }else{
            echo "<input type='".$tipo."' name='".$nombre."' class='".$estilo."' placeholder='".$etiqueta."' maxlength='".$max."'>";
        }
}


function campoEdit($max, $requerido, $tipo, $nombre, $valor, $etiqueta, $estilo){
    
        If ($requerido == 1){
            echo "<input type='".$tipo."' name='".$nombre."' value='".$valor."' class='".$etiqueta."' placeholder='".$etiqueta."' maxlength='".$max."' required>";
        }else{
            echo "<input type='".$tipo."' name='".$nombre."' value='".$valor."' class='".$etiqueta."' placeholder='".$etiqueta."' maxlength='".$max."'>";
        }
}



function carritoTemporal($tipo){

    $totalcoste=0;
    $totalcoste2=0;

    foreach($_SESSION['carro'] as $id => $x){

        $datosArticulo=array();
        $datosArticulo=consultaArticuloId($id);

        $nombre = $datosArticulo[2];
        $codigo = $datosArticulo[1];
        $precio = $datosArticulo[18];
        $stock = $datosArticulo[4];
        $medidas = $datosArticulo[5];

        //Coste por artículo según la cantidad elegida
        $coste = $precio * $x;

        $totalcoste = $totalcoste + $coste;

        //Contador del total de productos añadidos al carro
//        $xTotal = $xTotal + $x;
            
        

        switch ($tipo) {
            case "carrito-lista":
                    echo "<tr>";
                        
                        $filename = '/home/c1200348/public_html/assets/images/productos';
                        $filename = $filename.'/'.$codigo.'BIG1.jpg';
                        if (file_exists($filename)) { 
                            echo "<td class='images'><img src='assets/images/productos/".$codigo."BIG1.jpg' alt=''></td>";
                        } else {
                            echo "<td class='images'><img src='assets/images/productos/no-imagen.jpg' alt=''></td>";
                        }

                        echo "<td class='ptice'>".utf8_encode($nombre)."</td>";

                        calculoPrecio("carrito-lista-unidad", $codigo, $datosArticulo[18], $datosArticulo[19], 0);

                        echo "<td>";

                        comboCantidad($id, $stock, "carrito", $x, $codigo, $medidas);
                        

                    echo "</td>";

                        calculoPrecio("carrito-lista", $codigo, $datosArticulo[18], $datosArticulo[19], $x);

                        echo "<td class='remove'><a href='carrito.php?id=".$id."&action=removeProd'><i class='fa fa-times'></i></a></td>
                    </tr>";
                    break;

            case "checkout":
                    echo "<div class='row'>";
                        $filename = '/home/c1200348/public_html/assets/images/productos';
                        $filename = $filename.'/'.$codigo.'BIG1.jpg';
                        if (file_exists($filename)) { 
                            echo "<div class='col-lg-4 col-md-4'><img src='assets/images/productos/".$codigo."BIG1.jpg' alt='".$nombre."'></div>";
                        } else {
                            echo "<div class='col-lg-4 col-md-4'><img src='assets/images/productos/no-imagen.jpg' alt='".$nombre."'></div>";
                        }

                        $codSubCategoria = obtenerSubCategoria($codigo);

                        If ($codSubCategoria==1 OR $codSubCategoria==5 OR $codSubCategoria==6) {

                            echo "<div class='col-lg-5 col-md-5'>".utf8_encode($nombre)."<br><br>Medida: ".$_SESSION['medida'][$id]."<br>Cant. ".$x."</div>";

                        } else {

                            echo "<div class='col-lg-5 col-md-5'>".utf8_encode($nombre)."<br><br>Medida: ".$medidas."<br>Cant. ".$x."</div>";

                        }

                          calculoPrecio("checkout", $codigo, $datosArticulo[18], $datosArticulo[19], $x);


                          echo "</div>
                          <div class='row'><hr></div>";
                    break;

            case "menu":
                    echo "<li class='cart-items'>
                            <div class='cart-img'>
                                <img src='assets/images/productos/".$codigo.".jpg' alt=''>
                            </div>
                            <div class='cart-content'>
                                <a href='#'>".utf8_encode($nombre)."</a>
                                <span>Cant : ".$x."</span>";
                                calculoPrecio("checkout", $codigo, $datosArticulo[18], $datosArticulo[19], $x);
                                
                                echo "<i class='fa fa-times'></i>
                            </div>

                        </li>";
                    break;
        }
        //$iva=($totalcoste*21)/100;
        //$totalcoste2=$totalcoste+$iva;
    }
}

function carritoTemporalTotal(){

    $totalcoste=0;
    $totalcoste2=0;

    foreach($_SESSION['carro'] as $id => $x){

        $datosArticulo=array();
        $datosArticulo=consultaArticuloId($id);

        $nombre = $datosArticulo[3];
        $codigo = $datosArticulo[1];
        $precioLista = $datosArticulo[18];          
        $precioFinal = $datosArticulo[19];          
        //Coste por artículo según la cantidad elegida

        $precioAux=($precioLista*$precioFinal)/100;

        $precio=$precioLista-$precioAux;

    
        $coste = $precio * $x;



        $totalcoste = $totalcoste + $coste;

        //Contador del total de productos añadidos al carro
       // $xTotal = $xTotal + $x;
    }

    return $totalcoste;
}


function comboCantidad($id, $stock, $tipo, $cantidad, $codigo, $medidas){


    If  ($stock>0){

        If  ($tipo == "carrito"){

            echo "<form  method='post' action='carritoTemp.php'>
                <input type='hidden' name='id' value='".$id."'>
                <input type='hidden' name='action' value='add2'>";

            // MEDIDA //////////
            $codSubCategoria = obtenerSubCategoria($codigo);
            comboMedidas($medidas, $codSubCategoria, $id, "carrito");
            // FIN MEDIDA //////////
            echo "<select class='form-control' name='cantidad'>";
            for ($i=1; $i <= $stock ; $i++) { 

                echo "<option value='".$i."'>Cant:<b> ".$i."</b></option>";
            }

            echo "</select>";
            echo "<br><input  type='submit' value='Actualizar' class='search2'>
            </form>";

        }else{

            echo "<form role='form' action='carrito.php?id=".$id."&action=add2' method='post'>";

            // MEDIDA //////////
            $codSubCategoria = obtenerSubCategoria($codigo);
            comboMedidas($medidas, $codSubCategoria, $id, "modal");
            // FIN MEDIDA //////////

            echo "<select class='form-control' name='cantidad'>";
            for ($i=1; $i <= $stock ; $i++) { 
                    echo "<option value='".$i."'>Cantidad:<b> ".$i."</b></option>";
                }
            echo "</select>";

            echo "<br><input  type='submit' value='Comprar' class='search2'>
            </form>";
        }


    }else{

        echo "Sin Stock";

    }
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



function itemProducto($codigo, $descripcion, $idProductMain, $precioLista, $cont, $stock, $flagNew, $precioFinal) {

    //$codigoEncriptado=encriptar($codigo, "KOER6793");
    echo "<li class='col-lg-3 col-sm-6 col-6'>
        <div class='featured-product-wrap'>
            <div class='featured-product-img'>";
             
            //$filename = 'http://c1200348.ferozo.com/assets/images/productos';
            $filename = '/home/c1200348/public_html/assets/images/productos';
            $filename = $filename.'/'.$codigo.'BIG1.jpg';

            if (file_exists($filename)) { 

                echo "<a data-toggle='modal' data-target='#exampleModalCenter".$cont."' href='javascript:void(0);'><img src='assets/images/productos/".$codigo."BIG1.jpg' alt=''></a>";

            } else {

                echo "<a data-toggle='modal' data-target='#exampleModalCenter".$cont."' href='javascript:void(0);'><img src='assets/images/productos/no-imagen.jpg' alt=''></a>";

            }

           If ($precioFinal > 0){
            echo "<div style='position:absolute; top:0; left:0;'>
               <img src='assets/images/descuentos/bg-descuento-".$precioFinal.".png' alt=''>
            </div>";
            }

            echo "</div>
            <div class='featured-product-content'>
                <div class='row'>
                    <div class='col-12'>
                        <h3><a href='product-detail.php?codigo=".$codigo."'>".utf8_encode($descripcion)."</a></h3>";
                        
                        calculoPrecio("itemProducto", $codigo, $precioLista, $precioFinal, 0);
                        
                    echo "</div>
                    <br>
                    <div  class='item-opciones'>
                    <ul>

                            <li><a href='product-detail.php?codigo=".$codigo."'><i class='fa fa-eye'></i></a></li>";
                            validaBotonStock($codigo);
                            if(isset($_SESSION['idUsuario'])){ 
                                echo "<li><a href='wishlist-temp.php?codigo=".$codigo."'><i class='fa fa-heart'></i></a></li>";
                            }else{
                                echo "<li><a href='login.php?e=3&orig=2'><i class='fa fa-heart'></i></a></li>";
                            }
                        echo "</ul>
                    </div>
                </div>
            </div>
        </div>
    </li>";

    $datosArticulo2=array();
    $datosArticulo2=consultaArticuloCodigo($codigo);

    echo "<div class='modal fade' id='exampleModalCenter".$cont."' tabindex='-1'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <div class='modal-body2 d-flex'>
                    <div class='product-single-img w-50'>
                        <img src='assets/images/productos/".$codigo."BIG1.jpg' alt=''>
                    </div>
                    <div class='product-single-content w-50'>
                    <br>
                        <h3>".utf8_encode($descripcion)."</h3>
                        <p>".utf8_encode($datosArticulo2[2])."</p>";
                        calculoPrecio("itemProducto", $codigo, $precioLista, $precioFinal, 0);


                        comboCantidad($idProductMain,$stock, "gral", 0, $codigo, $datosArticulo2[5]);
                        
                        
                        
                    echo"</div>
                </div>
            </div>
        </div>
    </div>";


}



function listarProductos($codCategoria, $codSubCategoria){

    include ("connect.php");
    $catalogo=1;

    If ($codSubCategoria==0){

        $sql = "SELECT idProductMain, productmain.codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productoscategoria.codCategoria = ? AND productmain.catalogo = ?) ORDER BY productmain.codigo DESC";

            $stmt = $mysqli->prepare($sql);
            if(!$stmt->bind_param('ii', $codCategoria, $catalogo))
            {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
            }
    }else{

        $sql = "SELECT idProductMain, productmain.codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productoscategoria.codCategoria = ? AND productoscategoria.codSubCategoria = ? AND productmain.catalogo = ?) ORDER BY productoscategoria.orden DESC";

            $stmt = $mysqli->prepare($sql);
            if(!$stmt->bind_param('iii', $codCategoria, $codSubCategoria, $catalogo))
            {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
            }


    }

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew);


    echo "<div class='tab-content'>
        <ul class='row'> ";

    $cont=1;

    while ($stmt->fetch()) { 

        itemProducto($codigo, $descripcion, $idProductMain, $precioLista, $cont, $stock, $flagNew, $precioFinal);
        $cont++;
    }
    echo "</ul>
    </div>";

}



function obtenerDestacados($codCategoria, $codSubCategoria){

    include ("connect.php");
    $destacado=1;
    $catalogo=1;


    $sql = "SELECT idProductMain, productmain.codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productoscategoria.codCategoria = ? AND productoscategoria.codSubCategoria = ? AND productmain.catalogo = ? AND productmain.destacado = ?) ORDER BY productoscategoria.ordenDestacado";

    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('iiii', $codCategoria, $codSubCategoria, $catalogo, $destacado)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew);

    echo "<div class='tab-pane active' id='".$codSubCategoria."'>
        <ul class='row'> ";

    $cont=1;
    while ($stmt->fetch()) { 

        itemProducto($codigo, $descripcion, $idProductMain, $precioLista, $cont, $stock, $flagNew, $precioFinal);
        $cont++;

    }
    echo "</ul>
    </div>";

}



function consultaArticuloCodigo($codigo){

    include ("connect.php");

    
        $sql = "SELECT idProductMain, codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo FROM productmain WHERE codigo = ?";

    

    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('s', $codigo)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo);

    $stmt->fetch();

    $datos = array($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo);

    return $datos;
}

function consultaArticuloId($id){

    include ("connect.php");

    
        $sql = "SELECT idProductMain, codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo FROM productmain WHERE idProductMain = ?";


    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $id)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo);

    $stmt->fetch();

    $datos = array($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo);

    return $datos;
}




function consultaStock($id){

    include ("connect.php");

    
    $sql = "SELECT stock FROM productmain WHERE idProductMain = ?";


    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $id)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stock);
    $stmt->fetch();
    return $stock;
}





function obtenerImagenesDetalle($codigo){

    include ("connect.php");

   /*$dir = dirname(__FILE__);

    echo $dir;*/

    echo "<div class='product-single-img'>
            <div class='product-active owl-carousel'>";

                $filename = '/home/c1200348/public_html/assets/images/productos';
                $filename = $filename.'/'.$codigo.'BIG1.jpg';

                if (file_exists($filename)) { 

                    echo "<div class='item'>
                        <img src='assets/images/productos/".$codigo."BIG1.jpg' alt='".$codigo."'>
                    </div>";
                }


                
                for ($i = 2; $i < 3; $i++) { 
                    
                    $filename = '/home/c1200348/public_html/assets/images/productos';
                    $filename = $filename.'/'.$codigo.'BIG'.$i.'.jpg';

                    if (file_exists($filename)) { 

                        echo "<div class='item'>
                            <img src='assets/images/productos/".$codigo."BIG".$i.".jpg' alt='".$codigo."'>
                        </div>";
                    }
                } 
                
            echo "</div>
            <div class='product-thumbnil-active  owl-carousel'>";

                for ($i = 1; $i < 3; $i++) { 

                    $filename = '/home/c1200348/public_html/assets/images/productos';
                    $filename = $filename.'/'.$codigo.'BIG'.$i.'.jpg';

                    if (file_exists($filename)) { 

                        echo "<div class='item'>
                            <img src='assets/images/productos/".$codigo."BIG".$i.".jpg' alt='".$codigo."'>
                        </div>";
                    }

                } 
            echo "</div>
            
        </div>";
}






////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// BACKOFFICE //////////////////////////////////////////////////////////////////
// BACKOFFICE //////////////////////////////////////////////////////////////////
// BACKOFFICE //////////////////////////////////////////////////////////////////
// BACKOFFICE //////////////////////////////////////////////////////////////////

function resultadoProductos($word, $origen){

    include ("connect.php");

    $likeString = '%' . $word . '%';

    $sql = "SELECT idProductMain, codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo
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

    $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo);

    while ($stmt->fetch()) { 
        echo "<tr class='even pointer'>
                <td class=' '>".$codigo."</td>
                <td class=' '>".utf8_encode($descripcion)."</td>
                <td class=' last'>";

                

                    echo "<a href='producto.php?idProductMain=".$idProductMain."'>EDITAR</a> | <a href='producto-categoria2.php?codigo=".$codigo."'>ASIGNAR CATEGORIA</a> | <a href='productos-relacionados.php?codigo=".$codigo."&word=".$word."&idProductMain=".$idProductMain."&flagInicio=1&tipo=1'>RELACIONAR PRODUCTOS</a> | <a href='productos-eliminar.php?codigo=".$codigo."&word=".$word."&idProductMain=".$idProductMain."' onclick='return confirma_delete();'>ELIMINAR</a>";
               
                //    <a href='productoOutlet.php?idProductMain=".$idProductMain."'>Editar</a>

                echo "</td>
            </tr>";
        
    }
            
        echo "</tbody>
    </table>";

}


function consultaProducto($idProductMain){

    include ("connect.php");
    $sql = "SELECT idProductMain, codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew FROM productmain WHERE idProductMain = ?";

    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idProductMain)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew);

    $stmt->fetch();

    $datos = array($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew);

    return $datos;
}


function consultaProductoCod($codigo){

    include ("connect.php");
    $sql = "SELECT idProductMain, codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew FROM productmain WHERE codigo = ?";

    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('s', $codigo)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew);

    $stmt->fetch();

    $datos = array($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew);

    return $datos;
}



function mostrarImagen($codigo){

    /*$filename = "http://www.vivre.com.ar/catalogo/catalogo2018";
    $filename = $filename."/".$codigo."BIG1.jpg";
    if (fopen($filename, 'r')) {*/

        echo "<img src='../assets\images\productos/".$codigo."BIG1.jpg' class='img-responsive'>";

    /*}else{ 

        echo "<img src='http://www.vivre.com.ar/catalogo/catalogo2018/sin-foto.gif' class='img-responsive'>";

    }*/


}



function comboTipoPiedra($codTipoAux, $tipo){

    include ("connect.php");
    $flag=0;

        $sql = "SELECT codPiedra, tipoPiedra FROM piedras ORDER BY tipoPiedra";
        $stmt = $mysqli->prepare($sql);
        
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($codPiedra, $tipoPiedra);
        
        If ($tipo==1){
            echo "<select class='form-control' name='codPiedra'>";
        } else {
            echo "<select class='form-control' name='codpiedra2'>";
        }

        while ($stmt->fetch()) { 

            echo "<option value='".$codPiedra."'"; 
            If ($codTipoAux==$codPiedra){
                echo "selected"; 
                $flag=1;
            }
            echo ">".strtoupper($tipoPiedra)."</option>";
        }
        If ($flag==0){
            echo "<option value='0' selected>SELECCIONAR PIEDRA</option>";
        }
        echo "</select>";
    }   


function comboTipoMetal($codTipoAux){

    include ("connect.php");
    $flag=0;

        $sql = "SELECT codMetal, nombreMetal FROM metales ORDER BY nombreMetal";
        $stmt = $mysqli->prepare($sql);
        
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($codMetal, $nombreMetal);

        echo "<select class='form-control' name='codMetal'>";

        while ($stmt->fetch()) { 

            echo "<option value='".$codMetal."'"; 
            If ($codTipoAux==$codMetal){
                echo "selected"; 
                $flag=1;
            }
            echo ">".strtoupper($nombreMetal)."</option>";
        }
        If ($flag==0){
            echo "<option value='0' selected>SELECCIONAR METAL</option>";
        }
        echo "</select>";
    }   



// FIN BACKOFFICE //////////////////////////////////////////////////////////////////
// FIN BACKOFFICE //////////////////////////////////////////////////////////////////
// FIN BACKOFFICE //////////////////////////////////////////////////////////////////
// FIN BACKOFFICE //////////////////////////////////////////////////////////////////















function formularioLugar($lugar){

    echo "<hr><h4>".strtoupper($lugar)."</h4>
    <form action='lugar-insert.php' method='post' enctype='multipart/form-data' name='form1'  class='form-horizontal form-label-left'>

    <input type='hidden' name='lugar' value='".$lugar."' required>

    <div class='form-group'>
    <div class='col-md-12 col-sm-12 col-xs-12'>";
    
    campo(0, "text","nombre","");

    echo "</div>
    </div>

    <div class='ln_solid'></div>
    <div class='form-group'>
    <div class='col-md-12 col-sm-12 col-xs-12'>
    <button type='submit' class='btn btn-success'>Agregar</button>
    </div>
    </div>
    </form>";
}



function propiedadesSimilares($operacion, $tipoPropiedad, $valor, $seccion)
{
    include ("connect.php");
    //Busqueda con valor...
    If ($seccion == 1){
        $sql = "SELECT idPropiedad, descripcion, ubicacion, precio, tipoPropiedad, operacion, superficieTerreno, ambientes, dormitorios, bano, cochera, antiguedad, quincho, terraza, parrilla, lavadero, playroom, patio, jardin, balcon, dependencia, piscina, cloacas, agua, telefono, internet, moneda FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ? AND precio >= ? and precio <= ?) ORDER BY RAND() LIMIT 5";
        $stmt = $mysqli->prepare($sql);

        if(!$stmt->bind_param('ssi', $operacion, $tipoPropiedad, $valor)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }

    }
    //Listado desde el menu sin valor
    If ($seccion == 2){
        $sql = "SELECT idPropiedad, descripcion, ubicacion, precio, tipoPropiedad, operacion, superficieTerreno, ambientes, dormitorios, bano, cochera, antiguedad, quincho, terraza, parrilla, lavadero, playroom, patio, jardin, balcon, dependencia, piscina, cloacas, agua, telefono, internet, moneda FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ?) ORDER BY RAND() LIMIT 5";
        $stmt = $mysqli->prepare($sql);

        if(!$stmt->bind_param('ss', $operacion, $tipoPropiedad)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
    }
    // Desde el detalle de una propiedad
    If ($seccion == 3){
        $sql = "SELECT idPropiedad, descripcion, ubicacion, precio, tipoPropiedad, operacion, superficieTerreno, ambientes, dormitorios, bano, cochera, antiguedad, quincho, terraza, parrilla, lavadero, playroom, patio, jardin, balcon, dependencia, piscina, cloacas, agua, telefono, internet, moneda FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ?) ORDER BY RAND() LIMIT 5";
        $stmt = $mysqli->prepare($sql);

        if(!$stmt->bind_param('ss', $operacion, $tipoPropiedad)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
    }

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPropiedad, $descripcion, $ubicacion, $precio, $tipoPropiedad, $operacion, $superficieTerreno, $ambientes, $dormitorios, $bano, $cochera, $antiguedad, $quincho, $terraza, $parrilla, $lavadero, $playroom, $patio, $jardin, $balcon, $dependencia, $piscina, $cloacas, $agua, $teléfono, $internet, $moneda);


    echo "<aside id='featured-properties'>
        <header><h3>Propiedades Similares</h3></header>";

    while ($stmt->fetch()) {

        echo "<div class='property small'>
            <a href='propiedad-detalle.php?idPropiedad=".$idPropiedad."'>
                <div class='property-image'>";
                    obtenerImagen($idPropiedad, 1);
                echo "</div>
            </a>
            <div class='info'>
                <a href='propiedad-detalle.php?idPropiedad=".$idPropiedad."'><h4>".$tipoPropiedad." ".$ambientes." amb.</h4></a>
                <figure>".$ubicacion."</figure>
                <div class='tag price'>";
                obtenerMoneda($moneda);
            echo $precio."</div>
            </div>
        </div>";
    }

    echo "</aside>";

}


function resultadoFiltro($tipoPropiedad, $operacion, $rango1, $rango2, $filtro, $moneda){
    
    include ("connect.php");
    $valoraux=1;
    $total=1;
    $flag=1;
    If ($rango1){

        $sql = "SELECT DISTINCT(".$filtro.") as filtroAux FROM `propiedades` WHERE (operacion = ? AND tipoPropiedad = ? AND moneda = ?  AND (precio>=? AND precio<=?))";
        $stmt = $mysqli->prepare($sql);
            if(!$stmt->bind_param('sssii', $operacion, $tipoPropiedad, $moneda, $rango1, $rango2)) 
            {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
            }

    }else{

    $sql = "SELECT DISTINCT(".$filtro.") as filtroAux FROM `propiedades` WHERE tipoPropiedad = ? AND operacion = ?";
    $stmt = $mysqli->prepare($sql);
            if(!$stmt->bind_param('ss', $tipoPropiedad, $operacion)) 
            {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
            }

    }

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($filtroAux);
    //echo "________________ ".$filtroAux;
    while ($stmt->fetch()) { 

        If ($flag==1){
            echo "<h3> ".strtoupper($filtro)."</a></h3>";
            $flag=2;
        }

        include ("connect.php");
        If ($rango1){

          //  echo "SELECT count(idPropiedad) as total FROM propiedades WHERE (operacion = '$operacion' AND tipoPropiedad = '$tipoPropiedad' AND moneda = '$moneda' AND ".$filtro."=? AND (precio>=$rango1 AND precio<=$rango2))<br>";


            $sql = "SELECT count(idPropiedad) as total FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ? AND moneda = ? AND ".$filtro."=? AND (precio>=? AND precio<=?))";
            $stmt2 = $mysqli->prepare($sql);
            if(!$stmt2->bind_param('ssssii', $operacion, $tipoPropiedad, $moneda, $filtroAux, $rango1, $rango2)) 
            {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
            }
        }else{
            //echo "________________ ".$filtroAux;
            //echo $tipoPropiedad." - ".$operacion." ------>>>> ".$filtroAux;

           // echo "<br>SELECT count(idPropiedad) as total FROM propiedades WHERE tipoPropiedad = ".$tipoPropiedad." AND operacion = ".$operacion." and ".$filtro."=".$filtroAux;


            $sql = "SELECT count(idPropiedad) as total FROM propiedades WHERE tipoPropiedad = ? AND operacion = ? and ".$filtro."=?";
            $stmt2 = $mysqli->prepare($sql);
            if(!$stmt2->bind_param('sss', $tipoPropiedad, $operacion, $filtroAux)) 
            {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
            }
        }
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($total);
        $stmt2->fetch();

        //echo "Resultado de la consulta: ".$total;






        If ($total<>0){
            echo "<p><a href='propiedades-listar-filtro.php?operacion=".$operacion."&tipoPropiedad=".$tipoPropiedad."&rango1=".$rango1."&rango2=".$rango2."&filtro=".$filtro."&moneda=".$moneda."&valorFiltro=".$filtroAux."'>".$filtroAux." ".strtoupper($filtro)." (".$total.")</a></p>";
            $total=0;
        }
    }
    If ($flag==2){
        echo "<hr>";
    }

}






function resultadoDetalles($detalle, $tipoPropiedad, $operacion, $rango1, $rango2){
    
    include ("connect.php");
    $valoraux=1;
  

    If ($rango1){

        $sql = "SELECT count(idPropiedad) as total FROM propiedades WHERE tipoPropiedad = ? AND operacion = ? and ".$detalle."=? AND precio >= ? and precio <= ?";
        $stmt = $mysqli->prepare($sql);
        if(!$stmt->bind_param('ssiii', $tipoPropiedad, $operacion, $valoraux, $rango1, $rango2)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }



    }else{
        $sql = "SELECT count(idPropiedad) as total FROM propiedades WHERE tipoPropiedad = ? AND operacion = ? and ".$detalle."=?";
        $stmt = $mysqli->prepare($sql);
        if(!$stmt->bind_param('ssi', $tipoPropiedad, $operacion, $valoraux)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
    }

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($total);
    $stmt->fetch();

    If ($total<>0){
        echo "<p><a href='propiedades-listar-detalle.php?operacion=".$operacion."&tipoPropiedad=".$tipoPropiedad."&rango1=".$rango1."&rango2=".$rango2."&detalle=".$detalle."'>".$detalle." (".$total.")</a></p>";


    }

}





function resultadoLugar($lugar){
    
    include ("connect.php");

    If ($lugar=="localidad"){
        
        $sql = "SELECT id, nombre FROM ".$lugar." ORDER BY nombre";
        $stmt = $mysqli->prepare($sql);
    }
    If ($lugar=="barrio"){

            $sql = "SELECT id, nombre FROM ".$lugar." ORDER BY nombre";
            $stmt = $mysqli->prepare($sql);

    }    
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nombre);




        echo"<div class='table-responsive'>
            <table class='table table-hover'>
                <thead>
                    <tr>
                        <th><h2>".strtoupper($lugar)."</h2></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>";
        
        while ($stmt->fetch()) { 
            echo"<tr>

                <td><b>".$nombre."</b></td>
                <td>";
                    echo "<a href='lugar-eliminar.php?id=".$id."&flagEliminar=1&lugar=".$lugar."' onclick='return confirma_delete();'> Eliminar</a>";

                echo "</td>
            </tr>";
        }
            
        echo "        </tbody>
            </table>
        </div>";

}




function resultadoPropiedadesBusqueda($busqueda, $tipoBusqueda){
    
    include ("connect.php");

    If ($tipoBusqueda==1){
        
        $likeString = '%'.$busqueda.'%';

        $sql = "SELECT idPropiedad, ubicacion, precio, tipoPropiedad, operacion, moneda FROM propiedades WHERE ubicacion LIKE ? ORDER BY ubicacion DESC";
        $stmt = $mysqli->prepare($sql);
        if(!$stmt->bind_param('s', $likeString)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }

    }
    If ($tipoBusqueda==2){

        

            $sql = "SELECT idPropiedad, ubicacion, precio, tipoPropiedad, operacion, moneda FROM propiedades WHERE tipoPropiedad = ? ORDER BY tipoPropiedad DESC";
            $stmt = $mysqli->prepare($sql);
            if(!$stmt->bind_param('s', $busqueda)) 
            {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
            }
    }    
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPropiedad, $ubicacion, $precio, $tipoPropiedad, $operacion, $moneda);




        echo"<div class='table-responsive'>
            <table class='table table-hover'>
                <thead>
                    <tr>
                        <th>Ubicación</th>
                        <th>Precio</th>
                        <th>Moneda</th>
                        <th>Tipo Propiedad</th>
                        <th>Operación</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>";
        
        while ($stmt->fetch()) { 
            echo"<tr>

                <td><b>".$ubicacion."</b></td>
                <td>$ ".$precio."</td>
                <td>".$moneda."</td>
                <td><b>".$tipoPropiedad."</b></td>
                <td>".$operacion."</td>
                <td>";
                    echo "<a href='propiedad-editar-temp.php?idPropiedad=".$idPropiedad."'> Seleccionar</a>";
                    echo " | <a href='propiedad-eliminar.php?idPropiedad=".$idPropiedad."' onclick='return confirma_delete();'> Eliminar</a>";

                echo "</td>
            </tr>";
        }
            
        echo "        </tbody>
            </table>
        </div>";

}






function consultaPropiedad($idPropiedad){

    include ("connect.php");
    
    $sql = "SELECT descripcion, ubicacion, precio, tipoPropiedad, operacion, superficieTerreno, ambientes, dormitorios, bano, cochera, antiguedad, quincho, terraza, parrilla, lavadero, playroom, patio, jardin, balcon, dependencia, piscina, cloacas, agua, telefono, internet, destacado, moneda, localidad, barrio, datosPropietario, codigo, mapa, credito FROM propiedades WHERE idPropiedad = ?";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt->bind_param('i', $idPropiedad)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($descripcion, $ubicacion, $precio, $tipoPropiedad, $operacion, $superficieTerreno, $ambientes, $dormitorios, $bano, $cochera, $antiguedad, $quincho, $terraza, $parrilla, $lavadero, $playroom, $patio, $jardin, $balcon, $dependencia, $piscina, $cloacas, $agua, $telefono, $internet, $destacado, $moneda, $localidad, $barrio, $datosPropietario, $codigo, $mapa, $credito);
    $stmt->fetch();
    $datos = array($descripcion, $ubicacion, $precio, $tipoPropiedad, $operacion, $superficieTerreno, $ambientes, $dormitorios, $bano, $cochera, $antiguedad, $quincho, $terraza, $parrilla, $lavadero, $playroom, $patio, $jardin, $balcon, $dependencia, $piscina, $cloacas, $agua, $telefono, $internet, $destacado, $moneda, $localidad, $barrio, $datosPropietario, $codigo, $mapa, $credito);
    return $datos;
}




function obtenerArchivosDetalle($id){

    include ("connect.php");
    $tipoArchivoAux=2;
    $sql  = "SELECT idArchivo, id, nombreArchivo, textoArchivo FROM archivos WHERE id = ? and tipoArchivo= ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ii', $id, $tipoArchivoAux) or die($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($idArchivo, $id, $nombreArchivo, $textoArchivo);

    $flag=0;
    while ($stmt->fetch()) { 

        If($flag==0){
            echo "<hr><header><h3>Documentos</h3></header>
            <ul>";
            $flag=1;
        }

         echo "<li><a href='backoffice/main/archivos/".$nombreArchivo."' target='_blank'>".strtoupper($textoArchivo)."</a>";
                
    }
    If($flag==1){
        echo "</ul>";
    }
}


function obtenerGaleria($id){

    include ("connect.php");

    $medida=0;

    $sql  = "SELECT idArchivo, id, nombreArchivo, textoArchivo FROM archivos WHERE id = ? and medida= ? ORDER BY orden";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ii', $id, $medida) or die($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($idArchivo, $id, $nombreArchivo, $textoArchivo);

    $flag=0;
    while ($stmt->fetch()) { 

        If($flag==0){
            echo "<section id='property-gallery'>
                <div class='owl-carousel property-carousel'>";
            $flag=1;
        }

         echo "<div class='property-slide'>
                    <a href='backoffice/main/archivos/".$nombreArchivo."' class='image-popup'>
                        <div class='overlay'><h3>Vista</h3></div>
                        <img alt='' src='backoffice/main/archivos/".$nombreArchivo."'>
                    </a>
                </div><!-- /.property-slide -->";
                
    }
    If($flag==1){
        echo "</div><!-- /.property-carousel -->
            </section>";
    }
}


function obtenerArchivo($id, $tipo, $medida){

    include ("connect.php");
    If ($tipo == 2){
        $sql  = "SELECT idArchivo, id, nombreArchivo, textoArchivo, medida, tipoArchivo, orden FROM archivos WHERE id = ? AND tipoArchivo = ? ORDER BY tipoArchivo, orden";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ii', $id, $tipo) or die($mysqli->error);
        $stmt->execute();
        $stmt->bind_result($idArchivo, $id, $nombreArchivo, $textoArchivo, $medida, $tipoArchivo, $orden);
    }else{
        If ($medida == 0){
            $sql  = "SELECT idArchivo, id, nombreArchivo, textoArchivo, medida, tipoArchivo, orden FROM archivos WHERE id = ? AND tipoArchivo = ? AND medida = ? ORDER BY tipoArchivo, orden";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('iii', $id, $tipo, $medida) or die($mysqli->error);
            $stmt->execute();
            $stmt->bind_result($idArchivo, $id, $nombreArchivo, $textoArchivo, $medida, $tipoArchivo, $orden);
        }else{
            $sql  = "SELECT idArchivo, id, nombreArchivo, textoArchivo, medida, tipoArchivo, orden FROM archivos WHERE id = ? AND tipoArchivo = ? AND medida = ? ORDER BY tipoArchivo, orden";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('iii', $id, $tipo, $medida) or die($mysqli->error);
            $stmt->execute();
            $stmt->bind_result($idArchivo, $id, $nombreArchivo, $textoArchivo, $medida, $tipoArchivo, $orden);
        }
    }





    echo "<h4>Archivos </h4>";
    while ($stmt->fetch()) { 
        
        echo "<div class='row'><div class='col-sm-2'>";
        If ($tipo == 1){
            echo "<img src='archivos/".$nombreArchivo."' class='img-responsive'>";
        }else{
             echo $textoArchivo;
        }
        echo "</div>";

        echo "<div class='col-sm-2'>";

            If ($tipoArchivo==1){
                switch ($medida) {
                    case "0":
                        echo "Imagen Grande Slider";
                        break;
                    case "1":
                        echo "Imagen Mediana";
                        break;
                }
            }else{
                echo "Documento";
            }

        echo "</div>";
        echo "<div class='col-sm-2'>
            <a href='archivos/".$nombreArchivo."' target='_blank' class='btn btn-info m-r-15' role='button'>Descargar</a>
        </div>
        <div class='col-sm-2'>
            <a href='archivo-eliminar.php?idArchivo=".$idArchivo."' class='btn btn-danger waves-effect waves-light' role='button'>Eliminar</a>
        </div>
        <div class='col-sm-4'>";

        If ($medida==0){
            echo "<form method='post' action='propiedades-archivos-orden.php?idArchivo=".$idArchivo."'>
                <input type='text' name='orden' size='5' class='input' value='".$orden."' />
                <input type='submit' name='Submit' value='Cambiar' class='boton' />
            </form>";
        }

        echo "</div>
        </div>";
        echo "<div class='row'><hr></div>";
        
    }
        
}



function formularioArchivo($id){

    echo "<h4>Adjuntar Archivo </h4>
    <form action='archivos/archivos.php' method='post' enctype='multipart/form-data' name='form1'  class='form-horizontal form-label-left'>
    <input type='hidden' name='id' value='".$id."'>

    <div class='form-group'>
    <label class='control-label col-md-1 col-sm-1 col-xs-12'>Titulo: </label>
    <div class='col-md-11 col-sm-11 col-xs-12'>";
    
    campo(0, "text","textoArchivo","");

    echo "</div>
    </div>

    <div class='form-group'>
    <label class='control-label col-md-1 col-sm-1 col-xs-12'>Tipo Archivo: </label>
    <div class='col-md-11 col-sm-11 col-xs-12'>
    <input type='radio' name='tipoArchivo' value='1' checked> Foto Galería <br>
    <input type='radio' name='tipoArchivo' value='2'> Documento <br>
   
    </div>
    </div>

    <div class='form-group'>
    <label class='control-label col-md-1 col-sm-1 col-xs-12'>Medida Archivo: </label>
    <div class='col-md-11 col-sm-11 col-xs-12'>
    <input type='radio' name='medida' value='0' checked> Imagen Grande Slider<br>
    <input type='radio' name='medida' value='1'> Imagen Mediana (600px x 450px)<br>
  
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

function obtenerServiciosBase($idPropiedad, $servicios) {
    include ("connect.php");

    
    $sql = "SELECT ".$servicios." FROM propiedades WHERE idPropiedad = ?";

    $stmt = $mysqli->prepare($sql);

    if(!$stmt->bind_param('i', $idPropiedad)) 
    {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($valor);
    $stmt->fetch();

    return $valor;



}


function obtenerServicios($idPropiedad){

$servicio = array("quincho", "terraza", "parrilla", "lavadero", "playroom", "patio", "jardin", "balcon", "dependencia", "piscina", "cloacas", "agua", "telefono", "internet");

$long = count($servicio);

echo "<ul class='list-unstyled property-features-list'>";

for ($i=0; $i < $long ; $i++) { 

        $servicioBase=obtenerServiciosBase($idPropiedad, $servicio[$i]);
    If ($servicioBase==1){
        echo "<li>".strtoupper($servicio[$i])."</li>"; 
    }
}

echo "</ul>";
}

function campoCheck($campo, $valor, $nombre){

    If ($valor==1){
        echo "<input type='checkbox' name='".$campo."' value='1' checked> ".$nombre."  -  ";
    }else{
        echo "<input type='checkbox' name='".$campo."' value='1'> ".$nombre."  -  ";
    }
    
    
}


function comboMoneda($moneda){

    If ($moneda=="PESOS"){
        echo "<input type='radio' name='moneda' value='PESOS' checked> PESOS | ";
        echo " <input type='radio' name='moneda' value='DOLARES' > DOLARES";
    
    }else{
        echo "<input type='radio' name='moneda' value='PESOS' > PESOS |";
        echo " <input type='radio' name='moneda' value='DOLARES' checked> DOLARES";
    }
    
    
}

function obtenerMoneda($moneda){

    If ($moneda=="PESOS"){
        echo "$ ";
    }else{
        echo "u\$s ";
    }
    
    
}



function comboLugar($lugar, $valorLugar){

    include ("connect.php");
    $sql = "SELECT nombre FROM ".$lugar."";
    $stmt = $mysqli->prepare($sql);
    
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($nombre);

    echo "<select class='form-control' name='".$lugar."'>";

    while ($stmt->fetch()) { 

        echo "<option value='".$nombre."'"; 
        If ($nombre==$valorLugar){
            echo "selected"; 
        }
        echo ">".$nombre."</option>";
    }
    echo "</select>";
}




function comboOperacion($operacion){

    If ($operacion=="EN VENTA"){
        echo "<input type='radio' name='operacion' value='EN VENTA' checked> EN VENTA | ";
        echo " <input type='radio' name='operacion' value='ALQUILER' > ALQUILER";
    
    }else{
        echo "<input type='radio' name='operacion' value='EN VENTA' > EN VENTA |";
        echo " <input type='radio' name='operacion' value='ALQUILER' checked> ALQUILER";
    }
    
    
}

function comboCredito($operacion){

    If ($operacion=="APTA CREDITO"){

        echo "<input type='checkbox' name='credito' value='APTA CREDITO' checked>";

    }else{
        echo "<input type='checkbox' name='credito' value='APTA CREDITO'>";
    }
    
    
}


function comboPropiedad($tipoPropiedad){

$tipos = array("CASA","DEPARTAMENTO","DUPLEX","BARRIO CERRADO/COUNTRY","TERRENO","LOCAL","OFICINA","DEPOSITO","CAMPO");

$long = count($tipos);

    echo "<select class='form-control' name='tipoPropiedad'>";
    echo "<option value=''>Tipo de Propiedad</option>";
    for ($i=0; $i < $long ; $i++) { 
        echo "<option value='".$tipos[$i]."'"; 
        If ($tipoPropiedad==$tipos[$i]){
            echo "selected"; 
        }
        echo ">$tipos[$i]</option>";
    }
   
    echo "</select>";
}




function resultadoPropiedadesContador($operacion, $tipoPropiedad, $rango1, $rango2, $moneda){
    include ("connect.php");

    If ($rango1){


        $sql = "SELECT count(idPropiedad) as totalResultado FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ? AND moneda = ? AND (precio>=? AND precio<=?))";
        $stmt = $mysqli->prepare($sql);

        if(!$stmt->bind_param('sssii', $operacion, $tipoPropiedad, $moneda, $rango1, $rango2)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }

    }else{
        $sql = "SELECT count(idPropiedad) as totalResultado FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ?)";
        $stmt = $mysqli->prepare($sql);

        if(!$stmt->bind_param('ss', $operacion, $tipoPropiedad)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
    }

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($totalResultado);
      
    $stmt->fetch();

    If ($totalResultado==0){
        echo "No se encontraron registros asociados.";
    }else{
        echo "<section id='search-filter'>
        <figure><h3><i class='fa fa-search'></i>Resultado de la búsqueda:</h3>
            <span class='search-count'>";
            echo $totalResultado;
        echo "</span></figure></section>";
    }

}




function resultadoPropiedadesDetalle($operacion, $tipoPropiedad, $rango1, $rango2, $detalle){
    include ("connect.php");
    $detalleAux=1;
    If ($rango1){
        $sql = "SELECT idPropiedad, descripcion, ubicacion, precio, tipoPropiedad, operacion, superficieTerreno, ambientes, dormitorios, bano, cochera, antiguedad, quincho, terraza, parrilla, lavadero, playroom, patio, jardin, balcon, dependencia, piscina, cloacas, agua, telefono, internet FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ? AND precio >= ? AND precio <= ? AND ".$detalle." = ?)";
        $stmt = $mysqli->prepare($sql);

        if(!$stmt->bind_param('ssiii', $operacion, $tipoPropiedad, $rango1, $rango2, $detalleAux)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }

    }else{
        $sql = "SELECT idPropiedad, descripcion, ubicacion, precio, tipoPropiedad, operacion, superficieTerreno, ambientes, dormitorios, bano, cochera, antiguedad, quincho, terraza, parrilla, lavadero, playroom, patio, jardin, balcon, dependencia, piscina, cloacas, agua, telefono, internet FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ? AND ".$detalle." = ?)";
        $stmt = $mysqli->prepare($sql);

        if(!$stmt->bind_param('ssi', $operacion, $tipoPropiedad, $detalleAux)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
    }

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPropiedad, $descripcion, $ubicacion, $precio, $tipoPropiedad, $operacion, $superficieTerreno, $ambientes, $dormitorios, $bano, $cochera, $antiguedad, $quincho, $terraza, $parrilla, $lavadero, $playroom, $patio, $jardin, $balcon, $dependencia, $piscina, $cloacas, $agua, $teléfono, $internet);

        echo"<section id='properties'>
            <div class='grid'>";
        
        while ($stmt->fetch()) { 
            
            /*Funcion para solicitar imagenes*/

            echo" <div class='property masonry'>
                    <div class='inner'>
                        <a href='propiedad-detalle.php?idPropiedad=".$idPropiedad."'>
                            <div class='property-image'>
                                <figure class='tag status'>".$operacion."</figure>
                                <figure class='type' title='Apartment'>
                                
                                </figure>
                                <div class='overlay'>
                                    <div class='info'>
                                        <div class='tag price'>us ".$precio."</div>
                                    </div>
                                </div>";
                                obtenerImagen($idPropiedad, 1);
                            echo "</div>
                        </a>
                        <aside>
                            <header>
                                <a href='propiedad-detalle.php'><h3>".$tipoPropiedad." ".$ambientes." Amb.</h3></a>
                                <figure>".$ubicacion."</figure>
                            </header>
                            
                            <dl>
                                <dt>Operación:</dt>
                                <dd>".$operacion."</dd>
                                <dt>Area:</dt>
                                <dd>".$superficieTerreno." m<sup>2</sup></dd>
                                <dt>Ambientes:</dt>
                                <dd>".$ambientes."</dd>
                                <dt>Baños:</dt>
                                <dd>".$bano."</dd>
                            </dl>
                            <a href='propiedad-detalle.php?idPropiedad=".$idPropiedad."' class='link-arrow'>Leer Más</a>
                        </aside>
                    </div>
                </div>";
        }
            
        echo "
            </div><!-- /.center-->
        </section>";

}


function resultadoPropiedadesAmbientes($operacion, $tipoPropiedad, $rango1, $rango2, $ambientesAux){
    include ("connect.php");
    $detalleAux=1;
    If ($rango1){
        $sql = "SELECT idPropiedad, descripcion, ubicacion, precio, tipoPropiedad, operacion, superficieTerreno, ambientes, dormitorios, bano, cochera, antiguedad, quincho, terraza, parrilla, lavadero, playroom, patio, jardin, balcon, dependencia, piscina, cloacas, agua, telefono, internet FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ? AND precio >= ? AND precio <= ? AND ambientes = ?)";
        $stmt = $mysqli->prepare($sql);

        if(!$stmt->bind_param('ssiii', $operacion, $tipoPropiedad, $rango1, $rango2, $ambientesAux)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }

    }else{
        $sql = "SELECT idPropiedad, descripcion, ubicacion, precio, tipoPropiedad, operacion, superficieTerreno, ambientes, dormitorios, bano, cochera, antiguedad, quincho, terraza, parrilla, lavadero, playroom, patio, jardin, balcon, dependencia, piscina, cloacas, agua, telefono, internet FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ? AND ambientes = ?)";
        $stmt = $mysqli->prepare($sql);

        if(!$stmt->bind_param('ssi', $operacion, $tipoPropiedad, $ambientesAux)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
    }

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPropiedad, $descripcion, $ubicacion, $precio, $tipoPropiedad, $operacion, $superficieTerreno, $ambientes, $dormitorios, $bano, $cochera, $antiguedad, $quincho, $terraza, $parrilla, $lavadero, $playroom, $patio, $jardin, $balcon, $dependencia, $piscina, $cloacas, $agua, $teléfono, $internet);

        echo"<section id='properties'>
            <div class='grid'>";
        
        while ($stmt->fetch()) { 
            
            /*Funcion para solicitar imagenes*/

            echo" <div class='property masonry'>
                    <div class='inner'>
                        <a href='propiedad-detalle.php?idPropiedad=".$idPropiedad."'>
                            <div class='property-image'>
                                <figure class='tag status'>".$operacion."</figure>
                                <figure class='type' title='Apartment'>
                                
                                </figure>
                                <div class='overlay'>
                                    <div class='info'>
                                        <div class='tag price'>us ".$precio."</div>
                                    </div>
                                </div>";
                                obtenerImagen($idPropiedad, 1);
                            echo "</div>
                        </a>
                        <aside>
                            <header>
                                <a href='propiedad-detalle.php'><h3>".$tipoPropiedad." ".$ambientes." Amb.</h3></a>
                                <figure>".$ubicacion."</figure>
                            </header>
                            
                            <dl>
                                <dt>Operación:</dt>
                                <dd>".$operacion."</dd>
                                <dt>Area:</dt>
                                <dd>".$superficieTerreno." m<sup>2</sup></dd>
                                <dt>Ambientes:</dt>
                                <dd>".$ambientes."</dd>
                                <dt>Baños:</dt>
                                <dd>".$bano."</dd>
                            </dl>
                            <a href='propiedad-detalle.php?idPropiedad=".$idPropiedad."' class='link-arrow'>Leer Más</a>
                        </aside>
                    </div>
                </div>";
        }
            
        echo "
            </div><!-- /.center-->
        </section>";

}




function resultadoPropiedadesFiltro($operacion, $tipoPropiedad, $rango1, $rango2, $filtro, $filtroValor, $moneda){
    include ("connect.php");
    $detalleAux=1;
    If ($rango1){

        $sql = "SELECT idPropiedad, descripcion, ubicacion, localidad, barrio precio, tipoPropiedad, operacion, superficieTerreno, ambientes, dormitorios, bano, cochera, antiguedad, quincho, terraza, parrilla, lavadero, playroom, patio, jardin, balcon, dependencia, piscina, cloacas, agua, telefono, internet FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ? AND precio >= ? AND precio <= ? AND ".$filtro." = ?)";
        $stmt = $mysqli->prepare($sql);

        if(!$stmt->bind_param('ssiis', $operacion, $tipoPropiedad, $rango1, $rango2, $filtroValor)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }

    }else{
        $sql = "SELECT idPropiedad, descripcion, ubicacion, localidad, barrio, precio, tipoPropiedad, operacion, superficieTerreno, ambientes, dormitorios, bano, cochera, antiguedad, quincho, terraza, parrilla, lavadero, playroom, patio, jardin, balcon, dependencia, piscina, cloacas, agua, telefono, internet FROM propiedades WHERE (operacion = ? AND tipoPropiedad = ? AND ".$filtro." = ?)";
        $stmt = $mysqli->prepare($sql);

        if(!$stmt->bind_param('sss', $operacion, $tipoPropiedad, $filtroValor)) 
        {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
    }

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($idPropiedad, $descripcion, $ubicacion, $localidad, $barrio, $precio, $tipoPropiedad, $operacion, $superficieTerreno, $ambientes, $dormitorios, $bano, $cochera, $antiguedad, $quincho, $terraza, $parrilla, $lavadero, $playroom, $patio, $jardin, $balcon, $dependencia, $piscina, $cloacas, $agua, $teléfono, $internet);

        echo"<section id='properties'>
            <div class='grid'>";
        
        while ($stmt->fetch()) { 
            
            /*Funcion para solicitar imagenes*/

            echo" <div class='property masonry'>
                    <div class='inner'>
                        <a href='propiedad-detalle.php?idPropiedad=".$idPropiedad."'>
                            <div class='property-image'>
                                <figure class='tag status'>".$operacion."</figure>
                                <figure class='type' title='Apartment'>
                                
                                </figure>
                                <div class='overlay'>
                                    <div class='info'>
                                        <div class='tag price'>";
                                        obtenerMoneda($moneda);
                                        echo $precio."</div>";
                                    echo "</div>
                                </div>";
                                obtenerImagen($idPropiedad, 1);
                            echo "</div>
                        </a>
                        <aside>
                            <header>
                                <a href='propiedad-detalle.php'><h3>".$tipoPropiedad." ".$ambientes." Amb.</h3></a>
                                <figure>".$ubicacion." | ".$localidad."</figure>
                            </header>
                            
                            <dl>
                                <dt>Operación:</dt>
                                <dd>".$operacion."</dd>
                                <dt>Sup. Construida:</dt>
                                <dd>".$antiguedad." m<sup>2</sup></dd>
                                <dt>Supeficie:</dt>
                                <dd>".$superficieTerreno." m<sup>2</sup></dd>
                                <dt>Ambientes:</dt>
                                <dd>".$ambientes."</dd>
                                <dt>Dormitorios:</dt>
                                <dd>".$dormitorios."</dd>
                            </dl>
                            <a href='propiedad-detalle.php?idPropiedad=".$idPropiedad."' class='link-arrow'>Leer Más</a>
                        </aside>
                    </div>
                </div>";
        }
            
        echo "
            </div><!-- /.center-->
        </section>";

}

function obtenerImagen($id, $medida){

    include ("connect.php");

    $sql  = "SELECT idArchivo, id, nombreArchivo, textoArchivo FROM archivos WHERE id = ? and medida= ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ii', $id, $medida) or die($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($idArchivo, $id, $nombreArchivo, $textoArchivo);

    If ($stmt->fetch()) { 
        echo "<img src='backoffice/main/archivos/".$nombreArchivo."'  alt='".$textoArchivo."'>";
            
    } else {
       // echo "<img src='assets/img/sin-foto.jpg'  alt=''>";
    }
}


/*
function campo($requerido, $tipo, $nombre, $etiqueta){
        If ($requerido == 1){
            echo "<input type='".$tipo."' name='".$nombre."' class='form-control' placeholder='".$etiqueta."'  required>";
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
    

}*/

function enviarMail($destino,$asunto, $remitente, $body)
    {
        echo $destino." - ".$asunto." - ".$remitente." - ".$body;

        require("class.phpmailer.php");
        $mail=new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth=true;
        $mail->Host="mail.sconsultinghost.com.ar";
        $mail->Username="webform@sconsultinghost.com.ar"; // usuario correo remitente
        $mail->Password="123456Ps"; // contraseña correo remitente

        $mail->Port=25;
        $mail->From="webform@sconsultinghost.com.ar"; // correo remitente
        $mail->FromName=$remitente; // nombre remitente
        $mail->AddAddress($destino); // destinatario
        $mail->AddAddress("martin@sconsulting.com.ar"); // destinatario
        $mail->IsHTML(true);
        $mail->Subject=$asunto;
        $mail->MsgHTML($body); //Put your body of the message you can place html code here
        $send = $mail->Send(); //Send the mails
        
        if($send){echo "OK";}else{echo "ERROR2";}
    }


function formContacto($destino,$asunto, $remitente, $contenido){

        $fecha=date("d/m/Y");

        $body="<html>
        <head>
          <title>Mailing</title>
          <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
          </head>
        <body style='padding:0; margin:0'>

           <table border='0' cellspacing='0' cellpadding='30' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center; background:#F3F3F3' width='100%' align='center'><tr><td align='center' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:center; background:#F3F3F3' width='100%'>
            


            <table border='0' cellspacing='0' cellpadding='0' align='center' style='width:500px; margin:0 auto; text-align:center'><tr><td>
            
                <tr>
                  <td style='width:160px' width='160'><a href='http://www.elabastecedor.com.ar' style='text-decoration:none'><img src='http://www.repettoprop.com.ar/test/backoffice/main/images/logo-small.png' alt='Repetto Propiedades' style='display:block; border:0px'></a></td>
                  <td valign='bottom' style='text-align:right' align='right'><h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; margin:0; padding:0; font-size:13px; font-weight:400; color:#333'>Fecha: ".$fecha."</h3></td>
                </tr>
                <tr>
                  <td colspan='2' align='center' style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:13px; text-align: left; font-weight:500; background-color:#fff; padding: 15px'; >".$contenido."
                  </td>
                </tr>
              
            </table>


        </body>
        </html>";

        enviarMail($destino,$asunto, $remitente, $body);
}


?>