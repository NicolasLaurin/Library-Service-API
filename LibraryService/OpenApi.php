<?php
require("vendor/autoload.php");

$openApi = \OpenApi\Generator::scan(['C:\xampp\htdocs\LibraryService']);

header('Content-Type: application/x-yaml');
echo $openApi->toYaml();
