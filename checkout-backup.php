<?php session_start();?>
<?ob_start();?>
<?php include ("backoffice/connect.php");?>
<?php include ("backoffice/incFunction.php");?>
<?php require_once "lib/mercadopago.php";?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Damian Colombo</title>
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
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    

    <div class="preloader-wrap">
        <div class="spinner"></div>
    </div>
    <?php include ("inc-menu.php");?>


<?php    
    if($_SESSION['carro']){ 
      $totalcoste = 0;
      //Inicializamos el contador de productos seleccionados.
      $xTotal = 0;
    ?>  


    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Datos de Compra</h3>
                        <a href="#">> Estoy registrado acceder</a><hr>
                        <form action="checkout">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <p>Nombre *</p>
                                    <?php campo(40, 1, "text", "nombre", "", "")?>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Apellido *</p>
                                    <?php campo(40, 1, "text", "apellido", "", "")?>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email *</p>
                                    <?php campo(40, 1, "email", "email", "", "")?>                                    

                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Teléfono *</p>
                                    <?php campo(40, 1, "text", "telefono", "", "")?>                                    
                                </div>
                                <div class="col-12">
                                    <p>Dirección *</p>
                                    <?php campo(60, 1, "text", "direccion", "", "")?>                                                                        
                                </div>
                                
                                <div class="col-sm-5 col-12">
                                    <p>Localidad *</p>
                                    <?php campo(50, 1, "text", "localidad", "", "")?>
                                </div>
                                <div class="col-sm-5 col-12">
                                    <p>Provincia *</p>
                                    <?php obtenerComboProvincias("Buenos Aires"); ?>
                                </div>
                                <div class="col-sm-2 col-12">
                                    <p>C.P.</p>
                                    <?php campo(15, 1, "text", "cp", "", "")?>
                                </div>
                                <div class="col-12">
                                    <p>Observaciones </p>
                                    <textarea name="massage" ></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Compra</h3>
                        <ul class="total-cost">

                            <?php carritoTemporal("checkout"); ?>
                            <?php $totalcoste=carritoTemporalTotal(); ?>

                            <li></li>
                            <li>Total<span class="pull-right">$ <?php echo $totalcoste;?></span></li>
                        </ul>
                        
                        <!--<button>Realizar el Pago</button>-->

                        <!-- INICIO BOTON DE PAGO CON TARJETA -->                    
                        
                                    <?php 
                                    $totalcoste=1200;

                                    $descripcion_pedido="Pedido: DAMIAN COLOMBO";
                                    $mp = new MP ("1856382750950229", "DiekD4lwC7wO7QttzhBN2rQjqmeIBVs9");
                                    $texto_pedido="Pedido num ";
                                            $preference_data = array (
                                            "items" => array (
                                                array (
                                                    "title" => $descripcion_pedido,
                                                    "quantity" => 1,
                                                    "currency_id" => "ARS",
                                                    "unit_price" => $totalcoste
                                                )
                                            ),
                                            "shipments" => array(
                                                "mode" => "me2",
                                                "dimensions" => "30x30x30,500",
                                                "local_pickup" => true,
                                                "default_shipping_method" => 73328,
                                                "zip_code" => "C1107CMB"
                                            )
                                    );
                                            

                                      $preference = $mp->create_preference ($preference_data);
                                        ?>
                                 
                                      
                                      <!--<center><a href="<?//php echo $preference['response']['sandbox_init_point']; ?>" class="button login" title="Proceder a la Compra" ><span>Proceder a la Compra</span></a></center>-->

                                      <a href="<?php echo $preference['response']['init_point']; ?>" name="MP-Checkout" class="lightblue-M-Ov-ArOn" mp-mode="modal" onreturn="execute_my_onreturn">Pagar la compra</a>

                                      <!--<a href="<?//php echo $preference['response']['sandbox_init_point']; ?>" name="MP-Checkout" class="lightblue-M-Ov-ArOn" mp-mode="modal" onreturn="execute_my_onreturn">Pagar la compra</a>-->


                                      <script type="text/javascript">
                                      function execute_my_onreturn (json) {
                                          if (json.collection_status=='approved'){
                                               location.href="carrito-update-pago.php";
                                          } else if(json.collection_status=='pending'){
                                              alert ('No se completó el pago');
                                          } else if(json.collection_status=='in_process'){    
                                              alert ('El pago está siendo revisado');    
                                          } else if(json.collection_status=='rejected'){
                                              alert ('El pago fué rechazado, el usuario puede intentar nuevamente el pago');
                                          } else if(json.collection_status==null){
                                              alert ('No completó el proceso de pago, no se ha generado ningún pago');
                                              //location.href="carrito-update.php";
                                          }
                                      }
                                      </script>


                                    <!-- FIN BOTON DE PAGO CON TARJETA --> 


                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php } ?>
    
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
    <script type="text/javascript">
(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
</script>

</body>

</html>