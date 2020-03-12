<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Settings\Entity\Currency;
use Settings\Entity\Country;

/**
 * @ORM\Entity
 * @ORM\Table(name="professional_indemnity")
 *
 * @author otaba
 *        
 */
class ProfessionalIndemnity
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="head_office", type="text", nullable=true)
     *
     * @var text
     */
    private $headOffice;

    /**
     * @ORM\Column(name="other_office", type="text", nullable=true)
     *
     * @var text
     */
    private $otherOffice;
    
    /**
     * 
     * @ORM\Column(name="is_outstanding_indemnity", type="boolean", nullable=true)
     * @var boolean
     */
    private $isOutStandingIndemnity;

    /**
     * Amount of Indemnity Required (Outstaning)
     * @ORM\Column(name="indemnity_value", type="string", nullable=true)
     *
     * @var string
     */
    private $indemnityValue;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     * 
     * @var Currency
     */
    private $currency;

    /**
     * @ORM\Column(name="is_alternate_practice", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAlternativePractice;

    /**
     * @ORM\Column(name="alternate_practice", type="text", nullable=true)
     *
     * @var text
     */
    private $alternativePractice;

    /**
     * @ORM\Column(name="indemnity_start", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $indemnityStart;

    /**
     * @ORM\Column(name="indemnity_period", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $indemnityEnd;

    /**
     * @ORM\Column(name="annual_brokerage_income", type="string", nullable=true)
     * @var string
     */
    private $annualBrokerageIncome;

    /**
     * @ORM\Column(name="is_underwriting_agent", nullable=true, type="boolean")
     * Do you act as Underwriting Agent for any Syndicate, Underwriters or Insurance Companies?
     * 
     * @var boolean
     */
    private $isUnderwritingAgent;

    /**
     * @ORM\Column(name="profession", type="text", nullable=true)
     * Identity/Type of the proffesion
     * 
     * @var text
     */
    private $profession;

    /**
     * @ORM\Column(name="professional_body", type="string", nullable=true)
     * Identity / Name of the professional bbody
     * 
     * @var stirng
     */
    private $professionalBody;

    /**
     * @ORM\Column(name="membership", type="string", nullable=true)
     * Professional membership status
     *
     * @var string
     */
    private $membership;

    /**
     * how long have cinsured been established in this profession
     * @ORM\Column(name="profession_duration", type="string", nullable=true)
     *
     * @var string
     */
    private $professionDuration;

    /**
     * Details of partners
     * @ORM\OneToMany(targetEntity="ProfessionalIndemnityPartnerDetails", mappedBy="professionalIndemnity")
     *
     * @var Collection
     */
    private $partnerDetails;

    /**
     * Was previously insured
     * @ORM\Column(name="is_previous_insure", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPreviousInsure;

    /**
     * @ORM\Column(name="is_declined", type="boolean", nullable=true)
     * Has been previuously declined by an insurer
     * 
     * @var boolean
     */
    private $isDeclined;

    /**
     * @ORM\Column(name="is_subject_to_increase", type="boolean", nullable=true)
     * Indemmnity has been subjected to increase
     * 
     * @var boolean
     */
    private $isSubjectToIncrease;

    /**
     * @ORM\Column(name="is_special_restriction", type="boolean", nullable=true)
     * has been subjected to special restrictions
     * 
     * @var boolean
     */
    private $isSpecialRestriction;

    /**
     * Details of the special restriction
     * @ORM\Column(name="special_restriction", type="text", nullable=true)
     * 
     * @var text
     */
    private $specialRestriction;

    /**
     * Do you undertake work in any other country outside Nigeria?
     * @ORM\Column(name="is_other_country", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isOtherCountery;

    /**
     * @ORM\ManyToMany(targetEntity="Settings\Entity\Country", cascade={"persist","remove"})
     * @ORM\JoinTable(name="proffesional_indemnity_other_country", joinColumns={
     * @ORM\JoinColumn(name="professional_indemnity", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="other_country", referencedColumnName="id", unique=true)
     * })
     *
     * 
     * 
     * @var Collection
     */
    private $otherCountry;

    /**
     * If Customer wants to provide addistional info
     * @ORM\Column(name="additional_info", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isAdditonalInfo;

    /**
     * Total Number of partners
     * @ORM\Column(name="total_partners", type="string", nullable=true)
     * 
     * @var string
     */
    private $totalPartners;

    /**
     * Total number of staff, Total staff other than Secretaries and Messengers.
     * @ORM\Column(name="total_staff", type="string", nullable=true)
     * 
     * @var string
     */
    private $totalStaff;

    /**
     * If to provide cove r for all staff
     * @ORM\Column(name="is_cover_all_staff", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isCoverAllStaff;

    /**
     * Idenfiy any limited Indemnity
     *
     * @ORM\Column(name="limit_indemnity", type="string", nullable=true)
     * 
     * @var string
     */
    private $limitIndemnity;

    /**
     */
    public function __construct()
    {
        $this->otherCountry = new ArrayCollection();
        $this->partnerDetails = new ArrayCollection();
    }

    public function getPartnerDetails()
    {
        return $this->partnerDetails;
    }

    /**
     *
     * @param ProfessionalIndemnityPartnerDetails $det            
     */
    public function addPartnerDetails($det)
    {
        if (! $this->partnerDetails->contains($det)) {
            $this->partnerDetails->add($det);
            $det->setProfessionalIndemnity($this);
        }
        
        return $this;
    }

    /**
     *
     * @param ProfessionalIndemnityPartnerDetails $det            
     */
    public function removePartnerDetails($det)
    {
        if ($this->partnerDetails->contains($det)) {
            $this->partnerDetails->removeElement($det);
            $det->setProfessionalIndemnity(NULL);
        }
        return $this;
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
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
     * @return the $headOffice
     */
    public function getHeadOffice()
    {
        return $this->headOffice;
    }

    /**
     * @param \IMServices\Entity\text $headOffice
     */
    public function setHeadOffice($headOffice)
    {
        $this->headOffice = $headOffice;
        return $this;
    }

    /**
     * @return the $otherOffice
     */
    public function getOtherOffice()
    {
        return $this->otherOffice;
    }

    /**
     * @param \IMServices\Entity\text $otherOffice
     */
    public function setOtherOffice($otherOffice)
    {
        $this->otherOffice = $otherOffice;
        return $this;
    }

    /**
     * @return the $indemnityValue
     */
    public function getIndemnityValue()
    {
        return $this->indemnityValue;
    }

    /**
     * @param string $indemnityValue
     */
    public function setIndemnityValue($indemnityValue)
    {
        $this->indemnityValue = $indemnityValue;
        return $this;
    }

    /**
     * @return the $currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param \Settings\Entity\Currency $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return the $isAlternativePractice
     */
    public function getIsAlternativePractice()
    {
        return $this->isAlternativePractice;
    }

    /**
     * @param boolean $isAlternativePractice
     */
    public function setIsAlternativePractice($isAlternativePractice)
    {
        $this->isAlternativePractice = $isAlternativePractice;
        return $this;
    }

    /**
     * @return the $alternativePractice
     */
    public function getAlternativePractice()
    {
        return $this->alternativePractice;
    }

    /**
     * @param \IMServices\Entity\text $alternativePractice
     */
    public function setAlternativePractice($alternativePractice)
    {
        $this->alternativePractice = $alternativePractice;
        return $this;
    }

    /**
     * @return the $indemnityStart
     */
    public function getIndemnityStart()
    {
        return $this->indemnityStart;
    }

    /**
     * @param DateTime $indemnityStart
     */
    public function setIndemnityStart($indemnityStart)
    {
        $this->indemnityStart = $indemnityStart;
        return $this;
    }

    /**
     * @return the $indemnityEnd
     */
    public function getIndemnityEnd()
    {
        return $this->indemnityEnd;
    }

    /**
     * @param DateTime $indemnityEnd
     */
    public function setIndemnityEnd($indemnityEnd)
    {
        $this->indemnityEnd = $indemnityEnd;
        return $this;
    }

    /**
     * @return the $annualBrokerageIncome
     */
    public function getAnnualBrokerageIncome()
    {
        return $this->annualBrokerageIncome;
    }

    /**
     * @param string $annualBrokerageIncome
     */
    public function setAnnualBrokerageIncome($annualBrokerageIncome)
    {
        $this->annualBrokerageIncome = $annualBrokerageIncome;
        return $this;
    }

    /**
     * @return the $isUnderwritingAgent
     */
    public function getIsUnderwritingAgent()
    {
        return $this->isUnderwritingAgent;
    }

    /**
     * @param boolean $isUnderwritingAgent
     */
    public function setIsUnderwritingAgent($isUnderwritingAgent)
    {
        $this->isUnderwritingAgent = $isUnderwritingAgent;
        return $this;
    }

    /**
     * @return the $profession
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @param \IMServices\Entity\text $profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
        return $this;
    }

    /**
     * @return the $professionalBody
     */
    public function getProfessionalBody()
    {
        return $this->professionalBody;
    }

    /**
     * @param \IMServices\Entity\stirng $professionalBody
     */
    public function setProfessionalBody($professionalBody)
    {
        $this->professionalBody = $professionalBody;
        return $this;
    }

    /**
     * @return the $membership
     */
    public function getMembership()
    {
        return $this->membership;
    }

    /**
     * @param string $membership
     */
    public function setMembership($membership)
    {
        $this->membership = $membership;
        return $this;
    }

    /**
     * @return the $professionDuration
     */
    public function getProfessionDuration()
    {
        return $this->professionDuration;
    }

    /**
     * @param string $professionDuration
     */
    public function setProfessionDuration($professionDuration)
    {
        $this->professionDuration = $professionDuration;
        return $this;
    }

    /**
     * @return the $isPreviousInsure
     */
    public function getIsPreviousInsure()
    {
        return $this->isPreviousInsure;
    }

    /**
     * @param boolean $isPreviousInsure
     */
    public function setIsPreviousInsure($isPreviousInsure)
    {
        $this->isPreviousInsure = $isPreviousInsure;
        return $this;
    }

    /**
     * @return the $isDeclined
     */
    public function getIsDeclined()
    {
        return $this->isDeclined;
    }

    /**
     * @param boolean $isDeclined
     */
    public function setIsDeclined($isDeclined)
    {
        $this->isDeclined = $isDeclined;
        return $this;
    }

    /**
     * @return the $isSubjectToIncrease
     */
    public function getIsSubjectToIncrease()
    {
        return $this->isSubjectToIncrease;
    }

    /**
     * @param boolean $isSubjectToIncrease
     */
    public function setIsSubjectToIncrease($isSubjectToIncrease)
    {
        $this->isSubjectToIncrease = $isSubjectToIncrease;
        return $this;
    }

    /**
     * @return the $isSpecialRestriction
     */
    public function getIsSpecialRestriction()
    {
        return $this->isSpecialRestriction;
    }

    /**
     * @param boolean $isSpecialRestriction
     */
    public function setIsSpecialRestriction($isSpecialRestriction)
    {
        $this->isSpecialRestriction = $isSpecialRestriction;
        return  $this;
    }

    /**
     * @return the $specialRestriction
     */
    public function getSpecialRestriction()
    {
        return $this->specialRestriction;
    }

    /**
     * @param \IMServices\Entity\text $specialRestriction
     */
    public function setSpecialRestriction($specialRestriction)
    {
        $this->specialRestriction = $specialRestriction;
        return $this;
    }

    /**
     * @return the $isOtherCountery
     */
    public function getIsOtherCountery()
    {
        return $this->isOtherCountery;
    }

    /**
     * @param boolean $isOtherCountery
     */
    public function setIsOtherCountery($isOtherCountery)
    {
        $this->isOtherCountery = $isOtherCountery;
        return $this;
    }

    /**
     * @return the $otherCountry
     */
    public function getOtherCountry()
    {
        return $this->otherCountry;
    }

    public function addOtherCountry($country){
        if(!$this->otherCountry->contains($country)){
           foreach ($country as $count){
               $this->otherCountry->add($count);
           }
        }
        
        return $this;
    }
    
    public function removeOtherCountry($country){
        if($this->otherCountry->contains($country)){
            foreach ($country as $count){
                $this->otherCountry->removeElement($count);
            }
        }
        return $this;
    }

    /**
     * @return the $isAdditonalInfo
     */
    public function getIsAdditonalInfo()
    {
        return $this->isAdditonalInfo;
    }

    /**
     * @param boolean $isAdditonalInfo
     */
    public function setIsAdditonalInfo($isAdditonalInfo)
    {
        $this->isAdditonalInfo = $isAdditonalInfo;
        return $this;
    }

    /**
     * @return the $totalPartners
     */
    public function getTotalPartners()
    {
        return $this->totalPartners;
    }

    /**
     * @param string $totalPartners
     */
    public function setTotalPartners($totalPartners)
    {
        $this->totalPartners = $totalPartners;
        return $this;
    }

    /**
     * @return the $totalStaff
     */
    public function getTotalStaff()
    {
        return $this->totalStaff;
    }

    /**
     * @param string $totalStaff
     */
    public function setTotalStaff($totalStaff)
    {
        $this->totalStaff = $totalStaff;
        return $this;
    }

    /**
     * @return the $isCoverAllStaff
     */
    public function getIsCoverAllStaff()
    {
        return $this->isCoverAllStaff;
    }

    /**
     * @param boolean $isCoverAllStaff
     */
    public function setIsCoverAllStaff($isCoverAllStaff)
    {
        $this->isCoverAllStaff = $isCoverAllStaff;
        return $this;
    }

    /**
     * @return the $limitIndemnity
     */
    public function getLimitIndemnity()
    {
        return $this->limitIndemnity;
    }

    /**
     * @param string $limitIndemnity
     */
    public function setLimitIndemnity($limitIndemnity)
    {
        $this->limitIndemnity = $limitIndemnity;
        return $this;
    }

//     /**
//      * @param \Doctrine\Common\Collections\Collection $partnerDetails
//      */
//     public function setPartnerDetails($partnerDetails)
//     {
//         $this->partnerDetails = $partnerDetails;
//     }

    /**
     * @return boolean
     */
    public function getIsOutStandingIndemnity()
    {
        return $this->isOutStandingIndemnity;
    }

    /**
     * @param boolean $isOutStandingIndemnity
     */
    public function setIsOutStandingIndemnity($isOutStandingIndemnity)
    {
        $this->isOutStandingIndemnity = $isOutStandingIndemnity;
        return $this;
    }

   

}

