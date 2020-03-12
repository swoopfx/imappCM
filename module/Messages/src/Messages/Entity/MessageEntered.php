<?php
namespace Messages\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;
use Customer\Entity\Customer;

/**
 * @ORM\Entity
 * @ORM\Table(name="message_entered")
 *
 * @author otaba
 *        
 */
class MessageEntered
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * This defines if the broker is the sender or the recipient
     * @ORM\ManyToOne(targetEntity="Messages\Entity\MessageFunction")
     *
     * @var MessageFunction
     */
    private $brokerFunction;

//     /**
//      * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
//      *
//      * @var InsuranceBrokerRegistered
//      */
//     private $broker;

    /**
     * @ORM\Column(name="message_text", type="text", nullable=true)
     *
     * @var string
     */
    private $messageText;

    /**
     * This defines if the broker is the sender or the recipient
     * @ORM\ManyToOne(targetEntity="Messages\Entity\MessageFunction")
     *
     * @var MessageFunction
     */
    private $customerFunction;

//     /**
//      * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
//      *
//      * @var Customer
//      */
//     private $customer;

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
    private $updatedOn;
    
    /**
     * @ORM\ManyToOne(targetEntity="Messages\Entity\Messages" , inversedBy="messageEntered")
     * 
     * @var Messages
     */
    private $messages;
    
    /**
     * This is either read or unread
     * @ORM\ManyToOne(targetEntity="Messages\Entity\MessageStatus")
     * @var MessageStatus
     */
    private $messageStatus;
    
    /**
     * @ORM\Column(name="is_read", type="boolean", nullable=true , options={"default" : 0})
     * @var boolean
     */
    private $isRead;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function setBrokerFunction($func)
    {
        $this->brokerFunction = $func;
        return $this;
    }

    public function getBrokerFunction()
    {
        return $this->brokerFunction;
    }

  

    public function getMessageText()
    {
        return $this->messageText;
    }

    public function setMessageText($mes)
    {
        $this->messageText = $mes;
        return $this;
    }

    public function getCustomerFunction()
    {
        return $this->customerFunction;
    }

    public function setCustomerFunction($func)
    {
        $this->customerFunction = $func;
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

    public function setCreatedOn($creat)
    {
        $this->updatedOn = $creat;
        $this->createdOn = $creat;
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }
    
    public function setMessages($mess){
        $this->messages = $mess;
        return $this;
    }
    
    public function getMessages(){
        return $this->messages;
    }
    
    public function getMessageStatus(){
        return $this->messageStatus ;
    }
    
    public function setMessageStatus($status){
        $this->messageStatus = $status;
        return $this;
    }
    /**
     * @return boolean
     */
    public function getIsRead()
    {
        return $this->isRead;
    }

    /**
     * @param \DateTime $updatedOn
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
        return $this;
    }

    /**
     * @param boolean $isRead
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;
        return $this;
    }

}

