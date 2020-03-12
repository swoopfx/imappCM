<?php
namespace  Customer\Entity;


 use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;
 
 /**
  * @ORM\Entity
  * @ORM\Table(name="customer_messages")
  * @author otaba
  *
  */
class CustomerMessages {
	
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="message_name", type="string", nullable=false)
	 * @var string
	 */
    private $messageName;
    
    /**
     * @ORM\Column(name="content", type="text", nullable=false)
     * @var Text
     */
    private $content;
    
    /**
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     * @var InsuranceBrokerRegistered
     */
    private $broker;
    
    /**
     * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
     * @var Customer
     */
    private $customer;
    
    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * @var datetime
     */
    private $createdOn;
    
    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     * @var datetime
     */
    private $updatedOn;
    /**
     * @ORM\Column(name="is_read", type="boolean", nullable=false, options={"default":false})
     * @var boolean
     */
    private $isRead;
    
    public function getId(){
    	return $this->id;
    }
    
    public function getMessageName(){
    	return $this->messageName;
    }
    
    public function setMessageName($name){
    	$this->messageName = $name;
    	return $this;
    }
    
    public function getContent(){
    	return $this->content;
    }
    
    public function setContent ($content){
    	$this->content = $content;
    	return $this;
    }
    
    public function getBroker(){
    	return $this->broker;
    }
    
    public function setBroker($brk){
    	$this->broker = $brk;
    	return $this;
    }
    
    public function setCustomer($cus){
    	$this->customer = $cus;
    	return $this;
    }
    
    public function getCustomer(){
    	return $this->customer;
    }
    
    public function getCreatedOn(){
    	return $this->createdOn;
    }
    
    public function setCreatedOn($date){
    	$this->createdOn = $date;
    	$this->updatedOn = $date;
    	return $this ;
    }
    
    public function getUpdated(){
    	return $this->updatedOn;
    	
    }
    
    public function setUpdated($upd){
    	$this->updatedOn = $upd;
    	return $this;
    }
    
    public function xgetIsRead(){
    	return $this->isRead;
    }
    
    public function setIsRead($read){
    	$this->isRead = $read;
    	return $this;
    }
}