<?php

$getStatus = escapeshellcmd('python3 contest.py');
$output = shell_exec($getStatus);

echo $output;

?>