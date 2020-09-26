<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
if ($_POST["ClientId"]!="" && $_POST["ClientSecret"]!=""){
		session_start();
		$_SESSION["ClientId"]=$_POST["ClientId"];
		$_SESSION["ClientSecret"]=$_POST["ClientSecret"];
		header(	
				"location: https"."://".
				"api.secure.mercedes-benz.com".
				"/oidc10/auth/oauth/v2/authorize?".
				"response_type=code&".
				"client_id=".$_POST["ClientId"]."&".
				"redirect_uri=http%3A%2F%2Flocalhost%2Fmb%2Fclient.php&".
				"scope=mb:vehicle:status:general mb:user:pool:reader"
			);
		exit();
}
?>
<!doctype html>
<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <meta content="utf-8" http-equiv="encoding" />
    <meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=0.5, user-scalable=0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <title>Connected Vehicle Experimental APP</title>
	<link rel="stylesheet" href="index.css">
	<link rel="icon" href="mercedes.ico?v=1.0">
</head>
<body>
<div class="logindiv" id="logindiv">
	<span id="headerText">CVE Client</span>
	<form action="index.php" method="post" id="loginForm">
		<input type="hidden" id="appType" value="">
		<input type="text" name="ClientId" id="ClientId" title="ClientId" class="inp inp2" 
		placeholder="ClientId" value="9399987d-a7b5-4255-a73b-55dd879531d5"><br>
		<input type="text" name="ClientSecret" id="ClientSecret" title="ClientSecret" class="inp inp2" 
		placeholder="ClientSecret" required value="8be5bb1a-7fa7-4b19-91da-cd7f8e47db0e"><br>
		<input type="submit" class="inp inp2" id="submitButton" value="Login">
	</form>
</div>
</body>
</html>
