<?php
/**
This Example shows how to expire an API key using the MCAPI.php class and do 
some basic error checking.
**/
require_once '../mcapi.php';
require_once 'config/config.inc.php'; //contains apikey

$api = new MCAPI($apikey);

$retval = $api->apikeyExpire($username, $password);

if ($api->errorCode){
	echo "Unable to Expire API Key()!";
	echo "\n\tCode=".$api->errorCode;
	echo "\n\tMsg=".$api->errorMessage."\n";
} else {
	echo "API Key Expired:".$api->api_key."\n";
}

?>
