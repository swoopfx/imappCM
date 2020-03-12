<?php
namespace Customer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Country;
use Settings\Entity\Zone;
use CsnUser\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use GeneralServicer\Entity\BrokerChild;
use Packages\Entity\Packages;
use GeneralServicer\Entity\Document;
use Doctrine\Common\Collections\Collection;
use Messages\Entity\Messages;

// use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer
 *
 * @author swoopfx
 *         @ORM\Table(name="customer")
 *         @ORM\Entity(repositoryClass="Customer\Entity\Repository\CustomerRepository")
 */
class Customer
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
     * @ORM\ManyToOne(targetEntity="GeneralServicer\Entity\Document")
     * @ORM\JoinColumn(name="customer_image", referencedColumnName="id")
     * 
     * @var Document
     */
    private $customerImage;

    /**
     *
     * @var \CsnUser\Entity\User @ORM\OneToOne(targetEntity="CsnUser\Entity\User")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *      })
     */
    private $user;

    /**
     * @ORM\Column(name="full_name", type="text", nullable=true)
     *
     * @var string
     */
    private $name;

    // this includes companies and individuals Full Name
    
    // /**
    // * @ORM\Column(name="phone", type="string", unique=true, nullable=true)
    // *
    // * @var string
    // */
    // private $phone;
    
    /**
     * @ORM\ManyToOne(targetEntity="Customer\Entity\CustomerCategory")
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     *
     * @var CustomerCategory
     */
    private $customerCategory;

    // /**
    // * @ORM\Column(name="email", type="string", unique=true, nullable=false)
    // *
    // * @var string
    // */
    // private $email;
    // // This has to be unique across the board
    
    /**
     * @ORM\Column(name="address1", type="text", nullable=true)
     *
     * @var string
     */
    private $address1;

    /**
     * @ORM\Column(name="address2", type="text", nullable=true)
     *
     * @var string
     */
    private $address2;

    /**
     * @ORM\Column(name="city", type="string", nullable=true)
     *
     * @var string
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Zone")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     *
     * @var Zone
     */
    private $state;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Country")
     * @ORM\JoinColumn(name="country", referencedColumnName="id")
     *
     * @var Country
     */
    private $country;

    /**
     * @ORM\Column(name="dob", type="date", nullable=true)
     *
     * @var \DateTime
     */
    private $dob;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updateOn;

    // /**
    // * @ORM\Column(name="pin", type="integer", nullable=false)
    // *
    // * @var integer
    // */
    // private $userPin;
    
    /**
     * @ORM\Column(name="account_id", type="string", nullable=false, unique=true)
     *
     * @var string
     */
    private $accountId;

    /**
     * This is either Broker or Agent
     * @ORM\ManyToOne(targetEntity="Customer\Entity\CustomerAdministrator")
     * @ORM\JoinColumn(name="admin", referencedColumnName="id")
     *
     * @var CustomerAdministrator
     */
    private $administrator;

    /**
     * TODO - change to one to many relationship
     * @ORM\OneToOne(targetEntity="Customer\Entity\CustomerBroker", mappedBy="customer", cascade={"persist", "remove"})
     *
     * @var CustomerBroker
     */
    private $customerBroker;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\BrokerChild", mappedBy="assignedCustomer", cascade={"persist", "remove"})
     * 
     * @var Collection
     */
    private $assignedChildBroker;

    /**
     * @ORM\OneToMany(targetEntity="Proposal\Entity\Proposal", mappedBy="customer")
     *
     * @var
     *
     */
    private $proposal;

    /**
     * @ORM\ManyToOne(targetEntity="Packages\Entity\Packages", inversedBy="recomendedCustomer" )
     * 
     * @var Packages
     */
    private $recommendedPackages;

    /**
     * @ORM\Column(name="is_hidden", type="boolean", nullable=true, options={"default":"0"})
     * 
     * @var boolean
     */
    private $isHidden;
    
    /**
     * @ORM\OneToOne(targetEntity="Messages\Entity\Messages", mappedBy="customer")
     *
     * @var Messages
     */
    private $messages;

    public function __construct()
    {
        $this->assignedChildBroker = new ArrayCollection();
        // $this->customerBroker = new ArrayCollection();
        $this->proposal = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getCustomerImage()
    {
        return $this->customerImage;
    }

    public function setCustomerImage($img)
    {
        $this->customerImage = $img;
        return $this;
    }

    public function getCustomerCategory()
    {
        return $this->customerCategory;
    }

    public function setCustomerCategory($cat)
    {
        $this->customerCategory = $cat;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    }

    public function getFullAddress()
    {
        return $this->getAddress1() . ' ' . $this->getAddress2() . ' ' . ($this->getState() != NULL ? $this->getState()->getZoneName() : "") . ' ' . ($this->getCountry() != NULL ? $this->getCountry()->getCountryName() : "");
    }

    public function getAddress1()
    {
        return $this->address1;
    }

    public function setAddress1($add)
    {
        $this->address1 = $add;
        
        return $this;
    }

    public function getAddress2()
    {
        return $this->address2;
    }

    public function setAddress2($address)
    {
        $this->address2 = $address;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
        
        return $this;
    }

    public function setCountry($count)
    {
        $this->country = $count;
        
        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getDob()
    {
        return $this->dob;
    }

    public function setDob($dob)
    {
        $this->dob = $dob;
        
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->updateOn = $date;
        
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updateOn;
    }

    public function setUpdatedOn($date)
    {
        $this->updateOn = $date;
        
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    //
    public function getBroker()
    {
        return $this->broker;
    }

    public function setBroker($broker)
    {
        $this->broker = $broker;
        
        return $this;
    }

    public function getAgent()
    {
        return $this->agent;
    }

    public function setAgent($agent)
    {
        $this->agent = $agent;
        
        return $this;
    }

    public function getAccountId()
    {
        return $this->accountId;
    }

    public function setAccountId($acc)
    {
        $this->accountId = $acc;
        return $this;
    }

    public function getCustomerToken()
    {
        return $this->customerToken;
    }

    public function setCustomerToken($token)
    {
        $this->customerToken = $token;
        return $this;
    }

    public function getAdministrator()
    {
        return $this->administrator;
    }

    public function setAdministrator($admin)
    {
        $this->administrator = $admin;
        return $this;
    }

    public function getCustomerBroker()
    {
        return $this->customerBroker;
    }

    public function setCustomerBroker($broker)
    {
        $this->customerBroker = $broker;
        return $this;
    }

    // public function addCustomerBroker($broker)
    // {
    // $this->customerBroker->setCustomer($this);
    // foreach ($broker as $brok) {
    // $this->customerBroker[] = $brok;
    // }
    // return $this;
    // }
    
    // public function removeCustomerBroker($broker)
    // {
    // $this->customerBroker->removeElement($broker);
    // }
    public function getProposal()
    {
        return $this->proposal;
    }

    public function addProposal($prop)
    {
        foreach ($prop as $proposal) {
            $this->proposal[] = $proposal;
            $proposal->setCustomer($this);
        }
    }

    public function getAssignedChildBroker()
    {
        return $this->assignedChildBroker;
    }

    public function addAssignedChildBroker(BrokerChild $broker)
    {
        if (! $this->assignedChildBroker->contains($broker)) {
            $broker->addAssignedCustomer($this);
            $this->assignedChildBroker->add($broker);
        }
        return $this;
    }

    public function removeAssignedChildBroker($element)
    {
        if ($this->assignedChildBroker->contains($element)) {
            $this->assignedChildBroker->removeElement($element);
        }
        return $this;
    }

    public function getRecommendedPackages()
    {
        return $this->recommendedPackages;
    }

    public function setRecommendedPackages($pack)
    {
        $this->recommendedPackages = $pack;
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
    
    public function getMessages(){
        return $this->messages;
    }
    
    public function setMessages($mess){
        $this->messages = $mess;
        return $this;
    }
}


