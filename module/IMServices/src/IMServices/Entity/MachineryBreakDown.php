<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\MotorValueType;
use Settings\Entity\Insurer;
use Settings\Entity\VehicleValueType;

/**
 * This is also used by mahinery breakdown , This is also as a computer all risk and
 * electronic all risk , and plant all risk
 * @ORM\Entity
 * @ORM\Table(name="machinery_break_down")
 *
 * @author otaba
 *        
 */
class MachineryBreakDown
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="is_plant_all_risk", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPlantAllRisk;

    /**
     * This is a series of identifiers that properly identifies these machines
     * @ORM\Column(name="machine_unique_id", type="string", nullable=true)
     *
     * @var string
     */
    private $machineUniqueId;

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

    /**
     * @ORM\Column(name="purchase_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $purchaseDate;

    /**
     * A detailed description of the machine
     * @ORM\Column(name="machine_desc", type="text", nullable=true))
     *
     * @var text
     */
    private $machineDesc;

    /**
     * Defines if machine was acquired new or Tokunbo
     * @ORM\ManyToOne(targetEntity="Settings\Entity\VehicleValueType")
     *
     * @var VehicleValueType
     */
    private $machinePurchaseType;

    /**
     * Defines the use of the machinery
     * @ORM\Column(name="machine_use", type="text", nullable=true)
     *
     * @var text
     */
    private $machineUse;

    /**
     * Last Date of service
     * @ORM\Column(name="last_service_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $lastServiceDate;

    /**
     * Useful if only data is meant to be insured
     * @ORM\Column(name="sum_insured", type="string", nullable=true)
     *
     * @var string
     */
    private $sumInsured;

    /**
     * The servicibg company
     * @ORM\Column(name="service_company", type="string", nullable=true)
     *
     * @var string
     */
    private $serviceCompany;

    /**
     * @ORM\Column(name="is_cover_foundation",type="boolean", nullable=true )
     * 
     * @var boolean
     */
    private $isCoverFoundation;

    /**
     * Defines if there is a Fire and buglary Cover on the machine
     * @ORM\Column(name="is_fire_buglary",type="boolean", nullable=true )
     *
     * @var boolean
     */
    private $isFireBuglary;

    /**
     * The insurance Company Covering for the Fire and Buglary
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     *
     * @var Insurer
     */
    private $fireBuglaryInsurer;

    /**
     * @ORM\Column(name="is_previous_decline", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousDecline;

    /**
     * DEtails on the previous Decline containing reasons given
     * @ORM\Column(name="decline_details", type="text", nullable=true)
     *
     * @var text
     */
    private $declineDetails;

    /**
     * @ORM\Column(name="is_previous_loss", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPreviousLoss;

    /**
     * Information about previous loss
     * @ORM\Column(name="previous_loss", type="text", nullable=true)
     *
     * @var text
     */
    private $previousLoss;

    /**
     * Nau aditional Fact required for processing this policy
     * @ORM\Column(name="material_facts", type="text", nullable=true)
     *
     * @var text
     */
    private $materialFacts;

    /**
     * @ORM\Column(name="is_declaration", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDeclaration;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate($date)
    {
        $this->purchaseDate = $date;
        return $this;
    }

    public function getMachineDesc()
    {
        return $this->machineDesc;
    }

    public function setMachineDesc($desc)
    {
        $this->machineDesc = $desc;
        return $this;
    }

    public function getMachinePurchaseType()
    {
        return $this->machinePurchaseType;
    }

    public function setMachinePurchaseType($type)
    {
        $this->machinePurchaseType = $type;
        return $this;
    }

    public function getMachineUse()
    {
        return $this->machineUse;
    }

    public function setMachineUse($use)
    {
        $this->machineUse = $use;
        return $this;
    }

    public function getLastServiceDate()
    {
        return $this->lastServiceDate;
    }

    public function setLastServiceDate($date)
    {
        $this->lastServiceDate = $date;
        return $this;
    }

    public function getServiceCompany()
    {
        return $this->serviceCompany;
    }

    public function setServiceCompany($comp)
    {
        $this->serviceCompany = $comp;
        return $this;
    }

    public function getIsFireBuglary()
    {
        return $this->isFireBuglary;
    }

    public function setIsFireBuglary($lary)
    {
        $this->isFireBuglary = $lary;
        return $this;
    }

    public function getFireBuglaryInsurer()
    {
        return $this->fireBuglaryInsurer;
    }

    public function setFireBuglaryInsurer($ins)
    {
        $this->fireBuglaryInsurer = $ins;
        return $this;
    }

    public function getIsPreviousDecline()
    {
        return $this->isPreviousDecline;
    }

    public function setIsPreviousDecline($dec)
    {
        $this->isPreviousDecline = $dec;
        return $this;
    }

    public function getDeclineDetails()
    {
        return $this->declineDetails;
    }

    public function setDeclineDetails($det)
    {
        $this->declineDetails = $det;
        return $this;
    }

    public function getPreviousLoss()
    {
        return $this->previousLoss;
    }

    public function setPreviousLoss($loss)
    {
        $this->previousLoss = $loss;
        return $this;
    }

    public function getMaterialFacts()
    {
        return $this->materialFacts;
    }

    public function setMaterialFacts($facts)
    {
        $this->materialFacts = $facts;
        return $this;
    }

    public function getIsDeclaration()
    {
        return $this->isDeclaration;
    }

    public function setIsDeclaration($dec)
    {
        $this->isDeclaration = $dec;
        return $this;
    }

    public function setCoverDetails($details)
    {
        $this->coverDetails = $details;
        return $this;
    }

    /**
     *
     * @return the $machineUniqueId
     */
    public function getMachineUniqueId()
    {
        return $this->machineUniqueId;
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
     * @return the $sumInsured
     */
    public function getSumInsured()
    {
        return $this->sumInsured;
    }

    /**
     *
     * @param string $machineUniqueId            
     */
    public function setMachineUniqueId($machineUniqueId)
    {
        $this->machineUniqueId = $machineUniqueId;
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
     * @param string $sumInsured            
     */
    public function setSumInsured($sumInsured)
    {
        $this->sumInsured = $sumInsured;
        return $this;
    }
    /**
     * @return the $isCoverFoundation
     */
    public function getIsCoverFoundation()
    {
        return $this->isCoverFoundation;
    }

    /**
     * @return the $isPreviousLoss
     */
    public function getIsPreviousLoss()
    {
        return $this->isPreviousLoss;
    }

    /**
     * @param boolean $isCoverFoundation
     */
    public function setIsCoverFoundation($isCoverFoundation)
    {
        $this->isCoverFoundation = $isCoverFoundation;
        return $this;
    }

    /**
     * @param boolean $isPreviousLoss
     */
    public function setIsPreviousLoss($isPreviousLoss)
    {
        $this->isPreviousLoss = $isPreviousLoss;
        return $this;
    }
    /**
     * @return the $isPlantAllRisk
     */
    public function getIsPlantAllRisk()
    {
        return $this->isPlantAllRisk;
    }

    /**
     * @param boolean $isPlantAllRisk
     */
    public function setIsPlantAllRisk($isPlantAllRisk)
    {
        $this->isPlantAllRisk = $isPlantAllRisk;
        return $this;
    }


}

