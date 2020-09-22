<?php

$getStatus = escapeshellcmd('python3 xpdata.py');
$output = shell_exec($getStatus);

echo $output;

?>