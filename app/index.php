<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;


$s3 = new S3Client([
    'credentials' => false,
    'version' => '2006-03-01',
    'region' => 'us-east-1',
    // Enable 'use_path_style_endpoint' => true, if bucket name is non DNS compliant
    'use_path_style_endpoint' => true,
    'endpoint' => 'http://localstack:4566',
]);

// Configuration Variables
$bucketName = 'bucket1';
$body = "Hello from localstack";
$key = 'key';

// Create Bucket

$result = $s3->createBucket([
    'Bucket' => $bucketName,
]);


//Listing all S3 Bucket
$buckets = $s3->listBuckets();
foreach ($buckets['Buckets'] as $bucket) {
    echo "Backet: ".$bucket['Name'] . "\n";
}

$result = $s3->putObject([
    'Bucket' => $bucketName,
    'Key' => $key,
    'Body' => $body,
]);
$result = $s3->getObject([
    'Bucket' => $bucketName,
    'Key' => $key
]);

// Print the body of the result by indexing into the result object.
echo $result['Body'];
//echo "<pre>";
//print_r($result);
//echo "<pre>";

