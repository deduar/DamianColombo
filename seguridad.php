<?php
if (!isset($_SESSION['idUsuario'])) 
{?>

    <script type="text/javascript">
      window.location.replace("login.php");
    </script>

<?php
    header('Location: login.php');
    die();
}?>