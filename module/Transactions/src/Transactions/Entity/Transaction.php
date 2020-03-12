<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\PaymentMode;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="Transactions\Entity\Repository\TransactionRepository")
 */
class Transaction
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
     * @var string @ORM\Column(name="transact_uid", type="string", length=225, nullable=true)
     */
    private $transactUid;

    // /**
    // *
    // * @var boolean @ORM\Column(name="is_success", type="boolean", nullable=false)
    // */
    // private $isSuccess;
    
    /**
     *
     * @var \DateTime @ORM\Column(name="payment_date", type="datetime", nullable=true)
     */
    private $paymentDate;

    /**
     *
     * @var \Transactions\Entity\Invoice @ORM\ManyToOne(targetEntity="Transactions\Entity\Invoice", inversedBy="transaction")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     *      })
     *     
     *      An invoice is generated for every transaction made on the platform
     *     
     */
    private $invoice;

    /**
     * this defines pending or finalizzed , failed etc
     *
     * @var \Transactions\Entity\TransactionStatus @ORM\ManyToOne(targetEntity="Transactions\Entity\TransactionStatus")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="transact_status_id", referencedColumnName="id")
     *      })
     *     
     */
    private $transactStatus;

    // /**
    // *
    // * @var \CsnUser\Entity\User @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
    // * @ORM\JoinColumns({
    // * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    // * })
    // */
    // private $user;
    
    /**
     *
     * @var \Settings\Entity\PaymentMode @ORM\ManyToOne(targetEntity="Settings\Entity\PaymentMode")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="payment_mode", referencedColumnName="id")
     *      })
     */
    private $paymentMode;

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
     * @ORM\OneToOne(targetEntity="Transactions\Entity\FlutterwaveResponse", mappedBy="transaction", cascade={"persist", "remove"})
     *
     * @var FlutterwaveResponse
     */
    private $flutterwave;
    
    /**
     * @ORM\OneToOne(targetEntity="Transactions\Entity\PaystackResponse", mappedBy="transaction", cascade={"persist", "remove"})
     *
     * @var PaystackResponse
     */
    private $paystack;

    /**
     * @ORM\ManyToOne(targetEntity="MicroPayment", inversedBy="transaction")
     *
     * @var MicroPayment
     */
    private $microPayment;

    public function getId()
    {
        return $this->id;
    }

    public function getTransactUid()
    {
        return $this->transactUid;
    }

    public function setTransactUid($transactUid)
    {
        $this->transactUid = $transactUid;
        return $this;
    }

    // public function getAmountPaid()
    // {
    // return $this->amountPaid;
    // }
    
    // public function setAmountPaid($amountPaid)
    // {
    // $this->amountPaid = $amountPaid;
    // return $this;
    // }
    
    // public function getIsSuccess()
    // {
    // return $this->isSuccess;
    // }
    
    // public function setIsSuccess($isSuccess)
    // {
    // $this->isSuccess = $isSuccess;
    // return $this;
    // }
    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
        return $this;
    }

    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;
        
        return $this;
    }

    public function getTransactStatus()
    {
        return $this->transactStatus;
    }

    public function setTransactStatus($status)
    {
        $this->transactStatus = $status;
        return $this;
    }

    // /**
    // * Set currency
    // *
    // * @param \Settings\Entity\Currency $currency
    // *
    // * @return CustomerTransaction
    // */
    // public function setCurrency(\Settings\Entity\Currency $currency = null)
    // {
    // $this->currency = $currency;
    
    // return $this;
    // }
    
    // /**
    // * Get currency
    // *
    // * @return \Settings\Entity\Currency
    // */
    // public function getCurrency()
    // {
    // return $this->currency;
    // }
    
    // /**
    // * Set user
    // *
    // * @param \CsnUser\Entity\User $user
    // *
    // * @return CustomerTransaction
    // */
    // public function setUser(\CsnUser\Entity\User $user = null)
    // {
    // $this->user = $user;
    
    // return $this;
    // }
    
    // /**
    // * Get user
    // *
    // * @return \CsnUser\Entity\User
    // */
    // public function getUser()
    // {
    // return $this->user;
    // }
    
    /**
     * Set paymentMode
     *
     * @param \Settings\Entity\PaymentMode $paymentMode            
     *
     * @return PaymentMode
     */
    public function setPaymentMode($paymentMode)
    {
        $this->paymentMode = $paymentMode;
        
        return $this;
    }

    /**
     * Get paymentMode
     *
     * @return \Settings\Entity\PaymentMode
     */
    public function getPaymentMode()
    {
        return $this->paymentMode;
    }

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

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }

    public function getFlutterwave()
    {
        return $this->flutterwave;
    }
    
    public function getPaystack(){
        return $this->paystack;
        
    }
    
    public function setPayStack($pay){
        $this->paystack = $pay;
        return $this;
    }

    public function setMicroPayment($micro)
    {
        $this->microPayment = $micro;
        return $this;
    }

    public function getMicroPayment()
    {
        return $this->microPayment;
    }
}

?>