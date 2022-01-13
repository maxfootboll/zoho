<?php 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://accounts.zoho.com/oauth/v2/token");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  //  'Content-Type: application/json',
	'Authorization: Zoho-oauthtoken 1000.361624dac5812e377d36d875204daa8b.d754374b430bb5014a35b0575fbef659',
));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
             http_build_query(array("grant_type" => "authorization_code", "client_id" => "1000.A9Y0AY4NT94Q53NI2MGDRUVOQOEIML", "client_secret" => "e15351a1005f53fc20193b63f701c93105dc592ede", "redirect_uri" => "", "code" => "1000.e7a76bd811782c2ddd7bbc4dba528300.4c02252f05dfb306dff12aa8668fa95c" )));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);

var_dump($server_output);

$f = fopen('token.json', 'w+');
fwrite($f, $server_output);
fclose($f);

 ?>