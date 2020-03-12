<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
// use Settings\Entity\InsuranceSpecificService;
use Settings\Entity\MarineHullCoverType;
use Settings\Entity\MarineTerritorialLimit;
use Settings\Entity\MarineEngineType;
use Settings\Entity\Currency;
use Settings\Entity\VesselType;

/**
 * @ORM\Entity
 * @ORM\Table(name="hull")
 *
 * @author otaba
 *        
 */
class Hull
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Name of the vessel;
     * @ORM\Column(name="vessel_name", type="string", nullable=true)
     *
     * @var string
     */
    private $vesselName;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\VesselType")
     *
     * @var VesselType
     */
    private $vesselType;

    /**
     * @ORM\Column(name="other_vessel_type", type="string", nullable=true)
     *
     * @var string
     */
    private $otherVesselType;

    /**
     * @ORM\Column(name="vessel_builder", type="string", nullable=true)
     *
     * @var string
     */
    private $vesselBuilders;

    /**
     * @ORM\Column(name="vessel_port_registry", type="string", nullable=true)
     *
     * @var string
     */
    private $vesselPortOfRegistry;

    /**
     * @ORM\Column(name="vessel_identification", type="string", nullable=true)
     *
     * @var string
     */
    private $identificationNo;

    /**
     * @ORM\Column(name="date_of_built", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $dateOfBuilt;

    /**
     * @ORM\Column(name="date_of_purchase", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $dateOfPurchase;

    /**
     * @ORM\Column(name="price_paid", type="string", nullable=true)
     *
     * @var string
     */
    private $pricePaid;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     *
     * @var Currency
     */
    private $currency;

    /**
     * @ORM\Column(name="vessel_lenght", type="string", nullable=true)
     *
     * @var string
     */
    private $vesselLength;

    /**
     *
     * @ORM\Column(name="vessel_beam", type="string", nullable=true)
     *
     * @var string
     */
    private $vesselBeam;

    /**
     *
     * @ORM\Column(name="draft", type="string", nullable=true)
     *
     * @var string
     */
    private $draft;

    /**
     *
     * @ORM\Column(name="tonnage", type="string", nullable=true)
     *
     * @var string
     */
    private $tonnage;

    // /**
    // *
    // * @var InsuranceSpecificService
    // */
    // private $hullType;
    
    /**
     * @ORM\Column(name="is_professional_surveyed", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isProfessionalSurveyed;

    /**
     * @ORM\Column(name="survey_report", type="text", nullable=true)
     *
     * @var text
     */
    private $surveyReport;

    // Begin Value to be insured
    
    /**
     * Value in Naira
     * @ORM\Column(name="vessel_value", type="string", nullable=true)
     *
     * @var string
     */
    private $vesselValue;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     *
     * @var Currency
     */
    private $vesselCurrency;

    /**
     * This is value in Naira
     * @ORM\Column(name="trailer_value", type="string", nullable=true)
     *
     * @var string
     */
    private $trailerValue;

    // /**
    // * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
    // * @var Currency
    // */
    // private $trailerCurrency;
    
    /**
     * This is value in Naira
     * @ORM\Column(name="personal_effects", type="string", nullable=true)
     *
     * @var string
     */
    private $personalEffects;

    // /**
    // * No getters
    // * Personal Effects Currency
    // * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
    // * @var Currency
    // */
    // private $peCurrency;
    
    /**
     * This is value in Naira
     * @ORM\Column(name="total_insured_value", type="string", nullable=true)
     *
     * @var string
     */
    private $totalInsuredValue;

    // /**
    // * No getters
    // * Personal Effects Currency
    // * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
    // * @var Currency
    // */
    // private $tiCurrency;
    
    // Begin Machinery Details
    
    /**
     * Make and Model
     * @ORM\Column(name="make_model", type="string", nullable=true)
     *
     * @var string
     */
    private $makeNModel;

    /**
     * Amount of Engines
     * @ORM\Column(name="engine_count", type="string", nullable=true)
     *
     * @var string
     */
    private $engineCount;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MarineEngineType")
     *
     * @var MarineEngineType
     */
    private $engineType;
    
    /**
     * @ORM\Column(name="other_engine_type", type="string", nullable=true)
     * @var string
     */
    private $otherEngineType;

    /**
     * @ORM\Column(name="is_cover_dropping_off", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCoverDroppingOff;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MarineHullCoverType")
     *
     * @var MarineHullCoverType
     */
    private $hullCoverType;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MarineTerritorialLimit")
     *
     * @var MarineTerritorialLimit
     */
    private $marineTerritorialLimit;

    /**
     * @ORM\Column(name="other_territorial_limit", type="string", nullable=true)
     *
     * @var string
     */
    private $otherTerritorialLimit;

    /**
     * @ORM\Column(name="is_third_party", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isThirdParty;

    /**
     * @ORM\Column(name="is_water_skier_liability", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isWaterSkierLiability;

    /**
     * Value of deductible
     * @ORM\Column(name="deductible", type="string", nullable=true)
     *
     * @var string
     */
    private $deductible;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getVesselName()
    {
        return $this->vesselName;
    }

    public function setVesselName($name)
    {
        $this->vesselName = $name;
        return $this;
    }

    public function getVesselType()
    {
        return $this->vesselType;
    }

    public function setVesselType($type)
    {
        $this->vesselType = $type;
        return $this;
    }

    public function getOtherVesselType()
    {
        return $this->otherVesselType;
    }

    public function setOtherVesselType($other)
    {
        $this->otherVesselType = $other;
        return $this;
    }

    public function getVesselBuilders()
    {
        return $this->vesselBuilders;
    }

    public function setVesselBuilders($set)
    {
        $this->vesselBuilders = $set;
        return $this;
    }

    public function getVesselPortOfRegistry()
    {
        return $this->vesselPortOfRegistry;
    }

    public function setVesselPortOfRegistry($reg)
    {
        $this->vesselPortOfRegistry = $reg;
        return $this;
    }

    public function getIdentificationNo()
    {
        return $this->identificationNo;
    }

    public function setIdentificationNo($set)
    {
        $this->identificationNo = $set;
        return $this;
    }

    public function getDateOfBuilt()
    {
        return $this->dateOfBuilt;
    }

    public function setDateOfBuilt($date)
    {
        $this->dateOfBuilt = $date;
        return $this;
    }

    public function getDateOfPurchase()
    {
        return $this->dateOfPurchase;
    }

    public function setDateOfPurchase($date)
    {
        $this->dateOfPurchase = $date;
        return $this;
    }

    public function getPricePaid()
    {
        return $this->pricePaid;
    }

    /**
     *
     * @param string $pricePaid            
     */
    public function setPricePaid($pricePaid)
    {
        $this->pricePaid = $pricePaid;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($set)
    {
        $this->currency = $set;
        return $this;
    }

    public function getgetVesselLength()
    {
        return $this->vesselLength;
    }

    public function setVesselLength($len)
    {
        $this->vesselLength = $len;
        return $this;
    }

    public function getVesselBeam()
    {
        return $this->vesselBeam;
    }

    public function setVesselBeam($beam)
    {
        $this->vesselBeam = $beam;
        return $this;
    }

    public function getDraft()
    {
        return $this->draft;
    }

    public function setDraft($draft)
    {
        $this->draft = $draft;
        return $this;
    }

    public function getTonnage()
    {
        return $this->tonnage;
    }

    public function setTonnage($ton)
    {
        $this->tonnage = $ton;
        return $this;
    }

    public function getsProfessionalSurveyed()
    {
        return $this->isProfessionalSurveyed;
    }

    public function setIsProfessionalSurveyed($is)
    {
        $this->isProfessionalSurveyed = $is;
        return $this;
    }

    /**
     *
     * @return the $surveyReport
     */
    public function getSurveyReport()
    {
        return $this->surveyReport;
    }

    /**
     *
     * @param \IMServices\Entity\text $surveyReport            
     */
    public function setSurveyReport($surveyReport)
    {
        $this->surveyReport = $surveyReport;
        return $this;
    }

    /**
     *
     * @return the $vesselValue
     */
    public function getVesselValue()
    {
        return $this->vesselValue;
    }

    /**
     *
     * @param string $vesselValue            
     */
    public function setVesselValue($vesselValue)
    {
        $this->vesselValue = $vesselValue;
        return $this;
    }

    /**
     *
     * @return the $vesselCurrency
     */
    public function getVesselCurrency()
    {
        return $this->vesselCurrency;
    }

    /**
     *
     * @param \Settings\Entity\Currency $vesselCurrency            
     */
    public function setVesselCurrency($vesselCurrency)
    {
        $this->vesselCurrency = $vesselCurrency;
        return $this;
    }

    /**
     *
     * @return the $trailerValue
     */
    public function getTrailerValue()
    {
        return $this->trailerValue;
    }

    /**
     *
     * @param string $trailerValue            
     */
    public function setTrailerValue($trailerValue)
    {
        $this->trailerValue = $trailerValue;
        return $this;
    }

    /**
     *
     * @return the $personalEffects
     */
    public function getPersonalEffects()
    {
        return $this->personalEffects;
    }

    /**
     *
     * @param string $personalEffects            
     */
    public function setPersonalEffects($personalEffects)
    {
        $this->personalEffects = $personalEffects;
        return $this;
    }

    /**
     *
     * @return the $totalInsuredValue
     */
    public function getTotalInsuredValue()
    {
        return $this->totalInsuredValue;
    }

    /**
     *
     * @param string $totalInsuredValue            
     */
    public function setTotalInsuredValue($totalInsuredValue)
    {
        $this->totalInsuredValue = $totalInsuredValue;
        return $this;
    }

    /**
     *
     * @return the $makeNModel
     */
    public function getMakeNModel()
    {
        return $this->makeNModel;
    }

    /**
     *
     * @param string $makeNModel            
     */
    public function setMakeNModel($makeNModel)
    {
        $this->makeNModel = $makeNModel;
        return $this;
    }

    /**
     *
     * @return the $engineCount
     */
    public function getEngineCount()
    {
        return $this->engineCount;
    }

    /**
     *
     * @param string $engineCount            
     */
    public function setEngineCount($engineCount)
    {
        $this->engineCount = $engineCount;
        return $this;
    }

    /**
     *
     * @return the $engineType
     */
    public function getEngineType()
    {
        return $this->engineType;
    }

    /**
     *
     * @param \Settings\Entity\MarineEngineType $engineType            
     */
    public function setEngineType($engineType)
    {
        $this->engineType = $engineType;
        return $this;
    }

    /**
     *
     * @return the $isCoverDroppingOff
     */
    public function getIsCoverDroppingOff()
    {
        return $this->isCoverDroppingOff;
    }

    /**
     *
     * @param boolean $isCoverDroppingOff            
     */
    public function setIsCoverDroppingOff($isCoverDroppingOff)
    {
        $this->isCoverDroppingOff = $isCoverDroppingOff;
        return $this;
    }

    /**
     *
     * @return the $hullCoverType
     */
    public function getHullCoverType()
    {
        return $this->hullCoverType;
    }

    /**
     *
     * @param \Settings\Entity\MarineHullCoverType $hullCoverType            
     */
    public function setHullCoverType($hullCoverType)
    {
        $this->hullCoverType = $hullCoverType;
        return $this;
    }

    /**
     *
     * @return the $marineTerritorialLimit
     */
    public function getMarineTerritorialLimit()
    {
        return $this->marineTerritorialLimit;
    }

    /**
     *
     * @param \Settings\Entity\MarineTerritorialLimit $marineTerritorialLimit            
     */
    public function setMarineTerritorialLimit($marineTerritorialLimit)
    {
        $this->marineTerritorialLimit = $marineTerritorialLimit;
        return $this;
    }

    /**
     *
     * @return the $isThirdParty
     */
    public function getIsThirdParty()
    {
        return $this->isThirdParty;
    }

    /**
     *
     * @param boolean $isThirdParty            
     */
    public function setIsThirdParty($isThirdParty)
    {
        $this->isThirdParty = $isThirdParty;
        return $this;
    }

    /**
     *
     * @return the $isWaterSkierLiability
     */
    public function getIsWaterSkierLiability()
    {
        return $this->isWaterSkierLiability;
    }

    /**
     *
     * @param boolean $isWaterSkierLiability            
     */
    public function setIsWaterSkierLiability($isWaterSkierLiability)
    {
        $this->isWaterSkierLiability = $isWaterSkierLiability;
        return $this;
    }

    /**
     *
     * @return the $deductible
     */
    public function getDeductible()
    {
        return $this->deductible;
    }

    /**
     *
     * @param string $deductible            
     */
    public function setDeductible($deductible)
    {
        $this->deductible = $deductible;
        return $this;
    }

    /**
     *
     * @return the $vesselLength
     */
    public function getVesselLength()
    {
        return $this->vesselLength;
    }

    /**
     *
     * @return the $isProfessionalSurveyed
     */
    public function getIsProfessionalSurveyed()
    {
        return $this->isProfessionalSurveyed;
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
     * @return the $otherTerritorialLimit
     */
    public function getOtherTerritorialLimit()
    {
        return $this->otherTerritorialLimit;
    }

    /**
     *
     * @param string $otherTerritorialLimit            
     */
    public function setOtherTerritorialLimit($otherTerritorialLimit)
    {
        $this->otherTerritorialLimit = $otherTerritorialLimit;
        return $this;
    }
    /**
     * @return the $otherEngineType
     */
    public function getOtherEngineType()
    {
        return $this->otherEngineType;
    }

    /**
     * @param string $otherEngineType
     */
    public function setOtherEngineType($otherEngineType)
    {
        $this->otherEngineType = $otherEngineType;
        return $this;
    }

}

