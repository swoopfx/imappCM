<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Sex;
use Settings\Entity\MaritalStatus;
use Settings\Entity\MicroPaymentStructure;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="life_policy")
 *
 * @author otaba
 *        
 */
class LifePolicy
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Sex")
     *
     * @var Sex
     */
    private $sex;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MaritalStatus")
     *
     * @var MaritalStatus
     */
    private $maritalStatus;
    
    /**
     * @ORM\Column(name="husband_name", type="string", nullable=true)
     * @var string
     */
    private $husbandsName;
    
    /**
     * @ORM\Column(name="is_pregnant", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPregnant;

    /**
     * Nature of business or occupation
     * @ORM\Column(name="business_nature", type="string", nullable=true)
     *
     * @var string
     */
    private $businessNature;

    // This could also be the occupation
    
    /**
     * The name of the company
     * @ORM\Column(name="employer", type="string", nullable=true)
     *
     * @var string
     *
     */
    private $employer;

    /**
     * @ORM\Column(name="is_self_employer", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isSelfEmployed = false;

    /**
     * Nature of Self employed business
     * @ORM\Column(name="self_employed_business", type="string", nullable=true)
     *
     * @var string
     *
     */
    private $selfEmployedBusiness;

    // This is the nature of the self employed
    
    /**
     * @ORM\Column(name="is_job_change_in_3_years", type="boolean", nullable=true)
     *
     * @var boolean
     *
     */
    private $isJobChangedIn3years = false;

    /**
     * Are there any notable accidents and / diseases
     * particularly associated with your occupation?
     * @ORM\Column(name="is_accident_or_disease", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAccidentOrDisease = false;
    
    /**
     * @ORM\Column(name="is_travel", type="boolean", nullable=true)
     * @var boolean
     */
    private $isTravel = false;

    /**
     * Duration in a year
     * @ORM\Column(name="local_travel_duration", type="string", nullable=true)
     *
     * @var string
     */
    private $localTravelDuration;

    /**
     * Duration in a year
     * @ORM\Column(name="abroad_travel_duration", type="string", nullable=true)
     *
     * @var string
     */
    private $abroadTravelDuration;

    /**
     * Sum sopposedly assured
     * @ORM\Column(name="sum_assured", type="string", nullable=true)
     *
     * @var string
     */
    private $sumAssured;
    
    /**
     * @ORM\Column(name="is_plan_of_assurance", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPlanOfAssurance;
    

    /**
     * Terms of assurance
     * @ORM\Column(name="is_assurance_term", type="boolean", nullable=true)
     *
     * @var string
     */
    private $isAssuranceTerm;

    /**
     * @ORM\Column(name="commencement_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $commencementDate;

    /**
     * @ORM\Column(name="is_with_profit", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isWithProfit;

    // private $
    
    // Medical Details
    /**
     * @ORM\Column(name="is_physician", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPhysician = FALSE;

    /**
     * @ORM\Column(name="physician_name", type="string", nullable=true)
     *
     * @var string
     */
    private $physicianName;

    /**
     * @ORM\Column(name="consultation_reason", type="string", nullable=true)
     *
     * @var string
     */
    private $consultationReason;

    /**
     * @ORM\Column(name="last_treatment_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $lastTreatmentDate;

    /**
     * @ORM\Column(name="is_respiratory_disease", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isRespiratoryDisease = FALSE;

    /**
     * @ORM\Column(name="is_epilepsy", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isEpilepsy = FALSE;

    /**
     * @ORM\Column(name="is_clinical_depresion", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isClinicalDepresion = FALSE;

    /**
     * @ORM\Column(name="is_miscariage", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isMisCarriage = FALSE;

    /**
     * @ORM\Column(name="is_insanity", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isInsanity = FALSE;

    /**
     * @ORM\Column(name="is_diabetes", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isDiabetes = FALSE;

    /**
     * @ORM\Column(name="is_heart_disease", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isHeartDisease = FALSE;

    /**
     * @ORM\Column(name="is_hiv", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isHiv = FALSE;

    /**
     * @ORM\Column(name="is_paralysis", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isParalysis = FALSE;

    /**
     * @ORM\Column(name="is_hbp", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isHbp = FALSE;

    /**
     * @ORM\Column(name="is_cancer", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCancer = FALSE;

    /**
     * @ORM\Column(name="is_other_condition", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isOtherCondition = FALSE;

    /**
     * @ORM\Column(name="conitional_details", type="text", nullable=true)
     *
     * @var text
     */
    private $conditionDetails;

    // Policy Bonus
    
    /**
     * @ORM\Column(name="is_premium_waiver", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPremiumWaiver = false;

    /**
     * @ORM\Column(name="is_accidental_death_benefit", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAccidentalDeathBenefit = FALSE;
    
    /**
     * @ORM\Column(name="is_personal_accident_benefit", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPersonalAccidentBenefit = false ;

    /**
     * @ORM\Column(name="provisional_premium", type="string", nullable=true)
     *
     * @var string
     */
    private $provisionalPremium;
    
    

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MicroPaymentStructure")
     * 
     * @var MicroPaymentStructure
     */
    private $paymentFrequency;

    /**
     * @ORM\OneToMany(targetEntity="LifePolicyMedicalList", mappedBy="lifePolicy")
     * 
     * @var Collection
     */
    private $medicalConsultaionList;

    /**
     */
    public function __construct()
    {}

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
    }

    /**
     *
     * @return the $sex
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     *
     * @param \Settings\Entity\Sex $sex            
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     *
     * @return the $maritalStatus
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     *
     * @param \Settings\Entity\MaritalStatus $maritalStatus            
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
        return $this;
    }

    /**
     *
     * @return the $businessNature
     */
    public function getBusinessNature()
    {
        return $this->businessNature;
    }

    /**
     *
     * @param string $businessNature            
     */
    public function setBusinessNature($businessNature)
    {
        $this->businessNature = $businessNature;
        return $this;
    }

    /**
     *
     * @return the $employer
     */
    public function getEmployer()
    {
        return $this->employer;
    }

    /**
     *
     * @param string $employer            
     */
    public function setEmployer($employer)
    {
        $this->employer = $employer;
        return $this;
    }

    /**
     *
     * @return the $isSelfEmployed
     */
    public function getIsSelfEmployed()
    {
        return $this->isSelfEmployed;
    }

    /**
     *
     * @param boolean $isSelfEmployed            
     */
    public function setIsSelfEmployed($isSelfEmployed)
    {
        $this->isSelfEmployed = $isSelfEmployed;
        return $this;
    }

    /**
     *
     * @return the $selfEmployedBusiness
     */
    public function getSelfEmployedBusiness()
    {
        return $this->selfEmployedBusiness;
    }

    /**
     *
     * @param string $selfEmployedBusiness            
     */
    public function setSelfEmployedBusiness($selfEmployedBusiness)
    {
        $this->selfEmployedBusiness = $selfEmployedBusiness;
        return $this;
    }

    /**
     *
     * @return the $isJobChangedIn3years
     */
    public function getIsJobChangedIn3years()
    {
        return $this->isJobChangedIn3years;
    }

    /**
     *
     * @param boolean $isJobChangedIn3years            
     */
    public function setIsJobChangedIn3years($isJobChangedIn3years)
    {
        $this->isJobChangedIn3years = $isJobChangedIn3years;
        return $this;
    }

    /**
     *
     * @return the $isAccidentOrDisease
     */
    public function getIsAccidentOrDisease()
    {
        return $this->isAccidentOrDisease;
    }

    /**
     *
     * @param boolean $isAccidentOrDisease            
     */
    public function setIsAccidentOrDisease($isAccidentOrDisease)
    {
        $this->isAccidentOrDisease = $isAccidentOrDisease;
        return $this;
    }

    /**
     *
     * @return the $localTravelDuration
     */
    public function getLocalTravelDuration()
    {
        return $this->localTravelDuration;
    }

    /**
     *
     * @param string $localTravelDuration            
     */
    public function setLocalTravelDuration($localTravelDuration)
    {
        $this->localTravelDuration = $localTravelDuration;
        return $this;
    }

    /**
     *
     * @return the $abroadTravelDuration
     */
    public function getAbroadTravelDuration()
    {
        return $this->abroadTravelDuration;
    }

    /**
     *
     * @param string $abroadTravelDuration            
     */
    public function setAbroadTravelDuration($abroadTravelDuration)
    {
        $this->abroadTravelDuration = $abroadTravelDuration;
        return $this;
    }

    /**
     *
     * @return the $sumAssured
     */
    public function getSumAssured()
    {
        return $this->sumAssured;
    }

    /**
     *
     * @param string $sumAssured            
     */
    public function setSumAssured($sumAssured)
    {
        $this->sumAssured = $sumAssured;
        return $this;
    }

    /**
     *
     * @return the $isAssuranceTerm
     */
    public function getIsAssuranceTerm()
    {
        return $this->isAssuranceTerm;
    }

    /**
     *
     * @param string $isAssuranceTerm            
     */
    public function setIsAssuranceTerm($isAssuranceTerm)
    {
        $this->isAssuranceTerm = $isAssuranceTerm;
        return $this;
    }

    /**
     *
     * @return the $commencementDate
     */
    public function getCommencementDate()
    {
        return $this->commencementDate;
    }

    /**
     *
     * @param DateTime $commencementDate            
     */
    public function setCommencementDate($commencementDate)
    {
        $this->commencementDate = $commencementDate;
        return $this;
    }

    /**
     *
     * @return the $isWithProfit
     */
    public function getIsWithProfit()
    {
        return $this->isWithProfit;
    }

    /**
     *
     * @param boolean $isWithProfit            
     */
    public function setIsWithProfit($isWithProfit)
    {
        $this->isWithProfit = $isWithProfit;
        return $this;
    }

    /**
     *
     * @return the $isPhysician
     */
    public function getIsPhysician()
    {
        return $this->isPhysician;
    }

    /**
     *
     * @param boolean $isPhysician            
     */
    public function setIsPhysician($isPhysician)
    {
        $this->isPhysician = $isPhysician;
        return $this;
    }

    /**
     *
     * @return the $physicianName
     */
    public function getPhysicianName()
    {
        return $this->physicianName;
    }

    /**
     *
     * @param string $physicianName            
     */
    public function setPhysicianName($physicianName)
    {
        $this->physicianName = $physicianName;
        return $this;
    }

    /**
     *
     * @return the $consultationReason
     */
    public function getConsultationReason()
    {
        return $this->consultationReason;
    }

    /**
     *
     * @param string $consultationReason            
     */
    public function setConsultationReason($consultationReason)
    {
        $this->consultationReason = $consultationReason;
        return $this;
    }

    /**
     *
     * @return the $lastTreatmentDate
     */
    public function getLastTreatmentDate()
    {
        return $this->lastTreatmentDate;
    }

    /**
     *
     * @param DateTime $lastTreatmentDate            
     */
    public function setLastTreatmentDate($lastTreatmentDate)
    {
        $this->lastTreatmentDate = $lastTreatmentDate;
        return $this;
    }

    /**
     *
     * @return the $isRespiratoryDisease
     */
    public function getIsRespiratoryDisease()
    {
        return $this->isRespiratoryDisease;
    }

    /**
     *
     * @param boolean $isRespiratoryDisease            
     */
    public function setIsRespiratoryDisease($isRespiratoryDisease)
    {
        $this->isRespiratoryDisease = $isRespiratoryDisease;
        return $this;
    }

    /**
     *
     * @return the $isEpilepsy
     */
    public function getIsEpilepsy()
    {
        return $this->isEpilepsy;
    }

    /**
     *
     * @param boolean $isEpilepsy            
     */
    public function setIsEpilepsy($isEpilepsy)
    {
        $this->isEpilepsy = $isEpilepsy;
        return $this;
    }

    /**
     *
     * @return the $isClinicalDepresion
     */
    public function getIsClinicalDepresion()
    {
        return $this->isClinicalDepresion;
    }

    /**
     *
     * @param boolean $isClinicalDepresion            
     */
    public function setIsClinicalDepresion($isClinicalDepresion)
    {
        $this->isClinicalDepresion = $isClinicalDepresion;
        return $this;
    }

    /**
     *
     * @return the $isMisCarriage
     */
    public function getIsMisCarriage()
    {
        return $this->isMisCarriage;
    }

    /**
     *
     * @param boolean $isMisCarriage            
     */
    public function setIsMisCarriage($isMisCarriage)
    {
        $this->isMisCarriage = $isMisCarriage;
        return $this;
    }

    /**
     *
     * @return the $isInsanity
     */
    public function getIsInsanity()
    {
        return $this->isInsanity;
    }

    /**
     *
     * @param boolean $isInsanity            
     */
    public function setIsInsanity($isInsanity)
    {
        $this->isInsanity = $isInsanity;
        return $this;
    }

    /**
     *
     * @return the $isDiabetes
     */
    public function getIsDiabetes()
    {
        return $this->isDiabetes;
    }

    /**
     *
     * @param boolean $isDiabetes            
     */
    public function setIsDiabetes($isDiabetes)
    {
        $this->isDiabetes = $isDiabetes;
        return $this;
    }

    /**
     *
     * @return the $isHeartDisease
     */
    public function getIsHeartDisease()
    {
        return $this->isHeartDisease;
    }

    /**
     *
     * @param boolean $isHeartDisease            
     */
    public function setIsHeartDisease($isHeartDisease)
    {
        $this->isHeartDisease = $isHeartDisease;
        return $this;
    }

    /**
     *
     * @return the $isHiv
     */
    public function getIsHiv()
    {
        return $this->isHiv;
    }

    /**
     *
     * @param boolean $isHiv            
     */
    public function setIsHiv($isHiv)
    {
        $this->isHiv = $isHiv;
        return $this;
    }

    /**
     *
     * @return the $isParalysis
     */
    public function getIsParalysis()
    {
        return $this->isParalysis;
    }

    /**
     *
     * @param boolean $isParalysis            
     */
    public function setIsParalysis($isParalysis)
    {
        $this->isParalysis = $isParalysis;
        return $this;
    }

    /**
     *
     * @return the $isHbp
     */
    public function getIsHbp()
    {
        return $this->isHbp;
    }

    /**
     *
     * @param boolean $isHbp            
     */
    public function setIsHbp($isHbp)
    {
        $this->isHbp = $isHbp;
        return $this;
    }

    /**
     *
     * @return the $isCancer
     */
    public function getIsCancer()
    {
        return $this->isCancer;
    }

    /**
     *
     * @param boolean $isCancer            
     */
    public function setIsCancer($isCancer)
    {
        $this->isCancer = $isCancer;
        return $this;
    }

    /**
     *
     * @return the $isOtherCondition
     */
    public function getIsOtherCondition()
    {
        return $this->isOtherCondition;
    }

    /**
     *
     * @param boolean $isOtherCondition            
     */
    public function setIsOtherCondition($isOtherCondition)
    {
        $this->isOtherCondition = $isOtherCondition;
        return $this;
    }

    /**
     *
     * @return the $conditionDetails
     */
    public function getConditionDetails()
    {
        return $this->conditionDetails;
    }

    /**
     *
     * @param \IMServices\Entity\text $conditionDetails            
     */
    public function setConditionDetails($conditionDetails)
    {
        $this->conditionDetails = $conditionDetails;
        return $this;
    }

    /**
     *
     * @return the $isPremiumWaiver
     */
    public function getIsPremiumWaiver()
    {
        return $this->isPremiumWaiver;
    }

    /**
     *
     * @param boolean $isPremiumWaiver            
     */
    public function setIsPremiumWaiver($isPremiumWaiver)
    {
        $this->isPremiumWaiver = $isPremiumWaiver;
        return $this;
    }

    /**
     *
     * @return the $isAccidentalDeathBenefit
     */
    public function getIsAccidentalDeathBenefit()
    {
        return $this->isAccidentalDeathBenefit;
    }

    /**
     *
     * @param boolean $isAccidentalDeathBenefit            
     */
    public function setIsAccidentalDeathBenefit($isAccidentalDeathBenefit)
    {
        $this->isAccidentalDeathBenefit = $isAccidentalDeathBenefit;
        return $this;
    }

    /**
     *
     * @return the $provisionalPremium
     */
    public function getProvisionalPremium()
    {
        return $this->provisionalPremium;
    }

    /**
     *
     * @param string $provisionalPremium            
     */
    public function setProvisionalPremium($provisionalPremium)
    {
        $this->provisionalPremium = $provisionalPremium;
        return $this;
    }

    /**
     *
     * @return the $paymentFrequency
     */
    public function getPaymentFrequency()
    {
        return $this->paymentFrequency;
    }

    /**
     *
     * @param \Settings\Entity\MicroPaymentStructure $paymentFrequency            
     */
    public function setPaymentFrequency($paymentFrequency)
    {
        $this->paymentFrequency = $paymentFrequency;
        return $this;
    }

    /**
     *
     * @return the $medicalConsultaionList
     */
    public function getMedicalConsultaionList()
    {
        return $this->medicalConsultaionList;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $medicalConsultaionList            
     */
    public function setMedicalConsultaionList($medicalConsultaionList)
    {
        $this->medicalConsultaionList = $medicalConsultaionList;
        return $this;
    }
    /**
     * @return the $isTravel
     */
    public function getIsTravel()
    {
        return $this->isTravel;
    }

    /**
     * @param boolean $isTravel
     */
    public function setIsTravel($isTravel)
    {
        $this->isTravel = $isTravel;
        return $this;
    }

    /**
     * @return the $isPlanOfAssurance
     */
    public function getIsPlanOfAssurance()
    {
        return $this->isPlanOfAssurance;
    }

    /**
     * @param boolean $isPlanOfAssurance
     */
    public function setIsPlanOfAssurance($isPlanOfAssurance)
    {
        $this->isPlanOfAssurance = $isPlanOfAssurance;
        return $this;
    }

    /**
     * @return the $isPersonalAccidentBenefit
     */
    public function getIsPersonalAccidentBenefit()
    {
        return $this->isPersonalAccidentBenefit;
    }

    /**
     * @param boolean $isPersonalAccidentBenefit
     */
    public function setIsPersonalAccidentBenefit($isPersonalAccidentBenefit)
    {
        $this->isPersonalAccidentBenefit = $isPersonalAccidentBenefit;
        return $this;
    }
    /**
     * @return the $husbandsName
     */
    public function getHusbandsName()
    {
        return $this->husbandsName;
    }

    /**
     * @param string $husbandsName
     */
    public function setHusbandsName($husbandsName)
    {
        $this->husbandsName = $husbandsName;
        return $this;
    }

    /**
     * @return the $isPregnant
     */
    public function getIsPregnant()
    {
        return $this->isPregnant;
    }

    /**
     * @param boolean $isPregnant
     */
    public function setIsPregnant($isPregnant)
    {
        $this->isPregnant = $isPregnant;
        return $this;
    }


}

