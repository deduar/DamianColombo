<!doctype html>
<?php include ("backoffice/incFunction.php");?>
<?php
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$codigo = htmlspecialchars($codigo);

$flagEnvio = isset($_GET['flagEnvio']) ? $_GET['flagEnvio'] : null;

$codSubCategoria = isset($_GET['codSubCategoria']) ? $_GET['codSubCategoria'] : null;
$codSubCategoria = htmlspecialchars($codSubCategoria);

//$codigo=desencriptar($codigo, $enc33);

$datosArticulo=array();
$datosArticulo=consultaArticuloCodigo($codigo);

$archivo_actual = basename($_SERVER['PHP_SELF']);
$path=$archivo_actual."?codigo=".$datosArticulo[1];
$producto=utf8_encode($datosArticulo[1])." | ".utf8_encode($datosArticulo[27]);

?>

<html class="no-js" lang="">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $datosArticulo[27]; ?></title>
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


  <!--//////////////////////////////////////////////////////////////////////////////////////////////-->


  <div class="single-product-area ptb-25">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="d-md-none"><h5><?php echo $datosArticulo[27]; ?></h5></div>
          <hr>


          <div class="d-lg-none d-xl-none">
            <div>
              <?php obtenerImagenesDetalle($codigo, "xs")?>
            </div>
          </div>

          <div class="col d-none d-sm-block">
            <div>
              <?php obtenerImagenesDetalle($codigo, "lg")?>
            </div>
          </div>



        </div>
        <div class="col-lg-1">
        </div>
        <div class="col-lg-5">
          <div class="product-single-content">
            <?php if ($flagEnvio=="ok") : ?>
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Your query was sent successfully. Shortly we will be contacting you.
              </div>
            <?php endif; ?>

            <?php if ($flagEnvio=="false") : ?>
              <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                The query was not sent try again.
              </div>
            <?php endif; ?>

            <div class=" d-none d-sm-block"><h3><?php echo $datosArticulo[27]; ?></h3></div>
            <div class=" d-none d-sm-block"><?php echo trim($datosArticulo[28]); ?></div>
            <?php If($codigo=='AWG0064' OR $codigo=='AWG0061' OR $codigo=='AWG0067' OR $codigo=='AWG0066' OR $codigo=='AWG0062' OR $codigo=='AWG0063' OR $codigo=='AWG0059' OR $codigo=='AWG0068'){?>
              <img src="assets/images/falber-diamonds.png">
              <br><br>
            <?php } ?>

            <div class="row">
              <div class="col-lg-8 col-sm-8 col-8">
                <span class="text-cod"> Product Code: <?php echo $datosArticulo[1]; ?></span><br>
                <?php If ($codSubCategoria <> 6){ ?>
                  <?php calculoPrecio("detalle", $datosArticulo[2], $datosArticulo[18], $datosArticulo[19], 1); ?>
                  <!-- // VERIFICA EL STOCK-->
                <?php } ?>
              </div>
              <div class="col-lg-4 col-sm-4 col-4">
                <!--///// Otros Metales-->
                <?php otroMetales($datosArticulo[1]); ?>
                <!--///// Fin Otros Metales-->
                <!--///// Inicio Wishlist -->
                <div class='featured-product-content'>
                  <div  class="item-opciones">
                    <ul>
                      <?php if(isset($_SESSION['idUsuario'])){
                        echo "<li><a href='wishlist-temp.php?codigo=".$codigo."' data-toggle='tooltip' data-placement='top' title='Wishlist'><i class='fa fa-heart'></i></a></li>";
                      }else{
                        echo "<li><a href='login.php?e=3&orig=2' data-toggle='tooltip' data-placement='top' title='Wishlist'><i class='fa fa-heart'></i></a></li>";
                      } ?>
                    </ul>
                  </div>
                </div>
                <!--///// Fin Wishlist -->
              </div>
            </div>



            <?php

            // If ($datosArticulo[4] >= 1 AND $codSubCategoria <> 6 ) {
            //   comboCantidad($datosArticulo[0], $datosArticulo[4], "gral", 0, $codigo, $datosArticulo[5]); ?>

            <?//php }else{ ?>

              <h5>Consult </h5>
              <hr>

              <div class="add-review">
                <form action="contactoSend.php" method="POST">
                  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
                  <input type="hidden" name="producto" value="<?php echo $producto; ?>">
                  <input type="hidden" name="codSubCategoria" value="<?php echo $codSubCategoria; ?>">
                  <input type="hidden" name="tipo" value="ORDENAR">
                  <div class="row">
                    <div class="col-md-6 col-12">
                      Name:
                      <input type="text" placeholder="" name="nombre" maxlength="40" required />
                    </div>
                    <div class="col-md-6 col-12">
                      Email:
                      <input type="email" placeholder="" name="email" maxlength="40" required />
                    </div>
                    <div class="col-md-12 col-12">
                      Phone:
                      <input type="text" placeholder="" name="telefono" maxlength="40" required />
                    </div>
                    <div class="col-12">
                      Message:
                      <textarea name="mensaje" id="massage" cols="30" rows="5" placeholder="" maxlength="350"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="g-recaptcha" data-sitekey="6Lc5IhUUAAAAANoax8NG5hCBwLNmz6zOkUnSNSPr"></div>
                    </div>
                    <div class="col-12">
                      <button type="submit">Order</button>
                    </div>
                  </div>
                </form>
              </div>

            <?//php } ?>
            <hr>
            <?php
            If ($datosArticulo[26]=='1'){ ?>
            <center><a href='size-guide' target="_blank" class="linkMedida">Size Guide</a></center>
            <?php } ?>

            <?php If ($datosArticulo[26]=='4'){ ?>
              <a data-toggle='modal' data-target='#exampleModalCenter' href='javascript:void(0);' class="linkMedida">Size Guide</a>

              <br><br>
              <div class='modal fade' id='exampleModalCenter' tabindex='-1'>
                <div class='modal-dialog modal-dialog-centered'>
                  <div class='modal-content'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                    <div class='modal-body2 d-flex'>
                      <div class="col-lg-3">
                      </div>
                      <div class="col-lg-9">
                        <img src='assets/images/cadena-medida--mujer.png' alt=''>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>


            <div class=" d-md-none"><hr>Description:<br><?php echo trim($datosArticulo[3]); ?></div>

            <hr>
            <!--<div class="row">
              <div class="col-lg-6 col-sm-6 col-6">
                <img src="assets/images/icon-envio.png">
              </div>
              <div class="col-lg-6 col-sm-6 col-6">
                <a href='https://www.mercadopago.com.ar/cuotas' target="_blank"><img src="assets/images/icon-mercado-pago.png"></a>
              </div>
            </div>
            <hr>-->
            <div class="row">
              <div class="col-lg-6 col-sm-6 col-6">
                <div class="d-lg-none">
                  <a href="whatsapp://send?text=http://www.damiancolombo.com/<?php echo $path; ?>" data-action="share/whatsapp/share">
                    <img border="0" src="assets/images/icon-wp.png">
                  </a>
                </div>
              </div>
              <div class="col-lg-6 col-sm-6 col-6">
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox_525e"></div>
              </div>
            </div>

            <hr>

          </div>
        </div>
      </div>

      <div class="row mt-60">
        <div class="col-12">
          <div class="single-product-menu">
            <ul class="nav">
              <li><a class="active" data-toggle="tab" href="#certificado"> Certificate </a> </li>
              <li><a  data-toggle="tab" href="#medida"> Technical Information </a> </li>
              <li><a data-toggle="tab" href="#review"> Consult </a></li>
            </ul>
          </div>
        </div>
        <div class="col-12">
          <div class="tab-content">

            <div class="tab-pane active" id="certificado">
              <div class="description-wrap">

                <?php If ($datosArticulo[17] != "" AND $datosArticulo[17] != "DC Report") {?>
                  <a href="assets/certificados/<?php echo $datosArticulo[17];?>.pdf" target="_blank">Download Certificate</a>
                  <br>
                <?php } ?>

                <?php If ($datosArticulo[24] >= 2) {?>
                  <a href="certificado-pdf.php?codigo=<?php echo $datosArticulo[1];?>" target="_blank">Download DC Certificate</a>
                <?php } ?>

                <?php If ($datosArticulo[24] == 1) {?>
                  <a href="certificado-fancy-pdf.php?codigo=<?php echo $datosArticulo[1];?>" target="_blank">Download DC Certificate</a>
                <?php } ?>

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
                          <td>Type</td>
                          <td>
                            <?php mostrarMetal($datosArticulo[6]);?>
                          </td>

                        </tr>
                        <tr>
                          <td>Weight</td>
                          <td>
                            <?php echo $datosArticulo[7];?>
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
                          <td>Type</td>
                          <td>
                            <?php mostrarPiedra($datosArticulo[8]);?>
                          </td>
                        </tr>
                        <tr>
                          <td>Cut</td>
                          <td>
                            <?php echo $datosArticulo[9];?>
                          </td>
                        </tr>
                        <tr>
                          <td>Weight</td>
                          <td>
                            <?php echo $datosArticulo[10];?>
                          </td>
                        </tr>
                        <tr>
                          <td>Colour</td>
                          <td>
                            <?php echo $datosArticulo[11];?>
                          </td>
                        </tr>
                        <tr>
                          <td>Purity</td>
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
                          <th colspan="2">Secondary Stone</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Type</td>
                          <td>
                            <?php mostrarPiedra($datosArticulo[13]);?>
                          </td>
                        </tr>

                        <tr>
                          <td>Weight</td>
                          <td>
                            <?php echo $datosArticulo[14];?>
                          </td>
                        </tr>
                        <tr>
                          <td>Colour</td>
                          <td>
                            <?php echo $datosArticulo[15];?>
                          </td>
                        </tr>
                        <tr>
                          <td>Purity</td>
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
                  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
                  <input type="hidden" name="producto" value="<?php echo $producto; ?>">
                  <input type="hidden" name="codSubCategoria" value="<?php echo $codSubCategoria; ?>">
                  <input type="hidden" name="tipo" value="CONSULTA">
                  <div class="row">
                    <div class="col-md-4 col-12">
                      <p>Name:</p>
                      <input type="text" placeholder="" name="nombre" />
                    </div>
                    <div class="col-md-4 col-12">
                      <p>Email:</p>
                      <input type="email" placeholder="" name="email" />
                    </div>
                    <div class="col-md-4 col-12">
                      <p>Phone:</p>
                      <input type="text" placeholder="" name="telefono" />
                    </div>
                    <div class="col-12">
                      <p>Message:</p>
                      <textarea name="mensaje" id="massage" cols="30" rows="5" placeholder=""></textarea>
                    </div>
                    <div class="col-12">
                        <div class="g-recaptcha" data-sitekey="6Lc5IhUUAAAAANoax8NG5hCBwLNmz6zOkUnSNSPr"></div>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn-style"> Send </button>
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
