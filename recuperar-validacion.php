<?php
session_start();
ob_start();
include ("backoffice/incFunction.php");
If (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'])
{
  var_dump($_POST);
  $secret = "6Lc5IhUUAAAAAA2YGGzLe5lSTX7J1qwgSPNIGw_l";
  $ip = $_SERVER["REMOTE_ADDR"];

  $captcha = $_POST['g-recaptcha-response'];

  $result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
  var_dump($result);

  $array = json_decode($result,TRUE);

  if($array["success"]){

    echo "Paso Success";

    $email = isset($_POST['email']) ? $_POST['email'] : null;

    $email = htmlspecialchars($email);

    $login_ok   = false;

    include ("backoffice/connect.php");

    $sql    = "SELECT idUsuario, nombre, apellido, email, password, estado FROM usuarios where email = ?";

    $stmt   = $mysqli->prepare($sql);
    $stmt->bind_param('s', $email) or die ($mysqli->error);
    $stmt->execute();
    $stmt->bind_result($idUsuario, $nombre, $apellido, $email, $password_db, $estado);
    if($stmt->fetch())
    {
      $enc33 = "kalo_as56";
      $password_db = desencriptar($password_db, $enc33);
      $nombre = desencriptar($nombre, $enc33);




      if ($estado > 0)
      {
        $login_ok = true;
        //ENVIAR EMAIL CON DATOS DE ACCESO////////////////////////////////////////////////////////////
        $asunto="Recover Password Damian Colombo";
        mailRecuperarClave($email, $nombre, $asunto, $password_db);
        header("Location: recuperar-login-ok");
      }
      $stmt->close();
    } else {
      header("Location: recuperar-login-error");
    }
  } else {
    header("Location: recuperar-login-error");
  }
  //Valida Captcha Success
} else{
  header("Location: recuperar-login-error");
}
//Valida Captcha Campos
?>
