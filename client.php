<?php
	ini_set('display_errors', 1); 
	ini_set('display_startup_errors', 1); 
	error_reporting(E_ALL);
	session_start();
	include('functions.php');
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
	<link rel="icon" href="mercedes.ico?v=1.0">
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.js" ></script>
	<script type="text/javascript" src="client.js?v=1.1"></script>
	<link rel="stylesheet" href="client.css">
</head>
<body>
<div class="Container">
		<button onclick="doCommand('LOCK');"   >LOCK</button>
		<button onclick="doCommand('UNLOCK');" >UNLOCK</button>
		<button onclick="doCommand('INFO');"   >INFO</button>
		<div id="messages" class="messages">
<?php
	if ($_GET['code']!="" || $_SESSION["code"]!="") {
		if ($_GET['code']!="") $_SESSION["code"] = $_GET['code'];
		echo afterPostLogin();
?>
		</div><br/>
		<div id="car" class="car">
			<table cellpadding="0" border="0" cellspacing="0" padding="0" border-spacing="0">
				<tr>
					<td><img alt="" src="slice_0_0.png" style="width: 121px;  height: 173px; border-width: 0px;"></td>
					<td><img alt="" src="slice_0_1.png" style="width: 278px;  height: 173px; border-width: 0px;"></td>
					<td><img alt="" src="slice_0_2.png" style="width: 113px;  height: 173px; border-width: 0px;"></td>
				</tr>
				<tr>
					<td><img alt="" id="FL" src="slice_1_0_LC.png" style="width: 121px;  height: 102px; border-width: 0px;"></td>
					<td><img alt="" src="slice_1_1.png"  style="width: 278px; height: 102px; border-width: 0px;"></td>
					<td><img alt="" id="FR" src="slice_1_2_LC.png" style="width: 113px;  height: 102px; border-width: 0px;"></td>
				</tr>
				<tr>
					<td><img alt="" id="RL" src="slice_2_0_LC.png" style="width: 121px;  height: 102px; border-width: 0px;"></td>
					<td><img alt="" src="slice_2_1.png"  style="width: 278px; height: 102px; border-width: 0px;"></td>
					<td><img alt="" id="RR" src="slice_2_2_LC.png" style="width: 113px;  height: 102px; border-width: 0px;"></td>
				</tr>
				<tr>
					<td><img alt="" src="slice_3_0.png" style="width: 121px;  height: 135px; border-width: 0px;"></td>
					<td><img alt="" src="slice_3_1.png" style="width: 278px;  height: 135px; border-width: 0px;"></td>
					<td><img alt="" src="slice_3_2.png" style="width: 113px;  height: 135px; border-width: 0px;"></td>
				</tr>
			</table>
		</div>		
<?php
	} else {
?>
	Code doesn't exist!
<?php
	}
?>
</div>
</body>
</html>
