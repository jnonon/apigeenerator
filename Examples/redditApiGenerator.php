<?php

include_once __DIR__.'/../vendor/autoload.php';

use Jnonon\Tools\Apigee\Client\ApiGenerator;

$url = 'https://apigee.com/v1/consoles/reddit/apidescription?format=internal';

$apigee = new ApiGenerator('RedditApi');

$apigee->setApigeeSourceUrl($url);

$endpoints = $apigee->getEndpoints();

//Write to a path, overriding if exists
//$apigee->generateClassForEndpoint($endpoints[0])->write('/desirable/path', true);

echo $apigee->generateClassForEndpoint($endpoints[0])->toString();

