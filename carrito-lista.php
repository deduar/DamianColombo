<?php session_start();?>
<?ob_start();?>
<?php include ("backoffice/connect.php");?>
<?php include ("backoffice/incFunction.php");?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>My Bag</title>
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
</head>

<body>
  <!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->


  <!-- <div class="preloader-wrap">
  <div class="spinner"></div>
</div> -->
<?php include ("inc-menu.php");?>
<?php
if($_SESSION['carro']){
  $totalcoste = 0;
  //Inicializamos el contador de productos seleccionados.
  $xTotal = 0;
  ?>
  <!-- top -->
<div class="breadcumb-area ptb-15">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="bg-lg-img-11">
                  <h4>My Bag</h4>
            </div>
          </div>
        </div>
      </div>
    </div>


<!--

  <div class="breadcumb-area ptb-15">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="col d-none d-sm-block">
              <div class="bg-lg-img-11">
                  <h4>My Bag</h4>
              </div>
          </div>
          <div class="d-lg-none d-xl-none">
              <div class="bg-img-11">
                  <h4>My Bag</h4>
              </div>
          </div>



        </div>
      </div>
    </div>
  </div>-->

  <div class="cart-area col d-none d-sm-block">
    <div class="container">
      <div class="row">
        <div class="col-12">

          <table class="table-responsive cart-wrap">
            <thead>
              <tr>
                <th class="images"></th>
                <th class="product">Product</th>
                <th class="ptice">Price</th>
                <th class="quantity">Quantity</th>
                <th class="total">Total</th>
                <th class="remove">Delete</th>
              </tr>
            </thead>
            <tbody>

              <?php carritoTemporal("carrito-lista"); ?>

            </tbody>
          </table>
          <div class="row mt-60">
            <div class="col-xl-4 col-lg-5 col-md-6 ">
              <div class="cartcupon-wrap">
                <ul class="d-flex">
                  <li><a href="rings">Continue Buying</a></li>
                </ul>
                <!--<h3>Cupon</h3>
                <p>Enter Your Cupon Code if You Have One</p>
                <div class="cupon-wrap">
                <input type="text" placeholder="Cupon Code">
                <button>Apply Cupon</button>
              </div>-->
            </div>
          </div>

          <?php $totalcoste=carritoTemporalTotal(); ?>

          <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
            <div class="boton-oscuro text-right">
              <!-- <span class="txt-total"><b> Total  U&#36D <?php echo $totalcoste;?></b></span> -->

              <a href="checkout-login.php">Proceed to Checkout</a>
              <br><br>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<div class="d-lg-none d-xl-none">

  <?php carritoTemporal("carrito-xs"); ?>

  <hr>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-sm-12 col-12">
        <!-- U&#36D -->
        <center><h3> Total U&#36D  <?php echo $totalcoste;?></h3></center>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-sm-12 col-12">
        <form action="checkout-login" method="POST">
          <button type="submit" class="btnCheckout">Proceed to Checkout</button>
        </form>
        <br><br>
      </div>
    </div>
    <!--<div class="row">
      <div class="col-lg-6 col-sm-6 col-6">
        <img src="assets/images/icon-envio.png">
      </div>
      <div class="col-lg-6 col-sm-6 col-6">
        <a href='https://www.mercadopago.com.ar/cuotas' target="_blank"><img src="assets/images/icon-mercado-pago.png"></a>
      </div>
    </div>-->
  </div>
  <hr>





</div>


<?php }else{ ?>
  <div class="cart-area ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>Bag</h2>
          <p>Empty</p>
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
<?php  //print "<pre>"; print_r($_SESSION); print "</pre>\n"; ?>

</body>

</html>
