<?php
/////////// VARIABLES GLOBALES /////////////////////////////////

Global $EmailColombo;
Global $enc33;
Global $enc33;

$EmailColombo = "sales@damiancolombo.com";
$enc33 = "kalo_as56";
//setlocale(LC_MONETARY, 'en_US');
/////////// FIN VARIABLES GLOBALES /////////////////////////////////



/*error_reporting(E_ALL);
ini_set('display_errors', '1');
*/
require("class.phpmailer.php");

function encriptar($string, $key)
{
  $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
  $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_URANDOM );
  mcrypt_generic_init($td, $key, $iv);
  $encrypted_data_bin = mcrypt_generic($td, $string);
  mcrypt_generic_deinit($td);
  mcrypt_module_close($td);
  $encrypted_data_hex = bin2hex($iv).bin2hex($encrypted_data_bin);
  return $encrypted_data_hex;
}

function desencriptar($encrypted_data_hex, $key)
{
  $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
  $iv_size_hex = mcrypt_enc_get_iv_size($td)*2;
  $iv = pack("H*", substr($encrypted_data_hex, 0, $iv_size_hex));
  $encrypted_data_bin = pack("H*", substr($encrypted_data_hex, $iv_size_hex));
  mcrypt_generic_init($td, $key, $iv);
  $decrypted = mdecrypt_generic($td, $encrypted_data_bin);
  mcrypt_generic_deinit($td);
  mcrypt_module_close($td);
  return $decrypted;
}

////////////////////////////////////////////////////////////////////////////////
// COLOMBO /////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

function comboTipoArticulo($tipoArticulo){
  echo "<select class='form-control' name='tipoArticulo'>";
  $mostrar = ($tipoArticulo=='1') ? 'selected' : '';
  echo "<option value='1' ".$mostrar.">ANILLOS</option>";

  $mostrar = ($tipoArticulo=='2') ? 'selected' : '';
  echo "<option value='2' ".$mostrar.">AROS</option>";

  $mostrar = ($tipoArticulo=='3') ? 'selected' : '';
  echo "<option value='3' ".$mostrar.">PULSERAS</option>";

  $mostrar = ($tipoArticulo=='4') ? 'selected' : '';
  echo "<option value='4' ".$mostrar.">COLLARES</option>";

  echo "</select>";

}




function  limpiaCadena($descripcionCertificado){
  $descripcionCertificado = substr($descripcionCertificado, 3);
  $descripcionCertificado = substr($descripcionCertificado, 0, -4);
  return $descripcionCertificado;
}

function consultacCertificado($codigo){

  include ("connect.php");
  $sql = "SELECT idCertificado, codigo, diamond1, shape1, carat1, colourGrade1, clarityGrade1, symmetry1, colorOrigin1, colorDistribution1, diamond2, shape2, carat2, colourGrade2, clarityGrade2, symmetry2, colorOrigin2, colorDistribution2 FROM certificado WHERE codigo = ?";

  $stmt = $mysqli->prepare($sql);
  if(!$stmt->bind_param('s', $codigo))
  {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
  }

  $stmt->execute();
  $stmt->store_result();

  $stmt->bind_result($idCertificado, $codigo, $diamond1, $shape1, $carat1, $colourGrade1, $clarityGrade1, $symmetry1, $colorOrigin1, $colorDistribution1, $diamond2, $shape2, $carat2, $colourGrade2, $clarityGrade2, $symmetry2, $colorOrigin2, $colorDistribution2);

  $stmt->fetch();

  $datos = array($idCertificado, $codigo, $diamond1, $shape1, $carat1, $colourGrade1, $clarityGrade1, $symmetry1, $colorOrigin1, $colorDistribution1, $diamond2, $shape2, $carat2, $colourGrade2, $clarityGrade2, $symmetry2, $colorOrigin2, $colorDistribution2);

  return $datos;
}



function otroMetales($codigo){

  include ("connect.php");

  $sql = "SELECT codigoRelacionado, codMetal FROM metalesrelacionados WHERE codigo = ? ORDER BY codMetal";

  $stmt = $mysqli->prepare($sql);
  if(!$stmt->bind_param('s', $codigo))
  {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
  }

  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($codigoRelacionado, $codMetal);
  $flag=0;
  while ($stmt->fetch()) {

    $datosArticulo=array();
    $datosArticulo=consultaArticuloCodigo($codigoRelacionado);

    If ($flag==0) {
      echo "See also: ";
      echo "<br><a href='product-detail.php?codigo=".$codigoRelacionado."'><img src='assets/images/metal/".$datosArticulo[6].".png'></a>";
    }
    If ($flag==1) {
      echo "<a href='product-detail.php?codigo=".$codigoRelacionado."'><img src='assets/images/metal/".$datosArticulo[6].".png'></a>";
    }
    
    $flag=1;
  }

  If ($flag==1)    echo "<br><br>";

}

function obtenerPedidosId($id_pedido){

  include ("connect.php");
  $sql = "SELECT id_pedido, idUsuario, fecha, estado, estadoEnvio, observaciones, estadoPrecio, cliente, hora, observacionesCliente FROM pedidos WHERE id_pedido = ?";

  $stmt = $mysqli->prepare($sql);
  if(!$stmt->bind_param('i', $id_pedido))
  {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
  }

  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($id_pedido, $idUsuario, $fecha, $estado, $estadoEnvio, $observaciones, $estadoPrecio, $cliente, $hora, $observacionesCliente);

  $stmt->fetch();
  $datos = array($id_pedido, $idUsuario, $fecha, $estado, $estadoEnvio, $observaciones, $estadoPrecio, $cliente, $hora, $observacionesCliente);
  return $datos;


}




function obtenerPedidos($estado){

  echo "<table class='table table-striped responsive-utilities jambo_table bulk_action'>
  <thead>
  <tr class='headings'>
  <th class='column-title'>Fecha Pedido</th>
  <th class='column-title'>Cliente</th>
  <th class='column-title'><strong>Nro. Pedido</strong></th>
  <th class='column-title'>E-mail</th>
  <th class='column-title'>Estado</th>
  <th class='column-title no-link last'><span class='nobr'>Acción</span></th>
  </tr>
  </thead>

  <tbody>";



  include ("connect.php");
  $sql = "SELECT id_pedido, idUsuario, fecha, estado, estadoEnvio, observaciones, estadoPrecio, cliente, hora, observacionesCliente FROM pedidos WHERE estado = ? ORDER BY fecha DESC";

  $stmt = $mysqli->prepare($sql);
  if(!$stmt->bind_param('s', $estado))
  {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
  }

  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($id_pedido, $idUsuario, $fecha, $estado, $estadoEnvio, $observaciones, $estadoPrecio, $cliente, $hora, $observacionesCliente);


  while ($stmt->fetch()) {

    $datos=array();
    $datos=consultaUsuario($idUsuario);
    $enc33 = "kalo_as56";
    //echo "encrip ******** ".$datos[3];
    $datos[3] = desencriptar($datos[3], $enc33);
    $datos[4] = desencriptar($datos[4], $enc33);
    //echo "desencrip ******** ".$datos[3];


    echo "<tr class='even pointer'>
    <td class=' '><b>".cambiaf_a_normal($fecha)."</b></td>
    <td class=' '>".strtoupper($datos[3])." ".strtoupper($datos[4])."</td>
    <td class=' '><strong>".$id_pedido."</strong></td>
    <td class=' '><b>".strtolower($datos[5])."</b></td>
    <td class=' '><strong>".$estado."</strong></div></td>
    <td class=' last'>
    <a href='pedido-detalle.php?id_pedido=".$id_pedido."'>Acceder</a>
    </td>
    </tr>";

  }
  echo "</tbody>

  </table>";

}


function modificarEstado($id_pedido, $estado) {
  include ("connect.php");
  $sql = "UPDATE pedidos SET estado=? WHERE id_pedido=?";
  $stmt = $mysqli->prepare($sql) or die ($mysqli->error);
  $stmt->bind_param('si', $estado, $id_pedido) or die ($mysqli->error);
  $stmt->execute();

}


function consultaDolar(){

  include ("connect.php");

  $idDolar=1;
  $sql = "SELECT precioDolar FROM dolar WHERE idDolar = ?";
  $stmt = $mysqli->prepare($sql);
  if(!$stmt->bind_param('i', $idDolar))
  {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
  }

  $stmt->execute();
  $stmt->store_result();

  $stmt->bind_result($precioDolar);

  $stmt->fetch();

  return $precioDolar;
}





function consultaNovedad($idNoticia){

  include ("connect.php");
  $sql = "SELECT fechaDesde, fechaHasta, titulo, bajada, descripcion, tituloIngles, bajadaIngles, descripcionIngles FROM noticias WHERE idNoticia = ?";
  $stmt = $mysqli->prepare($sql);
  if(!$stmt->bind_param('i', $idNoticia))
  {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
  }

  $stmt->execute();
  $stmt->store_result();

  $stmt->bind_result($fechaDesde, $fechaHasta, $titulo, $bajada, $descripcion, $tituloIngles, $bajadaIngles, $descripcionIngles);

  $stmt->fetch();

  $datos = array($fechaDesde, $fechaHasta, $titulo, $bajada, $descripcion, $tituloIngles, $bajadaIngles, $descripcionIngles);

  return $datos;
}






///////////////// FUNCIONES CARGA NOVEDADES ///////////////////////////////////

