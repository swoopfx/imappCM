<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims_house_holder")
 * 
 * @author otaba
 *        
 */
class ClaimsHouseHolder
{

    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var integer
     */
    private $id;
    
    /**
     * 
     * @var unknown
     */
    private $natureOfLoss;
    
    /**
     *  Describe briefly what happened and the resultant damage, and state what you believe caused it to  happen
     * @var string
     */
    private $lossDesiption;

    /**
     * @ORM\Column(name="loss_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $lossDate;

    /**
     * Who first discovered loss
     * 
     * @var string
     */
    private $lossDiscoveredBy;

    /**
     * Total Value of Loss
     * @ORM\Column(name="loss_value", type="string", nullable=true)
     * @var unknown
     */
    private $lossValue;
    
    /**
     * @ORM\Column(name="loss_location", type="text", nullable=true)
     * @var text
     */

    private $lossLocation;

    
    /**
     * @ORM\COlumn(name="is_premise_occupied", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPremiseOccupied;

    /**
     * @ORM\Column(name="occupation_duration", type="string", nullable=true)
     * @var string
     */
    private $occupationDuration;

    /**
     * @ORM\Column(name="theft_method", type="string", nullable=true)
     * @var string
     */
    private $theftMethod;

    /**
     * @ORM\Column(name="is_police_notify", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPoliceNotify;

    /**
     * @ORM\Column(name="police_location", type="string", nullable=true)
     * @var string
     */
    private $policeLocation;

    /**
     * @ORM\Column(name="is_other_insurance", type="boolean", nullable=true)
     * @var boolean
     */
    private $isOtherInsurance;

    /**
     * @ORM\Column(name="other_insurance", type="text", nullable=true)
     * @var text
     */
    private $otherInsurance;

    /**
     * @ORM\OneToMany(targetEntity="Claims\Entity\ClaimLossList", mappedBy="claimsHouseHolder")
     * @var Collection
     */
    private $listLoss;
    
    /**
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims", inversedBy="claimsHouseHold")
     *
     * @var Claims;
     */
    private $claims;

    public function __construct()
    {
        
        
        $this->listLoss = new ArrayCollection();
    }
    
    
    public function getId(){
        return $this->id;
    }
    
    public function getLossDate(){
        return $this->lossDate;
        
    }
    
    public function setLossDate($date){
        $this->lossDate = $date;
        return $this;
    }
    
    public function getLossDiscoveredBy(){
        return $this->lossDiscoveredBy;
    }
    
    public function setLossDiscoveredBy($loss){
        $this->lossDiscoveredBy = $loss;
        return $this;
    }
    
    public function getLossValue(){
        return $this->lossValue;
    }
    
    public function setLossValue($value){
        $this->lossValue = $value;
        return $this;
    }
    
    public function getLossLocation(){
        return $this->lossLocation;
    }
    
    public function setLossLocation($loca){
        $this->lossLocation = $loca;
        return $this;
    }
    
    public function getIsPremiseOccupied(){
        return $this->isPremiseOccupied;
    }
    
    public function setIsPremiseOccupied($is){
        $this->isPremiseOccupied = $is;
        return $this;
    }
    
    public function getOccupationDuration(){
        return $this->occupationDuration;
    }
    
    public function setOccupationDuration($set){
        $this->occupationDuration = $set;
        return $this;
    }
    
    public function getTheftMethod(){
        return $this->theftMethod;
    }
    
    public function setTheftMethod($term){
        $this->theftMethod = $term;
        return $this;
    }
    
    public function getIsPoliceNotify(){
        return $this->isPoliceNotify;
    }
    
    public function setIsPoliceNotify($not){
        $this->isPoliceNotify = $not;
        
        return $this;
    }
    
    public function getIsOtherInsurance(){
        return $this->isOtherInsurance;
    }
    
    public function setIsOtherInsurance($ins){
        $this->isOtherInsurance = $ins;
        return $this;
    }
    
    public function getOtherInsurance(){
        return $this->otherInsurance;
    }
    
    public function setItherInsurance($ins){
        $this->otherInsurance = $ins;
        return $this;
    }
    
    public function getListLoss(){
        return $this->listLoss;
    }
    
    public function getClaims(){
        return $this->claims;
    }
    
    public function setClaims($cla){
        $this->claims = $cla;
        return $this;
    }
    
    /**
     * 
     * @param ClaimLossList $list
     * @return \Claims\Entity\ClaimsHouseHolder
     */
    public function addListLoss($list){
        if(!$this->listLoss->contains($list)){
            $this->listLoss->add($list);
            $list->setClaimsHouseHolder($list);
        }
        
        return $this;
    }
    
    /**
     *
     * @param ClaimLossList $list
     * @return \Claims\Entity\ClaimsHouseHolder
     */
    public function removeListLoss($list){
        if($this->listLoss->contains($list)){
            $this->listLoss->removeElement($list);
            $list->setClaimsHouseHolder($list);
        }
        
        return $this;
    }
}

