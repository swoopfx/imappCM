<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Insurer;

/**
 * @ORM\Entity
 * @ORM\Table(name="cash_in_safe")
 * 
 * @author otaba
 *        
 */
class CashInSafe
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
     * @ORM\Column(name="max_insured_amount", type="string", nullable=true)
     * @var string
     */
    private $maxInsuredAmount;
    
    /**
     * This describes the make and model of safe
     * @ORM\Column(name="safe_nature", type="text", nullable=true)
     * @var text
     */
    private $safeNature;
    
    /**
     * This defines the safe location
     * @ORM\Column(name="safe_location", type="string", nullable=true)
     * @var string
     */
    private $safeLocation;
    
    /**
     * Decribes if available intruder alarm system, motion detectors  or anti robbery systems 
     * @ORM\Column(name="security_arrangement", type="text", nullable=true)
     * @var text
     */
    private $securityArrangements;
    
    /**
     * Notifies if employee engaged has fidelity guaratee policy
     * @ORM\Column(name="is_employee_has_fidelity", type="boolean", nullable=true)
     * @var boolean
     */
    private $isEmployeeHasFidelityGuaratee;
    
    /**
     * @ORM\Column(name="is_previous_insure", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPreviousInsured;
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     * @var Insurer
     */
    private $previousInsurer;
    
    /**
     * @ORM\Column(name="left_previos_insurer_reason", type="text", nullable=true)
     * @var text
     */
    private $leftPreviousInsurerReason;
    
    /**
     * @ORM\Column(name="is_previous_loss", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPreviousloss;
    
    /**
     * This is a series of measure taken to avert the previous loss
     * 
     * @ORM\Column(name="measure_taken_after_loss", type="text", nullable=true)
     * @var Text
     */
    private $measureTakenAfterLoss;
    
    

   
    
    public function getId(){
        return $this->id;
    }
    
    public function getMaxInsuredAmount(){
        return $this->maxInsuredAmount;
    }
    
    public function setMaxInsuredAmount($set){
        $this->maxInsuredAmount = $set;
        return $this;
    }
    
    public function getSafeNature(){
        return $this->safeNature;
    }
    
    public function setSafeNature($nat){
        $this->safeNature = $nat;
        return $this;
    }
    
    public function getSafeLocation(){
        return $this->safeLocation;
    }
    
    public function setSafeLocation($set){
        $this->safeLocation = $set;
        return $this;
    }
    
    
    public function getSecurityArrangements(){
        return $this->securityArrangements;
    }
    
    
    public function setSecurityArrangements($set){
        $this->securityArrangements = $set;
        return $this;
    }
    
    public function getIsEmployeeHasFidelityGuaratee(){
        return $this->isEmployeeHasFidelityGuaratee;
    }
    
    public function setIsEmployeeHasFidelityGuaratee($set){
        $this->isEmployeeHasFidelityGuaratee = $set;
        return $this;
    }
    
    public function getPreviousInsurer(){
        return $this->previousInsurer;
    }
    
    public function setPreviousInsurer($set){
        $this->previousInsurer = $set;
        return $this;
    }
    
    public function getLeftPreviousInsurerReason(){
        return $this->leftPreviousInsurerReason;
    }
    
    public function setLeftPreviousInsurerReason($set){
        $this->leftPreviousInsurerReason = $set;
        return $this;
    }
    
    public function getIsPreviousloss(){
        return $this->isPreviousloss;
    }
    
    public function setIsPreviousloss($set){
        $this->isPreviousloss = $set;
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
     * @param \IMServices\Entity\Currency $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return the $isPreviousInsured
     */
    public function getIsPreviousInsured()
    {
        return $this->isPreviousInsured;
    }

    /**
     * @param boolean $isPreviousInsured
     */
    public function setIsPreviousInsured($isPreviousInsured)
    {
        $this->isPreviousInsured = $isPreviousInsured;
        return $this;
    }
    /**
     * @return the $measureTakenAfterLoss
     */
    public function getMeasureTakenAfterLoss()
    {
        return $this->measureTakenAfterLoss;
    }

    /**
     * @param \IMServices\Entity\Text $measureTakenAfterLoss
     */
    public function setMeasureTakenAfterLoss($measureTakenAfterLoss)
    {
        $this->measureTakenAfterLoss = $measureTakenAfterLoss;
        return $this;
    }


}

