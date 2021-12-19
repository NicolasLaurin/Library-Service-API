<?php
	require_once 'vendor/autoload.php';

	$bucketName = 'cnkbucket'; #test-bucket12311231
	$key = 'NicolasLaurin/VideoFile.avi';
	$file = 'C:/xampp/htdocs/Client/SavedFiles/VideoFile.avi';

	$s3 = new Aws\S3\S3Client([
		'region'  => 'us-east-1',
		'version' => 'latest',
		'credentials' => [
			'key'    => 'AKIAUTZKO3SN4LKU5QSM', #AKIAX3Z33PMZ2BRUBTOT
			'secret' => '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', #c6Ju6KHJCNdQx+tou84dTOh7E1PMqHNf1OXc+lE+
		]
	]);

	try {
		$result = $s3->putObject([
			'Bucket' => $bucketName,
			'Key'    => $key,
			'Body' => fopen($file, 'r')
		]);
	} catch (Aws\S3\Exception\S3Exception $e) {
		echo $e;
		die("There was an error uploading the file.");
	}

	var_dump('SENT TO BUCKET: ' . $result);