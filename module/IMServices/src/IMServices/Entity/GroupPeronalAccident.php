<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\GroupPersonalAccidentType;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_personal_accident")
 * 
 * @author otaba
 *        
 */
class GroupPeronalAccident
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * defines if the personalGroup is either Fixed Benefit or Wage Based cover
     * @ORM\ManyToOne(targetEntity="Settings\Entity\GroupPersonalAccidentType")
     * 
     * @var GroupPersonalAccidentType
     */
    private $personalAccidentType;

    /**
     * @ORM\OneToMany(targetEntity="IMServices\Entity\GroupPersonalFixedDetails", mappedBy="groupPersonalAccident")
     * 
     * @var Collection
     *
     */
    private $fixedDetails;

    /**
     * This defines and creates information for wages bbusiness
     * @ORM\OneToMany(targetEntity="IMServices\Entity\GroupPersonalWagesDetails", mappedBy="groupPersonalAccident")
     * 
     * @var Collection
     */
    private $wagesDetails;

    /**
     * What emoluments( if any) are to be included in addition to basic salary or wage?
     * @ORM\Column(name="is_include_emolument", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isIncludeEmoluments;

    /**
     * @ORM\Column(name="emoluments", type="string", nullable=true)
     * 
     * @var string
     */
    private $emoluments;

    /**
     * This defines the highest emolument that should be paid to any one individual
     * State the amount which for the purpose of this insurance is to be taken as salary payable to any one person
     * @ORM\Column(name="highest_emolument_paid", type="string", nullable=true)
     * 
     * @var string
     */
    private $highestEmolumentPaid;

    /**
     * This defines that the cover is resytricted to accidents only
     * @ORM\Column(name="is_retricted", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isRestrictedToEmployeeAccident;

    /**
     * This is only availble if the isRestricted is true
     * and a list of restriction would be defined in a text area
     *
     * @ORM\Column(name="restriction", type="text", nullable=true)
     * 
     * @var text
     */
    private $restriction;

    /**
     * Attest that people are in sound health
     * @ORM\Column(name="is_persons_in_sound_health", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPersonsInSoundHealth;

    /**
     * travel to a considerable extent by air or by motor car
     * in the course of his or her duties
     * @ORM\Column(name="is_travel", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isTravel;

    /**
     * Name, Post and travel details
     * @ORM\Column(name="travel_details", type="text", nullable=true)
     * 
     * @var text
     */
    private $travelDetails;

    /**
     * Will any of the persons to be insured
     * Use machinery
     * @ORM\Column(name="is_use_machinery", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isUseMachinery;

    /**
     * Type and use of macine,
     * Name of person who is covered for this
     * @ORM\Column(name="machine_details", type="text", nullable=true)
     * 
     * @var text
     */
    private $machineDetails;

    /**
     * @ORM\Column(name="is_other_extension", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isOtherExtension;

    /**
     * @ORM\Column(name="extension_details", type="text", nullable=true)
     * 
     * @var text
     */
    private $extensionDetails;

    /**
     * @ORM\Column(name="is_previous_group_accident", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPreviousGroupAccident;

    /**
     * @ORM\Column(name="is_declined", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isDeclined;

    /**
     * @ORM\Column(name="decline_details", type="text", nullable=true)
     * 
     * @var text
     */
    private $declineDetails;

    /**
     * @ORM\Column(name="is_terminated", type="string", nullable=true)
     * 
     * @var boolean
     */
    private $isTerminated;

    /**
     * @ORM\Column(name="terminated_details", type="text", nullable=true)
     * 
     * @var text
     */
    private $terminatedDetails;

    /**
     * @ORM\Column(name="is_special_condition", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isSpecialCondition;

    /**
     * @ORM\Column(name="condtition_details", type="text", nullable=true)
     * 
     * @var text
     */
    private $conditionDetails;

    /**
     * Are there any additional facts likely to affect the proposed
     * Insurance which should be disclosed to the underwriter?
     * @ORM\Column(name="additional_facts", type="text", nullable=true)
     * 
     * @var text
     */
    private $addtionalFacts;

    public function __construct()
    {
        $this->fixedDetails = new ArrayCollection();
        $this->wagesDetails = new ArrayCollection();
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return the $personalAccidentType
     */
    public function getPersonalAccidentType()
    {
        return $this->personalAccidentType;
    }

    /**
     * @param \Settings\Entity\GroupPersonalAccidentType $personalAccidentType
     */
    public function setPersonalAccidentType($personalAccidentType)
    {
        $this->personalAccidentType = $personalAccidentType;
        return $this;
    }

    /**
     * @return the $fixedDetails
     */
    public function getFixedDetails()
    {
        return $this->fixedDetails;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $fixedDetails
     */
    public function setFixedDetails($fixedDetails)
    {
        $this->fixedDetails = $fixedDetails;
        return $this;
    }

    /**
     * @return the $wagesDetails
     */
    public function getWagesDetails()
    {
        return $this->wagesDetails;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $wagesDetails
     */
    public function setWagesDetails($wagesDetails)
    {
        $this->wagesDetails = $wagesDetails;
        
        return $this;
    }

    /**
     * @return the $isIncludeEmoluments
     */
    public function getIsIncludeEmoluments()
    {
        return $this->isIncludeEmoluments;
    }

    /**
     * @param boolean $isIncludeEmoluments
     */
    public function setIsIncludeEmoluments($isIncludeEmoluments)
    {
        $this->isIncludeEmoluments = $isIncludeEmoluments;
        return $this;
    }

    /**
     * @return the $emoluments
     */
    public function getEmoluments()
    {
        return $this->emoluments;
    }

    /**
     * @param string $emoluments
     */
    public function setEmoluments($emoluments)
    {
        $this->emoluments = $emoluments;
        return $this;
    }

    /**
     * @return the $highestEmolumentPaid
     */
    public function getHighestEmolumentPaid()
    {
        return $this->highestEmolumentPaid;
    }

    /**
     * @param string $highestEmolumentPaid
     */
    public function setHighestEmolumentPaid($highestEmolumentPaid)
    {
        $this->highestEmolumentPaid = $highestEmolumentPaid;
        return $this;
    }

    /**
     * @return the $isRestrictedToEmployeeAccident
     */
    public function getIsRestrictedToEmployeeAccident()
    {
        return $this->isRestrictedToEmployeeAccident;
    }

    /**
     * @param boolean $isRestrictedToEmployeeAccident
     */
    public function setIsRestrictedToEmployeeAccident($isRestrictedToEmployeeAccident)
    {
        $this->isRestrictedToEmployeeAccident = $isRestrictedToEmployeeAccident;
        return $this;
    }

    /**
     * @return the $restriction
     */
    public function getRestriction()
    {
        return $this->restriction;
    }

    /**
     * @param \IMServices\Entity\text $restriction
     */
    public function setRestriction($restriction)
    {
        $this->restriction = $restriction;
        return $this;
    }

    /**
     * @return the $isPersonsInSoundHealth
     */
    public function getIsPersonsInSoundHealth()
    {
        return $this->isPersonsInSoundHealth;
    }

    /**
     * @param boolean $isPersonsInSoundHealth
     */
    public function setIsPersonsInSoundHealth($isPersonsInSoundHealth)
    {
        $this->isPersonsInSoundHealth = $isPersonsInSoundHealth;
        return $this;
    }

    /**
     * @return the $isTravel
     */
    public function getIsTravel()
    {
        return $this->isTravel;
    }

    /**
     * @param boolean $isTravel
     */
    public function setIsTravel($isTravel)
    {
        $this->isTravel = $isTravel;
        return $this;
    }

    /**
     * @return the $travelDetails
     */
    public function getTravelDetails()
    {
        return $this->travelDetails;
    }

    /**
     * @param \IMServices\Entity\text $travelDetails
     */
    public function setTravelDetails($travelDetails)
    {
        $this->travelDetails = $travelDetails;
        return $this;
    }

    /**
     * @return the $isUseMachinery
     */
    public function getIsUseMachinery()
    {
        return $this->isUseMachinery;
    }

    /**
     * @param boolean $isUseMachinery
     */
    public function setIsUseMachinery($isUseMachinery)
    {
        $this->isUseMachinery = $isUseMachinery;
        return $this;
    }

    /**
     * @return the $machineDetails
     */
    public function getMachineDetails()
    {
        return $this->machineDetails;
    }

    /**
     * @param \IMServices\Entity\text $machineDetails
     */
    public function setMachineDetails($machineDetails)
    {
        $this->machineDetails = $machineDetails;
        return $this;
        
    }

    /**
     * @return the $isOtherExtension
     */
    public function getIsOtherExtension()
    {
        return $this->isOtherExtension;
    }

    /**
     * @param boolean $isOtherExtension
     */
    public function setIsOtherExtension($isOtherExtension)
    {
        $this->isOtherExtension = $isOtherExtension;
        return $this;
    }

    /**
     * @return the $extensionDetails
     */
    public function getExtensionDetails()
    {
        return $this->extensionDetails;
    }

    /**
     * @param \IMServices\Entity\text $extensionDetails
     */
    public function setExtensionDetails($extensionDetails)
    {
        $this->extensionDetails = $extensionDetails;
        return $this;
    }

    /**
     * @return the $isPreviousGroupAccident
     */
    public function getIsPreviousGroupAccident()
    {
        return $this->isPreviousGroupAccident;
    }

    /**
     * @param boolean $isPreviousGroupAccident
     */
    public function setIsPreviousGroupAccident($isPreviousGroupAccident)
    {
        $this->isPreviousGroupAccident = $isPreviousGroupAccident;
        return $this;
    }

    /**
     * @return the $isDeclined
     */
    public function getIsDeclined()
    {
        return $this->isDeclined;
    }

    /**
     * @param boolean $isDeclined
     */
    public function setIsDeclined($isDeclined)
    {
        $this->isDeclined = $isDeclined;
        return $this;
    }

    /**
     * @return the $declineDetails
     */
    public function getDeclineDetails()
    {
        return $this->declineDetails;
    }

    /**
     * @param \IMServices\Entity\text $declineDetails
     */
    public function setDeclineDetails($declineDetails)
    {
        $this->declineDetails = $declineDetails;
        return $this;
    }

    /**
     * @return the $isTerminated
     */
    public function getIsTerminated()
    {
        return $this->isTerminated;
    }

    /**
     * @param boolean $isTerminated
     */
    public function setIsTerminated($isTerminated)
    {
        $this->isTerminated = $isTerminated;
        return $this;
    }

    /**
     * @return the $terminatedDetails
     */
    public function getTerminatedDetails()
    {
        return $this->terminatedDetails;
    }

    /**
     * @param \IMServices\Entity\text $terminatedDetails
     */
    public function setTerminatedDetails($terminatedDetails)
    {
        $this->terminatedDetails = $terminatedDetails;
        return $this;
    }

    /**
     * @return the $isSpecialCondition
     */
    public function getIsSpecialCondition()
    {
        return $this->isSpecialCondition;
    }

    /**
     * @param boolean $isSpecialCondition
     */
    public function setIsSpecialCondition($isSpecialCondition)
    {
        $this->isSpecialCondition = $isSpecialCondition;
        return  $this;
    }

    /**
     * @return the $conditionDetails
     */
    public function getConditionDetails()
    {
        return $this->conditionDetails;
    }

    /**
     * @param \IMServices\Entity\text $conditionDetails
     */
    public function setConditionDetails($conditionDetails)
    {
        $this->conditionDetails = $conditionDetails;
        return $this;
    }

    /**
     * @return the $addtionalFacts
     */
    public function getAddtionalFacts()
    {
        return $this->addtionalFacts;
    }

    /**
     * @param \IMServices\Entity\text $addtionalFacts
     */
    public function setAddtionalFacts($addtionalFacts)
    {
        $this->addtionalFacts = $addtionalFacts;
        return $this;
    }

}


