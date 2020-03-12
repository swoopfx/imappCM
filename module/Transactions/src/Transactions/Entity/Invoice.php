<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Customer\Entity\Customer;
use Policy\Entity\CoverNote;
use Packages\Entity\Packages;
use Offer\Entity\Offer;
use Proposal\Entity\Proposal;
use Customer\Entity\CustomerPackage;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Policy\Entity\PolicyFloat;
use CsnUser\Entity\User;
use Users\Entity\InsuranceBrokerRegistered;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="Transactions\Entity\Repository\InvoiceRepository")
 */
class Invoice
{

    /**
     *
     * @var integer This is only genertated upon successful transaction
     *      @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    // /**
    // *
    // * @var string @ORM\Column(name="being_for", type="string", length=45, nullable=true)
    // */
    // private $beingFor;
    
    /**
     * The customer entity involved in the transaction
     * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
     * @ORM\JoinColumn(name="customer", referencedColumnName="id")
     * 
     * @var Customer
     */
    private $customer;

    /**
     * The date the invoice eas generated
     * @var \DateTime @ORM\Column(name="generated_on", type="datetime", nullable=true)
     */
    private $generatedOn;

    /**
     * The amount meant to be transacted
     * @var string @ORM\Column(name="amount", type="string")
     */
    private $amount;

    /**
     * The category of the invoice , be it SMS Paymen, subscription etc 
     * @ORM\ManyToOne(targetEntity="Transactions\Entity\InvoiceCategory")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="invoice_category", referencedColumnName="id")
     * })
     *
     * @var InvoiceCategory
     */
    private $invoiceCategory;

    /**
     * The related transaction or reciept on successful payment or unsccessful Payment
     * @var Collection @ORM\OneToMany(targetEntity="Transactions\Entity\Transaction", mappedBy="invoice", cascade={"persist", "remove"})
     */
    private $transaction;

    /**
     * 
     * @var string @ORM\Column(name="invoice_uid", type="string", nullable=false)
     */
    private $invoiceUid;

    /**
     * setteled or unsettled
     *
     * @var \Transactions\Entity\InvoiceStatus @ORM\ManyToOne(targetEntity="Transactions\Entity\InvoiceStatus")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     *      })
     */
    private $status;

    /**
     *
     * @var \Settings\Entity\Currency @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     *      })
     *     
     *     
     *     
     */
    private $currency;

    /**
     *
     * @var \DateTime @ORM\Column(name="modified_on", type="datetime", nullable=true)
     */
    private $modifiedOn;

    // private $active; //
    
    // /**
    // *
    // * @var InvoiceEntity @ORM\ManyToOne(targetEntity="Transactions\Entity\InvoiceEntity")
    // * @ORM\JoinColumns({
    // * @ORM\JoinColumn(name="invoice_entity", referencedColumnName="id")
    // * })
    // */
    // private $invoiceEntity;
    
    /**
     * This defines it the invoice is still valid /open for payment if
     * Invoice is Closed there will be no link to payout
     *
     * @var boolean @ORM\Column(name="is_open", type="boolean", nullable=true, options={"default":true})
     */
    private $isOpen = true;

    // /**
    // * @ORM\OneToOne(targetEntity="Transactions\Entity\BrokerCustomerInvoice", mappedBy="invoice", cascade={"persist", "remove"})
    // *
    // * @var BrokerCustomerInvoice
    // */
    // private $brokerCustomerInvoice;
    
    /**
     * This is conditionally noit useful as the customer has been assigned a broker \
     * And the broker can be refrenced from the customer
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     * @ORM\JoinColumn(name="broker", referencedColumnName="id")
     *
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    // /**
    // * @ORM\OneToOne(targetEntity="Transactions\Entity\Invoice", mappedBy="invoice" , cascade={"persist", "remove"})
    // *
    // * @var User
    // */
    // private $invoiceUser;
    
    // /**
    // *
    // * @var @ORM\OneToOne(targetEntity="Policy\Entity\Policy", mappedBy="invoice", cascade={"persist", "remove"} )
    // */
    // private $policy;
    
    /**
     * @ORM\Column(name="expiry_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $expiryDate;

    // /**
    // * @ORM\OneToOne(targetEntity="Transactions\Entity\ProposalInvoice", mappedBy="invoice", cascade={"persist", "remove"})
    // * @var unknown
    // */
    // private $proposalInvoice;
    
