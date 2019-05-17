<?php 
session_start();
ob_start();
include ("connect.php");

/*
If (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'])
{
    var_dump($_POST);
    $secret = "6Lc5IhUUAAAAAA2YGGzLe5lSTX7J1qwgSPNIGw_l";
    $ip = $_SERVER["REMOTE_ADDR"];

    $captcha = $_POST['g-recaptcha-response'];

    $result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");

    var_dump($result);

    $array = json_decode($result,TRUE);

    if($array["success"]){ */

            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;

            $email = htmlspecialchars($email);
            $password = htmlspecialchars($password);




            $login_ok   = false;


            $sql    = "SELECT password FROM claves where email =?";
            $stmt   = $mysqli->prepare($sql);
            $stmt->bind_param('s', $email) or die ($mysqli->error);
            $stmt->execute();
            $stmt->bind_result($password_db);

            echo "SELECT password, estado FROM usuarios where email ='$email'";

            if($stmt->fetch()) 
            {

                /*$check_password = hash('sha256', $password . $salt);
                for ($r=0;$r<65536;$r++) 
                {
                    $check_password = hash('sha256', $check_password . $salt);
                }

                //echo "check_password-> ".$check_password."password_db: ".$password_db;
                */
                if ($password == $password_db) 
                {
                    $login_ok = true;
                }
                $stmt->close();

            } else {
                header("Location: index.php?e=1");	
            }

            //echo "----->".$login_ok;

            if ($login_ok) {
                //echo "pasoooo2";
                $sql    = "SELECT idClaves, nombre, nivel  FROM claves where email=?";
                $stmt   = $mysqli->prepare($sql) or die($mysqli->error);
                $stmt->bind_param('s', $email) or die ($mysqli->error);
                $stmt->execute();
                $stmt->bind_result($idClaves, $nombre, $nivel);
                $stmt->store_result();
                if ($stmt->fetch()) 
                { 
                    //echo "pasoooo3";
                    $_SESSION["security"]       = "FF56YU235";
                    $_SESSION["idClaves"]       = $idClaves;
                    $_SESSION["nombreUsuario"]  = $nombre;	
                    $_SESSION["nivel"]          = $nivel;
    

                    $date = date("Y-m-d");
                    
                    header("Location: home.php");
                    
                } else {

                  header("Location: index.php?e=1"); 

                }


            } else {

              header("Location: index.php?e=1");	
            }
/*
    } else {

        header("Location: index.php?e=1");
    }

} else{
        
    header("Location: index.php?e=1");

}    */
?>