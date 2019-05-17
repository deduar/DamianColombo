<!doctype html>
<?php include ("backoffice/incFunction.php");?>
<?php
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$codigo = htmlspecialchars($codigo);


$codSubCategoria = isset($_GET['codSubCategoria']) ? $_GET['codSubCategoria'] : null;
$codSubCategoria = htmlspecialchars($codSubCategoria);

//$codigo=desencriptar($codigo, $enc33);

$datosArticulo=array();

$datosArticulo=consultaArticuloCodigo($codigo);

$archivo_actual = basename($_SERVER['PHP_SELF']);
$path=$archivo_actual."?codigo=".$datosArticulo[1];

$producto=utf8_encode($datosArticulo[1])." | ".utf8_encode($datosArticulo[2]);

?>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $datosArticulo[2]; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="assets/images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="assets/images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-16x16.png">
    <link rel="manifest" href="assets/images/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
   <!-- bootstrap v3.3.7 css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="assets/css/metisMenu.min.css">
    <!-- slicknav.min.css -->
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- swiper.min.css -->
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <?php include ("inc-google-analytics.php");?>




<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style type="text/css">
    
@import url(http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css);
.col-item
{
    border: 1px solid #E1E1E1;
    border-radius: 5px;
    background: #FFF;
}
.col-item .photo img
{
    margin: 0 auto;
    width: 100%;
}

.col-item .info
{
    padding: 10px;
    border-radius: 0 0 5px 5px;
    margin-top: 1px;
}

.col-item:hover .info {
    background-color: #F5F5DC;
}
.col-item .price
{
    /*width: 50%;*/
    float: left;
    margin-top: 5px;
}

.col-item .price h5
{
    line-height: 20px;
    margin: 0;
}

.price-text-color
{
    color: #219FD1;
}

.col-item .info .rating
{
    color: #777;
}

.col-item .rating
{
    /*width: 50%;*/
    float: left;
    font-size: 17px;
    text-align: right;
    line-height: 52px;
    margin-bottom: 10px;
    height: 52px;
}

.col-item .separator
{
    border-top: 1px solid #E1E1E1;
}

.clear-left
{
    clear: left;
}

.col-item .separator p
{
    line-height: 20px;
    margin-bottom: 0;
    margin-top: 10px;
    text-align: center;
}

.col-item .separator p i
{
    margin-right: 5px;
}
.col-item .btn-add
{
    width: 50%;
    float: left;
}

.col-item .btn-add
{
    border-right: 1px solid #E1E1E1;
}

