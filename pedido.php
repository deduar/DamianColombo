<?php session_start();?>
<?php
include ("backoffice/incFunction.php");
setlocale(LC_MONETARY, 'en_US.UTF-8');

$sde = isset($_GET['sde']) ? $_GET['sde'] : null;
$id_pedido=desencriptar($sde, $enc33);
$id_pedido = htmlspecialchars($id_pedido);
$_SESSION["id_pedido"] = $id_pedido;
$idUsuario = $_SESSION["idUsuario"];


?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Orders</title>
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
  $datosPedido=array();
  $datosPedido=obtenerPedidosId($id_pedido);

  $estado=obtenerEstadoIngles($datosPedido[3]);


  ?>
  <div class="cart-area ptb-50">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h4>Order: <?php echo $id_pedido; ?></h4>
          <p>Date: <?php echo cambiaf_a_normal($datosPedido[2]); ?> | Hour: <?php echo $datosPedido[8];?></p>
          <p>State: <b><?php echo $estado; ?></b></p>
          <p>Observations: <?php echo $datosPedido[9]; ?></p>

          <br><br>
          <table class="cart-wrap">
            <thead>
              <tr>
                <th class="images"></th>
                <th class="product">Product</th>
                <th class="ptice">Price</th>
                <th class="quantity">Qty.</th>
                <th class="total">SubTotal</th>
              </tr>
            </thead>
            <tbody>




              <?php
              $subtotal=0;
              $total=0;
              $idUsuario  = $_SESSION["idUsuario"];

              include ("backoffice/connect.php");

              $sql        = "SELECT det_pedidos.cantidad, det_pedidos.precio, productmain.description, productmain.codigo FROM productmain INNER JOIN det_pedidos ON productmain.idProductMain = det_pedidos.id WHERE (det_pedidos.id_pedido = ?)";

              $stmt       = $mysqli->prepare($sql);
              $stmt->bind_param('i', $id_pedido) or die($mysqli->error);
              $stmt->execute();
              $stmt->bind_result($cantidad, $precio, $nombre, $codigo);

              while ($stmt->fetch()) {


                $subtotal=$precio*$cantidad;
                $total=$total+$subtotal;
                ?>



                <tr>
                  <?php
                  $filename = '/home/damianco/public_html/assets/images/productos';
                  $filename = $filename.'/'.$codigo.'BIG1.jpg';
                  if (file_exists($filename)) {
                    echo "<td class='images'><img src='assets/images/productos/".$codigo."BIG1.jpg' alt=''></td>";
                  } else {
                    echo "<td class='images'><img src='assets/images/productos/no-imagen.jpg' alt=''></td>";
                  }
                  ?>
                  <td class='ptice'><?php echo utf8_encode($nombre); ?></td>
                  <td class='ptice'>U$D <?php echo $precio;?></td>
                  <td class='ptice'><?php echo $cantidad;?></td>
                  <td class='ptice'><strong>U$D <?php echo $subtotal;?></strong></td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
          <br>
          <div class="col-xl-3 offset-xl-9 col-lg-4 offset-lg-3 col-md-6">
            <div class="boton-oscuro text-right">
              <span class="txt-total"><b> Total  U&#36D <?php echo $total;?></b></span>

            </div>
          </div>
          <div class="row mt-60">
            <div class="col-xl-4 col-lg-5 col-md-6 ">
              <div class="cartcupon-wrap">
                <ul class="d-flex">
                  <li><a href="cuenta">Back</a></li>
                </ul>
                <!--<h3>Cupon</h3>
                <p>Enter Your Cupon Code if You Have One</p>
                <div class="cupon-wrap">
                <input type="text" placeholder="Cupon Code">
                <button>Apply Cupon</button>
              </div>-->
            </div>
          </div>




        </div>



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
