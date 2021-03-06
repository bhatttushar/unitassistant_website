<?php
/**
This Example shows how to unschedule a campaign currently scheduled for delivery
via the MCAPI class.
**/
require_once '../mcapi.php';
require_once 'config/config.inc.php'; //contains apikey

$api = new MCAPI($apikey);

$retval = $api->campaignUnschedule($campaignId);

if ($api->errorCode){
	echo "Unable to Unschedule Campaign!";
	echo "\n\tCode=".$api->errorCode;
	echo "\n\tMsg=".$api->errorMessage."\n";
} else {
	echo "Campaign Unscheduled!\n";
}

?>
