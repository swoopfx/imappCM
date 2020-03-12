<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="payment_cash")
 * 
 * @author otaba
 *        
 */
class PaymentCash
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
     * @ORM\Column(name="collected_by", type="string", nullable=true)
     * 
     * @var string
     */
    private $collectedBy;
    
    /**
     * @ORM\Column(name="amount_paid", type="string", nullable=true)
     *
     * @var string
     */
    private $amountPaid;

    /**
     * @ORM\Column(name="date_collected", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $datePaid;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $createdOn;
    
    /**
     * @ORM\ManyToOne(targetEntity="TransactionManualProcess", inversedBy="cash")
     * @var TransactionManualProcess
     */
    private $manualProcess;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getCollectedBy()
    {
        return $this->collectedBy;
    }

    public function setCollectedBy($da)
    {
        $this->collectedBy = $da;
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

    public function getDatePaid()
    {
        return $this->datePaid;
    }

    public function setDatePaid($date)
    {
        $this->datePaid = $date;
        return $this;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }
    
    public function getManualProcess(){
        return $this->manualProcess;
    }
    
    public function setManualProcess($cash){
        $this->manualProcess = $cash;
        return $this;
    }
}

