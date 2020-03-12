<?php
namespace IMServices\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity
 *@ORM\Table(name="andvanced_payment_bond")
 * @author otaba
 *        
 */
class AdvancedPaymentBond
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="bond_value", type="string", nullable=true)
     * @var string
     */
    private $bondValue;
    
    /**
     * @ORM\Column(name="commence_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $commenceDate;
    
    /**
     * @ORM\Column(name="finish_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $finishDate;
    
    
    /**
     * This is the name of the party involved whose bond is issued in favour
     *@ORM\Column(name="party_name", type="string", nullable=true)
     * @var string
     */
    private $partyName;
    
    /**
     * @ORM\Column(name="party_address", type="text", nullable=true)
     *
     * @var text
     */
    private $partyAddress;
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     *
     * @var Currency
     */
    private $currency;
    
    /**
     * @ORM\Column(name="contract_price", type="string", nullable=true)
     *
     * @var string
     */
    private $contractPrice;
    
    /**
     * @ORM\Column(name="is_award_by_tender", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAwardedByTender;
    
    /**
     * @ORM\Column(name="tender_details", type="text", nullable=true)
     *
     * @var text
     */
    private $tenderDetails;
    
    /**
     * Number Identification of contract according to document
     * @ORM\Column(name="contract_no", type="string", nullable=true)
     *
     * @var string
     */
    private $contractNo;
    
    /**
     * This include Name, contact address of contractor
     * @ORM\Column(name="contractor_details", type="text", nullable=true)
     *
     * @var text
     */
    private $contractorDetails;
    
    /**
     * defined period for maintanace
     * @ORM\Column(name="maintenance_period", type="string", nullable=true)
     *
     * @var string
     */
    private $maintenancePeriod;
    
    /**
     * Contract Locatioin address with nearest landmark
     * @ORM\Column(name="contract_location", type="text", nullable=true)
     *
     * @var text
     */
    private $contractLocation;
    
    /**
     * Identifies if there should be a rentention value for maintenance
     * @ORM\Column(name="is_retention_for_maintenance", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isRetentionForMaintenance;
    
    /**
     * Percentage value for retention
     * @ORM\Column(name="maintenance_retention_value", type="string", nullable=true)
     *
     * @var string
     */
    private $maintenanceRententionValue;
    
    /**
     * Identifies if re-imbursement takes place for increased cost
     * @ORM\Column(name="is_reimburse_increased_cost", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isReimbuseIncresedCost;
    
    /**
     * Identifies if a project has been handle previously with this principal
     * @ORM\Column(name="is_previous_contract_with_principal", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousContractWithPrincipal;
    
    /**
     * Identifies if party owns all equipment used for this project
     * @ORM\Column(name="is_own_plantused", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isOwnPlantUsed;
    
    /**
     */
    public function __construct()
    {}
    
    public function getId()
    {
        return $this->id;
    }
    
    
    public function getBondValue(){
        return $this->bondValue;
    }
    
    public  function setBondValue($val){
        $this->bondValue = $val;
        return $this;
    }
    
    public function getCommenceDate(){
        return $this->commenceDate;
    }
    
    public function setCommenceDate($set){
        $this->commenceDate = $set;
        return $this;
    }
    
    public function getFinishDate(){
        return $this->finishDate;
    }
    
    public function setFinishDate($fin){
        $this->finishDate = $fin;
        return $this;
    }
    
    public function getPartyName()
    {
        return $this->partyName;
    }
    
    public function setPartyName($name)
    {
        $this->partyName = $name;
        return $this;
    }
    
    public function getPartyAddress()
    {
        return $this->partyAddress;
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
    
    public function getContractPrice()
    {
        return $this->contractPrice;
    }
    
    public function setContractPrice($price)
    {
        $this->contractPrice = $price;
        return $this;
    }
    
    public function getIsAwardedByTender()
    {
        return $this->isAwardedByTender;
    }
    
    public function setIsAwardedByTender($set)
    {
        $this->isAwardedByTender = $set;
        return $this;
    }
    
    public function getTenderDetails()
    {
        return $this->tenderDetails;
    }
    
    public function getContractNo()
    {
        return $this->contractNo;
    }
    
    public function setContractNo($no)
    {
        $this->contractNo = $no;
        return $this;
    }
    
    public function getContractorDetails()
    {
        return $this->contractorDetails;
    }
    
    public function setContractorDetails($det)
    {
        $this->contractorDetails = $det;
        return $this;
    }
    
    public function getMaintenancePeriod()
    {
        return $this->maintenancePeriod;
    }
    
    public function setMaintenancePeriod($ped)
    {
        $this->maintenancePeriod = $ped;
        return $this;
    }
    
    public function getContractLocation()
    {
        return $this->contractLocation;
    }
    
    public function setContractLocationn($loc)
    {
        $this->contractLocation = $loc;
        return $this;
    }
    
    public function getIsRetentionForMaintenance()
    {
        return $this->isRetentionForMaintenance;
    }
    
    public function setIsRetentionForMaintenance($is)
    {
        $this->isRetentionForMaintenance = $is;
        return $this;
    }
    
    public function getMaintenanceRententionValue()
    {
        return $this->maintenanceRententionValue;
    }
    
    public function setMaintenanceRententionValue($main)
    {
        $this->maintenanceRententionValue = $main;
        return $this;
    }
    
    public function getIsReimbuseIncresedCost()
    {
        return $this->isReimbuseIncresedCost;
    }
    
    public function setIsReimbuseIncresedCost($is)
    {
        $this->isReimbuseIncresedCost = $is;
        return $this;
    }
    
    public function getIsPreviousContractWithPrincipal()
    {
        return $this->isPreviousContractWithPrincipal;
    }
    
    public function setIsPreviousContractWithPrincipal($set)
    {
        $this->isPreviousContractWithPrincipal = $set;
        return $this;
    }
    
    public function getIsOwnPlantUsed()
    {
        return $this->isOwnPlantUsed;
    }
    
    public function setIsOwnPlantUsed($set)
    {
        $this->isOwnPlantUsed = $set;
        return $this;
    }
}

