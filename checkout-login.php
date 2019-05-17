<?php session_start();?>
<?ob_start();?>
<?php include ("backoffice/connect.php");?>
<?php include ("backoffice/incFunction.php");?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Customer Login</title>
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

    <!-- top -->

    <div class="breadcumb-area ptb-15">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="bg-lg-img-11">
                  <h4>Checkout</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- fin top -->
    <div class="d-lg-none d-xl-none">
      <div class="checkout-area">
        <div class="container">
          <div class="row">

            <div class="col-lg-12 col-sm-12 col-12">
              <form action="checkout" method="POST">
                <button type="submit" class="btnCheckout">Checkout as a Guest</button>
              </form>
              <hr>
              <form action="login?orig=1" method="POST">
                <button type="submit" class="btnCheckout">Sign in to your account </button>
              </form>
            </div>
          </div>
          <hr>
        </div>
      </div>
    </div>

    <?php
    /*
      include ("backoffice/connect.php");
      $precioTotal=0;
     foreach ($_SESSION['carro'] as $key => $value) {
        $sql = "SELECT precioLista, precioFinal FROM productmain WHERE idProductMain = ".$key;
        $stmt = $mysqli->query($sql);
        $data = $stmt->fetch_assoc();
        $precioAux=($data['precioLista']*$data['precioFinal'])/100;
        $precio=$data['precioLista']-$precioAux;
        $precioTotal=$precio+$precioTotal;
      }
      //var_dump($precioTotal);
      */
    ?>

    <div class="col d-none d-sm-block">
      <div class="checkout-area">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-sm-3 col-3">
            </div>
            <div class="col-lg-6 col-sm-6 col-6">
              <form action="checkout.php" method="POST">
                <button type="submit" class="btnCheckout">Checkout as a Guest</button>
              </form>
              <hr>
              <form action="login?orig=1" method="POST">
                <button type="submit" class="btnCheckout">Sign in to your account</button>
              </form>
            </div>
            <div class="col-lg-3 col-sm-3 col-3">
            </div>
          </div>
          <hr>

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

  <?php  //var_dump($_SESSION);  ?>

</body>

</html>
