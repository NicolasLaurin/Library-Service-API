<?php
	// A- Reading data as a stream
	$fopen = fopen("http://localhost/VideoConversionService/api/client/all", "r");
	//$fopen = fopen("http://10.1.3.150/VideoConversionService/api/client/all", "r"); //Alternative
	// NOTE: Defining the IP allows us to get data from a different machine as long as their server is enabled

	$data = stream_get_contents($fopen, -1, 0);

	echo $data;
?>