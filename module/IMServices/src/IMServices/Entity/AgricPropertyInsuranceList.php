<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="agric_property_insurance_list")
 *
 * @author otaba
 *        
 */
class AgricPropertyInsuranceList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="property_name", type="string", nullable=true)
     *
     * @var string
     */
    private $propertyName;

    /**
     * @ORM\Column(name="descsss", type="text", nullable=true)
     *
     * @var text
     */
    private $desc;

    /**
     * @ORM\Column(name="value", type="string", nullable=true)
     *
     * @var text
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\AgricProductInsurance", inversedBy="propertyList")
     * 
     * @var AgricProductInsurance;
     */
    private $agricProperty;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param number $id            
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @return the $propertyName
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     *
     * @param string $propertyName            
     */
    public function setPropertyName($propertyName)
    {
        $this->propertyName = $propertyName;
        return $this;
    }

    /**
     *
     * @return the $desc
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     *
     * @param \IMServices\Entity\text $desc            
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
        return $this;
    }

    /**
     *
     * @return the $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     *
     * @param \IMServices\Entity\text $value            
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
    /**
     * @return the $agricProperty
     */
    public function getAgricProperty()
    {
        return $this->agricProperty;
    }

    /**
     * @param \IMServices\Entity\AgricProductInsurance; $agricProperty
     */
    public function setAgricProperty($agricProperty)
    {
        $this->agricProperty = $agricProperty;
        return $this;
    }

}

