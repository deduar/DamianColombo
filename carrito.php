<?php session_start();?>
<?ob_start();?>
<?php include ("backoffice/connect.php");?>
<?php include ("backoffice/incFunction.php");?>
<?php

  
      

      if (isset($_GET['cantidad']))
          $cantidad = $_GET['cantidad'];
      else
          $cantidad = $_POST['cantidad'];

      if (isset($_GET['medida']))
          $medida = $_GET['medida'];
      else
          $medida = $_POST['medida'];

      
      if (isset($_GET['id']))
        $id = $_GET['id'];
      else
        $id = 1;
      
      if (isset($_GET['action']))
        $action = $_GET['action'];
      else
        $action = "empty";
  
  echo "id: ".$id;
  echo "<br>";
  echo "action: ".  $action;
  echo "<br>";
  echo "medida: ".  $medida;
  echo "<br>";

  echo "<br>--------------------------------------";
  

  echo "Cant. ".$cantidad;

      switch($action){
      
        case "add":
          if(isset($_SESSION['carro'][$id])){
            $_SESSION['carro'][$id]++;
          } else {
            $_SESSION['carro'][$id]=1;
          }



          

          $_SESSION['medida'][$id]=$medida;
          
          echo "-------------> Valor Medida".$medida;

          echo "<br>-------------> Valor id".$id;

          echo "<br><br>||||------------->Valor Session Medida Id ".$_SESSION['medida'][$id];


        break;

        case "add2":
            
            echo "--->Session carro ".$_SESSION['carro'][$id];

            $_SESSION['carro'][$id]=0;
            for ($i=1; $i <= $cantidad ; $i++) { 
              $_SESSION['carro'][$id]++;

            $_SESSION['medida'][$id]=$medida;
            
          
          echo ">Session carro  ".$_SESSION['carro'][$id];

          echo ">Session medida  ".$_SESSION['medida'][$id];
            
          }
        break;        
        
        case "remove":
          if(isset($_SESSION['carro'][$id]))
          {
            $_SESSION['carro'][$id]--;
            if($_SESSION['carro'][$id]==0)
              unset($_SESSION['carro'][$id]);
              unset($_SESSION['medida'][$id]);
          }
          
        break;
        case "removeProd":
          
          if(isset($_SESSION['carro'][$id])){
            unset($_SESSION['carro'][$id]);
          }

          if(isset($_SESSION['medida'][$id])){
            unset($_SESSION['medida'][$id]);
          }          
        break;
        
        case "mostrar":
          if(isset($_SESSION['carro'][$id])){
            continue;
          }
        break;
        
        case "empty":
          unset($_SESSION['carro']);
        
        break;
            
        
      }

header("Location: bag");

?>
<?php  print "<pre>"; print_r($_SESSION); print "</pre>\n"; ?>