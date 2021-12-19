<?php
//-----------------------------------------------------------
//Original:
// require_once 'vendor/autoload.php';

// use GuzzleHttp\Client;

// $client = new GuzzleHttp\Client([
//     // Base URI is used with relative requests
//     'base_uri' => 'http://localhost/videoconversionservice/api/'
//     // You can set any number of default request options.
//     // 'timeout'  => 2.0
// ]);

// $response = $client->request('GET', 'client');
// echo $response->getStatusCode(); // 200
// echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
// echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
//-----------------------------------------------------------


//-----------------------------------------------------------
//ALT:
// require_once 'vendor/autoload.php';

// use GuzzleHttp\Client;

//     $client = new \GuzzleHttp\Client();
//     $response = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');

//     echo $response->getStatusCode(); // 200
//     echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
//     echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
//-----------------------------------------------------------


//-----------------------------------------------------------
//W3 ALT:
//GUZZLE - GET REQUEST
// require_once "vendor/autoload.php";

// use GuzzleHttp\Client;

// $client = new Client([
//     // Base URI is used with relative requests
//     'base_uri' => 'https://reqres.in',
// ]);

// $response = $client->request('GET', '/api/users', [
//     'query' => [
//         'page' => '2',
//     ]
// ]);

// //get status code using $response->getStatusCode();

// $body = $response->getBody();
// $arr_body = json_decode($body);
// print_r($arr_body);
//-----------------------------------------------------------

//-----------------------------------------------------------
//W3 ALT:
//GUZZLE - POST REQUEST
// require_once "vendor/autoload.php";

// use GuzzleHttp\Client;

// echo __DIR__ . PHP_EOL;
// $client = new Client([
//     // Base URI is used with relative requests
//     'base_uri' => 'https://reqres.in',
// ]);

// $response = $client->request('POST', '/api/users', [
//     'json' => [
//         'name' => 'Sam',
//         'job' => 'Developer'
//     ]
// ]);

// //get status code using $response->getStatusCode();

// $body = $response->getBody();
// $arr_body = json_decode($body);
// print_r($arr_body);
//-----------------------------------------------------------
