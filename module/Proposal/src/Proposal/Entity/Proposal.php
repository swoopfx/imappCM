<?php
namespace Proposal\Entity;

use Doctrine\ORM\Mapping as ORM;
use Customer\Entity\Customer;
// use CsnUser\Entity\User;
use GeneralServicer\Entity\Document;
use Doctrine\Common\Collections\ArrayCollection;
use Settings\Entity\InsuranceServiceType;
use Settings\Entity\InsuranceSpecificService;
use Settings\Entity\Insurer;
use Settings\Entity\Administrator;
use Transactions\Entity\Invoice;
use Settings\Entity\InsuranceType;
use Settings\Entity\Currency;
use Object\Entity\Object;
use Settings\Entity\MicroPaymentStructure;
use Policy\Entity\CoverNote;
use GeneralServicer\Entity\ManualPremium;
use IMServices\Entity\CoverDetails;
use Settings\Entity\DefinePackageValueType;
use Messages\Entity\Messages;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\PolicyCoverTermedValue;
use Settings\Entity\PolicyCoverDuration;
use Offer\Entity\Offer;

/**
 * Proposal
 *
 * @ORM\Table(name="proposals")
 * @ORM\Entity(repositoryClass="Proposal\Entity\Repository\ProposalRepository")
 */
class Proposal
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer", inversedBy="proposal")
     * @ORM\JoinColumn(name="customer", referencedColumnName="id")
     *
     * @var Customer
     */
    private $customer;

    /**
     * @ORM\Column(name="proposal_title", type="string", nullable=true)
     *
     * @var string
     */
    private $proposalTitle;

    /**
     * @ORM\Column(name="proposal_desc", type="text", nullable=true)
     *
     * @var string
     */
    private $proposalDesc;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var string
     */
    private $createdOn;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceType")
     * @ORM\JoinColumn(name="insurance_type", referencedColumnName="id")
     *
     * @var InsuranceType
     */
    private $insuranceCategory;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     * @ORM\JoinColumn(name="insurer", referencedColumnName="id")
     *
     * @var Insurer
     */
    private $insurer;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     *
     * @var \Datetime
     */
    private $updatedOn;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceServiceType")
     * @ORM\JoinColumn(name="service_type", referencedColumnName="id")
     *
     * @var InsuranceServiceType
     */
    private $serviceType;

    /**
     * @ORM\Column(name="other_service_type", type="string", nullable=true)
     *
     * @var string
     */
    private $otherServiceType;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceSpecificService")
     * @ORM\JoinColumn(name="specific_service", referencedColumnName="id")
     *
     * @var InsuranceSpecificService
     */
    private $specificService;

    /**
     * @ORM\Column(name="other_specific_service", type="string", nullable=true)
     *
     * @var string
     */
    private $otherSpecificService;

    /**
     * This defines if any of the service is not defined from the SpecificService
     * Or if the Broker chooses Others or custom service
     * @ORM\Column(name="custom_service", type="string", nullable=true)
     *
     * @var string
     */
    private $customService;

    /**
     *
     * @var \Doctrine\Common\Collections\Collection @ORM\ManyToMany(targetEntity="Object\Entity\Object")
     *      @ORM\JoinTable(name="object_proposal",
     *      joinColumns={
     *      @ORM\JoinColumn(name="proposal_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={
     *      @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     *      }
     *      )
     * @var Object
     */
    private $object;

    /**
     * @ORM\OneToOne(targetEntity="Transactions\Entity\Invoice", mappedBy="proposal")
     *
     *
     * @var Invoice
     */
    private $invoice;

    /**
     *
     * @var \Doctrine\Common\Collections\Collection @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\Document")
     *      @ORM\JoinTable(name="doc_proposal",
     *      joinColumns={
     *      @ORM\JoinColumn(name="proposal_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={
     *      @ORM\JoinColumn(name="doc_id", referencedColumnName="id")
     *      }
     *      )
     */
    private $document;

    /**
     * @ORM\Column(name="proposal_code", type="string", unique=true, nullable=false)
     *
     * @var string
     */
    private $proposalCode;

    /**
     * @ORM\ManyToOne(targetEntity="Proposal\Entity\ProposalStatus")
     * @ORM\JoinColumn(name="proposal_status_id", referencedColumnName="id")
     *
     * @var ProposalStatus
     */
    private $proposalStatus;

    // /**
    // * @ORM\OneToOne(targetEntity="Proposal\Entity\ProposalBroker", mappedBy="proposal", cascade={"persist", "remove"} )
    // *
    // * @var ProposalBroker
    // */
    // private $proposalBroker;
    
    /**
     * An Active proposal is one that has not bee transfered to a policy
     * @ORM\Column(name="is_active", type="boolean", nullable=true, options={"default" : 1})
     *
     * @var boolean
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Administrator")
     * @ORM\JoinColumn(name="administrator", referencedColumnName="id")
     *
     * @var Administrator
     */
    private $proposalAdminstrator;

    /**
     * This actually mimic the delete button
     * As nothing is actually deleted on the database
     * @ORM\Column(name="is_hidden", type="boolean", nullable=false, options={"default" : 0})
     *
     * @var boolean
     */
    private $isHidden;

    /**
     * @ORM\OneToOne(targetEntity="Policy\Entity\CoverNote", mappedBy="proposal")
     *
     * @var CoverNote
     */
    private $coverNote;

    /**
     * This determines if the customer can actually see thee proposal
     * @ORM\Column(name="is_visible", type="boolean", nullable=false, options={"default" : 0})
     *
     * @var boolean
     */
    private $isVisible;

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
     * @ORM\ManyToOne(targetEntity="Settings\Entity\DefinePackageValueType")
     *
     *
     * @var DefinePackageValueType
     */
    private $valueType;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     *
     * @var Currency
     */
    private $currency;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MicroPaymentStructure")
     * @ORM\JoinColumn(name="value_type", referencedColumnName="id")
     *
     * @var MicroPaymentStructure
     */
    private $microPayment;

    /**
     * @ORM\OneToOne(targetEntity="Messages\Entity\Messages", mappedBy="proposals")
     *
     * @var Messages
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PolicyCoverDuration")
     *
     * @var PolicyCoverDuration
     */
    private $coverDuration;

    /**
     * @ORM\Column(name="termed_duration", type="string", nullable=true)
     *
     * @var string
     */
    private $termedDuration;

    /**
     * Overwrites the default calculated premium value
     *
     * @ORM\OneToOne(targetEntity="GeneralServicer\Entity\ManualPremium", mappedBy="proposal", cascade={"persist", "remove"})
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

    /**
     * This identifies if the finalize button was once clicked
     * @ORM\Column(name="is_finalized", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isFinalized;

    /**
     * This identifies if the finalize button was once clicked
     * @ORM\Column(name="is_cover_details", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCoverDetails;

    /**
     * @ORM\OneToOne(targetEntity="IMServices\Entity\CoverDetails", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="cover_details", referencedColumnName="id")
     *
     * @var CoverDetails
     */
    private $coverDetails;

    /**
     * Defines if the data has been exported to the insurance company
     *
     * @ORM\Column(name="is_export", type="boolean", nullable=true, options={"default" : 0})
     *
     * @var boolean
     */
    private $isExport;

    /**
     * @ORM\OneToMany(targetEntity="IMServices\Entity\InsurePortal", mappedBy="proposal", cascade={"persist", "remove"})
     * 
     * @var 
     */
    private $insurerPortal;
    
    /**
     * identifies if a policy has been generated 
     * @ORM\Column(name="is_policy", type="boolean", nullable=true, options={"default" : 0})
     * @var boolean
     */
    private $isPolicy;
    
    /**
     * Identify if the proposal should be closed 
     * @ORM\Column(name="is_closed", type="boolean", nullable=true, options={"default" : 0})
     * @var boolean
     */
    private $isClosed;

    // // Beegin service type custom information
    // /**
    // * @ORM\ManyToOne(targetEntity="IMServices\Entity\ContractAllRisk", inversedBy="proposal")
    // */
    // private $contractAllRisk;
    public function __construct()
    {
        $this->insurerPortal = new ArrayCollection();
        $this->object = new ArrayCollection();
        $this->document = new ArrayCollection();
    }

    /**
     *
     * @return object $customService
     */
    public function getCustomService()
    {
        return $this->customService;
    }

    /**
     *
     * @param string $customService            
     */
    public function setCustomService($customService)
    {
        $this->customService = $customService;
        return $this;
    }

    /**
     *
     * @return object $microPayment
     */
    public function getMicroPayment()
    {
        return $this->microPayment;
    }

    /**
     *
     * @param \Settings\Entity\MicroPaymentStructure $microPayment            
     */
    public function setMicroPayment($microPayment)
    {
        $this->microPayment = $microPayment;
        return $this;
    }

    /**
     *
     * @return object $isVisible
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($cust)
    {
        $this->customer = $cust;
        return $this;
    }

    public function getProposalTitle()
    {
        return $this->proposalTitle;
    }

    public function setProposalTitle($title)
    {
        $this->proposalTitle = $title;
        return $this;
    }

    public function getProposalDesc()
    {
        return $this->proposalDesc;
    }

    public function setProposalDesc($desc)
    {
        $this->proposalDesc = $desc;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->updatedOn = $date;
        
        return $this;
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

    public function getInsuranceCategory()
    {
        return $this->insuranceCategory;
    }

    public function setInsuranceCategory($cat)
    {
        $this->insuranceCategory = $cat;
        return $this;
    }

    public function getInvoice()
    {
        return $this->invoice;
    }

    public function getInsurer()
    {
        return $this->insurer;
    }

    public function setInsurer($ins)
    {
        $this->insurer = $ins;
        return $this;
    }

    public function getSpecificService()
    {
        return $this->specificService;
    }

    public function setSpecificService($serve)
    {
        $this->specificService = $serve;
        return $this;
    }

    public function getServiceType()
    {
        return $this->serviceType;
    }

    public function setServiceType($type)
    {
        $this->serviceType = $type;
        return $this;
    }

    public function getProposalCode()
    {
        return $this->proposalCode;
    }

    public function setProposalCode($coode)
    {
        $this->proposalCode = $coode;
        return $this;
    }

    public function getProposalStatus()
    {
        return $this->proposalStatus;
    }

    public function setProposalStatus($status)
    {
        $this->proposalStatus = $status;
        return $this;
    }

    /**
     * Add $object
     *
     * @param \Object\Entity\Object $object            
     *
     * @return \Object\Entity\Object
     */
    public function addObject($object)
    {
        if (! $this->object->contains($object)) {
            $this->object[] = $object;
        }
        
        return $this;
    }

    /**
     * Remove Object
     *
     * @param \Object\Entity\Object $idDoc            
     */
    public function removeObject($object)
    {
        if($this->object->contains($object)){
            $this->object->removeElement($object);
        }
       return $this;
    }

    /**
     * Get Object
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Add idDoc
     *
     * @param Document $idDoc            
     *
     * @return Offer
     */
    public function addDocument(Document $idDoc)
    {
        if (! $this->document->contains($idDoc)) {
            $this->document->add($idDoc);
        }
        
        return $this;
    }

    /**
     * Remove idDoc
     *
     * @param Document $idDoc            
     */
    public function removeDocument(Document $idDoc)
    {
        if ($this->document->contains($idDoc)) {
            $this->document->removeElement($idDoc);
        }
        
        return $this;
    }

    /**
     * Get idDoc
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocument()
    {
        return $this->document;
    }

    public function getProposalBroker()
    {
        return $this->proposalBroker;
    }

    public function setIsActive($bool)
    {
        $this->isActive = $bool;
        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function getProposalAdminstrator()
    {
        return $this->proposalAdminstrator;
    }

    public function setProposalAdminstrator($prop)
    {
        $this->proposalAdminstrator;
        return $this;
    }

    public function getIsHidden()
    {
        return $this->isHidden;
    }

    public function setIsHidden($hide)
    {
        $this->isHidden = $hide;
        return $this;
    }

    public function getIsVisibile()
    {
        return $this->isVisible;
    }

    public function setIsVisible($vis)
    {
        $this->isVisible = $vis;
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

    public function setValueType($type)
    {
        $this->valueType = $type;
        return $this;
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

    public function getMessages()
    {
        return $this->messages;
    }

    public function getCoverNote()
    {
        return $this->coverNote;
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

    public function setManualPremium($man)
    {
        $this->manualPremium = $man;
        return $this;
    }

    public function getIsManualPremium()
    {
        return $this->isManualPremium;
    }

    public function setIsManualPremium($man)
    {
        $this->isManualPremium = $man;
        return $this;
    }

    public function getIsFinalized()
    {
        return $this->isFinalized;
    }

    public function setIsFinalized($fin)
    {
        $this->isFinalized = $fin;
        return $this;
    }

    public function getCoverDetails()
    {
        return $this->coverDetails;
    }

    public function setCoverDetails($det)
    {
        $this->coverDetails = $det;
        return $this;
    }

    // public function getContractAllRisk(){
    // return $this->contractAllRisk;
    // }
    
    // public function setContractAllRisk($risk){
    // $this->contractAllRisk = $risk;
    // return $this;
    // }
    
    /**
     *
     * @return object $isCoverDetails
     */
    public function getIsCoverDetails()
    {
        return $this->isCoverDetails;
    }

    /**
     *
     * @param boolean $isCoverDetails            
     */
    public function setIsCoverDetails($isCoverDetails)
    {
        $this->isCoverDetails = $isCoverDetails;
        return $this;
    }

    /**
     *
     * @return object $otherServiceType
     */
    public function getOtherServiceType()
    {
        return $this->otherServiceType;
    }

    /**
     *
     * @param string $otherServiceType            
     */
    public function setOtherServiceType($otherServiceType)
    {
        $this->otherServiceType = $otherServiceType;
        return $this;
    }

    /**
     *
     * @return object $otherSpecificService
     */
    public function getOtherSpecificService()
    {
        return $this->otherSpecificService;
    }

    /**
     *
     * @param string $otherSpecificService            
     */
    public function setOtherSpecificService($otherSpecificService)
    {
        $this->otherSpecificService = $otherSpecificService;
        return $this;
    }

    /**
     *
     * @return boolean $isExport
     */
    public function getIsExport()
    {
        return $this->isExport;
    }

    /**
     *
     * @param boolean $isExport            
     */
    public function setIsExport($isExport)
    {
        $this->isExport = $isExport;
        return $this;
    }

    /**
     *
     * @return object $insurerPortal
     */
    public function getInsurerPortal()
    {
        return $this->insurerPortal;
    }

    public function addInsurerPortal($portal)
    {
        if (! $this->insurerPortal->contains($portal)) {
            $this->insurerPortal[] = $portal;
        }
        return $this;
    }

    public function removeInsurerPortal($portal)
    {
        if ($this->insurerPortal->contains($portal)) {
            $this->insurerPortal->removeElement($portal);
        }
        return $this;
    }
    /**
     * @return object $isPolicy
     */
    public function getIsPolicy()
    {
        return $this->isPolicy;
    }

    /**
     * @param boolean $isPolicy
     */
    public function setIsPolicy($isPolicy)
    {
        $this->isPolicy = $isPolicy;
        return $this;
    }
    
    public function getIsClosed(){
        return $this->isClosed;
    }
    /**
     * @param boolean $isClosed
     */
    public function setIsClosed($isClosed)
    {
        $this->isClosed = $isClosed;
        return $this;
    }


}

