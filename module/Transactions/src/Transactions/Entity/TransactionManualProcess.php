<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\PaymentMode;
use Settings\Entity\Currency;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="transaction_manual_process")
 *
 * @author otaba
 *        
 */
class TransactionManualProcess
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
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PaymentMode")
     *
     * @var PaymentMode
     */
    private $paymentMode;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     *
     * @var Currency
     */
    private $currency;

    /**
     * @ORM\Column(name="amount_paid", type="string", nullable=true)
     *
     * @var string
     */
    private $amountPaid;

    /**
     * @ORM\ManyToOne(targetEntity="Transactions\Entity\TransactionStatus")
     *
     * @var TransactionStatus
     */
    private $paymentStatus;

    /**
     * @ORM\OneToMany(targetEntity="Transactions\Entity\PaymentBankDeposit", mappedBy="manualProcess", cascade={"persist", "remove"})
     *
     * @var Collection
     */
    private $bankDeposit;

    /**
     * @ORM\OneToMany(targetEntity="Transactions\Entity\PaymentCash", mappedBy="manualProcess", cascade={"persist", "remove"})
     *
     * @var Collection
     */
    private $cash;

    /**
     * @ORM\OneToMany(targetEntity="PaymentTransfer", mappedBy="manualProcess", cascade={"persist", "remove"})
     *
     * @var Collection
     */
    private $bankTransfer;

    /**
     *
     * @ORM\OneToOne(targetEntity="Transactions\Entity\Invoice", inversedBy="manualProcess")
     *
     * @var Invoice
     */
    private $invoice;

    public function __construct()
    {
        $this->cash = new ArrayCollection();
        $this->bankDeposit = new ArrayCollection();
        $this->bankTransfer = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus($stat)
    {
        $this->paymentStatus = $stat;
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

    public function getAmountPaid()
    {
        return $this->amountPaid;
    }

    public function setAmountPaid($paid)
    {
        $this->amountPaid = $paid;
        return $this;
    }

    public function getPaymentMode()
    {
        return $this->paymentMode;
    }

    public function setPaymentMode($mode)
    {
        $this->paymentMode = $mode;
        return $this;
    }

    public function getBankDeposit()
    {
        return $this->bankDeposit;
    }
    
    public function addBankDeposit($bankDep){
        if(!$this->bankDeposit->contains($bankDep)){
            $bankDep->setManualProcess($this);
            $this->bankDeposit->add($bankDep);
        }
        return $this;
    }
    
    public function removeBankDeposit($bankDeposit){
        if($this->bankDeposit->contains($bankDeposit)){
            $this->bankDeposit->add($bankDeposit);
        }
        return $this;
    }

    public function getCash()
    {
        return $this->cash;
    }

    public function addCash(PaymentCash $cash){
        if(!$this->cash->contains($cash)){
            $cash->setManualProcess($this);
            $this->cash->add($cash);
        }
        return $this;
    }
    
    public function removeCash($cash){
        if($this->cash->contains($cash)){
            $this->cash->removeElement($cash);
            
        }
        return $this;
    }

    public function getBankTransfer()
    {
        return $this->bankTransfer;
    }
    
    public function addBankTransfer(PaymentTransfer $bankTransfer){
        if (!$this->bankTransfer->contains($bankTransfer)){
            $bankTransfer->setManualProcess($this);
            $this->bankTransfer->removeElement($bankTransfer);
        }
        
        return $this;
    }
    
    public function removeBankTransfer(PaymentTransfer $transfer){
        if($this->bankTransfer->contains($transfer)){
            $this->bankTransfer->removeElement($transfer);
        }
        return $this;
    }

    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setInvoice($inv)
    {
        $this->invoice = $inv;
        return $this;
    }
}

