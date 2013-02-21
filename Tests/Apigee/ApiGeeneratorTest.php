<?php

namespace Jnonon\Tools\ApiGeenerator\Test;

use Jnonon\Tools\ApiGeenerator\Client\ApiGeenerator;

class ApiGeeneratorTest extends \PHPUnit_Framework_TestCase
{
    protected $apiName = 'TraktApi';

    protected $providerApi = 'morbo';

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
                           ),
                          'base' => 'this.url.base/'
                   );
    /**
     * Tests property importance desition
     */
    public function testPropertyImportance()
    {

        $apigee = new ApiGeenerator($this->providerApi, $this->apiName);

        $this->assertEquals($apigee->getApiName(), $this->apiName);

        //End point fixture

        $apigee->getInformationfromEndpoint($this->endpoint);
        $parameterImportance = $apigee->getParametersImportance();

        $method = $apigee->getMethod(ApiGeenerator::stringToCamel('not-important-method'));

        $this->assertInstanceOf('Jnonon\\Tools\\ApiGeenerator\\Client\\ApiMethod', $method);

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

        $apigee = new ApiGeenerator('DoNotExistsAPI');

        $apigee->write('.');

    }

    /**
     * Tests when try to return a generated class without data
     * @expectedException Exception
     */
    public function testToStringBeforeGenerates()
    {

        $apigee = new ApiGeenerator('DoNotExistsAPI');

        $apigee->toString('.');

    }

    /**
     * Tests for invalid APIs urls
     * @expectedException Exception
     */
    public function testInvalidUrl()
    {

        $url = 'https://apigee.com/v1/consoles/IdoNotExist/apidescription?format=internal';

        $apigee = new ApiGeenerator('DoNotExistsAPI');

        $apigee->setApigeeSourceUrl($url);

        $apigee->getEndpoints();

    }

    /**
     * Tests for existing file
     * @expectedException Exception
     */
    public function testOveridingExistingFile()
    {

        $apigee = new ApiGeenerator('DoNotExistsAPI');

        $apigee->generateClassForEndpoint($this->endpoint)->write(sys_get_temp_dir(), true);
        $apigee->generateClassForEndpoint($this->endpoint)->write(sys_get_temp_dir(), false);

    }

    /**
     * Tests for non writable path
     * @expectedException Exception
     */
    public function testWritingToNonWritablePath()
    {

        $apigee = new ApiGeenerator('DoNotExistsAPI');

        $apigee->generateClassForEndpoint($this->endpoint)->write('/home', false);

    }

    /**
     * Tests for undefined base url
     * @expectedException Exception
     */
    public function testEndpointWithoutBaseurl()
    {

        $apigee = new ApiGeenerator('DoNotExistsAPI');
        $apigee->getInformationfromEndpoint(array('resources' => array()));

    }

    /**
     * Tests for empty endpoints
     */
    public function testEmptyEndpoints()
    {
        $className = 'DoNotExistsAPI';
        $baseUrl = 'http:\\\\base.url.com';
        $namespace = "This\Is\A\NameSpace";

        $apigee = new ApiGeenerator($className);
        $apigee->setNamespace($namespace);

        $apiInfo = $apigee->getInformationfromEndpoint(array('resources' => array(), 'base' => $baseUrl));

        $methods = $apiInfo->getMethods();
        $properties = $apiInfo->getProperties();

        $this->assertTrue(empty($methods), 'Methods are not empty');
        $this->assertTrue(empty($properties), 'Properties are not empty');
        $this->assertEquals($apiInfo->getBaseUrl(), $baseUrl);
        $this->assertEquals($apiInfo->getClassName(), $className);
        $this->assertEquals($apiInfo->getNamespace(), $namespace);

    }

    /**
     * Tests if the class have been generated correctly
     */
    public function testClassIsGeneratedCorrectly()
    {
        $apigee = new ApiGeenerator('reddit', 'RedditAwesomeApi');

        $endpoints = $apigee->getEndpoints();

        $path = $apigee->generateClassForEndpoint($endpoints[0])->write(sys_get_temp_dir(), true);

        //File is created
        $this->assertTrue(file_exists($path));

        //Test that an string can be returned
        $this->assertTrue(is_string($apigee->toString()));

        //Test that the generated file is correct
        $commandReturnValue = null;
        $output = array();

        //Test syntax errors, may be moved to another method
        exec('php -l '.$path, $output, $commandReturnValue);

        $this->assertEquals($commandReturnValue, 0);

    }

}
