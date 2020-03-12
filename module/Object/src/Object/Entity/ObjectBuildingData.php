<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\BuildingType;
//use Settings\Entity\Insurer;
use Settings\Entity\Zone;
use Settings\Entity\Country;
use Settings\Entity\BuildingWallType;
use Settings\Entity\BuildingRoofType;

/**
 * @ORM\Entity
 * @ORM\Table(name="object_building_data")
 *
 * @author otaba
 *        
 */
class ObjectBuildingData
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
     * @var \Object\Entity\Object @ORM\OneToOne(targetEntity="Object\Entity\Object", inversedBy="objectBuilding")
     *     
     */
    private $object;

    /**
     *
     * @var string @ORM\Column(name="house_add1", type="string", nullable=true)
     */
    private $houseAdd1;

    /**
     *
     * @var \DateTime @ORM\Column(name="house_add2", type="string", nullable=true)
     */
    private $houseAdd2;

    /**
     * @ORM\Column(name="city", type="string", nullable=true)
     *
     * @var string
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Zone")
     *
     * @var Zone
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Country")
     *
     * @var Country
     */
    private $country;

    /**
     *
     * @var String @ORM\Column(name="house_description", type="text", nullable=true)
     */
    private $houseDescription;

    // /**
    // *
    // * @ORM\OneToOne(targetEntity="Object\Entity\ObjectValue", cascade={"persist"})
    // * @ORM\JoinColumn(name="object_value", referencedColumnName="id")
    // *
    // * @var ObjectValue
    // */
    // private $objectValue;
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\BuildingWallType")
     *
     * @var BuildingWallType
     */
    private $wallType;
    
    private $otherWall;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\BuildingRoofType")
     *
     * @var BuildingRoofType
     */
    private $roofType;
    
    /**
     * 
     * @var string
     */
    private $otherRoofType;
    
//     private 

    /**
     * @ORM\Column(name="floor_area", type="string", nullable=true)
     *
     * @var string
     */
    private $floorArea;

    // /**
    // * @ORM\Column(name="is_previous_insured", type="boolean", nullable=true)
    // *
    // * @var boolean
    // */
    // private $IsPreviousInsured;
    
    // /**
    // * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
    // *
    // * @var Insurer
    // */
    // private $previousInsurer;
    
    /**
     * @ORM\Column(name="is_intruder_alarm_system", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isIntruderAlarmSystem;

    /**
     * Define a fire alarm system
     * @ORM\Column(name="is_fire_alarm_system", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isFireAlarmSystem;

    /**
     * Define a fire protection system
     * @ORM\Column(name="is_fire_protection_system", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isFireProtectionSystem;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\BuildingType");
     *
     * @var BuildingType
     */
    private $buildingType;

    /**
     * @ORM\Column(name="other_info", type="text", nullable=true)
     *
     * @var string
     */
    private $otherInfo;

    /**
     * @ORM\Column(name="no_of_rooms", type="string", nullable=true)
     *
     * @var string
     */
    private $noOfRooms;

    /**
     *
     * @var string
     */
    private $noOfStoreys;
    
    /**
     * @ORM\Column(name="year_built", type="datetime", nullable=true)
     * @var \Datetime
     */
    private $yearBuilt;

    public function __construct()
    {}

    public function setObject($obj)
    {
        $this->object = $obj;
        $this->object->setObjectBuilding($this);
        return $this;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getHouseAdd1()
    {
        return $this->houseAdd1;
    }

    public function setHouseAdd1($add)
    {
        $this->houseAdd1 = $add;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($ci)
    {
        $this->city = $ci;
        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($cou)
    {
        $this->country = $cou;
        return $this;
    }

    public function getFullAddress()
    {
        return ($this->houseAdd1 == NULL ? "": $this->houseAdd1) . ", " . ($this->houseAdd2 == NULL ? "" : $this->houseAdd2). "  " . ($this->city == NULL ? "" : $this->city). "  " . ($this->state == NULL ? "" : $this->state->getZoneName()). ",  " . ($this->country == NULL ? "" :$this->country->getCountryName());
    }

    public function getHouseAdd2()
    {
        return $this->houseAdd2;
    }

    public function setHouseAdd2($add)
    {
        $this->houseAdd2 = $add;
        return $this;
    }

    public function getHouseDescription()
    {
        return $this->houseDescription;
    }

    public function setHouseDescription($desc)
    {
        $this->houseDescription = $desc;
        return $this;
    }

    public function getWallType()
    {
        return $this->wallType;
    }

    public function setWallType($type)
    {
        $this->wallType = $type;
        return $this;
    }

    public function getRoofType()
    {
        return $this->roofType;
    }

    public function setRoofType($type)
    {
        $this->roofType = $type;
        return $this;
    }

    public function getIsPreviousInsured()
    {
        return $this->IsPreviousInsured;
    }

    public function setIsPreviousInsured($ins)
    {
        $this->IsPreviousInsured = $ins;
        return $this;
    }

    public function getPreviousInsurer()
    {
        return $this->previousInsurer;
    }

    public function setPreviousInsurer($ins)
    {
        $this->previousInsurer = $ins;
        return $this;
    }

    public function getIsIntruderAlarmSystem()
    {
        return $this->isIntruderAlarmSystem;
    }

    public function setIsIntruderAlarmSystem($ins)
    {
        $this->isIntruderAlarmSystem = $ins;
        return $this;
    }

    public function setIsFireAlarmSystem($ins)
    {
        $this->isFireAlarmSystem = $ins;
        return $this;
    }

    public function getIsFireAlarmSystem()
    {
        return $this->isFireAlarmSystem;
    }

    public function getIsFireProtectionSystem()
    {
        return $this->isFireProtectionSystem;
    }

    public function setIsFireProtectionSystem($pro)
    {
        $this->isFireProtectionSystem = $pro;
        return $this;
    }

    public function getBuildingType()
    {
        return $this->buildingType;
    }

    public function setBuildingType($type)
    {
        $this->buildingType = $type;
        return $this;
    }

    public function getOtherInfo()
    {
        return $this->otherInfo;
    }

    public function setOtherInfo($info)
    {
        $this->otherInfo = $info;
        return $this;
    }

    public function getNoOfRooms()
    {
        return $this->noOfRooms;
    }

    public function setNoOfRooms($set)
    {
        $this->noOfRooms = $set;
        return $this;
    }

    public function setFloorArea($area)
    {
        $this->floorArea = $area;
        return $this;
    }

    public function getFloorArea()
    {
        return $this->floorArea;
    }

    public function getNoOfStoreys()
    {
        return $this->noOfStoreys;
    }

    public function setNoOfStoreys($set)
    {
        $this->noOfStoreys = $set;
        return $this;
    }
    
    public function getYearBuilt(){
        return $this->yearBuilt;
    }
    
    public function setYearBuilt($date){
        $this->yearBuilt = $date;
        return $this;
    }
}

