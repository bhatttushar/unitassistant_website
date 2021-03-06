<?php
/**
This Example shows how to retrieve a list of your Campaign Templates
via the MCAPI class.
**/
require_once '../mcapi.php';
require_once 'config/config.inc.php'; //contains apikey

$api = new MCAPI($apikey);

$types = array('user'=>true, 'gallery'=>true);
$retval = $api->templates($types);

if ($api->errorCode){
	echo "Unable to Load Templates!";
	echo "\n\tCode=".$api->errorCode;
	echo "\n\tMsg=".$api->errorMessage."\n";
} else {

	echo "Your templates:\n";
	foreach($retval['user'] as $tmpl){
	    echo $tmpl['id']." | ".$tmpl['name']." | ".$tmpl['layout']."\n";
	}
	echo "Gallery templates:\n";
	foreach($retval['gallery'] as $tmpl){
	    echo $tmpl['id']." | ".$tmpl['name']." | ".$tmpl['layout']."\n";
	}
}

?>
