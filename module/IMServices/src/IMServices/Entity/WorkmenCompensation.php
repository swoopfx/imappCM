<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="worlmen_compensation")
 *
 * @author otaba
 *        
 */
class WorkmenCompensation
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="WorkmenDecreeList", mappedBy="workmenCopensation")
     *
     * @var Collection
     */
    private $decreeList;

    /**
     * Total amount of wages, salaries and other earning paid by me/us to the above decree list in thepast twelve months.
     * @ORM\Column(name="total_12_months_wages", type="string", nullable=true)
     *
     * @var string
     */
    private $total12monthwages;

    /**
     * Do you require indemnity in respect of Medical Expenses under Workmen’s Compensation Decree?
     * @ORM\Column(name="is_medical_indemnity", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isMedicalIndemnity;

    /**
     * Provide insurance for sub contractors
     * @ORM\Column(name="is_insure_sub_contractor", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isInsureSubContractor;

    /**
     * A collection of subcontractors
     * @ORM\OneToMany(targetEntity="IMServices\Entity\WorkmenCompensationSubContractorsList", mappedBy="workmenCopensation")
     *
     * @var Collection
     */
    private $subContractorsList;

    /**
     * Total amount of wages, salaries and other earning paid by me/us to the above decree list in thepast twelve months.
     * @ORM\Column(name="total_12_months_sub_contractor_wages", type="string", nullable=true)
     *
     * @var string
     */
    private $total12monthSubContractorwages;

    /**
     * Total Provisional annual payment
     * @ORM\Column(name="total_provisional_annual_premium", type="string", nullable=true)
     *
     * @var string
     */
    private $totalProvisionalAnnualPremium;

    /**
     * All persons in your service?
     * @ORM\Column(name="is_all_in_service", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAllPersonsInservice;

    /**
     * @ORM\Column(name="is_insure_all_contractors ", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAllSubContractors;

    /**
     * Does your premises come within the meaning of any Decree or Regulation governing the conduct or
     * maintenance of such premises
     * @ORM\Column(name="is_maintenance_regulation", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isMaintenanceRegulation;

    /**
     * @ORM\Column(name="regulation", type="text", nullable=true)
     *
     * @var text
     */
    private $regulation;

    /**
     * Have you carried out all the obligations imposed on you by
     * @ORM\Column(name="is_carried_out_obligation", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCarriedOutObligation;

    /**
     * Are your machinery plant and ways properly fenced and guarded and in good order or condition
     * @ORM\Column(name="is_fence_machine", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isFenceMachine;

    /**
     * @ORM\Column(name="is_boilers", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isBoilers;

    /**
     * Give particulars of any circular saws or other machinery driven by steam, gas, water,electricity or other mechanical power
     * @ORM\Column(name="boiler_details", type="text", nullable=true)
     * 
     * @var text
     */
    private $boilerDetails;

    /**
     * Give particulars of any circular saws or other machinery driven by steam, gas, water,electricity or other mechanical power
     * @ORM\Column(name="is_saw", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isSaw;

    /**
     * Give particulars of any circular saws or other machinery driven by steam, gas, water,electricity or other mechanical power
     * @ORM\Column(name="saw_details", type="text", nullable=true)
     * 
     * @var text
     */
    private $sawDetails;

    /**
     * State what acids, gases, chemicals explosive or fissionable materials will be used and to what extent
     * @ORM\Column(name="is_acid", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAcidExplosiveMaterials;

    /**
     * Give particulars of any circular saws or other machinery driven by steam, gas, water,electricity or other mechanical power
     * @ORM\Column(name="acid_details", type="text", nullable=true)
     * 
     * @var text
     */
    private $acidDetails;

    /**
     *
     * @ORM\Column(name="is_previously_insured", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviouslyInsured;

    /**
     * @ORM\Column(name="is_previous_decline", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousDecline;

    /**
     * @ORM\Column(name="is_special_terms", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isSpecialTerms;

    /**
     * @ORM\Column(name="is_previous_claims", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousClaims;
    
    /**
     * @ORM\Column(name="claims_details", type="text", nullable=true)
     * @var text
     */
    private $claimsDetails;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

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
     * @return the $decreeList
     */
    public function getDecreeList()
    {
        return $this->decreeList;
    }

    /**
     *
     * @return the $total12monthwages
     */
    public function getTotal12monthwages()
    {
        return $this->total12monthwages;
    }

    /**
     *
     * @return the $isMedicalIndemnity
     */
    public function getIsMedicalIndemnity()
    {
        return $this->isMedicalIndemnity;
    }

    /**
     *
     * @return the $isInsureSubContractor
     */
    public function getIsInsureSubContractor()
    {
        return $this->isInsureSubContractor;
    }

    /**
     *
     * @return the $subContractorsList
     */
    public function getSubContractorsList()
    {
        return $this->subContractorsList;
    }

    /**
     *
     * @return the $totalProvisionalAnnualPremium
     */
    public function getTotalProvisionalAnnualPremium()
    {
        return $this->totalProvisionalAnnualPremium;
    }

    /**
     *
     * @return the $isAllPersonsInservice
     */
    public function getIsAllPersonsInservice()
    {
        return $this->isAllPersonsInservice;
    }

    /**
     *
     * @return the $isAllSubContractors
     */
    public function getIsAllSubContractors()
    {
        return $this->isAllSubContractors;
    }

    /**
     *
     * @return the $isMaintenanceRegulation
     */
    public function getIsMaintenanceRegulation()
    {
        return $this->isMaintenanceRegulation;
    }

    /**
     *
     * @return the $regulation
     */
    public function getRegulation()
    {
        return $this->regulation;
    }

    /**
     *
     * @return the $isCarriedOutObligation
     */
    public function getIsCarriedOutObligation()
    {
        return $this->isCarriedOutObligation;
    }

    /**
     *
     * @return the $isFenceMachine
     */
    public function getIsFenceMachine()
    {
        return $this->isFenceMachine;
    }

    /**
     *
     * @return the $isBoilers
     */
    public function getIsBoilers()
    {
        return $this->isBoilers;
    }

    /**
     *
     * @return the $isSaw
     */
    public function getIsSaw()
    {
        return $this->isSaw;
    }

    /**
     *
     * @return the $isPreviouslyInsured
     */
    public function getIsPreviouslyInsured()
    {
        return $this->isPreviouslyInsured;
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
     * @return the $isSpecialTerms
     */
    public function getIsSpecialTerms()
    {
        return $this->isSpecialTerms;
    }

    /**
     *
     * @return the $isPreviousClaims
     */
    public function getIsPreviousClaims()
    {
        return $this->isPreviousClaims;
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
     * @param \Doctrine\Common\Collections\Collection $decreeList            
     */
    public function setDecreeList($decreeList)
    {
        $this->decreeList = $decreeList;
        return $this;
    }

    /**
     *
     * @param string $total12monthwages            
     */
    public function setTotal12monthwages($total12monthwages)
    {
        $this->total12monthwages = $total12monthwages;
        return $this;
    }

    /**
     *
     * @param boolean $isMedicalIndemnity            
     */
    public function setIsMedicalIndemnity($isMedicalIndemnity)
    {
        $this->isMedicalIndemnity = $isMedicalIndemnity;
        return $this;
    }

    /**
     *
     * @param boolean $isInsureSubContractor            
     */
    public function setIsInsureSubContractor($isInsureSubContractor)
    {
        $this->isInsureSubContractor = $isInsureSubContractor;
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $subContractorsList            
     */
    public function setSubContractorsList($subContractorsList)
    {
        $this->subContractorsList = $subContractorsList;
        return $this;
    }

    /**
     *
     * @param string $totalProvisionalAnnualPremium            
     */
    public function setTotalProvisionalAnnualPremium($totalProvisionalAnnualPremium)
    {
        $this->totalProvisionalAnnualPremium = $totalProvisionalAnnualPremium;
        return $this;
    }

    /**
     *
     * @param boolean $isAllPersonsInservice            
     */
    public function setIsAllPersonsInservice($isAllPersonsInservice)
    {
        $this->isAllPersonsInservice = $isAllPersonsInservice;
        return $this;
    }

    /**
     *
     * @param boolean $isAllSubContractors            
     */
    public function setIsAllSubContractors($isAllSubContractors)
    {
        $this->isAllSubContractors = $isAllSubContractors;
        return $this;
    }

    /**
     *
     * @param boolean $isMaintenanceRegulation            
     */
    public function setIsMaintenanceRegulation($isMaintenanceRegulation)
    {
        $this->isMaintenanceRegulation = $isMaintenanceRegulation;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\text $regulation            
     */
    public function setRegulation($regulation)
    {
        $this->regulation = $regulation;
        return $this;
    }

    /**
     *
     * @param boolean $isCarriedOutObligation            
     */
    public function setIsCarriedOutObligation($isCarriedOutObligation)
    {
        $this->isCarriedOutObligation = $isCarriedOutObligation;
        return $this;
    }

    /**
     *
     * @param boolean $isFenceMachine            
     */
    public function setIsFenceMachine($isFenceMachine)
    {
        $this->isFenceMachine = $isFenceMachine;
        return $this;
    }

    /**
     *
     * @param boolean $isBoilers            
     */
    public function setIsBoilers($isBoilers)
    {
        $this->isBoilers = $isBoilers;
        return $this;
    }

    /**
     *
     * @param boolean $isSaw            
     */
    public function setIsSaw($isSaw)
    {
        $this->isSaw = $isSaw;
        return $this;
    }

    /**
     *
     * @param boolean $isPreviouslyInsured            
     */
    public function setIsPreviouslyInsured($isPreviouslyInsured)
    {
        $this->isPreviouslyInsured = $isPreviouslyInsured;
        return $this;
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
     * @param boolean $isSpecialTerms            
     */
    public function setIsSpecialTerms($isSpecialTerms)
    {
        $this->isSpecialTerms = $isSpecialTerms;
        return $this;
    }

    /**
     *
     * @param boolean $isPreviousClaims            
     */
    public function setIsPreviousClaims($isPreviousClaims)
    {
        $this->isPreviousClaims = $isPreviousClaims;
        return $this;
    }

    /**
     *
     * @return the $total12monthSubContractorwages
     */
    public function getTotal12monthSubContractorwages()
    {
        return $this->total12monthSubContractorwages;
    }

    /**
     *
     * @return the $sawDetails
     */
    public function getSawDetails()
    {
        return $this->sawDetails;
    }

    /**
     *
     * @param string $total12monthSubContractorwages            
     */
    public function setTotal12monthSubContractorwages($total12monthSubContractorwages)
    {
        $this->total12monthSubContractorwages = $total12monthSubContractorwages;
        return $this;
    }

    /**
     *
     * @param field_type $sawDetails            
     */
    public function setSawDetails($sawDetails)
    {
        $this->sawDetails = $sawDetails;
        return $this;
    }
    /**
     * @return the $boilerDetails
     */
    public function getBoilerDetails()
    {
        return $this->boilerDetails;
    }

    /**
     * @return the $isAcidExplosiveMaterials
     */
    public function getIsAcidExplosiveMaterials()
    {
        return $this->isAcidExplosiveMaterials;
    }

    /**
     * @return the $acidDetails
     */
    public function getAcidDetails()
    {
        return $this->acidDetails;
    }

    /**
     * @param \IMServices\Entity\text $boilerDetails
     */
    public function setBoilerDetails($boilerDetails)
    {
        $this->boilerDetails = $boilerDetails;
        return $this;
    }

    /**
     * @param boolean $isAcidExplosiveMaterials
     */
    public function setIsAcidExplosiveMaterials($isAcidExplosiveMaterials)
    {
        $this->isAcidExplosiveMaterials = $isAcidExplosiveMaterials;
        return $this;
    }

    /**
     * @param \IMServices\Entity\text $acidDetails
     */
    public function setAcidDetails($acidDetails)
    {
        $this->acidDetails = $acidDetails;
        return $this;
    }
    /**
     * @return the $claimsDetails
     */
    public function getClaimsDetails()
    {
        return $this->claimsDetails;
    }

    /**
     * @param \IMServices\Entity\text $claimsDetails
     */
    public function setClaimsDetails($claimsDetails)
    {
        $this->claimsDetails = $claimsDetails;
        return $this;
    }


}

