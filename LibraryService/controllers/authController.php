<?php
require_once("../model/clients.php");

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class AuthController
{
  public $tokenId;
  public $secretKey;
  public $issuedAt;
  public $expire;
  public $serverName;
  public $subject;

  function __construct()
  {
    require_once '../vendor/autoload.php';

    $this->tokenId = base64_encode(random_bytes(16));
    $this->secretKey = '1Ro4Q43SaqzyQLm7kV/7mtaxObLA8QSvvqFz16SGbew='; //'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew='
    $this->issuedAt = new DateTimeImmutable();
    $this->expire = $this->issuedAt->modify('+4 weeks')->getTimestamp();
    $this->serverName = "localhost";
    $this->subject = null;
  }

  function getClientByLicenseKey($licenseKey)
  {
    $clients = new Clients();
    return $clients->getClientByLicenseKey($licenseKey);
  }

  function generateToken($licenseKey)
  {
    $this->subject = $licenseKey;

    $token = [
      'iat'  => $this->issuedAt->getTimestamp(),
      'jti'  => $this->tokenId,
      'iss'  => $this->serverName,
      'nbf'  => $this->issuedAt->getTimestamp(),
      'exp'  => $this->expire,
      'sub'  => $this->subject
    ];

    $json_web_token = JWT::encode($token, $this->secretKey, 'HS512');

    return $json_web_token;
  }

  function validateToken($token)
  {
    try {
      $decoded_JWT = JWT::decode($token, new Key($this->secretKey, 'HS512'));
    } catch (Exception $e) {
      echo $e;
      return null;
    }
    $decoded_JWT_array = (array) $decoded_JWT;
    return $decoded_JWT_array;
  }
}
