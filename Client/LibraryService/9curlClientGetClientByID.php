<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/LibraryService/api/clients/1',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE2Mzk5MzE3NTUsImp0aSI6ImFDTFlqaDMyemN6VEZXbVNLYUs3M1E9PSIsImlzcyI6ImxvY2FsaG9zdCIsIm5iZiI6MTYzOTkzMTc1NSwiZXhwIjoxNjQyMzUwOTU1LCJzdWIiOiJLRVlBQkMxMjMifQ.fw9ulpB0PBa-k-msG7OkdZJ9MRKi1zfoK1ovDFcbRG_GYCvOmQnIYVfDGlHFJvp4ZBr-Ql0uOEI_wTL6uxhZVw'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;