<?php

/**
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*
* @author Jonathan Nonon <jnonon@gmail.com>
*
**/
namespace Jnonon\Tools\Apigee\Client;

use Twig_Loader_Filesystem;

/**
 * Generates Skeleton PHP Apis from ApiGee
 *
*/
class ApiGenerator
{
    /**
     * Api description url
     *
     * @var string
     */
    protected $apigeeSourceUrl;

    /**
     * Desirable api name to use
     * @var string
     */
    protected $apiName;

    /**
     *
     * @var string default template
     */
    protected $template = 'apiClassTemplate.php.twig';
    /**
     * Determines the importance of a set of parameters in order to decide
     * when to create a property
     *
     * @var array $parametersImportance
     */

    protected $parametersImportance = array();

    /**
     * Total methods in current endpoint
     *
     * @var integer $totalMethods
     */
    protected $totalMethods = 0;

    /**
     * A list of all methods along with its details
     *
     * @var array $methods
     */
    protected $methods = array();

    /**
     * A list of all propertiess along with its details
     *
     * @var array $properties
     */

    protected $properties = array();


    /**
     * Constructor
     *
     * @param string $apiName Api name
     */
    public function __construct($apiName)
    {
        $this->apiName = $apiName;
    }
    /**
     * Sets the url where the target Api description lives
     *
     * @param string $apigeeSourceUrl Url
     */
    public function setApigeeSourceUrl($apigeeSourceUrl)
    {
        $this->apigeeSourceUrl = $apigeeSourceUrl;
    }
    /**
     * Gets Api Name
     *
     * @return string
     */
    public function getApiName()
    {
        return $this->apiName;
    }

    /**
     * Gets API Desctiption
     *
     * @return array
     */
    private  function getApiDescription()
    {

        $descriptionString = file_get_contents($this->apigeeSourceUrl);
        $apiDescription = json_decode($descriptionString, true); //as an array

        if (!is_array($apiDescription)) {
            throw new \Exception('Invalid Json Object');
        }

        return $apiDescription;
    }

    /**
     * Get all Api endpoints
     *
     * @return array
     */
    public function getEndpoints()
    {

        $apiDescription = $this->getApiDescription();

        return $apiDescription['application']['endpoints'];

    }

    /**
     * Resets all important variables
     */
    private function clean()
    {
        $this->totalMethods = 0;
        $this->methods = array();
        $this->properties = array();
        $this->parametersImportance = array();

    }
    /**
     * Get methods from an end point. This method clears $this->parametersImportance
     *
     * @param array $endPoint End point
     */
    private function extractMethods(array $endPoint)
    {

        $this->clean();

        foreach ($endPoint['resources'] as $resource) {
            //$requiredVarsInRequest = $this->parseString($resource['path']);
            $methodDetail = $resource['method'];
            $methodName = $this->snakeToCamel($methodDetail['id']);


            $this->methods[$methodName]['documentation']['description'] = html_entity_decode($methodDetail['doc']['content']);
            $this->methods[$methodName]['documentation']['reference'] = $methodDetail['doc']['apigee:url'];
            $this->methods[$methodName]['params'] = $methodDetail['params'];

            $this->buildParameterPriority($methodDetail['params']);

            $this->totalMethods++;

        }


        return $this->methods;
    }
    /**
     * Extracts properties from methods
     *
     * @return array
     */
    private function extractPropertiesFromMethods()
    {

        //Nothing to do
        if (empty($this->methods)) {
            return array();
        }

        foreach ($this->methods as $methodName => $methodDetail) {

            foreach ($methodDetail['params'] as $key => $parameter) {
                $propertyName = $parameter['name'];

                if ($this->isProperty($propertyName)) {

                    //Works under the asumption that same parameter names have the same description
                    if (!isset($this->properties[$propertyName])) {

                        $this->properties[$propertyName] = $methodDetail['params'][$key];
                    }

                    //Removes from current method
                    unset($this->methods[$methodName]['params'][$key]);

                }
            }
        }

        return $this->properties;

    }

    /**
     * Builds an importance array with method parameters repeated across the API
     *
     * @param array $parameters
     */
    private function buildParameterPriority($parameters)
    {
        foreach ($parameters as $parameter) {

            if (isset($this->parametersImportance[$parameter['name']])) {

                $this->parametersImportance[$parameter['name']] += 1;

            } else {

                $this->parametersImportance[$parameter['name']] = 1;

            }
        }
    }
    /**
     * Uses Laplace Smoothing to determine if a variable name can be used as a property
     * See http://en.wikipedia.org/wiki/Additive_smoothing
     *
     * @param string $paramName
     *
     * @return boolean
     *
     */
    private function isProperty($paramName)
    {

        $importanceThreshold = 0.45;

        return  ($this->getImportance($paramName) > $importanceThreshold);
    }

    /**
     * Gets the importance degree of a variable in the whole API
     *
     * @param string $paramName
     *
     * @return number
     */

    public function getImportance($paramName)
    {
        $k = 0.001;

        $variableTotalAperance = isset($this->parametersImportance[$paramName]) ? $this->parametersImportance[$paramName] : 0;
        $totalVariableCases = count($this->parametersImportance); //This count may be catched
        $totalAmountOfMethods = $this->totalMethods;

        return ($variableTotalAperance +$k)/($totalAmountOfMethods + $k*$totalVariableCases);

    }

    /**
     * Parses an string, looks for strings inside a {}
     *
     * @param string $string String
     *
     * @return array
     */
    private function parseString($string)
    {

        if (preg_match_all('/{([\w\d]+)}/U', $string, $matches)) {

            return $matches;
        }

        return array();
    }
    /**
     * Convert from snake format to camel case
     * See http://www.refreshinglyblue.com/2009/03/20/php-snake-case-to-camel-case/
     *
     * @param string $string String with snake style
     *
     * @return string
     */
    private function snakeToCamel($string)
    {
        $val = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        return $val;
    }

    /**
     * Gets methods and properties from an endpoint
     *
     * @param array $endpoint Endpoint
     * @return array:
     */
    public function getInformationfromEndpoint($endpoint)
    {
        $this->extractMethods($endpoint);
        $this->extractPropertiesFromMethods();

        return array($this->methods, $this->properties);

    }

    public function getParametersImportance()
    {
        return $this->parametersImportance;
    }
    /**
     * Gets skeleton class for an specific endpoint
     *
     * @param array $endpoint
     * @return string
     */
    public function generateClassForEndpoint($endpoint)
    {

        list($methods, $properties) = $this->getInformationfromEndpoint($endpoint);

        $loader = new Twig_Loader_Filesystem(__DIR__.'/../Resources/views/Templates');


        $twig = new \Twig_Environment($loader);

        return $twig->render($this->template, array('apiName' => $this->apiName,
                                                    'methods' => $methods,
                                                    'properties' => $properties));

    }

}
