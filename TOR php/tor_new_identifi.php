<?PHP




if (tor_new_identity('127.0.0.1', '9051')) {
	echo "Identity switched!";
}

/**
 * Switch TOR to a new identity.
 **/
function tor_new_identity($tor_ip='127.0.0.1', $control_port='9051', $auth_code=''){
	$fp = fsockopen($tor_ip, $control_port, $errno, $errstr, 30);
	if (!$fp) return false; //can't connect to the control port
 
	fputs($fp, "AUTHENTICATE $auth_code\r\n");
	$response = fread($fp, 1024);
	list($code, $text) = explode(' ', $response, 2);
	if ($code != '250') return false; //authentication failed
 
	//send the request to for new identity
	fputs($fp, "signal NEWNYM\r\n");
	$response = fread($fp, 1024);
	list($code, $text) = explode(' ', $response, 2);
	if ($code != '250') return false; //signal failed
 
	fclose($fp);
	return true;
}
 
function tor_get_cookie($filename){
	$cookie = file_get_contents($filename);
	//convert the cookie to hexadecimal
	$hex = '';
	for ($i=0;$i<strlen($cookie);$i++){
		$h = dechex(ord($cookie[$i]));
		$hex .= str_pad($h, 2, '0', STR_PAD_LEFT);
	}
	return strtoupper($hex);
}

sleep(3);

?>