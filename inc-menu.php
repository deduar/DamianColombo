<?php $_SESSION["carro"] = isset($_SESSION["carro"]) ? $_SESSION["carro"] : null; ?>
<!-- header-area start -->
<header class="header-area fixed-top" id="sticky-header">
  <div class="container">
    <div class="row">
      <!-- <div class="col-lg-3 col-6"> -->
      <div class="d-none d-lg-block col-lg-3 col-6">
        <div class="logo" >
          <a href="index.php">
            <img src="assets/images/logo.png" alt="">
          </a>
        </div>
      </div>

      <div class="d-lg-none .d-xl-block col-lg-3 col-6">
        <!-- <div class="d-none d-sm-block logo" > -->
        <div class="logo2">
          <a href="index.php">
            <img class="logoSize" src="assets/images/logo-xs.png" alt="">
          </a>
        </div>

      </div>
      <div class="col-lg-8 d-none d-lg-block ">
        <div class="mainmenu">
          <ul id="navigation" class="d-flex">
            <li class="active"><a href="javascript:void(0);">Jewelry <i class="fa fa-angle-down"></i></a>
              <ul class="megamenu row">
                <li class="col-lg-3 col-12 col-x-3">
                  <strong><a href="rings">Rings</a></strong>
                  <div class=" d-none d-sm-block"><a href="rings"><img src="assets/images/04.gif" alt="" class="img-responsive"></a></div>
                </li>
                <li class="col-lg-3 col-12 col-x-3">
                  <strong><a href="earrings">Earrings</a></strong>
                  <div class=" d-none d-sm-block"><a href="earrings"><img src="assets/images/01.gif" alt="" class="img-responsive"></a></div>
                </li>
                <li class="col-lg-3 col-12 col-x-3">
                  <strong><a href="bracelets">Bracelets</a></strong>
                  <div class=" d-none d-sm-block"><a href="bracelets"><img src="assets/images/03.gif" alt="" class="img-responsive"></a></div>
                </li>
                <li class="col-lg-3 col-12 col-x-3">
                  <strong><a href="necklaces">Necklaces</a></strong>
                  <div class=" d-none d-sm-block"><a href="necklaces"><img src="assets/images/02.gif" alt="" class="img-responsive"></a></div>
                </li>
              </ul>
            </li>

            <li class="active"><a href="javascript:void(0);">Bridal <i class="fa fa-angle-down"></i></a>
              <ul class="megamenu row">
                <li class="col-lg-4 col-12 col-x-4">
                  <strong><a href="engagement-rings">Engagement Rings</a></strong>

                  <div class="d-none d-sm-block"><a href="engagement-rings"><img src="assets/images/05.gif" alt="" class="img-responsive"></a></div>

                </li>
                <li class="col-lg-4 col-12 col-x-4">
                  <strong><a href="wedding-bands">Wedding bands</a></strong>
                  <div class=" d-none d-sm-block"><a href="wedding-bands"><img src="assets/images/06.gif" alt="" class="img-responsive"></a></div>
                </li>
                <li class="col-lg-4 col-12 col-x-4">
                  <strong><a href="love-celebrations">Love Celebrations</a></strong>
                  <div class=" d-none d-sm-block"><a href="love-celebrations"><img src="assets/images/07.gif" alt="" class="img-responsive"></a></div>
                </li>

              </ul>
            </li>

            <li class="active"><a href="high-jewelry">High Jewelry</a></li>
            <li class="active"><a href="about-us">About Us</a></li>
            <li class="active"><a href="javascript:void(0);">Education <i class="fa fa-angle-down"></i></a>
              <ul class="submenu">
                <li><a href="education">Education</a></li>
                <li><a href="bridal-diamond-jewelry">Bridal and Diamond Jewelry</a></li>

              </ul>
            </li>
            <li class="active"><a href="news">News</a></li>
            <li class="active"><a href="contact">Contact Us</a></li>

          </ul>
        </div>
      </div>
      <div class="col-lg-1 col-sm-5 col-4">
        <div class="search-wrapper">
          <ul class="d-flex">
            <li><a href="javascript:void(0);"><i class="fa fa-search"></i></a>
              <ul class="search">
                <li>
                  <form action="search-result" method="POST">
                    <input type="text" placeholder="Search..." maxlength="30" name="search" id="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                  </form>
                </li>
              </ul>
            </li>
            <li><a href="javascript:void(0);"><i class="fa fa-shopping-bag"></i></a>
              <?php
              if($_SESSION['carro']){
                $totalcoste = 0;
                //Inicializamos el contador de productos seleccionados.
                $xTotal = 0;
                ?>
                <ul class="cart-wrap">
                  <?php carritoTemporal("menu"); ?>
                  <?php $totalcoste=carritoTemporalTotal(); ?>
                  <li><a href="#"><b>Total: <span class="pull-right">U$S <?php echo $totalcoste;?></span></b></a></li>
                  <li>
                    <hr>
                    <center><b><a href="bag">My Bag</a></b></center>
                  </li>
                </ul>

              <?php } else { ?>
                <ul class="account-wrap">
                  <li><a href="#">Empty</a></li>
                </ul>
              <?php } ?>
            </li>
            <li><a href="javascript:void(0);"><i class="fa fa-user"></i></a>
              <ul class="account-wrap">
                <?php
                if(isset($_SESSION['idUsuario'])){ ?>
                  <li><strong><a href="#"><?php echo substr(trim($_SESSION["nombre"]),0,23);?></a></strong></li>
                  <li><a href="cuenta">My Account</a></li>
                  <li><a href="wishlist">Wishlist</a></li>
                  <li><a href="logout">Logout</a></li>
                <?php }else{ ?>
                  <li><a href="login">My Account</a></li>
                  <!--<li><a href="#">wishlist</a></li>-->
                <?php } ?>

              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="d-block d-lg-none col-sm-1 clear col-2">
        <div class="responsive-menu-wrap floatright"></div>
      </div>
    </div>
  </div>
</header>
<div class="margen-top"></div>



<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/5b58cecfe21878736ba24e9e/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