.col-item .btn-details
{
    width: 50%;
    float: left;
    padding-left: 10px;
}
.controls
{
    margin-top: 20px;
}
[data-slide="prev"]
{
    margin-right: 10px;
}



    
</style>

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    

    <div class="preloader-wrap">
        <div class="spinner"></div>
    </div>
    <?php include ("inc-menu.php");?>
    
    
    <!--//////////////////////////////////////////////////////////////////////////////////////////////-->


    <div class="single-product-area ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <?php obtenerImagenesDetalle($codigo)?>
                </div>
                <div class="col-lg-1">
                </div>
                <div class="col-lg-5">
                    <div class="product-single-content">
                        <h3><?php echo utf8_encode($datosArticulo[2]); ?></h3>
                        <?php echo utf8_encode($datosArticulo[3]); ?>
                        <div class='featured-product-content'>
                            <div  class="item-opciones">
                                <ul>
                                <?php if(isset($_SESSION['idUsuario'])){ 
                                        echo "<li><a href='wishlist-temp.php?codigo=".$codigo."'><i class='fa fa-heart'></i></a></li>";
                                    }else{
                                        echo "<li><a href='login.php?e=3&orig=2'><i class='fa fa-heart'></i></a></li>";
                                    } ?>
                                </ul>
                            </div>
                        </div>
                        <span class="text-cod"> Código Producto: <?php echo $datosArticulo[1]; ?></span><br><br>
                        <?php calculoPrecio("detalle", $datosArticulo[2], $datosArticulo[18], $datosArticulo[19], 1); ?>
                        
                        <!-- // VERIFICA EL STOCK-->
                        <?php 
                        $codSubCategoria=obtenerSubCategoria($codigo);

                        If ($codSubCategoria==1 OR $codSubCategoria==5){ ?>
                            <a href='guia-medidas.php' target="_blank" class="menus">Guía de Medidas</a>
                            <br><br>
                        <?php } ?>
                        
                        <?php If ($datosArticulo[4] >= 1) { 
                                comboCantidad($datosArticulo[0], $datosArticulo[4], "gral", 0, $codigo, $datosArticulo[5]); ?>
                                
                        <?php }else{ ?>

                                <h5>Sin Stock / Ordenar </h5>
                                <hr>

                                <div class="add-review">
                                        <form action="contactoSend.php" method="POST">
                                        <input type="hidden" name="producto" value="<?php echo $producto; ?>">
                                        <input type="hidden" name="tipo" value="ORDENAR">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    Nombre:
                                                    <input type="text" placeholder="" name="nombre" maxlength="40" required />
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    Email:
                                                    <input type="email" placeholder="" name="email" maxlength="40" required />
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    Teléfono:
                                                    <input type="text" placeholder="" name="telefono" maxlength="40" required />
                                                </div>
                                                <div class="col-12">
                                                    Mensaje:
                                                    <textarea name="mensaje" id="massage" cols="30" rows="5" placeholder="" maxlength="350"></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn-style">Ordenar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                        <?php } ?>


                            <div class="d-lg-none">
                                <hr>
                                <a href="whatsapp://send?text=http://www.damiancolombo.com/<?php echo $path; ?>" data-action="share/whatsapp/share">
                                    Compartir en: <img border="0" src="assets/images/icon-wp.png" width="XXX" height="YYY">
                                    </a>
                            </div>


                        <hr>
                        
                        
                        
                    <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox_525e"></div>
                        
                    </div>
                </div>
            </div>

            



            <div class="row mt-60">
                <div class="col-12">
                    <div class="single-product-menu">
                        <ul class="nav">
                            <li><a class="active" data-toggle="tab" href="#certificado">Certificado</a> </li>
                            <li><a  data-toggle="tab" href="#medida">Medidas</a> </li>
                            <li><a data-toggle="tab" href="#review">Consultar</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tab-content">

                        <div class="tab-pane active" id="certificado">
                            <div class="description-wrap">

                                <a href="assets/certificados/<?php echo $datosArticulo[17];?>.pdf" target="_blank">Descargar Certificado</a>
                                
                            </div>
                        </div>
                        <div class="tab-pane" id="medida">
                            <div class="description-wrap">
                                <div class="row">
                                    <div class="col-md-3 ratting-wrap">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">Metal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tipo</td>
                                                        <td>
                                                            <?php mostrarMetal($datosArticulo[6]);?>
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>Peso</td>
                                                        <td>
                                                            <?php echo $datosArticulo[7];?> g.
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                    </div>
                                    <div class="col-md-3 ratting-wrap">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">Piedra Principal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tipo</td>
                                                        <td>
                                                            <?php mostrarPiedra($datosArticulo[8]);?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Corte</td>
                                                        <td>
                                                            <?php echo $datosArticulo[9];?>
                                                        </td>
                                                    </tr>                                    
                                                    <tr>
                                                        <td>Peso</td>
                                                        <td>
                                                            <?php echo $datosArticulo[10];?> ct
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Color</td>
                                                        <td>
                                                            <?php echo $datosArticulo[11];?> 
                                                        </td>
                                                    </tr>                                    
                                                    <tr>
                                                        <td>Pureza</td>
                                                        <td>
                                                            <?php echo $datosArticulo[12];?> 
                                                        </td>
                                                    </tr> 
                                                    
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="col-md-3 ratting-wrap">
                                            
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">Piedra Secundaria</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tipo</td>
                                                        <td>
                                                            <?php mostrarPiedra($datosArticulo[13]);?>
                                                        </td>
                                                    </tr>
                                                                                      
                                                    <tr>
                                                        <td>Peso</td>
                                                        <td>
                                                            <?php echo $datosArticulo[14];?> ct
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Color</td>
                                                        <td>
                                                            <?php echo $datosArticulo[15];?> 
                                                        </td>
                                                    </tr>                                    
                                                    <tr>
                                                        <td>Pureza</td>
                                                        <td>
                                                            <?php echo $datosArticulo[16];?> 
                                                        </td>
                                                    </tr> 
                                                    
                                                </tbody>
                                            </table>
                                        
                                        </div>
                                    </div>














                            </div>
                        </div>

                        
                        
                        <div class="tab-pane" id="review">
                            
                            <div class="add-review">

                                <form action="contactoSend.php" method="POST">
                                <input type="hidden" name="producto" value="<?php echo $producto; ?>">
                                <input type="hidden" name="tipo" value="CONSULTA">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <p>Nombre:</p>
                                            <input type="text" placeholder="" name="nombre" />
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <p>Email:</p>
                                            <input type="email" placeholder="" name="email" />
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <p>Teléfono:</p>
                                            <input type="text" placeholder="" name="telefono" />
                                        </div>
                                        <div class="col-12">
                                            <p>Mensaje:</p>
                                            <textarea name="mensaje" id="massage" cols="30" rows="5" placeholder=""></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn-style">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php consultaProductoRel($datosArticulo[1], 1, "detalle"); ?>

            <?php consultaProductoSimilares($codSubCategoria, "detalle"); ?>




        </div>
    </div>
    



<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-9">
                <h3>
                    Carousel Product Cart Slider</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example"
                        data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example"
                            data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product Example</h5>
                                            <h5 class="price-text-color">
                                                $249.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Next Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $149.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Grouped Product</h5>
                                            <h5 class="price-text-color">
                                                $249.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $149.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-md-9">
                <h3>
                    Carousel Product Cart Slider</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example-generic"
                        data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-primary" href="#carousel-example-generic"
                            data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product Example</h5>
                                            <h5 class="price-text-color">
                                                $249.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Next Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $149.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Grouped Product</h5>
                                            <h5 class="price-text-color">
                                                $249.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $149.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--//////////////////////////////////////////////////////////////////////////////////////////////-->
    
    <?php include ("inc-bottom.php");?>
    
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- mouse_scroll.js -->
    <script src="assets/js/mouse_scroll.js"></script>
    <!-- scrollup.js -->
    <script src="assets/js/scrollup.js"></script>
    <!-- slicknav.js -->
    <script src="assets/js/slicknav.js"></script>
    <!-- jquery.zoom.min.js -->
    <script src="assets/js/jquery.zoom.min.js"></script>
    <!-- swiper.min.js -->
    <script src="assets/js/swiper.min.js"></script>
    <!-- metisMenu.min.js -->
    <script src="assets/js/metisMenu.min.js"></script>
    <!-- mailchimp.js -->
    <script src="assets/js/mailchimp.js"></script>
    <!-- jquery-ui.min.js -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- main js -->
    <script src="assets/js/scripts.js"></script>

    <!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53fc99fd4bf9bbf5"></script>


</body>

</html>