    /**
     * @ORM\OneToOne(targetEntity="Transactions\Entity\InvoiceUser", mappedBy="invoice", cascade={"persist", "remove"})
     * 
     * @var InvoiceUser
     */
    private $invoiceUser;
    
    /**
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     * @var User
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Policy\Entity\CoverNote", inversedBy="invoice")
     * @ORM\JoinColumn(name="cover_note", referencedColumnName="id")
     * 
     * @var CoverNote
     */
    private $coverNote;

    /**
     * @ORM\OneToOne(targetEntity="Customer\Entity\CustomerPackage", inversedBy="invoice")
     * @ORM\JoinColumn(name="packages", referencedColumnName="id")
     * 
     * @var CustomerPackage
     */
    private $packages;

    /**
     * @ORM\OneToOne(targetEntity="Offer\Entity\Offer", inversedBy="invoice")
     * @ORM\JoinColumn(name="offer", referencedColumnName="id")
     * 
     * @var Offer
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity="Proposal\Entity\Proposal", inversedBy="invoice")
     * @ORM\JoinColumn(name="proposal", referencedColumnName="id")
     * 
     * @var Proposal
     */
    private $proposal;
    
    /**
     * @ORM\OneToOne(targetEntity="Policy\Entity\PolicyFloat", mappedBy="invoice")
     * @ORM\JoinColumn(name="policy_float", referencedColumnName="id")
     * @var PolicyFloat
     */
    private $policyFloat;

    /**
     * @ORM\OneToOne(targetEntity="Transactions\Entity\TransactionManualProcess", mappedBy="invoice")
     * 
     * @var TransactionManualProcess
     */
    private $manualProcess;
    
    
    /**
     * @ORM\Column(name="is_micro", type="boolean", nullable=true, options={"default":"0"})
     * @var boolean
     */
    private $isMicro;
    
//     /**
//      * @ORM\OneToMany(targetEntity="Transactions\Entity\MicroPayment", mappedBy="invoice", cascade={"all"})
//      * @var Collection
//      */
//     private $microPayment;

    public function __construct()
    {
        $this->microPayment = new ArrayCollection();
    }

