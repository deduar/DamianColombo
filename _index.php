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



  <!-- ////////////////////////////////////////////////////////////////////////////// -->
  <!-- ////////////////////////////////////////////////////////////////////////////// -->
  <!-- ////////////////////////////////////////////////////////////////////////////// -->

  <!-- LOAD JQUERY LIBRARY -->
  		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>

  <link rel="stylesheet" type="text/css" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

  <!-- REVOLUTION STYLE SHEETS -->
  <link rel="stylesheet" type="text/css" href="css/settings.css">



  <style type="text/css">.hesperiden.tparrows{cursor:pointer;background:rgba(0,0,0,0.5);width:40px;height:40px;position:absolute;display:block;z-index:100;  border-radius:50%}.hesperiden.tparrows:hover{background:rgba(0,0,0,1)}.hesperiden.tparrows:before{font-family:"revicons";font-size:20px;color:rgb(255,255,255);display:block;line-height:40px;text-align:center}.hesperiden.tparrows.tp-leftarrow:before{content:"\e82c";  margin-left:-3px}.hesperiden.tparrows.tp-rightarrow:before{content:"\e82d";  margin-right:-3px}</style>


  <!-- ADD-ONS CSS FILES -->
  <!-- ADD-ONS JS FILES -->
  <!-- REVOLUTION JS FILES -->
  <script type="text/javascript" src="js/jquery.themepunch.tools.min.js"></script>
  <script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script>

  <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
  <script type="text/javascript" src="js/extensions/revolution.extension.actions.min.js"></script>
  <script type="text/javascript" src="js/extensions/revolution.extension.carousel.min.js"></script>
  <script type="text/javascript" src="js/extensions/revolution.extension.kenburn.min.js"></script>
  <script type="text/javascript" src="js/extensions/revolution.extension.layeranimation.min.js"></script>
  <script type="text/javascript" src="js/extensions/revolution.extension.migration.min.js"></script>
  <script type="text/javascript" src="js/extensions/revolution.extension.navigation.min.js"></script>
  <script type="text/javascript" src="js/extensions/revolution.extension.parallax.min.js"></script>
  <script type="text/javascript" src="js/extensions/revolution.extension.slideanims.min.js"></script>
  <script type="text/javascript" src="js/extensions/revolution.extension.video.min.js"></script>


  <script type="text/javascript">function setREVStartSize(e){
    try{ e.c=jQuery(e.c);var i=jQuery(window).width(),t=9999,r=0,n=0,l=0,f=0,s=0,h=0;
      if(e.responsiveLevels&&(jQuery.each(e.responsiveLevels,function(e,f){f>i&&(t=r=f,l=e),i>f&&f>r&&(r=f,n=e)}),t>r&&(l=n)),f=e.gridheight[l]||e.gridheight[0]||e.gridheight,s=e.gridwidth[l]||e.gridwidth[0]||e.gridwidth,h=i/s,h=h>1?1:h,f=Math.round(h*f),"fullscreen"==e.sliderLayout){var u=(e.c.width(),jQuery(window).height());if(void 0!=e.fullScreenOffsetContainer){var c=e.fullScreenOffsetContainer.split(",");if (c) jQuery.each(c,function(e,i){u=jQuery(i).length>0?u-jQuery(i).outerHeight(!0):u}),e.fullScreenOffset.split("%").length>1&&void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0?u-=jQuery(window).height()*parseInt(e.fullScreenOffset,0)/100:void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0&&(u-=parseInt(e.fullScreenOffset,0))}f=u}else void 0!=e.minHeight&&f<e.minHeight&&(f=e.minHeight);e.c.closest(".rev_slider_wrapper").css({height:f})
    }catch(d){console.log("Failure at Presize of Slider:"+d)}
  };</script>


  <!-- ////////////////////////////////////////////////////////////////////////////// -->


</head>

<body>
  <!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <!--
  <div class="preloader-wrap">
  <div class="spinner"></div>
</div> -->
<?php include ("inc-menu.php");?>

<!-- ////////////////////////////////////// slider-area start -->
<?php include ("inc-slider.php");?>
<!-- ///////////////////////////////////// slider-area end -->

  <?php include ("inc-bottom.php");?>


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
