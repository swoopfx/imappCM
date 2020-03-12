<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Object\Entity\ObjectBusinessEquipment;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims_business_interuption")
 * 
 * @author otaba
 *        
 */
class ClaimsBusinessInteruption
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims", inversedBy="claimsBusinessInteruption")
     * 
     * @var Claims
     */
    private $claims;

    // /**
    // * @ORM\Column(name="total_claims_value", type="text", nullable=true )
    // * @var string
    // */
    // private $machineValue;
    
    /**
     * @ORM\Column(name="repair_value", type="text", nullable=true)
     * 
     * @var string
     */
    private $repairValue;

    /**
     * @ORM\Column(name="total_claims_value", type="text", nullable=true )
     * 
     * @var string
     */
    private $totalClaimsValue;

    /**
     * This is a list of machine lost in the loss
     * @ORM\ManyToMany(targetEntity="Object\Entity\ObjectBusinessEquipment")
     * @ORM\JoinTable(name="claims_business_interuption_equipment",
     * joinColumns={
     * @ORM\JoinColumn(name="claims_business", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="business_equipment", referencedColumnName="id")
     * }
     * )
     * 
     * @var Collection
     */
    private $equipment;

    /**
     * @ORM\Column(name="loss_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $lossDate;

    /**
     * @ORM\Column(name="location_of_loss", type="text", nullable=true)
     * 
     * @var string
     */
    private $locationOfLoss;

    /**
     * This defines places damaged, parts and extent,
     * circumtances
     * @ORM\Column(name="danage_description", nullable=true, type="text")
     * 
     * @var text
     */
    private $damageDescription;

    /**
     * (
     * @ORM\Column(name="inspection_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $inspectionDate;

    /**
     * @ORM\Column(name="is_loss_by_theft", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isLossByTheft;

    /**
     * @ORM\Column(name="is_police_notify", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isPoliceNotify;

    /**
     * @ORM\Column(name="police_notify", type="text", nullable=true)
     * 
     * @var string
     */
    private $policeNotify;

    /**
     * This is the employee the event was reported to
     * @ORM\Column(name="event_reported_to", type="text", nullable=true)
     * 
     * @var string
     */
    private $eventReportedTo;

    /**
     * @ORM\Column(name="reported_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $reportedDate;

    /**
     * defines actions taken for recovery of item
     * @ORM\Column(name="recovery_action", type="text", nullable=true)
     *
     * @var text
     */
    private $recoveryAction;

    /**
     * Defines if other insurance cover is on the property
     * @ORM\Column(name="is_other_insurance_cover", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isOtherInsuranceCover;

    /**
     * @ORM\Column(name="other_insurance_cover", type="text", nullable=true)
     * 
     * @var text
     */
    private $otherInsuranceCover;

    /**
     * @ORM\Column(name="is_third_party_involved", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isThridPartyInvolved;

    /**
     * @ORM\Column(name="is_third_party", type="boolean", nullable=true)
     * @var boolean
     */
    private $isThirdParty;

    /**
     */
    public function __construct()
    {
        $this->equipment = new ArrayCollection();
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getClaims(){
        return $this->claims;
    }
    
    public function setClaims($claim){
        $this->claims = $claim;
        return $this;
    }
    
    public function getRepairValue(){
        return $this->repairValue;
    }
}

