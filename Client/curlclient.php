<?php
	//Create a new cURL object:
	$curl = curl_init();

	//Set URL and other options:
	curl_setopt($curl, CURLOPT_URL, "http://localhost/videoconversionservice/api/client/");

	//Execute the request:
	curl_exec($curl);

	//Close the cURL object:
	curl_close($curl);
?>