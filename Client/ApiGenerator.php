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
     * Api description url, can be overwritten with setAapigeeSourceUrl
     *
     * @var string
     */
    protected $apigeeSourceUrl = "https://apigee.com/v1/consoles/[apiProvider]/apidescription?format=internal";

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
     * Generated class string
     *
     * @var string
     */
    protected $stubClass = '';
    /**
     * Namespace
     *
     * @var string
     */
    protected $namespace;

    /**
     * Base url for current endpoint
     *
     * @var string
     */
    protected $baseUrl = '';

    /**
     * Constructor
     * Initialize the url of an specific API, where the api description is
     *
     * @param string $apiProvider Provider name. For example, twitter, facebook
     * @param string $apiName     Overrides the default ApiName
     *
     */
    public function __construct($apiProvider, $apiName = '')
    {
        //Makes the class name a CamelCase version of the api provider
        if ($apiName == '') {
            $apiName =  self::stringToCamel($apiProvider);

        }

        $apiProvider = strtolower($apiProvider);

        $this->apiName = $apiName;
        $this->apigeeSourceUrl = str_replace('[apiProvider]', $apiProvider, $this->apigeeSourceUrl);

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
     * Sets a namespace
     * @param string $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Gets API Desctiption
     *
     * @return array
     */
    private function getApiDescription()
    {
        try {
            //Guzzle may be an over kill for this
            $descriptionString = file_get_contents($this->apigeeSourceUrl);

            $apiDescription = json_decode($descriptionString, true); //as an array

            return $apiDescription;

        } catch (\Exception $error) {

            throw new \Exception('An error occurred while puling data from ' .
                                 $this->apigeeSourceUrl.'. Original error: ' .
                                 $error->getMessage());
        }
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
        $this->stubClass = '';
        $this->baseUrl = '';

    }
    /**
     * Get methods from an end point. This method clears $this->parametersImportance
     *
     * @param array $endPoint End point
     */
    private function extractMethods(array $endPoint)
    {
        if (!isset($endPoint['base'])) {
            throw new \Exception('Api definition expects to have an base url');
        }

        $this->clean();

        foreach ($endPoint['resources'] as $resource) {

            $methodDetail = $resource['method'];

            $method = new ApiMethod($methodDetail);

            $this->methods[$method->getName()] = $method;
            $parameters = $method->getParameters();

            $this->buildParameterPriority($parameters);
            $this->totalMethods++;

        }

        $this->baseUrl = $endPoint['base'];

        return $this->methods;
    }
    /**
     * Gets a method from current endpoint
     *
     * @param string $methodName Method name
     *
     * @return ApiMethod
     */
    public function getMethod($methodName)
    {
        return (isset($this->methods[$methodName])) ? $this->methods[$methodName] : null;
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

            foreach ($methodDetail->getParameters() as $key => $parameter) {
                $parameterName = $parameter->getName();

                if ($this->isProperty($parameterName)) {

                    //Works under the asumption that same parameter names have the same description
                    if (!isset($this->properties[$parameterName])) {

                        $this->properties[$parameterName] = $parameter;
                    }
                    //Removes from current method
                    $methodDetail->removeParameter($parameterName);

                    //unset($this->methods[$methodName]['params'][$key]);

                }
            }
        }

        return $this->properties;

    }

    /**
     * Builds an importance array with method parameters repeated across the API
     *
     * @param array $parameters collection
     */
    private function buildParameterPriority($parameters)
    {

        foreach ($parameters as $parameter) {
            $parameterName = $parameter->getName();

            if (isset($this->parametersImportance[$parameterName])) {

                $this->parametersImportance[$parameterName] += 1;

            } else {

                $this->parametersImportance[$parameterName] = 1;

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

        $importanceThreshold = 0.60;

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
     * Convert from snake format to camel case
     * See http://www.refreshinglyblue.com/2009/03/20/php-snake-case-to-camel-case/
     *
     * @param string  $string               String to be converted into camel case
     * @param boolean $$capitalizeFirstWord Capitalizes first word by default
     *
     * @return string
     */
    public static function stringToCamel($string, $capitalizeFirstWord = true)
    {
        $val = str_replace(' ', '', ucwords(preg_replace('/[_-]/', ' ', $string)));

        if (!$capitalizeFirstWord) {
            $val = strtolower($val{0}).substr($val, 1);
        }

        return $val;
    }

    /**
     * Gets methods and properties from an endpoint
     *
     * @param  array    $endpoint Endpoint
     * @return ApiClass
     */
    public function getInformationfromEndpoint($endpoint)
    {

        $this->extractMethods($endpoint);
        $this->extractPropertiesFromMethods();

        $apiClass = new ApiClass();

        $apiClass->setBaseUrl($this->baseUrl);
        $apiClass->setProperties($this->properties);
        $apiClass->setMethods($this->methods);
        $apiClass->setBaseUrl($this->baseUrl);
        $apiClass->setClassName($this->apiName);
        $apiClass->setNamespace($this->namespace);

        return $apiClass;

    }

    public function getParametersImportance()
    {
        return $this->parametersImportance;
    }
    /**
     * Gets skeleton class for an specific endpoint
     *
     * @param  array  $endpoint
     * @return string
     */
    public function generateClassForEndpoint($endpoint)
    {

        $apiClass = $this->getInformationfromEndpoint($endpoint);

        $loader = new Twig_Loader_Filesystem(__DIR__.'/../Resources/views/Templates');

        $twig = new \Twig_Environment($loader);

        $this->stubClass = $twig->render($this->template, array('apiClass' => $apiClass));

        return $this;

    }
    /**
     * Writes to a file
     *
     * @param  string    $path     File Path
     * @param  boolean   $override Override if exists
     * @throws Exception
     * @return mixed     string or false
     */
    public function write($path, $override = false)
    {

        if ($this->stubClass == '') {
            throw new \Exception('Must call generateClassForEndpoint first');
        }

        $fileName = $this->apiName.'.php';

        $filePath = $path.DIRECTORY_SEPARATOR.$fileName;

        if ($override == false && file_exists($filePath)) {
            throw new \Exception("File $path already exists. If you want to override, set override = true");
        }

        $file = new \SplFileObject($filePath, 'w+');

        // @codeCoverageIgnoreStart
        if ($file->fwrite($this->stubClass) === null) {
            throw new \Exception("Could not write file in $path, verify you have writing permission");
        }
        // @codeCoverageIgnoreEnd
        return $filePath;

    }
    /**
     * Returns a string representation of the stub class
     *
     * @throws \Exception
     * @return string
     */
    public function toString()
    {

        if ($this->stubClass == '') {
            throw new \Exception('Must call generateClassForEndpoint first');
        }

        return $this->stubClass;

    }

}
