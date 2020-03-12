<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VehicleValueType
 *
 * @ORM\Table(name="vehicle_value_type")
 * @ORM\Entity
 */
class VehicleValueType
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
     * @var string @ORM\Column(name="value_type", type="string", length=100, nullable=true)
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
     * Set valueType
     *
     * @param string $valueType            
     *
     * @return VehicleValueType
     */
    public function setValueType($valueType)
    {
        $this->valueType = $valueType;
        
        return $this;
    }

    /**
     * Get valueType
     *
     * @return string
     */
    public function getValueType()
    {
        return $this->valueType;
    }
}
