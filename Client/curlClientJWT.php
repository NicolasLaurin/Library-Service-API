<?php
require_once "vendor/autoload.php";
$_SERVER['HTTP_AUTHORIZATION'] = require_once "authentication(JWT).php";

use GuzzleHttp\Client;

$auth_token = $_SERVER['HTTP_AUTHORIZATION'];

if (preg_match('/Bearer\s(\w.+)/', $auth_token, $matches) && $auth_token != "Bearer undefined") {
	$client = new Client([
		'base_uri' => 'http://localhost/videoconversionservice/api/'
	]);

	$response = $client->request('POST', 'videoconversion', [
		'originalFormat' => 'mp4',
		'targetFormat' => 'avi',
		'licenseKey' => 'KEYABC',
		'file' => 'C:\\xampp\\htdocs\\VideoConversionService\\ImportantFiles\\VideoFile.mp4',
		'auth' => ['username', 'password']
	]);

	$body = $response->getBody();
	$body_array = json_decode($body);
	print_r($body_array);
} else {
	echo "Access Denied - Unauthorized";
}