function mostrarContenido($idNoticia, $tipo, $tamanio){

  include ("connect.php");
  $sql = "SELECT idArchivo FROM archivonews WHERE id=? AND tipo=?";
  $stmt = $mysqli->prepare($sql);
  if(!$stmt->bind_param('ii', $idNoticia, $tipo))
  {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
  }
  $stmt->execute();
  $stmt->bind_result($idArchivo);


  If ($stmt->fetch()){

    switch($tipo)
    {
      // Imagen Principal
      case "1":

      echo "-------------paso";
      include ("connect.php");
      $sql = "SELECT idArchivo, id, idModulo, nombreArchivo, textoArchivo, tipo, ver FROM archivonews WHERE id=? AND tipo=?";
      $stmt = $mysqli->prepare($sql);
      if(!$stmt->bind_param('ii', $idNoticia, $tipo))
      {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
      }
      $stmt->execute();
      $stmt->bind_result($idArchivo, $id, $idModulo, $nombreArchivo, $textoArchivo, $tipo, $ver);

      echo "<img src='archivosNoticias/$nombreArchivo' alt='' class='img-responsive'/><br>
      <a href='novedades-agregar-version.php?paso=Eliminar&amp;idArchivo=$idArchivo&idNoticia=$idNoticia' class='btn btn-block btn-danger btn-sm'>Eliminar</a>
      "; break;

      // Listado de Imagenes
      case "2":

      include ("connect.php");
      $sql = "SELECT idArchivo, id, idModulo, nombreArchivo, textoArchivo, tipo, ver FROM archivonews WHERE id=? AND tipo=?";
      $stmt = $mysqli->prepare($sql);
      if(!$stmt->bind_param('ii', $idNoticia, $tipo))
      {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
      }
      $stmt->execute();
      $stmt->bind_result($idArchivo, $id, $idModulo, $nombreArchivo, $textoArchivo, $tipo, $ver);

      echo "

      <a href=\"javascript:;\" onclick=\"MM_openBrWindow('archivosNoticias/fileNew.php?tipo=$tipo&amp;id=$idNoticia&tamanio=$tamanio','file','scrollbars=yes,width=510,height=220')\"  class='btn btn-block btn-success btn-sm' >Cargar Otras Imagenes</a><br>

      ";

      while ($stmt->fetch()){


        echo "
        <img src='archivosNoticias/$nombreArchivo' alt='' class='img-responsive'/>
        <a href='novedades-agregar-version.php?paso=Eliminar&amp;idArchivo=$idArchivo&idNoticia=$idNoticia' class='btn btn-block btn-danger btn-sm'>Eliminar</a><br>
        ";

      }


      break;

      // Imagen Secundaria
      case "6":

      include ("connect.php");
      $sql = "SELECT idArchivo, id, idModulo, nombreArchivo, textoArchivo, tipo, ver FROM archivonews WHERE id=? AND tipo=?";
      $stmt = $mysqli->prepare($sql);
      if(!$stmt->bind_param('ii', $idNoticia, $tipo))
      {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
      }
      $stmt->execute();
      $stmt->bind_result($idArchivo, $id, $idModulo, $nombreArchivo, $textoArchivo, $tipo, $ver);
      $stmt->fetch();

      echo "<img src='archivosNoticias/$nombreArchivo' class='img-responsive' alt=''/>
      <a href='novedades-agregar-version.php?paso=Eliminar&amp;idArchivo=$idArchivo&idNoticia=$idNoticia' class='btn btn-block btn-danger btn-sm'>Eliminar</a><br>"; break;


      // Video Principal
      case "5":
      include ("connect.php");
      $sql = "SELECT idArchivo, id, idModulo, nombreArchivo, textoArchivo, tipo, ver FROM archivonews WHERE id=? AND tipo=?";
      $stmt = $mysqli->prepare($sql);
      if(!$stmt->bind_param('ii', $idNoticia, $tipo))
      {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
      }
      $stmt->execute();
      $stmt->bind_result($idArchivo, $id, $idModulo, $nombreArchivo, $textoArchivo, $tipo, $ver);
      $stmt->fetch();

      echo "
      <div class='embed-responsive embed-responsive-16by9'>
      <iframe class='embed-responsive-item' src='http://www.youtube.com/embed/$nombreArchivo'></iframe>
        </div>

        <a href='novedades-agregar-version.php?paso=Eliminar&amp;idArchivo=$idArchivo&idNoticia=$idNoticia' class='btn btn-block btn-danger btn-sm'>Eliminar</a>
        "; break;


        // Listado de Videos

        case "4":

        include ("connect.php");
        $sql = "SELECT idArchivo, id, idModulo, nombreArchivo, textoArchivo, tipo, ver FROM archivonews WHERE id=? AND tipo=?";
        $stmt = $mysqli->prepare($sql);
        if(!$stmt->bind_param('ii', $idNoticia, $tipo))
        {
          trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
        $stmt->execute();
        $stmt->bind_result($idArchivo, $id, $idModulo, $nombreArchivo, $textoArchivo, $tipo, $ver);

        echo "

        <a href=\"javascript:;\" onclick=\"MM_openBrWindow('noticiasUploadVideo.php?tipo=$tipo&id=$idNoticia','file','scrollbars=yes,width=1200,height=550')\"  class='btn btn-block btn-success btn-sm' >Cargar Otros Videos</a><br>";

        while ($stmt->fetch()){



          echo "

          <div class='embed-responsive embed-responsive-16by9'>
          <iframe class='embed-responsive-item' src='http://www.youtube.com/embed/$nombreArchivo'></iframe>
            </div>
            <a href='novedades-agregar-version.php?paso=Eliminar&amp;idArchivo=$idArchivo&idNoticia=$idNoticia' class='btn btn-block btn-danger btn-sm'>Eliminar</a><br>
            ";

          }

          break;

          // Listado de Archivos Adicionales
          case "3":

          include ("connect.php");
          $sql = "SELECT idArchivo, id, idModulo, nombreArchivo, textoArchivo, tipo, ver FROM archivonews WHERE id=? AND tipo=?";
          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('ii', $idNoticia, $tipo))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->bind_result($idArchivo, $id, $idModulo, $nombreArchivo, $textoArchivo, $tipo, $ver);


          echo "
          <a href=\"javascript:;\" onclick=\"MM_openBrWindow('archivosNoticias/fileNewDocumentos.php?tipo=$tipo&amp;id=$idNoticia','file','scrollbars=yes,width=510,height=220')\" class='btn btn-block btn-success btn-sm'>Cargar Archivos Adicionales</a><br>";


          while ($stmt->fetch()){



            echo "<a href='archivosNoticias/$nombreArchivo' target='_blank'>Ver</a> |
            <a href='novedades-agregar-version.php?paso=Eliminar&amp;idArchivo=$idArchivo&idNoticia=$idNoticia'>Eliminar</a>";

          }


          break;




        }


      } else{


        switch($tipo)
        {
          // Imagen Principal
          case "1": echo "<a href=\"javascript:;\" onclick=\"MM_openBrWindow('archivosNoticias/fileNew.php?tipo=$tipo&id=$idNoticia&tamanio=$tamanio','file','scrollbars=yes,width=510,height=220')\"  ><img src='images/nov-foto2.jpg'  class='img-responsive'  alt=''/></a><br>"; break;

          // Listado de Imagenes
          case "2":

          echo "

          <a href=\"javascript:;\" onclick=\"MM_openBrWindow('archivosNoticias/fileNew.php?tipo=$tipo&amp;id=$idNoticia&tamanio=$tamanio','file','scrollbars=yes,width=510,height=220')\" class='btn btn-block btn-success btn-sm'  >Cargar Otras Imagenes</a>

          ";

          break;

          // Listado de Videos
          case "4": echo "
          <a href=\"javascript:;\" onclick=\"MM_openBrWindow('noticiasUploadVideo.php?tipo=$tipo&id=$idNoticia','file','scrollbars=yes,width=1200,height=550')\" class='btn btn-block btn-success btn-sm'  >Cargar Otros Videos</a>";
          break;

          // Listado de Archivos Adicionales

          case "3":

          echo "
          <a href=\"javascript:;\" onclick=\"MM_openBrWindow('archivosNoticias/fileNewDocumentos.php?tipo=$tipo&amp;id=$idNoticia','file','scrollbars=yes,width=510,height=220')\" class='btn btn-block btn-success btn-sm'>Cargar Archivos Adicionales</a>";
          break;


          // Video Principal
          case "5": echo "<a href=\"javascript:;\" onclick=\"MM_openBrWindow('noticiasUploadVideo.php?tipo=$tipo&id=$idNoticia','file','scrollbars=yes,width=1100,height=700')\"  ><img src='images/nov-video.jpg'  class='img-responsive' alt=''/></a>"; break;


          // Imagen Secundaria
          case "6": echo "<a href=\"javascript:;\" onclick=\"MM_openBrWindow('archivosNoticias/fileNew.php?tipo=$tipo&id=$idNoticia&tamanio=$tamanio','file','scrollbars=yes,width=510,height=220')\"  ><img src='images/nov-foto.jpg' class='img-responsive'></a>"; break;
        }

      }

    }



    ///////////////// VISUALIZAR CONTENIDOS ON LINE  ///////////////////////////////////

    function mostrarContenidoOnLine($idNoticia, $tipo, $origen, $idioma){

      include ("connect.php");
      $sql = "SELECT idArchivo FROM archivonews WHERE id=? AND tipo=?";
      $stmt = $mysqli->prepare($sql);
      if(!$stmt->bind_param('ii', $idNoticia, $tipo))
      {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
      }
      $stmt->execute();
      $stmt->bind_result($idArchivo);

      If ($stmt->fetch()){

        switch($tipo)
        {
          case "1":
          include ("connect.php");
          $sql = "SELECT idArchivo, id, idModulo, nombreArchivo, textoArchivo, tipo, ver, textoArchivoIngles FROM archivonews WHERE id=? AND tipo=?";
          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('ii', $idNoticia, $tipo))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->bind_result($idArchivo, $id, $idModulo, $nombreArchivo, $textoArchivo, $tipo, $ver, $textoArchivoIngles);
          $stmt->fetch();


          // Imagen Principal
          

            echo "<img src='http://www.damiancolombo.com/backoffice/archivosNoticias/$nombreArchivo' alt='' class='img-responsive'/>";

            If ($idioma=='ING'){
              echo "<p>".$textoArchivoIngles."</p><br>";
            }else{
              echo "<p>".$textoArchivo."</p><br>";
            }

          

          break;

          // Listado de Imagenes
          case "2":

          include ("connect.php");
          $sql = "SELECT idArchivo, id, idModulo, nombreArchivo, textoArchivo, tipo, ver, textoArchivoIngles FROM archivonews WHERE id=? AND tipo=?";
          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('ii', $idNoticia, $tipo))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->bind_result($idArchivo, $id, $idModulo, $nombreArchivo, $textoArchivo, $tipo, $ver, $textoArchivoIngles);

          $flagCont=1;

          while ($stmt->fetch()){
            If ($flagCont==1){
              echo "<div>";
              $flagCont=0;
            }


            echo "

            <figcaption>";

            echo "<a data-toggle='modal' data-target='#exampleModalCenter".$idArchivo."' href='javascript:void(0);'><img src='http://www.damiancolombo.com/backoffice/archivosNoticias/".$nombreArchivo."' alt=''></a>";

            If ($idioma=='ING'){
              echo "</figcaption><p>".$textoArchivoIngles."</p><br>";
            }else{
              echo "</figcaption><p>".$textoArchivo."</p><br>";
            }

            

            echo "<div class='modal fade' id='exampleModalCenter".$idArchivo."' tabindex='-1'>
            <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <div class='modal-body2 d-flex'>

            <img src='http://www.damiancolombo.com/backoffice/archivosNoticias/".$nombreArchivo."' alt=''>


            </div>
            </div>
            </div>
            </div>";





          }

          echo "</div>";
          break;

          // Imagen Secundaria

          case "6":
          include ("connect.php");
          $sql = "SELECT idArchivo, id, idModulo, nombreArchivo, textoArchivo, tipo, ver, textoArchivoIngles FROM archivonews WHERE id=? AND tipo=?";
          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('ii', $idNoticia, $tipo))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->bind_result($idArchivo, $id, $idModulo, $nombreArchivo, $textoArchivo, $tipo, $ver, $textoArchivoIngles);

          $flagCont=1;

          If ($stmt->fetch()){

            If ($origen=="BLOG"){
              echo "<figcaption>";
              echo "<a href='news-ampliar.php?idNoticia=".$idNoticia."'><img src='http://www.damiancolombo.com/backoffice/archivosNoticias/".$nombreArchivo."' alt=''></a>";
              echo "</figcaption>";
            }else{
              echo "<figcaption>";
              echo "<a data-toggle='modal' data-target='#exampleModalCenter".$idArchivo."' href='javascript:void(0);'><img src='http://www.damiancolombo.com/backoffice/archivosNoticias/".$nombreArchivo."' alt=''></a>";
              echo "</figcaption>";
              
              If ($idioma=='ING'){
                echo "<p>".$textoArchivoIngles."</p><br>";
              }else{
                echo "<p>".$textoArchivo."</p><br>";
              }

            }

            echo "<div class='modal fade' id='exampleModalCenter".$idArchivo."' tabindex='-1'>
            <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <div class='modal-body2 d-flex'>

            <img src='http://www.damiancolombo.com/backoffice/archivosNoticias/".$nombreArchivo."' alt=''>


            </div>
            </div>
            </div>
            </div>";


          }


          break;

          // Video Principal
          case "5": echo "
          <div class='row'>
          <div class='embed-responsive embed-responsive-16by9'>
          <iframe class='embed-responsive-item' src='http://www.youtube.com/embed/$nombreArchivo'></iframe>
            </div>
            </div>
            "; break;


            // Listado de Videos

            case "4":

            include ("connect.php");
            $sql = "SELECT idArchivo, id, idModulo, nombreArchivo, textoArchivo, tipo, ver, textoArchivoIngles FROM archivonews WHERE id=? AND tipo=?";
            $stmt = $mysqli->prepare($sql);
            if(!$stmt->bind_param('ii', $idNoticia, $tipo))
            {
              trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
            }
            $stmt->execute();
            $stmt->bind_result($idArchivo, $id, $idModulo, $nombreArchivo, $textoArchivo, $tipo, $ver, $textoArchivoIngles);

            $flagCont=1;

            while ($stmt->fetch()){
              If ($flagCont==1){
                echo "<div>";
                $flagCont=0;
              }

              echo "
              <div class='row'>
              <div class='embed-responsive embed-responsive-16by9'>
              <iframe class='embed-responsive-item' src='http://www.youtube.com/embed/$nombreArchivo'></iframe>
                </div>
                </div>";

              }
              echo "</div>";


              break;

              // Listado de Archivos Adicionales
              case "3":

              include ("connect.php");
              $sql = "SELECT idArchivo, id, idModulo, nombreArchivo, textoArchivo, tipo, ver, $textoArchivoIngles FROM archivonews WHERE id=? AND tipo=?";
              $stmt = $mysqli->prepare($sql);
              if(!$stmt->bind_param('ii', $idNoticia, $tipo))
              {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
              }
              $stmt->execute();
              $stmt->bind_result($idArchivo, $id, $idModulo, $nombreArchivo, $textoArchivo, $tipo, $ver, $textoArchivoIngles);

              $flagCont=1;

              while ($stmt->fetch()){
                If ($flagCont==1){
                  echo "<div>";
                  $flagCont=0;
                }


                echo "
                <div class='margenes'>
                <a href='http://www.damiancolombo.com/backoffice/archivosNoticias/".$nombreArchivo."' target='_blank' class='list-group-item'>";

                If ($idioma=='ING'){
                  echo "<h4 class='list-group-item-heading'>".$textoArchivoIngles."</h4>";
                }else{
                  echo "<h4 class='list-group-item-heading'>".$textoArchivo."</h4>";
                }
                echo "</a>
                </div>
                ";

              }
              echo "</div>";

              /*    echo "</div></div>";*/
              break;
            }

          }

        }

        function mostrarPiedra($codPiedra){

          include ("connect.php");
          $flag=0;

          $sql = "SELECT codPiedra, tipoPiedra FROM piedras WHERE codPiedra = ?";

          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('i', $codPiedra))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }

          $stmt->execute();
          $stmt->bind_result($codPiedra, $tipoPiedra);
          $stmt->fetch();



          echo $tipoPiedra;

        }



        function mostrarMetal($codMetal){

          include ("connect.php");
          $flag=0;

          $sql = "SELECT codMetal, nombreMetal FROM metales WHERE codMetal = ?";

          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('i', $codMetal))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }

          $stmt->execute();
          $stmt->bind_result($codMetal, $nombreMetal);
          $stmt->fetch();


          echo $nombreMetal;

        }

        function consultaProductoRel($codigo, $tipo, $origen){
          include ("connect.php");
          $catalogo=1;
          $sql = "SELECT idProductoRelacionado, codigoRel FROM productosrelacionados WHERE codigo = ? AND tipo = ?";
          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('si', $codigo, $tipo))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($idProductoRelacionado, $codigoRel);
          $cont=1;
          $flag=0;
          If ($origen == 'detalle'){
            while ($stmt->fetch()) {
              $cont++;

              If ($flag == 0){

                echo "<br><br>
                <div class='featured-product-area'>
                <div class='container'>
                <div class='row'>
                <div class='col-12'>
                <div class='section-title'>
                <h2>Related Products</h2>
                </div>
                </div>
                </div>
                <div class='row'>

                <div class='tab-content'>
                <ul class='row'> ";
                $flag=1;
              }
              $datosProducto=array();
              $datosProducto=consultaProductoCod($codigoRel);
              itemProducto($datosProducto[1], $datosProducto[26], $datosProducto[0], $datosProducto[27], $cont, $datosProducto[4], 0, $datosProducto[28], $datosProducto[29], 0, 1);

              
            }
            If ($flag == 1){
              echo "</ul>
              </div>
              </div>
              </div>
              </div>";
            }
          }else{
            echo "<table class='table table-striped responsive-utilities jambo_table bulk_action'>
            <thead>
            <tr class='headings'>
            <th class='column-title'>Código</th>
            <th class='column-title'>Descripción</th>
            <th class='column-title no-link last'><span class='nobr'>Acción</span></th>
            </tr>
            </thead>
            <tbody>";
            while ($stmt->fetch()) {
              $flag=1;
              $datosProducto=array();
              $datosProducto=consultaProductoCod($codigoRel);
              echo "<tr class='even pointer'>
              <td class=' '>".$datosProducto[1]."</td>
              <td class=' '>".$datosProducto[2]."</td>
              <td class=' last'>
              <a href='productos-relacionados-eliminar.php?idProductMain=".$datosProducto[0]."&idProductoRelacionado=".$idProductoRelacionado."&codigo=".$datosProducto[1]."&tipo=".$tipo."'>Eliminar</a>
              </td>
              </tr>";
            }
            echo "</tbody>
            </table>";
          }
        }


                function consultaProductoMetales($codigo){
                  include ("connect.php");
                  $catalogo=1;
                  $sql = "SELECT idMetalesRelacionados, codigoRelacionado FROM metalesrelacionados WHERE codigo = ?";
                  $stmt = $mysqli->prepare($sql);
                  if(!$stmt->bind_param('s', $codigo))
                  {
                    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
                  }
                  $stmt->execute();
                  $stmt->store_result();
                  $stmt->bind_result($idMetalesRelacionados, $codigoRelacionado);
                  $cont=1;
                  $flag=0;

                  echo "<table class='table table-striped responsive-utilities jambo_table bulk_action'>
                  <thead>
                  <tr class='headings'>
                  <th class='column-title'></th>
                  <th class='column-title'>Código</th>
                  <th class='column-title'>Descripción</th>
                  <th class='column-title no-link last'><span class='nobr'>Acción</span></th>
                  </tr>
                  </thead>
                  <tbody>";
                  while ($stmt->fetch()) {
                    $flag=1;
                    $datosProducto=array();
                    $datosProducto=consultaProductoCod($codigoRelacionado);
                    echo "<tr class='even pointer'>
                    <td class=' '><div class=''><img src='../assets\images\productos/".$datosProducto[1]."BIG1.jpg' class='imagen-lista'></div></td>
                    <td class=' '>".$datosProducto[1]."</td>
                    <td class=' '>".$datosProducto[2]."</td>
                    <td class=' last'>
                    <a href='productos-metales-eliminar.php?idMetalesRelacionados=".$idMetalesRelacionados."&codigo=".$codigo."'>Eliminar</a>
                    </td>
                    </tr>";
                  }
                  echo "</tbody>
                  </table>";
                }






        function consultaProductoSimilares($codSubCategoria, $origen){

          include ("connect.php");
          $catalogo=1;

          $sql = "SELECT idProductMain, productmain.codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew, labelDescuento, precioListaIngles, descuentoIngles, labelDescuentoIngles, description FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productoscategoria.codSubCategoria = ? AND productmain.catalogo = ?) ORDER BY RAND() LIMIT 3";

          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('ii', $codSubCategoria, $catalogo))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }


          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew, $labelDescuento, $precioListaIngles, $descuentoIngles, $labelDescuentoIngles, $description);
          $cont=1;
          $flag=0;
          If ($origen == 'detalle'){
            while ($stmt->fetch()) {
              $cont++;

              If ($flag == 0){

                echo "<br><br>
                <div class='featured-product-area'>
                <div class='container'>
                <div class='row'>
                <div class='col-12'>
                <div class='section-title'>
                <h2>Similar Products</h2>
                </div>
                </div>
                </div>
                <div class='row'>

                <div class='tab-content'>
                <ul class='row'> ";
                $flag=1;
              }
              /*$datosProducto=array();
              $datosProducto=consultaProductoCod($codigoRel);
              itemProducto($datosProducto[1], $datosProducto[2], $datosProducto[0], $datosProducto[18], $cont, $datosProducto[4], 0, $datosProducto[19], $datosProducto[25]);*/

              itemProducto($codigo, $description, $idProductMain, $precioListaIngles, $cont, $stock, 0, $descuentoIngles, $labelDescuento, $codSubCategoria, 2);
            }

            If ($flag == 1){

              echo "</ul>
              </div>


              </div>
              </div>
              </div>";
            }


          }
        }


        function productosBuscar($search){

          $likeString = '%'.$search.'%';

          include ("connect.php");
          $estado=1;
          // $sql  = "SELECT productmain.codigo, descripcion, idProductMain, precioLista, stock, flagNew, precioFinal, labelDescuento, productoscategoria.codSubCategoria FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo WHERE descripcion LIKE ? OR descripcionLarga LIKE ? OR productmain.codigo LIKE ?";
          $sql  = "SELECT codigo, descripcion, idProductMain, precioLista, stock, flagNew, precioFinal, labelDescuento, description, precioListaIngles, descuentoIngles, labelDescuentoIngles FROM productmain WHERE description LIKE ? OR descripcionLargaIngles LIKE ? OR codigo LIKE ?";
          $stmt = $mysqli->prepare($sql);
          $stmt->bind_param('sss', $likeString, $likeString, $likeString) or die($mysqli->error);
          $stmt->execute();
          $stmt->bind_result($codigo, $descripcion, $idProductMain, $precioLista, $stock, $flagNew, $precioFinal, $labelDescuento, $description, $precioListaIngles, $descuentoIngles, $labelDescuentoIngles);

          $cont=1;
          $flag=0;

          while ($stmt->fetch()) {

            $flag=1;
            itemProducto($codigo, $description, $idProductMain, $precioListaIngles, $cont, $stock, $flagNew, $descuentoIngles, $labelDescuentoIngles, 0, 1);

            $cont++;

          }

          If ($flag==0){

            echo "<center><h4>Sorry, no product matches were found</h4></center>";

          }

        }



        function cambiaf_a_normal($fecha){

          $lafecha = date('d-m-Y', strtotime($fecha));
          return $lafecha;
        }





        function consultaUsuario($idUsuario){

          include ("connect.php");

          $sql = "SELECT idUsuario, fecha, fechaAlta, nombre, apellido, email, password, direccion, localidad, provincia, cp, telefono, cuit, estado, flagNews FROM usuarios WHERE idUsuario = ?";

          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('i', $idUsuario))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }

          $stmt->execute();
          $stmt->store_result();

          $stmt->bind_result($idUsuario, $fecha, $fechaAlta, $nombre, $apellido, $email, $password, $direccion, $localidad, $provincia, $cp, $telefono, $cuit, $estado, $flagNews);

          $stmt->fetch();

          $datos = array($idUsuario, $fecha, $fechaAlta, $nombre, $apellido, $email, $password, $direccion, $localidad, $provincia, $cp, $telefono, $cuit, $estado, $flagNews);

          return $datos;
        }





        function listarWishlist($idUsuario){
          include ("connect.php");
          $catalogo=1;
          $sql = "SELECT idProductMain, productmain.codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew, precioListaIngles, descuentoIngles, description FROM productmain INNER JOIN wishlist ON productmain.codigo = wishlist.codigo  WHERE (wishlist.idUsuario = ? AND productmain.catalogo = ?) ORDER BY productmain.codigo DESC";

          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('ii', $idUsuario, $catalogo))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew, $precioListaIngles, $descuentoIngles, $description);
          $cont=1;
          $flag=0;
          while ($stmt->fetch()) {
            $flag=1;
            echo "<div class='row'>";
                echo "<div class='col-5 col-lg-2'>
                  <img src='../assets/images/productos/".$codigo."BIG1.jpg' border='1' alt='".$descripcion."'>";
                echo "</div>";
                echo "<div class='col-7 col-lg-4'>
                  <h5>".$description."</h5>";
                  If ($stock >= 1){
                    calculoPrecio('wishlist', $codigo, $precioListaIngles, $descuentoIngles, 0);
                  }
                echo "</div>";
                echo "<div class='col-5 col-lg-2'></div>";
                echo "<div class='col-4 col-lg-2'>";
                  echo "<a href='product-detail.php?codigo=".$codigo."' class='linkMedida'>More</a>";
                echo "</div>";
                echo "<div class='col-3 col-lg-2'>";
                  echo "<a href='wishlist-eliminar.php?codigo=".$codigo."' class='linkMedida'>Delete</a>";
                echo "</div>";
                echo "<div class='col-12 col-lg-12'>
                <hr>
                </div>
            </div>";


            $cont++;
          }

          If ($flag==0){

            echo "<div class='row'>
            <div class='col-lg-4'>
            <h4>You don't have items in your Wishlist.</h4>
            </div>
            </div>";



          }

        }



        function calculoPrecio($origen, $codigo, $precioLista, $precioFinal, $cantidad){

          $precioAux=($precioLista*$precioFinal)/100;
          $precio=$precioLista-$precioAux;
          $precioTotal=$precio*$cantidad;

          switch ($origen) {
            case "itemProducto":
            echo "<center><br><p>List Price: <br><span class='tachado'>U&#36D ".money_format('%(#10n', $precioLista)."</span></p>
            <p>Save: ".money_format('%(#10n', $precioFinal)."%</p>
            <h5>U&#36D ".money_format('%(#10n', $precio)."</h5></center>";
            break;

            case "wishlist":

            echo "<b><h5 class='pull-left'>U&#36D ".money_format('%(#10n', $precio)."</h5></b>";
            break;

            case "carrito-lista":
            echo "<td class='total'>U&#36D ".money_format('%(#10n', $precioTotal)."</td>";
            break;

            case "carrito-lista-unidad":
            echo "<td class='ptice'>U&#36D ".money_format('%(#10n', $precio)."</td>";
            break;

            case "checkout":
            echo "<div class='col-lg-3 col-md-3'>U&#36D ".money_format('%(#10n', $precioTotal)."</div>";
            break;

            case "menu":
            echo "<p class='margen-menu'><b>U&#36D ".money_format('%(#10n', $precioTotal)."</b></p>";
            break;

            case "detalle":
            echo "List Price: <span class='tachado'>U&#36D ".money_format('%(#10n', $precioLista)."</span><br>
            <b>Save: ".money_format('%(#10n', $precioFinal)."%</b><br><br>
            <div class='rating-wrap fix'>
            <h3 class='pull-left'>U&#36D ".money_format('%(#10n', $precioTotal)."</h3>
            </div>";
            break;
          }
        }


        function validaBotonStock($codigo){

          $datosArticulo=array();
          $datosArticulo=consultaArticuloCodigo($codigo);

          $medida = explode(" / ", $datosArticulo[5]);

          $stockIngles = $datosArticulo[32];
          $stock = $datosArticulo[4];
          $idProductMain = $datosArticulo[0];

          $medida = $medida[0];

          If ($stockIngles >= 1){
            echo "<a href='carrito.php?id=".$idProductMain."&action=add&medida=$medida&cantidad=1'><img src='assets/images/icon-comprar.gif'></a>";
          }else{
            If ($stock >= 1){
              echo "<a href='carrito.php?id=".$idProductMain."&action=add&medida=$medida&cantidad=1'><img src='assets/images/icon-comprar.gif'></a>";
            }
          }

        }


        function definirStockAlternativo($codigo){

          $datosArticulo=array();
          $datosArticulo=consultaArticuloCodigo($codigo);

          $stockIngles = $datosArticulo[32];
          $stock = $datosArticulo[4];

          If ($stockIngles >= 1){

          }else{
            If ($stock >= 1){
              echo "<div class='cajaAlert'>The shipping will take between 5 & 8 business days more than estimated by the mail service. For more information, please <a href='contact'>contact us.</a></div>";
            }
          }

        }

 

        function obtenerSubCategoria($codigo) {

          include ("connect.php");
          $sql = "SELECT codSubCategoria FROM productoscategoria WHERE codigo = ?";

          $stmt = $mysqli->prepare($sql);

          if(!$stmt->bind_param('s', $codigo))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($codSubCategoria);
          $stmt->fetch();

          return $codSubCategoria;

        }


        function obtenerCategorias($codCategoria, $codSubCategoria) {

          include ("connect.php");

          $sql = "SELECT categoriaIngles, subCategoriaIngles FROM categorias INNER JOIN subcategorias ON categorias.codCategoria = subcategorias.codCategoria  WHERE (subcategorias.codCategoria = ? AND subcategorias.codSubCategoria = ?)";

          $stmt = $mysqli->prepare($sql);

          if(!$stmt->bind_param('ii', $codCategoria, $codSubCategoria))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($categoria, $subCategoria);

          $stmt->fetch();

          $datos = array($categoria, $subCategoria);

          return $datos;
        }


        function comboMedidas($medidas, $codSubCategoria, $id, $origen){
          $flag=0;
          If ($codSubCategoria==1 OR $codSubCategoria==5 OR $codSubCategoria==6) {
            $medida = explode(" / ", $medidas);
            $total=count($medida);
            echo "Size: ";
            echo "<select name='medida' class='carrito'>";
            for ($i=0; $i <= $total ; $i++) {
              If  ($_SESSION['medida'][$id]){
                $flag=1;
                //$_SESSION['medida'][$id] = isset($_SESSION['medida'][$id]) ? $_SESSION['medida'][$id] : null;
                //echo $medida[$i]." / ".$_SESSION['medida'][$id];

                If ($medida[$i]) {
                  If ($medida[$i] == $_SESSION['medida'][$id]) {
                    echo "<option value='".$medida[$i]."' selected><b> ".$medida[$i]."</b></option>";
                  } else {
                    If ($medida[$i]){
                      echo "<option value='".$medida[$i]."'><b> ".$medida[$i]."</b></option>";
                    }
                  }
                }
              } else {
                If ($medida[$i]){
                  echo "<option value='".$medida[$i]."'><b> ".$medida[$i]."</b></option>";
                }
              }

            }

            echo "</select><br>";

            If ($origen=='carrito'){
              If ($flag==0){
                $_SESSION['medida'][$id]=$medida[1];
                $flag=1;
              }
            }

          } else {

            //echo "<p>".utf8_encode($medidas)."</p>";

          }

        }


