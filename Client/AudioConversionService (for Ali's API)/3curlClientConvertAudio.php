<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/WebServicesFinal/audioconversionservice/api/conversion/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "licenseKey": "123ABC",
  "originalFormat": ".mp3",
  "targetFormat": ".wav",
  "file": "C:\\\\xampp\\\\htdocs\\\\WebServicesFinal\\\\Media\\\\AudioFile.mp3",
  "startingTime" => "10",
  "duration" => "30"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: ',
    'Content-Type: text/plain'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;