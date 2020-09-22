<?php

$getStatus = escapeshellcmd('python3 networkscan.py');
$output = shell_exec($getStatus);

echo $output;

?>