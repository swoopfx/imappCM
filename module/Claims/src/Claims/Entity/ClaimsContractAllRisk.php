<?php
namespace Claims\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * This is actually contractors all risk
 * @ORM\Entity
 * @ORM\Table(name="claims_contract_all_risk")
 * @author otaba
 *        
 */
class ClaimsContractAllRisk
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="loss_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $lossDate;
    
    /**
     * @ORM\Column(name="location_of_loss", type="string", nullable=true)
     * @var string
     */
    private $locationOfLoss;
    
    /**
     * @ORM\OneToMany(targetEntity="Claims\Entity\ClaimsContractAllRiskLossList", mappedBy="claimsContractAllRisk")
     * @var Collection
     */
    private $lossList;
    
   
    
    /**
     * @ORM\Column(name="loss_circumstance", type="text", nullable=true)
     * @var string
     */
    private $lossCircumstances;
    
    /**
     * @ORM\Column(name="is_suspecious_damage", type="boolean", nullable=true)
     * @var boolean
     */
    private $isSuspiciousDamage;
    
    /**
     * @ORM\Column(name="suspecious_details", type="text", nullable=true)
     * @var string
     */
    private $suspeciousDetails;
    
    /**
     * @ORM\Column(name="is_loss_by_theft", type="boolean", nullable=true)
     * @var boolean
     */
    private $isLossByTheft;
    
    /**
     * @ORM\Column(name="is_police_notified", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPoliceNotified;
    
    /**
     * @ORM\Column(name="police_details", type="text", nullable=true)
     * @var string
     */
    private $policeDetails;
    
    /**
     * @ORM\Column(name="is_other_cover", type="boolean", nullable=true)
     * @var boolean
     */
    private $isOtherCover;
    
    /**
     * Date of lats inspection of machine
     * @ORM\Column(name="date_plant_inspection", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $datePlantInspection;
    
//     private 
    
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
    
    public function getId(){
        return $this->id;
    }
    
  
    /**
     * @return \DateTime
     */
    public function getLossDate()
    {
        return $this->lossDate;
    }

    /**
     * @return string
     */
    public function getLocationOfLoss()
    {
        return $this->locationOfLoss;
    }

   

    /**
     * @return string
     */
    public function getLossCircumstances()
    {
        return $this->lossCircumstances;
    }

    /**
     * @return boolean
     */
    public function getIsSuspiciousDamage()
    {
        return $this->isSuspiciousDamage;
    }

    /**
     * @return string
     */
    public function getSuspeciousDetails()
    {
        return $this->suspeciousDetails;
    }

    /**
     * @return boolean
     */
    public function getIsLossByTheft()
    {
        return $this->isLossByTheft;
    }

    /**
     * @return boolean
     */
    public function getIsPoliceNotified()
    {
        return $this->isPoliceNotified;
    }

    /**
     * @return string
     */
    public function getPoliceDetails()
    {
        return $this->policeDetails;
    }

    /**
     * @return boolean
     */
    public function getIsOtherCover()
    {
        return $this->isOtherCover;
    }

    /**
     * @return \DateTime
     */
    public function getDatePlantInspection()
    {
        return $this->datePlantInspection;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param \DateTime $lossDate
     */
    public function setLossDate($lossDate)
    {
        $this->lossDate = $lossDate;
        return $this;
    }

    /**
     * @param string $locationOfLoss
     */
    public function setLocationOfLoss($locationOfLoss)
    {
        $this->locationOfLoss = $locationOfLoss;
        return $this;
    }

   

    /**
     * @param string $lossCircumstances
     */
    public function setLossCircumstances($lossCircumstances)
    {
        $this->lossCircumstances = $lossCircumstances;
        return $this;
    }

    /**
     * @param boolean $isSuspiciousDamage
     */
    public function setIsSuspiciousDamage($isSuspiciousDamage)
    {
        $this->isSuspiciousDamage = $isSuspiciousDamage;
        return $this;
    }

    /**
     * @param string $suspeciousDetails
     */
    public function setSuspeciousDetails($suspeciousDetails)
    {
        $this->suspeciousDetails = $suspeciousDetails;
        return $this;
    }

    /**
     * @param boolean $isLossByTheft
     */
    public function setIsLossByTheft($isLossByTheft)
    {
        $this->isLossByTheft = $isLossByTheft;
        return $this;
    }

    /**
     * @param boolean $isPoliceNotified
     */
    public function setIsPoliceNotified($isPoliceNotified)
    {
        $this->isPoliceNotified = $isPoliceNotified;
        return $this;
    }

    /**
     * @param string $policeDetails
     */
    public function setPoliceDetails($policeDetails)
    {
        $this->policeDetails = $policeDetails;
        return $this;
    }

    /**
     * @param boolean $isOtherCover
     */
    public function setIsOtherCover($isOtherCover)
    {
        $this->isOtherCover = $isOtherCover;
        return $this;
    }

    /**
     * @param \DateTime $datePlantInspection
     */
    public function setDatePlantInspection($datePlantInspection)
    {
        $this->datePlantInspection = $datePlantInspection;
        return $this;
    }
    /**
     * @return \Claims\Entity\Claims;
     */
    public function getClaims()
    {
        return $this->claims;
    }

    /**
     * @param \Claims\Entity\Claims; $claims
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;
        return $this;
    }


}

