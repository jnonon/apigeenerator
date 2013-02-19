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
 * Defines a parameter
 *
 */
class ApiParameter
{
    /**
     * Parameter name
     *
     * @var string
     */
    private $name;
    /**
     * Parameter Type
     * @var string
     */
    private $type;

    /**
     * Parameter Description
     * @var string
     */
    private $description;

    /**
     *
     * @var integer
     */
    private $order = 0;

    /**
     * Constructor
     *
     * @param array $parameter
     * @param array $options
     */
    public function __construct(array $parameter, array $options = array())
    {
        $this->name = ApiGenerator::stringToCamel($parameter['name'], false);
        $this->type = $parameter['type'];
        $this->description = (isset($parameter['doc']['content']) ? $parameter['doc']['content'] : ucfirst($this->name));
    }
    /**
     * Sets parameter order of apperance
     * @param integer $order Order
     *
     */
    public function setOrder($order)
    {
        $this->order = abs((int) $order);
    }

    /**
     * Gets parameter order of apperance
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Gets Name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Gets Type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Gets Description
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

}
