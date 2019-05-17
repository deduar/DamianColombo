<?php 
header('Content-Type:text/html; charset=UTF-8');
session_start();
include ("backoffice/incFunction.php");

$orig = isset($_GET['orig']) ? $_GET['orig'] : null; 

$e = isset($_GET['e']) ? $_GET['e'] : null;  
$flagReg = isset($_GET['flagReg']) ? $_GET['flagReg'] : null;

$flagReg = htmlspecialchars($flagReg);
$e = htmlspecialchars($e);


?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Accedé a tu cuenta</title>
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

    <!-- RECAPTCHA -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- FIN RECAPTCHA -->


</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    

    <div class="preloader-wrap">
        <div class="spinner"></div>
    </div>
    <?php include ("inc-menu.php");?>
    <div class="cart-area ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Login</h1>
                    <hr>
                </div>
            </div>
        </div>
    </div>      
    
    
    <div class="account-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <?php if ($e=="1") : ?>
                          <div id="signalert2" class="alert alert-warning">
                                <p>Error, intente nuevamente.</p>
                          </div>
                    <?php endif; ?>
                    <?php if ($e=="2") : ?>
                          <div id="signalert2" class="alert alert-success">
                                <p>Se actualizó su password</p>
                          </div>
                    <?php endif; ?>            
                    <?php if ($flagReg=="1") : ?>
                          <div id="signalert2" class="alert alert-success">
                                <p>Se validó correctamente su registración, ingrese con sus datos.</p>
                          </div>
                    <?php endif; ?>      

                    <?php if ($e=="3") : ?>
                          <div id="signalert2" class="alert alert-success">
                                <p>Para crear tu Wishlist deberás loguearte.</p>
                          </div>
                    <?php endif; ?>      

                    <form action="login-validacion2.php" method="post" name="calform" id="calform">
                        <input type="hidden" name="orig" value="<?php echo $orig;?>">

                        <div class="account-form form-style">
                            <p>Email *</p>
                            <input type="email" maxlength="50" value="" name="email" required>
                            <p>Clave *</p>
                            <input type="password" maxlength="20" name="password" required>
                            
                            <div class="g-recaptcha" data-sitekey="6Lc5IhUUAAAAANoax8NG5hCBwLNmz6zOkUnSNSPr"></div>
                            
                            <button type="submit">ACCEDER</button>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="recuperar-clave">¿Olvidaste tu clave?</a>
                                    <hr>
                                    <a href="registrarse">Registrarme</a>
                                     <div class="margen-50"></div>
                                </div>
                                
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
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
</body>

</html>