<?php
require_once 'vendor/autoload.php';

$bucket = 'test-bucket12311231';
$key = 'NicolasLaurin/VideoFile.avi';
$SaveAS = "C:/xampp/htdocs/Client/SavedFiles/VideoFile.avi";

try {
  $sharedConfig = [
    'region' => 'us-east-1',
    'version' => 'latest',
    'credentials' => [
      'key'    => "AKIAX3Z33PMZ2BRUBTOT",
      'secret' => "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",
    ]
  ];

  // Create an SDK class used to share configuration across clients.
  $sdk = new Aws\Sdk($sharedConfig);

  // Use an Aws\Sdk class to create the S3Client object.
  $s3Client = $sdk->createS3();

  // Save object to a file.
  $request = $s3Client->getObject(array(
    'Bucket' => $bucket,
    'Key' => $key,
    'SaveAs' => $SaveAS
  ));
  //Get a command to GetObject
  $cmd = $s3Client->getCommand('GetObject', [
    'Bucket' => $bucket,
    'Key' => $key
  ]);
  $result = $s3Client->createPresignedRequest($cmd, '+1 minutes');

  // Get the pre-signed URL
  $signedUrl = (string) $result->getUri();

  echo '<a href="'.$signedUrl.'">'.$signedUrl.'</a>';
  header('Content-Type: application/octet-stream');
  header("Content-Transfer-Encoding: Binary");
  header("Content-disposition: attachment; filename=\"" . basename($signedUrl) . "\"");
  readfile($signedUrl);
  // echo "<video width=\"320\" height=\"240\" controls><source src=\"$signedUrl\" type='video/mp4'></video>";
  // echo "<video width='320' height='240' controls><source src=\"{$signedUrl}\" type='video/mp4'>Your browser does not support the video tag.</video>";
} catch (Aws\S3\Exception\S3Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
