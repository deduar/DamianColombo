<?php session_start();?>
<?php ob_start();?>
<?php
$e = isset($_GET['e']) ? $_GET['e'] : null;  
$flagReg = isset($_GET['flagReg']) ? $_GET['flagReg'] : null;

$flagReg = htmlspecialchars($flagReg);
$e = htmlspecialchars($e);

srand(time());
$movie = (rand()%18);

If ($movie==0) {
    $movie=1;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Backoffice</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">


    <script src="js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<style type="text/css">
<!--

BODY{
    background: #000000 url(http://www.sconsulting.com.ar/images/bg<?php echo $movie;?>.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
   
</style>


<!-- RECAPTCHA -->
<script src="js/vendor/modernizr-2.8.3.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- FIN RECAPTCHA -->



</head>

<body>
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    
                   <form  class="contact-form" name="contact-form" method="post" action="login-validacion2.php" >
                        <input type="hidden" name="random2" value="<? echo $random2; ?>">
                        <h1>Backoffice DAMIAN COLOMBO</h1>
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
                        <div>
                            <input type="email" class="form-control" placeholder="E-mail" required="required" name="email"/>
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="required" name="password" />
                        </div>
                        <div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                               <!-- <div class="g-recaptcha" data-sitekey="6Lc5IhUUAAAAANoax8NG5hCBwLNmz6zOkUnSNSPr"></div>-->
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-default submit" type="submit" name="submit" value="submit form">Ingresar</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <div class="clearfix"></div>
                            <br />
                            <div>

                                
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            
        </div>
    </div>

</body>

</html>