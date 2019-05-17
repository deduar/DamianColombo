<?php 
session_start();
ob_start();
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;

/*
If (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'])
{
    var_dump($_POST);
    $secret = "6LfK2hMUAAAAAIB5Z9IL15crpDCsHMJwPUCttxY8";
    $ip = $_SERVER["REMOTE_ADDR"];

    $captcha = $_POST['g-recaptcha-response'];

    $result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");

    var_dump($result);

    $array = json_decode($result,TRUE);

    if($array["success"]){*/


        If ($tipo==1){

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : null;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : null;
            $cp = isset($_POST['cp']) ? $_POST['cp'] : null;
            $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;


            $nombre = htmlspecialchars($nombre);
            $apellido = htmlspecialchars($apellido);
            $email = htmlspecialchars($email);
            $telefono = htmlspecialchars($telefono);
            $direccion = htmlspecialchars($direccion);
            $localidad = htmlspecialchars($localidad);
            $provincia = htmlspecialchars($provincia);
            $cp = htmlspecialchars($cp);
            $apellido = htmlspecialchars($apellido);
            $observaciones = htmlspecialchars($observaciones);                        

            

            $_SESSION["email"]          = $email;   
            $_SESSION["nombre"]         = $nombre;
            $_SESSION["apellido"]       = $apellido;
            $_SESSION["telefono"]       = $telefono;

            $_SESSION["direccion"]       = $direccion;
            $_SESSION["localidad"]       = $localidad;
            $_SESSION["provincia"]       = $provincia;
            $_SESSION["cp"]       = $cp;
            $_SESSION["observaciones"]       = $observaciones;

            $_SESSION["envio"]           = $envio;

        }else{
            $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;
            $observaciones = htmlspecialchars($observaciones); 
            $_SESSION["observaciones"]       = $observaciones;
        }

        header("Location: checkout-payment");

            

                

   /* } else {

        header("Location: login-error");
    }

} else{
        
    header("Location: login-error");

}*/
?>