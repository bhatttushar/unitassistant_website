<?php
/**
This Example shows how to send Replicate Campaigns via the MCAPI class.
**/
require_once '../mcapi.php';
require_once 'config/config.inc.php'; //contains apikey

$api = new MCAPI($apikey);

$retval = $api->campaignReplicate($campaignId);

if ($api->errorCode){
	echo "Unable to Replicate Campaign!";
	echo "\n\tCode=".$api->errorCode;
	echo "\n\tMsg=".$api->errorMessage."\n";
} else {
	echo "New Campaign Id = $retval\n";
}

?>
