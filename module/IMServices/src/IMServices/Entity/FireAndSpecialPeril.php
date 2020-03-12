<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\BuildingWallType;
use Settings\Entity\BuildingRoofType;
use Settings\Entity\BuildingType;
use Settings\Entity\BuildingFloorType;
use Settings\Entity\BuildingPowerType;

/**
 * @ORM\Entity
 * @ORM\Table(name="fire_and_special_peril")
 * 
 * @author otaba
 *        
 */
class FireAndSpecialPeril
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\BuildingType");
     *
     * @var BuildingType
     */
    private $buildingType;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\BuildingWallType")
     *
     * @var BuildingWallType
     */
    private $wallType;

    /**
     * @ORM\Column(name="other_wall_type", type="string", nullable=true)
     * 
     * @var string
     */
    private $otherWallType;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\BuildingRoofType")
     *
     * @var BuildingRoofType
     */
    private $roofType;

    /**
     * @ORM\Column(name="other_roof_type", type="string", nullable=true)
     * 
     * @var string
     */
    private $otherRoofType;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\BuildingFloorType")
     *
     * @var BuildingFloorType
     */
    private $floorType;

    /**
     * @ORM\Column(name="other_floor_type", type="string", nullable=true)
     * 
     * @var string
     */
    private $otherFloorType;

    /**
     * @ORM\Column(name="number_of_stories", type="string", nullable=true)
     *
     * @var string
     */
    private $numberOfStories;

    /**
     * @ORM\Column(name="age_of_building", type="string", nullable=true)
     *
     * @var string
     */
    private $ageOfBuilding;

    /**
     * This defines if buildin is for manufacturing purpose
     * @ORM\Column(name="is_manufacturing", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isManufacturing;

    /**
     *
     * Give a brief description of the manufacturing taking place in the building
     * @ORM\Column(name="manufacturing", type="text", nullable=true)
     *
     * @var text
     */
    private $manufacturing;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\BuildingPowerType")
     *
     * @var BuildingPowerType
     */
    private $powerType;

    /**
     * This defines an hazardous good is in 10 metters of the building
     * @ORM\Column(name="is_hazardous_goods", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isHazardousGoods;

    /**
     * This ientifies if fire alarm systems are instaled in the premises
     * @ORM\Column(name="is_fire_alarm_system", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isFireAlarmSystem;

    /**
     * @ORM\Column(name="fire_alarm_system", type="text", nullable=true)
     *
     * @var text This is a description of the fire alarm suytem in building
     */
    private $fireALarmSystem;

    /**
     * @ORM\Column(name="is_fire_protection_system", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isFireProtectionSystem;

    /**
     * @ORM\Column(name="fire_protection_system", type="text", nullable=true)
     *
     * @var text
     */
    private $fireProtectionSystem;

    /**
     *
     *
     * @ORM\OneToMany(targetEntity="FireAndSpecialPerilCOverList", mappedBy="fireAndSpecialPeril")
     *
     * @var Collection
     */
    private $coverList;

    /**
     * This defines a previous decline by an insurer
     * @ORM\Column(name="is_previous_decline", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousDecline;

    /**
     * This sidentifies if the consumer require some special service listed below
     * the list below only shows if the consumer clicks this
     * @ORM\Column(name="is_special_peril", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isSpecialPeril;

    /**
     *
     * @ORM\Column(name="is_aircraft", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAircraft;

    /**
     *
     * @ORM\Column(name="is_explosion", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isExplosion;

    /**
     *
     * @ORM\Column(name="is_riot_n_strike", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isRiotNdStrike;

    /**
     * This can only show if riot and strike is active
     * @ORM\Column(name="is_malicious_damage", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isMaliciousDamage;

    /**
     *
     * @ORM\Column(name="is_bush_fire", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isBushFire;

    /**
     *
     * @ORM\Column(name="is_tornado", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isTornado;

    /**
     *
     * @ORM\Column(name="is_flood", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isFlood;

    /**
     * Defines if building is in good condition
     * @ORM\Column(name="is_good_condition", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isGoodCondition;
    
    /**
     * @ORM\Column(name="is_burst_pipes", type="boolean", nullable=true)
     * @var boolean
     */
    private $isBurstPipes;

    /**
     * If hthere is a physical impact
     * @ORM\Column(name="is_impact", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isImpact;

    // /**
    // * @ORM\Column(name="additional_info", type="text", nullable=true)
    // *
    // * @var text
    // */
    // private $additionalInfo;
    
    /**
     *
     *
     * @ORM\Column(name="is_declaration", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDeclaration;

    // /**
    // * @ORM\OneToOne(targetEntity="CoverDetails")
    // * @var CoverDetails
    // */
    // private $coverDetails;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
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

    public function getWallType()
    {
        return $this->wallType;
    }

    public function setWallType($type)
    {
        $this->wallType = $type;
        return $this;
    }

    /**
     *
     * @return the $otherWallType
     */
    public function getOtherWallType()
    {
        return $this->otherWallType;
    }
    
    /**
     *
     * @param string $otherWallType
     */
    public function setOtherWallType($otherWallType)
    {
        $this->otherWallType = $otherWallType;
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

    /**
     *
     * @return the $otherRoofType
     */
    public function getOtherRoofType()
    {
        return $this->otherRoofType;
    }

    /**
     *
     * @param string $otherRoofType            
     */
    public function setOtherRoofType($otherRoofType)
    {
        $this->otherRoofType = $otherRoofType;
        return $this;
    }

    public function getFloorType()
    {
        return $this->floorType;
    }

    public function setFloorType($type)
    {
        $this->floorType = $type;
        return $this;
    }

    public function getNumberOfStories()
    {
        return $this->numberOfStories;
    }

    public function setNumberOfStories($set)
    {
        $this->numberOfStories = $set;
        return $this;
    }

    public function getAgeOfBuilding()
    {
        return $this->ageOfBuilding;
    }

    public function setAgeOfBuilding($age)
    {
        $this->ageOfBuilding = $age;
        return $this;
    }

    public function getIsHazardousGoods()
    {
        return $this->isHazardousGoods;
    }

    public function setIsHazardousGoods($had)
    {
        $this->isHazardousGoods = $had;
        return $this;
    }

    public function getIsFireAlarmSystem()
    {
        return $this->isFireAlarmSystem;
    }

    public function setIsFireAlarmSystem($is)
    {
        $this->isFireAlarmSystem = $is;
        return $this;
    }

    public function getFireALarmSystem()
    {
        return $this->fireALarmSystem;
    }

    public function setFireALarmSystem($set)
    {
        $this->fireALarmSystem = $set;
        return $this;
    }

    public function getIsFireProtectionSystem()
    {
        return $this->isFireProtectionSystem;
    }

    public function setIsFireProtectionSystem($is)
    {
        $this->isFireProtectionSystem = $is;
        return $this;
    }

    public function getFireProtectionSystem()
    {
        return $this->fireProtectionSystem;
    }

    public function setFireProtectionSystem($fire)
    {
        $this->fireProtectionSystem = $fire;
        return $this;
    }

    public function getCoverList()
    {
        return $this->coverList;
    }

    /**
     *
     * @param FireAndSpecialPerilCOverList $cover            
     */
    public function addCoverList($cover)
    {
        if (! $this->coverList->contains($cover)) {
            $this->coverList->add($cover);
            $cover->setFireAndSpecialPeril($this);
        }
        return $this;
    }

    /**
     *
     * @param FireAndSpecialPerilCOverList $cover            
     */
    public function removeCoverList($cover)
    {
        if ($this->coverList->contains($cover)) {
            $this->coverList->removeElement($cover);
            $cover->setFireAndSpecialPeril(NULL);
        }
    }

    public function getIsPreviousDecline()
    {
        return $this->isPreviousDecline;
    }

    public function setIsPreviousDecline($dec)
    {
        $this->isPreviousDecline = $dec;
        return $this;
    }

    public function getIsSpecialPeril()
    {
        return $this->isSpecialPeril;
    }

    public function setIsSpecialPeril($sep)
    {
        $this->isSpecialPeril = $sep;
        return $this;
    }

    public function getIsAircraft()
    {
        return $this->isAircraft;
    }

    public function setIsAircraft($craft)
    {
        $this->isAircraft = $craft;
        return $this;
    }

    /**
     *
     * @return the $isExplosion
     */
    public function getIsExplosion()
    {
        return $this->isExplosion;
    }

    public function setIsExplosion($ex)
    {
        $this->isExplosion = $ex;
        return $this;
    }

    public function getIsRiotNdStrike()
    {
        return $this->isRiotNdStrike;
    }

    public function setIsRiotNdStrike($riot)
    {
        $this->isRiotNdStrike = $riot;
        return $this;
    }

    public function getIsMaliciousDamage()
    {
        return $this->isMaliciousDamage;
    }

    public function setIsMaliciousDamage($mal)
    {
        $this->isMaliciousDamage = $mal;
        return $this;
    }

    public function getIsBushFire()
    {
        return $this->isBushFire;
    }

    public function setIsBushFire($bush)
    {
        $this->isBushFire = $bush;
        return $this;
    }

    public function getIsTornado()
    {
        return $this->isTornado;
    }

    public function setIsTornado($tor)
    {
        $this->isTornado = $tor;
        return $this;
    }

    public function getIsFlood()
    {
        return $this->isFlood;
    }

    public function setIsFlood($floo)
    {
        $this->isFlood = $floo;
        return $this;
    }

   

    public function getIsImpact()
    {
        return $this->isImpact;
    }

    public function setIsImpact($imp)
    {
        $this->isImpact = $imp;
        return $this;
    }

  

    /**
     *
     * @return the $otherFloorType
     */
    public function getOtherFloorType()
    {
        return $this->otherFloorType;
    }

    /**
     *
     * @param string $otherFloorType            
     */
    public function setOtherFloorType($otherFloorType)
    {
        $this->otherFloorType = $otherFloorType;
        return $this;
    }

    /**
     *
     * @return the $isManufacturing
     */
    public function getIsManufacturing()
    {
        return $this->isManufacturing;
    }

    /**
     *
     * @param boolean $isManufacturing            
     */
    public function setIsManufacturing($isManufacturing)
    {
        $this->isManufacturing = $isManufacturing;
        return $this;
    }

    /**
     *
     * @return the $manufacturing
     */
    public function getManufacturing()
    {
        return $this->manufacturing;
    }

    /**
     *
     * @param \IMServices\Entity\text $manufacturing            
     */
    public function setManufacturing($manufacturing)
    {
        $this->manufacturing = $manufacturing;
        return $this;
    }

    /**
     *
     * @return the $powerType
     */
    public function getPowerType()
    {
        return $this->powerType;
    }

    /**
     *
     * @param \Settings\Entity\BuildingPowerType $powerType            
     */
    public function setPowerType($powerType)
    {
        $this->powerType = $powerType;
        return $this;
    }

  

    /**
     *
     * @param number $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $coverList            
     */
    public function setCoverList($coverList)
    {
        $this->coverList = $coverList;
    }
    /**
     * @return the $isGoodCondition
     */
    public function getIsGoodCondition()
    {
        return $this->isGoodCondition;
    }

    /**
     * @param boolean $isGoodCondition
     */
    public function setIsGoodCondition($isGoodCondition)
    {
        $this->isGoodCondition = $isGoodCondition;
        return $this;
    }
    /**
     * @return the $isBurstPipes
     */
    public function getIsBurstPipes()
    {
        return $this->isBurstPipes;
    }

    /**
     * @param boolean $isBurstPipes
     */
    public function setIsBurstPipes($isBurstPipes)
    {
        $this->isBurstPipes = $isBurstPipes;
        return $this;
    }


}

