<?php
namespace IMServices\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="motor_non_standard_accessory")
 * @ORM\Entity
 * 
 * @author otaba
 *        
 */
class MotorNonStandardAccesory
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=true)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="accessory_name", type="string", nullable=true)
     * @var string
     */
    private $accessoryName;
    
    /**
     * @ORM\Column(name="accessory_value", type="string", nullable=true)
     * @var string
     */
    private $accessoryValue;
    
    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\MotorData", inversedBy="nonStandardAccesory")
     * @var MotorData
     *
     */
    private $motorData;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $accessoryName
     */
    public function getAccessoryName()
    {
        return $this->accessoryName;
    }

    /**
     * @return the $accessoryValue
     */
    public function getAccessoryValue()
    {
        return $this->accessoryValue;
    }

    /**
     * @return the $motorData
     */
    public function getMotorData()
    {
        return $this->motorData;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $accessoryName
     */
    public function setAccessoryName($accessoryName)
    {
        $this->accessoryName = $accessoryName;
        return $this;
    }

    /**
     * @param string $accessoryValue
     */
    public function setAccessoryValue($accessoryValue)
    {
        $this->accessoryValue = $accessoryValue;
        return $this;
    }

    /**
     * @param \IMServices\Entity\MotorData $motorData
     */
    public function setMotorData($motorData)
    {
        $this->motorData = $motorData;
        return $this;
    }

}

