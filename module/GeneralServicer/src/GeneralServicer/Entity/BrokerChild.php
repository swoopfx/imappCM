<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;
use CsnUser\Entity\User;
// use Users\Entity\BrokerChildProfile;
use Customer\Entity\Customer;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="broker_child")
 * @ORM\Entity(repositoryClass="GeneralServicer\Entity\Repository\BrokerChildRepository")
 *
 * @author swoopfx
 *        
 */
class BrokerChild
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="broker_child_uid", type="string", nullable=false, unique=true)
     * 
     * @var string
     */
    private $brokerChildUid;

    /**
     * This is not required any more
     * This is the broker Id of the mother broker
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     * @ORM\JoinColumn(name="broker_id", referencedColumnName="id")
     *
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    // /**
    // * @ORM\Column(name="broker_uid", type="string", nullable=false)
    // *
    // * @var string
    // */
    // protected $brokerUid;
    
    /**
     *
     * This is the user entity of the child broker
     * @ORM\OneToOne(targetEntity="CsnUser\Entity\User", inversedBy="brokerChild")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var User
     */
    private $user;

    /**
     * @ORM\Column(name="firstname", type="string", nullable=true)
     *
     * @var string
     */
    private $firstname;

    /**
     * @ORM\Column(name="lastname", type="string", nullable=true)
     *
     * @var string
     */
    private $lastname;

    /**
     * @ORM\Column(name="facebook", type="string", nullable=true)
     *
     * @var string
     */
    private $facebook;

    /**
     * @ORM\Column(name="linkedIn", type="string", nullable=true)
     *
     * @var string
     */
    private $linkedIn;

    /**
     * @ORM\Column(name="tweeter", type="string", nullable=true)
     *
     * @var string
     */
    private $tweeter;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="modified_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $modifiedOn;

    /**
     *
     * @var \Doctrine\Common\Collections\Collection @ORM\ManyToMany(targetEntity="Customer\Entity\Customer", inversedBy="assignedChildBroker", cascade={"persist", "remove"} )
     *      @ORM\JoinTable(name="child_broker_customer")
     *      Custo
     */
    private $assignedCustomer;

    // /**
    // * @ORM\ManyToOne(targetEntity="Customer\Entity\CustomerBroker", inversedBy="brokerChild", cascade={"persist", "remove"})
    // *
    // * @var CustomerBroker
    // */
    // private $customerBroker;
    public function __construct()
    {
        $this->assignedCustomer = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBrokerChildUid()
    {
        return $this->brokerChildUid;
    }

    public function setBrokerChildUid($uid)
    {
        $this->brokerChildUid = $uid;
        return $this;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setBroker($broker)
    {
        $this->broker = $broker;
        
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($name)
    {
        $this->firstname = $name;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($name)
    {
        $this->lastname = $name;
        return $this;
    }

    public function setUser($uid)
    {
        $this->user = $uid;
        
        return $this;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->modifiedOn = $date;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setModifiedOn($date)
    {
        $this->modifiedOn = $date;
        return $this;
    }

    public function getModifiedOn()
    {
        return $this->modifiedOn;
    }

    public function getBrokerChildProfile()
    {
        return $this->brokerChildProfile;
    }

    public function getFullName()
    {
        return $this->lastname . " " . $this->firstname;
    }

    public function getAssignedCustomer()
    {
        return $this->assignedCustomer;
    }

    // /**
    // *
    // * @param Customer $id
    // * @return array
    // */
    // public function getOneAssignedCustomer(Customer $id){
    // return $this->assignedCustomer[$id]->getValues();
    // }
    public function addAssignedCustomer($customer)
    {
        if (! $this->assignedCustomer->contains($customer)) {
            $this->assignedCustomer->add($customer);
        }
        return $this;
    }

    public function removeAssignedCustomer($customer)
    {
        if ($this->assignedCustomer->contains($customer)) {
            $this->assignedCustomer->removeElement($customer);
        }
        return $this;
    }

    public function getFacebook()
    {
        return $this->facebook;
    }

    public function setFacebook($book)
    {
        $this->facebook = $book;
        return $this;
    }

    public function setlinkedIn($in)
    {
        $this->linkedIn = $in;
        return $this;
    }

    public function getLinkedIn()
    {
        return $this->linkedIn;
    }

    public function getTweeter()
    {
        return $this->tweeter;
    }

    public function setTweeter($tweet)
    {
        $this->tweeter = $tweet;
        return $this;
    }
}

