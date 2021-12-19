<?php
class Request
{
	public $verb;
	public $url_parameters;
	public $payload;
	public $payload_format;
	public $accept;

	function __construct()
	{
		// NOTE-1:
		// Apache, the web server, stores requests information in the Global Variable
		// $_SERVER as an associative array.
		$this->verb = $_SERVER["REQUEST_METHOD"];

		// NOTE-2:
		// URL Parameters are passed as what we call a Query String.
		// It is the part after the page name separated by a question mark ?
		// e.g.: http://localhost/VideoConversionService/api/index.php?client=1&attributes=clientName
		$this->url_parameters = array();
		parse_str($_SERVER["QUERY_STRING"], $this->url_parameters);
		// parse_str takes the Query String and transforms it into an array.

		$this->payload = file_get_contents('php://input');
		// echo $this->payload;

		$this->accept = $_SERVER['HTTP_ACCEPT'];
	}
}//END REQUEST CLASS
