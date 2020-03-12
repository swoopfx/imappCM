<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\ManualPaymentMode;
use Settings\Entity\Currency;
use CsnUser\Entity\User;

/**
 * This class defines the entity for manual payment by customer
 * But entered by the broker or child broker
 *
 * @ORM\Entity
 * @ORM\Table(name="manual_payment")
 * 
 * @author otaba
 *        
 */
class ManualPayment
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
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     * 
     * @var User
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Invoice")
     * @var Invoice
     */
    private $invoice;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\ManualPaymentMode")
     * 
     * @var ManualPaymentMode
     */
    private $paymentMode;

    /**
     * @ORM\Column(name="amount_paid", type="string", nullable=true)
     * 
     * @var string
     */
    private $amountPaid;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     * 
     * @var Currency
     */
    private $currency;

    /**
     * @ORM\Column(name="date_paid", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $datePaid;
    
    /**
     * @ORM\Column(name="check_number", type="string", nullable=true)
     * @var string
     */
    private $checkNumber;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $createdOn;

    /**
     */
    public function __construct()
    {
        
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }
    

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    
    public function getInvoice(){
        return $this->invoice;
    }
    
    public function setInvoice($inv){
        $this->invoice = $inv;
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

    public function getDatePaid()
    {
        return $this->datePaid;
    }

    public function setDatePaid($date)
    {
        $this->datePaid = $date;
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

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($cur)
    {
        $this->currency = $cur;
        return $this;
    }
    
    public function setCheckNumber($num){
        $this->checkNumber = $num;
        return $this;
    }
    
    public function getCheckNumber(){
        return $this->checkNumber;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        return $this;
    }
}

