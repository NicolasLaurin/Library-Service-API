<?php

require_once 'vendor/autoload.php';

use \Firebase\JWT\JWT;

$tokenId = base64_encode(random_bytes(16));
$secretKey = '1Ro4Q43SaqzyQLm7kV/7mtaxObLA8QSvvqFz16SGbew='; //'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew='
$issuedAt = new DateTimeImmutable();
$expire = $issuedAt->modify('+5 minutes')->getTimestamp();
$serverName = "localhost";
$username = "Nicolas Laurin";
$password = 'passwordNumber4';

$data = [
  'iat'  => $issuedAt->getTimestamp(),
  'jti'  => $tokenId,
  'iss'  => $serverName,
  'nbf'  => $issuedAt->getTimestamp(),
  'exp'  => $expire,
  'data' => ['userName' => $username, 'passWord' => $password]
];

$json_web_token = JWT::encode($data, $secretKey, 'HS512');

echo $json_web_token;
return $json_web_token;
