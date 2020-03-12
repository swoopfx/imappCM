<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Policy\Entity\Policy;
use GeneralServicer\Entity\Document;
use Customer\Entity\Customer;
use Doctrine\Common\Collections\Collection;
use Comments\Entity\Comments;

/**
 * CLaims is every member of the organisations duty
 * it must be propt and quick
 * all members of the organisation has access to the processing of a claims
 *
 * @author swoopfx
 *         @ORM\Table(name="claims")
 *         @ORM\Entity(repositoryClass="Claims\Entity\Repository\ClaimsRepository")
 */
class CLaims
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
     * @ORM\Column(name="is_board", type="boolean", nullable=true)
     * @var boolean
     */
    private $isBoard;

    // /**
    // *
    // * @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\Document")
    // * @ORM\JoinTable(name="claims_customer_image",
    // * joinColumns={@ORM\JoinColumn(name="claims", referencedColumnName="id")},
    // * inverseJoinColumns={@ORM\JoinColumn(name="image", referencedColumnName="id")}
    // * )
    // *
    // * These are images, snapshots , evidence provided to the broker by the cudtomer
    // * This is a many to many unidirectional mapping to document entity
    // *
    // * @var Collection
    // */
    // private $claimsImagesDoc;

    /**
     *
     * @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\Document")
     * @ORM\JoinTable(name="claims_customer_doc",
     * joinColumns={@ORM\JoinColumn(name="claims", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="doc", referencedColumnName="id")}
     * )
     * This is a series of document associated to this claims
     * available to the customer but uploaded by the admin/broker
     *
     * @var Collection
     */
    private $claimsDoc;

    /**
     *
     * @ORM\Column(name="claim_uid", type="string")
     *
     * @var string
     */
    private $claimUid;

    /**
     *
     * @ORM\Column(name="claim_topic", type="string", nullable=true)
     *
     * @var string
     */
    private $claimTopic;

    /**
     *
     * @var \Policy\Entity\Policy @ORM\ManyToOne(targetEntity="Policy\Entity\Policy", inversedBy="claims")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="policy_id", referencedColumnName="id")
     *      })
     *
     */
    private $policy;

    /**
     *
     * @ORM\OneToMany(targetEntity="Comments\Entity\Comments", mappedBy="claims")
     *
     * @var Collection
     */
    private $comments;

    /**
     *
     * @var ClaimStatus @ORM\ManyToOne(targetEntity="ClaimStatus")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="claims_status_id", referencedColumnName="id")
     *      })
     *
     *      This is a unidirectional Many to One mapping to CLaims Status Entity
     */
    private $claimStatus;

    /**
     *
     * @var string @ORM\Column(name="claim_info", type="text", nullable=true)
     */
    private $claimInfo;

    // /**
    // *
    // * @var Document @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\Document")
    // * @ORM\JoinTable(name="claims_document",
    // * @ORM\JoinColumns={@ORM\JoinColumn(name="claims_id", referencedColumnName="id")},
    // * inverseJoinColumns={@ORM\JoinColumn(name="doc_id", referencedColumnName="id")}
    // * )
    // *
    // * This is a many to many unidirectional mapping to document entity
    // */
    // private $docId;

    /**
     *
     * @var \DateTime @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $createdOn;

    /**
     *
     * @var \DateTime @ORM\Column(name="updated_on", type="datetime", nullable=true)
     */
    private $updatedOn;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="customer", referencedColumnName="id")
     * })
     *
     * @var Customer
     */
    private $customer;

    /**
     * THis deffines if the claims is setllted/approved or not
     * This indicate wheter the claims was approved
     * True for approved
     * false for declined
     *
     * @ORM\Column(name="is_settled", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isSettled;

    /**
     *
     * @ORM\OneToOne(targetEntity="ClaimsSettlement", mappedBy="claims")
     * @var ClaimsSettlement
     */
    private $claimsSettled;

    // /**
    // * @ORM\ManyToOne(targetEntity="CLaims\Entity\ClaimsBroker", mappedBy="claims", cascade={"persist", "remove"})
    // *
    // * @var Broker
    // */
    // private $broker;

    /**
     * THis deffines if the claims is hiidden/deleted or not
     *
     * @ORM\Column(name="is_hidden", type="boolean", nullable=false)
     *
     * @var boolean
     */
    private $isHidden;

    /**
     * The date the claims was completed
     *
     * @ORM\Column(name="claims_completed_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $claimsCompletedDate;

    /**
     * Date the claims was settled
     *
     * @ORM\Column(name="claims_settled_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $claimsSettledDate;

    /**
     * Date Broker began the processing of the claims
     *
     * @ORM\Column(name="claims_processing_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $claimsProcessingDate;

    /**
     * Reason Claims was unpaid
     *
     * @ORM\Column(name="unpaid_reason", type="text", nullable=true)
     *
     * @var string
     */
    private $unpaidReason;

    /**
     * Reason Claims was Declined
     *
     * @ORM\Column(name="declined_reason", type="string", nullable=true)
     *
     * @var string
     */
    private $declineResason;

    /**
     * @ORM\Column(name="reason_decription", type="text", nullable=true)
     * @var string
     */
    private $reasonDescription;

    /**
     *
     * @ORM\OneToOne(targetEntity="Claims\Entity\ClaimsDefault", mappedBy="claims")
     * @var ClaimsDefault
     */
    private $claimsDefault;

    /**
     *
     * @ORM\OneToOne(targetEntity="Claims\Entity\ClaimsMotorAccident", mappedBy="claims")
     *
     * @var ClaimsMotorAccident
     */
    private $claimsMotor;

    /**
     *
     * @ORM\OneToOne(targetEntity="Claims\Entity\ClaimsBuglary", mappedBy="claims")
     *
     * @var ClaimsBuglary
     */
    private $claimsBuglary;
    

    // /**
    // *
    // * @var
    // *
    // */
    // private $claimsProperty;

    // private $claimsLife;

    // private $claimsAvaiation;

    // private $claimsAgric;

    // private $claimsHealth;

    /**
     * @ORM\OneToOne(targetEntity="Claims\Entity\ClaimsMarineCargo", mappedBy="claims")
     * @var ClaimsMarineCargo
     */
    private $claimsMarineCargo;

    // // private $travelInsurance;

    // private $claimsTravel;
    /**
     * @ORM\OneToOne(targetEntity="Claims\Entity\ClaimsEmployersLiability", mappedBy="claims")
     * @var ClaimsEmployersLiability
     */
    private $claimsEmployeeLiability;

    // /**
    // * @ORM\OneToOne(targetEntity="Claims\Entity\ClaimsCashInTransit")
    // *
    // * @var ClaimsCashInTransit
    // */
    // private $claimsCashInTransit;

    // /**
    // * @ORM\OneToOne(targetEntity="Claims\Entity\ClaimsFidelityGuaratee")
    // *
    // * @var ClaimsFidelityGuaratee
    // */
    // private $claimsFidelityGuaratee;

    /**
    * @ORM\OneToOne(targetEntity="Claims\Entity\CLaimsFireLoss", mappedBy="claims")
    *
    * @var CLaimsFireLoss
    */
    private $claimsFireLoss;

    // /**
    // * @ORM\OneToOne(targetEntity="Claims\Entity\ClaimsConsequentialAllRisk")
    // *
    // * @var ClaimsConsequentialAllRisk
    // */
    // private $claimsConsequentialAllRisk;

    // /**
    // * @ORM\OneToOne(targetEntity="ClaimsHouseHolder")
    // *
    // * @var ClaimsHouseHolder
    // */
    // private $claimsHouseHold;

    // /**
    // * @ORM\OneToOne(targetEntity="ClaimsBusinessInteruption")
    // *
    // * @var ClaimsBusinessInteruption
    // */
    // private $claimsBusinessInteruption;

    // /**
    // * @ORM\OneToOne(targetEntity="ClaimsDefault")
    // * @var ClaimsDefault
    // */
    // private $claimsDefault;
    
    /**
     * @ORM\OneToOne(targetEntity="Claims\Entity\ClaimsProfessionalindemnity", mappedBy="claims")
     * @var ClaimsProfessionalindemnity
     */
    private $claimsProfessionalIndemnity;

    /**
     *
     * @ORM\Column(name="is_default_claims", type="boolean", nullable=false, options={"default" : 0})
     * @var boolean
     */
    private $isDefaultClaims;

    /**
     * This is to attest that the information provided are geniun Blah Blah
     *
     * @ORM\Column(name="attestation", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $attestation;

    public function __construct()
    {
        $this->docId = new ArrayCollection();
        $this->comment = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIsBoard()
    {
        return $this->isBoard;
    }

    public function setIsBoard($bor)
    {
        $this->isBoard = $bor;
        return $this;
    }

    public function getClaimsImagesDoc()
    {
        return $this->claimsImagesDoc;
    }

    public function addClaimsImagesDoc($image)
    {
        if (! $this->claimsImagesDoc->contains($image)) {
            $this->claimsImagesDoc->add($image);
        }

        return $this;
    }

    public function removeClaimsImagesDoc($image)
    {
        if ($this->claimsImagesDoc->contains($image)) {
            $this->claimsImagesDoc->removeElement($image);
        }

        return $this;
    }

    public function getClaimsDoc()
    {
        return $this->claimsDoc;
    }

    public function addClaimsDoc($doc)
    {
        if (! $this->claimsDoc->contains($doc)) {
            $this->claimsDoc->add($doc);
        }
        return $this;
    }

    public function removeClaimsDoc($doc)
    {
        if ($this->claimsDoc->contains($doc)) {
            $this->claimsDoc->removeElement($doc);
        }

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getClaimUid()
    {
        return $this->claimUid;
    }

    /**
     *
     * @param string $uid
     * @return \CLaims\Entity\CLaims
     */
    public function setClaimUid($uid)
    {
        $this->claimUid = $uid;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getClaimTopic()
    {
        return $this->claimTopic;
    }

    /**
     *
     * @param string $header
     * @return \CLaims\Entity\CLaims
     */
    public function setClaimTopic($header)
    {
        $this->claimTopic = $header;
        return $this;
    }

    /**
     *
     * @return \Policy\Entity\Policy
     */
    public function getPolicy()
    {
        return $this->policy;
    }

    /**
     *
     * @param Policy $policy
     */
    public function setPolicy(Policy $policy)
    {
        $this->policy = $policy;
        return $this;
    }

    public function getClaimStatus()
    {
        return $this->claimStatus;
    }

    /**
     *
     * @param ClaimStatus $status
     */
    public function setClaimStatus(ClaimStatus $status)
    {
        $this->claimStatus = $status;

        return $this;
    }

    public function getClaimInfo()
    {
        return $this->claimInfo;
    }

    /**
     *
     * @param string $info
     * @return \CLaims\Entity\CLaims
     */
    public function setClaimInfo($info)
    {
        $this->claimInfo = $info;

        return $this;
    }

    /**
     *
     * @return \GeneralServicer\Entity\Document
     */
    public function getDocId()
    {
        return $this->docId;
    }

    /**
     *
     * @param string $doc
     * @return \CLaims\Entity\CLaims
     */
    public function setDocId($doc)
    {
        $this->docId = $doc;

        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     *
     * @param \DateTime $create
     */
    public function setCreatedOn($create)
    {
        $this->createdOn = $create;
        $this->updatedOn = $create;

        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     *
     * @param \DateTime $create
     */
    public function setUpdatedOn($create)
    {
        $this->updatedOn = $create;

        return $this;
    }

    public function getIsSettled()
    {
        return $this->isSettled;
    }

    public function setIsSettled($set)
    {
        $this->isSettled = $set;
        return $this;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setIsHidden($hide)
    {
        $this->isHidden = $hide;
        return $this;
    }

    public function getIsHidden()
    {
        return $this->isHidden;
    }

    public function getClaimsCompletedDate()
    {
        return $this->claimsCompletedDate;
    }

    public function setClaimsCompletedDate($date)
    {
        $this->claimsCompletedDate = $date;
        return $this;
    }

    public function setClaimsSettledDate($date)
    {
        $this->claimsSettledDate = $date;
        return $this;
    }

    public function getClaimsSettledDate()
    {
        return $this->claimsSettledDate;
    }

    public function setClaimsProcessingDate($date)
    {
        $this->claimsProcessingDate = $date;
        return $this;
    }

    public function getClaimsProcessingDate()
    {
        return $this->claimsProcessingDate;
    }

    public function setUnpaidReason($reason)
    {
        $this->unpaidReason = $reason;
        return $this;
    }

    public function getUnpaidReason()
    {
        return $this->unpaidReason;
    }

    public function getDeclineReason()
    {
        return $this->declineResason;
    }

    public function setDeclineResason($res)
    {
        $this->declineResason = $res;
        return $this;
    }

    public function getAttestation()
    {
        return $this->attestation;
    }

    public function setAttestation($at)
    {
        $this->attestation = $at;
        return $this;
    }

    public function getClaimsFidelityGuaratee()
    {
        return $this->claimsFidelityGuaratee;
    }

    public function setClaimsFidelityGuaratee($tee)
    {
        $this->claimsFidelityGuaratee = $tee;
        return $this;
    }

    public function getClaimsFireLoss()
    {
        return $this->claimsFireLoss;
    }

    public function setClaimsFireLoss($cla)
    {
        $this->claimsFireLoss = $cla;
        return $this;
    }

    public function getClaimsConsequentialAllRisk()
    {
        return $this->claimsConsequentialAllRisk;
    }

    public function setClaimsConsequentialAllRisk($isd)
    {
        $this->claimsConsequentialAllRisk = $isd;
        return $this;
    }

    public function getClaimsHouseHold()
    {
        return $this->claimsHouseHold;
    }

    public function setClaimsHouseHold($set)
    {
        $this->claimsHouseHold = $set;
        return $this;
    }

    /**
     *
     * @return string $customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     *
     * @return string $declineResason
     */
    public function getDeclineResason()
    {
        return $this->declineResason;
    }

    // /**
    // *
    // * @return the $claimsMotor
    // */
    // public function getClaimsMotor()
    // {
    // return $this->claimsMotor;
    // }

    // /**
    // *
    // * @return the $claimsBuglary
    // */
    // public function getClaimsBuglary()
    // {
    // return $this->claimsBuglary;
    // }

    // /**
    // *
    // * @return the $claimsProperty
    // */
    // public function getClaimsProperty()
    // {
    // return $this->claimsProperty;
    // }

    // /**
    // *
    // * @return the $claimsLife
    // */
    // public function getClaimsLife()
    // {
    // return $this->claimsLife;
    // }

    // /**
    // *
    // * @return the $claimsAvaiation
    // */
    // public function getClaimsAvaiation()
    // {
    // return $this->claimsAvaiation;
    // }

    // /**
    // *
    // * @return the $claimsAgric
    // */
    // public function getClaimsAgric()
    // {
    // return $this->claimsAgric;
    // }

    // /**
    // *
    // * @return the $claimsHealth
    // */
    // public function getClaimsHealth()
    // {
    // return $this->claimsHealth;
    // }

    // /**
    // *
    // * @return the $claimsMarine
    // */
    // public function getClaimsMarine()
    // {
    // return $this->claimsMarine;
    // }

    // /**
    // *
    // * @return the $travelInsurance
    // */
    // public function getTravelInsurance()
    // {
    // return $this->travelInsurance;
    // }

    // /**
    // *
    // * @return the $claimsCashInTransit
    // */
    // public function getClaimsCashInTransit()
    // {
    // return $this->claimsCashInTransit;
    // }

    // /**
    // *
    // * @return the $claimsBusinessInteruption
    // */
    // public function getClaimsBusinessInteruption()
    // {
    // return $this->claimsBusinessInteruption;
    // }

    // /**
    // *
    // * @return the $claimsDefault
    // */
    // public function getClaimsDefault()
    // {
    // return $this->claimsDefault;
    // }

    // /**
    // *
    // * @param number $id
    // */
    // public function setId($id)
    // {
    // $this->id = $id;
    // }

    // /**
    // *
    // * @param \Doctrine\Common\Collections\Collection $claimsImagesDoc
    // */
    // public function setClaimsImagesDoc($claimsImagesDoc)
    // {
    // $this->claimsImagesDoc = $claimsImagesDoc;
    // return $this;
    // }

    // /**
    // *
    // * @param \Doctrine\Common\Collections\Collection $claimsDoc
    // */
    // public function setClaimsDoc($claimsDoc)
    // {
    // $this->claimsDoc = $claimsDoc;
    // return $this;
    // }

    // /**
    // *
    // * @param \Customer\Entity\Customer $customer
    // */
    // public function setCustomer($customer)
    // {
    // $this->customer = $customer;
    // return $this;
    // }

    // /**
    // *
    // * @param \Claims\Entity\ClaimsMotorAccident $claimsMotor
    // */
    // public function setClaimsMotor($claimsMotor)
    // {
    // $this->claimsMotor = $claimsMotor;
    // return $this;
    // }

    // /**
    // *
    // * @param \Claims\Entity\ClaimsBuglary $claimsBuglary
    // */
    // public function setClaimsBuglary($claimsBuglary)
    // {
    // $this->claimsBuglary = $claimsBuglary;
    // return $this;
    // }

    // /**
    // *
    // * @param field_type $claimsProperty
    // */
    // public function setClaimsProperty($claimsProperty)
    // {
    // $this->claimsProperty = $claimsProperty;
    // return $this;
    // }

    // /**
    // *
    // * @param field_type $claimsLife
    // */
    // public function setClaimsLife($claimsLife)
    // {
    // $this->claimsLife = $claimsLife;
    // return $this;
    // }

    // /**
    // *
    // * @param field_type $claimsAvaiation
    // */
    // public function setClaimsAvaiation($claimsAvaiation)
    // {
    // $this->claimsAvaiation = $claimsAvaiation;
    // return $this;
    // }

    // /**
    // *
    // * @param field_type $claimsAgric
    // */
    // public function setClaimsAgric($claimsAgric)
    // {
    // $this->claimsAgric = $claimsAgric;
    // return $this;
    // }

    // /**
    // *
    // * @param field_type $claimsHealth
    // */
    // public function setClaimsHealth($claimsHealth)
    // {
    // $this->claimsHealth = $claimsHealth;
    // return $this;
    // }

    // /**
    // *
    // * @param field_type $claimsMarine
    // */
    // public function setClaimsMarine($claimsMarine)
    // {
    // $this->claimsMarine = $claimsMarine;
    // return $this;
    // }

    // /**
    // *
    // * @param field_type $travelInsurance
    // */
    // public function setTravelInsurance($travelInsurance)
    // {
    // $this->travelInsurance = $travelInsurance;
    // return $this;
    // }

    // /**
    // *
    // * @param \Claims\Entity\ClaimsCashInTransit $claimsCashInTransit
    // */
    // public function setClaimsCashInTransit($claimsCashInTransit)
    // {
    // $this->claimsCashInTransit = $claimsCashInTransit;
    // return $this;
    // }

    /**
     *
     * @param \Claims\Entity\ClaimsBusinessInteruption $claimsBusinessInteruption
     */
    public function setClaimsBusinessInteruption($claimsBusinessInteruption)
    {
        $this->claimsBusinessInteruption = $claimsBusinessInteruption;
        return $this;
    }

    /**
     *
     * @param \Claims\Entity\ClaimsDefault $claimsDefault
     */
    public function setClaimsDefault($claimsDefault)
    {
        $this->claimsDefault = $claimsDefault;
        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getIsDefaultClaims()
    {
        return $this->isDefaultClaims;
    }

    // /**
    // * @return boolean
    // */
    // public function getAttestation()
    // {
    // return $this->attestation;
    // }

    /**
     *
     * @param \Customer\Entity\Customer $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     *
     * @param boolean $isDefaultClaims
     */
    public function setIsDefaultClaims($isDefaultClaims)
    {
        $this->isDefaultClaims = $isDefaultClaims;
        return $this;
    }

    /**
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     *
     * @return \Claims\Entity\ClaimsMotorAccident
     */
    public function getClaimsMotor()
    {
        return $this->claimsMotor;
    }

    /**
     *
     * @return \Claims\Entity\ClaimsDefault
     */
    public function getClaimsDefault()
    {
        return $this->claimsDefault;
    }

    /**
     *
     * @return \Claims\Entity\ClaimsBuglary
     */
    public function getClaimsBuglary()
    {
        return $this->claimsBuglary;
    }
    /**
     * @return \Claims\Entity\ClaimsSettlement
     */
    public function getClaimsSettled()
    {
        return $this->claimsSettled;
    }
    /**
     * @return string
     */
    public function getReasonDescription()
    {
        return $this->reasonDescription;
    }

    /**
     * @param string $reasonDescription
     */
    public function setReasonDescription($reasonDescription)
    {
        $this->reasonDescription = $reasonDescription;
        return $this;
    }
    /**
     * @return \Claims\Entity\ClaimsMarineCargo
     */
    public function getClaimsMarineCargo()
    {
        return $this->claimsMarineCargo;
    }

    /**
     * @param \Claims\Entity\ClaimsMarineCargo $claimsMarineCargo
     */
    public function setClaimsMarineCargo($claimsMarineCargo)
    {
        $this->claimsMarineCargo = $claimsMarineCargo;
        return $this;
    }
    /**
     * @return \Claims\Entity\ClaimsEmployersLiability
     */
    public function getClaimsEmployeeLiability()
    {
        return $this->claimsEmployeeLiability;
    }
    /**
     * @return \Claims\Entity\ClaimsProfessionalindemnity
     */
    public function getClaimsProfessionalIndemnity()
    {
        return $this->claimsProfessionalIndemnity;
    }





}

?>