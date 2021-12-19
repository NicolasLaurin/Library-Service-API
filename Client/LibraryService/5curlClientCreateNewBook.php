<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/LibraryService/api/books/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
     "ISBN": "9780547928227",
     "book_name": "The Hobbit",
     "author_name": "J. R. R. Tolkien",
     "category_name": "Epic Fantasy",
     "book_type": "Paperback",
     "num_of_pages": "300"
}',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE2Mzk5MzE3NTUsImp0aSI6ImFDTFlqaDMyemN6VEZXbVNLYUs3M1E9PSIsImlzcyI6ImxvY2FsaG9zdCIsIm5iZiI6MTYzOTkzMTc1NSwiZXhwIjoxNjQyMzUwOTU1LCJzdWIiOiJLRVlBQkMxMjMifQ.fw9ulpB0PBa-k-msG7OkdZJ9MRKi1zfoK1ovDFcbRG_GYCvOmQnIYVfDGlHFJvp4ZBr-Ql0uOEI_wTL6uxhZVw'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;