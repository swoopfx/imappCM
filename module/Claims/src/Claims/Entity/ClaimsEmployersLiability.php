<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @ORM\Entity
 * @@ORM\Table(name="claims_employers_liability")
 * @author otaba
 *        
 */
class ClaimsEmployersLiability
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Name of the injured
     *
     * @ORM\Column(name="injured_name", type="string", nullable=true)
     * @var string
     */
    private $injuredName;

    /**
     * Age of the injured
     *
     *  @ORM\Column(name="injured_age", type="string", nullable=true)
     * @var string
     */
    private $injuredAge;

    /**
     * Addrss of the injured
     *
     *  @ORM\Column(name="injured_address", type="text", nullable=true)
     * @var string
     */
    private $injuredAddress;

    /**
     *
     *  @ORM\Column(name="is_injured_direct_employ", type="boolean", nullable=true)
     * @var boolean
     */
    private $isInjuredDirectEmploy;

    /**
     * The 
     *  @ORM\Column(name="injured_employment", type="string", nullable=true)
     * @var string
     */
    private $injuredEmployment;

    /**
     * How long has injured been employed
     *  @ORM\Column(name="injured_period_in_service", type="string", nullable=true)
     * @var string
     */
    private $injuredPeriodInService;

    /**
     *
     *  @ORM\Column(name="accident_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $accidentDate;

    /**
     *
     *  @ORM\Column(name="accident_desc", type="text", nullable=true)
     * @var string
     */
    private $accidentDesc;

    // including date time cause and incident

    /**
     *
     *  @ORM\Column(name="whom_accident_reported_to", type="string", nullable=true)
     * @var string
     */
    private $whomAccidentWasReported;

    /**
     *
     *  @ORM\Column(name="accident_witness", type="text", nullable=true)
     * @var string
     */
    private $accidentWitness;

    /**
     * If acccident is connected to use of a machinery
     *
     *  @ORM\Column(name="is_connected_to_machinery", type="boolean", nullable=true)
     * @var boolean
     */
    private $isConnectedToMachinery;

    /**
     *
     *  @ORM\Column(name="machinery_name", type="string", nullable=true)
     * @var boolean
     */
    private $machineryName;

    /**
     * If the injury resulted to death
     *
     *  @ORM\Column(name="is_injury_rersult_to_death", type="boolean", nullable=true)
     * @var boolean
     */
    private $isInjuryResultToDeath;

    /**
     * Identifies if the injured was intoxicated during accident
     *
     *  @ORM\Column(name="is_injured_intoxicated", type="boolean", nullable=true)
     * @var boolean
     */
    private $isInjuredIntoxicated;

    /**
     * Details about the intoxication
     *
     *  @ORM\Column(name="intoxication_details", type="string", nullable=true)
     * @var string
     */
    private $intoxicationDetails;

    /**
     *
     *  @ORM\Column(name="is_due_to_neglegence", type="boolean", nullable=true)
     * @var boolean
     */
    private $isDueToNegelence;

    /**
     *
     *  @ORM\Column(name="neglegence_details", type="text", nullable=true)
     * @var string
     */
    private $neglegenceDetails;

    /**
     * Estimeted period injured might be disabled
     *
     *   @ORM\Column(name="disablement_period", type="string", nullable=true)
     * @var string
     */
    private $disablementPeriod;

    /**
     *
     * @ORM\OneToMany(targetEntity="ClaimsEmployersLiabilityWagesSettlement", mappedBy="claimsEmployerLiability")
     * @var Collection
     */
    private $wageSettlement;
    
    
    /**
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims", inversedBy="claimsEmployeeLiability")
     * @var CLaims
     */
    private $claims;

    // TODO - Insert your code here
    public function __construct()
    {
        $this->wageSettlement = new ArrayCollection();
    }
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getInjuredName()
    {
        return $this->injuredName;
    }

    /**
     * @return string
     */
    public function getInjuredAge()
    {
        return $this->injuredAge;
    }

    /**
     * @return string
     */
    public function getInjuredAddress()
    {
        return $this->injuredAddress;
    }

    /**
     * @return boolean
     */
    public function getIsInjuredDirectEmploy()
    {
        return $this->isInjuredDirectEmploy;
    }

    /**
     * @return string
     */
    public function getInjuredEmployment()
    {
        return $this->injuredEmployment;
    }

    /**
     * @return string
     */
    public function getInjuredPeriodInService()
    {
        return $this->injuredPeriodInService;
    }

    /**
     * @return \DateTime
     */
    public function getAccidentDate()
    {
        return $this->accidentDate;
    }

    /**
     * @return string
     */
    public function getAccidentDesc()
    {
        return $this->accidentDesc;
    }

    /**
     * @return string
     */
    public function getWhomAccidentWasReported()
    {
        return $this->whomAccidentWasReported;
    }

    /**
     * @return string
     */
    public function getAccidentWitness()
    {
        return $this->accidentWitness;
    }

    /**
     * @return boolean
     */
    public function getIsConnectedToMachinery()
    {
        return $this->isConnectedToMachinery;
    }

    /**
     * @return boolean
     */
    public function getMachineryName()
    {
        return $this->machineryName;
    }

    /**
     * @return boolean
     */
    public function getIsInjuryResultToDeath()
    {
        return $this->isInjuryResultToDeath;
    }

    /**
     * @return boolean
     */
    public function getIsInjuredIntoxicated()
    {
        return $this->isInjuredIntoxicated;
    }

    /**
     * @return string
     */
    public function getIntoxicationDetails()
    {
        return $this->intoxicationDetails;
    }

    /**
     * @return boolean
     */
    public function getIsDueToNegelence()
    {
        return $this->isDueToNegelence;
    }

    /**
     * @return string
     */
    public function getNeglegenceDetails()
    {
        return $this->neglegenceDetails;
    }

    /**
     * @return string
     */
    public function getDisablementPeriod()
    {
        return $this->disablementPeriod;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWageSettlement()
    {
        return $this->wageSettlement;
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
     * @param string $injuredName
     */
    public function setInjuredName($injuredName)
    {
        $this->injuredName = $injuredName;
        return $this;
    }

    /**
     * @param string $injuredAge
     */
    public function setInjuredAge($injuredAge)
    {
        $this->injuredAge = $injuredAge;
        return $this;
    }

    /**
     * @param string $injuredAddress
     */
    public function setInjuredAddress($injuredAddress)
    {
        $this->injuredAddress = $injuredAddress;
        return $this;
    }

    /**
     * @param boolean $IsInjuredDirectEmploy
     */
    public function setIsInjuredDirectEmploy($isInjuredDirectEmploy)
    {
        $this->isInjuredDirectEmploy = $isInjuredDirectEmploy;
        return $this;
    }

    /**
     * @param string $injuredEmployment
     */
    public function setInjuredEmployment($injuredEmployment)
    {
        $this->injuredEmployment = $injuredEmployment;
        return $this;
    }

    /**
     * @param string $injuredPeriodInService
     */
    public function setInjuredPeriodInService($injuredPeriodInService)
    {
        $this->injuredPeriodInService = $injuredPeriodInService;
        return $this;
    }

    /**
     * @param \DateTime $accidentDate
     */
    public function setAccidentDate($accidentDate)
    {
        $this->accidentDate = $accidentDate;
        return $this;
    }

    /**
     * @param string $accidentDesc
     */
    public function setAccidentDesc($accidentDesc)
    {
        $this->accidentDesc = $accidentDesc;
        return $this;
    }

    /**
     * @param string $whomAccidentWasReported
     */
    public function setWhomAccidentWasReported($whomAccidentWasReported)
    {
        $this->whomAccidentWasReported = $whomAccidentWasReported;
        return $this;
    }

    /**
     * @param string $accidentWitness
     */
    public function setAccidentWitness($accidentWitness)
    {
        $this->accidentWitness = $accidentWitness;
        return $this;
    }

    /**
     * @param boolean $isConnectedToMachinery
     */
    public function setIsConnectedToMachinery($isConnectedToMachinery)
    {
        $this->isConnectedToMachinery = $isConnectedToMachinery;
        return $this;
    }

    /**
     * @param boolean $machineryName
     */
    public function setMachineryName($machineryName)
    {
        $this->machineryName = $machineryName;
        return $this;
    }

    /**
     * @param boolean $isInjuryResultToDeath
     */
    public function setIsInjuryResultToDeath($isInjuryResultToDeath)
    {
        $this->isInjuryResultToDeath = $isInjuryResultToDeath;
        return $this;
    }

    /**
     * @param boolean $isInjuredIntoxicated
     */
    public function setIsInjuredIntoxicated($isInjuredIntoxicated)
    {
        $this->isInjuredIntoxicated = $isInjuredIntoxicated;
        return $this;
    }

    /**
     * @param string $intoxicationDetails
     */
    public function setIntoxicationDetails($intoxicationDetails)
    {
        $this->intoxicationDetails = $intoxicationDetails;
        return $this;
    }

    /**
     * @param boolean $isDueToNegelence
     */
    public function setIsDueToNegelence($isDueToNegelence)
    {
        $this->isDueToNegelence = $isDueToNegelence;
        return $this;
    }

    /**
     * @param string $neglegenceDetails
     */
    public function setNeglegenceDetails($neglegenceDetails)
    {
        $this->neglegenceDetails = $neglegenceDetails;
        return $this;
    }

    /**
     * @param string $disablementPeriod
     */
    public function setDisablementPeriod($disablementPeriod)
    {
        $this->disablementPeriod = $disablementPeriod;
        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $wageSettlement
     */
//     public function setWageSettlement($wageSettlement)
//     {
//         $this->wageSettlement = $wageSettlement;
//         return $this;
//     }

    public function addWageSettlement($wageSettlement){
        if(!$this->wageSettlement->contains($wageSettlement)){
            
        }
    }
    
    
    public function removeWageSettlement($wageSettlement){
        
    }
    /**
     * @return \Claims\Entity\CLaims
     */
    public function getClaims()
    {
        return $this->claims;
    }

    /**
     * @param \Claims\Entity\CLaims $claims
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;
        return $this;
    }


}

