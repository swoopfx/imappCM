<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotorType
 *
 * @ORM\Table(name="motor_value_type")
 * @ORM\Entity
 */
class MotorValueType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @var string @ORM\Column(name="value_type", type="string", length=200, nullable=true)
     */
    private $valueType;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name            
     * @return MotorType
     */
    public function setName($name)
    {
        $this->valueType = $name;
        
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->valueType;
    }
}
