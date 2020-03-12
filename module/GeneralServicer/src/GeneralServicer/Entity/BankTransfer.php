<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BankTransfer
 *
 * @ORM\Table(name="bank_transfer", indexes={@ORM\Index(name="FKbank_transfer_bank_idx", columns={"bank_id"}), @ORM\Index(name="FK_bank_transfer_transaction_id_idx", columns={"transaction_id"})})
 * @ORM\Entity
 */
class BankTransfer
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
     * @var string @ORM\Column(name="amount", type="decimal", precision=16, scale=2, nullable=true)
     */
    private $amount;

    /**
     *
     * @var \DateTime @ORM\Column(name="transfer_date", type="datetime", nullable=true)
     */
    private $transferDate;

    /**
     *
     * @var \GeneralServicer\Entity\BankTransferStatus @ORM\ManyToOne(targetEntity="GeneralServicer\Entity\BankTransferStatus")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     *      })
     */
    private $status;

    /**
     *
     * @var \Settings\Entity\NigeriaBanks @ORM\ManyToOne(targetEntity="Settings\Entity\NigeriaBanks")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="bank_id", referencedColumnName="id")
     *      })
     */
    private $bank;

    /**
     *
     * @var \Transactions\Entity\Transaction @ORM\ManyToOne(targetEntity="Transactions\Entity\Transaction")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="transaction_id", referencedColumnName="id")
     *      })
     */
    private $transaction;

    /**
     *
     * @var \DateTime @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $createdOn;

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
     * Set amount
     *
     * @param string $amount            
     *
     * @return BankTransfer
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        
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
     * Set transferDate
     *
     * @param \DateTime $transferDate            
     *
     * @return BankTransfer
     */
    public function setTransferDate($transferDate)
    {
        $this->transferDate = $transferDate;
        
        return $this;
    }

    /**
     * Get transferDate
     *
     * @return \DateTime
     */
    public function getTransferDate()
    {
        return $this->transferDate;
    }

    /**
     * Set status
     *
     * @param string $status            
     *
     * @return BankTransfer
     */
    public function setStatus($status)
    {
        $this->status = $status;
        
        return $this;
    }

    /**
     * Get status
     *
     * @return GeneralServicer\Entity\BankTransferStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set bank
     *
     * @param \Settings\Entity\NigeriaBanks $bank            
     *
     * @return BankTransfer
     */
    public function setBank(\Settings\Entity\NigeriaBanks $bank = null)
    {
        $this->bank = $bank;
        
        return $this;
    }

    /**
     * Get bank
     *
     * @return \Settings\Entity\NigeriaBanks
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Set transaction
     *
     * @param \Transactions\Entity\Transaction $transaction            
     *
     * @return BankTransfer
     */
    public function setTransaction(\Transactions\Entity\Transaction $transaction = null)
    {
        $this->transaction = $transaction;
        
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
}
