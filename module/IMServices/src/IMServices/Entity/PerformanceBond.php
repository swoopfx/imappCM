<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="performance_bond")
 *
 * @author otaba
 *        
 */
class PerformanceBond
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="AdvancedPaymentBond")
     * 
     * @var AdvancedPaymentBond
     */
    private $advancedPaymentBond;

//     /**
//      * @ORM\OneToMany(targetEntity="PerfomanceBondLiability")
//      * 
//      * @var PerfomanceBondLiability
//      */
//     private $performanceBondLiability;

//     /**
//      * @ORM\OneToMany(targetEntity="PerformanceBondAsset", mappedBy="performancebond")
//      * 
//      * @var PerformanceBondAsset
//      */
//     private $performanceBondAsset;
    
    // private
    
    // /**
    // * @ORM\Column(name="bond_value", type="string", nullable=true)
    // *
    // * @var string
    // */
    // private $bondValue;
    
    // /**
    // * @ORM\Column(name="commence_date", type="datetime", nullable=true)
    // *
    // * @var \DateTime
    // */
    // private $commenceDate;
    
    // /**
    // * @ORM\Column(name="finish_date", type="datetime", nullable=true)
    // *
    // * @var \DateTime
    // */
    // private $finishDate;
    
    // /**
    // * This is the name of the party involved whose bond is issued in favour
    // * @ORM\Column(name="party_name", type="string", nullable=true)
    // *
    // * @var string
    // */
    // private $partyName;
    
    // /**
    // * @ORM\Column(name="party_address", type="text", nullable=true)
    // *
    // * @var text
    // */
    // private $partyAddress;
    
    // /**
    // * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
    // *
    // * @var Currency
    // */
    // private $currency;
    
    // /**
    // * @ORM\Column(name="contract_price", type="string", nullable=true)
    // *
    // * @var string
    // */
    // private $contractPrice;
    
    // /**
    // * Was Contracted awarded by Tender?
    // * @ORM\Column(name="is_award_by_tender", type="boolean", nullable=true)
    // *
    // * @var boolean
    // */
    // private $isAwardedByTender;
    
    // /**
    // * If yes, please provide details of other Tenders
    // * @ORM\Column(name="tender_details", type="text", nullable=true)
    // *
    // * @var text
    // */
    // private $tenderDetails;
    
    // /**
    // * Number Identification of contract according to document
    // * @ORM\Column(name="contract_no", type="string", nullable=true)
    // *
    // * @var string
    // */
    // private $contractNo;
    
    // /**
    // * This include Name, contact address of contractor
    // * @ORM\Column(name="contractor_details", type="text", nullable=true)
    // *
    // * @var text
    // */
    // private $contractorDetails;
    
    // /**
    // * defined period for maintanace in months
    // * @ORM\Column(name="maintenance_period", type="string", nullable=true)
    // *
    // * @var string
    // */
    // private $maintenancePeriod;
    
    // /**
    // * Contract Locatioin address with nearest landmark
    // * @ORM\Column(name="contract_location", type="text", nullable=true)
    // *
    // * @var text
    // */
    // private $contractLocation;
    
    // /**
    // * Description of work:
    // * @ORM\Column(name="work_description", type="text", nullable=true)
    // *
    // * @var text
    // */
    // private $workDescription;
    
    // /**
    // * @ORM\Column(name="is_standard_condition_apply", type="boolean", nullable=true)
    // *
    // * @var boolean
    // */
    // private $isStandardConditionApply;
    
    // /**
    // * Identifies if there should be a rentention value for maintenance
    // * @ORM\Column(name="is_retention_for_maintenance", type="boolean", nullable=true)
    // *
    // * @var boolean
    // */
    // private $isRetentionForMaintenance;
    
    // /**
    // * Percentage value for retention
    // * @ORM\Column(name="maintenance_retention_value", type="string", nullable=true)
    // *
    // * @var string
    // */
    // private $maintenanceRententionValue;
    
    // /**
    // * Identifies if re-imbursement takes place for increased cost
    // * @ORM\Column(name="is_reimburse_increased_cost", type="boolean", nullable=true)
    // *
    // * @var boolean
    // */
    // private $isReimbuseIncresedCost;
    
    // /**
    // * Identifies if a project has been handle previously with this principal
    // * @ORM\Column(name="is_previous_contract_with_principal", type="boolean", nullable=true)
    // *
    // * @var boolean
    // */
    // private $isPreviousContractWithPrincipal;
    
    // /**
    // * Do you own all plant & equipment required to complete contract?
    // * Identifies if party owns all equipment used for this project
    // * @ORM\Column(name="is_own_plantused", type="boolean", nullable=true)
    // *
    // * @var boolean
    // */
    // private $isOwnPlantUsed;
    
    // /**
    // * Has Liabilities
    // * @ORM\Column(name="is_liabilities", type="boolean", nullable=true)
    // * @var boolean
    // */
    // private $isLiabilities;
    
    // /**
    // * @ORM\OneToMany(targetEntity="IMServices\Entity\PerfomanceBondLiability", mappedBy="performanceBond")
    // * @var Collection
    // */
    // private $bondLiability;
    
    // /**
    // * The name of the lender
    // * @ORM\Column(name="liabilities_overdraft", type="string", nullable=true)
    // * @var string
    // */
    // private $liabilitiesOverDraftName;
    
    // /**
    // * @ORM\Column(name="liability_limit", type="string", nullable=true)
    // * @var string
    // */
    // private $liabilityLimit;
    
    // /**
    // * @ORM\Column(name="interest_accrued", type="string", nullable=true)
    // * @var string
    // */
    // private $interestAccrued;
    
    // /**
    // * @ORM\Column(name="due_date", type="datetime", nullable=true)
    // * @var string
    // */
    // private $dueDate;
    
    // /**
    // * @ORM\Column(name="amount_owing", type="string", nullable=true)
    // * @var string
    // */
    // private $amountOwing;
    
    // /**
    // * @ORM\Column(name="contingents_liabilities", type="text", nullable=true)
    // * @var text
    // */
    // private $contingentLiabiites;
    
    // /**
    // * @ORM\Column(name="is_asset", type="boolean", nullable=true)
    // * @var boolean
    // */
    // private $isAsset;
    
    // /**
    // * @ORM\Column(name="is_shared_portfolio", type="boolean", nullable=true)
    // * @var boolean
    // */
    // private $isSharePortfolio;
    
    // /**
    // *
    // * @var boolean
    // */
    // private $isRealEstate;
    
    // /**
    // *
    // * @var boolean
    // */
    // private $isMotorAssets;
    
    // /**
    // *
    // * @var boolean
    // */
    // private $isOtherAssets;
    
    // /**
    // */
    // public function __construct()
    // {}
    
    // public function getId()
    // {
    // return $this->id;
    // }
    
    // public function getBondValue()
    // {
    // return $this->bondValue;
    // }
    
    // public function setBondValue($val)
    // {
    // $this->bondValue = $val;
    // return $this;
    // }
    
    // public function getCommenceDate()
    // {
    // return $this->commenceDate;
    // }
    
    // public function setCommenceDate($set)
    // {
    // $this->commenceDate = $set;
    // return $this;
    // }
    
    // public function getFinishDate()
    // {
    // return $this->finishDate;
    // }
    
    // public function setFinishDate($fin)
    // {
    // $this->finishDate = $fin;
    // return $this;
    // }
    
    // public function getPartyName()
    // {
    // return $this->partyName;
    // }
    
    // public function setPartyName($name)
    // {
    // $this->partyName = $name;
    // return $this;
    // }
    
    // public function getPartyAddress()
    // {
    // return $this->partyAddress;
    // }
    
    // public function getCurrency()
    // {
    // return $this->currency;
    // }
    
    // public function setCurrency($cur)
    // {
    // $this->currency = $cur;
    // return $this;
    // }
    
    // public function getContractPrice()
    // {
    // return $this->contractPrice;
    // }
    
    // public function setContractPrice($price)
    // {
    // $this->contractPrice = $price;
    // return $this;
    // }
    
    // public function getIsAwardedByTender()
    // {
    // return $this->isAwardedByTender;
    // }
    
    // public function setIsAwardedByTender($set)
    // {
    // $this->isAwardedByTender = $set;
    // return $this;
    // }
    
    // public function getTenderDetails()
    // {
    // return $this->tenderDetails;
    // }
    
    // public function getContractNo()
    // {
    // return $this->contractNo;
    // }
    
    // public function setContractNo($no)
    // {
    // $this->contractNo = $no;
    // return $this;
    // }
    
    // public function getContractorDetails()
    // {
    // return $this->contractorDetails;
    // }
    
    // public function setContractorDetails($det)
    // {
    // $this->contractorDetails = $det;
    // return $this;
    // }
    
    // public function getMaintenancePeriod()
    // {
    // return $this->maintenancePeriod;
    // }
    
    // public function setMaintenancePeriod($ped)
    // {
    // $this->maintenancePeriod = $ped;
    // return $this;
    // }
    
    // public function getContractLocation()
    // {
    // return $this->contractLocation;
    // }
    
    // public function setContractLocationn($loc)
    // {
    // $this->contractLocation = $loc;
    // return $this;
    // }
    
    // public function getIsRetentionForMaintenance()
    // {
    // return $this->isRetentionForMaintenance;
    // }
    
    // public function setIsRetentionForMaintenance($is)
    // {
    // $this->isRetentionForMaintenance = $is;
    // return $this;
    // }
    
    // public function getMaintenanceRententionValue()
    // {
    // return $this->maintenanceRententionValue;
    // }
    
    // public function setMaintenanceRententionValue($main)
    // {
    // $this->maintenanceRententionValue = $main;
    // return $this;
    // }
    
    // public function getIsReimbuseIncresedCost()
    // {
    // return $this->isReimbuseIncresedCost;
    // }
    
    // public function setIsReimbuseIncresedCost($is)
    // {
    // $this->isReimbuseIncresedCost = $is;
    // return $this;
    // }
    
    // public function getIsPreviousContractWithPrincipal()
    // {
    // return $this->isPreviousContractWithPrincipal;
    // }
    
    // public function setIsPreviousContractWithPrincipal($set)
    // {
    // $this->isPreviousContractWithPrincipal = $set;
    // return $this;
    // }
    
    // public function getIsOwnPlantUsed()
    // {
    // return $this->isOwnPlantUsed;
    // }
    
    // public function setIsOwnPlantUsed($set)
    // {
    // $this->isOwnPlantUsed = $set;
    // return $this;
    // }
    // /**
    // * @return the $workDescription
    // */
    // public function getWorkDescription()
    // {
    // return $this->workDescription;
    // }
    
    // /**
    // * @param \IMServices\Entity\text $workDescription
    // */
    // public function setWorkDescription($workDescription)
    // {
    // $this->workDescription = $workDescription;
    // }
    
    // /**
    // * @return the $isStandardConditionApply
    // */
    // public function getIsStandardConditionApply()
    // {
    // return $this->isStandardConditionApply;
    // }
    
    // /**
    // * @param boolean $isStandardConditionApply
    // */
    // public function setIsStandardConditionApply($isStandardConditionApply)
    // {
    // $this->isStandardConditionApply = $isStandardConditionApply;
    // }
    
    // /**
    // * @return the $isLiabilities
    // */
    // public function getIsLiabilities()
    // {
    // return $this->isLiabilities;
    // }
    
    // /**
    // * @param boolean $isLiabilities
    // */
    // public function setIsLiabilities($isLiabilities)
    // {
    // $this->isLiabilities = $isLiabilities;
    // }
    
    // /**
    // * @return the $bondLiability
    // */
    // public function getBondLiability()
    // {
    // return $this->bondLiability;
    // }
    
    // /**
    // * @param \Doctrine\Common\Collections\Collection $bondLiability
    // */
    // public function setBondLiability($bondLiability)
    // {
    // $this->bondLiability = $bondLiability;
    // }
    
    // /**
    // * @return the $liabilitiesOverDraftName
    // */
    // public function getLiabilitiesOverDraftName()
    // {
    // return $this->liabilitiesOverDraftName;
    // }
    
    // /**
    // * @param string $liabilitiesOverDraftName
    // */
    // public function setLiabilitiesOverDraftName($liabilitiesOverDraftName)
    // {
    // $this->liabilitiesOverDraftName = $liabilitiesOverDraftName;
    // }
    
    // /**
    // * @return the $liabilityLimit
    // */
    // public function getLiabilityLimit()
    // {
    // return $this->liabilityLimit;
    // }
    
    // /**
    // * @param string $liabilityLimit
    // */
    // public function setLiabilityLimit($liabilityLimit)
    // {
    // $this->liabilityLimit = $liabilityLimit;
    // }
    
    // /**
    // * @return the $interestAccrued
    // */
    // public function getInterestAccrued()
    // {
    // return $this->interestAccrued;
    // }
    
    // /**
    // * @param string $interestAccrued
    // */
    // public function setInterestAccrued($interestAccrued)
    // {
    // $this->interestAccrued = $interestAccrued;
    // }
    
    // /**
    // * @return the $dueDate
    // */
    // public function getDueDate()
    // {
    // return $this->dueDate;
    // }
    
    // /**
    // * @param string $dueDate
    // */
    // public function setDueDate($dueDate)
    // {
    // $this->dueDate = $dueDate;
    // }
    
    // /**
    // * @return the $amountOwing
    // */
    // public function getAmountOwing()
    // {
    // return $this->amountOwing;
    // }
    
    // /**
    // * @param string $amountOwing
    // */
    // public function setAmountOwing($amountOwing)
    // {
    // $this->amountOwing = $amountOwing;
    // }
    
    // /**
    // * @return the $contingentLiabiites
    // */
    // public function getContingentLiabiites()
    // {
    // return $this->contingentLiabiites;
    // }
    
    // /**
    // * @param \IMServices\Entity\text $contingentLiabiites
    // */
    // public function setContingentLiabiites($contingentLiabiites)
    // {
    // $this->contingentLiabiites = $contingentLiabiites;
    // }
    
    // /**
    // * @return the $isAsset
    // */
    // public function getIsAsset()
    // {
    // return $this->isAsset;
    // }
    
    // /**
    // * @param boolean $isAsset
    // */
    // public function setIsAsset($isAsset)
    // {
    // $this->isAsset = $isAsset;
    // }
    
    // /**
    // * @return the $isSharePortfolio
    // */
    // public function getIsSharePortfolio()
    // {
    // return $this->isSharePortfolio;
    // }
    
    // /**
    // * @param boolean $isSharePortfolio
    // */
    // public function setIsSharePortfolio($isSharePortfolio)
    // {
    // $this->isSharePortfolio = $isSharePortfolio;
    // }
    
    // /**
    // * @return the $isRealEstate
    // */
    // public function getIsRealEstate()
    // {
    // return $this->isRealEstate;
    // }
    
    // /**
    // * @param boolean $isRealEstate
    // */
    // public function setIsRealEstate($isRealEstate)
    // {
    // $this->isRealEstate = $isRealEstate;
    // }
    
    // /**
    // * @return the $isMotorAssets
    // */
    // public function getIsMotorAssets()
    // {
    // return $this->isMotorAssets;
    // }
    
    // /**
    // * @param boolean $isMotorAssets
    // */
    // public function setIsMotorAssets($isMotorAssets)
    // {
    // $this->isMotorAssets = $isMotorAssets;
    // }
    
    // /**
    // * @return the $isOtherAssets
    // */
    // public function getIsOtherAssets()
    // {
    // return $this->isOtherAssets;
    // }
    
    // /**
    // * @param boolean $isOtherAssets
    // */
    // public function setIsOtherAssets($isOtherAssets)
    // {
    // $this->isOtherAssets = $isOtherAssets;
    // }
    
    // /**
    // * @param number $id
    // */
    // public function setId($id)
    // {
    // $this->id = $id;
    // }
    
    // /**
    // * @param \IMServices\Entity\text $partyAddress
    // */
    // public function setPartyAddress($partyAddress)
    // {
    // $this->partyAddress = $partyAddress;
    // }
    
    // /**
    // * @param \IMServices\Entity\text $tenderDetails
    // */
    // public function setTenderDetails($tenderDetails)
    // {
    // $this->tenderDetails = $tenderDetails;
    // }
    
    // /**
    // * @param \IMServices\Entity\text $contractLocation
    // */
    // public function setContractLocation($contractLocation)
    // {
    // $this->contractLocation = $contractLocation;
    // }
}

