<?php
/*
* Proxy connection to the phpmotors database
*/

function phpmotorsConnect()
{
$server ='127.0.0.1';
$dbname ='phpmotors';
$username ='iClient';
$password ='1234';
$dsn ="mysql:host=$server;dbname=$dbname";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try{
  $link = new PDO($dsn, $username, $password, $options);
  
  return $link;
 } catch(PDOException $e){
    header('Location: /phpmotors/views/500.php');
    exit;
 }
}
//phpmotorsConnect();

