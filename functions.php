<?php
function JsonRequest($Method, $Protocol, $Server, $Port, $Function, $aData, $aHeader, $aJsonTrue=1, $aDebug=0){
	$ch = curl_init($Protocol.'://'.$Server.(($Port!="")?':'.$Port:'').$Function);
	if ($aDebug==1) echo "<!--".$Protocol.'://'.$Server.(($Port!="")?':'.$Port:'').$Function."-->\r\n";
	if ($aJsonTrue) $data_string = json_encode($aData); else $data_string=http_build_query($aData);
	if ($Method=='POST') {
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	}
	if ($Method=='GET' ) {
		//curl_setopt($ch, CURLOPT_HTTPGET, 1);
		//curl_setopt($ch, CURLOPT_GETFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	}
	if ($aDebug==1) echo "<!--\nMETHOD:".$Method."\r\n".$data_string.'-->'."\r\n";
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_HEADER  ,1);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
	if ($aDebug==1) {echo "<!--\n"; print_r($aHeader); echo "-->\r\n";};
	$r = curl_exec($ch);
	if ($aDebug==1) echo '<!--'.$r.'-->'."\r\n";
	$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$header      = substr($r, 0, $header_size);
	$body        = substr($r, $header_size);
	$result['header'] = $header;
	$result['body']   = $body;
	return $result;
}

function afterPostLogin(){
	global $_SESSION;
	if ($_SESSION["ClientId"] && $_SESSION["ClientSecret"] && $_SESSION['code']){
		if ($_SESSION['Bearer']==""){
			$xp = array(
				"grant_type"	=> "authorization_code",
				"code"  		=> $_SESSION["code"],
				"redirect_uri"	=> "http://localhost/mb/client.php"
				);
			$xh = array(
				'Content-Type: application/x-www-form-urlencoded',
				'Authorization: Basic '. base64_encode($_SESSION["ClientId"].":".$_SESSION["ClientSecret"])
			);
			$jsonResponse = JsonRequest('POST', "https", "api.secure.mercedes-benz.com", "", "/oidc10/auth/oauth/v2/token", $xp, $xh, 0, 1);
			$response     = json_decode($jsonResponse['body'], true);
			
			$_SESSION['Bearer'] = $response['access_token'];
		}
		if ($_SESSION['Bearer']!=""){
			$cveEndPoint   = "https://api.mercedes-benz.com/experimental/connectedvehicle/v1";
			$xp = array ();
			$xh = array(
				"accept: application/json",
				"authorization: Bearer ".$_SESSION['Bearer']
				);

			if($_SESSION['carid']==""){
				$jsonResponse2 = JsonRequest('GET', "https", "api.mercedes-benz.com", "", "/experimental/connectedvehicle/v1/vehicles", $xp, $xh, 1, 1);
				$response2     = json_decode($jsonResponse2['body'], true);
				$_SESSION['carid'] = $response2[0]['id'];
			}
			$jsonResponse3 = JsonRequest('GET', "https", "api.mercedes-benz.com", "", "/experimental/connectedvehicle/v1/vehicles/".$_SESSION['carid'], $xp, $xh, 1, 1);
			$response3     = json_decode($jsonResponse3['body'], true);
			$carDetail = "<table>";
			foreach($response3 as $k => $v) $carDetail.="<tr><td>".$k."</td><td>".$v."</td></tr>";
			$carDetail .= "</table>";
			
			//$jsonResponse4 = JsonRequest('GET', "https", "api.mercedes-benz.com", "", "/experimental/connectedvehicle/v1/vehicles/".$_SESSION['carid']."/doors", $xp, $xh, 1, 1);
			//$response4     = json_decode($jsonResponse4['body'], true);
			return $carDetail;
		}
	}
}

?>