<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="object_motor_extra_alloy_wheels")
 *
 * @author otaba
 *
 */
class ObjectMotorExtraAlloyWheels
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
     * @var string @ORM\Column(name="name", type="string", length=500, nullable=true)
     */
    private $name;
    
//     /**
//      *
//      * @ORM\OneToOne(targetEntity="Object\Entity\ObjectValue", cascade={"persist"})
//      * @ORM\JoinColumn(name="object_value", referencedColumnName="id")
//      *
//      * @var ObjectValue
//      */
//     private $objectValue;
    
    public function __construct()
    {}
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function getObjectValue()
    {
        return $this->objectValue;
    }
}

