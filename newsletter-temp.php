<?php 
session_start();
ob_start();

$email = isset($_POST['email']) ? $_POST['email'] : null;
$email = htmlspecialchars($_POST['email']);

$flag=1;

////// CORROBORA QUE NO ESTE REGISTRADO EL EMAIL

If ($_POST['email']){

    include ("backoffice/connect.php");
    $stmt   = $mysqli->prepare("SELECT email FROM newsletter WHERE email =?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $flag = 0;
    }

    $stmt->close();

    if ($flag == 1) 
    {
       
        $fecha=date("Y/m/d");
        include ("backoffice/connect.php");
        $sql = "INSERT INTO newsletter (fecha, email) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql) or die ($mysqli->error);
        $stmt->bind_param('ss', $fecha, $email) or die ($mysqli->error);
        $stmt->execute();
    } 

}

header("Location: gracias-newsletter");
                   
?>