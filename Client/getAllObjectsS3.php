<?php

require_once 'vendor/autoload.php';
$bucketName = 'cnkbucket'; #test-bucket12311231

// use Aws\S3\S3Client;
// use Aws\S3\Exception\S3Exception;

// Instantiate the client.
$s3 = new Aws\S3\S3Client([
  'version' => 'latest',
  'region'  => 'us-east-1',
  'credentials' => [
    'key'    => "AKIAUTZKO3SN4LKU5QSM", #AKIAX3Z33PMZ2BRUBTOT
    'secret' => "aCE8V/BPFAu2m4YEU2OlWtDyKk/c8QzXPal3vWk+", #c6Ju6KHJCNdQx+tou84dTOh7E1PMqHNf1OXc+lE+
  ]
]);

// Use the high-level iterators (returns ALL of your objects).
try {
  $results = $s3->getPaginator('ListObjects', [
    'Bucket' => $bucketName
  ]);

  foreach ($results as $result) {
    foreach ($result['Contents'] as $object) {
      echo $object['Key'] . PHP_EOL;
      var_dump($object);
    }
  }
} catch (Aws\S3\Exception\S3Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
