<?php
	require 'vendor/autoload.php';
	
	use Aws\S3\S3Client;
	use Aws\Exception\AwsException;

	$key = 'AKIAX3Z33PMZ2BRUBTOT';
	$secret = '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';
	$credentials = new Aws\Credentials\Credentials($key, $secret);
	// The same options that can be provided to a specific client constructor can also be supplied to the Aws\Sdk class.
	// Use the us-west-2 region and latest version of each client.
	$sharedConfig = [
		'region' => 'us-east-1',
		'version' => 'latest',
		'credentials' => $credentials
	];

	// Create an SDK class used to share configuration across clients.
	$sdk = new Aws\Sdk($sharedConfig);

	// Create an Amazon S3 client using the shared configuration data.
	$client = $sdk->createS3();

	// Send a PutObject request and get the result object.
	$result = $s3Client->putObject([
		'Bucket' => 'test-bucket12311231',
		'Key' => 'uploads',
		'Body' => 'This is the body!'
	]);

	// // Download the contents of the object.
	// $result = $s3Client->getObject([
	// 	'Bucket' => 'test-bucket12311231',
	// 	'Key' => 'uploads'
	// ]);

	// Print the body of the result by indexing into the result object.
	echo $result;

//--------------------------------------------------------------
	// use Aws\S3\S3Client;
	// use Aws\Exception\AwsException;
	
	// //Create a S3Client
	// $s3 = new Aws\S3\S3Client([
	// 	'version' => 'latest',
	// 	'region' =>'us-east-1'
	// ]);
	
//--------------------------------------------------------	
/* 	// The same options that can be provided to a specific client constructor can also be supplied to the Aws\Sdk class.
	// Use the us-west-2 region and latest version of each client.
	$sharedConfig = [
		'region' => 'us-west-2',
		'version' => 'latest'
	];

	// Create an SDK class used to share configuration across clients.
	$sdk = new Aws\Sdk($sharedConfig);

	// Create an Amazon S3 client using the shared configuration data.
	$client = $sdk->createS3(); */

//--------------------------------------------------------
	/* $sdk = new Aws\Sdk([
		'region'   => 'us-west-2',
		'version'  => 'latest',
		'DynamoDb' => [
			'region' => 'eu-central-1'
		]
	]);

	// Creating an Amazon DynamoDb client will use the "eu-central-1" AWS Region
	$client = $sdk->createDynamoDb(); */
//--------------------------------------------------------	

?>