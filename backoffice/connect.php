<?php
$mysqli= new mysqli("localhost", "root", "root","colombodb");
//$mysqli= new mysqli("localhost", "damianco_testuse", "vaLencia_73","damianco_test");
//$mysqli= new mysqli("localhost", "c1200348_colombo", "zemoNAdu48","c1200348_colombo");
//$mysqli= new mysqli("localhost", "damianco_sconsul", "z2aJbEALNrdv","damianco_desarrollosc");


if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
 if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
    {
        function undo_magic_quotes_gpc(&$array)
        {
            foreach($array as &$value)
            {
                if(is_array($value))
                {
                    undo_magic_quotes_gpc($value);
                }
                else
                {
                    $value = stripslashes($value);
                }
            }
        }

        undo_magic_quotes_gpc($_POST);
        undo_magic_quotes_gpc($_GET);
        undo_magic_quotes_gpc($_COOKIE);
    }


?>
