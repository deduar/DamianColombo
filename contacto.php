<?php session_start();?>
<?ob_start();?>
<?php
include ("backoffice/incFunction.php");
$flagEnvio = isset($_GET['flagEnvio']) ? $_GET['flagEnvio'] : null;
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Contact Us</title>
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
    <div class="breadcumb-area ptb-15">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="bg-img-10">
              <h4>Contact Us</h4>
            </div>

          </div>
        </div>
      </div>
    </div>


    <div class="contact-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                  <?php if ($flagEnvio=="ok") : ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      Your query was sent successfully. Shortly we will be contacting you.
                    </div>
                   <?php endif; ?>

                   <?php if ($flagEnvio=="false") : ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      The query wasn't sent try again.
                    </div>
                   <?php endif; ?>

                      <div class="account-form form-style">
                        <div class="cf-msg"></div>
                        <form action="contactoSend.php" method="post">
                        <input type="hidden" name="tipo" value="CONTACTO">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <input type="text" placeholder="Name" id="fname" name="nombre" maxlength="40" required>
                                </div>
                                <div class="col-12  col-sm-6">
                                    <input type="text" placeholder="Email" id="email" name="email" maxlength="40" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" placeholder="Phone" id="subject" name="telefono" maxlength="40">
                                </div>
                                <div class="col-12">
                                    <textarea class="contact-textarea" placeholder="Message" maxlength="550" rows="4" name="mensaje"></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="g-recaptcha" data-sitekey="6Lc5IhUUAAAAANoax8NG5hCBwLNmz6zOkUnSNSPr"></div>
                                </div>
                                <div class="col-4">
                                    <button name="submit">Contact Us</button>
                                     <div class="margen-50"></div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="contact-wrap">
                        <ul>

                            <li>
                                <i class="fa fa-envelope"></i> Email:
                                <p>
                                    <span><a href="mailto:sales@damiancolombo.com">sales@damiancolombo.com</a></span>
                                </p>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> Phone:
                                <p>
                                    <span><a href="https://wa.me/17863518210">+1 (786) 351-8210</a></span>

                                </p>
                            </li>
                        </ul>
                    </div>
                    <br>
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
