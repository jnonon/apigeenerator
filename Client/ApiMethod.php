<?php
/**
 *
 */

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Jonathan Nonon <jnonon@gmail.com>
 *
 **/
use Jnonon\Tools\Apigee\Client\ApiParameter;

namespace Jnonon\Tools\Apigee\Client;
/**
 * Defines a method
 *
 */
class ApiMethod
{
    /**
     * Method Name
     *
     * @var string
     */
    private $name;

    /**
     * Parameters
     *
     * @var array
     */
    private $parameters = array();

    /**
     * Method Description
     *
     * @var string
     */
    private $description;

    /**
     * Method reference
     *
     * @var string
     */
    private $reference;

    /**
     * Constructor
     * @param array $methodDetail
     */
    public function __construct(array $methodDetail)
    {

        $this->name = ApiGenerator::stringToCamel($methodDetail['id']);

        $this->description = (isset($methodDetail['doc']['content']) ?
                              html_entity_decode($methodDetail['doc']['content']) :
                              'FIXME: No Description');

        $this->reference= (isset($methodDetail['doc']['apigee:url']) ?
                          html_entity_decode($methodDetail['doc']['apigee:url']) : '');

        $parameters = (isset($methodDetail['params']) && is_array($methodDetail['params']) ? $methodDetail['params'] : array());

        $this->setParameters($parameters);
        /*
        $this->methods[$methodName]['documentation']['reference'] = $docReference;
        $this->methods[$methodName]['documentation']['description'] = $docDescription;
        $this->methods[$methodName]['params'] = $params;
        */


    }
    /**
     * Set method parameters
     *
     * @param array $parameters
     */
    private function setParameters(array $parameters)
    {
        $i = 0;
        foreach ($parameters as $parameter) {
            $parameterObject = new ApiParameter($parameter);
            $parameterObject->setOrder($i);
            $this->parameters[$parameterObject->getName()] = $parameterObject;
            $i++;
        }
    }

    /**
     * Removes a parameter by name
     *
     * @param string $parameterName
     */
    public function removeParameter($parameterName)
    {
        unset($this->parameters[$parameterName]);
    }

    /**
     * Gets method name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Gets method description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets method reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Gets Method parameters
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }



}
