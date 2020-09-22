<?php

function getJSON($target = '/sys/settings.json', $elem = 'ip'){
	$document = $_SERVER['DOCUMENT_ROOT'].$target;
	$getjson = file_get_contents($document);
	$hostinit = json_decode($getjson, true);
	
	return $hostinit[0][$elem];
}

function conJSON($target){
	$document = $_SERVER['DOCUMENT_ROOT'].$target;
	$getjson = file_get_contents($document);
	$inbound = json_decode($getjson, true);

	return $inbound;
}



?>
