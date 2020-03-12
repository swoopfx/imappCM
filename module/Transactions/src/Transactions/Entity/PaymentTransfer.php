<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="payment_transfer")
 *
 * @author otaba
 *        
 */
class PaymentTransfer
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
     * @ORM\ManyToOne(targetEntity="Settings\Entity\NigeriaBanks")
     *
     * @var NigeriaBanks
     */
    private $bank;
    
    /**
     * @ORM\Column(name="amount_paid", type="string", nullable=true)
     *
     * @var string
     */
    private $amountPaid;

    /**
     * @ORM\Column(name="trasfer_from", type="string", nullable=true)
     *
     * @var string
     */
    private $transferFrom;

    /**
     * @ORM\Column(name="trasfer_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $transferDate;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @ORM\ManyToOne(targetEntity="TransactionManualProcess", inversedBy="bankTransfer")
     * 
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

    public function getBank()
    {
        return $this->bank;
    }

    public function setBank($bk)
    {
        $this->bank = $bk;
        return $this;
    }
    
    public function getAmountPaid()
    {
        return $this->amountPaid;
    }
    
    public function setAmountPaid($pay)
    {
        $this->amountPaid = $pay;
        return $this;
    }

    public function getTransferFrom()
    {
        return $this->transferFrom;
    }

    public function setTransferFrom($trans)
    {
        $this->transferFrom = $trans;
        return $this;
    }

    public function getTransferDate()
    {
        return $this->transferDate;
    }

    public function setTransferDate($date)
    {
        $this->transferDate = $date;
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

    public function getManualProcess()
    {
        return $this->manualProcess;
    }

    public function setManualProcess($man)
    {
        $this->manualProcess = $man;
        return $this;
    }
}

