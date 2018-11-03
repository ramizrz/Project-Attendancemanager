<?php
//$string=exec('getmac');
//$mac=substr($string, 0, 17); 
//echo $mac;




//ob_start();
//system('ipconfig /all');
//$mycom=ob_get_contents();
//ob_clean();
//$findme = 'physical';
//$pmac = strpos($mycom, $findme);
//$mac=substr($mycom,($pmac+36),17);
//echo $mac;




function getMacAddr(){
  ob_start(); // Turn on output buffering
  system('ipconfig /all'); //Execute external program to display output
  $mycom=ob_get_contents(); // Capture the output into a variable
  ob_clean(); // Clean (erase) the output buffer

  $findme = "Physical";
  $pmac = strpos($mycom, $findme); // Find the position of Physical text
  $mac=substr($mycom,($pmac+36),17); // Get Physical Address
  return $mac.'_'.$_SERVER['HTTP_USER_AGENT'];
 }
 echo getMacAddr();




?>