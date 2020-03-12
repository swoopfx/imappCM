<?php
namespace Offer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Offer\Entity\OfferServiceType;
use Offer\Entity\OfferSpecificService;
use GeneralServicer\Entity\Document;
use Object\Entity\Object;
use CsnUser\Entity\User;
use Users\Entity\InsuranceBrokerRegistered;
use Settings\Entity\Insurer;
use Customer\Entity\Customer;
use Settings\Entity\InsuranceServiceType;
use Transactions\Entity\Invoice;
use Settings\Entity\DefinePackageValueType;
use Settings\Entity\InsuranceSpecificService;
use Settings\Entity\CoverDuration;
use Messages\Entity\Messages;
use Settings\Entity\PolicyCoverTermedValue;
use GeneralServicer\Entity\ManualPremium;
// use Object\Entity\ObjectContractAllRisk;
use IMServices\Entity\ContractAllRisk;
use Settings\Entity\Currency;

// use IMServices\Entity\MotorOfferData;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity(repositoryClass="Offer\Entity\Repository\OfferRepository")
 */
class Offer
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="offer_name", type="string", nullable=true)
     *
     * @var string
     */
    private $offerName;

    /**
     *
     * @var string @ORM\Column(name="offer_code", type="string", length=45, nullable=true)
     */
    private $offerCode;

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
     * This is a Many to One unidrectional mapping to offerSer
     * This defines if the offer is Motor Insurance, Burglary Insurance etc
     *
     * @var InsuranceServiceType @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceServiceType")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="offer_service_type", referencedColumnName="id")
     *      })
     */
    private $offerServiceType;

    // /**
    // * @ORM\Column(name="require_advice", type="boolean", nullable=true)
    // * @var boolean
    // */
    // private $requireAdvice;
    
    /**
     *
     * @var boolean @ORM\Column(name="is_renewable", type="boolean", nullable=true)
     */
    private $isRenewable;

    // set to true
    
    /**
     *
     * @var boolean @ORM\Column(name="is_hidden", type="boolean", nullable=true)
     */
    private $isHidden = False;

    /**
     *
     * @var boolean @ORM\Column(name="is_policized", type="boolean", nullable=true)
     */
    private $isPolicized = False;

    // once this is true there is no more editing on the form alloewd
    
    /**
     * This is the customer 
     *
     * @var \Settings\Entity\Insurer @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_preferd_insurer", referencedColumnName="id")
     *      })
     */
    private $idPreferdInsurer;

    /**
     * This should be a collection
     * That is a one to many relationship
     *
     * @var \Settings\Entity\Insurer @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="recommended_insurer", referencedColumnName="id")
     *      })
     */
    private $recommendedInsurer;

    /**
     * @ORM\Column(name="is_recommended_insurer", type="boolean", nullable=true, options={})
     *
     * @var boolean
     */
    private $isRecommendedInsurer;

    /**
     *
     * @var \Users\Entity\InsuranceBrokerRegistered @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="insurance_broker", referencedColumnName="id")
     *      })
     */
    private $idInsuranceBroker;

    /**
     *
     * @var \Offer\Entity\OfferStatus @ORM\ManyToOne(targetEntity="Offer\Entity\OfferStatus")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="offer_statuses", referencedColumnName="id")
     *      })
     */
    private $offerStatuses;

    /**
     *
     * @var \Customer\Entity\Customer @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="customer", referencedColumnName="id")
     *      })
     */
    private $customer;

    /**
     *
     * @var \Doctrine\Common\Collections\Collection @ORM\ManyToMany(targetEntity="Object\Entity\Object")
     *      @ORM\JoinTable(name="object_offer",
     *      joinColumns={
     *      @ORM\JoinColumn(name="offer_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={
     *      @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     *      }
     *      )
     */
    private $object;

    /**
     * @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\Document")
     * @ORM\JoinTable(name="offer_doc",
     * joinColumns={@ORM\JoinColumn(name="offer_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="doc_id", referencedColumnName="id")}
     * )
     *
     * This is a many to many unidirectional mapping to document entity
     */
    private $idDoc;

    /**
     *
     * @var InsuranceSpecificService @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceSpecificService")
     *      @ORM\JoinColumn(name="offer_specific_service", referencedColumnName="id")
     */
    private $offerSpecificService;

    /**
     * This a boolean confriming that the user has confiremed
     * all decalration to the service
     *
     * @var boolean @ORM\Column(name="is_declared", type="boolean", nullable=true)
     */
    private $isDeclared;

    /**
     * if the value is percentage
     * The calculation takes percentile
     * else do it as absolute
     * This is actually the proposed value of the offer and not the calculated Premium
     * @ORM\Column(name="value", type="string", nullable=true)
     *
     * @var string
     */
    private $value;
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     * @var Currency
     */
    private $currency;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\DefinePackageValueType")
     * @ORM\JoinColumn(name="value_type", referencedColumnName="id")
     *
     * @var DefinePackageValueType
     */
    private $valueType;

    /**
     * @ORM\OneToOne(targetEntity="Policy\Entity\CoverNote", mappedBy="offer")
     *
     * @var CoverNote
     */
    private $coverNote;

    /**
     * @ORM\OneToOne(targetEntity="Transactions\Entity\Invoice", mappedBy="offer", cascade={"persist", "remove"})
     *
     * @var Invoice
     */
    private $invoice;

    /**
     * This defines the time frame the cover is valid e.g Yearly, monthly weekly
     * It also defines if the micro payment form would activated
     * A micro payment form is only activated when the yearly payment is not selected
     * @ORM\ManyToOne(targetEntity="Settings\Entity\CoverDuration")
     *
     * @var CoverDuration
     */
    private $duration;

    /**
     * @ORM\OneToOne(targetEntity="Messages\Entity\Messages", mappedBy="offer")
     *
     * @var Messages
     */
    private $messages;

    /**
     * This defines the timeframe the offer is active and valid the detault value is yearly
     * But if the value is termed, a specifica values needs to be defined
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PolicyCoverDuration")
     * 
     * @var CoverDuration
     */
    private $coverDuration;

    /**
     * @ORM\OneToOne(targetEntity="Settings\Entity\PolicyCoverTermedValue", mappedBy="offer", cascade={"persist", "remove"})
     * 
     * @var PolicyCoverTermedValue
     */
    private $termedDuration;

    /**
     * Overwrites the default calculated premium value
     *
     * @ORM\OneToOne(targetEntity="GeneralServicer\Entity\ManualPremium", mappedBy="offer")
     * 
     * @var ManualPremium
     */
    private $manualPremium;

    /**
     * This signifies if the manual premium should be used
     * @ORM\Column(name="is_manual_premium", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isManualPremium;

    // Begin custom service details
    
    /*
     * This defines the details of the service selected
     */
    
