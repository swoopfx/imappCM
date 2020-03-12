<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\NigeriaBanks;

/**
 * BrokerBankAccount
 *
 * @ORM\Table(name="broker_bank_account")
 * @ORM\Entity
 */
class BrokerBankAccount
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
     * @var NigeriaBanks @ORM\ManyToOne(targetEntity="Settings\Entity\NigeriaBanks")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="nigeria_banks", referencedColumnName="id")
     *      })
     */
    private $bankName;

    /**
     *
     * @var string @ORM\Column(name="account_name", type="string", length=200, nullable=true)
     */
    private $accountName;

    /**
     *
     * @var integer @ORM\Column(name="bank_account_no", type="string", nullable=false)
     */
    private $bankAccountNo;

    /**
     *
     * @var string @ORM\Column(name="swift_code", type="string", length=45, nullable=true)
     */
    private $swiftCode;

    /**
     *
     * @var string @ORM\Column(name="sort_code", type="string", length=45, nullable=true)
     */
    private $sortCode;

    /**
     *
     * @var string @ORM\Column(name="bank_address", type="text", length=45, nullable=true)
     */
    private $bankAddress;

//     /**
//      *
//      * @var \Users\Entity\InsuranceBrokerRegistered 
//      * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered", inversedBy="brokerBankAccount")
//      *      @ORM\JoinColumns({
//      *      @ORM\JoinColumn(name="broker_id", referencedColumnName="id")
//      *      })
//      *     
//      *      This is a one to one bidirectional mapping of registered broker to the account
//      */
//     private $broker;

    /**
     * @ORM\ManyToOne(targetEntity="InsuranceBrokerRegistered")
     * @var InsuranceBrokerRegistered
     */
    private $broker;

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
     * @return \Users\Entity\InsuranceBrokerRegistered
     */
    public function getBroker()
    {
        return $this->broker;
    }

    /**
     * @param \Users\Entity\InsuranceBrokerRegistered $broker
     */
    public function setBroker($broker)
    {
        $this->broker = $broker;
        return $this;
    }

    //     /**
//      * @ORM\OneToOne(targetEntity="Users\Entity\BrokerDefaultAccount", mappedBy="brokerBankAccount" , cascade={"persist", "remove"})
//      * @var BrokerDefaultAccount
//      */
//     private $defaultBankAccount;

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
     * Set bankName
     *
     * @param string $bankName            
     *
     * @return BrokerBankAccount
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
        
        return $this;
    }

    /**
     * Get bankName
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * Set accountName
     *
     * @param string $accountName            
     *
     * @return BrokerBankAccount
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;
        
        return $this;
    }

    /**
     * Get accountName
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * Set bankAccountNo
     *
     * @param integer $bankAccountNo            
     *
     * @return BrokerBankAccount
     */
    public function setBankAccountNo($bankAccountNo)
    {
        $this->bankAccountNo = $bankAccountNo;
        
        return $this;
    }

    /**
     * Get bankAccountNo
     *
     * @return integer
     */
    public function getBankAccountNo()
    {
        return $this->bankAccountNo;
    }

    /**
     * Set swiftCode
     *
     * @param string $swiftCode            
     *
     * @return BrokerBankAccount
     */
    public function setSwiftCode($swiftCode)
    {
        $this->swiftCode = $swiftCode;
        
        return $this;
    }

    /**
     * Get swiftCode
     *
     * @return string
     */
    public function getSwiftCode()
    {
        return $this->swiftCode;
    }

    /**
     * Set sortCode
     *
     * @param string $sortCode            
     *
     * @return BrokerBankAccount
     */
    public function setSortCode($sortCode)
    {
        $this->sortCode = $sortCode;
        
        return $this;
    }

    /**
     * Get sortCode
     *
     * @return string
     */
    public function getSortCode()
    {
        return $this->sortCode;
    }

    /**
     * Set bankAddress
     *
     * @param string $bankAddress            
     *
     * @return BrokerBankAccount
     */
    public function setBankAddress($bankAddress)
    {
        $this->bankAddress = $bankAddress;
        
        return $this;
    }

    /**
     * Get bankAddress
     *
     * @return string
     */
    public function getBankAddress()
    {
        return $this->bankAddress;
    }

    /**
     * Set paymentmode
     *
     * @param integer $paymentmode            
     *
     * @return BrokerBankAccount
     */
    public function setPaymentmode($paymentmode)
    {
        $this->paymentmode = $paymentmode;
        
        return $this;
    }

    /**
     * Get paymentmode
     *
     * @return integer
     */
    public function getPaymentmode()
    {
        return $this->paymentmode;
    }

//     /**
//      * Set broker
//      *
//      * @param \Users\Entity\InsuranceBrokerRegistered $broker            
//      *
//      * @return BrokerBankAccount
//      */
//     public function setBroker(\Users\Entity\InsuranceBrokerRegistered $broker = null)
//     {
//         $this->broker = $broker;
        
//         return $this;
//     }

//     /**
//      * Get broker
//      *
//      * @return \Users\Entity\InsuranceBrokerRegistered
//      */
//     public function getBroker()
//     {
//         return $this->broker;
//     }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($created)
    {
        $this->createdOn = $created;
        $this->updatedOn = $created;
        
        return $this;
    }
    
    public function setUpdatedOn($date){
        $this->updatedOn = $date ;
        return $this;
    }
    
    public function getUpdatedOn(){
        return $this->updatedOn;
    }
    
    public function getDefaultBankAccunt(){
        return $this->defaultBankAccount;
    }
}
