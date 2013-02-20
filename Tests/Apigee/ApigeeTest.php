<?php

namespace Jnonon\Tools\Apigee\Test;

use Jnonon\Tools\Apigee\Client\ApiGenerator;

class OpenCalaisApiClientTest extends \PHPUnit_Framework_TestCase
{
    protected $apiName = 'TraktApi';

    protected $endpoint = array('resources' =>
                       array(
                           array('method' =>
                               array (
                                      'id' => 'important-method',
                                      'doc' => array (
                                                  'title' => '',
                                                  'apigee:url' => 'http://test.com/test',
                                               ),
                                       'params' => array (array ('name' => 'important', 'type' => 'string'),
                                                           array ('name' => 'not-important', 'type' => 'string')
                                                          )
                                       )
                               ),
                           array('method' =>
                               array (
                                      'id' => 'not-important-method',
                                      'doc' => array (
                                                  'content' => 'This is an important parameter',
                                                  'title' => '',
                                                  'apigee:url' => 'http://test.com/test',
                                               ),
                                       'params' => array (array ('name' => 'important', 'type' => 'string'),
                                                           array ('name' => 'not-important2', 'type' => 'string')
                                                          )
                                       )
                               )
                           )
                );

    public function testPropertyImportance()
    {

        $apigee = new ApiGenerator($this->apiName);

        $this->assertEquals($apigee->getApiName(), $this->apiName);

        //End point fixture



        $apiInfo = $apigee->getInformationfromEndpoint($this->endpoint);
        $parameterImportance = $apigee->getParametersImportance();

        $method = $apigee->getMethod(ApiGenerator::stringToCamel('not-important-method'));

        $this->assertInstanceOf('Jnonon\\Tools\\Apigee\\Client\\ApiMethod', $method);

        $this->assertTrue(count($parameterImportance) == 3);

        $relevant = $apigee->getImportance('important');
        $notRelevant = $apigee->getImportance('notImportant');
        //2/3
        $this->assertTrue($relevant > 0.66, "Parameter importance is less than expected: ".$relevant);
        $this->assertTrue( $notRelevant < 0.66, "Parameter importance is bigger than expected: ".$notRelevant);

    }

    /**
     * Tests when try to write to a path when file already exists
     * @expectedException Exception
     */
    public function testWriteBeforeGenerates()
    {

        $url = 'https://apigee.com/v1/consoles/IdoNotExist/apidescription?format=internal';

        $apigee = new ApiGenerator('DoNotExistsAPI');

        $apigee->write('.');

    }



    /**
     * Tests for invalid APIs urls
     * @expectedException Exception
     */
    public function testInvalidUrl()
    {

        $url = 'https://apigee.com/v1/consoles/IdoNotExist/apidescription?format=internal';

        $apigee = new ApiGenerator('DoNotExistsAPI');

        $apigee->setApigeeSourceUrl($url);

        $endpoints = $apigee->getEndpoints();

    }

    /**
     * Tests for existing file
     * @expectedException Exception
     */
    public function testOveridingExistingFile()
    {

        $apigee = new ApiGenerator('DoNotExistsAPI');

        $apigee->generateClassForEndpoint($this->endpoint)->write(sys_get_temp_dir(), true);
        $apigee->generateClassForEndpoint($this->endpoint)->write(sys_get_temp_dir(), false);

    }


    /**
     * Tests for empty endpoints
     */
    public function testEmptyEndpoints()
    {
        //$url = 'https://apigee.com/v1/consoles/IdoNotExist/apidescription?format=internal';

        $apigee = new ApiGenerator('DoNotExistsAPI');

        $apiInfo = $apigee->getInformationfromEndpoint(array('resources' => array()));

        $this->assertTrue(is_array($apiInfo));
        $this->assertTrue(empty($apiInfo[0]));
        $this->assertTrue(empty($apiInfo[1]));


    }

    /**
     * Tests for description of an API
     */
    public function testGetApiDescription()
    {
        //$url = 'https://apigee.com/v1/consoles/reddit/apidescription?format=internal';

        $url = 'https://apigee.com/v1/consoles/morbo/apidescription?format=internal';

        $apigee = new ApiGenerator('RedditApi');

        $apigee->setApigeeSourceUrl($url);

        $endpoints = $apigee->getEndpoints();

        $apigee->generateClassForEndpoint($endpoints[0])->write(sys_get_temp_dir(), true);

    }

}
