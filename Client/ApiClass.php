<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Jonathan Nonon <jnonon@gmail.com>
 *
 **/
namespace Jnonon\Tools\Apigee\Client;
/**
 * Defines a Class
 *
 */
class ApiClass
{
    /**
     * Holds class methods
     * @var array
     */
    protected $methods;

    /**
     * Holds class properties if they exists
     * @var array
     */
    protected $properties;

    /**
     * Class Name
     * @var string
     */
    protected $className;

    /**
     * Base Url
     * @var string
     */

    protected $baseUrl;

    /**
     * Namespace
     * @var string
     */
    protected $namespace = 'ADD\\A\\PSR0\\NamespaceReference';

    /**
     * Get methods
     * @return array
     */
    public function getMethods()
    {
        return $this->methods;
    }
    /**
     * Set methods
     *
     * @param array $methods Class methods
     */
    public function setMethods(array $methods)
    {
        $this->methods = $methods;
    }

    /**
     * Get properties
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }
    /**
     * Set Properties
     * @param array $properties
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;
    }
    /**
     * Get class name
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }
    /**
     * Set class name
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * Gets base Url
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Set base url
     *
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }
    /**
     * Gets namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }
    /**
     * Set namespace
     *
     * @param string $namespace Namespace
     */
    public function setNamespace($namespace)
    {
        if ($namespace != '') {
            $this->namespace = $namespace;
        }
    }

}
