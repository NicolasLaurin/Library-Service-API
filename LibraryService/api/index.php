<?php

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *   title="Library Service",
 *   description="A web service for managing the books of a library.",
 *   version="1.0.0",
 *   @OA\Contact(
 *     name="Nicolas Laurin",
 *     email="nicolas1231.laurin@gmail.com"
 *   )
 * )
 */
require '../vendor/autoload.php';
require_once("./Request.php");
require_once("./Response.php");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

if ($_SERVER['REQUEST_METHOD'] != 'GET' && $_SERVER['REQUEST_METHOD'] != 'POST' && $_SERVER['REQUEST_METHOD'] != 'PUT' && $_SERVER['REQUEST_METHOD'] != 'DELETE') {
	http_response_code(405);
	return;
}

// $method = $_SERVER['REQUEST_METHOD'];
// // echo '$method: ' . $method;

// $accept = $_SERVER['HTTP_ACCEPT'];
// // echo '$accept: ' . $accept;

// $request_uri = $_SERVER['REQUEST_URI'];
// //echo $request_uri;

// $tables = ['clients', 'videoconversions'];
// $url = rtrim($request_uri, '/');
// $url = filter_var($request_uri, FILTER_SANITIZE_URL);
// $url = explode('/', $url);
// //print_r($url);
// $tableName = (string) $url[3];
// //print_r($tableName);
// if ($tableName == '') {
// 	ini_set('display_errors', 'off');
// 	if ($url[4] != null) {
// 		$id = (int) $url[4];
// 	} else {
// 		$id = null;
// 	}
// 	// echo '$id: ' . $id;
// 	ini_set('display_errors', 'on');
// }

// NOTE-4:
// We register our custom autoload function as a callback to be called when PHP is loading dependencies
// or required files.
spl_autoload_register('autoload');

function autoload($classname)
{
	if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
		require_once('../controllers/' . $classname . '.php');
		return true;
	}
	return false;
}

// Testing the Request class.
$request = new Request();
$request->accept = "application/json"; //Requesting a response in JSON format.

$response = new Response();
// echo "request method: " . $request->verb . "<br/>";
// var_dump($request->url_parameters);

//----------------------------------------------------------------------------------------------------------------
// NOTE-3:
// Given a URL with a parameter "client=123",
// we need to determine that this request is asking for the client with ID 123
// We need to implement a general way that allows us to load the appropriate controller
// depending on the URL parameter.
// Check NOTE-4.

//Get the target resource controller name
$keys = array_keys($request->url_parameters);
$ids = array_values($request->url_parameters);
// var_dump($request->url_parameters);
// var_dump($keys);
// var_dump($values);
// $keys[0] in this case is 'client'
// We will capitalize the first letter.
$controllerName = ucfirst($keys[0]) . 'Controller'; //This becomes 'ClientController'
// echo $controllerName;

