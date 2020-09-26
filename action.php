<?php
require('functions.php');
session_start();
$parts = explode("?", $_SERVER["REQUEST_URI"]);
if ($_SESSION['Bearer']!=""){
	switch ($parts[1]){
		case "INFO":
			$cveEndPoint   = "https://api.mercedes-benz.com/experimental/connectedvehicle/v1";
			$xp = array ();
			$xh = array(
				"accept: application/json",
				"authorization: Bearer ".$_SESSION['Bearer']
				);
			$jsonResponse4 = JsonRequest('GET', "https", "api.mercedes-benz.com", "", "/experimental/connectedvehicle/v1/vehicles/".$_SESSION['carid']."/doors", $xp, $xh, 1, 0);
			echo "'".$jsonResponse4['body']."'";
		break;
		case "LOCK":
			$cveEndPoint   = "https://api.mercedes-benz.com/experimental/connectedvehicle/v1";
			$xp = array ("command"=>"LOCK");
			$xh = array(
				"accept: application/json",
				"authorization: Bearer ".$_SESSION['Bearer']
				);
			$jsonResponse4 = JsonRequest('POST', "https", "api.mercedes-benz.com", "", "/experimental/connectedvehicle/v1/vehicles/".$_SESSION['carid']."/doors", $xp, $xh, 1, 0);
			echo "'".$jsonResponse4['body']."'";
		break;
		case "UNLOCK":
			$cveEndPoint   = "https://api.mercedes-benz.com/experimental/connectedvehicle/v1";
			$xp = array ("command"=>"UNLOCK");
			$xh = array(
				"accept: application/json",
				"authorization: Bearer ".$_SESSION['Bearer']
				);
			$jsonResponse4 = JsonRequest('POST', "https", "api.mercedes-benz.com", "", "/experimental/connectedvehicle/v1/vehicles/".$_SESSION['carid']."/doors", $xp, $xh, 1, 0);
			echo "'".$jsonResponse4['body']."'";
		break;
	}
}
?>