<?php
/**
This Example shows how to Update a regular Campaign via the MCAPI class.
**/
require_once '../mcapi.php';
require_once 'config/config.inc.php'; //contains apikey

$api = new MCAPI($apikey);

$field = "title";
$value = "My New Title";

$retval = $api->campaignUpdate($campaignId, $field, $value);

if ($api->errorCode){
	echo "Unable to Update Campaign!";
	echo "\n\tCode=".$api->errorCode;
	echo "\n\tMsg=".$api->errorMessage."\n";
} else {
    echo "SUCCESS! \n";
}

?>
