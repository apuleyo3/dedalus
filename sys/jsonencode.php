<?php

$finalip = $_POST['ip'];
$cpass = $_POST['cpass'];
$cadmin = $_POST['cadmin'];
$factory = $_POST['factory'];

$msg = '';

$document = $_SERVER['DOCUMENT_ROOT'].'/sys/settings.json';
$getjson = file_get_contents($document);

if($factory == 'no' && empty($finalip))
{
    $newpass = json_decode($getjson, true);

    $newpass[0]["custom_user"] = md5($cadmin);
    $newpass[0]["custom_pass"] = md5($cpass);
    $newpass[0]["factory"] = "no";
    $newJsonString = json_encode($newpass);

    $msg = 'keys-saved';
}
elseif($factory == 'yes' && empty($finalip))
{
    $reset = json_decode($getjson, true);

    $reset[0]["custom_user"] = "";
    $reset[0]["custom_pass"] = "";
    $reset[0]["factory"] = "yes";
    $newJsonString = json_encode($reset);

    $msg = 'reset';

}
else
{
    
    $hostinit = json_decode($getjson, true);
    $hostinit[0]["ip"] = $finalip;
    $newJsonString = json_encode($hostinit);

    $msg = 'ip-saved';
   
}

chmod($document, 0777);
file_put_contents($document, $newJsonString);
chmod($document, 0664);
shell_exec('systemctl restart ifsand.service');
echo $msg;


?>
