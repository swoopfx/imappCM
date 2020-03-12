<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\HomeCategoryType;
use Settings\Entity\BuildingWallType;
use Settings\Entity\BuildingFloorType;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="home_insurance")
 * This defines insurance for home and household
 * 
 * @author otaba
 *        
 */
class HomeInsurance
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
   

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\HomeCategoryType")
     * 
     * @var HomeCategoryType
     */
    private $occupierCategory;

    /**
     * @ORM\Column(name="other_occupier_category", type="string", nullable=true)
     * 
     * @var string
     */
    private $otherOcuppierCategry;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\BuildingWallType")
     * 
     * @var BuildingWallType
     */
    private $buildingWallType;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\BuildingFloorType")
     * 
     * @var BuildingFloorType
     */
    private $buildingFloorType;

    /**
     * @ORM\Column(name="building_location", type="text", nullable=true)
     * 
     * @var text
     */
    private $buildingLocation;

    /**
     * @ORM\Column(name="building_value", type="string", nullable=true)
     * 
     * @var string
     */
    private $buildingValue;

    /**
     * @ORM\Column(name="insured_sum", type="string", nullable=true)
     * 
     * @var string
     */
    private $insuredSum;

    // /**
    // * @ORM\Column(name="deductible", type="string", nullable=true)
    // * @var string
    // */
    // private $deductible;
    
    /**
     * Defines if other party has financial interest in the building
     * E.g Mortgage Banks, Commercial Banks
     * @ORM\Column(name="is_other_financial_interest", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isOtherFinancialInterest;

    /**
     * @ORM\Column(name="is_personal_property_coverage", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPersonalPropertyCoverage;

    /**
     * @ORM\Column(name="is_sound_state", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isSoundState;

    /**
     * This include kichen appliances, Clothings
     * @ORM\OneToMany(targetEntity="HouseHoldGoods", mappedBy="homeInsurance")
     * 
     * @var Collection
     */
    private $houseHoldGoods;

    /**
     * This includes Jewelry, Precious metals, paintings nad Collections
     * @ORM\OneToMany(targetEntity="HouseValuables", mappedBy="homeInsurance")
     * 
     * @var Collection
     */
    private $houseValueables;
    
   
    /**
     * If the building would be left for 30 consecutive days or more
     * @ORM\Column(name="is_left_for_30_days", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isLeftFor30Days;

    /**
     * Defines if building has other tenants
     * @ORM\Column(name="is_tenants", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isTenant;

    /**
     * Deines if the building is used for trade
     * @ORM\Column(name="is_used_for_trade", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isUsedForTrade;

    /**
     * Identifies if property was previously insured
     * @ORM\Column(name="is_previous_insured", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPreviousInsured;

    /**
     * If specific policy was previously declined by an insurance company
     * @ORM\Column(name="is_previous_decline", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPreviousDecline;

    /**
     * Decline Reason
     * @ORM\Column(name="decline_reason", type="text", nullable=true)
     * 
     * @var text
     */
    private $declineReason;
    
    /**
     * If building has valuables
     * @ORM\Column(name="is_valuables", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isValuables;
    
    /**
     * Defines if building belongs to applicant
     * @var boolean
     */
    private $isApplicants;
    
    /**
     * a site which has been free from flooding in the last ten years?
     * free from any sign of danger by landship or subsidence?
     * 
     * @ORM\Column(name="is_free_from_flooding_etc", type="boolean", nullable=true)
     * @var boolean
     */
    private $isFreeFromFloodinEtc;
    
    /**
     * Type of danger from above
     * @ORM\Column(name="danger_details", type="text", nullable=true)
     * @var string
     */
    private $dangerDetails;
    
    /**
     * @ORM\Column(name="is_mortgage", type="boolean", nullable=true)
     * @var boolean
     */
    private $isMortgage;
    
    /**
     * @ORM\Column(name="mortgage_details", type="text", nullable=true)
     * @var string
     */
    private $mortgageDetails;
    
    /**
     * Determines if applicants wants to provide list of goods to be covered;
     * if false just show sum covered fields
     *  @var boolean
     */
    private $isProvideList;
    
    private $sumBuildingCovered;
    
    private $sumContentCovered;
    
    private $summLossRentCovered;
    
    private $sumOthersCovered;
    
    
    

    /**
     */
    public function __construct()
    {
        
       $this->houseHoldGoods = new ArrayCollection();
       $this->houseValueables = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getInsuredSum()
    {
        return $this->insuredSum;
    }

    public function setInsuredSum($sum)
    {
        $this->insuredSum = $sum;
        return $this;
    }

    public function getDeductible()
    {
        return $this->deductible;
    }

    public function setDeductible($dec)
    {
        $this->deductible = $dec;
        return $this;
    }

    public function getIsOtherFinancialInterest()
    {
        return $this->isOtherFinancialInterest;
    }

    public function setIsOtherFinancialInterest($set)
    {
        $this->isOtherFinancialInterest = $set;
        return $this;
    }

    public function getIsPersonalPropertyCoverage()
    {
        return $this->isPersonalPropertyCoverage;
    }

    public function setIsPersonalPropertyCoverage($set)
    {
        $this->isPersonalPropertyCoverage = $set;
        return $this;
    }

    public function getISoundState()
    {
        return $this->isSoundState;
    }

    public function setIsSoundState($set)
    {
        $this->isSoundState = $set;
        return $this;
    }

    public function getHouseHoldGoods()
    {
        return $this->houseHoldGoods;
    }

    public function addHouseHoldGoods($add)
    {
        if (! $this->houseHoldGoods->contains($add)) {
            $this->houseHoldGoods->add($add);
        }
        return $this;
    }

    public function removeHouseHoldGoods($house)
    {
        if ($this->houseHoldGoods->remove($house)) {
            $this->houseHoldGoods->removeElement($house);
        }
        return $this;
    }

    public function getHouseValueables()
    {
        return $this->houseValueables;
    }

    public function addHouseValueables($home)
    {
        if (! $this->houseValueables->contains($home)) {
            $this->houseValueables->add($home);
        }
        
        return $this;
    }

    public function removeHouseValueables($value)
    {
        if ($this->houseValueables->contains($value)) {
            $this->houseValueables->removeElement($value);
        }
        return $this;
    }

    public function getIsOwnerOccupier()
    {
        return $this->isOwnerOccupier;
    }

    public function setIsOwnerOccupier($is)
    {
        $this->isOwnerOccupier = $is;
        return $this;
    }

    public function getIsLeftFor30Days()
    {
        return $this->isLeftFor30Days;
    }

    public function setIsLeftFor30Days($set)
    {
        $this->isLeftFor30Days = $set;
        return $this;
    }

    public function getIsTenant()
    {
        return $this->isTenant;
    }

    public function setIsTenant($set)
    {
        $this->isTenant = $set;
        return $this;
    }

    public function getIsUsedForTrade()
    {
        return $this->isUsedForTrade;
    }

    public function setIsUsedForTrade($set)
    {
        $this->isUsedForTrade = $set;
        return $this;
    }

    /**
     *
     * @return the $occupierCategory
     */
    public function getOccupierCategory()
    {
        return $this->occupierCategory;
    }

    /**
     *
     * @return the $otherOcuppierCategry
     */
    public function getOtherOcuppierCategry()
    {
        return $this->otherOcuppierCategry;
    }

    /**
     *
     * @return the $buildingWallType
     */
    public function getBuildingWallType()
    {
        return $this->buildingWallType;
    }

    /**
     *
     * @return the $buildingFloorType
     */
    public function getBuildingFloorType()
    {
        return $this->buildingFloorType;
    }

    /**
     *
     * @return the $buildingLocation
     */
    public function getBuildingLocation()
    {
        return $this->buildingLocation;
    }

    /**
     *
     * @return the $buildingValue
     */
    public function getBuildingValue()
    {
        return $this->buildingValue;
    }

    /**
     *
     * @return the $isSoundState
     */
    public function getIsSoundState()
    {
        return $this->isSoundState;
    }

    /**
     *
     * @return the $isPreviousInsured
     */
    public function getIsPreviousInsured()
    {
        return $this->isPreviousInsured;
    }

    /**
     *
     * @return the $isPreviousDecline
     */
    public function getIsPreviousDecline()
    {
        return $this->isPreviousDecline;
    }

    /**
     *
     * @return the $declineReason
     */
    public function getDeclineReason()
    {
        return $this->declineReason;
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
     * @param \Settings\Entity\HomeCategoryType $occupierCategory            
     */
    public function setOccupierCategory($occupierCategory)
    {
        $this->occupierCategory = $occupierCategory;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\unknown $otherOcuppierCategry            
     */
    public function setOtherOcuppierCategry($otherOcuppierCategry)
    {
        $this->otherOcuppierCategry = $otherOcuppierCategry;
        return $this;
    }

    /**
     *
     * @param \Settings\Entity\BuildingWallType $buildingWallType            
     */
    public function setBuildingWallType($buildingWallType)
    {
        $this->buildingWallType = $buildingWallType;
        return $this;
    }

    /**
     *
     * @param \Settings\Entity\BuildingFloorType $buildingFloorType            
     */
    public function setBuildingFloorType($buildingFloorType)
    {
        $this->buildingFloorType = $buildingFloorType;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\text $buildingLocation            
     */
    public function setBuildingLocation($buildingLocation)
    {
        $this->buildingLocation = $buildingLocation;
        return $this;
    }

    /**
     *
     * @param string $buildingValue            
     */
    public function setBuildingValue($buildingValue)
    {
        $this->buildingValue = $buildingValue;
        return $this;
    }

    /**
     *
     * @param boolean $isPreviousInsured            
     */
    public function setIsPreviousInsured($isPreviousInsured)
    {
        $this->isPreviousInsured = $isPreviousInsured;
        return $this;
    }

    /**
     *
     * @param boolean $isPreviousDecline            
     */
    public function setIsPreviousDecline($isPreviousDecline)
    {
        $this->isPreviousDecline = $isPreviousDecline;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\text $declineReason            
     */
    public function setDeclineReason($declineReason)
    {
        $this->declineReason = $declineReason;
        return $this;
    }
    /**
     * @return the $isValuables
     */
    public function getIsValuables()
    {
        return $this->isValuables;
    }

    /**
     * @param boolean $isValuables
     */
    public function setIsValuables($isValuables)
    {
        $this->isValuables = $isValuables;
        return $this;
    }

}

