<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Currency;
use Settings\Entity\Insurer;

/**
 * @ORM\Entity
 * @ORM\Table(name="cash_in_transit")
 *
 * @author otaba
 *        
 */
class CashInTransit
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     *
     * @var Currency
     */
    private $currency;

    /**
     * @ORM\Column(name="single_carry_limit", type="string", nullable=true)
     *
     * @var string
     */
    private $singleCarryLimit;

    /**
     * @ORM\Column(name="annual_turnover", type="string", nullable=true)
     *
     * @var string
     */
    private $annualTurnover;

    /**
     * Gives a detailed description of how money is conveyed within premises
     * @ORM\Column(name="convey_method", type="text", nullable=true)
     *
     * @var text
     */
    private $conveyMethod;

    /**
     * Identifies how many people are involved in the conveying
     * @ORM\Column(name="no_of_conveyor", type="string", nullable=true)
     *
     * @var string
     */
    private $noOfConveyor;

    /**
     * This gives details of other things bieng transited, like bonds , jewelry, revenue stamps
     * @ORM\Column(name="other_transit", type="text", nullable=true)
     *
     * @var text
     */
    private $otherTransit;

    /**
     * Notifies if employee engaged has fidelity guaratee policy
     * @ORM\Column(name="is_fidelity_guaratee", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isEmployeeHasFidelityGuaratee;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     * 
     * @var Insurer
     */
    private $fidelityInsurer;

    /**
     * This defines how many days a week cash is carried
     * @ORM\Column(name="frequency_of_transit", type="string", nullable=true)
     *
     * @var string
     */
    private $frequencyOfTransit;

    /**
     * @ORM\Column(name="daily_frequency", type="string", nullable=true)
     *
     * @var string
     */
    private $dailyFrequency;

    /**
     * If accompanied by armed guards
     * @ORM\Column(name="is_armed_guards", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isArmedGaurd;

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

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($cur)
    {
        $this->currency = $cur;
        return $this;
    }

    public function getSingleCarryLimit()
    {
        return $this->singleCarryLimit;
    }

    public function setSingleCarryLimit($set)
    {
        $this->singleCarryLimit = $set;
        return $this;
    }

    public function getAnnualTurnover()
    {
        return $this->annualTurnover;
    }

    public function setAnnualTurnover($set)
    {
        $this->annualTurnover = $set;
        return $this;
    }

    public function getConveyMethod()
    {
        return $this->conveyMethod;
    }

    public function setConveyMethod($meth)
    {
        $this->conveyMethod = $meth;
        return $this;
    }

    public function getNoOfConveyor()
    {
        return $this->noOfConveyor;
    }

    public function setNoOfConveyor($set)
    {
        $this->noOfConveyor = $set;
        return $this;
    }

    public function getOtherTransit()
    {
        return $this->otherTransit;
    }

    public function setOtherTransit($set)
    {
        $this->otherTransit = $set;
        return $this;
    }

    public function getIsEmployeeHasFidelityGuaratee()
    {
        return $this->isEmployeeHasFidelityGuaratee;
    }

    public function setIsEmployeeHasFidelityGuaratee($set)
    {
        $this->isEmployeeHasFidelityGuaratee = $set;
        return $this;
    }

    /**
     *
     * @return the $fidelityInsurer
     */
    public function getFidelityInsurer()
    {
        return $this->fidelityInsurer;
    }

    /**
     *
     * @param \Settings\Entity\Insurer $fidelityInsurer            
     */
    public function setFidelityInsurer($fidelityInsurer)
    {
        $this->fidelityInsurer = $fidelityInsurer;
        return $this;
    }

    public function getFrequencyOfTransit()
    {
        return $this->frequencyOfTransit;
    }

    public function setFrequencyOfTransit($set)
    {
        $this->frequencyOfTransit = $set;
        return $this;
    }

    public function getDailyFrequency()
    {
        return $this->dailyFrequency;
    }

    public function setDailyFrequency($set)
    {
        $this->dailyFrequency = $set;
        return $this;
    }

    public function getIsArmedGaurd()
    {
        return $this->isArmedGaurd;
    }

    public function setIsArmedGaurd($set)
    {
        $this->isArmedGaurd = $set;
        return $this;
    }
}

