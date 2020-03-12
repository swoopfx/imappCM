<?php
namespace Transactions\Entity;

// use Mapp
use Doctrine\ORM\Mapping  as ORM;
use Users\Entity\InsuranceBrokerRegistered;
use CsnUser\Entity\User;

/**
 * It signifies no broker bank account 
 * Hence a transfer would not take place to the brokers maccount number 
 * This class defines all transaction that could not be transfer to broker 
 * for either reason 
 * @ORM\Entity
 * @ORM\Table(name="no_broker_account")
 * @author otaba
 *
 */
class NoBrokerAccount
{
    
    /**
     *
     * @var integer This is only genertated upon successful transaction
     *      @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     * @var InsuranceBrokerRegistered
     */
    private $broker;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     * @var User
     */
    private $user; // alternatively the customer that initiated the payment
    
    /**
     * The reference of the payment made 
     * @ORM\Column(name="transaction_ref", type="string", nullable=true)
     * @var string
     */
    private $transactionRef;
    
    /**
     * The amount paid
     * @ORM\Column(name="amount_paid", type="string", nullable=true)
     * @var string
     */
    private $amountPaid;
    
    /**
     * @ORM\ManyToOne(targetEntity="NoBrokerAccountStatus")
     * @var NoBrokerAccountStatus
     */
    private $status;
    
    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $createdOn;
    
    

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Users\Entity\InsuranceBrokerRegistered
     */
    public function getBroker()
    {
        return $this->broker;
    }

    /**
     * @return \CsnUser\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getTransactionRef()
    {
        return $this->transactionRef;
    }

    /**
     * @return string
     */
    public function getAmountPaid()
    {
        return $this->amountPaid;
    }

    /**
     * @return \Transactions\Entity\NoBrokerAccountStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @param \CsnUser\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @param string $transactionRef
     */
    public function setTransactionRef($transactionRef)
    {
        $this->transactionRef = $transactionRef;
        return $this;
    }

    /**
     * @param string $amountPaid
     */
    public function setAmountPaid($amountPaid)
    {
        $this->amountPaid = $amountPaid;
        return $this;
    }

    /**
     * @param \Transactions\Entity\NoBrokerAccountStatus $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        return $this;
    }

}

