<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This provides specific details for the specific cover
 * @ORM\Entity
 * @ORM\Table(name="cover_detailss")
 *
 * @author otaba
 *        
 */
class CoverDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    // /**
    // * @ORM\ManyToOne(targetEntity="Settings\Entity\CoverCategory")
    // *
    // * @var CoverCategory
    // */
    // private $category;
    
    // /**
    // * @ORM\OneToOne(targetEntity="Proposal\Entity\Proposal", inversedBy="coverDetails")
    // * @ORM\JoinColumn(name="proposal", referencedColumnName="id")
    // *
    // * @var Proposal
    // */
    // private $proposal;
    
    // /**
    // * @ORM\OneToOne(targetEntity="Offer\Entity\Offer")
    // * @ORM\JoinColumn(name="offer", referencedColumnName="id")
    // *
    // * @var Offer
    // */
    // private $offer;
    
    // /**
    // * @ORM\OneToOne(targetEntity="Policy\Entity\PolicyFloat")
    // * @var Packages
    // */
    // private $package;
    
    // /**
    // * @ORM\OneToOne(targetEntity="Policy\Entity\PolicyFloat")
    // * @var PolicyFloat
    // */
    // private $float;
    
    // private $cover
    
    /**
     * @ORM\OneToOne(targetEntity="AgricProductInsurance")
     *
     * @var AgricProductInsurance
     */
    private $agricPropertyInsurance;

    /**
     * @ORM\OneToOne(targetEntity="BoilersInsurance")
     *
     * @var BoilersInsurance
     */
    private $boilerInsurance;

    /**
     * @ORM\OneToOne(targetEntity="MotorData")
     *
     * @var MotorData
     */
    private $motorInsurance;

    /**
     * @ORM\OneToOne(targetEntity="CashInSafe")
     *
     * @var CashInSafe
     */
    private $cashInSafeInsurance;

    /**
     * @ORM\OneToOne(targetEntity="CashInTransit")
     *
     * @var CashInTransit
     */
    private $cashInTransitInsurance;

    /**
     * @ORM\OneToOne(targetEntity="AviationInsurance")
     *
     * @var AviationInsurance
     */
    private $aviationInsurance;

    /**
     * @ORM\OneToOne(targetEntity="BuglaryHouseBreaking")
     *
     * @var BuglaryHouseBreaking
     */
    private $buglary;

    /**
     * @ORM\OneToOne(targetEntity="CropAgricInsurance")
     *
     * @var CropAgricInsurance
     */
    private $cropAgricIinsurance;

    /**
     * @ORM\OneToOne(targetEntity="LiveStockFarmInsurance")
     *
     * @var LiveStockFarmInsurance
     */
    private $livestockAgricInsurance;

    /**
     * @ORM\OneToOne(targetEntity="ConsequentialLoss")
     *
     * @var ConsequentialLoss
     */
    private $consequentialLoss;

    /**
     * @ORM\OneToOne(targetEntity="ContractAllRisk")
     *
     * @var ContractAllRisk
     */
    private $contractAllRisk;

    /**
     * @ORM\OneToOne(targetEntity="DirectorsLiability")
     *
     * @var DirectorsLiability
     */
    private $directorsLiability;

    /**
     * @ORM\OneToOne(targetEntity="PlantAllRisk")
     *
     * @var PlantAllRisk
     */
    private $electronicAllRisk;

    /**
     * @ORM\OneToOne(targetEntity="ElectronicEquipment")
     *
     * @var ElectronicEquipment
     */
    private $electonicEquipment;

    /**
     * @ORM\OneToOne(targetEntity="EmployerLiability")
     *
     * @var EmployerLiability
     */
    private $employersLiability;

    /**
     * @ORM\OneToOne(targetEntity="ContractAllRisk")
     *
     * @var ContractAllRisk
     */
    private $erectionAllRisk;

    /**
     * @ORM\OneToOne(targetEntity="FidelityGaurantee")
     *
     * @var FidelityGaurantee
     */
    private $fidelityGaruantee;

    /**
     * @ORM\OneToOne(targetEntity="FireAndSpecialPeril")
     *
     * @var FireAndSpecialPeril
     */
    private $fireNSpecialPeril;

    /**
     * @ORM\OneToOne(targetEntity="GoodsInTransit")
     *
     * @var GoodsInTransit
     */
    private $git;

    /**
     * @ORM\OneToOne(targetEntity="GroupLife")
     *
     * @var GroupLife
     */
    private $groupLife;

    /**
     * @ORM\OneToOne(targetEntity="GroupPeronalAccident")
     *
     * @var GroupPeronalAccident
     */
    private $groupPersonalAccident;

    // /**
    // * @ORM\Column(name="namesss", type="string", nullable=true)
    // *
    // * @var HomeProperty
    // */
    // private $homeProperty;
    
    /**
     * @ORM\OneToOne(targetEntity="HomeInsurance")
     * 
     * @var HomeInsurance
     */
    private $homeInsurance;

    /**
     * @ORM\OneToOne(targetEntity="LifePolicy")
     *
     * @var LifePolicy
     */
    private $lifePolicy;

    /**
     * @ORM\OneToOne(targetEntity="MachineryBreakDown")
     * 
     * @var MachineryBreakDown
     */
    private $machineryBreakdown;

    /**
     * @ORM\OneToOne(targetEntity="MarineCargo")
     * @ORM\JoinColumn(name="marine_cargo", referencedColumnName="id")
     *
     * @var MarineCargo
     */
    private $marineCargo;

    /**
     * @ORM\OneToOne(targetEntity="Hull")
     * @ORM\JoinColumn(name="marine_hull", referencedColumnName="id")
     *
     * @var Hull
     */
    private $marineHull;

    /**
     * @ORM\OneToOne(targetEntity="OilEnergyInsurance")
     *
     * @var OilEnergyInsurance
     */
    private $oilEnergyInsurance;

    /**
     * @ORM\OneToOne(targetEntity="OccupiersLiability")
     * 
     * @var OccupiersLiability
     */
    private $occupiersLiability;

    /**
     * @ORM\OneToOne(targetEntity="PersonalAccident")
     * @ORM\JoinColumn(name="personal_accident", referencedColumnName="id")
     *
     * @var PersonalAccident
     */
    private $personalAccident;

    /**
     * @ORM\OneToOne(targetEntity="MachineryBreakDown")
     * 
     *
     * @var MachineryBreakDown
     */
    private $plantAllRisk;

    /**
     * @ORM\OneToOne(targetEntity="ProfessionalIndemnity")
     * @ORM\JoinColumn(name="professional_indemnity", referencedColumnName="id")
     *
     * @var ProfessionalIndemnity
     */
    private $professionalIndemnity;

    /**
     * @ORM\OneToOne(targetEntity="PropertyInsurnace")
     * @ORM\JoinColumn(name="property_insurance", referencedColumnName="id")
     *
     * @var PropertyInsurnace
     */
    private $propertyInsurance;

    /**
     * @ORM\OneToOne(targetEntity="PublicLiability")
     * @ORM\JoinColumn(name="public_liability", referencedColumnName="id")
     *
     * @var PublicLiability
     */
    private $publicLiability;

    /**
     * @ORM\OneToOne(targetEntity="TravelInsurance")
     *
     *
     * @var TravelInsurance
     */
    private $travelInsurance;

    /**
     * @ORM\OneToOne(targetEntity="WorkmenCompensation")
     *
     * @var WorkmenCompensation
     */
    private $workmenCompensation;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true )
     *
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true )
     *
     * @var \DateTime
     */
    private $updatedOn;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return the $agricPropertyInsurance
     */
    public function getAgricPropertyInsurance()
    {
        return $this->agricPropertyInsurance;
    }

    /**
     *
     * @param \IMServices\Entity\AgricProductInsurance $agricPropertyInsurance            
     */
    public function setAgricPropertyInsurance($agricPropertyInsurance)
    {
        $this->agricPropertyInsurance = $agricPropertyInsurance;
        return $this;
    }

    /**
     *
     * @return the $boilerInsurance
     */
    public function getBoilerInsurance()
    {
        return $this->boilerInsurance;
    }

    /**
     *
     * @param \IMServices\Entity\BoilersInsurance $boilerInsurance            
     */
    public function setBoilerInsurance($boilerInsurance)
    {
        $this->boilerInsurance = $boilerInsurance;
        return $this;
    }

    /**
     *
     * @return the $motorInsurance
     */
    public function getMotorInsurance()
    {
        return $this->motorInsurance;
    }

    /**
     *
     * @return the $cashInSafeInsurance
     */
    public function getCashInSafeInsurance()
    {
        return $this->cashInSafeInsurance;
    }

    /**
     *
     * @param \IMServices\Entity\CashInSafe $cashInSafeInsurance            
     */
    public function setCashInSafeInsurance($cashInSafeInsurance)
    {
        $this->cashInSafeInsurance = $cashInSafeInsurance;
        return $this;
    }

    /**
     *
     * @return the $cashInTransitInsurance
     */
    public function getCashInTransitInsurance()
    {
        return $this->cashInTransitInsurance;
    }

    /**
     *
     * @param \IMServices\Entity\CashInTransit $cashInTransitInsurance            
     */
    public function setCashInTransitInsurance($cashInTransitInsurance)
    {
        $this->cashInTransitInsurance = $cashInTransitInsurance;
        return $this;
    }

    public function getBuglary()
    {
        return $this->buglary;
    }

    public function setBuglary($bug)
    {
        $this->buglary = $bug;
        return $this;
    }

    /**
     *
     * @return the $aviationInsurance
     */
    public function getAviationInsurance()
    {
        return $this->aviationInsurance;
    }

    /**
     *
     * @param \IMServices\Entity\AviationInsurance $aviationInsurance            
     */
    public function setAviationInsurance($aviationInsurance)
    {
        $this->aviationInsurance = $aviationInsurance;
        return $this;
    }

    public function getConsequentialLoss()
    {
        return $this->consequentialLoss;
    }

    public function setConsequentialLoss($loss)
    {
        $this->consequentialLoss = $loss;
        return $this;
    }

    public function getContractAllRisk()
    {
        return $this->contractAllRisk;
    }

    public function setContractAllRisk($risk)
    {
        $this->contractAllRisk = $risk;
        return $this;
    }

    /**
     *
     * @return the $directorsLiability
     */
    public function getDirectorsLiability()
    {
        return $this->directorsLiability;
    }

    /**
     *
     * @param \IMServices\Entity\DirectorsLiability $directorsLiability            
     */
    public function setDirectorsLiability($directorsLiability)
    {
        $this->directorsLiability = $directorsLiability;
        return $this;
    }

    public function getElectronicAllRisk()
    {
        return $this->electronicAllRisk;
    }

    public function setElectronicAllRisk($risk)
    {
        $this->electronicAllRisk = $risk;
        return $this;
    }

    // public function getEmployersLiabiltiy()
    // {
    // return $this->employersLiability;
    // }
    public function setEmployersLiability($re)
    {
        $this->employersLiability = $re;
        return $this;
    }

    public function getErectionAllRisk()
    {
        return $this->erectionAllRisk;
    }

    public function setErectionAllRisk($rec)
    {
        $this->erectionAllRisk = $rec;
        return $this;
    }

    public function getFidelityGaruantee()
    {
        return $this->fidelityGaruantee;
    }

    public function setFidelityGaruantee($fid)
    {
        $this->fidelityGaruantee = $fid;
        return $this;
    }

    public function getFireNSpecialPeril()
    {
        return $this->fireNSpecialPeril;
    }

    public function setFireNSpecialPeril($peril)
    {
        $this->fireNSpecialPeril = $peril;
        return $this;
    }

    public function getGit()
    {
        return $this->git;
    }

    public function setGit($git)
    {
        $this->git = $git;
        return $this;
    }

    public function getGroupLife()
    {
        return $this->groupLife;
    }

    public function setGroupLife($life)
    {
        $this->groupLife = $life;
        return $this;
    }

    public function getGroupPersonalAccident()
    {
        return $this->groupPersonalAccident;
    }

    public function setGroupPersonalAccident($grp)
    {
        $this->groupPersonalAccident = $grp;
        return $this;
    }

    public function getHomeProperty()
    {
        return $this->homeProperty;
    }

    public function setHomeProperty($prop)
    {
        $this->homeProperty = $prop;
        return $this;
    }

    public function getLifePolicy()
    {
        return $this->lifePolicy;
    }

    public function setLifePolicy($pol)
    {
        $this->lifePolicy = $pol;
        return $this;
    }

    public function getMarineCargo()
    {
        return $this->marineCargo;
    }

    public function setMarineCargo($marine)
    {
        $this->marineCargo = $marine;
        return $this;
    }

    public function getPersonalAccident()
    {
        return $this->personalAccident;
    }

    public function setPersonalAccident($acci)
    {
        $this->personalAccident = $acci;
        return $this;
    }

    public function getPlantAllRisk()
    {
        return $this->plantAllRisk;
    }

    public function setPlantAllRisk($risk)
    {
        $this->plantAllRisk = $risk;
        return $this;
    }

    public function getProfessionalIndemnity()
    {
        return $this->professionalIndemnity;
    }

    public function setProfessionalIndemnity($set)
    {
        $this->professionalIndemnity = $set;
        return $this;
    }

    public function getPropertInsurance()
    {
        return $this->propertyInsurance;
    }

    public function setPropertyInsurance($ins)
    {
        $this->propertyInsurance = $ins;
        return $this;
    }

    public function getPublicLiability()
    {
        return $this->publicLiability;
    }

    public function setPublicLiability($set)
    {
        $this->publicLiability = $set;
        return $this;
    }

    public function getTravelInsurance()
    {
        return $this->travelInsurance;
    }

    public function setTravelInsurance($set)
    {
        $this->travelInsurance = $set;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($set)
    {
        $this->createdOn = $set;
        $this->updatedOn = $set;
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn($set)
    {
        $this->updatedOn = $set;
        return $this;
    }

    /**
     *
     * @return the $employersLiability
     */
    public function getEmployersLiability()
    {
        return $this->employersLiability;
    }

    // /**
    // * @return the $fireNSpecialPeril
    // */
    // public function getFireNSpecialPeril()
    // {
    // return $this->fireNSpecialPeril;
    // }
    
    /**
     *
     * @return the $propertyInsurance
     */
    public function getPropertyInsurance()
    {
        return $this->propertyInsurance;
    }

    /**
     *
     * @param \IMServices\Entity\MotorData $motorInsurance            
     */
    public function setMotorInsurance($motorInsurance)
    {
        $this->motorInsurance = $motorInsurance;
        return $this;
    }

    /**
     *
     * @return the $cropAgricIinsurance
     */
    public function getCropAgricIinsurance()
    {
        return $this->cropAgricIinsurance;
    }

    /**
     *
     * @param \IMServices\Entity\CropAgricInsurance $cropAgricIinsurance            
     */
    public function setCropAgricIinsurance($cropAgricIinsurance)
    {
        $this->cropAgricIinsurance = $cropAgricIinsurance;
        return $this;
    }

    /**
     *
     * @return the $livestockAgricInsurance
     */
    public function getLivestockAgricInsurance()
    {
        return $this->livestockAgricInsurance;
    }

    /**
     *
     * @param \IMServices\Entity\LiveStockFarmInsurance $livestockAgricInsurance            
     */
    public function setLivestockAgricInsurance($livestockAgricInsurance)
    {
        $this->livestockAgricInsurance = $livestockAgricInsurance;
        return $this;
    }

    /**
     *
     * @return the $marineHull
     */
    public function getMarineHull()
    {
        return $this->marineHull;
    }

    /**
     *
     * @param \IMServices\Entity\Hull $marineHull            
     */
    public function setMarineHull($marineHull)
    {
        $this->marineHull = $marineHull;
        return $this;
    }

    /**
     *
     * @return the $oilEnergyInsurance
     */
    public function getOilEnergyInsurance()
    {
        return $this->oilEnergyInsurance;
    }

    /**
     *
     * @param \IMServices\Entity\OilEnergyInsurance $oilEnergyInsurance            
     */
    public function setOilEnergyInsurance($oilEnergyInsurance)
    {
        $this->oilEnergyInsurance = $oilEnergyInsurance;
        return $this;
    }

    /**
     *
     * @return the $electonicEquipment
     */
    public function getElectonicEquipment()
    {
        return $this->electonicEquipment;
    }

    /**
     *
     * @param \IMServices\Entity\ElectronicEquipment $electonicEquipment            
     */
    public function setElectonicEquipment($electonicEquipment)
    {
        $this->electonicEquipment = $electonicEquipment;
        return $this;
    }

    /**
     *
     * @return the $workmenCompensation
     */
    public function getWorkmenCompensation()
    {
        return $this->workmenCompensation;
    }

    /**
     *
     * @param \IMServices\Entity\WorkmenCompensation $workmenCompensation            
     */
    public function setWorkmenCompensation($workmenCompensation)
    {
        $this->workmenCompensation = $workmenCompensation;
        return $this;
    }

    /**
     *
     * @return the $homeInsurance
     */
    public function getHomeInsurance()
    {
        return $this->homeInsurance;
    }

    /**
     *
     * @param \IMServices\Entity\HomeInsurance $homeInsurance            
     */
    public function setHomeInsurance($homeInsurance)
    {
        $this->homeInsurance = $homeInsurance;
        return $this;
    }

    /**
     *
     * @return the $machineryBreakdown
     */
    public function getMachineryBreakdown()
    {
        return $this->machineryBreakdown;
    }

    /**
     *
     * @param \IMServices\Entity\MachineryBreakDown $machineryBreakdown            
     */
    public function setMachineryBreakdown($machineryBreakdown)
    {
        $this->machineryBreakdown = $machineryBreakdown;
        return $this;
    }

    /**
     *
     * @return the $occupiersLiability
     */
    public function getOccupiersLiability()
    {
        return $this->occupiersLiability;
    }

    /**
     *
     * @param \IMServices\Entity\OccupiersLiability $occupiersLiability            
     */
    public function setOccupiersLiability($occupiersLiability)
    {
        $this->occupiersLiability = $occupiersLiability;
        return $this;
    }
}

