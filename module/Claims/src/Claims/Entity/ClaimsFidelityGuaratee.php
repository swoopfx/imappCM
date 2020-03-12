<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="claims_fidelity_guaratee")
 *
 * @author otaba
 *        
 */
class ClaimsFidelityGuaratee
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Name of the defaulter
     *
     * @ORM\Column(name="defaulters_name", type="string", nullable=true)
     * @var string
     */
    private $defaultersName;

    /**
     * Defaulters present Address
     *
     * @ORM\Column(name="defaulters_address", type="text", nullable=true)
     * @var string
     */
    private $defaulterAddress;

    /**
     * Defaulters present phone numeber
     *
     * @ORM\Column(name="defaulter_phone", type="string", nullable=true)
     * @var string
     */
    private $defaulterPhone;

    /**
     * Defaulters prresent age
     *
     * @ORM\Column(name="defaulters_age", nullable=true, type="string")
     * @var string
     */
    private $defaultersAge;

    /**
     * Date default was discovererd
     *
     * @ORM\Column(name="default_descovery_date", type="string", nullable=true)
     * @var \DateTime
     */
    private $defaultDescoveryDate;

    /**
     *
     * @ORM\Column(name="defaulters_occupation", type="string", nullable=true)
     * @var string
     */
    private $defaultersOccupation;

    /**
     * Provide deftails of the defaulters next of kin
     *
     * @ORM\Column(name="defaulters_next_of_kin", type="text", nullable=true)
     * @var string
     */
    private $defaultersNextOfKin;

    /**
     * This defines how long the default has been taking place
     * and defines in what manner the default was carried
     *
     * @ORM\Column(name="default_duration_explanation", type="text", nullable=true)
     *
     * @var string
     */
    private $defaultDurationExplanation;

    /**
     * What led to the discovery of the default
     *
     * @ORM\Column(name="default_descovery", nullable=true, type="text")
     * @var string
     */
    private $defaultDescovery;

    /**
     *
     * @ORM\Column(name="default_amount", type="string", nullable=true)
     * @var string
     */
    private $defaultAmount;

    /**
     *
     * @ORM\Column(name="is_previous_irregularity", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPreviousIrregularity;

    /**
     * Has there been any previous irregularity in the defaulters
     * accounts? If so, state when, and give particulars
     *
     * @ORM\Column(name="previous_irregularity", nullable=true, type="text")
     * @var string
     */
    private $previousIrregularity;

    /**
     * this defines the last time a proper audit was made on the stock
     *
     * @ORM\Column(name="last_audit_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $lastAuditDate;

    /**
     * These are other insurance policy for issues like this
     *
     * @ORM\Column(name="other_security", type="text", nullable=true)
     * @var string
     */
    private $otherSecurity;

    /**
     *
     * @ORM\Column(name="is_defaulter_has_salary", type="boolean", nullable=true)
     * @var boolean
     */
    private $isDefaulterHasSalary;

    /**
     *
     * @ORM\Column(name="defaulters_salary", type="string", nullable=true)
     * @var string
     */
    private $defaulterSalary;

    /**
     * Is there any salary, commission or other remuneration or allowance due to him
     *
     * @ORM\Column(name="is_defaulter_other_security", type="boolean", nullable=true)
     * @var boolean
     */
    private $isDefaulterOtherSecurity;

    /**
     * Has a proposal for settlement been put forward by defaulter
     *
     * @ORM\Column(name="is_default", type="boolean", nullable=true)
     * @var boolean
     */
    private $isDefaulterSettlement;

    /**
     *
     * @ORM\Column(name="is_defaulter_discharged", type="boolean", nullable=true)
     * @var boolean
     */
    private $isDefaulterDischarged;

    /**
     *
     * @ORM\Column(name="diacharge_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $dischargeDate;

//     /**
//      * An aggrement the the information provided is true
//      *
//      * @ORM\Column(name="is_aggrement", nullable=true, type="boolean")
//      * @var boolean
//      */
//     private $isAggrement;

    /**
     *
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims",  cascade={"persist", "remove"})
     *
     * @var Claims;
     */
    private $claims;

    /**
     */
    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDefaultersName()
    {
        return $this->defaultersName;
    }

    /**
     *
     * @return string
     */
    public function getDefaulterAddress()
    {
        return $this->defaulterAddress;
    }

    /**
     *
     * @return string
     */
    public function getDefaulterPhone()
    {
        return $this->defaulterPhone;
    }

    /**
     *
     * @return string
     */
    public function getDefaultersAge()
    {
        return $this->defaultersAge;
    }

    /**
     *
     * @return \DateTime
     */
    public function getDefaultDescoveryDate()
    {
        return $this->defaultDescoveryDate;
    }

    /**
     *
     * @return string
     */
    public function getDefaultersOccupation()
    {
        return $this->defaultersOccupation;
    }

    /**
     *
     * @return string
     */
    public function getDefaultersNextOfKin()
    {
        return $this->defaultersNextOfKin;
    }

    /**
     *
     * @return string
     */
    public function getDefaultDurationExplanation()
    {
        return $this->defaultDurationExplanation;
    }

    /**
     *
     * @return string
     */
    public function getDefaultDescovery()
    {
        return $this->defaultDescovery;
    }

    /**
     *
     * @return string
     */
    public function getDefaultAmount()
    {
        return $this->defaultAmount;
    }

    /**
     *
     * @return string
     */
    public function getPreviousIrregularity()
    {
        return $this->previousIrregularity;
    }

    /**
     *
     * @return \DateTime
     */
    public function getLastAuditDate()
    {
        return $this->lastAuditDate;
    }

    /**
     *
     * @return string
     */
    public function getOtherSecurity()
    {
        return $this->otherSecurity;
    }

    /**
     *
     * @return string
     */
    public function getDefaulterSalary()
    {
        return $this->defaulterSalary;
    }

    /**
     *
     * @return boolean
     */
    public function getIsDefaulterSettlement()
    {
        return $this->isDefaulterSettlement;
    }

    /**
     *
     * @return boolean
     */
    public function getIsDefaulterDischarged()
    {
        return $this->isDefaulterDischarged;
    }

    /**
     *
     * @return \DateTime
     */
    public function getDischargeDate()
    {
        return $this->dischargeDate;
    }

    /**
     *
     * @return boolean
     */
    public function getIsAggrement()
    {
        return $this->isAggrement;
    }

    /**
     *
     * @return \Claims\Entity\Claims;
     */
    public function getClaims()
    {
        return $this->claims;
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
     * @param string $defaultersName
     */
    public function setDefaultersName($defaultersName)
    {
        $this->defaultersName = $defaultersName;
        return $this;
    }

    /**
     *
     * @param string $defaulterAddress
     */
    public function setDefaulterAddress($defaulterAddress)
    {
        $this->defaulterAddress = $defaulterAddress;
        return $this;
    }

    /**
     *
     * @param string $defaulterPhone
     */
    public function setDefaulterPhone($defaulterPhone)
    {
        $this->defaulterPhone = $defaulterPhone;
        return $this;
    }

    /**
     *
     * @param string $defaultersAge
     */
    public function setDefaultersAge($defaultersAge)
    {
        $this->defaultersAge = $defaultersAge;
        return $this;
    }

    /**
     *
     * @param \DateTime $defaultDescoveryDate
     */
    public function setDefaultDescoveryDate($defaultDescoveryDate)
    {
        $this->defaultDescoveryDate = $defaultDescoveryDate;
        return $this;
    }

    /**
     *
     * @param string $defaultersOccupation
     */
    public function setDefaultersOccupation($defaultersOccupation)
    {
        $this->defaultersOccupation = $defaultersOccupation;
        return $this;
    }

    /**
     *
     * @param string $defaultersNextOfKin
     */
    public function setDefaultersNextOfKin($defaultersNextOfKin)
    {
        $this->defaultersNextOfKin = $defaultersNextOfKin;
        return $this;
    }

    /**
     *
     * @param string $defaultDurationExplanation
     */
    public function setDefaultDurationExplanation($defaultDurationExplanation)
    {
        $this->defaultDurationExplanation = $defaultDurationExplanation;
        return $this;
    }

    /**
     *
     * @param string $defaultDescovery
     */
    public function setDefaultDescovery($defaultDescovery)
    {
        $this->defaultDescovery = $defaultDescovery;
        return $this;
    }

    /**
     *
     * @param string $defaultAmount
     */
    public function setDefaultAmount($defaultAmount)
    {
        $this->defaultAmount = $defaultAmount;
        return $this;
    }

    /**
     *
     * @param string $previousIrregularity
     */
    public function setPreviousIrregularity($previousIrregularity)
    {
        $this->previousIrregularity = $previousIrregularity;
        return $this;
    }

    /**
     *
     * @param \DateTime $lastAuditDate
     */
    public function setLastAuditDate($lastAuditDate)
    {
        $this->lastAuditDate = $lastAuditDate;
        return $this;
    }

    /**
     *
     * @param string $otherSecurity
     */
    public function setOtherSecurity($otherSecurity)
    {
        $this->otherSecurity = $otherSecurity;
        return $this;
    }

    /**
     *
     * @param string $defaulterSalary
     */
    public function setDefaulterSalary($defaulterSalary)
    {
        $this->defaulterSalary = $defaulterSalary;
        return $this;
    }

    /**
     *
     * @param boolean $isDefaulterSettlement
     */
    public function setIsDefaulterSettlement($isDefaulterSettlement)
    {
        $this->isDefaulterSettlement = $isDefaulterSettlement;
        return $this;
    }

    /**
     *
     * @param boolean $isDefaulterDischarged
     */
    public function setIsDefaulterDischarged($isDefaulterDischarged)
    {
        $this->isDefaulterDischarged = $isDefaulterDischarged;
        return $this;
    }

    /**
     *
     * @param \DateTime $dischargeDate
     */
    public function setDischargeDate($dischargeDate)
    {
        $this->dischargeDate = $dischargeDate;
        return $this;
    }

    /**
     *
     * @param boolean $isAggrement
     */
    public function setIsAggrement($isAggrement)
    {
        $this->isAggrement = $isAggrement;
        return $this;
    }

    /**
     *
     * @param \Claims\Entity\Claims; $claims
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;
        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getIsDefaulterHasSalary()
    {
        return $this->isDefaulterHasSalary;
    }

    /**
     *
     * @return boolean
     */
    public function getIsDefaulterOtherSecurity()
    {
        return $this->isDefaulterOtherSecurity;
    }

    /**
     *
     * @param boolean $isDefaulterHasSalary
     */
    public function setIsDefaulterHasSalary($isDefaulterHasSalary)
    {
        $this->isDefaulterHasSalary = $isDefaulterHasSalary;
        return $this;
    }

    /**
     *
     * @param boolean $isDefaulterOtherSecurity
     */
    public function setIsDefaulterOtherSecurity($isDefaulterOtherSecurity)
    {
        $this->isDefaulterOtherSecurity = $isDefaulterOtherSecurity;
        return $this;
    }
    /**
     * @return boolean
     */
    public function getIsPreviousIrregularity()
    {
        return $this->isPreviousIrregularity;
    }

    /**
     * @param boolean $isPreviousIrregularity
     */
    public function setIsPreviousIrregularity($isPreviousIrregularity)
    {
        $this->isPreviousIrregularity = $isPreviousIrregularity;
        return $this;
    }

}

