<?php
namespace Messages\Entity;

use Doctrine\ORM\Mapping as ORM;
use Customer\Entity\Customer;
use Doctrine\Common\Collections\ArrayCollection;
use Offer\Entity\Offer;
use Doctrine\Common\Collections\Collection;
use Proposal\Entity\Proposal;
use Customer\Entity\CustomerPackage;
use GeneralServicer\Entity\Portal;
use Settings\Entity\CoverCategory;
use Policy\Entity\Policy;
use Users\Entity\InsuranceBrokerRegistered;

/**
 *
 * @ORM\Entity(repositoryClass="Messages\Entity\Repository\MessageRepository")
 * @ORM\Table(name="messages")
 *
 * @author otaba
 *        
 */
class Messages
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
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     *
     * @ORM\Column(name="message_title", type="string", nullable=true)
     *
     * @var string
     */
    private $messageTitle;

    /**
     *
     * @ORM\Column(name="massage_uid", type="string", nullable=true)
     *
     * @var string
     */
    private $messageUid;

    /**
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
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
     * @ORM\OneToMany(targetEntity="Messages\Entity\MessageEntered", mappedBy="messages", cascade={"persist", "remove"})
     *
     * @var Collection
     *
     */
    private $messageEntered;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\CoverCategory")
     * @ORM\JoinColumn(name="message_category", referencedColumnName="id")
     *
     * @var CoverCategory
     */
    private $messageCategory;

    /**
     *
     * @ORM\OneToOne(targetEntity="Offer\Entity\Offer", inversedBy="messages")
     * @ORM\JoinColumn(name="offer", referencedColumnName="id")
     *
     * @var Offer
     */
    private $offer;

    /**
     *
     * @ORM\OneToOne(targetEntity="Customer\Entity\CustomerPackage", inversedBy="messages")
     * @ORM\JoinColumn(name="customer_package", referencedColumnName="id")
     *
     * @var CustomerPackage
     */
    private $packages;

    /**
     *
     * @ORM\OneToOne(targetEntity="Proposal\Entity\Proposal", inversedBy="messages")
     * @ORM\JoinColumn(name="proposal", referencedColumnName="id")
     *
     * @var Proposal
     */
    private $proposals;

    /**
     *
     * @ORM\OneToOne(targetEntity="Policy\Entity\PolicyFloat", inversedBy="messages")
     * @ORM\JoinColumn(name="float_policy", referencedColumnName="id")
     *
     * @var Proposal
     */
    private $floatPolicy;

    /**
     *
     * @var Policy
     */
    private $policy;

    /**
     *
     * @ORM\OneToOne(targetEntity="IMServices\Entity\InsurePortal", inversedBy="messages")
     * @var Portal
     */
    private $portal;

    /**
     * This is only used if the message has no originof category lijke offer, pcakages, or proposal
     * and it is a direct message to the broker
     *
     * @ORM\OneToOne(targetEntity="Customer\Entity\Customer", inversedBy="messages")
     *
     * @var Customer
     */
    private $customer;

    /**
     */
    public function __construct()
    {
        $this->messageEntered = new ArrayCollection();
    }

    public function getMessageTitle()
    {
        return $this->messageTitle;
    }

    public function setMessageTitle($mess)
    {
        $this->messageTitle = $mess;
        return $this;
    }

    public function getMessageUid()
    {
        return $this->messageUid;
    }

    public function setMessageUid($uid)
    {
        $this->messageUid = $uid;
        return $this;
    }

    public function setCreatedOn($date)
    {
        $this->updatedOn = $date;
        $this->createdOn = $date;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
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

    public function addMessageEntered(MessageEntered $message)
    {
        if (! $this->messageEntered->contains($message)) {
            // $message->setMessages($this);
            $this->messageEntered->add($message);
        }

        return $this;
    }

    public function removeMessageEntered(MessageEntered $message)
    {
        if ($this->messageEntered->contains($message)) {
            $message->setMessages(NULL);
            $this->messageEntered->removeElement($message);
        }
    }

    // public function setMessageEntered($ent)
    // {
    // $this->messageEntered = $ent;
    // return $this;
    // }
    public function getMessageEntered()
    {
        return $this->messageEntered;
    }

    public function getMessageCatgory()
    {
        return $this->messageCategory;
    }

    public function setMessageCategory($cat)
    {
        $this->messageCategory = $cat;
        return $this;
    }

    public function getOffer()
    {
        return $this->offer;
    }

    public function setOffer($offer)
    {
        $this->offer = $offer;
        return $this;
    }

    public function getPackages()
    {
        return $this->packages;
    }

    public function setPackages($pack)
    {
        $this->packages = $pack;
        return $this;
    }

    public function getProposals()
    {
        return $this->proposals;
    }

    public function setProposals($prop)
    {
        $this->proposals = $prop;
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

    public function getFloatPolicy()
    {
        return $this->floatPolicy;
    }

    public function setFloatPolicy($float)
    {
        $this->floatPolicy = $float;
        return $this;
    }

    /**
     *
     * @return object $portal
     */
    public function getPortal()
    {
        return $this->portal;
    }

//     /**
//      *
//      * @param \GeneralServicer\Entity\Portal $portal
//      */
//     public function setPortal($portal)
//     {
//         $this->portal = $portal;
//         return $this;
//     }

    /**
     * @return \Users\Entity\InsuranceBrokerRegistered
     */
    public function getBroker()
    {
        return $this->broker;
    }

    /**
     * @return \Policy\Entity\Policy
     */
    public function getPolicy()
    {
        return $this->policy;
    }

    /**
     * @param \Users\Entity\InsuranceBrokerRegistered $broker
     */
    public function setBroker($broker)
    {
        $this->broker = $broker;
        return $this;
    }

    /**
     * @param \Policy\Entity\Policy $policy
     */
    public function setPolicy($policy)
    {
        $this->policy = $policy;
        return $this;
    }
    /**
     * @return \Settings\Entity\CoverCategory
     */
    public function getMessageCategory()
    {
        return $this->messageCategory;
    }


}

