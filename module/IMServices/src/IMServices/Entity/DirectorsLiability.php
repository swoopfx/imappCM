<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\CompanyStatusType;
use Settings\Entity\Country;
// use Settings\Entity\CompanyListType;
use Settings\Entity\Insurer;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Settings\Entity\DirectorLiabilityProcedureList;

/**
 * @ORM\Entity
 * @ORM\Table(name="director_liability")
 *
 * @author otaba
 *        
 */
class DirectorsLiability
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Defines what the company does and any other subsidiaries
     * @ORM\Column(name="business_activity", type="text", nullable=true)
     *
     * @var string
     */
    private $businessActivity;

    /**
     * Defines the duration of company in business
     * @ORM\Column(name="in_business_duration", type="string", nullable=true)
     *
     * @var integer
     */
    private $inBusinessDuration;

    // In the past five years
    /**
     * @ORM\Column(name="is_name_changed", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isNameChanged;

    /**
     * identifies if an acquisition or merger has taken place
     * @ORM\Column(name="is_acquisition", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAcquisition;

    /**
     * Details about the acquisition
     * @ORM\Column(name="acquisition_details", type="text", nullable=true)
     *
     * @var text
     */
    private $acquisitionDetails;

    /**
     * Any subsidiary company been sold or ceased trading?
     * @ORM\Column(name="is_ceased_trading", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCeasedTrading;

    /**
     * @ORM\Column(name="is_pending_merger", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPendingMerger;

    /**
     * @ORM\Column(name="is_acquisition_proposal", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAcquisitionProposal;

    /**
     * Is the Company intending a new public offering of
     * securities within the next year in the RSA, UK, United
     * States of America, ECOWAS countries or elsewhere?.
     *
     * @ORM\Column(name="is_tending_new_offering", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isTendingNewOffering;

    /**
     * @ORM\Column(name="company_offering", type="text", nullable=true)
     *
     * @var text
     */
    private $companyOffering;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\CompanyStatusType")
     *
     * @var CompanyStatusType
     */
    private $companyStatus;
    
    /**
     * @ORM\Column(name="other_company_status", type="string", nullable=true)
     * @var string
     */
    private $otherCompanyStatus;

    /**
     * Details of the foriegn SE country, Name and type of listing
     * @ORM\Column(name="foriegn_se_details", type="text", nullable=true)
     *
     * @var text
     */
    private $foriegnSeDetails;

    /**
     * @ORM\Column(name="total_share_holders", type="string", nullable=true)
     *
     * @var string
     */
    private $totalShareHolders;

    /**
     * @ORM\Column(name="total_chares_issured", type="string", nullable=true)
     *
     * @var string
     */
    private $totalSharesIssued;

    /**
     * @ORM\Column(name="total_directors_share", type="string", nullable=true)
     *
     * @var string
     */
    private $totalDirectorShares;

    /**
     * Does the Company or any Director or Officer have Directors
     * & Officers Liability Insurance in force?
     *
     * @ORM\Column(name="is_director_liability", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDirectorLiability;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     *
     * @var Insurer
     */
    private $insurer;

    /**
     * @ORM\Column(name="indemnity_limit", type="string", nullable=true)
     *
     * @var string
     */
    private $indemnityLimit;

    /**
     * @ORM\Column(name="expiry_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $expiryDate;

    /**
     * Has the Company ever had any insurer decline a proposal or
     * cancel or refuse to renew a Directors & Officers Liability
     * @ORM\Column(name="is_decline", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDecline;

    /**
     * @ORM\Column(name="decline_details", type="text", nullable=true)
     *
     * @var text
     */
    private $declineDetails;

    /**
     * Have any Directors and/or Executive Officers of the company
     * resigned or been replaced in the past 12 months?
     * @ORM\Column(name="is_director_resign", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDirectorResign;

    /**
     * If “yes”, who and why?
     * @ORM\Column(name="resign_details", type="text", nullable=true)
     *
     * @var text
     */
    private $resignDetails;

    /**
     * @ORM\Column(name="is_clams", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isClaims;

    /**
     * @ORM\Column(name="calims_details", type="text", nullable=true)
     *
     * @var text
     */
    private $claimsDetails;

    /**
     * @ORM\Column(name="is_employment_practice_cover", type="boolean", nullable=true)
     *
     * @var booolean
     */
    private $isEmploymentPracticeCover;

    /**
     * @ORM\Column(name="is_human_resource_dept", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isHumanResourceDept;

    /**
     * If “yes”, how many employees are there in this department
     * @ORM\Column(name="dept_number_employee", type="string", nullable=true)
     *
     * @var string
     */
    private $deptNumberOfEmployee;

    /**
     * If “no”, how is the function handled
     * @ORM\Column(name="hr_function_handled", type="text", nullable=true)
     *
     * @var text
     */
    private $hrFunctionHandled;

    /*
     * How many officers and other employees have resigned, been terminated
     * (with or without cause) or have taken early retirement within the last 24
     * months:
     */
    
    /**
     * Number of sacked employees
     * @ORM\Column(name="sacked_employees", type="string", nullable=true)
     *
     * @var string
     */
    private $sackedEmployees;

    /**
     * Number of sacked officers
     * @ORM\Column(name="sacked_officers", type="string", nullable=true)
     *
     * @var string
     */
    private $sackedOfficers;

    /**
     * Does the Proposer have a written human resourses
     * manual or equivalent written management guidelines
     * @ORM\Column(name="is_hr_manual", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isHRManual;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Settings\Entity\DirectorLiabilityProcedureList", cascade={"persist","remove"})
     * @ORM\JoinTable(name="directors_liability_procedure_list", joinColumns={
     * @ORM\JoinColumn(name="director_liabilirty_id", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="procedure_list_id", referencedColumnName="id")
     * })
     *
     * 
     * @var Collection
     *
     */
    private $procedureList;

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
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
     *
     * @return the $businessActivity
     */
    public function getBusinessActivity()
    {
        return $this->businessActivity;
    }

    /**
     *
     * @param string $businessActivity            
     */
    public function setBusinessActivity($businessActivity)
    {
        $this->businessActivity = $businessActivity;
        return $this;
    }

    /**
     *
     * @return the $inBusinessDuration
     */
    public function getInBusinessDuration()
    {
        return $this->inBusinessDuration;
    }

    /**
     *
     * @param number $inBusinessDuration            
     */
    public function setInBusinessDuration($inBusinessDuration)
    {
        $this->inBusinessDuration = $inBusinessDuration;
        return $this;
    }

    /**
     *
     * @return the $isNameChanged
     */
    public function getIsNameChanged()
    {
        return $this->isNameChanged;
    }

    /**
     *
     * @param boolean $isNameChanged            
     */
    public function setIsNameChanged($isNameChanged)
    {
        $this->isNameChanged = $isNameChanged;
        return $this;
    }

    /**
     *
     * @return the $isAcquisition
     */
    public function getIsAcquisition()
    {
        return $this->isAcquisition;
    }

    /**
     *
     * @param boolean $isAcquisition            
     */
    public function setIsAcquisition($isAcquisition)
    {
        $this->isAcquisition = $isAcquisition;
        return $this;
    }

    /**
     *
     * @return the $acquisitionDetails
     */
    public function getAcquisitionDetails()
    {
        return $this->acquisitionDetails;
    }

    /**
     *
     * @param \IMServices\Entity\text $acquisitionDetails            
     */
    public function setAcquisitionDetails($acquisitionDetails)
    {
        $this->acquisitionDetails = $acquisitionDetails;
        return $this;
    }

    /**
     *
     * @return the $isCeasedTrading
     */
    public function getIsCeasedTrading()
    {
        return $this->isCeasedTrading;
    }

    /**
     *
     * @param boolean $isCeasedTrading            
     */
    public function setIsCeasedTrading($isCeasedTrading)
    {
        $this->isCeasedTrading = $isCeasedTrading;
        return $this;
    }

    /**
     *
     * @return the $isPendingMerger
     */
    public function getIsPendingMerger()
    {
        return $this->isPendingMerger;
    }

    /**
     *
     * @param boolean $isPendingMerger            
     */
    public function setIsPendingMerger($isPendingMerger)
    {
        $this->isPendingMerger = $isPendingMerger;
        return $this;
    }

    /**
     *
     * @return the $isAcquisitionProposal
     */
    public function getIsAcquisitionProposal()
    {
        return $this->isAcquisitionProposal;
    }

    /**
     *
     * @param boolean $isAcquisitionProposal            
     */
    public function setIsAcquisitionProposal($isAcquisitionProposal)
    {
        $this->isAcquisitionProposal = $isAcquisitionProposal;
        return $this;
    }

    /**
     *
     * @return the $isTendingNewOffering
     */
    public function getIsTendingNewOffering()
    {
        return $this->isTendingNewOffering;
    }

    /**
     *
     * @param boolean $isTendingNewOffering            
     */
    public function setIsTendingNewOffering($isTendingNewOffering)
    {
        $this->isTendingNewOffering = $isTendingNewOffering;
        return $this;
    }

    /**
     *
     * @return the $companyOffering
     */
    public function getCompanyOffering()
    {
        return $this->companyOffering;
    }

    /**
     *
     * @param \IMServices\Entity\text $companyOffering            
     */
    public function setCompanyOffering($companyOffering)
    {
        $this->companyOffering = $companyOffering;
        return $this;
    }

    /**
     *
     * @return the $companyStatus
     */
    public function getCompanyStatus()
    {
        return $this->companyStatus;
    }

    /**
     *
     * @param \Settings\Entity\CompanyStatusType $companyStatus            
     */
    public function setCompanyStatus($companyStatus)
    {
        $this->companyStatus = $companyStatus;
        return $this;
    }

    /**
     *
     * @return the $foriegnSeDetails
     */
    public function getForiegnSeDetails()
    {
        return $this->foriegnSeDetails;
    }

    /**
     *
     * @param \IMServices\Entity\text $foriegnSeDetails            
     */
    public function setForiegnSeDetails($foriegnSeDetails)
    {
        $this->foriegnSeDetails = $foriegnSeDetails;
        return $this;
    }

    /**
     *
     * @return the $totalShareHolders
     */
    public function getTotalShareHolders()
    {
        return $this->totalShareHolders;
    }

    /**
     *
     * @param string $totalShareHolders            
     */
    public function setTotalShareHolders($totalShareHolders)
    {
        $this->totalShareHolders = $totalShareHolders;
        return $this;
    }

    /**
     *
     * @return the $totalSharesIssued
     */
    public function getTotalSharesIssued()
    {
        return $this->totalSharesIssued;
    }

    /**
     *
     * @param string $totalSharesIssued            
     */
    public function setTotalSharesIssued($totalSharesIssued)
    {
        $this->totalSharesIssued = $totalSharesIssued;
        return $this;
    }

    /**
     *
     * @return the $totalDirectorShares
     */
    public function getTotalDirectorShares()
    {
        return $this->totalDirectorShares;
    }

    /**
     *
     * @param string $totalDirectorShares            
     */
    public function setTotalDirectorShares($totalDirectorShares)
    {
        $this->totalDirectorShares = $totalDirectorShares;
        return $this;
    }

    /**
     *
     * @return the $isDirectorLiability
     */
    public function getIsDirectorLiability()
    {
        return $this->isDirectorLiability;
    }

    /**
     *
     * @param boolean $isDirectorLiability            
     */
    public function setIsDirectorLiability($isDirectorLiability)
    {
        $this->isDirectorLiability = $isDirectorLiability;
        return $this;
    }

    /**
     *
     * @return the $insurer
     */
    public function getInsurer()
    {
        return $this->insurer;
    }

    /**
     *
     * @param \Settings\Entity\Insurer $insurer            
     */
    public function setInsurer($insurer)
    {
        $this->insurer = $insurer;
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
     * @param string $indemnityLimit            
     */
    public function setIndemnityLimit($indemnityLimit)
    {
        $this->indemnityLimit = $indemnityLimit;
        return $this;
    }

    /**
     *
     * @return the $expiryDate
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     *
     * @param DateTime $expiryDate            
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;
        return $this;
    }

    /**
     *
     * @return the $isDecline
     */
    public function getIsDecline()
    {
        return $this->isDecline;
    }

    /**
     *
     * @param boolean $isDecline            
     */
    public function setIsDecline($isDecline)
    {
        $this->isDecline = $isDecline;
        return $this;
    }

    /**
     *
     * @return the $declineDetails
     */
    public function getDeclineDetails()
    {
        return $this->declineDetails;
    }

    /**
     *
     * @param \IMServices\Entity\text $declineDetails            
     */
    public function setDeclineDetails($declineDetails)
    {
        $this->declineDetails = $declineDetails;
        return $this;
    }

    /**
     *
     * @return the $isDirectorResign
     */
    public function getIsDirectorResign()
    {
        return $this->isDirectorResign;
    }

    /**
     *
     * @param boolean $isDirectorResign            
     */
    public function setIsDirectorResign($isDirectorResign)
    {
        $this->isDirectorResign = $isDirectorResign;
        return $this;
    }

    /**
     *
     * @return the $resignDetails
     */
    public function getResignDetails()
    {
        return $this->resignDetails;
    }

    /**
     *
     * @param \IMServices\Entity\text $resignDetails            
     */
    public function setResignDetails($resignDetails)
    {
        $this->resignDetails = $resignDetails;
        return $this;
    }

    /**
     *
     * @return the $isClaims
     */
    public function getIsClaims()
    {
        return $this->isClaims;
    }

    /**
     *
     * @param boolean $isClaims            
     */
    public function setIsClaims($isClaims)
    {
        $this->isClaims = $isClaims;
        return $this;
    }

    /**
     *
     * @return the $claimsDetails
     */
    public function getClaimsDetails()
    {
        return $this->claimsDetails;
    }

    /**
     *
     * @param \IMServices\Entity\text $claimsDetails            
     */
    public function setClaimsDetails($claimsDetails)
    {
        $this->claimsDetails = $claimsDetails;
        return $this;
    }

    /**
     *
     * @return the $isEmploymentPracticeCover
     */
    public function getIsEmploymentPracticeCover()
    {
        return $this->isEmploymentPracticeCover;
    }

    /**
     *
     * @param \IMServices\Entity\booolean $isEmploymentPracticeCover            
     */
    public function setIsEmploymentPracticeCover($isEmploymentPracticeCover)
    {
        $this->isEmploymentPracticeCover = $isEmploymentPracticeCover;
        return $this;
    }

    /**
     *
     * @return the $isHumanResourceDept
     */
    public function getIsHumanResourceDept()
    {
        return $this->isHumanResourceDept;
    }

    /**
     *
     * @param boolean $isHumanResourceDept            
     */
    public function setIsHumanResourceDept($isHumanResourceDept)
    {
        $this->isHumanResourceDept = $isHumanResourceDept;
        return $this;
    }

    /**
     *
     * @return the $deptNumberOfEmployee
     */
    public function getDeptNumberOfEmployee()
    {
        return $this->deptNumberOfEmployee;
    }

    /**
     *
     * @param string $deptNumberOfEmployee            
     */
    public function setDeptNumberOfEmployee($deptNumberOfEmployee)
    {
        $this->deptNumberOfEmployee = $deptNumberOfEmployee;
        return $this;
    }

    /**
     *
     * @return the $hrFunctionHandled
     */
    public function getHrFunctionHandled()
    {
        return $this->hrFunctionHandled;
    }

    /**
     *
     * @param \IMServices\Entity\text $hrFunctionHandled            
     */
    public function setHrFunctionHandled($hrFunctionHandled)
    {
        $this->hrFunctionHandled = $hrFunctionHandled;
        return $this;
    }

    /**
     *
     * @return the $sackedEmployees
     */
    public function getSackedEmployees()
    {
        return $this->sackedEmployees;
    }

    /**
     *
     * @param string $sackedEmployees            
     */
    public function setSackedEmployees($sackedEmployees)
    {
        $this->sackedEmployees = $sackedEmployees;
        return $this;
    }

    /**
     *
     * @return the $sackedOfficers
     */
    public function getSackedOfficers()
    {
        return $this->sackedOfficers;
    }

    /**
     *
     * @param string $sackedOfficers            
     */
    public function setSackedOfficers($sackedOfficers)
    {
        $this->sackedOfficers = $sackedOfficers;
        return $this;
    }

    /**
     *
     * @return the $isHRManual
     */
    public function getIsHRManual()
    {
        return $this->isHRManual;
    }

    /**
     *
     * @param boolean $isHRManual            
     */
    public function setIsHRManual($isHRManual)
    {
        $this->isHRManual = $isHRManual;
        return $this;
    }

    /**
     *
     * @return the $procedureList
     */
    public function getProcedureList()
    {
        return $this->procedureList;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $procedureList            
     */
    public function setProcedureList($procedureList)
    {
        $this->procedureList = $procedureList;
        return $this;
    }

    public function addProcedureList($procedureList)
    {
        if (! $this->procedureList->contains($procedureList)) {
            foreach ($procedureList as $list) {
                $this->procedureList->add($list);
            }
        }
        return $this;
    }

    public function removeProcedureList($procedureList)
    {
        if ($this->procedureList->contains($procedureList)) {
            foreach ($procedureList as $list) {
                $this->procedureList->removeElement($list);
            }
        }
        return $this;
    }

    /**
     */
    public function __construct()
    {
        $this->procedureList = new ArrayCollection();
    }
}

