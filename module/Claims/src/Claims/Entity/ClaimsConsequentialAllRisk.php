<?php
namespace Claims\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims_consequential_allrisk")
 * @author otaba
 *        
 */
class ClaimsConsequentialAllRisk
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     * @ORM\Column(name="loss_address", type="text", nullable=true)
     * @var text
     */
    private $lossAddress;
    
    /**
     * @ORM\Column(name="loss_details", type="text", nullable=true)
     * @var text
     */
    private $lossDetails;
    
    /**
     * @ORM\Column(name="loss_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $lossDate;
    
    
    /**
     * @ORM\Column(name="loss_discovered_by", type="string", nullable=true)
     * @var string
     */
    private $lossDiscoveredBy;
    
    /**
     * @ORM\Column(name="loss_date_discovered", type="datetime", nullable=true)
     * @var datetime
     */
    private $lossDateDiscovered;
    
    /**
     * @ORM\Column(name="police_notify_date", type="datetime", nullable=true)
     * @var datetime
     */
    private $policeNotifyDate;
    
    /**
     * @ORM\Column(name="is_thorough_search", type="boolean", nullable=true)
     * @var boolean
     */
    private $isThoroughSearch;
    
    /**
     * @ORM\Column(name="is_advertised_loss", type="boolean", nullable=true)
     * @var boolean
     */
    private $isAdvertisedLoss;
    
    /**
     * @ORM\Column(name="is_previous_damage_theft", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPreviousLossByTheftOrDamage;
    
    
    /**
     * @ORM\Column(name="previous_damage_theft", type="string", nullable=true)
     * @var string
     */
    private $previousLossByTheftOrDamage;
    
    /**
     * @ORM\Column(name="is_aggrement", type="boolean", nullable=true)
     * @var boolean
     */
    private $isAggrement;
    
    /**
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims", inversedBy="claimsConsequentialAllRisk")
     *
     * @var Claims;
     */
    private $claims;
    
    /**
     * @ORM\OneToMany(targetEntity="Claims\Entity\ClaimLossList", mappedBy="claimsFireLoss")
     *
     * @var Collection
     */
    private $listLoss;
    
    
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
        
    }
    
    public function getLossAddress(){
        return $this->lossAddress;
    }
    
    public function setLossAddress($add){
        $this->lossAddress = $add;
        return $this;
    }
    
    public function getLossDetails(){
        return $this->lossDetails;
    }
    
    public function setLossDetails($det){
        $this->lossDetails = $det;
        return $this;
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
    
    public function setLossDiscoveredBy($dis){
        $this->lossDiscoveredBy = $dis;
        return $this;
    }
    
    public function getossDateDiscovered(){
        return $this->lossDateDiscovered;
    }
    
    public function setLossDateDiscovered($dis){
        $this->lossDateDiscovered = $dis;
        return $this;
    }
    
    public function getPoliceNotifyDate(){
        return $this->policeNotifyDate;
    }
    
    public function setPoliceNotifyDate($dis){
        $this->policeNotifyDate = $dis;
        return $this;
    }
    
    public function getIsThoroughSearch(){
        return $this->isThoroughSearch;
    }
    
    public function setIsThoroughSearch($is){
        $this->isThoroughSearch = $is;
        return $this;
    }
    
    public function getIsAdvertisedLoss(){
        return $this->isAdvertisedLoss;
    }
    
    public function setIsAdvertisedLoss($is){
        $this->isAdvertisedLoss = $is;
        return $this;
        
    }
    
    public function getIsPreviousLossByTheftOrDamage(){
        return $this->isPreviousLossByTheftOrDamage;
    }
    
    public function setIsPreviousLossByTheftOrDamage($is){
        $this->isPreviousLossByTheftOrDamage = $is;
        
        return $this;
    }
    
    public function getPreviousLossByTheftOrDamage(){
        return $this->previousLossByTheftOrDamage;
    }
    
    public function setPreviousLossByTheftOrDamage($isd){
        $this->previousLossByTheftOrDamage = $isd;
        return $this;
    }
    
    public function getIsAggrement(){
        return $this->isAggrement;
    }
    
    public function setIsAggrement($isd){
        $this->isAggrement = $isd;
        return $this;
    }
    
    public function getClaims(){
        return $this->claims;
    }
    
    public function setClaims($claims){
        $this->claims = $claims;
        return $this;
    }
    
    public function getListLoss(){
        return $this->listLoss;
    }
    
    public function addListLoss($list){
        if(!$this->listLoss->contains($list)){
            $this->listLoss->add($list);
        }
        return $this;
    }
    
    public function removeListLoss($list){
        if($this->listLoss->contains($list)){
            $this->listLoss->removeElement($list);
        }
        
        return $this;
    }
}

