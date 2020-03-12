<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\NonResidentialType;

/**
 *
 * @author swoopfx
 *         @ORM\Table(name="buglary_house_breaking")
 *         @ORM\Entity
 *        
 */
class BuglaryHouseBreaking
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    // private $premisesAdress;
    
    /**
     * Defines if building is residential
     * @ORM\Column(name="is_residential", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isResidential;

    /**
     * Define the non Residential Type
     * Basicly for non residential buildings
     *
     * e.g Factory, Boarding or Lodging, or Office premises
     * @ORM\ManyToOne(targetEntity="Settings\Entity\NonResidentialType")
     *
     * @var NonResidentialType
     */
    private $propertyType;
    
    /**
     * @ORM\Column(name="other_property", type="string", nullable=true)
     * @var string
     */
    private $otherProperty;

    // /**
    // * This is only obvious if the is Residential is true
    // * $this defines if it is boarding or lodging
    // * @var unknown
    // */
    // private $buildingCategory;
    
    /**
     * @ORM\Column(name="is_always_occupied", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isAlwaysOccupied;

    /**
     * if is always occupied is false
     * This identifies the duration it will not be occupied
     * @ORM\Column(name="not_occupied_duration", type="string", nullable=true)
     * 
     * @var string
     */
    private $notOccupiedDuaration;

    /**
     * Identifies if all locks to the building is in good condition
     * @ORM\Column(name="is_lock_in_good_condition", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isLockInGoodState;

    /**
     * @ORM\Column(name="is_stock_contains_jewelry", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isStockContainsJewelry;

    /**
     * @ORM\Column(name="jewelry", type="string", nullable=true)
     * 
     * @var string
     */
    private $jewelryValue;

    /**
     * @ORM\Column(name="is_anti_theft_device", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isAntiTheftDevice;

    /**
     * @ORM\Column(name="is_previous_claims", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPreviousClaims;

    /**
     * Identifies if there is safe on premesis
     * @ORM\Column(name="is_safe", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isSafe;

    /**
     * A collection of items in the safe
     * and also items to be insured even not in safe
     * @ORM\OneToMany(targetEntity="BuglarySafeDetails", mappedBy="buglary")
     * 
     * @var Collection
     */
    private $safeDetails;

    /**
     * Defines if regular stock are usually taken
     * @ORM\Column(name="is_regular_stock", type="boolean", nullable=true)
     * 
     * @var
     *
     */
    private $isRegularStock;

    /**
     * @ORM\Column(name="is_sole_occupier", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isSoleOccupier;

    /**
     * If Sole occupoier is false, a list of other occupeir should be defined
     * these shuld be available in only residentail
     * @ORM\Column(name="other_occupier", type="text", nullable=true)
     * 
     * @var text
     */
    private $otherOccupier;

    /**
     * This determines how long the ocupier has been at the occupation
     * @ORM\Column(name="ocupy_duration", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $occupyDuration;

    // /**
    // * @ORM\Column(name="premises_description", type="text", nullable=true)
    // * @var text
    // */
    // private $premisesDescription;
    
    /**
     * @ORM\Column(name="is_domestic_servants", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isDomesticServants;

    /**
     * @ORM\Column(name="is_day_security", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isDaySecurity;

    /**
     * @ORM\Column(name="is_night_security", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isNightSecurity;

    /**
     * @ORM\Column(name="is_trade_on_premises", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isTradeOnPremises;

    /**
     * @ORM\Column(name="is_trade_around_premises", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isTradeAroundPremises;

    /**
     * identfies if there has been a previous insurer
     * @ORM\Column(name="is_previous_proposal", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPreviousProposal;

    /**
     * identifies if the insured has been previously declined
     * @ORM\Column(name="is_declined_insurer", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isDeclinedInsurer;
    
    /**
     * @ORM\Column(name="decline_reason", type="text", nullable=true)
     * @var string
     */
    private $declineReason;

    /**
     * Identifies if insured has sufferd loss
     * @ORM\Column(name="is_suffered_loss", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isSufferedLoss;

   
    /**
     * An estimated/expected premium value
     * @ORM\Column(name="expected_premium", type="string", nullable=true)
     * 
     * @var string
     */
    private $expectedPremium;

    // /**
    // *
    // * @var CoverDetails
    // */
    // private $coverDetails;
    public function getId()
    {
        return $this->id;
    }

    public function getIsResidential()
    {
        return $this->isResidential;
    }

    public function setIsResidentail($res)
    {
        $this->isResidential = $res;
        return $this;
    }

    public function getIsSoleOccupier()
    {
        return $this->isSoleOccupier;
    }

    public function setIsSoleOccupier($occ)
    {
        $this->isSoleOccupier = $occ;
        return $this;
    }

    public function getOtherOccupier()
    {
        return $this->otherOccupier;
    }

    public function setOtherOccupier($occ)
    {
        $this->otherOccupier = $occ;
        return $this;
    }

    public function getOccupyDuration()
    {
        return $this->occupyDuration;
    }

    public function setOccupyDuration($occ)
    {
        $this->occupyDuration = $occ;
        return $this;
    }

    public function getIsDomesticServants()
    {
        return $this->isDomesticServants;
    }

    public function setIsDomesticServants($serv)
    {
        $this->isDomesticServants = $serv;
        return $this;
    }

    public function getIsDaySecurity()
    {
        return $this->isDaySecurity;
    }

    public function setIsDaySecurity($set)
    {
        $this->isDaySecurity = $set;
        return $this;
    }

    public function getIsNightSecurity()
    {
        return $this->isNightSecurity;
    }

    public function setIsNightSecurity($sec)
    {
        $this->isNightSecurity = $sec;
        return $this;
    }

    public function getIsTradeOnPremises()
    {
        return $this->isTradeOnPremises;
    }

    public function setIsTradeOnPremises($set)
    {
        $this->isTradeOnPremises = $set;
        return $this;
    }

    public function getIsTradeAroundPremises()
    {
        return $this->isTradeAroundPremises;
    }

    public function setIsTradeAroundPremises($set)
    {
        $this->isTradeAroundPremises = $set;
        return $this;
    }

    public function getIsPreviousProposal()
    {
        return $this->isPreviousProposal;
    }

    public function setIsPreviousProposal($set)
    {
        $this->isPreviousProposal = $set;
        return $this;
    }

    public function getStructureInfor()
    {
        return $this->structureInfo;
    }

    public function setStructureInfor($info)
    {
        $this->structureInfo = $info;
        return $this;
    }

    public function getIsDeclinedInsurer()
    {
        return $this->isDeclinedInsurer;
    }

    public function setIsDeclinedInsurer($set)
    {
        $this->isDeclinedInsurer = $set;
        return $this;
    }

    /**
     *
     * @param BuglarySafeDetails $details            
     */
    public function addSafeDetails($details)
    {
        if (! $this->safeDetails->contains($details)) {
            $this->safeDetails->add($details);
            $details->setBuglary($this);
        }
        return $this;
    }

    /**
     *
     * @param BuglarySafeDetails $details            
     */
    public function removeSafeDetails($details)
    {
        if ($this->safeDetails->contains($details)) {
            $this->safeDetails->removeElement($details);
            $details->setBuglary(NULL);
        }
    }

    /**
     *
     * @return the $propertyType
     */
    public function getPropertyType()
    {
        return $this->propertyType;
    }

    /**
     *
     * @param string $propertyType            
     */
    public function setPropertyType($propertyType)
    {
        $this->propertyType = $propertyType;
        return $this;
    }

    /**
     *
     * @return the $isAlwaysOccupied
     */
    public function getIsAlwaysOccupied()
    {
        return $this->isAlwaysOccupied;
    }

    /**
     *
     * @param boolean $isAlwaysOccupied            
     */
    public function setIsAlwaysOccupied($isAlwaysOccupied)
    {
        $this->isAlwaysOccupied = $isAlwaysOccupied;
        return $this;
    }

    /**
     *
     * @return the $isStockContainsJewelry
     */
    public function getIsStockContainsJewelry()
    {
        return $this->isStockContainsJewelry;
    }

    /**
     *
     * @param boolean $isStockContainsJewelry            
     */
    public function setIsStockContainsJewelry($isStockContainsJewelry)
    {
        $this->isStockContainsJewelry = $isStockContainsJewelry;
        return $this;
    }

    /**
     *
     * @return the $jewelryValue
     */
    public function getJewelryValue()
    {
        return $this->jewelryValue;
    }

    /**
     *
     * @param string $jewelryValue            
     */
    public function setJewelryValue($jewelryValue)
    {
        $this->jewelryValue = $jewelryValue;
        
        return $this;
    }

    /**
     *
     * @return the $isAntiTheftDevice
     */
    public function getIsAntiTheftDevice()
    {
        return $this->isAntiTheftDevice;
    }

    /**
     *
     * @param boolean $isAntiTheftDevice            
     */
    public function setIsAntiTheftDevice($isAntiTheftDevice)
    {
        $this->isAntiTheftDevice = $isAntiTheftDevice;
        return $this;
    }

    /**
     *
     * @return the $isPreviousClaims
     */
    public function getIsPreviousClaims()
    {
        return $this->isPreviousClaims;
    }

    /**
     *
     * @param boolean $isPreviousClaims            
     */
    public function setIsPreviousClaims($isPreviousClaims)
    {
        $this->isPreviousClaims = $isPreviousClaims;
        return $this;
    }

    /**
     *
     * @return the $safeDetails
     */
    public function getSafeDetails()
    {
        return $this->safeDetails;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $safeDetails            
     */
    public function setSafeDetails($safeDetails)
    {
        $this->safeDetails = $safeDetails;
        return $this;
    }

    /**
     *
     * @return the $isRegularStock
     */
    public function getIsRegularStock()
    {
        return $this->isRegularStock;
    }

    /**
     *
     * @param field_type $isRegularStock            
     */
    public function setIsRegularStock($isRegularStock)
    {
        $this->isRegularStock = $isRegularStock;
        return $this;
    }

    /**
     *
     * @return the $isSufferedLoss
     */
    public function getIsSufferedLoss()
    {
        return $this->isSufferedLoss;
    }

    /**
     *
     * @param boolean $isSufferedLoss            
     */
    public function setIsSufferedLoss($isSufferedLoss)
    {
        $this->isSufferedLoss = $isSufferedLoss;
        return $this;
    }

    /**
     *
     * @return the $structureInfo
     */
    public function getStructureInfo()
    {
        return $this->structureInfo;
    }

    /**
     *
     * @param \IMServices\Entity\Text $structureInfo            
     */
    public function setStructureInfo($structureInfo)
    {
        $this->structureInfo = $structureInfo;
        return $this;
    }

    /**
     *
     * @param boolean $isResidential            
     */
    public function setIsResidential($isResidential)
    {
        $this->isResidential = $isResidential;
        return $this;
    }
    /**
     * @return the $notOccupiedDuaration
     */
    public function getNotOccupiedDuaration()
    {
        return $this->notOccupiedDuaration;
    }

    /**
     * @return the $isLockInGoodState
     */
    public function getIsLockInGoodState()
    {
        return $this->isLockInGoodState;
    }

    /**
     * @return the $isSafe
     */
    public function getIsSafe()
    {
        return $this->isSafe;
    }

    /**
     * @return the $expectedPremium
     */
    public function getExpectedPremium()
    {
        return $this->expectedPremium;
    }

    /**
     * @param string $notOccupiedDuaration
     */
    public function setNotOccupiedDuaration($notOccupiedDuaration)
    {
        $this->notOccupiedDuaration = $notOccupiedDuaration;
        return $this;
    }

    /**
     * @param boolean $isLockInGoodState
     */
    public function setIsLockInGoodState($isLockInGoodState)
    {
        $this->isLockInGoodState = $isLockInGoodState;
        return $this;
    }

    /**
     * @param boolean $isSafe
     */
    public function setIsSafe($isSafe)
    {
        $this->isSafe = $isSafe;
        return $this;
    }

    /**
     * @param string $expectedPremium
     */
    public function setExpectedPremium($expectedPremium)
    {
        $this->expectedPremium = $expectedPremium;
        return $this;
    }
    /**
     * @return the $otherProperty
     */
    public function getOtherProperty()
    {
        return $this->otherProperty;
    }

    /**
     * @param string $otherProperty
     */
    public function setOtherProperty($otherProperty)
    {
        $this->otherProperty = $otherProperty;
        return $this;
    }
    /**
     * @return the $declineReason
     */
    public function getDeclineReason()
    {
        return $this->declineReason;
    }

    /**
     * @param string $declineReason
     */
    public function setDeclineReason($declineReason)
    {
        $this->declineReason = $declineReason;
        return $this;
    }



}

?>