<?php
namespace Policy\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Settings\Entity\InsuranceServiceType;
use Settings\Entity\InsuranceSpecificService;
use Doctrine\Common\Collections\Collection;
use Customer\Entity\Customer;


/**
 * This is the policy holder generated before onboarding
 * It is neither linked to a Proposal, Offer or Package
 *
 * @ORM\Entity(repositoryClass="Policy\Entity\Repository\PolicyFloatRepository")
 * @ORM\Table(name="policy_float")
 *
 * @author otaba
 *        
 */
class PolicyFloat
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

//     /**
//     * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
//     *
//     * @var Customer
//     */
//     private $customer;

   
//     /**
//      *
//      * @ORM\OneToOne(targetEntity="Transactions\Entity\Invoice", inversedBy="policyFloat")
//      *
//      * @var Invoice
//      */
//     private $invoice;

    /**
     * This is a Many to One unidrectional mapping to offerSer
     * This defines if the offer is Motor Insurance, Burglary Insurance etc
     *
     * @var InsuranceServiceType @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceServiceType")
     *     
     *     
     */
    private $serviceType;

    /**
     * Defines the specific service
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceSpecificService")
     *
     * @var InsuranceSpecificService
     */
    private $specificService;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Object\Entity\Object")
     * @ORM\JoinTable(name="float_policy_objects",
     * joinColumns={@ORM\JoinColumn(name="float_policy", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="object_id", referencedColumnName="id")}
     * )
     *
     * @var Collection
     */
    private $objects;

//     /**
//      *
//      * @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\Document")
//      * @ORM\JoinTable(name="float_policy_doc",
//      * joinColumns={@ORM\JoinColumn(name="float_policy", referencedColumnName="id")},
//      * inverseJoinColumns={@ORM\JoinColumn(name="doc_id", referencedColumnName="id")}
//      * )
//      *
//      * @var \Doctrine\Common\Collections\Collection This is a many to many unidirectional mapping to document entity
//      */
//     private $documents;

    // /**
    // * if the value is percentage
    // * The calculation takes percentile
    // * else do it as absolute
    // * This is actually the proposed value of the offer and not the calculated Premium
    // * @ORM\Column(name="value", type="string", nullable=true)
    // *
    // * @var string
    // */
    // private $value;

    // /**
    // * @ORM\ManyToOne(targetEntity="Settings\Entity\DefinePackageValueType")
    // * @ORM\JoinColumn(name="value_type", referencedColumnName="id")
    // *
    // * @var DefinePackageValueType
    // */
    // private $valueType;

//     /**
//      *
//      * @ORM\Column(name="premium", type="string", nullable=true)
//      *
//      * @var string
//      */
//     private $premium;

//     /**
//      *
//      * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
//      *
//      * @var Currency
//      */
//     private $currency;

//     /**
//      *
//      * @ORM\ManyToOne(targetEntity="Settings\Entity\PolicyCoverDuration")
//      *
//      * @var PolicyCoverDuration
//      */
//     private $coverDuration;

//     /**
//      * This is only visibile if the cover duration in termed
//      *
//      * @ORM\OneToOne(targetEntity="Settings\Entity\PolicyCoverTermedValue", mappedBy="floatPolicy", cascade={"persist", "remove"})
//      *
//      * @var PolicyCoverTermedValue
//      */
//     private $termedDuration;

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
     * @var \Datetime
     */
    private $updatedOn;

//     /**
//      *
//      * @ORM\Column(name="policy_start_date", type="datetime", nullable=true)
//      * @var \DateTime
//      */
//     private $policyStartDate;

//     /**
//      *
//      * @ORM\Column(name="policy_end_date", type="datetime", nullable=true)
//      * @var \DateTime
//      */
//     private $policyEndDate;

    /**
     *
     * @ORM\OneToOne(targetEntity="Policy\Entity\CoverNote", mappedBy="policyFloat", cascade={"persist", "remove"})
     *
     *
     * @var CoverNote
     */
    private $coverNote;

//     /**
//      *
//      * @ORM\OneToOne(targetEntity="Messages\Entity\Messages", mappedBy="floatPolicy")
//      *
//      * @var Messages
//      */
//     private $messages;

    // /**
    // * @ORM\ManyToOne(targetEntity="IMServices\Entity\ContractAllRisk", inversedBy="floatingPolicy")
    // * @var ContractAllRisk
    // */
    // private $contractAllRisk;

    /**
     *
     * @ORM\Column(name="policy_float_uid", type="string", nullable=true, unique=true)
     *
     * @var string
     */
    private $policyFloatUid;

//     /**
//      *
//      * @ORM\Column(name="is_auto_renew", type="boolean", nullable=true)
//      *
//      * @var boolean
//      */
//     private $isAutoRenew;

//     /**
//      * This signifies if the float policy has been published
//      *
//      *  @ORM\Column(name="is_published", type="boolean", nullable=true)
//      * @var boolean
//      */
//     private $isPublished;

//     /**
//      *
//      * @ORM\Column(name="is_visible", type="boolean", nullable=true)
//      * @var boolean
//      */
//     private $isVisible;

    /**
     */
    public function __construct()
    {
        $this->objects = new ArrayCollection();
        $this->documents = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    public function getSpecificService()
    {
        return $this->specificService;
    }

    public function setSpecificService($spec)
    {
        $this->specificService = $spec;
        return $this;
    }

    public function getObjects()
    {
        return $this->objects;
    }

    public function addObjects($object)
    {
        if (! $this->objects->contains($object)) {
            $this->objects->add($object);
        }
        return $this;
    }

    public function removeObjects($object)
    {
        if ($this->objects->contains($object)) {
            $this->objects->removeElement($object);
        }

        return $this;
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

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
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

  

   

    public function getPolicyFloatUid()
    {
        return $this->policyFloatUid;
    }

    public function setPolicyFloatUid($uid)
    {
        $this->policyFloatUid = $uid;
        return $this;
    }

   

}

