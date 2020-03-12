<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\TravelRegion;
use GeneralServicer\Entity\Document;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="aviation_insurance")
 *
 * @author otaba
 *        
 */
class AviationInsurance
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * DEfines the usage of the aircraft
     *
     * @ORM\Column(name="aircraft_usage", type="string", nullable=true)
     *
     * @var text
     */
    private $aircraftUsage;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\TravelRegion")
     *
     * @var TravelRegion
     */
    private $geographicalOperation;

    /**
     * @ORM\Column(name="airline_background", type="text", nullable=true)
     *
     * @var text
     */
    private $airlineBackground;

    /**
     * @ORM\Column(name="aircraft_capacity", type="string", nullable=true)
     *
     * @var string
     */
    private $aircraftCapacity;

    /**
     * @ORM\Column(name="aircraft_make_n_type", type="string", nullable=true)
     *
     * @var string
     */
    private $aircraftMakeNType;

    /**
     * @ORM\Column(name="construction_year", type="string", nullable=true)
     *
     * @var string
     */
    private $constructionYear;

    /**
     * @ORM\Column(name="serial_number", type="string", nullable=true)
     *
     * @var string
     */
    private $serialNumber;

     /**
     * Perform regular maintenenae
     * @ORM\Column(name="is_regular_maintenance", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isRegularMaintenance;

    /**
     * @ORM\Column(name="is_regularly_hangered", type="boolean", nullable=true)
     * @var boolean
     */
    private $isRegularlyHangered;

    /**
     *
     * @ORM\Column(name="hangered_location", type="string", nullable=true)
     *
     * @var string
     */
    private $hangeredLocation;

   
    /**
     * @ORM\Column(name="maintenance_by", type="string", nullable=true)
     *
     * @var string
     */
    private $maintenanceBy;

    /**
     * @ORM\Column(name="last_maintenance_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $lastMaintenanceDate;

    /**
     * @ORM\Column(name="is_maintenance_include_engine", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isMaintenanceIncludeEngine;

    /**
     * Pilot details
     * @ORM\OneToMany(targetEntity="AviationinsurancePilotDetails", mappedBy="aviationInsurance")
     * 
     * @var Collection
     */
    private $pilotDetails;

    /**
     * @ORM\Column(name="is_lien", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isLien = false;

    /**
     * @ORM\Column(name="lien_amount", type="string", nullable=true)
     *
     * @var string
     */
    private $lienAmount = 0;

    /**
     * @ORM\Column(name="lien_holder", type="string", nullable=true)
     *
     * @var string
     */
    private $lienHolder;

    /**
     * @ORM\Column(name="agreed_hull_value", type="string", nullable=true)
     *
     * @var string
     */
    private $agreedHullValue;

    /**
     * @ORM\Column(name="annual_utilization", type="string", nullable=true)
     *
     * @var string
     */
    private $annualUtilization;

    /**
     * @ORM\Column(name="covered_persons", type="text", nullable=true)
     *
     * @var string
     */
    private $coveredPersons;

    /**
     * @ORM\Column(name="is_certificate", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCertificateOfAirWorthiness = FALSE;

    /**
     * @ORM\ManyToOne(targetEntity="GeneralServicer\Entity\Document")
     *
     * @var Document
     */
    private $certificate;

    /**
     * @ORM\Column(name="cover_type", type="string", nullable=true)
     *
     * @var string
     */
    private $coverType;
    
    /**
     * @ORM\Column(name="is_include_risk", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isIncludeRisk;

    /**
     * @ORM\Column(name="is_include_flight_risk", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isIncludeFlightRisk;

    /**
     * @ORM\Column(name="is_include_taxi_risk", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isIncludeTaxiRisk;

    /**
     * @ORM\Column(name="is_include_ground_risk", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isIncludeGroundRisk;

    /**
     * @ORM\Column(name="is_include_motoring_risk", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isMotoringRisk;

    /**
     * @ORM\Column(name="is_indemnity_limit", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isIndemnityLimit;

    /**
     * @ORM\Column(name="indemnitiy_limit", type="string", nullable=true)
     *
     * @var boolean
     */
    private $indemnityLimit;

    /**
     * Indemnity Limmit for any one persenger
     * @ORM\Column(name="indemnity_limit_one_passenger", type="string", nullable=true)
     *
     * @var boolean
     */
    private $indemnityLimitOnePassenger;

    /**
     * Indemnity Limmit for any one persenger
     * @ORM\Column(name="indemnity_limit_one_accident", type="string", nullable=true)
     *
     * @var boolean
     */
    private $indemnityLimitOneAccident;

    /**
     * Is Previous Insurer
     * @ORM\Column(name="is_previous_insurer", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousInsurer;

    /**
     * Is Previously declined
     * @ORM\Column(name="is_previous_decline", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousDecline;

    /**
     * @ORM\Column(name="decline_reason", type="text", nullable=true)
     *
     * @var text
     */
    private $declineReason;

    /**
     * Is Previously declined
     * @ORM\Column(name="is_previous_cancel", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousCancel;

    /**
     * @ORM\Column(name="cancel_reason", type="text", nullable=true)
     *
     * @var text
     */
    private $cancelReason;

    // private
    
    /**
     */
    public function __construct()
    {
        $this->pilotDetails = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAircraftUsage()
    {
        return $this->aircraftUsage;
    }

    public function setAircraftUsage($use)
    {
        $this->aircraftUsage = $use;
        return $this;
    }

    public function getGeographicalOperation()
    {
        return $this->geographicalOperation;
    }

    public function setGeographicalOperation($set)
    {
        $this->geographicalOperation = $set;
        return $this;
    }

    public function getAirlineBackground()
    {
        return $this->airlineBackground;
    }

    public function setAirlineBackground($back)
    {
        $this->airlineBackground = $back;
        return $this;
    }

    public function getAircraftCapacity()
    {
        return $this->aircraftCapacity;
    }

    public function setAircraftCapacity($cap)
    {
        $this->aircraftCapacity = $cap;
        return $this;
    }

    public function getAircraftMakeNType()
    {
        return $this->aircraftMakeNType;
    }

    public function setAircraftMakeNType($air)
    {
        return $this->aircraftMakeNType;
    }

    public function getConstructionYear()
    {
        return $this->constructionYear;
    }

    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    public function setSerialNumber($number)
    {
        $this->serialNumber = $number;
        return $this;
    }

    public function getMaintenanceBy()
    {
        return $this->maintenanceBy;
    }

    public function setMaintenanceBy($main)
    {
        $this->maintenanceBy = $main;
        return $this;
    }

    public function getIsLien()
    {
        return $this->isLien;
    }

    public function setIsLien($lien)
    {
        $this->isLien = $lien;
        return $this;
    }

    public function getLienAmount()
    {
        return $this->lienAmount;
    }

    public function setLienAmount($mount)
    {
        $this->lienAmount = $mount;
        return $this;
    }

    public function getLienHolder()
    {
        return $this->lienHolder;
    }

    public function setLienHolder($hol)
    {
        $this->lienHolder = $hol;
        return $this;
    }

    public function getAgreedHullValue()
    {
        return $this->agreedHullValue;
    }

    public function setAgreedHullValue($value)
    {
        $this->agreedHullValue = $value;
        return $this;
    }

    public function getAnnualUtilization()
    {
        return $this->annualUtilization;
    }

    public function setAnnualUtilization($liz)
    {
        $this->annualUtilization = $liz;
        return $this;
    }

    public function getHangeredLocation()
    {
        return $this->hangeredLocation;
    }

    public function setHangeredLocation($han)
    {
        $this->hangeredLocation = $han;
        return $this;
    }

    public function getCoveredPersons()
    {
        return $this->coveredPersons;
    }

    public function setCoveredPersons($vere)
    {
        $this->coveredPersons = $vere;
        return $this;
    }

    public function getIsCertificateOfAirWorthiness()
    {
        return $this->isCertificateOfAirWorthiness;
    }

    public function setIsCertificateOfAirWorthiness($cover)
    {
        $this->isCertificateOfAirWorthiness = $cover;
        return $this;
    }

    public function getCertificate()
    {
        return $this->certificate;
    }

    public function setCertificate($sert)
    {
        $this->certificate = $sert;
        return $this;
    }

    public function getCoverType()
    {
        return $this->coverType;
    }

    public function setCoverType($type)
    {
        $this->coverType = $type;
        return $this;
    }

    /**
     *
     * @param string $constructionYear            
     */
    public function setConstructionYear($constructionYear)
    {
        $this->constructionYear = $constructionYear;
        return $this;
    }

    /**
     *
     * @return the $isRegularMaintenance
     */
    public function getIsRegularMaintenance()
    {
        return $this->isRegularMaintenance;
    }

    /**
     *
     * @param boolean $isRegularMaintenance            
     */
    public function setIsRegularMaintenance($isRegularMaintenance)
    {
        $this->isRegularMaintenance = $isRegularMaintenance;
        return $this;
    }

    /**
     *
     * @return the $isRegularlyHangered
     */
    public function getIsRegularlyHangered()
    {
        return $this->isRegularlyHangered;
    }

    /**
     *
     * @param boolean $isRegularlyHangered            
     */
    public function setIsRegularlyHangered($isRegularlyHangered)
    {
        $this->isRegularlyHangered = $isRegularlyHangered;
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
     * @return the $lastMaintenanceDate
     */
    public function getLastMaintenanceDate()
    {
        return $this->lastMaintenanceDate;
    }

    /**
     *
     * @param DateTime $lastMaintenanceDate            
     */
    public function setLastMaintenanceDate($lastMaintenanceDate)
    {
        $this->lastMaintenanceDate = $lastMaintenanceDate;
        return $this;
    }

    /**
     *
     * @return the $isMaintenanceIncludeEngine
     */
    public function getIsMaintenanceIncludeEngine()
    {
        return $this->isMaintenanceIncludeEngine;
    }

    /**
     *
     * @param boolean $isMaintenanceIncludeEngine            
     */
    public function setIsMaintenanceIncludeEngine($isMaintenanceIncludeEngine)
    {
        $this->isMaintenanceIncludeEngine = $isMaintenanceIncludeEngine;
        return $this;
    }

    /**
     *
     * @return the $pilotDetails
     */
    public function getPilotDetails()
    {
        return $this->pilotDetails;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $pilotDetails            
     */
    public function setPilotDetails($pilotDetails)
    {
        $this->pilotDetails = $pilotDetails;
        return $this;
    }

    /**
     *
     * @return the $isIncludeFlightRisk
     */
    public function getIsIncludeFlightRisk()
    {
        return $this->isIncludeFlightRisk;
    }

    /**
     *
     * @param boolean $isIncludeFlightRisk            
     */
    public function setIsIncludeFlightRisk($isIncludeFlightRisk)
    {
        $this->isIncludeFlightRisk = $isIncludeFlightRisk;
        return $this;
    }

    /**
     *
     * @return the $isIncludeTaxiRisk
     */
    public function getIsIncludeTaxiRisk()
    {
        return $this->isIncludeTaxiRisk;
    }

    /**
     *
     * @param boolean $isIncludeTaxiRisk            
     */
    public function setIsIncludeTaxiRisk($isIncludeTaxiRisk)
    {
        $this->isIncludeTaxiRisk = $isIncludeTaxiRisk;
        return $this;
    }

    /**
     *
     * @return the $isIncludeGroundRisk
     */
    public function getIsIncludeGroundRisk()
    {
        return $this->isIncludeGroundRisk;
    }

    /**
     *
     * @param boolean $isIncludeGroundRisk            
     */
    public function setIsIncludeGroundRisk($isIncludeGroundRisk)
    {
        $this->isIncludeGroundRisk = $isIncludeGroundRisk;
        return $this;
    }

    /**
     *
     * @return the $isMotoringRisk
     */
    public function getIsMotoringRisk()
    {
        return $this->isMotoringRisk;
    }

    /**
     *
     * @param boolean $isMotoringRisk            
     */
    public function setIsMotoringRisk($isMotoringRisk)
    {
        $this->isMotoringRisk = $isMotoringRisk;
        return $this;
    }

    /**
     *
     * @return the $isIndemnityLimit
     */
    public function getIsIndemnityLimit()
    {
        return $this->isIndemnityLimit;
    }

    /**
     *
     * @param boolean $isIndemnityLimit            
     */
    public function setIsIndemnityLimit($isIndemnityLimit)
    {
        $this->isIndemnityLimit = $isIndemnityLimit;
        return $this;
    }

    /**
     *
     * @return the $indemnityLimit
     */
    public function getIndemnityLimit()
    {
        return $this->indemnityLimit;
    }

    /**
     *
     * @param boolean $indemnityLimit            
     */
    public function setIndemnityLimit($indemnityLimit)
    {
        $this->indemnityLimit = $indemnityLimit;
        return $this;
    }

    /**
     *
     * @return the $indemnityLimitOnePassenger
     */
    public function getIndemnityLimitOnePassenger()
    {
        return $this->indemnityLimitOnePassenger;
    }

    /**
     *
     * @param boolean $indemnityLimitOnePassenger            
     */
    public function setIndemnityLimitOnePassenger($indemnityLimitOnePassenger)
    {
        $this->indemnityLimitOnePassenger = $indemnityLimitOnePassenger;
        return $this;
    }

    /**
     *
     * @return the $indemnityLimitOneAccident
     */
    public function getIndemnityLimitOneAccident()
    {
        return $this->indemnityLimitOneAccident;
    }

    /**
     *
     * @param boolean $indemnityLimitOneAccident            
     */
    public function setIndemnityLimitOneAccident($indemnityLimitOneAccident)
    {
        $this->indemnityLimitOneAccident = $indemnityLimitOneAccident;
        return $this;
    }

    /**
     *
     * @return the $isPreviousInsurer
     */
    public function getIsPreviousInsurer()
    {
        return $this->isPreviousInsurer;
    }

    /**
     *
     * @param boolean $isPreviousInsurer            
     */
    public function setIsPreviousInsurer($isPreviousInsurer)
    {
        $this->isPreviousInsurer = $isPreviousInsurer;
        return $this;
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
     * @param boolean $isPreviousDecline            
     */
    public function setIsPreviousDecline($isPreviousDecline)
    {
        $this->isPreviousDecline = $isPreviousDecline;
        return $this;
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
     * @param \IMServices\Entity\text $declineReason            
     */
    public function setDeclineReason($declineReason)
    {
        $this->declineReason = $declineReason;
        return $this;
    }

    /**
     *
     * @return the $isPreviousCancel
     */
    public function getIsPreviousCancel()
    {
        return $this->isPreviousCancel;
    }

    /**
     *
     * @param boolean $isPreviousCancel            
     */
    public function setIsPreviousCancel($isPreviousCancel)
    {
        $this->isPreviousCancel = $isPreviousCancel;
        return $this;
    }

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
     * @param \IMServices\Entity\text $cancelReason            
     */
    public function setCancelReason($cancelReason)
    {
        $this->cancelReason = $cancelReason;
        return $this;
    }

    /**
     *
     * @param number $id            
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return the $isIncludeRisk
     */
    public function getIsIncludeRisk()
    {
        return $this->isIncludeRisk;
    }

    /**
     * @param boolean $isIncludeRisk
     */
    public function setIsIncludeRisk($isIncludeRisk)
    {
        $this->isIncludeRisk = $isIncludeRisk;
        return $this;
    }

}

