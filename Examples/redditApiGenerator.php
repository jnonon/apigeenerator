<?php

require __DIR__.'/../vendor/autoload.php';

use Jnonon\Tools\ApiGeenerator\Client\ApiGeenerator;

$apigee = new ApiGeenerator('reddit', 'RedditApi');
$endpoints = $apigee->getEndpoints();

//Write to a path, overriding if exists
//$apigee->generateClassForEndpoint($endpoints[0])->write('/desirable/path', true);

echo $apigee->generateClassForEndpoint($endpoints[0])->toString();
