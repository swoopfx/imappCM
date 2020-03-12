<?php
namespace Policy\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
// use Customer\Entity\Customer;
use Claims\Entity\Claims;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\PolicyRevokeReason;

/**
 * Policy
 *
 * @ORM\Table(name="policy")
 * @ORM\Entity(repositoryClass="Policy\Entity\Repository\PolicyRepository")
 */
class Policy
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    // /**
    // * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
    // *
    // * @var Customer
    // */
    // private $customer;

    /**
     * A Unique name that identifies the policy
     * @ORM\Column(name="policy_name", type="text", nullable=true)
     *
     * @var string
     */
    private $policyName;

    /**
     * A collection of documents for the policy
     * @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\Document")
     * @ORM\JoinTable(name="policy_doc",
     * joinColumns={@ORM\JoinColumn(name="policy_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="doc_id", referencedColumnName="id")}
     * )
     *
     * @var Collection
     */
    private $documents;

    // /**
    // * @ORM\Column(name="desc", type="text", nullable=true)
    // * @var Text
    // */
    // private $desc;

    /**
     *
     * @ORM\Column(name="extra_info", type="text", nullable=true)
     *
     * @var string
     */
    private $extraInfo;

    /**
     *
     * @ORM\Column(name="policy_code", type="string", length=200, nullable=false)
     *
     * @var string
     */
    private $policyCode;

    // /**
    // * @ORM\OneToMany(targetEntity="GeneralServicer\Entity\Document", mappedBy="policy", cascade={"persist", "remove"})
    // */
    // private $document;

    /**
     * The status of the policy
     * @ORM\ManyToOne(targetEntity="Policy\Entity\PolicyStatus")
     * @ORM\JoinColumn(name="policy_status", referencedColumnName="id")
     *
     * @var PolicyStatus
     */
    private $policyStatus;

    /**
     * Upon locked the policy cannot be altered except by austhorized personel
     * @ORM\Column(name="is_locked", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isLocked = 0;

    /**
     * UID generated for the policy
     * @ORM\Column(name="policy_uid", type="string", nullable=true)
     *
     * @var string
     */
    private $policyUid;

    

    // once a policy is locked it cann not be edited any more
    /**
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \Datetime
     */
    private $createdOn;

    /**
     *
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedOn;

    /**
     *
     * @ORM\OneToOne(targetEntity="Policy\Entity\CoverNote", inversedBy="policy")
     * @ORM\JoinColumn(name="cover_note", referencedColumnName="id")
     *
     * @var CoverNote
     */
    private $coverNote;


    /**
     * Always true except when suspended and finally deactivated 
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isActive;

    /**
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     *
     */
    private $startDate;

    /**
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $endDate;

    /**
     *
     * @ORM\OneToMany(targetEntity="Claims\Entity\CLaims", mappedBy="policy")
     *
     *
     * @var Collection
     *
     */
    private $claims;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PolicyRevokeReason")
     * @var PolicyRevokeReason
     */
    private $suspendedReason;

    /**
     *
     * @ORM\Column(name="other_suspension", type="string", nullable=true)
     * @var string
     */
    private $otherSuspension;

    /**
     *
     * @ORM\Column(name="reason_description", type="text", nullable=true)
     * @var string
     */
    private $reasonDescription;

    /**
     *
     * @ORM\Column(name="is_auto_renew", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isAutoRenew;


    /**
     * These are Event driven activity taken on the policy
     * @ORM\OneToMany(targetEntity="Policy\Entity\PolicyNotification", mappedBy="policy")
     * @var Collection
     */
    private $policyActivity;

    /**
     * If the policy Has special terms
     * @ORM\Column(name="is_special_terms", type="boolean", nullable=true)
     * @var boolean
     */
    private $isSpecialTerms;

    /**
     * Definition of the special terms
     * @ORM\Column(name="special_terms", type="text", nullable=true)
     * @var string
     */
    private $specialTerms;


    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->claims = new ArrayCollection();
        $this->policyActivity = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    // public function getCustomer()
    // {
    // return $this->customer;
    // }

    // public function setCustomer($cus)
    // {
    // $this->customer = $cus;
    // return $this;
    // }

    // public function getPolicyCert()
    // {
    // return $this->policyCert;
    // }

    // public function setPolicyCert($cert)
    // {
    // $this->policyCert = $cert;
    // return $this;
    // }
    public function getPolicyName()
    {
        return $this->policyName;
    }

    public function setPolicyName($policy)
    {
        $this->policyName = $policy;
        return $this;
    }

    public function getCoverNote()
    {
        return $this->coverNote;
    }

    public function setCoverNote($note)
    {
        $this->coverNote = $note;
        return $this;
    }

    public function getPolicyCode()
    {
        return $this->policyCode;
    }

    public function setPolicyCode($code)
    {
        $this->policyCode = $code;
        return $this;
    }

    public function getDocuments()
    {
        return $this->documents;
    }

    public function addDocuments($docs)
    {
        if (! $this->documents->contains($docs)) {
            $this->documents->add($docs);
        }
        return $this;
    }

    public function removeDocuments($docs)
    {
        if ($this->documents->contains($docs)) {
            $this->documents->removeElement($docs);
        }
        return $this;
    }

    public function getExtraInfo()
    {
        return $this->extraInfo;
    }

    public function setExtraInfo($desc)
    {
        $this->extraInfo = $desc;
        return $this;
    }

    // public function getPolicyBegins()
    // {
    // return $this->policyBegins;
    // }

    // public function setPolicyBegins($datetime)
    // {
    // $this->policyBegins = $datetime;
    // return $this;
    // }

    // public function getPolicyEnds()
    // {
    // return $this->policyEnds;
    // }

    // public function setPolicyEnds($end)
    // {
    // $this->policyEnds = $end;
    // return $this;
    // }
    public function getPolicyStatus()
    {
        return $this->policyStatus;
    }

    public function setPolicyStatus($status)
    {
        $this->policyStatus = $status;
        return $this;
    }

    public function setIsLocked($lock)
    {
        $this->isLocked = $lock;
        return $this;
    }

    public function getIsLocked()
    {
        return $this->isLocked;
    }

    public function getPolicyUid()
    {
        return $this->policyUid;
    }

    public function setPolicyUid($uid)
    {
        $this->policyUid = $uid;
        return $this;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->updateOn = $date;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive($active)
    {
        $this->isActive = $active;
        return $this;
    }

    public function getClaims()
    {
        return $this->claims;
    }

    public function addClaims(Claims $claim)
    {
        if (! $this->claims->contains($claim)) {
            $this->claims->add($claim);
        }

        return $this;
    }

    public function removeClaims(Claims $claim)
    {
        if ($this->claims->contains($claim)) {
            $this->claims->removeElement($claim);
        }

        return $this;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($date)
    {
        $this->startDate = $date;
        return $this;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($date)
    {
        $this->endDate = $date;
        return $this;
    }

    public function getSuspendedReason()
    {
        return $this->suspendedReason;
    }

    public function setSuspendedReason($reason)
    {
        $this->suspendedReason = $reason;
        return $this;
    }

    public function getIsAutoRenew()
    {
        return $this->isAutoRenew;
    }

    public function setIsAutoRenew($ren)
    {
        $this->isAutoRenew = $ren;
        return $this;
    }

   

    /**
     *
     * @return object $renewedPremium
     */
    public function getRenewedPremium()
    {
        return $this->renewedPremium;
    }

    /**
     *
     * @param string $renewedPremium
     */
    public function setRenewedPremium($renewedPremium)
    {
        $this->renewedPremium = $renewedPremium;
        return $this;
    }

    /**
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPolicyActivity()
    {
        return $this->policyActivity;
    }

    /**
     *
     * @return string
     */
    public function getOtherSuspension()
    {
        return $this->otherSuspension;
    }

    /**
     *
     * @return string
     */
    public function getReasonDescription()
    {
        return $this->reasonDescription;
    }

    /**
     *
     * @param string $otherSuspension
     */
    public function setOtherSuspension($otherSuspension)
    {
        $this->otherSuspension = $otherSuspension;
        return $this;
    }

    /**
     *
     * @param string $reasonDescription
     */
    public function setReasonDescription($reasonDescription)
    {
        $this->reasonDescription = $reasonDescription;
        return $this;
    }
    /**
     * @return boolean
     */
    public function getIsSpecialTerms()
    {
        return $this->isSpecialTerms;
    }

    /**
     * @return string
     */
    public function getSpecialTerms()
    {
        return $this->specialTerms;
    }

    /**
     * @param boolean $isSpecialTerms
     */
    public function setIsSpecialTerms($isSpecialTerms)
    {
        $this->isSpecialTerms = $isSpecialTerms;
        return $this;
    }

    /**
     * @param string $specialTerms
     */
    public function setSpecialTerms($specialTerms)
    {
        $this->specialTerms = $specialTerms;
        return $this;
    }

}
