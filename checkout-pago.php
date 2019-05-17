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
    <title>Checkout Billing</title>
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
        <div class="checkout-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="order-area">
                            <h3>Purchase</h3>
                            <?php carritoTemporal("checkout"); ?>
                            <?php $totalcoste=carritoTemporalTotal();
                            $totalcosteDolares=$totalcoste;
                            $precioDolar=consultaDolar();
                            $totalcoste=$totalcoste*$precioDolar;
                            ?>
                            <ul class="total-cost">
                                <li></li>
                                <li>Total<span class="pull-right"><b>U&#36D <?php echo money_format('%(#10n', $totalcosteDolares);?></b></span></li>

                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-5">

                        <div class="order-area">
                            <h3>Your Info</h3>

                            <?php echo $_SESSION["nombre"];?><br><?php echo $_SESSION["email"];?><br><?php echo $_SESSION["telefono"];?><br><br>
                            <?php echo $_SESSION["direccion"];?> | <?php echo $_SESSION["localidad"];?> | <?php echo $_SESSION["provincia"];?> | <?php echo $_SESSION["cp"];?>
                            <br><br>    <br><br>
                            <b>Observations of the Purchase</b>
                            <hr>
                            <?php echo $_SESSION["observaciones"];?>
                            <br><br><br>
                            <!-- <a href="carrito-update-pago.php">Pagado</a> -->

                        </div>
                    </div>

                </div>
            </div>
        

        <!-- //*** AUTHOZE.NET ****// -->
        <?php
        require_once "authorize-net/config.php";

        $type = "";
        $message = "";
        if (!empty($_POST["pay_now"])) {
            require_once 'authorize-net/AuthorizeNetPayment.php';
            $authorizeNetPayment = new AuthorizeNetPayment();
            
            $response = $authorizeNetPayment->chargeCreditCard($_POST);
            //var_dump($response);
            if ($response != NULL)
            {
                $tresponse = $response->getTransactionResponse();
                
                if (($tresponse != NULL) && ($tresponse->getResponseCode()=="1"))
                {
                    $authCode = $tresponse->getAuthCode();
                    $paymentResponse = $tresponse->getMessages()[0]->getDescription();
                    $reponseType = "success";
                    $message = "This transaction has been approved. <br/> Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() .  " <br/>Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";

                }
                else
                {
                    if($tresponse->getErrors()[0] != NULL) {
                    //var_dump($tresponse->getErrors()[0]);
                    //die();
                    $authCode = "";
                    $paymentResponse = $tresponse->getErrors()[0]->getErrorText();
                    $reponseType = "error";
                    $message = "Charge Credit Card ERROR :  Invalid response\n";
                    } else {
                        $param_type = 'sssdss';
                        $param_value_array = array(
                            $transactionId,
                            $authCode,
                            $responseCode,
                            $_POST["amount"],
                            $paymentStatus,
                            $paymentResponse
                        );
                    }
                }
                
                $transactionId = $tresponse->getTransId();
                $responseCode = $tresponse->getResponseCode();
                $paymentStatus = $authorizeNetPayment->responseText[$tresponse->getResponseCode()];
                require_once "authorize-net/DBController.php";
                $dbController = new DBController();
                
                $param_type = 'sssdss';
                $param_value_array = array(
                    $transactionId,
                    $authCode,
                    $responseCode,
                    $_POST["amount"],
                    $paymentStatus,
                    $paymentResponse
                );
                $query = "INSERT INTO tbl_authorizenet_payment (transaction_id, auth_code, response_code, amount, payment_status, payment_response) values (?, ?, ?, ?, ?, ?)";
                $id = $dbController->insert($query, $param_type, $param_value_array);
                session_destroy(); 
                $message = "Pay Acceptance Successful !!!. Thanks"?>
                <meta http-equiv="refresh" content="0; URL='<?php echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>'" />
                <?php 
            }
            else
            {
                $reponseType = "error";
                $message= "Charge Credit Card Null response returned";
            }
        }
        ?>
        <hr>
        <div class="breadcumb-area ptb-15">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <?php if(!empty($message)) { ?>
                            <div id="response-message" class="<?php echo $reponseType; ?>"><?php echo $message; ?></div>
                        <?php  } ?>
                        <div id="error-message"></div>
                
                        <form id="frmPayment" action="" method="post" onSubmit="return cardValidation();">
                            <label>Card Number</label>
                            <input type="text" id="card-number" name="card-number" class="demoInputBox">
                            <br>
                            <label>Expiry Month / Year</label>
                            <select name="month" id="month" class="demoSelectBox">
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <select name="year" id="year" class="demoSelectBox">
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                            <br>
                            <input type="submit" name="pay_now" value="Submit" id="submit-btn" class="btnAction">
                            <input type='hidden' name='amount' value=<?php echo $totalcosteDolares ?>> 
                        </form>
                    </div>
                    <div class="col-6">
                        <div class="test-data">
                            <h3>Test Card Information</h3>
                            <p>Use these test card numbers with valid expiration month / year for testing.</p>
                            <table class="tutorial-table" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <th>CARD NUMBER</th>
                                    <th>BRAND</th>
                                </tr>
                                <tr>
                                    <td>4111111111111111</td>
                                    <td>Visa</td>
                                </tr>
                                
                                <tr>
                                    <td>5424000000000015</td>
                                    <td>Mastercard</td>
                                </tr>
                                
                                <tr>
                                    <td>370000000000002</td>
                                    <td>American Express</td>
                                </tr>
                                
                                <tr>
                                    <td>6011000000000012</td>
                                    <td>Discover</td>
                                </tr>
                                
                                <tr>
                                    <td>38000000000006</td>
                                    <td>Diners Club/ Carte Blanche</td>
                                </tr>
                                <tr>
                                    <td>3088000000000017</td>
                                    <td>JCB</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="authorize-net/vendor/jquery/jquery-3.2.1.min.js"
        type="text/javascript"></script>
    <script>

    function cardValidation () {
        var valid = true;
        var cardNumber = $('#card-number').val();
        var month = $('#month').val();
        var year = $('#year').val();

        $("#error-message").html("").hide();

        if (cardNumber.trim() == "") {
               valid = false;
        }

        if (month.trim() == "") {
                valid = false;
        }
        if (year.trim() == "") {
            valid = false;
        }

        if(valid == false) {
            $("#error-message").html("All Fields are required").show();
        }

        return valid;
    }
    </script>

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