//     /**
//      * @ORM\ManyToOne(targetEntity="IMServices\Entity\ContractAllRisk", inversedBy="offer")
//      * 
//      * @var ContractAllRisk
//      */
//     private $contractAllRisk;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->object = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idDoc = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     *
     * @return string
     */
    public function getOfferName()
    {
        return $this->offerName;
    }

    /**
     *
     * @param string $offer            
     */
    public function setOfferName($offer)
    {
        $this->offerName = $offer;
        return $this;
    }

    /**
     * Set offerCode
     *
     * @param string $offerCode            
     *
     * @return Offer
     */
    public function setOfferCode($offerCode)
    {
        $this->offerCode = $offerCode;
        
        return $this;
    }

    /**
     * Get offerCode
     *
     * @return string
     */
    public function getOfferCode()
    {
        return $this->offerCode;
    }

    /**
     *
     * @return \Customer\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     *
     * @param unknown $customer            
     * @return \Offer\Entity\Offer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn            
     *
     * @return Offer
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        $this->updatedOn = $createdOn;
        
        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn            
     *
     * @return Offer
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
        
        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     *
     * @return
     *
     */
    public function getOfferServiceType()
    {
        return $this->offerServiceType;
    }

    /**
     *
     * @param \Offer\Entity\OfferServiceType $ost            
     * @return \Offer\Entity\Offer
     */
    public function setOfferServiceType($ost)
    {
        $this->offerServiceType = $ost;
        return $this;
    }

    /**
     * Set isRenewable
     *
     * @param boolean $isRenewable            
     *
     * @return Offer
     */
    public function setIsRenewable($isRenewable = false)
    {
        $this->isRenewable = $isRenewable;
        
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
     * @return Offer
     */
    public function setIsHidden($isHidden = false)
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

    /**
     * Set isPolicized
     *
     * @param boolean $isPolicized            
     *
     * @return Offer
     */
    public function setIsPolicized($isPolicized = false)
    {
        $this->isPolicized = $isPolicized;
        
        return $this;
    }

    /**
     * Get isPolicized
     *
     * @return boolean
     */
    public function getIsPolicized()
    {
        return $this->isPolicized;
    }

    /**
     * Get idPreferdInsurer
     *
     * @return Insurer
     */
    public function getIdPreferdInsurer()
    {
        return $this->idPreferdInsurer;
    }

    /**
     * Set idPreferdInsurer
     *
     * @param Insurer $idPreferdInsurer            
     *
     * @return Offer
     */
    public function setIdPreferdInsurer(Insurer $idPreferdInsurer = null)
    {
        $this->idPreferdInsurer = $idPreferdInsurer;
        
        return $this;
    }

    public function setRecommendedInsurer($ins)
    {
        $this->recommendedInsurer = $ins;
        return $this;
    }

    public function getRecommendedInsurer()
    {
        return $this->recommendedInsurer;
    }

    public function setIsRecommendedInsurer($ins)
    {
        $this->isRecommendedInsurer = $ins;
        return $this;
    }

    public function getIsRecommendedInsurer()
    {
        return $this->isRecommendedInsurer;
    }

    /**
     * Set idInsuranceBroker
     *
     * @param InsuranceBrokerRegistered $idInsuranceBroker            
     *
     * @return Offer
     */
    public function setIdInsuranceBroker(InsuranceBrokerRegistered $idInsuranceBroker = null)
    {
        $this->idInsuranceBroker = $idInsuranceBroker;
        
        return $this;
    }

    /**
     * Get idInsuranceBroker
     *
     * @return InsuranceBrokerRegistered
     */
    public function getIdInsuranceBroker()
    {
        return $this->idInsuranceBroker;
    }

    public function getOfferStatuses()
    {
        return $this->offerStatuses;
    }

    /**
     * Set offerStatuses
     *
     * @param OfferStatus $offerStatuses            
     *
     * @return Offer
     */
    public function setOfferStatuses(OfferStatus $offerStatuses = null)
    {
        $this->offerStatuses = $offerStatuses;
        
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($val)
    {
        $this->value = $val;
        return $this;
    }

    public function getValueType()
    {
        return $this->valueType;
    }
    
    public function getCurrency(){
        return $this->currency;
    }
    
    public function setCurrency($cur){
        $this->currency = $cur;
        return $this;
    }

    public function setValueType($val)
    {
        $this->valueType = $val;
        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get object
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Add object
     *
     * @param Object $object            
     *
     * @return Offer
     */
    public function addObject(Object $object)
    {
        if (! $this->object->contains($object)) {
            $this->object->add($object);
        }
        
        return $this;
    }

    /**
     * Remove object
     *
     * @param \Object\Entity\Object $object            
     */
    public function removeObject(\Object\Entity\Object $object)
    {
        $this->object->removeElement($object);
    }

    /**
     * Add idDoc
     *
     * @param Document $idDoc            
     *
     * @return Offer
     */
    public function addIdDoc(Document $idDoc)
    {
        if (! $this->idDoc->contains($idDoc)) {
            $this->idDoc->add($idDoc);
        }
        return $this;
    }

    /**
     * Remove idDoc
     *
     * @param Document $idDoc            
     */
    public function removeIdDoc(Document $idDoc)
    {
        if ($this->idDoc->contains($idDoc)) {
            $this->idDoc->removeElement($idDoc);
        }
        return $this;
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

    public function getOfferSpecificService()
    {
        return $this->offerSpecificService;
    }

    public function setOfferSpecificService($service)
    {
        $this->offerSpecificService = $service;
        return $this;
    }

    public function getMotorOfferData()
    {
        return $this->motorOfferData;
    }

    public function setMotorOfferData($motor)
    {
        $this->motorOfferData = $motor;
        
        return $this;
    }

    public function getOfferStatusWord()
    {
        return $this->offerStatuses->getOfferStatusId()->getStatusWord();
    }

    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setInvoice($invo)
    {
        $this->invoice = $invo;
        return $this;
    }

    public function getCoverNote()
    {
        return $this->coverNote;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($dur)
    {
        $this->duration = $dur;
        return $this;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function getCoverDuration()
    {
        return $this->coverDuration;
    }

    public function setCoverDuration($dur)
    {
        $this->coverDuration = $dur;
        return $this;
    }

    public function getTermedDuration()
    {
        return $this->termedDuration;
    }

    public function setTermedDuration($term)
    {
        $this->termedDuration = $term;
        return $this;
    }

    public function getManualPremium()
    {
        return $this->manualPremium;
    }

    public function setManualPremium($set)
    {
        $this->manualPremium = $set;
        return $this;
    }

    public function getIsManualPremium()
    {
        return $this->manualPremium;
    }

    public function setIsManualPremium($man)
    {
        $this->isManualPremium = $man;
        return $this;
    }

    public function getContractAllRisk()
    {
        return $this->contractAllRisk;
    }

    public function setContractAllRisk($risk)
    {
        $this->contractAllRisk = $risk;
        return $this;
    }
    
    // * uniqueConstraints={@ORM\UniqueConstraint(name="offer_code_UNIQUE", columns={"offer_code"})},
    // * indexes={@ORM\Index(name="FK_offer_data_user_idx", columns={"user_id"}),
    // * @ORM\Index(name="FK_offer_related_broker_idx", columns={"id_insurance_broker"}),
    // * @ORM\Index(name="FK_offer_prefered_insurer_idx", columns={"id_preferd_insurer"}),
    // * @ORM\Index(name="FK_29D6873EA25512BD_idx", columns={"offer_statuses"})})
}
