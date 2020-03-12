<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Object\Entity\Object;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Offer\Entity\Offer;
use Proposal\Entity\Proposal;
// use Policy\Entity\PolicyFloat;
use Settings\Entity\Currency;
use Settings\Entity\SoilCondition;

/**
 * This also works for erection alll risk
 *
 * @ORM\Entity
 * @ORM\Table(name="contract_all_risk")
 *
 * @author otaba
 *        
 */
class ContractAllRisk
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
     * @ORM\Column(name="contract_name", type="string", nullable=true)
     * This is equivalent to the title of the contract
     *
     * @var string
     */
    private $contractName;

    /**
     *
     * @ORM\Column(name="contract_address", type="string", nullable=true)
     *
     * @var string
     */
    private $contractAddress;

//     /**
//      * This is the contract value
//      *
//      * @ORM\Column(name="contract_value", type="string", nullable=true)
//      * @var string
//      */
//     private $value;

    /**
     * Name of the supervising engineer
     *
     * @ORM\Column(name="supervising_engineer", type="string", nullable=true)
     *
     * @var string
     */
    private $supervisingEngineer;

    /**
     *
     * @ORM\Column(name="nearest_airport", type="string", nullable=true)
     *
     * @var string
     *
     */
    private $nearestAirport;

    /**
     *
     * @ORM\Column(name="nearest_landmark", type="string", nullable=true)
     *
     * @var string
     *
     */
    private $nearestLandmark;

    /**
     *
     * @ORM\Column(name="contact_description", type="text", nullable=true)
     *
     * @var string
     */
    private $contractDescription;

    /**
     * Main Contractor of the Contract
     *
     * @ORM\Column(name="main_contractor", type="string", nullable=true)
     *
     * @var string
     */
    private $mainContractor;

    /**
     * Identity of Consulting Engioneer
     *
     * @ORM\Column(name="consulting_engineer", type="string", nullable=true)
     *
     * @var string
     */
    private $consultingEngineer;

    /**
     * Start date of the Contract
     *
     * @ORM\Column(name="contract_start_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $contractStartDate;

    /**
     * This identifies the date of expiration of the contract
     *
     * @ORM\Column(name="contract_end_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $contractEndDate;

    /**
     * Identifis if the project has a testing period
     *
     * @ORM\Column(name="is_testing", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isTesting;

    /**
     *
     * @ORM\Column(name="testing_start_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $testingStartDate;

    /**
     *
     * @ORM\Column(name="testing_end_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $testingEndDate;

    /**
     * IDentifies if maintenance is handle on the contract
     *
     * @ORM\Column(name="is_maintenance", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isMaintenance;

    /**
     * maintenance start date
     *
     * @ORM\Column(name="maintenance_start_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $maintenanceStartDate;

    /**
     * maintenance start date
     *
     * @ORM\Column(name="maintenance_end_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $maintenanceEndDate;

    /**
     * This indentifies if a similar contractor erection has taken place before
     *
     * @ORM\Column(name="is_similar_construction", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isSimilarConstruction;

    /**
     *
     * @ORM\Column(name="previous_construction_name", type="string", nullable=true)
     *
     * @var string
     */
    private $previousContructionName;

    /**
     * Identifies if current project is an extension of a previous work
     *
     * @ORM\Column(name="is_extension", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isExtension;

    /**
     * This is a brif information of the existing contract/plant the is being extendrd
     *
     * @ORM\Column(name="existing_plant", type="text", nullable=true)
     *
     * @var string
     */
    private $existingPlant;

    /**
     * Identifies if civil and engineering work has been completed
     *
     * @ORM\Column(name="is_civil_completed", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCivilCompleted;

    /**
     * if above is false
     * DEscribe outstanding civil and engineering work left
     *
     * @ORM\Column(name="civil_work", type="text", nullable=true)
     *
     * @var unknown
     */
    private $civilWork;

    /**
     * This defines the there is an agravated risk
     * If there is , the list below is displayed
     *
     * @ORM\Column(name="is_agaravated_risk", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAgravatedRisk;

    /**
     * Is active if there is agravated risk of fire
     *
     * @ORM\Column(name="is_agravated_fire", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAgravatedFire;

    /**
     * It is active if there is agravated risk of explosion
     *
     * @ORM\Column(name="is_agravated_explosion", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAgravatedExplosion;

    /**
     * identifies if area is prone to earth quake
     *
     * @ORM\Column(name="is_earth_quake", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isEarthQuake;

    /**
     * Identifies soil Conditions in the vicinity
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\SoilCondition")
     *
     * @var SoilCondition
     */
    private $soilCondition;

    /**
     *
     * @ORM\Column(name="other_soil", type="string", nullable=true)
     *
     * @var string
     */
    private $otherSoil;

    /**
     * Identifies if there is geological fault in the area
     *
     * @ORM\Column(name="is_geological_fault", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isGeologicalFault;

    /**
     * This list all possible geological faults
     *
     * @ORM\Column(name="geological_faults", type="text", nullable=true)
     *
     * @var string
     *
     */
    private $geologicalFault;

    /**
     * Provide possible and maximum Fire Loss in Naira
     *
     * @ORM\Column(name="possible_fire_loss", type="string", nullable=true)
     *
     * @var string
     */
    private $possibleFireLoss;

    /**
     * Povide possible and maximum Quake loss in Naira
     *
     * @ORM\Column(name="possible_quake_loss", type="string", nullable=true)
     *
     * @var string
     */
    private $possibleQuakeLoss;

    /**
     * Provide Possible and maximum other losses in Naira
     *
     * @ORM\Column(name="possible_other_loss", type="string", nullable=true)
     *
     * @var string
     */
    private $possibleOtherLoss;

    /**
     * Identifies if this is a coverage for scafolding equipment
     *
     * @ORM\Column(name="is_scafolding", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isScafolding;

    /**
     * This provides information about the equipemtn and the ste it is
     *
     * @ORM\Column(name="scafold_desc", type="text", nullable=true)
     *
     * @var string
     */
    private $scafoldDesc;

    /**
     * Identifies if this is a coverage of Equipments are Excavator, Cranes and machines
     *
     * Provide List of the macine in the value List
     *
     * @ORM\Column(name="is_excavator_n_machine", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isExcavatorNMachine;

    /**
     * This provides a decision to include third party liability into this cover
     *
     * @ORM\Column(name="is_third_party_liability", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isThirdLiability;

    /**
     * This determines if buildings are adjacent to the construction sites
     *
     * @ORM\Column(name="is_adjacent_building", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAdjacentBuilding;

    /**
     *
     * @ORM\Column(name="is_other_risk", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isOtherRisk;

    /**
     * This determines it there are special extension
     * and is particularly listed with the boolean below
     *
     * @ORM\Column(name="is_special_extension", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isSpecialExtension;

    /**
     *
     * @ORM\Column(name="is_express_friegth_extension", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isExpressFriegthExtesion;

    /**
     *
     * @ORM\Column(name="is_overtime_extension", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isOvertimeExtension;

    /**
     *
     * @ORM\Column(name="is_night_work_extension", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isNightWorkExtension;

    /**
     *
     * @ORM\Column(name="is_public_holiday_extension", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPublicHolidayExtension;

    // private $isT

    /**
     * This is a list of things meant to be covered
     *
     * @ORM\OneToMany(targetEntity="IMServices\Entity\ContractAllRiskValueList", mappedBy="contractAllRisk")
     *
     * @var Collection
     */
    private $valueList;

    /**
     * $this is the contract insured value
     *
     * @ORM\Column(name="contract_value", type="string", nullable=true)
     *
     * @var string
     */
    private $contractValue;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     *
     * @var Currency
     */
    private $currency;

    /**
     *
     * @ORM\OneToOne(targetEntity="Object\Entity\Object", inversedBy="objectContractAllRisk")
     *
     * @var Object
     */
    private $object;

    /**
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $createdOn;

    // /**
    // * @ORM\OneToOne(targetEntity="CoverDetails")
    // * @var CoverDetails
    // */
    // private $coverDetails;

    // /**
    // * @ORM\OneToMany(targetEntity="Offer\Entity\Offer", mappedBy="contractAllRisk")
    // *
    // * @var Collection
    // *
    // */
    // private $offer;

    // /**
    // * @ORM\OneToMany(targetEntity="Proposal\Entity\Proposal", mappedBy="contractAllRisk")
    // *
    // * @var Collection
    // *
    // */
    // private $proposal;

    // /**
    // * @ORM\OneToMany(targetEntity="Policy\Entity\PolicyFloat", mappedBy="contractAllRisk")
    // *
    // * @var Collection
    // */
    // private $floatingPolicy;

    /**
     */
    public function __construct()
    {
        $this->valueList = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContractName()
    {
        return $this->contractName;
    }

    public function setContractName($name)
    {
        $this->contractName = $name;
        return $this;
    }

    public function getContractAddress()
    {
        return $this->contractAddress;
    }

    public function setContractAddress($add)
    {
        $this->contractAddress = $add;
        return $this;
    }

    public function getSupervisingEngineer()
    {
        return $this->supervisingEngineer;
    }

    public function setSupervisingEngineer($eng)
    {
        $this->supervisingEngineer = $eng;
        return $this;
    }

    public function getNearestLandmark()
    {
        return $this->nearestLandmark;
    }

    public function setNearestLandmark($near)
    {
        $this->nearestLandmark = $near;
        return $this;
    }

    public function getNearestAirport()
    {
        return $this->nearestAirport;
    }

    public function setNearestAirport($near)
    {
        $this->nearestAirport = $near;
        return $this;
    }

    public function getContractDescription()
    {
        return $this->contractDescription;
    }

    public function setContractDescription($desc)
    {
        $this->contractDescription = $desc;
        return $this;
    }

    public function getContractValue()
    {
        return $this->contractValue;
    }

    public function setContractValue($val)
    {
        return $this->contractValue;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($cur)
    {
        $this->currency = $cur;
        return $this;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($obj)
    {
        return $this->object;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        return $this;
    }

    public function getCoverDetails()
    {
        return $this->coverDetails;
    }

    public function setCoverDetails($det)
    {
        $this->coverDetails = $det;
        return $this;
    }

    // public function getOffer()
    // {
    // return $this->offer;
    // }

    // /**
    // *
    // * @param Offer $offer
    // * @return ContractAllRisk
    // */
    // public function addOffer($offer)
    // {
    // if (! $this->offer->contains($offer)) {
    // $this->offer->add($offer);
    // $offer->setContractAllRisk($this);
    // }

    // return $this;
    // }

    // /**
    // *
    // * @param Offer $offer
    // * @return ContractAllRisk
    // */
    // public function removeOffer($offer)
    // {
    // if (! $this->offer->contains($offer)) {
    // $this->offer->removeElement($offer);
    // $offer->setContractAllRisk(NULL);
    // }

    // return $this;
    // }

    // public function getProposal()
    // {
    // return $this->proposal;
    // }

    // /**
    // *
    // * @param Proposal $proposal
    // * @return ContractAllRisk
    // */
    // public function addProposal($proposal)
    // {
    // if (! $this->proposal->contains($proposal)) {
    // $this->proposal->add($proposal);
    // $proposal->setContractAllRisk($this);
    // }

    // return $this;
    // }

    // /**
    // *
    // * @param Proposal $proposal
    // * @return ContractAllRisk
    // */
    // public function removeProposal($proposal)
    // {
    // if ($this->proposal->contains($proposal)) {
    // $this->proposal->removeElement($proposal);
    // $proposal->setContractAllRisk(NULL);
    // }

    // return $this;
    // }

    // public function getFloatingPolicy()
    // {
    // return $this->floatingPolicy;
    // }

    // /**
    // *
    // * @param PolicyFloat $float
    // * @return ContractAllRisk
    // */
    // public function addFloatingPolicy($float)
    // {
    // if (! $this->floatingPolicy->contains($float)) {
    // $this->floatingPolicy->add($float);
    // $float->setContractAllRisk($this);
    // }

    // return $this;
    // }

    // /**
    // *
    // * @param PolicyFloat $float
    // * @return ContractAllRisk
    // */
    // public function removeFloatingPolicy($float)
    // {
    // if ($this->floatingPolicy->contains($float)) {
    // $this->floatingPolicy->add($float);
    // $float->setContractAllRisk(NULL);
    // }
    // return $this;
    // }

    /**
     *
     * @return the $mainContractor
     */
    public function getMainContractor()
    {
        return $this->mainContractor;
    }

    /**
     *
     * @param string $mainContractor
     */
    public function setMainContractor($mainContractor)
    {
        $this->mainContractor = $mainContractor;
        return $this;
    }

    /**
     *
     * @return the $consultingEngineer
     */
    public function getConsultingEngineer()
    {
        return $this->consultingEngineer;
    }

    /**
     *
     * @param string $consultingEngineer
     */
    public function setConsultingEngineer($consultingEngineer)
    {
        $this->consultingEngineer = $consultingEngineer;
        return $this;
    }

    /**
     *
     * @return the $contractStartDate
     */
    public function getContractStartDate()
    {
        return $this->contractStartDate;
    }

    /**
     *
     * @param DateTime $contractStartDate
     */
    public function setContractStartDate($contractStartDate)
    {
        $this->contractStartDate = $contractStartDate;
        return $this;
    }

    /**
     *
     * @return the $contractEndDate
     */
    public function getContractEndDate()
    {
        return $this->contractEndDate;
    }

    /**
     *
     * @param DateTime $contractEndDate
     */
    public function setContractEndDate($contractEndDate)
    {
        $this->contractEndDate = $contractEndDate;
        return $this;
    }

    /**
     *
     * @return the $isTesting
     */
    public function getIsTesting()
    {
        return $this->isTesting;
    }

    /**
     *
     * @param boolean $isTesting
     */
    public function setIsTesting($isTesting)
    {
        $this->isTesting = $isTesting;
        return $this;
    }

    /**
     *
     * @return the $testingStartDate
     */
    public function getTestingStartDate()
    {
        return $this->testingStartDate;
    }

    /**
     *
     * @param DateTime $testingStartDate
     */
    public function setTestingStartDate($testingStartDate)
    {
        $this->testingStartDate = $testingStartDate;
        return $this;
    }

    /**
     *
     * @return the $testingEndDate
     */
    public function getTestingEndDate()
    {
        return $this->testingEndDate;
    }

    /**
     *
     * @param DateTime $testingEndDate
     */
    public function setTestingEndDate($testingEndDate)
    {
        $this->testingEndDate = $testingEndDate;
        return $this;
    }

    /**
     *
     * @return the $isMaintenance
     */
    public function getIsMaintenance()
    {
        return $this->isMaintenance;
    }

    /**
     *
     * @param boolean $isMaintenance
     */
    public function setIsMaintenance($isMaintenance)
    {
        $this->isMaintenance = $isMaintenance;
        return $this;
    }

    /**
     *
     * @return the $maintenanceStartDate
     */
    public function getMaintenanceStartDate()
    {
        return $this->maintenanceStartDate;
    }

    /**
     *
     * @param DateTime $maintenanceStartDate
     */
    public function setMaintenanceStartDate($maintenanceStartDate)
    {
        $this->maintenanceStartDate = $maintenanceStartDate;
        return $this;
    }

    /**
     *
     * @return the $maintenanceEndDate
     */
    public function getMaintenanceEndDate()
    {
        return $this->maintenanceEndDate;
    }

    /**
     *
     * @param DateTime $maintenanceEndDate
     */
    public function setMaintenanceEndDate($maintenanceEndDate)
    {
        $this->maintenanceEndDate = $maintenanceEndDate;
        return $this;
    }

    /**
     *
     * @return the $isSimilarConstruction
     */
    public function getIsSimilarConstruction()
    {
        return $this->isSimilarConstruction;
    }

    /**
     *
     * @param boolean $isSimilarConstruction
     */
    public function setIsSimilarConstruction($isSimilarConstruction)
    {
        $this->isSimilarConstruction = $isSimilarConstruction;
        return $this;
    }

    /**
     *
     * @return the $previousContructionName
     */
    public function getPreviousContructionName()
    {
        return $this->previousContructionName;
    }

    /**
     *
     * @param string $previousContructionName
     */
    public function setPreviousContructionName($previousContructionName)
    {
        $this->previousContructionName = $previousContructionName;
        return $this;
    }

    /**
     *
     * @return the $isExtension
     */
    public function getIsExtension()
    {
        return $this->isExtension;
    }

    /**
     *
     * @param boolean $isExtension
     */
    public function setIsExtension($isExtension)
    {
        $this->isExtension = $isExtension;
        return $this;
    }

    /**
     *
     * @return the $existingPlant
     */
    public function getExistingPlant()
    {
        return $this->existingPlant;
    }

    /**
     *
     * @param string $existingPlant
     */
    public function setExistingPlant($existingPlant)
    {
        $this->existingPlant = $existingPlant;
        return $this;
    }

    /**
     *
     * @return the $isCivilCompleted
     */
    public function getIsCivilCompleted()
    {
        return $this->isCivilCompleted;
    }

    /**
     *
     * @param boolean $isCivilCompleted
     */
    public function setIsCivilCompleted($isCivilCompleted)
    {
        $this->isCivilCompleted = $isCivilCompleted;
        return $this;
    }

    /**
     *
     * @return the $civilWork
     */
    public function getCivilWork()
    {
        return $this->civilWork;
    }

    /**
     *
     * @param string $civilWork
     */
    public function setCivilWork($civilWork)
    {
        $this->civilWork = $civilWork;
        return $this;
    }

    /**
     *
     * @return the $isAgravatedRisk
     */
    public function getIsAgravatedRisk()
    {
        return $this->isAgravatedRisk;
    }

    /**
     *
     * @param boolean $isAgravatedRisk
     */
    public function setIsAgravatedRisk($isAgravatedRisk)
    {
        $this->isAgravatedRisk = $isAgravatedRisk;
        return $this;
    }

    /**
     *
     * @return the $isAgravatedFire
     */
    public function getIsAgravatedFire()
    {
        return $this->isAgravatedFire;
    }

    /**
     *
     * @param boolean $isAgravatedFire
     */
    public function setIsAgravatedFire($isAgravatedFire)
    {
        $this->isAgravatedFire = $isAgravatedFire;
        return $this;
    }

    /**
     *
     * @return the $isAgravatedExplosion
     */
    public function getIsAgravatedExplosion()
    {
        return $this->isAgravatedExplosion;
    }

    /**
     *
     * @param string $isAgravatedExplosion
     */
    public function setIsAgravatedExplosion($isAgravatedExplosion)
    {
        $this->isAgravatedExplosion = $isAgravatedExplosion;
        return $this;
    }

    /**
     *
     * @return the $isEarthQuake
     */
    public function getIsEarthQuake()
    {
        return $this->isEarthQuake;
    }

    /**
     *
     * @param boolean $isEarthQuake
     */
    public function setIsEarthQuake($isEarthQuake)
    {
        $this->isEarthQuake = $isEarthQuake;
        return $this;
    }

    /**
     *
     * @return the $soilCondition
     */
    public function getSoilCondition()
    {
        return $this->soilCondition;
    }

    /**
     *
     * @param \Settings\Entity\SoilCondition $soilCondition
     */
    public function setSoilCondition($soilCondition)
    {
        $this->soilCondition = $soilCondition;
        return $this;
    }

    /**
     *
     * @return the $otherSoil
     */
    public function getOtherSoil()
    {
        return $this->otherSoil;
    }

    /**
     *
     * @param string $otherSoil
     */
    public function setOtherSoil($otherSoil)
    {
        $this->otherSoil = $otherSoil;
        return $this;
    }

    /**
     *
     * @return the $isGeologicalFault
     */
    public function getIsGeologicalFault()
    {
        return $this->isGeologicalFault;
    }

    /**
     *
     * @param boolean $isGeologicalFault
     */
    public function setIsGeologicalFault($isGeologicalFault)
    {
        $this->isGeologicalFault = $isGeologicalFault;
        return $this;
    }

    /**
     *
     * @return the $geologicalFault
     */
    public function getGeologicalFault()
    {
        return $this->geologicalFault;
    }

    /**
     *
     * @param string $geologicalFault
     */
    public function setGeologicalFault($geologicalFault)
    {
        $this->geologicalFault = $geologicalFault;
        return $this;
    }

    /**
     *
     * @return the $possibleFireLoss
     */
    public function getPossibleFireLoss()
    {
        return $this->possibleFireLoss;
    }

    /**
     *
     * @param string $possibleFireLoss
     */
    public function setPossibleFireLoss($possibleFireLoss)
    {
        $this->possibleFireLoss = $possibleFireLoss;
        return $this;
    }

    /**
     *
     * @return the $possibleQuakeLoss
     */
    public function getPossibleQuakeLoss()
    {
        return $this->possibleQuakeLoss;
    }

    /**
     *
     * @param string $possibleQuakeLoss
     */
    public function setPossibleQuakeLoss($possibleQuakeLoss)
    {
        $this->possibleQuakeLoss = $possibleQuakeLoss;
        return $this;
    }

    /**
     *
     * @return the $possibleOtherLoss
     */
    public function getPossibleOtherLoss()
    {
        return $this->possibleOtherLoss;
    }

    /**
     *
     * @param string $possibleOtherLoss
     */
    public function setPossibleOtherLoss($possibleOtherLoss)
    {
        $this->possibleOtherLoss = $possibleOtherLoss;
        return $this;
    }

    /**
     *
     * @return the $isScafolding
     */
    public function getIsScafolding()
    {
        return $this->isScafolding;
    }

    /**
     *
     * @param boolean $isScafolding
     */
    public function setIsScafolding($isScafolding)
    {
        $this->isScafolding = $isScafolding;
        return $this;
    }

    /**
     *
     * @return the $scafoldDesc
     */
    public function getScafoldDesc()
    {
        return $this->scafoldDesc;
    }

    /**
     *
     * @param string $scafoldDesc
     */
    public function setScafoldDesc($scafoldDesc)
    {
        $this->scafoldDesc = $scafoldDesc;
        return $this;
    }

    /**
     *
     * @return the $isExcavatorNMachine
     */
    public function getIsExcavatorNMachine()
    {
        return $this->isExcavatorNMachine;
    }

    /**
     *
     * @param boolean $isExcavatorNMachine
     */
    public function setIsExcavatorNMachine($isExcavatorNMachine)
    {
        $this->isExcavatorNMachine = $isExcavatorNMachine;
        return $this;
    }

    /**
     *
     * @return the $isThirdLiability
     */
    public function getIsThirdLiability()
    {
        return $this->isThirdLiability;
    }

    /**
     *
     * @param boolean $isThirdLiability
     */
    public function setIsThirdLiability($isThirdLiability)
    {
        $this->isThirdLiability = $isThirdLiability;
        return $this;
    }

    /**
     *
     * @return the $isAdjacentBuilding
     */
    public function getIsAdjacentBuilding()
    {
        return $this->isAdjacentBuilding;
    }

    /**
     *
     * @param boolean $isAdjacentBuilding
     */
    public function setIsAdjacentBuilding($isAdjacentBuilding)
    {
        $this->isAdjacentBuilding = $isAdjacentBuilding;
        return $this;
    }

    /**
     *
     * @return the $isSpecialExtension
     */
    public function getIsSpecialExtension()
    {
        return $this->isSpecialExtension;
    }

    /**
     *
     * @param boolean $isSpecialExtension
     */
    public function setIsSpecialExtension($isSpecialExtension)
    {
        $this->isSpecialExtension = $isSpecialExtension;
        return $this;
    }

    /**
     *
     * @return the $isExpressFriegthExtesion
     */
    public function getIsExpressFriegthExtesion()
    {
        return $this->isExpressFriegthExtesion;
    }

    /**
     *
     * @param boolean $isExpressFriegthExtesion
     */
    public function setIsExpressFriegthExtesion($isExpressFriegthExtesion)
    {
        $this->isExpressFriegthExtesion = $isExpressFriegthExtesion;
        return $this;
    }

    /**
     *
     * @return the $isOvertimeExtension
     */
    public function getIsOvertimeExtension()
    {
        return $this->isOvertimeExtension;
    }

    /**
     *
     * @param boolean $isOvertimeExtension
     */
    public function setIsOvertimeExtension($isOvertimeExtension)
    {
        $this->isOvertimeExtension = $isOvertimeExtension;
        return $this;
    }

    /**
     *
     * @return the $isNightWorkExtension
     */
    public function getIsNightWorkExtension()
    {
        return $this->isNightWorkExtension;
    }

    /**
     *
     * @param boolean $isNightWorkExtension
     */
    public function setIsNightWorkExtension($isNightWorkExtension)
    {
        $this->isNightWorkExtension = $isNightWorkExtension;
        return $this;
    }

    /**
     *
     * @return the $isPublicHolidayExtension
     */
    public function getIsPublicHolidayExtension()
    {
        return $this->isPublicHolidayExtension;
    }

    /**
     *
     * @param boolean $isPublicHolidayExtension
     */
    public function setIsPublicHolidayExtension($isPublicHolidayExtension)
    {
        $this->isPublicHolidayExtension = $isPublicHolidayExtension;
        return $this;
    }

    /**
     *
     * @return ContractAllRiskValueList $valueList
     */
    public function getValueList()
    {
        return $this->valueList;
    }

    /**
     *
     * @param ContractAllRiskValueList $valueList
     */
    public function addValueList($valueList)
    {
        if (! $this->valueList->contains($valueList)) {
            $this->valueList->add($valueList);
            $valueList->setContractAllRisk($this);
        }
        return $this;
    }

    public function removeValueList($valueList)
    {
        if ($this->valueList->contains($valueList)) {
            $this->valueList->removeElement($valueList);
            $valueList->setContractAllRisk(NULL);
        }
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $valueList
     */
    public function setValueList($valueList)
    {
        $this->valueList = $valueList;
        return $this;
    }

    /**
     *
     * @return the $isOtherRisk
     */
    public function getIsOtherRisk()
    {
        return $this->isOtherRisk;
    }

    /**
     *
     * @param boolean $isOtherRisk
     */
    public function setIsOtherRisk($isOtherRisk)
    {
        $this->isOtherRisk = $isOtherRisk;
        return $this;
    }
//     /**
//      * @return string
//      */
//     public function getValue()
//     {
//         return $this->value;
//     }

//     /**
//      * @param string $value
//      */
//     public function setValue($value)
//     {
//         $this->value = $value;
//         return $this;
//     }

}