    /**
     * Set beingFor
     *
     * @param string $beingFor            
     *
     * @return Invoice
     */
    public function setBeingFor($beingFor)
    {
        $this->beingFor = $beingFor;
        
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

    /**
     * Get beingFor
     *
     * @return string
     */
    public function getBeingFor()
    {
        return $this->beingFor;
    }

    /**
     * Set generatedOn
     *
     * @param \DateTime $generatedOn            
     *
     * @return Invoice
     */
    public function setGeneratedOn($generatedOn)
    {
        $this->generatedOn = $generatedOn;
        $this->modifiedOn = $generatedOn;
        $this->expiryDate = $generatedOn;
        
        return $this;
    }

    /**
     * Get generatedOn
     *
     * @return \DateTime
     */
    public function getGeneratedOn()
    {
        return $this->generatedOn;
    }

    // /**
    // * Set userId
    // *
    // * @param integer $userId
    // *
    // * @return Invoice
    // */
    // public function setUserId($userId)
    // {
    // $this->userId = $userId;
    
    // return $this;
    // }
    
    // /**
    // * Get userId
    // *
    // * @return integer
    // */
    // public function getUserId()
    // {
    // return $this->userId;
    // }
    
    /**
     * Set amountPayed
     *
     * @param string $amountPayed            
     *
     * @return Invoice
     */
    public function setAmount($amountPayed)
    {
        $this->amount = $amountPayed;
        
        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set amountDue
     *
     * @param string $amountDue            
     *
     * @return Invoice
     */
    public function setAmountDue($amountDue)
    {
        $this->amountDue = $amountDue;
        
        return $this;
    }

    /**
     * Get amountDue
     *
     * @return string
     */
    public function getAmountDue()
    {
        return $this->amountDue;
    }

    /**
     * Set balance
     *
     * @param string $balance            
     *
     * @return Invoice
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
        
        return $this;
    }

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    // /**
    // * Set transaction
    // *
    // * @param \All\Entity\CustomerTransaction $transaction
    // *
    // * @return Invoice
    // */
    // public function setTransaction($transaction)
    // {
    // $this->transaction = $transaction;
    
    // return $this;
    // }
    public function addTransaction(Transaction $trans)
    {
        if (! $this->transaction->contains($trans)) {
            $this->transaction->add($trans);
        }
        
        return $this;
    }

    public function removeTransaction(Transaction $trans)
    {
        if ($this->transaction->contains($trans)) {
            $this->transaction->removeElement($trans);
        }
        return $this;
    }

    /**
     * Get transaction
     *
     * @return \Transactions\Entity\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     *
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param InvoiceStatus $status            
     *
     * @return Invoice
     */
    public function setStatus(InvoiceStatus $status = null)
    {
        $this->status = $status;
        
        return $this;
    }

    /**
     * @return object $user
     */
    public function getUser()
    {
        return $this->user;
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
     * Get status
     *
     * @return InvoiceStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     *
     * @param Invoice $uid            
     */
    public function setInvoiceUid($uid)
    {
        $this->invoiceUid = $uid;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getInvoiceUid()
    {
        return $this->invoiceUid;
    }

    /**
     *
     * @return \Transactions\Entity\InvoiceCategory
     */
    public function getInvoiceCategory()
    {
        return $this->invoiceCategory;
    }

    /**
     *
     * @param \Transactions\Entity\InvoiceCategory $cat            
     * @return \Transactions\Entity\Invoice
     */
    public function setInvoiceCategory($cat)
    {
        $this->invoiceCategory = $cat;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($cur)
    {
        $this->currency = $cur;
        
        return $this;
    }

    public function getModifiedOn()
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn($mod)
    {
        $this->modifiedOn = $mod;
        return $this;
    }

    public function getIsOpen()
    {
        return $this->isOpen;
    }

    public function setIsOpen($bool)
    {
        $this->isOpen = $bool;
        return $this;
    }

    public function setBroker($brk)
    {
        $this->broker = $brk;
        return $this;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function getBrokerCustomerInvoice()
    {
        return $this->brokerCustomerInvoice;
    }

    public function setBrokerCustomerInvoice($bci)
    {
        $this->brokerCustomerInvoice = $bci;
        return $this;
    }

    public function getInvoiceUser()
    {
        return $this->invoiceUser;
    }

    public function setExpiryDate($date)
    {
        $this->expiryDate = $date;
        return $this;
    }

    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    public function getCoverNote()
    {
        return $this->coverNote;
    }

    public function setCoverNote($note)
    {
        $this->coverNote = $note;
        return $this;
    }

    public function getOffer()
    {
        return $this->offer;
    }

    public function setOffer($off)
    {
        $this->offer = $off;
        return $this;
    }
    
    public function getPolicyFloat(){
        return $this->policyFloat;
    }
    
    public function setPolicyFloat($float){
        $this->policyFloat = $float;
        return $this;
    }

    public function getProposal()
    {
        return $this->proposal;
    }

    public function setProposal($prop)
    {
        $this->proposal = $prop;
        return $this;
    }

    public function setPackages($pac)
    {
        $this->packages = $pac;
        return $this;
    }

    public function getPackages()
    {
        return $this->packages;
    }

    public function getManualProcess()
    {
        return $this->manualProcess;
    }
    
    public function setIsMicro($micro){
        $this->isMicro = $micro;
        return $this;
    }
    
    public function getIsMicro(){
        return $this->isMicro;
    }
    
    public function getMicroPayment(){
        return $this->microPayment;
    }
    /**
     * 
     * @param MicroPayment $micro
     * @return \Transactions\Entity\Invoice
     */
   public function addMicroPayment($micro){
       if(!$this->microPayment->contains($micro)){
           $this->microPayment->add($micro);
           $micro->setInvoice($this);
       }
       return $this;
   }
   
   public function removeMicroPayment($micro){
       if($this->microPayment->contains($micro)){
           $this->microPayment->removeElement($micro);
       }
       
       return $this;
   }
    
    // , indexes={@ORM\Index(name="FK_invoice_transaction_id_idx", columns={"transaction_id"}), @ORM\Index(name="FK_invoice_invoice_status_idx", columns={"status_id"})}
}