// Check whether the class $controllerName exists.
// class_exists takes a second parameter $autoload of type boolean, and is true by default,
// therefore the $controllerName is passed as parameter $classname in autoload($classname).
if (class_exists($controllerName)) {
	$controller = new $controllerName();

	if ($controllerName == 'BooksController') {
		$authController = new AuthController();
		if (empty($_SERVER['HTTP_AUTHORIZATION']) || $authController->validateToken($_SERVER['HTTP_AUTHORIZATION']) == null) {
			http_response_code(401);
			$response->statusCode = '401 Unauthorized';
			return;
		}

		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			if ($ids[0] == null) {
				if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
					if (empty($controller->getAllBooks())) {
						http_response_code(404);
						$response->statusCode = '404 Not Found';
						return;
					} else if ($controller->getAllBooks() != false) {
						http_response_code(200);
						$response->statusCode = '200 OK';
						$response->payload = $controller->getAllBooks();
						$response->payload = json_encode($response->payload);
					} else {
						http_response_code(500);
						$response->statusCode = '500 Internal Server Error';
						return;
					}
				}
			} else if ($ids[0] != null && is_numeric($ids[0])) {
				if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
					if (empty($controller->getBookByISBN($ids[0]))) {
						http_response_code(404);
						$response->statusCode = '404 Not Found';
						return;
					} else if ($controller->getBookByISBN($ids[0]) != false) {
						http_response_code(200);
						$response->statusCode = '200 OK';
						$response->payload = $controller->getBookByISBN($ids[0]);
						$response->payload = json_encode($response->payload);
					} else {
						http_response_code(500);
						$response->statusCode = '500 Internal Server Error';
						return;
					}
				}
			}
		} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($_SERVER['HTTP_ACCEPT'] == 'application/json') { // && $_SERVER['HTTP_CONTENT_TYPE'] == 'application/json'
				// if ($controller->addBook(json_decode($request->payload, true)) == 'Invalid payload') {
				// 	http_response_code(400);
				// 	$response->statusCode = '400 Bad Request';
				// 	$response->payload = '[Placeholder]';
				// } else if ($controller->addBook(json_decode($request->payload, true))->errorInfo[1] == '1062') { // If duplicate entry
				// 	http_response_code(500);
				// 	$response->statusCode = '500 Internal Server Error';
				// 	$response->payload = json_encode($controller->addBook(json_decode($request->payload, true)));
				// }
				// if ($controller->addBook(json_decode($request->payload, true)) == true) {
				if ($ids[0] != null) {
					http_response_code(400);
					$response->statusCode = '400 Bad Request';
					return;
				} else if ($ids[0] == null) {
					if ($controller->addBook(json_decode($request->payload, true))) {
						http_response_code(201);
						$response->statusCode = '201 Created';
						$response->payload = json_encode($controller->getBookByISBN(json_decode($request->payload, true)['ISBN']));
					} else if (!$controller->validatePOSTRequestPayload(json_decode($request->payload, true))) {
						http_response_code(400);
						$response->statusCode = '400 Bad Request';
						return;
					} else {
						http_response_code(500);
						$response->statusCode = '500 Internal Server Error';
						return;
					}
				}
				// }
			}
		} else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
			if ($ids[0] == null || empty($request->payload) || $request->payload == null) {
				http_response_code(400);
				$response->statusCode = '400 Bad Request';
				return;
			} else if ($ids[0] != null && is_numeric($ids[0])) {
				if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
					if ($controller->updateBook($ids[0], json_decode($request->payload, true))) {
						http_response_code(200);
						$response->statusCode = '200 OK';
						$response->payload = json_encode($controller->getBookByISBN($ids[0]));
						if ($response->payload == 'false') {
							http_response_code(409);
							$response->statusCode = '409 Conflict';
							return;
						}
					} else if (!$controller->validatePUTRequestPayload(json_decode($request->payload, true))) {
						http_response_code(400);
						$response->statusCode = '400 Bad Request';
						return;
					} else {
						http_response_code(500);
						$response->statusCode = '500 Internal Server Error';
						return;
					}
				}
			}
		} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
			if ($ids[0] == null || !is_numeric($ids[0])) {
				http_response_code(400);
				$response->statusCode = '400 Bad Request';
				return;
			} else if ($ids[0] != null && is_numeric($ids[0])) {
				if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
					if ($controller->deleteBook($ids[0])) {
						http_response_code(204);
						$response->statusCode = '204 No Content';
						return;
					} else if ($controller->getBookByISBN($ids[0]) == null) {
						http_response_code(404);
						$response->statusCode = '404 Not Found';
						return;
					} else {
						http_response_code(500);
						$response->statusCode = '500 Internal Server Error';
						return;
					}
				}
			}
		}
	} else if ($controllerName == 'AuthController') {
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			if ($ids[0] == null) {
				http_response_code(400);
				$response->statusCode = "400 Bad Request";
				return;
			} else if ($ids[0] != null) { //if the licenseKey is provided
				if ($controller->getClientByLicenseKey($ids[0]) != false) { //If client exists
					$token = $controller->generateToken($ids[0]);
					$response->authenticate = "WWW-Authenticate: Bearer {$token}";
					header($response->authenticate);
					http_response_code(204);
					$response->statusCode = "204 No Content";
					return;
				} else {
					http_response_code(400);
					$response->statusCode = "400 Bad Request";
					return;
				}
			}
		}
	} else if ($controllerName == 'ClientsController') {
		$authController = new AuthController();
		if (empty($_SERVER['HTTP_AUTHORIZATION']) || $authController->validateToken($_SERVER['HTTP_AUTHORIZATION']) == null) {
			http_response_code(401);
			$response->statusCode = '401 Unauthorized';
			return;
		}

		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			if ($ids[0] == null) {
				if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
					if (empty($controller->getAllClients())) {
						http_response_code(404);
						$response->statusCode = '404 Not Found';
						return;
					} else if ($controller->getAllClients() != false) {
						http_response_code(200);
						$response->statusCode = '200 OK';
						$response->payload = $controller->getAllClients();
						$response->payload = json_encode($response->payload);
					} else {
						http_response_code(500);
						$response->statusCode = '500 Internal Server Error';
						return;
					}
				}
			} else if ($ids[0] != null && is_numeric($ids[0])) {
				if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
					if (empty($controller->getClientByID($ids[0]))) {
						http_response_code(404);
						$response->statusCode = '404 Not Found';
						return;
					} else if ($controller->getClientByID($ids[0]) != false) {
						http_response_code(200);
						$response->statusCode = '200 OK';
						$response->payload = $controller->getClientByID($ids[0]);
						$response->payload = json_encode($response->payload);
					} else {
						http_response_code(500);
						$response->statusCode = '500 Internal Server Error';
						return;
					}
				}
			}
		}
	}
	// else if ($controllerName == 'VideoconversionController') {
	// 	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	// 		if ($ids[0] == null) {
	// 			if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
	// 				$response->payload = $controller->getAllConversions();
	// 				$response->payload = json_encode($response->payload);
	// 			}
	// 		}
	// 	} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// 		if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
	// 			if ($controller->createVideoConversion(json_decode($request->payload, true))) { // Take parameters in order: originalFormat, targetFormat, file, licenseKey
	// 				$response->payload = array();
	// 				$response->statusCode = "201 Created";
	// 				array_push($response->payload, $response->statusCode);
	// 				$conversionResult = $controller->performConversion();
	// 				if ($conversionResult != null) {
	// 					echo "CONVERSION RESULT: " . $conversionResult . "\n\n\n\n";
	// 					$response->output_file = $controller->getLast()['output_file'];
	// 				} else
	// 					$response->output_file = 'none';
	// 				array_push($response->payload, $response->output_file);
	// 				$response->payload = json_encode($response->payload);
	// 			}
	// 		}
	// 	}
	// }

	//var_dump(json_decode($request->payload));

	// echo "\nRequest Payload:\n";
	// var_dump($request->payload);
	// echo "\n\n\n\nResponse Payload:\n";
	// var_dump($response->payload);

	// echo "Reponse Payload:\n";
	var_dump($response->payload);
}
//----------------------------------------------------------------------------------------------------------------