function obtenerEstadoIngles($estado){

          switch ($estado) {
            case "EN PROCESO":
                $estadoVer="IN PROCESS";
                return $estadoVer;
                break;
            case "EN TALLER":
                $estadoVer="IN WORKSHOP";
                return $estadoVer;
                break;
            case "PREPARACION P/ENVIO":
                $estadoVe="PREPARATION FOR SHIPPING";
                return $estadoVer;
                break;
            case "DESPACHADO":
                $estadoVer="DISPATCHED";
                return $estadoVer;
                break;
            case "ENTREGADO":
                $estadoVer="DELIVERED";
                return $estadoVer;
                break;
            case "CANCELADO":
                $estadoVer="CANCELED";
                return $estadoVer;
                break;

            
          }



        }



        function obtenerTitulo($codCategoria, $codSubCategoria){

          switch ($codCategoria) {
            case "2":
            switch ($codSubCategoria) {
              case "1":
              echo "Rings";
              break;
              case "2":
              echo "Earrings";
              break;
              case "3":
              echo "Bracelets";
              break;
              case "4":
              echo "Necklaces";
              break;
            }
            break;
            case "1":
            echo "High Jewelry";
            break;
            case "3":
            switch ($codSubCategoria) {
              case "5":
              echo "Engagement Rings";
              break;
              case "6":
              echo "Wedding bands";
              break;
              case "7":
              echo "Love Celebrations";
              break;
            }
            break;
          }



        }


        function campo($max, $requerido, $tipo, $nombre, $etiqueta, $estilo){
          If ($requerido == 1){
            echo "<input type='".$tipo."' name='".$nombre."' class='".$estilo."' placeholder='".$etiqueta."' maxlength='".$max."' required>";
          }else{
            echo "<input type='".$tipo."' name='".$nombre."' class='".$estilo."' placeholder='".$etiqueta."' maxlength='".$max."'>";
          }
        }


        function campoEdit($max, $requerido, $tipo, $nombre, $valor, $etiqueta, $estilo){

          If ($requerido == 1){
            echo "<input type='".$tipo."' name='".$nombre."' value='".$valor."' class='".$etiqueta."' placeholder='".$etiqueta."' maxlength='".$max."' required>";
          }else{
            echo "<input type='".$tipo."' name='".$nombre."' value='".$valor."' class='".$etiqueta."' placeholder='".$etiqueta."' maxlength='".$max."'>";
          }
        }



        function carritoTemporal($tipo){


          //$filenameAux = '/home/c1200348/public_html/assets/images/productos';
          $filenameAux = '/home/damianco/en-us.damiancolombo.com/assets/images/productos';


          $totalcoste=0;
          $totalcoste2=0;

          foreach($_SESSION['carro'] as $id => $x){

            $datosArticulo=array();
            $datosArticulo=consultaArticuloId($id);

            $nombre = $datosArticulo[24];
            $codigo = $datosArticulo[1];
            $precio = $datosArticulo[25];
            $stockEsp = $datosArticulo[4];
            $stockIngles = $datosArticulo[28];

            if ($stockIngles>=1){

              $stock=$stockIngles;

            }else{
                if ($stockEsp>=1){              
                  $stock=$stockEsp;
                }
            }


            $medidas = $datosArticulo[5];

            //Coste por artículo según la cantidad elegida
            $coste = $precio * $x;

            $totalcoste = $totalcoste + $coste;

            //Contador del total de productos añadidos al carro
            //        $xTotal = $xTotal + $x;

            $codSubCategoria = obtenerSubCategoria($codigo);

            switch ($tipo) {

              case "carrito-xs":
              echo "<hr><div class='container'>
                <div class='row'>
                  <div class='col'>";
                  $filename = $filenameAux.'/'.$codigo.'BIG1.jpg';
                  if (file_exists($filename)) {
                    echo "<img src='assets/images/productos/".$codigo."BIG1.jpg' alt=''>";
                  } else {
                    echo "<img src='assets/images/productos/no-imagen.jpg' alt=''>";
                  }
                  echo "</div>
                  <div class='col-6'>
                    <p>".$nombre."</p>";
                          comboCantidad($id, $stock, "carrito", $x, $codigo, $medidas);
                  echo "</div>
                  <div class='col'>
                  <a href='carrito.php?id=".$id."&action=removeProd'><i class='fa fa-times'></i></a><br>";
                  calculoPrecio("carrito-lista-unidad", $codigo, $datosArticulo[25], $datosArticulo[26], 0);
                  echo "</div>
                </div>
                <div class='row'><hr></div>
              </div>";
              break;

              case "carrito-lista":
              echo "<tr>";
              $filename = $filenameAux.'/'.$codigo.'BIG1.jpg';
              if (file_exists($filename)) {
                echo "<td class='images'><img src='assets/images/productos/".$codigo."BIG1.jpg' alt=''></td>";
              } else {
                echo "<td class='images'><img src='assets/images/productos/no-imagen.jpg' alt=''></td>";
              }

              echo "<td class='ptice'>".$nombre."<br><br>";
              definirStockAlternativo($codigo);
              echo "</td>";

              calculoPrecio("carrito-lista-unidad", $codigo, $datosArticulo[25], $datosArticulo[26], 0);

              echo "<td>";

              comboCantidad($id, $stock, "carrito", $x, $codigo, $medidas);


              echo "</td>";

              calculoPrecio("carrito-lista", $codigo, $datosArticulo[25], $datosArticulo[26], $x);

              echo "<td class='remove'><a href='carrito.php?id=".$id."&action=removeProd'><i class='fa fa-times'></i></a></td>
              </tr>";
              break;

              case "checkout":
              echo "<div class='row'>";

              $filename = $filenameAux.'/'.$codigo.'BIG1.jpg';
              if (file_exists($filename)) {
                echo "<div class='col-xs-4 col-sm-4 d-none d-sm-block'><img src='assets/images/productos/".$codigo."BIG1.jpg' alt='".$nombre."'></div>";
              } else {
                echo "<div class='col-xs-4 col-sm-4 d-none d-sm-block'><img src='assets/images/productos/no-imagen.jpg' alt='".$nombre."'></div>";
              }

              $codSubCategoria = obtenerSubCategoria($codigo);

              If ($codSubCategoria==1 OR $codSubCategoria==5 OR $codSubCategoria==6) {

                echo "<div class='col-lg-5 col-md-5'>".$nombre."<br><br>Size: ".$_SESSION['medida'][$id]."<br>Qty. ".$x."</div>";

              } else {

                echo "<div class='col-lg-5 col-md-5'>".$nombre."<br><br>Qty. ".$x."</div>";

              }

              calculoPrecio("checkout", $codigo, $datosArticulo[25], $datosArticulo[26], $x);


              echo "</div>
              <div class='row'><hr></div>";
              break;

              case "checkout-xs":
              echo "<div class='container'>
                <div class='row'>
                  <div class='col'>";
                  $filename = $filenameAux.'/'.$codigo.'BIG1.jpg';
                  if (file_exists($filename)) {
                    echo "<img src='assets/images/productos/".$codigo."BIG1.jpg' alt=''>";
                  } else {
                    echo "<img src='assets/images/productos/no-imagen.jpg' alt=''>";
                  }
                  echo "</div>
                  <div class='col-6'>";
                  $codSubCategoria = obtenerSubCategoria($codigo);
                  If ($codSubCategoria==1 OR $codSubCategoria==5 OR $codSubCategoria==6) {

                    echo "<p>".$nombre."<br><br>Size: ".$_SESSION['medida'][$id]."<br>Qty. ".$x."</p>";

                  } else {

                    echo "<p>".$nombre."<br><br>Size: ".$medidas."<br>Qty. ".$x."</p>";

                  }
                  echo "</div>
                  <div class='col'>";
                  calculoPrecio("checkout", $codigo, $datosArticulo[25], $datosArticulo[26], $x);
                  echo "</div>
                </div>
                <div class='row'><hr></div>
              </div>";
              break;

              case "menu":
              echo "


              <li class='cart-items'>
              <div class='cart-img'>
              <img src='https://www.damiancolombo.com/assets/images/productos/".$codigo."BIG1.jpg' alt='".$codigo."' >
              </div>
              <div class='cart-content'>
              <a href='product-detail.php?codigo=".$codigo."&codSubCategoria=".$codSubCategoria."'>".substr(trim($nombre),0,32)."</a>
              <span>Qty: ".$x."</span>";
              calculoPrecio("menu", $codigo, $datosArticulo[25], $datosArticulo[26], $x);
              echo "<a href='carrito.php?id=".$id."&action=removeProd'><i class='fa fa-times'></i></a>
              </div>
              </li>";


              break;
            }

            //$iva=($totalcoste*21)/100;
            //$totalcoste2=$totalcoste+$iva;
          }
        }

        function carritoTemporalTotal(){

          $totalcoste=0;
          $totalcoste2=0;

          foreach($_SESSION['carro'] as $id => $x){

            $datosArticulo=array();
            $datosArticulo=consultaArticuloId($id);

            $nombre = $datosArticulo[3];
            $codigo = $datosArticulo[1];
            $precioLista = $datosArticulo[25];
            $precioFinal = $datosArticulo[26];
            //Coste por artículo según la cantidad elegida

            $precioAux=($precioLista*$precioFinal)/100;

            $precio=$precioLista-$precioAux;


            $coste = $precio * $x;



            $totalcoste = $totalcoste + $coste;

            //Contador del total de productos añadidos al carro
            // $xTotal = $xTotal + $x;
          }

          return $totalcoste;
        }


        function comboCantidad($id, $stock, $tipo, $cantidad, $codigo, $medidas){
          $codSubCategoria = obtenerSubCategoria($codigo);
          If  ($stock>0){
            If  ($tipo == "carrito"){
              echo "<hr><form  method='post' action='carritoTemp.php' class='carrito'>
              <input type='hidden' name='id' value='".$id."'>
              <input type='hidden' name='action' value='add2'>";

              echo "<div class='row'>";
              If ($codSubCategoria==1 OR $codSubCategoria==5 OR $codSubCategoria==6) {
              echo "<div class='col-lg-6 col-sm-6 col-6'>";
                    // MEDIDA //////////
                    comboMedidas($medidas, $codSubCategoria, $id, "carrito");
                    // FIN MEDIDA //////////
              echo "</div>";
              }
              echo "<div class='col-lg-6 col-sm-6 col-6'>";
                  echo "Qty:<br><select class='carrito' name='cantidad'>";
                  for ($i=1; $i <= $stock ; $i++) {

                    echo "<option value='".$i."'>".$i."</option>";
                  }

                  echo "</select>";
                  echo "</div>";
                echo "</div>";
                echo "<div class='row'>
                <div class='col-lg-12 col-sm-12 col-12'>";

                      echo "<br><input  type='submit' value='Update' class='btnActualizar'>";
                echo "</div>";
                echo "</div>";

              echo "</form>";

            }else{

              echo "<form role='form' action='carrito.php?id=".$id."&action=add2' method='post' class='carrito'>";

              echo "<div class='row'>";

              If ($codSubCategoria==1 OR $codSubCategoria==5 OR $codSubCategoria==6) {
                  echo "<div class='col-lg-6 col-sm-6 col-6'>";
                        // MEDIDA //////////
                        comboMedidas($medidas, $codSubCategoria, $id, "modal");
                        // FIN MEDIDA //////////
                  echo "</div>";
                  echo "<div class='col-lg-6 col-sm-6 col-6'>";
                      echo "
                      Quantity:
                      <select name='cantidad' class='carrito'>";
                      for ($i=1; $i <= $stock ; $i++) {
                        echo "<option value='".$i."'> ".$i."</option>";
                      }
                      echo "</select>";
                  echo "</div>";
              } else{
                  echo "<div class='col-lg-6 col-sm-6 col-6'>";
                      echo "
                      Quantity:
                      <select name='cantidad' class='carrito'>";
                      for ($i=1; $i <= $stock ; $i++) {
                        echo "<option value='".$i."'> ".$i."</option>";
                      }
                      echo "</select>";
                  echo "</div>";
              }


            echo "</div>";
            echo "<div class='row'>
            <div class='col-lg-12 col-sm-12 col-12'>";
              echo "<br><input  type='submit' value='ADD TO BAG' class='btnComprar'>";
              echo "</div>";
            echo "</div>";
              echo "</form>";

            }


          }else{

            echo "Sin Stock";

          }
        }





        function obtenerComboProvincias($provincia){

          echo "<select class='selectForm' name='provincia' required>
          <option  value='Buenos Aires' <?php If ($provincia=='Buenos Aires'){?>selected<?php }?>>Buenos Aires</option>
          <option  value='Capital Federal' <?php If ($provincia=='Capital Federal'){?>selected<?php }?>>Capital Federal</option>
          <option value='Catamarca' <?php If ($provincia=='Catamarca'){?>selected<?php }?>>Catamarca </option>
          <option value='Chaco' <?php If ($provincia=='Chaco'){?>selected<?php }?>>Chaco </option>
          <option value='Chubut' <?php If ($provincia=='Chubut'){?>selected<?php }?>>Chubut </option>
          <option value='Cordoba' <?php If ($provincia=='Cordoba'){?>selected<?php }?>>Cordoba</option>
          <option value='Corrientes' <?php If ($provincia=='Corrientes'){?>selected<?php }?>>Corrientes </option>
          <option value='Entre Rios' <?php If ($provincia=='Entre Rios'){?>selected<?php }?>>Entre Rios</option>
          <option value='Formosa' <?php If ($provincia=='Formosa'){?>selected<?php }?>>Formosa </option>
          <option value='Jujuy' <?php If ($provincia=='Jujuy'){?>selected<?php }?>>Jujuy</option>
          <option value='La Pampa' <?php If ($provincia=='La Pampa'){?>selected<?php }?>>La Pampa</option>
          <option value='La Rioja' <?php If ($provincia=='La Rioja'){?>selected<?php }?>>La Rioja </option>
          <option value='Mendoza' <?php If ($provincia=='Mendoza'){?>selected<?php }?>>Mendoza</option>
          <option value='Misiones' <?php If ($provincia=='Misiones'){?>selected<?php }?>>Misiones</option>
          <option value='Neuquen' <?php If ($provincia=='Neuquen'){?>selected<?php }?>>Neuquen</option>
          <option value='Rio Negro' <?php If ($provincia=='Rio Negro'){?>selected<?php }?>>Rio Negro</option>
          <option value='Salta' <?php If ($provincia=='Salta'){?>selected<?php }?>>Salta</option>
          <option  value='San Juan' <?php If ($provincia=='San Juan'){?>selected<?php }?>>San Juan</option>
          <option  value='San Luis' <?php If ($provincia=='San Luis'){?>selected<?php }?>>San Luis </option>
          <option  value='Santa Cruz' <?php If ($provincia=='Santa Cruz'){?>selected<?php }?>>Santa Cruz</option>
          <option  value='Santa Fe' <?php If ($provincia=='Santa Fe'){?>selected<?php }?>>Santa Fe</option>
          <option value='Santiago del Estero <?php If ($provincia=='Santiago del Estero'){?>selected<?php }?>>Santiago del Estero</option>
          <option value='Tierra del Fuego' <?php If ($provincia=='Tierra del Fuego'){?>selected<?php }?>>Tierra del Fuego</option>
          <option value='Tucuman' <?php If ($provincia=='Tucuman'){?>selected<?php }?>>Tucuman</option>
          </select>";

        }



        function itemProducto($codigo, $descripcion, $idProductMain, $precioLista, $cont, $stock, $flagNew, $precioFinal, $labelDescuento, $codSubCategoria, $columnas) {
          //$filenameAux = '/home/c1200348/public_html/assets/images/productos';
          $filenameAux = '/home/damianco/en-us.damiancolombo.com/assets/images/productos';

          if ($columnas==2) {
            echo "<li class='col-lg-4 col-md-4 col-sm-6 col-6'>";
          }else{
            echo "<li class='col-lg-4 col-md-4 col-sm-6 col-6'>";
          }

          echo "<div class='featured-product-wrap'>
          <div class='featured-product-img'>";

          $filename = $filenameAux.'/'.$codigo.'BIG1.jpg';

          if (file_exists($filename)) {

            echo "<a href='product-detail.php?codigo=".$codigo."&codSubCategoria=".$codSubCategoria."'><img src='assets/images/productos/".$codigo."BIG1.jpg' alt=''></a>";

          } else {

            echo "<a href='product-detail.php?codigo=".$codigo."&codSubCategoria=".$codSubCategoria."'><img src='assets/images/productos/no-imagen.jpg' alt=''></a>";

          }

          If ($labelDescuento == 1){
            echo "<div style='position:absolute; top:0; left:0;'>
            <img src='assets/images/descuentos/bg-descuento-".$precioFinal.".png' alt=''>
            </div>";

          }else{
            If ($flagNew == 1){
              echo "<div style='position:absolute; top:0; left:0;'>
              <img src='assets/images/label-new.png' alt=''>
              </div>";
            }
          }

          echo "</div>
          <div class='featured-product-content'>
          <div class='row'>
          <div class='col-12'>
          <h3><center><a href='product-detail.php?codigo=".$codigo."&codSubCategoria=".$codSubCategoria."'>".$descripcion."</a></center></h3>";

          If ($codSubCategoria <> 6){
            calculoPrecio("itemProducto", $codigo, $precioLista, $precioFinal, 0);

          } else {

            echo "<center><a href='product-detail.php?codigo=".$codigo."&codSubCategoria=".$codSubCategoria."'>Contact Us</a></center>";
          }

          echo "</div>
          <br>
          <div  class='item-opciones'>";
          validaBotonStock($codigo);
          if(isset($_SESSION['idUsuario'])){
              echo "<a href='wishlist-temp.php?codigo=".$codigo."'><img src='assets/images/icon-wishlist.gif'></a>";
          }else{
            echo "<a href='login.php?e=3&orig=2'><img src='assets/images/icon-wishlist.gif'></a>";
          }
          echo "
          </div>
          </div>
          </div>
          </div>
          </li>";


        }



        function listarProductos($codCategoria, $codSubCategoria, $fl, $codMetal, $codPiedra, $precio){

          include ("connect.php");
          $catalogo=1;

          If ($codSubCategoria==0){

            If ($fl==1){
              $sql = "SELECT idProductMain, productmain.codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew, $labelDescuento, description, descripcionLargaIngles, precioListaIngles, descuentoIngles, labelDescuentoIngles, stockIngles  FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productoscategoria.codCategoria = ? AND productmain.catalogo = ? AND codMetal = ? AND (codPiedra= ? OR codPiedra2 = ?)) ORDER BY productmain.codigo DESC";

              $stmt = $mysqli->prepare($sql);
              if(!$stmt->bind_param('iiiii', $codCategoria, $catalogo, $codMetal, $codPiedra, $codPiedra))
              {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
              }

            }else{

              $sql = "SELECT idProductMain, productmain.codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew, $labelDescuento, description, descripcionLargaIngles, precioListaIngles, descuentoIngles, labelDescuentoIngles, stockIngles  FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productoscategoria.codCategoria = ? AND productmain.catalogo = ?) ORDER BY productmain.codigo DESC";

              $stmt = $mysqli->prepare($sql);
              if(!$stmt->bind_param('ii', $codCategoria, $catalogo))
              {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
              }
            }


          }else{
            If ($fl==1){

              $sql = "SELECT idProductMain, productmain.codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew, labelDescuento, description, descripcionLargaIngles, precioListaIngles, descuentoIngles, labelDescuentoIngles, stockIngles  FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productoscategoria.codCategoria = ? AND productoscategoria.codSubCategoria = ? AND productmain.catalogo = ? AND codMetal = ? AND (codPiedra= ? OR codPiedra2 = ?)) ORDER BY productoscategoria.orden DESC";


              $stmt = $mysqli->prepare($sql);
              if(!$stmt->bind_param('iiiiii', $codCategoria, $codSubCategoria, $catalogo, $codMetal, $codPiedra, $codPiedra))
              {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
              }

            }else{

              $sql = "SELECT idProductMain, productmain.codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew, labelDescuento, description, descripcionLargaIngles, precioListaIngles, descuentoIngles, labelDescuentoIngles, stockIngles  FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productoscategoria.codCategoria = ? AND productoscategoria.codSubCategoria = ? AND productmain.catalogo = ?) ORDER BY productoscategoria.orden DESC";

              $stmt = $mysqli->prepare($sql);
              if(!$stmt->bind_param('iii', $codCategoria, $codSubCategoria, $catalogo))
              {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
              }
            }

          }

          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew, $labelDescuento, $description, $descripcionLargaIngles, $precioListaIngles, $descuentoIngles, $labelDescuentoIngles, $stockIngles);


          echo "<div class='tab-content'>
          <ul class='row'> ";

          $cont=1;
          $registros=0;

          If ($fl==1){

            $precios = explode(" - ", $precio);
            $precio1=substr($precios[0],3);
            $precio2=substr($precios[1],3);
            /*echo "<br>";
            echo $precio1." | ".$precio2;
            echo "entro del IF precio> ".$precio;*/
            while ($stmt->fetch()) {


              $precioAux=($precioLista*$precioFinal)/100;
              $precioDefinitivo=$precioLista-$precioAux;

              If($precioDefinitivo >= $precio1 AND $precioDefinitivo <= $precio2){
                $registros=1;
                itemProducto($codigo, $description, $idProductMain, $precioListaIngles, $cont, $stockIngles, $flagNew, $descuentoIngles, $labelDescuentoIngles, $codSubCategoria, 1);
              }
            }
            $cont++;
          }else{

            while ($stmt->fetch()) {
              $registros=1;
              itemProducto($codigo, $description, $idProductMain, $precioListaIngles, $cont, $stockIngles, $flagNew, $descuentoIngles, $labelDescuentoIngles, $codSubCategoria, 1);

            }
            $cont++;
          }
          echo "</ul>
          </div>";

          If ($registros==0){

            echo "<br><br><h4>No se encontraron artículos.</h4>";
          }

        }

        function obtenerDestacados($codCategoria, $codSubCategoria){

          include ("connect.php");
          $destacado=1;
          $catalogo=1;


          $sql = "SELECT idProductMain, productmain.codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew, labelDescuento FROM productmain INNER JOIN productoscategoria ON productmain.codigo = productoscategoria.codigo  WHERE (productoscategoria.codCategoria = ? AND productoscategoria.codSubCategoria = ? AND productmain.catalogo = ? AND productmain.destacado = ?) ORDER BY productoscategoria.ordenDestacado";

          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('iiii', $codCategoria, $codSubCategoria, $catalogo, $destacado))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }

          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew, $labelDescuento);

          If ($codSubCategoria==1){
            echo "<div class='tab-pane active' id='".$codSubCategoria."'>
            <ul class='row'> ";
          }else{
            echo "<div class='tab-pane' id='".$codSubCategoria."'>
            <ul class='row'> ";
          }

          $cont=1;
          while ($stmt->fetch()) {

            itemProducto($codigo, $descripcion, $idProductMain, $precioLista, $cont, $stock, $flagNew, $precioFinal, $labelDescuento, $codSubCategoria, 1);
            $cont++;

          }
          echo "</ul>
          </div>";

        }


        function consultarCertificado($codigo){

          include ("connect.php");
          $sql = "SELECT idCertificado, codigo, diamond1, shape1, carat1, colourGrade1, clarityGrade1, symmetry1, colorOrigin1, colorDistribution1, diamond2, shape2, carat2, colourGrade2, clarityGrade2, symmetry2, colorOrigin2, colorDistribution2 FROM certificado WHERE codigo = ?";
          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('s', $codigo))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($idCertificado, $codigo, $diamond1, $shape1, $carat1, $colourGrade1, $clarityGrade1, $symmetry1, $colorOrigin1, $colorDistribution1, $diamond2, $shape2, $carat2, $colourGrade2, $clarityGrade2, $symmetry2, $colorOrigin2, $colorDistribution2);
          $stmt->fetch();
          $datos = array($idCertificado, $codigo, $diamond1, $shape1, $carat1, $colourGrade1, $clarityGrade1, $symmetry1, $colorOrigin1, $colorDistribution1, $diamond2, $shape2, $carat2, $colourGrade2, $clarityGrade2, $symmetry2, $colorOrigin2, $colorDistribution2);

          return $datos;
        }

        function consultaArticuloCodigo($codigo){

          include ("connect.php");
          $sql = "SELECT idProductMain, codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, certificado2, descripcionCertificado, tipoArticulo, description, descripcionLargaIngles, precioListaIngles, descuentoIngles, medidaIngles, stockIngles  FROM productmain WHERE codigo = ?";
          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('s', $codigo))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $certificado2, $descripcionCertificado, $tipoArticulo, $description, $descripcionLargaIngles, $precioListaIngles, $descuentoIngles, $medidaIngles, $stockIngles);
          $stmt->fetch();
          $datos = array($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $certificado2, $descripcionCertificado, $tipoArticulo, $description, $descripcionLargaIngles, $precioListaIngles, $descuentoIngles, $medidaIngles, $stockIngles);

          return $datos;
        }

        function consultaArticuloId($id){

          include ("connect.php");


          $sql = "SELECT idProductMain, codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, description, precioListaIngles, descuentoIngles, labelDescuentoIngles, stockIngles FROM productmain WHERE idProductMain = ?";


          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('i', $id))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }

          $stmt->execute();
          $stmt->store_result();

          $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $description, $precioListaIngles, $descuentoIngles, $labelDescuentoIngles, $stockIngles);

          $stmt->fetch();

          $datos = array($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $description, $precioListaIngles, $descuentoIngles, $labelDescuentoIngles, $stockIngles);

          return $datos;
        }




        function consultaStock($id){

          include ("connect.php");


          $sql = "SELECT stock FROM productmain WHERE idProductMain = ?";


          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('i', $id))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }

          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($stock);
          $stmt->fetch();
          return $stock;
        }



        function obtenerImagenesDetalle($codigo, $interface){
          //$filenameAux = '/home/damianco/en-us.damiancolombo.com/assets/images/productos';
          $filenameAux = '/home/damianco/en-us.damiancolombo.com/assets/images/productos';

          include ("connect.php");
          // $dir = dirname(__FILE__);
          // echo $dir;
          echo "<div class='product-single-img'>
          <div class='product-active owl-carousel'>";
          $filename = $filenameAux.'/'.$codigo.'BIG1.jpg';
          if (file_exists($filename)) {
            if ($interface=="xs") {
              echo "<div>";
            }else{
              echo "<div class='item'>";
            }
            echo "<img src='assets/images/productos/".$codigo."BIG1.jpg' alt='".$codigo."'>
            </div>";
          }

          for ($i = 2; $i < 4; $i++) {
            $filename = $filenameAux.'/'.$codigo.'BIG'.$i.'.jpg';
            if (file_exists($filename)) {

              if ($interface=="xs") {
                echo "<div>";
              }else{
                echo "<div class='item'>";
              }
              echo "<img src='assets/images/productos/".$codigo."BIG".$i.".jpg' alt='".$codigo."'>
              </div>";
            }
          }
          //Imagenes Adicionales (Bolsas / Caja)
          for ($i = 1; $i < 4; $i++) {

            $filename = $filenameAux.'/adicional'.$i.'.jpg';
            if (file_exists($filename)) {
              if ($interface=="xs") {
                echo "<div>";
              }else{
                echo "<div class='item'>";
              }
              echo "<img src='assets/images/productos/adicional".$i.".jpg'>
              </div>";
            }
          }

          echo "</div>
          <div class='product-thumbnil-active  owl-carousel'>";
          for ($i = 1; $i < 4; $i++) {
            $filename = $filenameAux.'/'.$codigo.'BIG'.$i.'.jpg';
            if (file_exists($filename)) {
              if ($interface=="xs") {
                echo "<div>";
              }else{
                echo "<div class='item'>";
              }
              echo "<img src='assets/images/productos/".$codigo."BIG".$i.".jpg' alt='".$codigo."'>
              </div>";
            }

          }

          //Imagenes Adicionales (Bolsas / Caja)

          for ($i = 1; $i < 4; $i++) {
            $filename = $filenameAux.'/adicional'.$i.'.jpg';
            if (file_exists($filename)) {
              echo "<div class='item'>
              <img src='assets/images/productos/adicional".$i.".jpg'>
              </div>";
            }
          }
          echo "</div>
          </div>";
        }






        ////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////

        // BACKOFFICE //////////////////////////////////////////////////////////////////
        // BACKOFFICE //////////////////////////////////////////////////////////////////
        // BACKOFFICE //////////////////////////////////////////////////////////////////
        // BACKOFFICE //////////////////////////////////////////////////////////////////





        function resultadoProductos($word, $origen){

          include ("connect.php");

          $likeString = '%' . $word . '%';

          $sql = "SELECT idProductMain, codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo
          FROM productmain WHERE codigo LIKE ? OR descripcion LIKE ?";

          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('ss', $likeString, $likeString))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->store_result();


          echo"<table class='table table-striped responsive-utilities jambo_table bulk_action'>
          <thead>
          <tr class='headings'>
          <th class='column-title'>Imagen</th>
          <th class='column-title'>Código</th>
          <th class='column-title'>Descripción</th>
          <th class='column-title no-link last'><span class='nobr'>Acción</span></th>
          </tr>
          </thead>
          <tbody>";

          $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo);

          while ($stmt->fetch()) {
            echo "<tr class='even pointer'>

            <td class=' '><div class=''><img src='../assets\images\productos/".$codigo."BIG1.jpg' class='imagen-lista'></div></td>
            <td class=' '>".$codigo."</td>
            <td class=' '>".$descripcion."</td>
            <td class=' last'>";



            echo "<a href='producto.php?idProductMain=".$idProductMain."'>EDITAR</a> | <a href='producto-categoria2.php?codigo=".$codigo."'>ASIGNAR CATEGORIA</a> | <a href='productos-relacionados.php?codigo=".$codigo."&word=".$word."&idProductMain=".$idProductMain."&flagInicio=1&tipo=1'>RELACIONAR PRODUCTOS</a> | <a href='productos-metales.php?codigo=".$codigo."&word=".$word."&flagInicio=1&tipo=1'>REL. METALES</a> | <a href='productos-eliminar.php?codigo=".$codigo."&word=".$word."&idProductMain=".$idProductMain."' onclick='return confirma_delete();'>ELIMINAR</a>";

            //    <a href='productoOutlet.php?idProductMain=".$idProductMain."'>Editar</a>

            echo "</td>
            </tr>";

          }

          echo "</tbody>
          </table>";

        }


        function consultaProducto($idProductMain){

          include ("connect.php");
          $sql = "SELECT idProductMain, codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew, labelDescuento, certificado2, descripcionCertificado, tipoArticulo, description, palabrasClavesIngles, urlCortaIngles, descripcionLargaIngles FROM productmain WHERE idProductMain = ?";

          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('i', $idProductMain))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->store_result();

          $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew, $labelDescuento, $certificado2, $descripcionCertificado, $tipoArticulo, $description, $palabrasClavesIngles, $urlCortaIngles, $descripcionLargaIngles);

          $stmt->fetch();

          $datos = array($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew, $labelDescuento, $certificado2, $descripcionCertificado, $tipoArticulo, $description, $palabrasClavesIngles, $urlCortaIngles, $descripcionLargaIngles);

          return $datos;
        }


        function consultaProductoCod($codigo){

          include ("connect.php");
          $sql = "SELECT idProductMain, codigo, descripcion, descripcionLarga, stock, medida, codMetal, pesoMetal, codPiedra, cortePiedra, pesoPiedra, colorPiedra, purezaPiedra, codpiedra2, pesoPiedra2, colorPiedra2, purezaPiedra2, certificado, precioLista, precioFinal, palabrasClaves, urlCorta, destacado, catalogo, flagNew, labelDescuento, description, precioListaIngles, descuentoIngles, labelDescuentoIngles FROM productmain WHERE codigo = ?";

          $stmt = $mysqli->prepare($sql);
          if(!$stmt->bind_param('s', $codigo))
          {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
          }
          $stmt->execute();
          $stmt->store_result();

          $stmt->bind_result($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew, $labelDescuento, $description, $precioListaIngles, $descuentoIngles, $labelDescuentoIngles);

          $stmt->fetch();

          $datos = array($idProductMain, $codigo, $descripcion, $descripcionLarga, $stock, $medida, $codMetal, $pesoMetal, $codPiedra, $cortePiedra, $pesoPiedra, $colorPiedra, $purezaPiedra, $codpiedra2, $pesoPiedra2, $colorPiedra2, $purezaPiedra2, $certificado, $precioLista, $precioFinal, $palabrasClaves, $urlCorta, $destacado, $catalogo, $flagNew, $labelDescuento, $description, $precioListaIngles, $descuentoIngles, $labelDescuentoIngles);

          return $datos;
        }



        function mostrarImagen($codigo){

          /*$filename = "http://www.vivre.com.ar/catalogo/catalogo2018";
          $filename = $filename."/".$codigo."BIG1.jpg";
          if (fopen($filename, 'r')) {*/

          echo "<img src='../assets\images\productos/".$codigo."BIG1.jpg' class='img-responsive'>";

          /*}else{

          echo "<img src='http://www.vivre.com.ar/catalogo/catalogo2018/sin-foto.gif' class='img-responsive'>";

        }*/


      }


      function comboTipoPiedra($codTipoAux, $tipo){

        include ("connect.php");
        $flag=0;

        $sql = "SELECT codPiedra, tipoPiedra FROM piedras ORDER BY tipoPiedra";
        $stmt = $mysqli->prepare($sql);

        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($codPiedra, $tipoPiedra);

        If ($tipo==1){
          echo "<select class='form-control' name='codPiedra'>";
        } else {
          echo "<select class='form-control' name='codpiedra2'>";
        }

        while ($stmt->fetch()) {

          echo "<option value='".$codPiedra."'";
          If ($codTipoAux==$codPiedra){
            echo "selected";
            $flag=1;
          }
          echo ">".strtoupper($tipoPiedra)."</option>";
        }
        If ($flag==0){
          echo "<option value='0' selected>SELECCIONAR PIEDRA</option>";
        }
        echo "</select>";
      }


      function comboTipoMetal($codTipoAux){

        include ("connect.php");
        $flag=0;

        $sql = "SELECT codMetal, nombreMetal FROM metales ORDER BY nombreMetal";
        $stmt = $mysqli->prepare($sql);

        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($codMetal, $nombreMetal);

        echo "<select class='form-control' name='codMetal'>";

        while ($stmt->fetch()) {

          echo "<option value='".$codMetal."'";
          If ($codTipoAux==$codMetal){
            echo "selected";
            $flag=1;
          }
          echo ">".strtoupper($nombreMetal)."</option>";
        }
        If ($flag==0){
          echo "<option value='0' selected>SELECCIONAR METAL</option>";
        }
        echo "</select>";
      }



      // FIN BACKOFFICE //////////////////////////////////////////////////////////////////
      // FIN BACKOFFICE //////////////////////////////////////////////////////////////////
      // FIN BACKOFFICE //////////////////////////////////////////////////////////////////
      // FIN BACKOFFICE //////////////////////////////////////////////////////////////////

      function enviarMail($destino,$asunto, $remitente, $body)
      {
        echo $destino." - ".$asunto." - ".$remitente." - ".$body;
        $mail=new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth=true;

        $mail->Host="mail.damiancolombo.com";
        $mail->Username="sales@damiancolombo.com"; // usuario correo remitente
        $mail->Password="20187080"; // contraseña correo remitente

        /*$mail->Host="mail.damiancolombo.com";
        $mail->Username="no-responder@damiancolombo.com"; // usuario correo remitente
        $mail->Password="Cm34WSYT"; // contraseña correo remitente*/
        $mail->Port=25;
        //$mail->From="no-responder@damiancolombo.com"; // correo remitente
        $mail->From="sales@damiancolombo.com"; // correo remitente
        $mail->FromName=$remitente; // nombre remitente
        $mail->AddAddress($destino); // destinatario
        $mail->addBCC("martin@sconsulting.com.ar"); // destinatario
        $mail->addBCC("info@damiancolombo.com"); // destinatario
        $mail->addBCC("marypeverelli@hotmail.com"); // destinatario
        $mail->IsHTML(true);
        $mail->Subject=$asunto;
        $mail->MsgHTML($body); //Put your body of the message you can place html code here
        $send = $mail->Send(); //Send the mails

        if($send){echo "OK";}else{echo "ERROR2";}
      }

      function enviarMailEstado($email, $id_pedido, $observaciones, $estado, $idUsuario, $nombreCompleto)
      {
        $body="<html><head><title>DAMIAN COLOMBO</title><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        </head><body style='padding:0; margin:0'>
        <table border='0'  width='100%'>
        <tr>
          <td align='center' style='width:100%; background:#767C85; padding:20px;'>
            <a href='https://damiancolombo.com/' style='text-decoration:none'><img src='https://damiancolombo.com/assets/images/logo-blanco-small.png' alt='Damian Colombo' style='display:block; border:0px'></a>
            </td>
        </tr>
        ";
        switch($estado)
        {
          case "EN PROCESO":
          $asunto="CONFIRMACION DE COMPRA Nro. ".$id_pedido;
          $body=$body."<tr>
          <td align='center' style='width:100%; background:#FFF; padding:65px;'>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:22px; color:#000';>
          Muchas gracias por tu compra.
          </p>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>
          Estimad@ ".$nombreCompleto."<br><br>
          Nos complace informarle que su compra Nro. ".$id_pedido." ha sido validada y est&aacute; siendo procesada.
          <br>Recibir&aacute; un correo electr&oacute;nico por separado cada vez que su pedido sea modificado de status hasta que el mismo sea enviado a su lugar de destino. <br>
          <br>Si ten&eacute;s alguna consulta en relaci&oacute;n a tu pedido, por favor env&iacute;anos un mail a sales@damiancolombo.com o llamanos al +1 (786) 351-8210.<br><br>
          &iexcl;Muchas gracias por elegirnos! <br>

          </p>";
          break;

          case "EN TALLER":
          $asunto="STATUS DE LA COMPRA Nro. ".$id_pedido." – EN TALLER";
          $body=$body."<tr>
          <td align='center' style='width:100%; background:#FFF; padding:65px;'>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:22px; color:#000';>
          En taller
          </p>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>Nro. de Compra: ".$id_pedido."</p>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>
          Estimad@ ".$nombreCompleto."<br><br>
          Actualmente tu pedido se encuentra en nuestro taller para ser modificado seg&uacute;n tu solicitud.
          Un vez que el mismo haya sido finalizado, te estaremos informando. <br>

          </p>";
          break;
          case "PREPARACION P/ENVIO":
          $asunto="STATUS DE LA COMPRA Nro. ".$id_pedido." – EN PREPARACION PARA EL ENVIO";
          $body=$body."<tr>
          <td align='center' style='width:100%; background:#FFF; padding:65px;'>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:22px; color:#000';>
          En preparaci&oacute;n para el env&iacute;o
          </p>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>Nro. de Compra: ".$id_pedido."</p>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>
          Estimad@ ".$nombreCompleto."<br><br>
          Tu pedido est&aacute; siendo preparado para ser enviado a su lugar de destino. Una vez que el mismo haya sido despachado, te estaremos informando. <br>

          </p>";
          break;

          case "DESPACHADO":
          $asunto="STATUS DE LA COMPRA Nro. ".$id_pedido." – DESPACHADO";
          $body=$body."<tr>
          <td align='center' style='width:100%; background:#FFF; padding:65px;'>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:22px; color:#000';>
          Despachado
          </p>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>Nro. de Compra: ".$id_pedido."</p>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>
          Estimad@ ".$nombreCompleto."<br><br>
          Tu pedido ha sido enviado. Pronto lo estar&aacute;s recibiendo.<br><br>
          </p>";
          break;
          case "ENTREGADO":
          $asunto="STATUS DE LA COMPRA Nro. ".$id_pedido." – ENTREGADO";
          $body=$body."<tr>
          <td align='center' style='width:100%; background:#FFF; padding:65px;'>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:22px; color:#000';>
          Entregado
          </p>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>Nro. de Compra: ".$id_pedido."</p>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>
          Estimad@ ".$nombreCompleto."<br><br>
          Hemos entregado tu pedido. Esperamos que tu experiencia con nosotros haya sido satisfactoria.<br>
          &iexcl;Sigamos celebrando grandes momentos juntos&#33;<br>
          &iexcl;Muchas gracias por elegirnos&#33;  <br>

          </p>";
          break;
          case "CANCELADO":
          $asunto="CANCELACION DE COMPRA Nro. ".$id_pedido;
          $body=$body."<tr>
          <td align='center' style='width:100%; background:#FFF; padding:65px;'>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:22px; color:#000';>
          Tu compra ha sido cancelada.
          </p>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>Nro. de Compra: ".$id_pedido."</p>
          <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>
          Estimad@ ".$nombreCompleto."<br><br>
          Lamentamos informarle que su pedido ha sido cancelado. A la brevedad uno de nuestros representantes se estar&aacute; contactando con vos para solucionar el inconveniente.<br>

          </p>";
          break;
        }

        $body=$body."<br><br><hr>
        <p style='font-family:Helvetica, Helvetica Neue, Arial, sans-serif; font-size:12px; color:#000';>Atentamente, equipo Dami&aacute;n Colombo.<br>
        +1 (786) 351-8210<br>
        sales@damiancolombo.com</p>
        </td>
        </tr>
        </table>
        </body></html></html>";
        echo $body;
        $remitente="DAMIAN COLOMBO";
        $destino=$email;

        enviarMail($destino,$asunto, $remitente, $body);
      }

      function enviarMailCompra($email, $id_pedido, $observaciones, $estado, $idUsuario, $nombreCompleto)
      {

        $body="<html><head><title>DAMIAN COLOMBO</title><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        </head><body style='padding:0; margin:0'>
        <table border='0'  width='100%'>
        <tr>
        <td align='center' style='width:100%; background:#767C85; padding:50px;'>
        <a href='https://damiancolombo.com/' style='text-decoration:none'><img src='https://damiancolombo.com/assets/images/logo-blanco-small.png' alt='Damian Colombo' style='display:block; border:0px'></a>
        </td>
        </tr>
        <tr>
        <td align='center' style='width:100%; background:#FFF; padding:65px;'>
        <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:22px; color:#000';>
        Se realiz&oacute; una compra.
        </p><p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000';>
        Nro. de Compra: ".$id_pedido."
        <br><br><br><br></p>
        <hr>
        <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:12px; color:#000';>
        Si no pod&eacute;s acceder comunicate con nosotros:<br>
        +1 (786) 351-8210<br>
        sales@damiancolombo.com</p>
        </td>
        </tr>
        </table>
        </body></html></html>
        ";

        $remitente="DAMIAN COLOMBO";
        $destino=$email;
        $asunto="Compra Damian Colombo";
        $EmailColombo="sales@damiancolombo.com";

        /// ENVIA A DAMIAN COLOMBO
        enviarMail($EmailColombo,$asunto, $remitente, $body);

      }

      function formContacto($destino,$asunto, $remitente, $contenido, $tipo){

        $fecha=date("d/m/Y");
        $body="<html>
        <head>
        <title>Pedidos On Line</title>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        </head>
        <body style='padding:0; margin:0'>
        <table border='0' cellspacing='0' cellpadding='30' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:left; background:#F2F2F2' width='100%' align='left'><tr><td align='left' style='width:100%; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:left; background:#F2F2F2' width='100%'>
        <table border='0' cellspacing='0' cellpadding='0' align='left' style='width:590px; margin:0 auto; text-align:left' width='590'><tr><td>
        <table border='0' cellspacing='0' cellpadding='0' style='width:100%' width='100%'>
        <tr>
        <td style='width:160px' width='160'><a href='https://damiancolombo.com/' style='text-decoration:none'><img src='https://damiancolombo.com/assets/images/logo-small.png' alt='Damian Colombo' style='display:block; border:0px'></a></td>
        <td valign='bottom' style='text-align:right' align='right'><h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; margin:0; padding:0; font-size:15px; font-weight:400; color:#666'>Fecha: ".$fecha."</h3></td>
        </tr>
        </table>
        <br><br>

        <h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:14px; line-height:20px; color:#666'; text-align:left>".$contenido."</h3>
        </td></tr></table>  </td></tr></table>  <table border='0' cellspacing='0' cellpadding='50' align='left' style='width:100%; margin:0 auto; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; text-align:left' width='100%'>
        <tr>
        <td>
        <table border='0' cellspacing='0' cellpadding='0' width='590' style='margin: 0 auto;'>
        <tr>
        <td>

        </p>
        </tr>
        </table>
        </td>
        </tr>
        </table>
        </body>
        </html>
        </html>";

        enviarMail($destino,$asunto, $remitente, $body);
      }



      function mailRecuperarClave($email, $nombre, $asunto, $password){

        $fecha=date("d/m/Y");

        $body="<html><head><title>DAMIAN COLOMBO</title><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        </head><body style='padding:0; margin:0'>
        <table border='0'  width='100%'>
        <tr>
        <td align='center' style='width:100%; background:#767C85; padding:50px;'>
        <a href='https://damiancolombo.com/' style='text-decoration:none'><img src='https://damiancolombo.com/assets/images/logo-blanco-small.png' alt='Damian Colombo' style='display:block; border:0px'></a>
        </td>
        </tr>
        <tr>
        <td align='center' style='width:100%; background:#FFF; padding:65px;'>

        <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:14px; color:#000'; text-align:left>
        ".$nombre." your password is:<br><br>
        <strong>".$password."</strong><br><br><br>
        <a href='https://damiancolombo.com/login' style='text-decoration:none'>Access with your data</a>
        </p>
        <hr>
        <p style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:12px; color:#000'; text-align:left>
        If you can not access communicate with us:<br>
        +1 (786) 351-8210<br>
        sales@damiancolombo.com</p>
        </td>
        </tr>
        </table>
        </body></html></html>";
        enviarMail($email,$asunto, "Damian Colombo", $body);
      }


      ?>
