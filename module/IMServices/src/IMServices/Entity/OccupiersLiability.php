<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\BuildingRoofType;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Settings\Entity\NonResidentialType;
use Settings\Entity\BuildingType;

/**
 * @ORM\Entity
 * @ORM\Table(name="occupiers_liability")
 * 
 * @author otaba
 *        
 */
class OccupiersLiability
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

//     /**
//      * @ORM\Column(name="occupiers_liability", type="string", nullable=true)
//      * 
//      * @var string
//      */
//     private $occupiersName;

    /**
     * @ORM\Column(name="cover_start_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $coverStartDate;

    /**
     * @ORM\Column(name="cover_end_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $coverEndDate;

//     /**
//      * Provides a description of the risk involved
//      * @ORM\Column(name="risk_desc", type="text", nullable=true)
//      * 
//      * @var text
//      */
//     private $riskDesc;

//     /**
//      * @ORM\Column(name="risl_location", type="string", nullable=true)
//      * 
//      * @var string
//      */
//     private $riskLocation;

    /**
     * Defines if builing is in good repair state
     * @ORM\Column(name="is_good_state", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isGoodState;
    
    /**
     * if isGoodStat is false 
     * A description of the condtion
     * @ORM\Column(name="bad_condition", type="text", nullable=true)
     * @var text
     */
    private $badCondition;

    /**
     * Defines if the building is prone to flooding from sea, river,
     * waterway or reservoir?
     * @ORM\Column(name="is_subject_to_flooding", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isSubjectToFlooding;
    
//     /**
//      *  What loss has been sustained in the estate/apartment in Recent 
//      *  years? State date of loss, amount, and cause thereof.
//      *  @ORM\Column(name="estate_loss", type="text", nullable=true)
//      * @var text 
//      */
//     private $estateLoss;

    /**
     * If the above is true
     * Define distance abovennormal water level
     * @ORM\Column(name="distance_from_ground", type="string", nullable=true)
     * 
     * @var string
     */
    private $distanceFromGround;

    /**
     * Defines if
     * @ORM\Column(name="is_xposed_to_fire_storm_quake", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isExposedToFireStormOrQuake;

    /**
     * If above is true state, define this
     * Thihs is the type of Loss Building is opened to
     * @ORM\Column(name="loss_type", type="string", nullable=true)
     * 
     * @var string
     */
    private $lossType;
    
    /**
     * @ORM\Column(name="is_previous_loss", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPreviousLoss;

    /**
     * Details about previous loss
     * What loss has been sustained in the estate/apartment in Recent 
     *  years? State date of loss, amount, and cause thereof.
     * @ORM\Column(name="previous_loss", type="text", nullable=true)
     * 
     * @var text
     */
    private $previousLoss;

    /**
     * Defines if building would be left unOccupied
     * @ORM\Column(name="is_unoccupied", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isUnoccupied;

    /**
     * If above is true
     * Defines how long building will be unoccupied
     * @ORM\Column(name="un_occupied_period", type="string", nullable=true)
     * 
     * @var string
     */
    private $unOccupiedPeriod;

    /**
     * If Service has been previously declined by an insurer or required special details
     * @ORM\Column(name="is_previous_declined", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPreviousDeclined;

    /**
     * If above is true, provide details of the the specila requirements
     * @ORM\Column(name="decline_details", type="text", nullable=true)
     * 
     * @var text
     */
    private $declineDetails;

    // private
    
    /**
     * Defines if any part of the building has been put up for rent
     * @ORM\Column(name="is_for_rent", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isForRent;

    /**
     * Defines the number of paying guest in the building
     * @ORM\Column(name="count_paying_guest", type="string", nullable=true)
     * 
     * @var string
     */
    private $countPayingGuest;

    /**
     * Residentail or NonResidential
     * @ORM\ManyToOne(targetEntity="Settings\Entity\BuildingType");
     *
     * @var BuildingType
     */
    private $buildingType;

    /**
     * Defins the non Residential Type
     * e.g Factory, Boarding or Lodging, or Office premises
     * @ORM\ManyToOne(targetEntity="Settings\Entity\NonResidentialType")
     * 
     * @var NonResidentialType
     */
    private $nonResidetialType;
    
    /**
     * A description of the use of the building
     * @ORM\Column(name="residence_description", type="text", nullable=true)
     * @var text
     */
    private $residenceDesription;

    /**
     * Does premises have Domestic Staff
     * @ORM\Column(name="is_domestic_staff", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isDomesticStaff;

    /**
     * @ORM\OneToMany(targetEntity="OccupiersLiabilityDomesticStaff", mappedBy="occupiersLiability")
     * 
     * @var Collection
     */
    private $domesticStaff;

    /**
     * If the building has a security during the day
     * @ORM\Column(name="is_day_security", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isDaySecurity;

    /**
     * @ORM\Column(name="is_trade_within_building", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isTradeWithinBuilding;

    /**
     * @ORM\Column(name="is_trade_around_building", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isTradeAroundBuilding;
    
    

    /**
     * @ORM\OneToMany(targetEntity="OccupiersLiabilityFamilyMembers", mappedBy="occupiersLiability")
     * 
     * @var Collection
     */
    private $familyMembers;

    /**
     * @return the $isPreviousLoss
     */
    public function getIsPreviousLoss()
    {
        return $this->isPreviousLoss;
    }

    /**
     * @param boolean $isPreviousLoss
     */
    public function setIsPreviousLoss($isPreviousLoss)
    {
        $this->isPreviousLoss = $isPreviousLoss;
        return $this;
    }

    // TODO provide the premium details
    
    /**
     */
    public function __construct()
    {
        $this->familyMembers = new ArrayCollection();
        $this->domesticStaff = new ArrayCollection();
    }

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return the $occupiersName
     */
    public function getOccupiersName()
    {
        return $this->occupiersName;
    }

    /**
     *
     * @return the $coverStartDate
     */
    public function getCoverStartDate()
    {
        return $this->coverStartDate;
    }

    /**
     *
     * @return the $coverEndDate
     */
    public function getCoverEndDate()
    {
        return $this->coverEndDate;
    }

    /**
     *
     * @return the $riskDesc
     */
    public function getRiskDesc()
    {
        return $this->riskDesc;
    }

    /**
     *
     * @return the $riskLocation
     */
    public function getRiskLocation()
    {
        return $this->riskLocation;
    }

    /**
     *
     * @return the $isGoodState
     */
    public function getIsGoodState()
    {
        return $this->isGoodState;
    }

    /**
     *
     * @return the $isSubjectToFlooding
     */
    public function getIsSubjectToFlooding()
    {
        return $this->isSubjectToFlooding;
    }

    /**
     *
     * @return the $distanceFromGround
     */
    public function getDistanceFromGround()
    {
        return $this->distanceFromGround;
    }

    /**
     *
     * @return the $isExposedToFireStormOrQuake
     */
    public function getIsExposedToFireStormOrQuake()
    {
        return $this->isExposedToFireStormOrQuake;
    }

    /**
     *
     * @return the $lossType
     */
    public function getLossType()
    {
        return $this->lossType;
    }

    /**
     *
     * @return the $previousLoss
     */
    public function getPreviousLoss()
    {
        return $this->previousLoss;
    }

    /**
     *
     * @return the $isUnoccupied
     */
    public function getIsUnoccupied()
    {
        return $this->isUnoccupied;
    }

    /**
     *
     * @return the $unOccupiedPeriod
     */
    public function getUnOccupiedPeriod()
    {
        return $this->unOccupiedPeriod;
    }

    /**
     *
     * @return the $isPreviousDeclined
     */
    public function getIsPreviousDeclined()
    {
        return $this->isPreviousDeclined;
    }

    /**
     *
     * @return the $declineDetails
     */
    public function getDeclineDetails()
    {
        return $this->declineDetails;
    }

    /**
     *
     * @return the $isForRent
     */
    public function getIsForRent()
    {
        return $this->isForRent;
    }

    /**
     *
     * @return the $countPayingGuest
     */
    public function getCountPayingGuest()
    {
        return $this->countPayingGuest;
    }

    /**
     *
     * @return the $buildingType
     */
    public function getBuildingType()
    {
        return $this->buildingType;
    }

    /**
     *
     * @return the $nonResidetialType
     */
    public function getNonResidetialType()
    {
        return $this->nonResidetialType;
    }

    /**
     *
     * @return the $isDomesticStaff
     */
    public function getIsDomesticStaff()
    {
        return $this->isDomesticStaff;
    }

    /**
     *
     * @return the $domesticStaff
     */
    public function getDomesticStaff()
    {
        return $this->domesticStaff;
    }

    /**
     *
     * @return the $isDaySecurity
     */
    public function getIsDaySecurity()
    {
        return $this->isDaySecurity;
    }

    /**
     *
     * @return the $isTradeWithinBuilding
     */
    public function getIsTradeWithinBuilding()
    {
        return $this->isTradeWithinBuilding;
    }

    /**
     *
     * @return the $isTradeAroundBuilding
     */
    public function getIsTradeAroundBuilding()
    {
        return $this->isTradeAroundBuilding;
    }

    /**
     *
     * @return the $familyMembers
     */
    public function getFamilyMembers()
    {
        return $this->familyMembers;
    }

    /**
     *
     * @param string $occupiersName            
     */
    public function setOccupiersName($occupiersName)
    {
        $this->occupiersName = $occupiersName;
        return $this;
    }

    /**
     *
     * @param DateTime $coverStartDate            
     */
    public function setCoverStartDate($coverStartDate)
    {
        $this->coverStartDate = $coverStartDate;
        return $this;
    }
    

    /**
     *
     * @param DateTime $coverEndDate            
     */
    public function setCoverEndDate($coverEndDate)
    {
        $this->coverEndDate = $coverEndDate;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\text $riskDesc            
     */
    public function setRiskDesc($riskDesc)
    {
        $this->riskDesc = $riskDesc;
        return $this;
    }

    /**
     *
     * @param string $riskLocation            
     */
    public function setRiskLocation($riskLocation)
    {
        $this->riskLocation = $riskLocation;
        return $this;
    }

    /**
     *
     * @param boolean $isGoodState            
     */
    public function setIsGoodState($isGoodState)
    {
        $this->isGoodState = $isGoodState;
        return $this;
    }

    /**
     *
     * @param boolean $isSubjectToFlooding            
     */
    public function setIsSubjectToFlooding($isSubjectToFlooding)
    {
        $this->isSubjectToFlooding = $isSubjectToFlooding;
        return $this;
    }

    /**
     *
     * @param string $distanceFromGround            
     */
    public function setDistanceFromGround($distanceFromGround)
    {
        $this->distanceFromGround = $distanceFromGround;
        return $this;
    }

    /**
     *
     * @param boolean $isExposedToFireStormOrQuake            
     */
    public function setIsExposedToFireStormOrQuake($isExposedToFireStormOrQuake)
    {
        $this->isExposedToFireStormOrQuake = $isExposedToFireStormOrQuake;
        return $this;
    }

    /**
     *
     * @param string $lossType            
     */
    public function setLossType($lossType)
    {
        $this->lossType = $lossType;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\text $previousLoss            
     */
    public function setPreviousLoss($previousLoss)
    {
        $this->previousLoss = $previousLoss;
        return $this;
    }

    /**
     *
     * @param boolean $isUnoccupied            
     */
    public function setIsUnoccupied($isUnoccupied)
    {
        $this->isUnoccupied = $isUnoccupied;
        return $this;
    }

    /**
     *
     * @param string $unOccupiedPeriod            
     */
    public function setUnOccupiedPeriod($unOccupiedPeriod)
    {
        $this->unOccupiedPeriod = $unOccupiedPeriod;
        return $this;
    }

    /**
     *
     * @param boolean $isPreviousDeclined            
     */
    public function setIsPreviousDeclined($isPreviousDeclined)
    {
        $this->isPreviousDeclined = $isPreviousDeclined;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\text $declineDetails            
     */
    public function setDeclineDetails($declineDetails)
    {
        $this->declineDetails = $declineDetails;
        return $this;
    }

    /**
     *
     * @param boolean $isForRent            
     */
    public function setIsForRent($isForRent)
    {
        $this->isForRent = $isForRent;
        return $this;
    }

    /**
     *
     * @param string $countPayingGuest            
     */
    public function setCountPayingGuest($countPayingGuest)
    {
        $this->countPayingGuest = $countPayingGuest;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\BuildingType $buildingType            
     */
    public function setBuildingType($buildingType)
    {
        $this->buildingType = $buildingType;
        return $this;
    }

    /**
     *
     * @param \Settings\Entity\NonResidentialType $nonResidetialType            
     */
    public function setNonResidetialType($nonResidetialType)
    {
        $this->nonResidetialType = $nonResidetialType;
        return $this;
    }

    /**
     *
     * @param boolean $isDomesticStaff            
     */
    public function setIsDomesticStaff($isDomesticStaff)
    {
        $this->isDomesticStaff = $isDomesticStaff;
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $domesticStaff            
     */
    public function addDomesticStaff($domesticStaff)
    {
        if (! $this->domesticStaff->contains($domesticStaff)) {
            $this->domesticStaff->add($domesticStaff);
        }
        return $this;
    }

    public function removeDomesticStaff($domesticStaff)
    {
        if ($this->domesticStaff->contains($domesticStaff)) {
            $this->domesticStaff->removeElement($domesticStaff);
        }
        return $this;
    }

    /**
     *
     * @param boolean $isDaySecurity            
     */
    public function setIsDaySecurity($isDaySecurity)
    {
        $this->isDaySecurity = $isDaySecurity;
        return $this;
    }

    /**
     *
     * @param boolean $isTradeWithinBuilding            
     */
    public function setIsTradeWithinBuilding($isTradeWithinBuilding)
    {
        $this->isTradeWithinBuilding = $isTradeWithinBuilding;
        return $this;
    }

    /**
     *
     * @param boolean $isTradeAroundBuilding            
     */
    public function setIsTradeAroundBuilding($isTradeAroundBuilding)
    {
        $this->isTradeAroundBuilding = $isTradeAroundBuilding;
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $familyMembers            
     */
    public function addFamilyMembers($familyMembers)
    {
        if (! $this->familyMembers->contains($familyMembers)) {
            $this->familyMembers->add($familyMembers);
        }
        return $this;
    }

    public function removeFamilyMembers($familyMembers)
    {
        if ($this->familyMembers->contains($familyMembers)) {
            $this->familyMembers->removeElement($familyMembers);
        }
        
        return $this;
    }
    /**
     * @return the $badCondition
     */
    public function getBadCondition()
    {
        return $this->badCondition;
    }

    /**
     * @return the $estateLoss
     */
    public function getEstateLoss()
    {
        return $this->estateLoss;
    }

    /**
     * @param \IMServices\Entity\text $badCondition
     */
    public function setBadCondition($badCondition)
    {
        $this->badCondition = $badCondition;
        return $this;
    }

    /**
     * @param \IMServices\Entity\text $estateLoss
     */
    public function setEstateLoss($estateLoss)
    {
        $this->estateLoss = $estateLoss;
        return $this;
    }
    /**
     * @return the $residenceDesription
     */
    public function getResidenceDesription()
    {
        return $this->residenceDesription;
    }

    /**
     * @param \IMServices\Entity\text $residenceDesription
     */
    public function setResidenceDesription($residenceDesription)
    {
        $this->residenceDesription = $residenceDesription;
        return $this;
    }


}

