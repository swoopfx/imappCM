<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Settings\Entity\MotorModel;
use Settings\Entity\VehicleValueType;

/**
 * ObjectMotorData
 *
 * @ORM\Table(name="object_motor_data")
 * @ORM\Entity
 */
class ObjectMotorData
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=true)
     *
     * @var string
     */
    private $name;

    // /**
    // *
    // * @ORM\OneToOne(targetEntity="Object\Entity\ObjectValue", cascade={"persist"})
    // * @ORM\JoinColumn(name="object_value", referencedColumnName="id")
    // *
    // * @var ObjectValue
    // */
    // private $objectValue;
    
    /**
     *
     * @var \Settings\Entity\MotorType @ORM\ManyToOne(targetEntity="Settings\Entity\MotorType")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="motor_type", referencedColumnName="id")
     *      })
     */
    private $motorType;

    /**
     * @ORM\Column(name="motor_model", type="string", nullable=true)
     * 
     *
     * @var string
     */
    private $motorModel;
    
    /**
     * @ORM\Column(name="make_year", type="datetime", nullable=true)
     * @var string
     */
    private $makeYear;

    /**
     *
     * @var \Settings\Entity\VehicleValueType @ORM\ManyToOne(targetEntity="Settings\Entity\VehicleValueType")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="motor_value_type", referencedColumnName="id")
     *      })
     *      
     *      @var VehicleValueType
     */
    private $motorValueType;

    /**
     *
     * @var string @ORM\Column(name="motor_number", type="string", length=100, nullable=true)
     */
    private $motorNumber;

    /**
     *
     * @var string @ORM\Column(name="engine_number", type="string", length=45, nullable=true)
     */
    private $engineNumber;

    /**
     *
     * @var string @ORM\Column(name="chasis_number", type="string", length=45, nullable=true)
     */
    private $chasisNumber;

    /**
     *
     * @var \Settings\Entity\MotorTypeOfBody @ORM\ManyToOne(targetEntity="Settings\Entity\MotorTypeOfBody")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="type_of_body", referencedColumnName="id")
     *      })
     */
    private $typeOfBody;

    /**
     *
     * @var @ORM\Column(name="year_of_manu", type="date", nullable=true)
     */
    private $yearOfManu;

    /**
     *
     * @var integer @ORM\Column(name="number_of_seats", type="integer", nullable=true)
     */
    private $numberOfSeats;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_updated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     *
     * @var \Object\Entity\Object @ORM\OneToOne(targetEntity="Object\Entity\Object", inversedBy="objectMotor")
     *      @ORM\JoinColumn(name="object", referencedColumnName="id")
     */
    private $object;

    /**
     *
     * @ORM\OneToOne(targetEntity="Object\Entity\ObjectMotorExtraAirCondition", cascade={"persist"})
     * @ORM\JoinColumn(name="extra_motor_air_condition", referencedColumnName="id")
     *
     * @var ObjectMotorExtraAirCondition
     */
    private $extraAirCondition;

    /**
     *
     * @ORM\OneToOne(targetEntity="Object\Entity\ObjectMotorExtraCdPlayer", cascade={"persist"})
     * @ORM\JoinColumn(name="extra_motor_cd_player", referencedColumnName="id")
     *
     * @var ObjectMotorExtraCdPlayer
     */
    private $extraCdPlayer;

    /**
     *
     * @ORM\OneToOne(targetEntity="Object\Entity\ObjectMotorExtraSecuritySystem", cascade={"persist"})
     * @ORM\JoinColumn(name="extra_motor_security_system", referencedColumnName="id")
     *
     * @var ObjectMotorExtraSecuritySystem
     */
    private $extraSecuritySystems;

    /**
     *
     * @ORM\OneToOne(targetEntity="Object\Entity\ObjectMotorExtraAlloyWheels", cascade={"persist"})
     * @ORM\JoinColumn(name="extra_motor_alloy_wheels", referencedColumnName="id")
     *
     * @var ObjectMotorExtraAlloyWheels
     */
    private $extraAlloyWheels;

    /**
     *
     * @ORM\OneToOne(targetEntity="Object\Entity\ObjectMotorExtraOthers", cascade={"persist"})
     * @ORM\JoinColumn(name="extra_motor_others", referencedColumnName="id")
     *
     * @var ObjectMotorExtraOthers
     */
    private $extraOthers;

    public function getExtraAirCondition()
    {
        return $this->extraAirCondition;
    }

    public function getExtraCdcPlayer()
    {
        return $this->extraCdPlayer;
    }

    public function getExtraAlloyWheels()
    {
        return $this->extraAlloyWheels;
    }

    public function getExtraSecutirySystems()
    {
        return $this->extraSecuritySystems;
    }

    public function getExtraOthers()
    {
        return $this->extraOthers;
    }

    public function __construct()
    {
        $this->object = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getMakeYear(){
        return $this->makeYear;
    }
    
    public function setMakeYear($year){
        $this->makeYear = $year;
        return $this;
    }

//     public function getObjectValue()
//     {
//         return $this->objectValue;
//     }

//     public function setObjectValue($value)
//     {
//         $this->objectValue = $value;
//         return $this;
//     }

    /**
     * Set motorType
     *
     * @param integer $motorType            
     * @return ObjectMotorData
     */
    public function setMotorType($motorType)
    {
        $this->motorType = $motorType;
        
        return $this;
    }

    /**
     * Get motorType
     *
     * @return integer
     */
    public function getMotorType()
    {
        return $this->motorType;
    }
    
    public function getMotorModel(){
        return $this->motorModel;
    }
    
    public function setMotorModel($model){
        $this->motorModel = $model ;
        return $this;
    }

    /**
     * Set motorValueType
     *
     * @param integer $motorValueType            
     * @return ObjectMotorData
     */
    public function setMotorValueType($motorValueType)
    {
        $this->motorValueType = $motorValueType;
        
        return $this;
    }

    /**
     * Get motorValueType
     *
     * @return integer
     */
    public function getMotorValueType()
    {
        return $this->motorValueType;
    }

    /**
     * Set motorNumber
     *
     * @param string $motorNumber            
     * @return ObjectMotorData
     */
    public function setMotorNumber($motorNumber)
    {
        $this->motorNumber = $motorNumber;
        
        return $this;
    }

    /**
     * Get motorNumber
     *
     * @return string
     */
    public function getMotorNumber()
    {
        return $this->motorNumber;
    }

//     public function setRegistrationNumber($reg)
//     {
//         $this->registrationNumber = $reg;
        
//         return $this;
//     }

//     public function getRegistrationNumber()
//     {
//         return $this->registrationNumber;
//     }

    public function getEngineNumber()
    {
        return $this->engineNumber;
        
        return $this;
    }

    public function setEngineNumber($engine)
    {
        $this->engineNumber = $engine;
        
        return $this;
    }

    public function getChasisNumber()
    {
        return $this->chasisNumber;
    }

    public function setChasisNumber($chasis)
    {
        $this->chasisNumber = $chasis;
        
        return $this;
    }

    public function getTypeOfBody()
    {
        return $this->typeOfBody;
    }

    public function setTypeOfBody($type)
    {
        $this->typeOfBody = $type;
        return $this;
    }

    public function getYearOfManu()
    {
        return $this->yearOfManu;
    }

    public function setYearOfManu($year)
    {
        $this->yearOfManu = $year;
        return $this;
    }

    public function getNumberOfSeats()
    {
        return $this->numberOfSeats;
    }

    public function setNumberOfSeats($set)
    {
        $this->numberOfSeats = $set;
        
        return $this;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated            
     * @return ObjectMotorData
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        
        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated            
     * @return ObjectMotorData
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
        
        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    // /**
    // * Set object
    // *
    // * @param \Object\Entity\Object $object
    // * @return Object
    // */
    // public function setObject(\Object\Entity\Object $object = null)
    // {
    // $this->object = $object;
    
    // return $this;
    // }
    // public function addObject($objs)
    // {
    // foreach ($objs as $obj) {
    // $this->object[] = $obj;
    // }
    // return $this;
    // }
    
    // public function removeObject($objs)
    // {
    // // $this->object->
    // }
    
    /**
     * Get object
     *
     * @return \Object\Entity\Object
     */
    public function getObject()
    {
        return $this->object;
    }

    public function setObject($obj)
    {
        $this->object = $obj;
        $this->object->setObjectMotor($this);
        return $this;
    }
}
