<?php
namespace Transactions\Entity;


use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;

/**
 * @ORM\Entity
 * @ORM\Table(name="broker_pay_stack_account")
 * @author otaba
 *        
 */
class BrokerPayStackAccount
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     * @ORM\Column(name="sub_account", type="string", nullable=false)
     * @var string
     */
    private $subAccount;
    
    /**
     * @ORM\Column(name="integration", type="string", nullable=false)
     * @var string
     */
    private $integration;
    /**
     * @ORM\OneToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered", inversedBy="brokerPayStackAccount")
     * @var InsuranceBrokerRegistered
     */
    private $broker;
    
    
    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * @var string
     */
    private $createdOn;
    
    
    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     * @var string
     */
    private $updatedOn;
    
    /**
     */
    public function __construct()
    {
        
        
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getSubAccount(){
        return $this->subAccount;
    }
    
    
    public function setSubAccount($acc){
        $this->subAccount = $acc;
        return $this;
    }
    
    public function getIntegration(){
        return $this->integration;
    }
    
    public function setIntegration($int){
        $this->integration = $int;
        return $this;
    }
    
    public function getBroker(){
        return $this->broker;
    }
    
    public function setBroker($brk){
        $this->broker = $brk;
        return $this;
    }
    
    public function getCreatedOn(){
        return $this->createdOn;
    }
    
    public function setCreatedOn($date){
        $this->createdOn = $date;
        $this->updatedOn = $date;
        return $this;
    }
    
    public function getUpdatedOn(){
        return $this->updatedOn;
    }
    
    public function setUpdatedOn($date){
        $this->updatedOn = $date;
        return $this;
    }
}

