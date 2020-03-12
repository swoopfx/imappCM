<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Offer\Entity\Offer;
use Settings\Entity\MotorPurposeOfUse;
use Settings\Entity\Country;
use Settings\Entity\VehicleValueType;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This is the data for single motor insurance
 * MotorData
 *
 * @ORM\Table(name="motor_data")
 * @ORM\Entity
 */
class MotorData
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=true)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="MotorNonStandardAccesory", mappedBy="motorData")
     *
     * @var Collection
     */
    private $nonStandardAccesory;

    /**
     * Defines if there should be a cover for accessory
     *
     * @ORM\Column(name="is_cover_accessory", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isCoverAccessory;

    /**
     *
     * @var boolean @ORM\Column(name="is_sole_owner", type="boolean", nullable=true)
     *     
     */
    private $isSoleOwner = FALSE;

    /**
     * If above is false , owners name should be identified
     * @ORM\Column(name="owner", type="string", nullable=true)
     *
     * @var string
     */
    private $owner;

    /**
     * @ORM\Column(name="is_locked_up", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isLockedUp = FALSE;

    /**
     * This also include tracking devices
     * @ORM\Column(name="is_safety_device", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isSafetyDevice = FALSE;

    /**
     * This also include Learners permit
     * @ORM\Column(name="is_drivers_license", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDriverLicense = FALSE;

    /**
     * This defines if the insured had a previous claims
     * @ORM\Column(name="is_previous_claims", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousClaim = FALSE;

    /**
     * Identifies if the insured has bee declines by a previous insurere
     * @ORM\Column(name="is_decline", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDecline = FALSE;

    /**
     * This includes the reason, insurer and any other details for decline
     * @ORM\Column(name="decline_details", type="text", nullable=true)
     *
     * @var text
     */
    private $declineDetails;

    /**
     * @ORM\Column(name="is_cancel", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCancel = FALSE;

    /**
     * @ORM\Column(name="cancel_reason", type="text", nullable=true)
     *
     * @var text
     */
    private $cancelReason;

    // /**
    // *
    // * @var \Settings\Entity\MotorType @ORM\ManyToOne(targetEntity="Settings\Entity\MotorType")
    // * @ORM\JoinColumns({
    // * @ORM\JoinColumn(name="type_of_vehicle", referencedColumnName="id")
    // * })
    // */
    // private $typeOfVehicle;
    
    /**
     *
     * @var MotorPurposeOfUse @ORM\ManyToOne(targetEntity="Settings\Entity\MotorPurposeOfUse")
     *      @ORM\JoinColumn(name="purpose_of_use", referencedColumnName="id")
     *     
     *      make this a multiple object selection
     */
    private $purposeOfUse;

    /**
     * @ORM\Column(name="is_commercial_use", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCommercialGoods;

    /**
     * @ORM\Column(name="is_commercial_traveling", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCommercialTraveling;

    /**
     * @ORM\Column(name="commercial_details", type="text", nullable=true)
     *
     * @var boolean
     */
    private $commercialDetails;

    /**
     *
     * @var boolean @ORM\Column(name="is_purpose_of_use", type="boolean", nullable=true)
     */
    private $isPuposeOfUse = FALSE;

    /**
     * This defines any extra use for the vehiclle
     * @ORM\Column(name="extra_purpose_of_use", type="text", nullable=true)
     *
     * @var text
     *
     */
    private $extraPurposeOfUse;

    /**
     *
     * @var boolean @ORM\Column(name="is_extended_func", type="boolean", nullable=true)
     */
    private $isExtendedFunc = FALSE;

    /**
     * DEfines thatthe car should cover only the peron who ons the car
     *
     * @var boolean @ORM\Column(name="is_limited_to_only_me", type="boolean", nullable=true)
     *     
     */
    private $isLimitedToOnlyMe = FALSE;

    /**
     * THis is only avialble if isLimitedByOlyMe is false
     *
     * @var text @ORM\Column(name="people_driving_car", type="text", nullable=true)
     *     
     */
    private $peopleDrivingCar;

    /**
     *
     * @var boolean @ORM\Column(name="is_usage_in_nigeria", type="boolean", nullable=true)
     */
    private $isUsageInNigeria = FALSE;

    /**
     *
     * @var Country @ORM\ManyToOne(targetEntity="Settings\Entity\Country")
     *      @ORM\JoinColumn(name="country_of_use", referencedColumnName="id")
     *      this would be defined with mutiple selection
     */
    private $countrieOfUse;

    /**
     *
     * @var boolean ORM\Column(name="is_general_info", type="boolean", nullable=false)
     */
    private $isGeneralInfo = false;

    /**
     *
     * @var MotorOfferGeneralInfo @ORM\OneToOne(targetEntity="MotorOfferGeneralInfo")
     *      @ORM\JoinColumn(name="id_general_info", referencedColumnName="id")
     *     
     */
    private $generalInfo;

    /**
     * @ORM\Column(name="previous_claims", type="text", nullable=true)
     *
     * @var text
     */
    private $previousClaims;

    public function __construct()
    {
        $this->nonStandardAccesory = new ArrayCollection();
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

    /**
     *
     * @return the $nonStandardAccesory
     */
    public function getNonStandardAccesory()
    {
        return $this->nonStandardAccesory;
    }

    /**
     *
     * @param \IMServices\Entity\MotorNonStandardAccesory $nonStandardAccesory            
     */
    public function setNonStandardAccesory($nonStandardAccesory)
    {
        $this->nonStandardAccesory = $nonStandardAccesory;
        return $this;
    }

    /**
     *
     * @param MotorNonStandardAccesory $stan            
     * @return \IMServices\Entity\MotorData
     */
    public function addNonStandardAccesory($stan)
    {
        if (! $this->nonStandardAccesory->contains($stan)) {
            $this->nonStandardAccesory->add($stan);
            $stan->setMotorData($this);
        }
        
        return $this;
    }

    /**
     *
     * @param MotorNonStandardAccesory $stan            
     * @return \IMServices\Entity\MotorData
     */
    public function removeNonStandardAccesory($stan)
    {
        if ($this->nonStandardAccesory->contains($stan)) {
            $this->nonStandardAccesory->removeElement($stan);
            $stan->setMotorData(NULL);
        }
        return $this;
    }

    /**
     * Set typeOfVehicle
     *
     * @param integer $typeOfVehicle            
     *
     * @return MotorData
     */
    public function setTypeOfVehicle($typeOfVehicle)
    {
        $this->typeOfVehicle = $typeOfVehicle;
        
        return $this;
    }

    /**
     * Get typeOfVehicle
     *
     * @return integer
     */
    public function getTypeOfVehicle()
    {
        return $this->typeOfVehicle;
    }

    public function setIsPurposeOfUse($purpose = FALSE)
    {
        $this->isPuposeOfUse = $purpose;
        return $this;
    }

    public function getIsPurposeOfUse()
    {
        return $this->isPuposeOfUse;
    }

    public function setExtraPurposeOfUse($purpose)
    {
        $this->extraPurposeOfUse = $purpose;
        return $this;
    }

    public function getExtraPuposeOfUse()
    {
        return $this->extraPurposeOfUse;
    }

    public function getIsExtendedFunction()
    {
        return $this->isExtendedFunc;
    }

    public function setIsExtendedFunction($func = false)
    {
        $this->isExtendedFunc = $func;
        return $this;
    }

    // /**
    // * Set healthCoverage
    // *
    // * @param string $healthCoverage
    // *
    // * @return MotorData
    // */
    // public function setHealthCoverage($healthCoverage)
    // {
    // $this->healthCoverage = $healthCoverage;
    
    // return $this;
    // }
    
    // /**
    // * Get healthCoverage
    // *
    // * @return string
    // */
    // public function getHealthCoverage()
    // {
    // return $this->healthCoverage;
    // }
    
    // /**
    // * Set damageDeductible
    // *
    // * @param string $damageDeductible
    // *
    // * @return MotorData
    // */
    public function setPurposeOfUse($damageDeductible)
    {
        $this->purposeOfUse = $damageDeductible;
        
        return $this;
    }

    /**
     * Get damageDeductible
     *
     * @return string
     */
    public function getPurposeOfUse()
    {
        return $this->purposeOfUse;
    }

    /**
     * Set courtesyCar
     *
     * @param boolean $courtesyCar            
     *
     * @return MotorData
     */
    public function setCourtesyCar($courtesyCar)
    {
        $this->courtesyCar = $courtesyCar;
        
        return $this;
    }

    /**
     * Get courtesyCar
     *
     * @return boolean
     */
    public function getCourtesyCar()
    {
        return $this->courtesyCar;
    }

    /**
     * Set isExtendedFunc
     *
     * @param boolean $isExtendedFunc            
     *
     * @return MotorData
     */
    public function setIsExtendedFunc($isExtendedFunc)
    {
        $this->isExtendedFunc = $isExtendedFunc;
        
        return $this;
    }

    /**
     * Get isExtendedFunc
     *
     * @return boolean
     */
    public function getIsExtendedFunc()
    {
        return $this->isExtendedFunc;
    }

    /**
     * Get objectMotorData
     *
     * @return \All\Entity\ObjectMotorData
     */
    public function getObjectMotorData()
    {
        return $this->objectMotorData;
    }

    /**
     * Set riskCovered
     *
     * @param \All\Entity\RiskCovered $riskCovered            
     *
     * @return MotorData
     */
    public function setRiskCovered($riskCovered)
    {
        $this->riskCovered = $riskCovered;
        
        return $this;
    }

    /**
     * Get riskCovered
     *
     * @return \All\Entity\RiskCovered
     */
    public function getRiskCovered()
    {
        return $this->riskCovered;
    }

    /**
     * Set vehicleValueType
     *
     * @param VehicleValueType $vehicleValueType            
     *
     * @return MotorData
     */
    public function setVehicleValueType(VehicleValueType $vehicleValueType = null)
    {
        $this->vehicleValueType = $vehicleValueType;
        
        return $this;
    }

    /**
     * Get vehicleValueType
     *
     * @return VehicleValueType
     */
    public function getVehicleValueType()
    {
        return $this->vehicleValueType;
    }

    public function setOffer($offer)
    {
        $this->offer = $offer;
    }

    public function getOffer()
    {
        return $this->offer;
    }

    public function getIsPreviousClaims()
    {
        return $this->isPreviousClaims;
    }

    public function setIsPreviousClaims($set)
    {
        $this->isPreviousClaims = $set;
        return $this;
    }

    public function getPreviousClaims()
    {
        return $this->previousClaims;
    }

    public function setPreviousClaims($claims)
    {
        $this->previousClaims = $claims;
        return $this;
    }

    public function getCoverDetails()
    {
        return $this->coverDetails;
    }

    public function setCoverDetails($set)
    {
        $this->coverDetails = $set;
        return $this;
    }

    /**
     *
     * @return the $isSoleOwner
     */
    public function getIsSoleOwner()
    {
        return $this->isSoleOwner;
    }

    /**
     *
     * @return the $owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     *
     * @return the $isLockedUp
     */
    public function getIsLockedUp()
    {
        return $this->isLockedUp;
    }

    /**
     *
     * @return the $isSafetyDevice
     */
    public function getIsSafetyDevice()
    {
        return $this->isSafetyDevice;
    }

    /**
     *
     * @return the $isDriverLicense
     */
    public function getIsDriverLicense()
    {
        return $this->isDriverLicense;
    }

    /**
     *
     * @return the $isPreviousClaim
     */
    public function getIsPreviousClaim()
    {
        return $this->isPreviousClaim;
    }

    // /**
    // *
    // * @return the $isPreviousDecline
    // */
    // public function getIsPreviousDecline()
    // {
    // return $this->isPreviousDecline;
    // }
    
    /**
     *
     * @return the $declineDetails
     */
    public function getDeclineDetails()
    {
        return $this->declineDetails;
    }

    // /**
    // *
    // * @return the $isPreviousCancel
    // */
    // public function getIsPreviousCancel()
    // {
    // return $this->isPreviousCancel;
    // }
    
    /**
     *
     * @return the $cancelReason
     */
    public function getCancelReason()
    {
        return $this->cancelReason;
    }

    /**
     *
     * @return the $isPuposeOfUse
     */
    public function getIsPuposeOfUse()
    {
        return $this->isPuposeOfUse;
    }

    /**
     *
     * @return the $extraPurposeOfUse
     */
    public function getExtraPurposeOfUse()
    {
        return $this->extraPurposeOfUse;
    }

    /**
     *
     * @return the $isLimitedToOnlyMe
     */
    public function getIsLimitedToOnlyMe()
    {
        return $this->isLimitedToOnlyMe;
    }

    /**
     *
     * @return the $peopleDrivingCar
     */
    public function getPeopleDrivingCar()
    {
        return $this->peopleDrivingCar;
    }

    /**
     *
     * @return the $isUsageInNigeria
     */
    public function getIsUsageInNigeria()
    {
        return $this->isUsageInNigeria;
    }

    /**
     *
     * @return the $countrieOfUse
     */
    public function getCountrieOfUse()
    {
        return $this->countrieOfUse;
    }

    /**
     *
     * @return the $isGeneralInfo
     */
    public function getIsGeneralInfo()
    {
        return $this->isGeneralInfo;
    }

    /**
     *
     * @return the $generalInfo
     */
    public function getGeneralInfo()
    {
        return $this->generalInfo;
    }

    /**
     *
     * @param boolean $isSoleOwner            
     */
    public function setIsSoleOwner($isSoleOwner)
    {
        $this->isSoleOwner = $isSoleOwner;
        return $this;
    }

    /**
     *
     * @param string $owner            
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     *
     * @param boolean $isLockedUp            
     */
    public function setIsLockedUp($isLockedUp)
    {
        $this->isLockedUp = $isLockedUp;
        return $this;
    }

    /**
     *
     * @param boolean $isSafetyDevice            
     */
    public function setIsSafetyDevice($isSafetyDevice)
    {
        $this->isSafetyDevice = $isSafetyDevice;
        return $this;
    }

    /**
     *
     * @param boolean $isDriverLicense            
     */
    public function setIsDriverLicense($isDriverLicense)
    {
        $this->isDriverLicense = $isDriverLicense;
        return $this;
    }

    /**
     *
     * @param boolean $isPreviousClaim            
     */
    public function setIsPreviousClaim($isPreviousClaim)
    {
        $this->isPreviousClaim = $isPreviousClaim;
        return $this;
    }

    // /**
    // *
    // * @param boolean $isPreviousDecline
    // */
    // public function setIsPreviousDecline($isPreviousDecline)
    // {
    // $this->isPreviousDecline = $isPreviousDecline;
    // return $this;
    // }
    
    /**
     *
     * @param \IMServices\Entity\text $declineDetails            
     */
    public function setDeclineDetails($declineDetails)
    {
        $this->declineDetails = $declineDetails;
        return $this;
    }

    // /**
    // *
    // * @param boolean $isPreviousCancel
    // */
    // public function setIsPreviousCancel($isPreviousCancel)
    // {
    // $this->isPreviousCancel = $isPreviousCancel;
    // return $this;
    // }
    
    /**
     *
     * @param \IMServices\Entity\text $cancelReason            
     */
    public function setCancelReason($cancelReason)
    {
        $this->cancelReason = $cancelReason;
        return $this;
    }

    /**
     *
     * @param boolean $isPuposeOfUse            
     */
    public function setIsPuposeOfUse($isPuposeOfUse)
    {
        $this->isPuposeOfUse = $isPuposeOfUse;
        return $this;
    }

    /**
     *
     * @param boolean $isLimitedToOnlyMe            
     */
    public function setIsLimitedToOnlyMe($isLimitedToOnlyMe)
    {
        $this->isLimitedToOnlyMe = $isLimitedToOnlyMe;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\text $peopleDrivingCar            
     */
    public function setPeopleDrivingCar($peopleDrivingCar)
    {
        $this->peopleDrivingCar = $peopleDrivingCar;
        return $this;
    }

    /**
     *
     * @param boolean $isUsageInNigeria            
     */
    public function setIsUsageInNigeria($isUsageInNigeria)
    {
        $this->isUsageInNigeria = $isUsageInNigeria;
        return $this;
    }

    /**
     *
     * @param \Settings\Entity\Country $countrieOfUse            
     */
    public function setCountrieOfUse($countrieOfUse)
    {
        $this->countrieOfUse = $countrieOfUse;
        return $this;
    }

    /**
     *
     * @param boolean $isGeneralInfo            
     */
    public function setIsGeneralInfo($isGeneralInfo)
    {
        $this->isGeneralInfo = $isGeneralInfo;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\MotorOfferGeneralInfo $generalInfo            
     */
    public function setGeneralInfo($generalInfo)
    {
        $this->generalInfo = $generalInfo;
        return $this;
    }

    /**
     *
     * @return the $isDecline
     */
    public function getIsDecline()
    {
        return $this->isDecline;
    }

    /**
     *
     * @param boolean $isDecline            
     */
    public function setIsDecline($isDecline)
    {
        $this->isDecline = $isDecline;
        return $this;
    }

    /**
     *
     * @return the $isCancel
     */
    public function getIsCancel()
    {
        return $this->isCancel;
    }

    /**
     *
     * @param boolean $isCancel            
     */
    public function setIsCancel($isCancel)
    {
        $this->isCancel = $isCancel;
        return $this;
    }

    /**
     *
     * @return the $isCommercialGoods
     */
    public function getIsCommercialGoods()
    {
        return $this->isCommercialGoods;
    }

    /**
     *
     * @param boolean $isCommercialGoods            
     */
    public function setIsCommercialGoods($isCommercialGoods)
    {
        $this->isCommercialGoods = $isCommercialGoods;
        return $this;
    }

    /**
     *
     * @return the $isCommercialTraveling
     */
    public function getIsCommercialTraveling()
    {
        return $this->isCommercialTraveling;
    }

    /**
     *
     * @param boolean $isCommercialTraveling            
     */
    public function setIsCommercialTraveling($isCommercialTraveling)
    {
        $this->isCommercialTraveling = $isCommercialTraveling;
        return $this;
    }

    /**
     *
     * @return the $commercialDetails
     */
    public function getCommercialDetails()
    {
        return $this->commercialDetails;
    }

    /**
     *
     * @param boolean $commercialDetails            
     */
    public function setCommercialDetails($commercialDetails)
    {
        $this->commercialDetails = $commercialDetails;
        return $this;
    }
}
