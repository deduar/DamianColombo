<?php
$data_in = "http://ws.geeklab.com.ar/dolar/get-dolar-json.php";
$data_json = @file_get_contents($data_in);
if(strlen($data_json)>0)
{
  $data_out = json_decode($data_json,true);
 
  if(is_array($data_out))
  {
    if(isset($data_out['libre'])) print "Libre: ".$data_out['libre']."<br>\n";
    if(isset($data_out['blue'])) print "Blue: ".$data_out['blue']."<br>\n";
  }
}
?>