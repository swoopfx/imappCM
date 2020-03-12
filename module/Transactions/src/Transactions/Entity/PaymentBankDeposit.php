<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\NigeriaBanks;

/**
 * @ORM\Entity
 * @ORM\Table(name="payment_bank_deposit")
 *
 * @author otaba
 *        
 */
class PaymentBankDeposit
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
     * @ORM\Column(name="deposit_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $depositDate;

    /**
     * @ORM\Column(name="depositor_name", type="string", nullable=true)
     *
     * @var string
     */
    private $depositorName;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var datetime
     */
    private $createdOn;

    /**
     * @ORM\OneToOne(targetEntity="TransactionManualProcess", inversedBy="bankDeposit")
     *
     * @var TransactionManualProcess
     */
    private $manualProcess;

   

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

    public function setBank($bank)
    {
        $this->bank = $bank;
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

    public function getDepositDate()
    {
        return $this->depositDate;
    }

    public function setDepositDate($date)
    {
        $this->depositDate = $date;
        return $this;
    }

    public function getDepositorName()
    {
        return $this->depositorName;
    }

    public function setDepositorName($name)
    {
        $this->depositorName = $name;
        return $this;
    }

    public function getCreatedOn($date)
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        return $this;
    }

    public function getManualProcess()
    {
        return $this->manualProcess;
    }

    public function setManualProcess($inv)
    {
        $this->manualProcess = $inv;
        return $this;
    }

   
}

