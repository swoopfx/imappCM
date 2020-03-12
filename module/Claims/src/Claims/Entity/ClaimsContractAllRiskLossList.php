<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="claims_contract_all_risk_loss_list")
 * @author otaba
 *        
 */
class ClaimsContractAllRiskLossList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

//     /**
//      * Name of the machine
//      *
//      * @ORM\Column(name="machine_name", type="string",  nullalbe=true)
//      * @var string
//      */
//     private $machineName;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Claims\Entity\ClaimsContractAllRisk", inversedBy="lossList")
     * @var ClaimsContractAllRisk
     */
    private $claimsContractAllRisk;

    /**
     *Parts and extent of damage
     * @ORM\Column(name="part_n_extent_of_damage", type="text", nullable=true)
     * @var string
     */
    private $partnExtentDamaged;

    // Damaged device/ Machinery details

    /**
     * Name or definition of machinery 
     * @ORM\Column(name="machine_definition", type="string", nullable=true)
     * @var string
     */
    private $machineDefinition;

    /**
     *
     * @ORM\Column(name="item_no", type="string", nullable=true)
     * @var string
     */
    private $itemNo;

    /**
     * Make of the machine
     *
     * @ORM\Column(name="machine_make", type="string", nullable=true)
     * @var string
     */
    private $machineMake;

    /**
     * machine registration number 
     * @ORM\Column(name="registration_no", type="string", nullable=true)
     * @var string
     */
    private $registrationNo;

    /**
     *
     * @ORM\Column(name="year_of_manu", type="string", nullable=true)
     * @var string
     */
    private $yearOfManu;

    /**
     *
     * @ORM\Column(name="date_of_purchase", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $dateOfPurchase;

    /**
     *
     * @ORM\Column(name="machine_cost_price", type="string", nullable=true)
     * @var string
     */
    private $machineCostPrice;

    /**
     * Deduction for age, use and/or wear tear.....................................
     * @ORM\Column(name="deduction", type="string", nullable=true)
     * @var string
     */
    private $deduction;

    /**
     * Sum claimed present value
     *
     * @ORM\Column(name="present_claim_value", type="string", nullable=true)
     * @var string
     */
    private $presentClaimsValue;

    /**
     * This is the sum claimed for repair
     *
     * @ORM\Column(name="present_claim_repair_value", type="string", nullable=true)
     * @var string
     */
    private $presentClaimsRepairValue;

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
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
    public function getMachineName()
    {
        return $this->machineName;
    }

    /**
     * @return \Claims\Entity\ClaimsContractAllRisk
     */
    public function getClaimsContractAllRisk()
    {
        return $this->claimsContractAllRisk;
    }

    /**
     * @return string
     */
    public function getPartnExtentDamaged()
    {
        return $this->partnExtentDamaged;
    }

    /**
     * @return string
     */
    public function getMachineDefinition()
    {
        return $this->machineDefinition;
    }

    /**
     * @return string
     */
    public function getItemNo()
    {
        return $this->itemNo;
    }

    /**
     * @return string
     */
    public function getMachineMake()
    {
        return $this->machineMake;
    }

    /**
     * @return string
     */
    public function getRegistrationNo()
    {
        return $this->registrationNo;
    }

    /**
     * @return string
     */
    public function getYearOfManu()
    {
        return $this->yearOfManu;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfPurchase()
    {
        return $this->dateOfPurchase;
    }

    /**
     * @return string
     */
    public function getMachineCostPrice()
    {
        return $this->machineCostPrice;
    }

    /**
     * @return string
     */
    public function getDeduction()
    {
        return $this->deduction;
    }

    /**
     * @return string
     */
    public function getPresentClaimsValue()
    {
        return $this->presentClaimsValue;
    }

    /**
     * @return string
     */
    public function getPresentClaimsRepairValue()
    {
        return $this->presentClaimsRepairValue;
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
     * @param string $machineName
     */
    public function setMachineName($machineName)
    {
        $this->machineName = $machineName;
        return $this;
    }

    /**
     * @param \Claims\Entity\ClaimsContractAllRisk $claimsContractAllRisk
     */
    public function setClaimsContractAllRisk($claimsContractAllRisk)
    {
        $this->claimsContractAllRisk = $claimsContractAllRisk;
        return $this;
    }

    /**
     * @param string $partnExtentDamaged
     */
    public function setPartnExtentDamaged($partnExtentDamaged)
    {
        $this->partnExtentDamaged = $partnExtentDamaged;
        return $this;
    }

    /**
     * @param string $machineDefinition
     */
    public function setMachineDefinition($machineDefinition)
    {
        $this->machineDefinition = $machineDefinition;
        return $this;
    }

    /**
     * @param string $itemNo
     */
    public function setItemNo($itemNo)
    {
        $this->itemNo = $itemNo;
        return $this;
    }
    

    /**
     * @param string $machineMake
     */
    public function setMachineMake($machineMake)
    {
        $this->machineMake = $machineMake;
        return $this;
    }

    /**
     * @param string $registrationNo
     */
    public function setRegistrationNo($registrationNo)
    {
        $this->registrationNo = $registrationNo;
        return $this;
    }

    /**
     * @param string $yearOfManu
     */
    public function setYearOfManu($yearOfManu)
    {
        $this->yearOfManu = $yearOfManu;
        return $this;
    }

    /**
     * @param \DateTime $dateOfPurchase
     */
    public function setDateOfPurchase($dateOfPurchase)
    {
        $this->dateOfPurchase = $dateOfPurchase;
        return $this;
    }

    /**
     * @param string $machineCostPrice
     */
    public function setMachineCostPrice($machineCostPrice)
    {
        $this->machineCostPrice = $machineCostPrice;
        return $this;
    }

    /**
     * @param string $deduction
     */
    public function setDeduction($deduction)
    {
        $this->deduction = $deduction;
        return $this;
    }

    /**
     * @param string $presentClaimsValue
     */
    public function setPresentClaimsValue($presentClaimsValue)
    {
        $this->presentClaimsValue = $presentClaimsValue;
        return $this;
    }

    /**
     * @param string $presentClaimsRepairValue
     */
    public function setPresentClaimsRepairValue($presentClaimsRepairValue)
    {
        $this->presentClaimsRepairValue = $presentClaimsRepairValue;
        return $this;
    }

}

