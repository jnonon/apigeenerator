<?php

namespace Jnonon\Tools\Apigee\Test;

use Jnonon\Tools\Apigee\Client\ApiGenerator;

class OpenCalaisApiClientTest extends \PHPUnit_Framework_TestCase
{

    public function testPropertyImportance()
    {

        $apigee = new ApiGenerator('TraktApi');

        //$apigee->setApigeeSourceUrl($url);

        //$endpoints = $apigee->getEndpoints();
        //
        //var_export($endpoints[0]); die();

        //$class = $apigee->generateClassForEndpoint($endpoints[0]);
        //Enpoint should be an object :-/
        $endpoint = array('resources' =>
                       array(
                           array('method' =>
                               array (
                                      'id' => 'important-method',
                                      'doc' => array (
                                                  'content' => 'This is an important parameter',
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


        $apiInfo = $apigee->getInformationfromEndpoint($endpoint);

        $relevant = $apigee->getImportance('important');
        $notRelevant = $apigee->getImportance('notImportant');
        //2/3
        $this->assertTrue($relevant > 0.66, "Parameter importance is less than expected: ".$relevant);
        $this->assertTrue( $notRelevant < 0.66, "Parameter importance is bigger than expected: ".$notRelevant);

    }

    /**
     * Tests for description of an API
     *
    public function testGetApiDescription()
    {
        //$url = 'https://apigee.com/v1/consoles/reddit/apidescription?format=internal';

        $url = 'https://apigee.com/v1/consoles/morbo/apidescription?format=internal';

        $apigee = new ApiGenerator('RedditApi');

        $apigee->setApigeeSourceUrl($url);

        $endpoints = $apigee->getEndpoints();

        $class = $apigee->generateClassForEndpoint($endpoints[0]);

        echo $class;


    }
*/

}
