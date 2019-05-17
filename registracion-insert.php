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

                    echo "--------------------> Succes";
                    $nombre         = htmlspecialchars($_POST['nombre']);
                    $apellido       = htmlspecialchars($_POST['apellido']);
                    $email          = htmlspecialchars($_POST['email']);
                    $email2         = htmlspecialchars($_POST['email2']);
                    $password       = htmlspecialchars($_POST['password']);
                    $password2      = htmlspecialchars($_POST['password2']);
                    $telefono       = htmlspecialchars($_POST['telefono']);
                    $direccion      = htmlspecialchars($_POST['direccion']);
                    $localidad      = htmlspecialchars($_POST['localidad']);
                    $cp             = htmlspecialchars($_POST['cp']);
                    $provincia      = htmlspecialchars($_POST['provincia']);

/*
                    $nombre = desencriptar($nombre, $enc33);
                    $apellido = desencriptar($apellido, $enc33);
                    //$email = desencriptar($email, $enc33);
                    $direccion = desencriptar($direccion, $enc33);
                    $localidad = desencriptar($localidad, $enc33);
                    $telefono = desencriptar($telefono, $enc33);
                    
                    $cp = desencriptar($cp, $enc33);
                    $provincia = desencriptar($provincia, $enc33);*/


                    $flag='';
                    $flagUnion=0;
                    

                    if ($email != $email2)  {
                        If ($flagUnion==1){
                            $flag .= "&em=1";
                        }else{
                            $flag .= "em=1";
                            $flagUnion=1;
                        }

                        $_SESSION["temp"]["email"]= "";

                    }

                    if ($password != $password2)  {
                        
                        If ($flagUnion==1){
                            $flag .= "&ps=1";
                        }else{
                            $flag .= "ps=1";
                        }

                        $_SESSION["temp"]["password"]= "";
                    }

                    ////// CORROBORA QUE NO ESTE REGISTRADO EL EMAIL
                    include ("backoffice/connect.php");
                    $stmt   = $mysqli->prepare("SELECT email FROM usuarios WHERE email =?");
                    $stmt->bind_param('s', $email);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        $flag .= "re=1";
                        $flagUnion=1;
                    }

                    $stmt->close();



                    if ($flag == '') 
                    {


                        echo "------------------------------------> PASO FLAG";


                        /////////////////////////////////////////////
                        //encoding problems
                        $nombre         = utf8_decode($nombre);
                        $apellido       = utf8_decode($apellido);
                        $email          = utf8_decode($email);
                        $direccion      = utf8_decode($direccion);
                        $localidad      = utf8_decode($localidad);
                        $provincia      = utf8_decode($provincia);
                        $telefono       = utf8_decode($telefono);
                        $password       = utf8_decode($password);

                        $nombre = encriptar($nombre, $enc33);
                        $apellido = encriptar($apellido, $enc33);
                        //$email = encriptar($email, $enc33);
                        $direccion = encriptar($direccion, $enc33);
                        $localidad = encriptar($localidad, $enc33);
                        $telefono = encriptar($telefono, $enc33);
                        $password = encriptar($password, $enc33);
                        //$cp = encriptar($cp, $enc33);
                        //$provincia = encriptar($provincia, $enc33);

                        /////////////////////////////////////////////////////////////////////////
                        
                        $fecha=date("Y/m/d");
                        $estado=1;

                        include ("backoffice/connect.php");
                        $sql = "INSERT INTO usuarios (nombre, apellido,  email, password, direccion, localidad, cp, provincia, telefono, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = $mysqli->prepare($sql) or die ($mysqli->error);
                        $stmt->bind_param('sssssssssi', $nombre, $apellido, $email, $password, $direccion, $localidad, $cp, $provincia, $telefono, $estado) or die ($mysqli->error);
                        $stmt->execute();
                        
                        /*include ("backoffice/connect2.php");
                        $result = $mysqli->query("SELECT MAX(idUsuario) as max FROM usuarios");
                        $row = $result->fetch_assoc();
                        $idUsuario=$row["max"];
                        
                        include ("backoffice/connect2.php");
                        $sql = "INSERT INTO entregavivre (idUsuario, direccion, localidad, provincia, cp) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = $mysqli->prepare($sql) or die ($mysqli->error);
                        $stmt->bind_param('isssss', $idUsuario, $direccion, $localidad, $provincia, $cp) or die ($mysqli->error);
                        $stmt->execute();


                        include ("backoffice/connect2.php");
                        $result = $mysqli->query("SELECT MAX(idEntrega) as max FROM entregavivre");
                        $row = $result->fetch_assoc();
                        $idEntrega=$row["max"];


                        include ("backoffice/connect2.php");
                        $sql2 = "UPDATE usuarios SET idEntrega = ? WHERE idUsuario = ?";
                        $stmt2 = $mysqli->prepare($sql2) or die ($mysqli->error);
                        $stmt2->bind_param('is', $idEntrega, $idUsuario) or die ($mysqli->error);
                        $stmt2->execute();
                        $stmt2->close();  */


                        header("Location: registracion-confirmacion.php?email=$email");

                    } else {
                            $_SESSION["temp"]["nombre"]         = $nombre;
                            $_SESSION["temp"]["apellido"]       = $apellido;
                            $_SESSION["temp"]["email"]          = $email;
                            $_SESSION["temp"]["email2"]         = $email2;
                            $_SESSION["temp"]["direccion"]      = $direccion;
                            $_SESSION["temp"]["localidad"]      = $localidad;
                            $_SESSION["temp"]["cp"]             = $cp;
                            $_SESSION["temp"]["provincia"]      = $provincia;
                            $_SESSION["temp"]["telefono"]       = $telefono;
                            header("Location: registracion.php?$flag");
                    }
    } else {
        header("Location: registracion.php?captcha=1");
        //echo "------------------------------------> No succes";
    }

} else{
        header("Location: registracion.php?$captcha=1");
        //echo "---------------------------------------> No post";
}     
?>