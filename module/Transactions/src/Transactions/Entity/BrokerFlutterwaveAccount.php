<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;

/**
 * @ORM\Entity
 * @ORM\Table(name="broker_flutterwave_account")
 * This is used to store the variables for processing flutterwave account
 * @author swoopfx
 *        
 */
class BrokerFlutterwaveAccount
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="merchant_id", type="string", nullable=false)
     * 
     * @var string
     */
    private $merchantId;

    /**
     * @ORM\Column(name="encrypt_key", type="string", nullable=false)
     * 
     * @var string
     */
    private $encryptKey;

    /**
     * @ORM\OneToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered", inversedBy="brokerFlutterwaveAccount")
     * @ORM\JoinColumn(name="broker", referencedColumnName="id")
     * 
     * @var InsuranceBrokerRegistered
     */
    private $broker;
    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     * @var \DateTime
     */
    private $createdOn;
    
    
    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=false)
     * @var \DateTime
     */
    private $updateOn;
    
   

    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMerchatId()
    {
        return $this->merchantId;
    }

    public function setMerchantId($id)
    {
        $this->merchantId = $id;
        return $this;
    }

    public function getEncryptKey()
    {
        return $this->encryptKey;
    }

    public function setEncryptKey($key)
    {
        $this->encryptKey = $key;
        return $this;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setBroker($bro)
    {
        $this->broker = $bro;
        return $this;
    }
    
    public function setCreateOn($dater){
        $this->createdOn = $dater;
        $this->updateOn = $dater;
        return $this;
    }
    
    public function getCreatedOn(){
        return $this->createdOn;
    }
    
    public function getUpdateOn(){
        return $this->updateOn;
    }
    
    public function setUpdatedOn($date){
        $this->updateOn = $date;
        return $this;
    }
}

