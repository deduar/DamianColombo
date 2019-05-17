<?php session_start();?>
<?ob_start();?>
<?php include ("backoffice/incFunction.php");?>
<?php

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;
$codSubCategoria = isset($_POST['codSubCategoria']) ? $_POST['codSubCategoria'] : null;

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



				$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
				$email = isset($_POST['email']) ? $_POST['email'] : null;
				$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
				$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : null;
				
				$producto = isset($_POST['producto']) ? $_POST['producto'] : null;

				$nombre         = htmlspecialchars($nombre);
				$email          = htmlspecialchars($email);
				$telefono       = htmlspecialchars($telefono);
				$mensaje      	= htmlspecialchars($mensaje);

				switch($tipo)
		        {
			        case "CONTACTO":
						$contenido="Nombre: ".$nombre."<br>Email: ".$email."<br>Telefono: ".$telefono."<br><br>Mensaje: ".$mensaje."<br>";
						$asunto="Contacto Damian Colombo";
						break;
					case "CONSULTA":
						$contenido="Consulta sobre producto: <b>".$producto."</b><br><br>Nombre: ".$nombre."<br>Email: ".$email."<br>Telefono: ".$telefono."<br><br>Mensaje: ".$mensaje."<br>";
						$asunto="Consulta de Producto Damian Colombo";
						break;
					case "ORDENAR":
						$contenido="Ordenar: <b>".$producto."</b><br><br>Nombre: ".$nombre."<br>Email: ".$email."<br>Telefono: ".$telefono."<br><br>Mensaje: ".$mensaje."<br>";
						$asunto="Ordenar producto Damian Colombo";
						break;

				}


				formContacto($EmailColombo, $asunto, $nombre, $contenido, $tipo);

				If ($tipo=="CONTACTO"){
						header("Location: thanks");
				}else {
						header("Location: product-detail.php?codigo=$codigo&codSubCategoria=$codSubCategoria&flagEnvio=ok");
				}


} else {

		If ($tipo=="CONTACTO"){
			echo "Contacto";
				header("Location: contacto-false");
		}else {
				header("Location: product-detail.php?codigo=$codigo&codSubCategoria=$codSubCategoria&flagEnvio=false");
		}

        
    }

} else{

		If ($tipo=="CONTACTO"){
					header("Location: contact-false");
		}else {
				header("Location: product-detail.php?codigo=$codigo&codSubCategoria=$codSubCategoria&flagEnvio=false");
		}

}

?>
