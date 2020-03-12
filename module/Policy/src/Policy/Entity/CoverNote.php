<?php
namespace Policy\Entity;

use Doctrine\ORM\Mapping as ORM;
use Proposal\Entity\Proposal;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Transactions\Entity\Invoice;
// use Users\Entity\InsuranceBrokerRegistered;
use Offer\Entity\Offer;
use Customer\Entity\CustomerPackage;
use Settings\Entity\Insurer;
use Settings\Entity\PolicyReference;
use Customer\Entity\Customer;
use Settings\Entity\CoverCategory;
use Settings\Entity\InsuranceServiceType;
use Settings\Entity\InsuranceSpecificService;

/**
 * This is the temporary policy Gnenerated at point of payment
 *
 * @ORM\Entity
 * @ORM\Table(name="cover_note")
 *
 * @author swoopfx
 *        
 */
class CoverNote
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
     *
     * @var Customer
     */
    private $customer;

    /**
     * This invoice is generated upon auto renewal
     * It is generated from the invoice attached to the respective category
     * Proposal, Offer, or Packages or policyFloat
     *
     * @ORM\OneToMany(targetEntity="Transactions\Entity\Invoice",mappedBy="coverNote")
     *
     * @var Invoice
     *
     */
    private $invoice;

    /**
     *
     * @var string @ORM\Column(name="cover_uid", type="string", length=100, nullable=false)
     */
    private $coverUid;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_updated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     *
     * @var \DateTime @ORM\Column(name="due_date", type="datetime", nullable=true)
     */
    private $dueDate;

    /**
     *
     * @var boolean @ORM\Column(name="is_renewable", type="boolean", nullable=true, options={"default":"1"})
     */

    // set Defualt to true
    private $isRenewable;

    // /**
    // * @ORM\Column(name="policyBegins", type="datetime", nullable=false)
    // *
    // * @var datetime
    // */
    // private $policyBegins;

    // /**
    // * @ORM\Column(name="policyEnds", type="datetime", nullable=false)
    // *
    // * @var datetime
    // */
    // private $policyEnds;

    /**
     *
     * @var boolean @ORM\Column(name="is_hidden", type="boolean", nullable=true)
     */

    // setDefault to false
    private $isHidden = '0';

    /**
     *
     * @var \Policy\Entity\CoverNoteStatus @ORM\ManyToOne(targetEntity="Policy\Entity\CoverNoteStatus")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="cover_status", referencedColumnName="id")
     *      })
     */
    private $coverStatus;

    /**
     * This is the final insurer providing the service
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     * @ORM\JoinColumn(name="insurer", referencedColumnName="id")
     *
     * @var Insurer
     */
    private $insurer;

    // /**
    // * This are additional insurers incase there are more than one insurance company covering the risks
    // * @ORM\ManyToMany(targetEntity="Settings\Entity\Insurer")
    // * @ORM\JoinTable(name="insured_cover",
    // * joinColumns={@ORM\JoinColumn(name="cover_id", referencedColumnName="id")},
    // * inverseJoinColumns={@ORM\JoinColumn(name="additinal_insurer_id", referencedColumnName="id")}
    // * )
    // *
    // * @var Insurer This is a many to many unidirectional mapping to document entity
    // */
    // private $additionalinsurer;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\CoverCategory")
     * @ORM\JoinColumn(name="cover_category", referencedColumnName="id")
     *
     * @var CoverCategory
     */
    private $coverCategory;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PolicyReference")
     * @ORM\JoinColumn(name="cover_reference", referencedColumnName="id")
     *
     * @var PolicyReference
     */
    private $coverRefernce;

    /**
     *
     * @ORM\OneToOne(targetEntity="Proposal\Entity\Proposal", inversedBy="coverNote")
     * @ORM\JoinColumn(name="proposal", referencedColumnName="id")
     *
     * @var Proposal
     */
    private $proposal;

    /**
     *
     * @ORM\OneToOne(targetEntity="Offer\Entity\Offer", inversedBy="coverNote")
     * @ORM\JoinColumn(name="offer", referencedColumnName="id")
     *
     * @var Offer
     */
    private $offer;

    /**
     *
     * @ORM\OneToOne(targetEntity="Customer\Entity\CustomerPackage", inversedBy="coverNote")
     * @ORM\JoinColumn(name="customer_package", referencedColumnName="id")
     *
     * @var CustomerPackage
     */
    private $package;

    /**
     *
     * @ORM\OneToOne(targetEntity="PolicyFloat", inversedBy="coverNote")
     * @ORM\JoinColumn(name="policy_float", referencedColumnName="id")
     *
     * @var PolicyFloat
     */
    private $policyFloat;

    // /**
    // * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
    // * @ORM\JoinColumn(name="broker", referencedColumnName="id")
    // *
    // * @var InsuranceBrokerRegistered
    // */
    // private $broker;

    /**
     * references thepolicy generated
     *
     * @ORM\OneToOne(targetEntity="Policy\Entity\Policy", mappedBy="coverNote" , cascade={"persist", "remove"})
     *
     *
     * @var Policy
     */
    private $policy;

    /**
     * Defines if policy has been generated
     *
     * @ORM\Column(name="is_policy", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPolicy = false;

    // /**
    // * The final insurer providing service
    // * Tis is the default insurer provided service is provided by just one insurance company
    // * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
    // * @var Insurer
    // */
    // private $finalInsurer;

    /**
     * This defines if multiple insureres provide cover
     *
     * @ORM\Column(name="is_multiple_insurer", type="boolean", nullable=true)
     * @var boolean
     */
    private $isMultipleInsurer;

    /**
     * This defines some services on watchlist by some insurer
     *
     * @ORM\ManyToMany(targetEntity="Settings\Entity\Insurer", cascade={"persist","remove"})
     * @ORM\JoinTable(name="covernote_multipliple_insurer", joinColumns={
     * @ORM\JoinColumn(name="covernote_id", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     * @ORM\JoinColumn(name="insurer_id", referencedColumnName="id")
     * })
     *
     *
     * @var Collection
     *
     */
    private $multipleInsurer;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceServiceType")
     * @var InsuranceServiceType
     */
    private $finalService;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceSpecificService")
     * @var InsuranceSpecificService
     */
    private $finalSpecificService;

    /**
     * This is the premium payable
     * provided the premium from the invoice changed
     * It is only defined when there is a change in condition risk
     * which affects the premium value and possibly policyFloat
     *
     * @ORM\Column(name="premium_payable", type="string", nullable=true)
     * @var string
     */
    private $premiumPayable;

    /**
     * This is the latest reason for changing the premium,
     * Every time premium changes this is also affected
     *
     * @ORM\Column(name="premium_change_reason", type="text", nullable=true)
     * @var string
     */
    private $premiumChangeReason;

    /**
     *
     * @return object $coverRefernce
     */
    public function getCoverRefernce()
    {
        return $this->coverRefernce;
    }

    /**
     *
     * @param \Settings\Entity\PolicyReference $coverRefernce
     */
    public function setCoverRefernce($coverRefernce)
    {
        $this->coverRefernce = $coverRefernce;
    }

    public function __construct()
    {
        $this->coverNoteCert = new ArrayCollection();
        $this->additionalinsurer = new ArrayCollection();
        $this->multipleInsurer = new ArrayCollection();
    }

    public function addCoverNoteCert(Collection $coverNotes)
    {
        foreach ($coverNotes as $coverNote) {
            $coverNote->setCoverNote($this);
            $this->coverNoteCert->add($coverNote);
        }
    }

    public function removeCoverNoteCert(Collection $coverNotes)
    {
        foreach ($coverNotes as $coverNote) {
            $coverNote->setCoverNote(Null);
            $this->coverNoteCert->remove($coverNote);
        }
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($cus)
    {
        $this->customer = $cus;
        return $this;
    }

    public function setCoverUid($uid)
    {
        $this->coverUid = $uid;
        return $this;
    }

    public function getCoverUid()
    {
        return $this->coverUid;
    }

    public function getCoverStatus()
    {
        return $this->coverStatus;
    }

    public function setCoverStatus($coverStatus)
    {
        $this->coverStatus = $coverStatus;
        return $this;
    }

    public function setInsurer($ins)
    {
        $this->insurer = $ins;
        return $this;
    }

    public function getInsurer()
    {
        return $this->insurer;
    }

    public function getCoverCategory()
    {
        return $this->coverCategory;
    }

    public function setCoverCategory($cat)
    {
        $this->coverCategory = $cat;
        return $this;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return CoverNote
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        $this->dateUpdated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     *
     * @return Policy
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate($date)
    {
        $this->dueDate = $date;
        return $this;
    }

    /**
     * Set isRenewable
     *
     * @param boolean $isRenewable
     *
     * @return Policy
     */
    public function setIsRenewable($isRenewable)
    {
        $this->isRenewable = $isRenewable;

        return $this;
    }

    public function getPolicyBegins()
    {
        return $this->policyBegins;
    }

    public function setPolicyBegins($date)
    {
        $this->policyBegins = $date;
        return $this;
    }

    public function getPolicyEnds()
    {
        return $this->policyEnds;
    }

    public function setPolicyEnds($date)
    {
        $this->policyEnds = $date;
        return $this;
    }

    /**
     * Get isRenewable
     *
     * @return boolean
     */
    public function getIsRenewable()
    {
        return $this->isRenewable;
    }

    /**
     * Set isHidden
     *
     * @param boolean $isHidden
     *
     * @return CoverNote
     */
    public function setIsHidden($isHidden)
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    /**
     * Get isHidden
     *
     * @return boolean
     */
    public function getIsHidden()
    {
        return $this->isHidden;
    }

    // /**
    // * Set policyCode
    // *
    // * @param string $policyCode
    // *
    // * @return Policy
    // */
    // public function setPolicyCode($policyCode)
    // {
    // $this->policyCode = $policyCode;

    // return $this;
    // }

    // /**
    // * Get policyCode
    // *
    // * @return string
    // */
    // public function getPolicyCode()
    // {
    // return $this->policyCode;
    // }

    // /**
    // * Set policyStatus
    // *
    // * @param \All\Entity\PolicyStatus $policyStatus
    // *
    // * @return Policy
    // */
    // public function setPolicyStatus(\Policy\Entity\PolicyStatus $policyStatus = null)
    // {
    // $this->policyStatus = $policyStatus;

    // return $this;
    // }

    /**
     * Get policyStatus
     *
     * @return \Policy\Entity\PolicyStatus
     */
    public function getPolicyStatus()
    {
        return $this->policyStatus;
    }

    /**
     * Set offer
     *
     * @param \Offer\Entity\Offer $offer
     *
     * @return CoverNote
     */
    public function setOffer(\Offer\Entity\Offer $offer = null)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \Offer\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Get invoice
     *
     * @return Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Add idDoc
     *
     * @param object $idDoc
     *
     * @return Policy
     */
    public function addIdDoc(\GeneralServicer\Entity\Document $idDoc)
    {
        $this->idDoc[] = $idDoc;

        return $this;
    }

    /**
     * Remove idDoc
     *
     * @param object $idDoc
     */
    public function removeIdDoc(\GeneralServicer\Entity\Document $idDoc)
    {
        $this->idDoc->removeElement($idDoc);
    }

    /**
     * Get idDoc
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdDoc()
    {
        return $this->idDoc;
    }

    /**
     * Add insurer
     *
     * @param
     *            Collection
     *            
     * @return Policy
     */
    public function addInsurer(Collection $insurer)

    {
        foreach ($insurer as $insure) {
            $insure->setCoverNote($this);
            $this->insurer->add($insure);
        }
    }

    /**
     * Remove insurer
     *
     * @param
     *            Collection
     */
    public function removeInsurer(Collection $insurer)
    {
        foreach ($insurer as $insure) {
            $insurer->setCoverNote(NULL);
            $this->insurer->removeElement($insurer);
        }
    }

    /**
     * Get insurer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    // public function getInsurer()
    // {
    // return $this->insurer;
    // }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    public function getPackage()
    {
        return $this->package;
    }

    public function setPackage($pack)
    {
        $this->package = $pack;
        return $this;
    }

    public function getProposal()
    {
        return $this->proposal;
    }

    public function setProposal($prop)
    {
        $this->proposal = $prop;
        return $this;
    }

    public function setBroker($broker)
    {
        $this->broker = $broker;
        return $this;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setPolicy($pol)
    {
        $this->policy = $pol;
        return $this;
    }

    public function getPolicy()
    {
        return $this->policy;
    }

    public function setIsPolicy($pol)
    {
        $this->isPolicy = $pol;
        return $this;
    }

    public function getIsPolicy()
    {
        return $this->isPolicy;
    }

    public function getPolicyFloat()
    {
        return $this->policyFloat;
    }

    public function setPolicyFloat($float)
    {
        $this->policyFloat = $float;
        return $this;
    }

    /**
     *
     * @return object $finalInsurer
     */
    public function getFinalInsurer()
    {
        return $this->finalInsurer;
    }

    /**
     *
     * @return object $isMultipleInsurer
     */
    public function getIsMultipleInsurer()
    {
        return $this->isMultipleInsurer;
    }

    /**
     *
     * @return object $multipleInsurer
     */
    public function getMultipleInsurer()
    {
        return $this->multipleInsurer;
    }

    /**
     *
     * @return object $finalService
     */
    public function getFinalService()
    {
        return $this->finalService;
    }

    /**
     *
     * @return object finalSpecificService
     */
    public function getFinalSpecificService()
    {
        return $this->finalSpecificService;
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
     * @param \Settings\Entity\Insurer $finalInsurer
     */
    public function setFinalInsurer($finalInsurer)
    {
        $this->finalInsurer = $finalInsurer;
        return $this;
    }

    /**
     *
     * @param boolean $isMultipleInsurer
     */
    public function setIsMultipleInsurer($isMultipleInsurer)
    {
        $this->isMultipleInsurer = $isMultipleInsurer;
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $multipleInsurer
     */
    public function setMultipleInsurer($multipleInsurer)
    {
        $this->multipleInsurer = $multipleInsurer;
        return $this;
    }

    public function addMultipleInsurer($insurer)
    {
        if (! $this->multipleInsurer->contains($insurer)) {
            foreach ($insurer as $insure) {
                $this->multipleInsurer->add($insure);
            }
        }
        return $this;
    }

    public function removeMultipleInsurer($insurer)
    {
        if ($this->multipleInsurer->contains($insurer)) {
            foreach ($insurer as $insure) {
                $this->multipleInsurer->removeElement($insure);
            }
        }
        return $this;
    }

    /**
     *
     * @param \Settings\Entity\InsuranceServiceType $finalService
     */
    public function setFinalService($finalService)
    {
        $this->finalService = $finalService;
        return $this;
    }

    /**
     *
     * @param \Settings\Entity\InsuranceSpecificService $finalSpecificService
     */
    public function setFinalSpecificService($finalSpecificService)
    {
        $this->finalSpecificService = $finalSpecificService;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getPremiumPayable()
    {
        return $this->premiumPayable;
    }

    /**
     *
     * @param string $premiumPayable
     */
    public function setPremiumPayable($premiumPayable)
    {
        $this->premiumPayable = $premiumPayable;
        return $this;
    }

    /**
     *
     * @param \Transactions\Entity\Invoice $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
        return $this;
    }
    /**
     * @return string
     */
    public function getPremiumChangeReason()
    {
        return $this->premiumChangeReason;
    }

    /**
     * @param string $premiumChangeReason
     */
    public function setPremiumChangeReason($premiumChangeReason)
    {
        $this->premiumChangeReason = $premiumChangeReason;
        return $this;
    }

}

