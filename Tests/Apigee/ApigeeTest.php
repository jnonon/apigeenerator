<?php

namespace Jnonon\Tools\Apigee\Test;

use Jnonon\Tools\Apigee\Client\ApiGenerator;

class OpenCalaisApiClientTest extends \PHPUnit_Framework_TestCase
{

    public function testPropertyImportance()
    {

        $url = 'https://apigee.com/v1/consoles/morbo/apidescription?format=internal';

        $apigee = new ApiGenerator('TraktApi');

        $apigee->setApigeeSourceUrl($url);

        $endpoints = $apigee->getEndpoints();

        $apiInfo = $apigee->getInformationfromEndpoint($endpoints[0]);
        $paramertersImportance = $apigee->getParametersImportance();


    }

    /**
     * Tests for description of an API
     */
    public function testGetApiDescription()
    {
        $url = 'https://apigee.com/v1/consoles/reddit/apidescription?format=internal';

        $apigee = new ApiGenerator('RedditApi');

        $apigee->setApigeeSourceUrl($url);

        $endpoints = $apigee->getEndpoints();

        $class = $apigee->generateClassForEndpoint($endpoints[0]);

        echo $class;


    }






}
