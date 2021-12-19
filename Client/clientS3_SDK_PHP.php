<!-- <?php
      require_once 'vendor/autoload.php';

      use Aws\S3;


      $uploadFile = dirname(__FILE__) . '/S3.php';
      echo $uploadFile;

      S3::putObject(S3::inputResource(fopen($file, 'rb'), filesize($file)), $bucketName, $uploadName, S3::ACL_PUBLIC_READ);


// public function getFromBucket2($awsAccessKey = 'AKIAX3Z33PMZ2BRUBTOT',
// $awsSecretKey = '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',
// 	)
// 	{
// 	} -->