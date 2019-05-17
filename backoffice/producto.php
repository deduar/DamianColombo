<?php session_start();?>
<?php ob_start();?>
<?php include ("incFunction.php");?>
<?php include ("seguridad.php");?>
<?php

$idProductMain = isset($_GET['idProductMain']) ? $_GET['idProductMain'] : null;
$flag = isset($_GET['flag']) ? $_GET['flag'] : null;

$datosProducto=array();
$datosProducto=consultaProducto($idProductMain);

$datosCertificado=array();
$datosCertificado=consultacCertificado($datosProducto[1]);
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

<!-- CDN hosted by Cachefly -->
<script src="tinymce/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>

<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <?php include ("inc-menu.php");?>
            </div>

            <?php include ("inc-top.php");?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Artículo</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <?php include ("inc-buscar-producto.php");?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" >
                                <br><br>
<!--/////////////////////////////////////////////////////////////////////// -->
<!-- BEGIN CONTENIDO ////////////////////////////////////////////////////// -->
<!--/////////////////////////////////////////////////////////////////////// -->
<!--/////////////////////////////////////////////////////////////////////// -->
<!--/////////////////////////////////////////////////////////////////////// -->
                                    <?php If ($flag==1) { ?>
                                    <div id="signalert2" style="display:show; margin-top:0px;" class="alert alert-success">
                                        <strong>Se actualizaron los datos.</strong>
                                    </div>
                                    <?php } ?>



                                        <form name=calform method="post" action="productos-update.php" class="form-horizontal form-label-left">
                                            <input type="hidden" name="idProductMain" value="<?php echo $idProductMain;?>" />

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                <?php mostrarImagen($datosProducto[1]); ?>
                                            </label>

                                             <div class="col-md-9 col-sm-9 col-xs-12">
                                                <br><br><br>
                                                <h1><?php echo $datosProducto[1];?> | <i><?php echo $datosProducto[2];?></i></h1>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">CODIGO</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="codigo" class="form-control" value="<?php echo $datosProducto[1];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NOMBRE PRODUCTO</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" name="descripcion" class="form-control" value="<?php echo $datosProducto[2];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">TIPO ARTICULO</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <?php
                                                comboTipoArticulo($datosProducto[28]); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">ESTADO</label>

                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <div class="checkbox">
                                                        <input type="radio" name="catalogo" value="1" <?php If ($datosProducto[23]==1) {?> checked <?php } ?>>
                                                         ACTIVO
                                                         <input type="radio" name="catalogo" value="0" <?php If ($datosProducto[23]==0) {?> checked <?php } ?>>
                                                         DESACTIVAR

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">DESTACADOS HOME</label>

                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="destacado" value="1" <?php If ($datosProducto[22]==1) {?> checked <?php } ?> > (MÁS VENDIDOS)</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">LABEL <img src='../assets/images/label-new.png'/></label>

                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="flagNew" value="1" <?php If ($datosProducto[24]==1) {?> checked <?php } ?> ></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">LABEL DESCUENTO</label>

                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="labelDescuento" value="1" <?php If ($datosProducto[25]==1) {?> checked <?php } ?> ></label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">DESCRIPCION <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <textarea class="form-control" name="descripcionLarga" rows="5"><?php echo $datosProducto[3];?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">DESCRIPCION CERTIFICADO<span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <textarea class="form-control" name="descripcionCertificado" rows="3"><?php echo $datosProducto[27];?></textarea>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">MEDIDA</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" name="medida" class="form-control" value="<?php echo $datosProducto[5];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">METAL</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <?php
                                                comboTipoMetal($datosProducto[6]); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">PESO METAL</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="pesoMetal" class="form-control" value="<?php echo $datosProducto[7];?>">
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><I>PRIMERA PIEDRA</I></label>
                                            <HR>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">PIEDRA</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <?php
                                                comboTipoPiedra($datosProducto[8], "1"); ?>
                                            </div>

                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">CORTE </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="cortePiedra" class="form-control" value="<?php echo $datosProducto[9];?>">
                                            </div>
                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">PESO</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="pesoPiedra" class="form-control" value="<?php echo $datosProducto[10];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">COLOR</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="colorPiedra" class="form-control" value="<?php echo $datosProducto[11];?>">
                                            </div>

                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">PUREZA </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="purezaPiedra" class="form-control" value="<?php echo $datosProducto[12];?>">
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><I>SEGUNDA PIEDRA</I></label>
                                            <HR>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">PIEDRA</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <?php
                                                comboTipoPiedra($datosProducto[13], "2"); ?>
                                            </div>

                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">PESO</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="pesoPiedra2" class="form-control" value="<?php echo $datosProducto[14];?>">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">COLOR</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="colorPiedra2" class="form-control" value="<?php echo $datosProducto[15];?>">
                                            </div>

                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">PUREZA </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="purezaPiedra2" class="form-control" value="<?php echo $datosProducto[16];?>">
                                            </div>

                                        </div>


                                        <div class="form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">-</label>
                                            <HR>
                                        </div>




                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">STOCK</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="stock" class="form-control" value="<?php echo $datosProducto[4];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">|</label>
                                            <H3>CERTIFICADO</H3>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">CERTIFICADO</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" name="certificado" class="form-control" value="<?php echo $datosProducto[17];?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">CERTIFICADO</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">

                                              <select class='form-control' name='certificado2'>
                                                <option value='0'>SELECCIONAR</option>;
                                                <option value='1'<?php If ($datosProducto[26]==1){ ?>selected<?php } ?>>FANCY DIAMONDS</option>
                                                <option value='2'<?php If ($datosProducto[26]==2){ ?>selected<?php } ?>>SOLITARIOS</option>
                                                <option value='3'<?php If ($datosProducto[26]==3){ ?>selected<?php } ?>>CON PIEDRAS SECUNDARIAS</option>
                                              </select>

                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">-</label>
                                            <HR>
                                        </div>
                                        <div class="form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><I>CERTIFICADO 1RA. PIEDRA</I></label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="diamond1" class="form-control" value="<?php echo $datosCertificado[2];?>">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">SHAPE</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="shape1" class="form-control" value="<?php echo $datosCertificado[3];?>">
                                            </div>

                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">CARAT </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="carat1" class="form-control" value="<?php echo $datosCertificado[4];?>">
                                            </div>
                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">COLOUR GRADE</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="colourGrade1" class="form-control" value="<?php echo $datosCertificado[5];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">CLARITY GRADE</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="clarityGrade1" class="form-control" value="<?php echo $datosCertificado[6];?>">
                                            </div>

                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">SYMMETRY </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="symmetry1" class="form-control" value="<?php echo $datosCertificado[7];?>">
                                            </div>
                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">COLOR ORIGIN </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="colorOrigin1" class="form-control" value="<?php echo $datosCertificado[8];?>">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">COLOR DISTRIBUTION</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="colorDistribution1" class="form-control" value="<?php echo $datosCertificado[9];?>">
                                            </div>

                                        </div>
                                        <div class="form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">-</label>
                                            <HR>
                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><I>CERTIFICADO 2DA. PIEDRA</I></label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="diamond2" class="form-control" value="<?php echo $datosCertificado[10];?>">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">SHAPE</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="shape2" class="form-control" value="<?php echo $datosCertificado[11];?>">
                                            </div>

                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">CARAT </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="carat2" class="form-control" value="<?php echo $datosCertificado[12];?>">
                                            </div>
                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">COLOUR GRADE</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="colourGrade2" class="form-control" value="<?php echo $datosCertificado[13];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">CLARITY GRADE</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="clarityGrade2" class="form-control" value="<?php echo $datosCertificado[14];?>">
                                            </div>

                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">SYMMETRY </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="symmetry2" class="form-control" value="<?php echo $datosCertificado[15];?>">
                                            </div>
                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">COLOR ORIGIN </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="colorOrigin2" class="form-control" value="<?php echo $datosCertificado[16];?>">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">COLOR DISTRIBUTION</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="colorDistribution2" class="form-control" value="<?php echo $datosCertificado[17];?>">
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">-</label>
                                            <HR>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">PRECIO LISTA</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="precioLista" class="form-control" value="<?php echo $datosProducto[18];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">DESCUENTO</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" name="precioFinal" class="form-control" value="<?php echo $datosProducto[19];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">PALABRAS CLAVES <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <textarea class="form-control" name="palabrasClaves" rows="5"><?php echo $datosProducto[20];?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">URL CORTA</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" name="urlCorta" class="form-control" value="<?php echo $datosProducto[21 ];?>">
                                            </div>
                                        </div>



                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">

                                                <button type="submit" class="btn btn-success">Confirmar</button>
                                            </div>
                                        </div>

                                    </form>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#birthday').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>


<!--/////////////////////////////////////////////////////////////////////// -->
<!-- END CONTENIDO ////////////////////////////////////////////////////// -->
<!--/////////////////////////////////////////////////////////////////////// -->
<!--/////////////////////////////////////////////////////////////////////// -->
<!--/////////////////////////////////////////////////////////////////////// -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right">Implementó | SConsulting.com.ar</p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>

    <script src="js/custom.js"></script>

    <!-- moris js -->
    <script src="js/moris/raphael-min.js"></script>
    <script src="js/moris/morris.js"></script>
    <script src="js/moris/example.js"></script>

    <!-- daterangepicker -->
        <script type="text/javascript" src="js/moment.min2.js"></script>
        <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

</body>

</html>
