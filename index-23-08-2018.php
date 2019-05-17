<?php session_start();?>
<?ob_start();?>
<!doctype html>
<?php
include ("backoffice/incFunction.php");
include ("backoffice/connect.php");
?>

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




<!-- slider-area start -->
    <div class="slider-area slider-area">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slide-inner slide-inner4">
                        <div class="container">
                            <div class="row">
                                 <div class="col-xl-5 offset-xl-7 col-lg-6 offset-lg-6 col-md-8 offset-md-4">
                                    <div class="slider-content text-right">


                                        <h2 data-swiper-parallax="-500">“Beauty begins the moment you decide to be yourself.” </h2>
                                        <p data-swiper-parallax="-400">Coco Chanel.</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-inner slide-inner5">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-5 col-lg-6 col-md-8">
                                    <div class="slider-content">
                                         <h2 data-swiper-parallax="-500">“Elegance is not about being noticed, it’s about being remembered.”</h2>
                                        <p data-swiper-parallax="-400">Giorgio Armani.</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-button-next fa fa-long-arrow-right"></div>
            <div class="swiper-button-prev  fa fa-long-arrow-left"></div>
        </div>
    </div>
    <!-- slider-area end -->



    <div class="category-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Joyería</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-6">
                    <a href="anillos">
                    <div class="category-wrap">
                        <img src="assets/images/category/1.jpg" alt="">
                        <div class="category-content flex-style">
                            <h3>Anillos</h3>
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-6">
                    <a href="aros">
                    <div class="category-wrap">
                        <img src="assets/images/category/2.jpg" alt="">
                        <div class="category-content flex-style">
                            <h3>Aros</h3>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-6">
                    <a href="pulseras">
                    <div class="category-wrap">
                        <img src="assets/images/category/3.jpg" alt="">
                        <div class="category-content flex-style">
                            <h3>Pulseras</h3>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-6">
                    <a href="collares">
                    <div class="category-wrap">
                        <img src="assets/images/category/4.jpg" alt="">
                        <div class="category-content flex-style">
                            <h3>Collares</h3>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Más Vendidos</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9 col-lg-10">
                    <div class="product-menu">
                        <ul class="nav">
                            <li>
                                <a class="active" data-toggle="tab" href="#1">Anillos</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#2">Aros</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#3">Pulseras</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#4">Collares</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="tab-content">

                <?php obtenerDestacados(2,1)?>
                <?php obtenerDestacados(2,2)?>
                <?php obtenerDestacados(2,3)?>
                <?php obtenerDestacados(2,4)?>



            </div>
        </div>
    </div>



    <br><br><br>


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
