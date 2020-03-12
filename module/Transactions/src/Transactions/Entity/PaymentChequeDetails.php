<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentChequeDetails
 *
 * @ORM\Table(name="payment_cheque_details", indexes={@ORM\Index(name="FK_cheque_payment_transaction_idx", columns={"transaction_id"})})
 * @ORM\Entity
 */
class PaymentChequeDetails
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
     * @var string @ORM\Column(name="cheque_name", type="string", length=45, nullable=false)
     */
    private $chequeName;

    /**
     *
     * @var string @ORM\Column(name="cheque_number", type="string", length=45, nullable=true)
     */
    private $chequeNumber;

    /**
     *
     * @var integer @ORM\Column(name="cheque_bank", type="integer", nullable=true)
     */
    private $chequeBank;

    /**
     *
     * @var integer @ORM\Column(name="cheque_date", type="integer", nullable=true)
     */
    private $chequeDate;

    /**
     *
     * @var unknown
     */
    private $createdOn;

    /**
     *
     * @var integer @ORM\Column(name="updated_on", type="integer", nullable=true)
     */
    private $updatedOn;

    /**
     *
     * @var \Transactions\Entity\Transaction @ORM\ManyToOne(targetEntity="Transactions\Entity\Transaction")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="transaction_id", referencedColumnName="id")
     *      })
     */
    private $transaction;

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
     * Set chequeName
     *
     * @param string $chequeName            
     *
     * @return PaymentChequeDetails
     */
    public function setChequeName($chequeName)
    {
        $this->chequeName = $chequeName;
        
        return $this;
    }

    /**
     * Get chequeName
     *
     * @return string
     */
    public function getChequeName()
    {
        return $this->chequeName;
    }

    /**
     * Set chequeNumber
     *
     * @param string $chequeNumber            
     *
     * @return PaymentChequeDetails
     */
    public function setChequeNumber($chequeNumber)
    {
        $this->chequeNumber = $chequeNumber;
        
        return $this;
    }

    /**
     * Get chequeNumber
     *
     * @return string
     */
    public function getChequeNumber()
    {
        return $this->chequeNumber;
    }

    /**
     * Set chequeBank
     *
     * @param integer $chequeBank            
     *
     * @return PaymentChequeDetails
     */
    public function setChequeBank($chequeBank)
    {
        $this->chequeBank = $chequeBank;
        
        return $this;
    }

    /**
     * Get chequeBank
     *
     * @return integer
     */
    public function getChequeBank()
    {
        return $this->chequeBank;
    }

    /**
     * Set chequeDate
     *
     * @param integer $chequeDate            
     *
     * @return PaymentChequeDetails
     */
    public function setChequeDate($chequeDate)
    {
        $this->chequeDate = $chequeDate;
        
        return $this;
    }

    /**
     * Get chequeDate
     *
     * @return integer
     */
    public function getChequeDate()
    {
        return $this->chequeDate;
    }

    /**
     * Set dateCleared
     *
     * @param \DateTime $dateCleared            
     *
     * @return PaymentChequeDetails
     */
    public function setDateCleared($dateCleared)
    {
        $this->dateCleared = $dateCleared;
        
        return $this;
    }

    /**
     * Get dateCleared
     *
     * @return \DateTime
     */
    public function getDateCleared()
    {
        return $this->dateCleared;
    }

    /**
     * Set dateCollected
     *
     * @param \DateTime $dateCollected            
     *
     * @return PaymentChequeDetails
     */
    public function setDateCollected($dateCollected)
    {
        $this->dateCollected = $dateCollected;
        
        return $this;
    }

    /**
     * Get dateCollected
     *
     * @return \DateTime
     */
    public function getDateCollected()
    {
        return $this->dateCollected;
    }

    /**
     * Set updatedOn
     *
     * @param integer $updatedOn            
     *
     * @return PaymentChequeDetails
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
        
        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return integer
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set transaction
     *
     * @param \All\Entity\CustomerTransaction $transaction            
     *
     * @return PaymentChequeDetails
     */
    public function setTransaction(\All\Entity\CustomerTransaction $transaction = null)
    {
        $this->transaction = $transaction;
        
        return $this;
    }

    /**
     * Get transaction
     *
     * @return \All\Entity\CustomerTransaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}
