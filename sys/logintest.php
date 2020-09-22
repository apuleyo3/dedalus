<?php

/*$usr = $_GET['user'];
$pass = $_GET['pass'];
$doc = $_SERVER['DOCUMENT_ROOT'].'/sys/settings.json';
$getjson = file_get_contents($doc);
$passelem = json_decode($getjson, true);
$passmd5 = md5($pass);
$usrmd5 = md5($usr);

if($passmd5 == $passelem[0]['pass'] && $usrmd5 == $passelem[0]['admin']){

    session_start();
    $_SESSION['user']= 'admin';
    echo $_SESSION['user'];
}
else{
    echo 'no-pass';
}*/

session_start();
unset($_SESSION["username"]);
unset($_SESSION["password"]);

echo 'You have cleaned session';
header('Refresh: 0; URL = /index.php');

?>