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
            $password = isset($_POST['password']) ? $_POST['password'] : null;
            $orig = isset($_POST['orig']) ? $_POST['orig'] : null;

            $email = htmlspecialchars($email);
            $password = htmlspecialchars($password);

            echo "-----> ".$email;

            echo "<br>-----> ".$password;



            $login_ok   = false;

            include ("backoffice/connect.php");

            $sql    = "SELECT password, estado FROM usuarios where email = ?";

            echo "SELECT password, estado FROM usuarios where email = $email";
            $stmt   = $mysqli->prepare($sql);
            $stmt->bind_param('s', $email) or die ($mysqli->error);
            $stmt->execute();
            $stmt->bind_result($password_db, $estado);


            if($stmt->fetch())
            {

                echo "<br>----------------------- ".$enc33;

                echo "<br><br>----------------------------> ".$password." | ".$password_db;

                $password_db = desencriptar($password_db, $enc33);

                echo "________________________________________________".$password." | ".$password_db;


                echo "________________________________________________".$password." | ".$password_db;


                if (trim($password) == trim($password_db) && $estado > 0)
                {
                    $login_ok = true;

                    echo "Paso IF";
                }

                $stmt->close();

            } else {

                header("Location: login-error");

            }

            if ($login_ok) {

                echo "________________________ login_ok";

                include ("backoffice/connect.php");
                $sql    = "SELECT idUsuario, nombre, apellido, email, direccion, localidad, cp, telefono  FROM usuarios where email=?";
                $stmt   = $mysqli->prepare($sql) or die($mysqli->error);
                $stmt->bind_param('s', $email) or die ($mysqli->error);
                $stmt->execute();
                $stmt->bind_result($idUsuario, $nombre, $apellido, $email, $direccion, $localidad, $cp, $telefono);
                $stmt->store_result();
                if ($stmt->fetch())
                {


                    $nombre = desencriptar($nombre, $enc33);
                    $apellido = desencriptar($apellido, $enc33);
                    $direccion = desencriptar($direccion, $enc33);
                    $localidad = desencriptar($localidad, $enc33);
                    echo "//////////////";
                    $telefono = desencriptar($telefono, $enc33);
                   // $cp = desencriptar($cp, $enc33);
                    //$provincia = desencriptar($provincia, $enc33);

                    $_SESSION["security"]       = trim("RT99T123VF");
                    $_SESSION["idUsuario"]      = trim($idUsuario);
                    $_SESSION["email"]          = trim($email);
                    $_SESSION["estado"]         = trim($estado);
                    $_SESSION["nombre"]         = $nombre." ".$apellido;
                    $_SESSION["nombre2"]        = trim($nombre);
                    $_SESSION["apellido"]       = trim($apellido);
                    $_SESSION["telefono"]       = trim($telefono);
                    $_SESSION["direccion"]      = trim($direccion);
                    $_SESSION["localidad"]      = trim($localidad);
                    $_SESSION["provincia"]      = trim($provincia);
                    $_SESSION["cp"]             = trim($cp);


                    $date = date("Y-m-d");
                    $flagRed=0;

                    switch ($orig) {
                        case "1":
                            $flagRed=1;
                            header("Location: checkout");
                            break;
                        case "2":
                            $flagRed=1;
                            header("Location: wishlist");
                            break;
                    }

                    If ($flagRed==0){
                        header("Location: cuenta");
                    }

                    // Deriva desde donde se logueo

                } else {

                  header("Location: login-error");

                }
                // Si existe el usuario


            } else {

              header("Location: login-error");


                echo "Sale por aca<br>";
                echo "________________________________________________".$password." | ".$password_db;
            }

            // Si el password es válido.

    } else {

        header("Location: login-error");
    }

    //Valida Captcha Success

} else{

    header("Location: login-error");

}
//Valida Captcha Campos
?>
