<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Receipt
 *
 * @ORM\Table(name="receipt")
 * @ORM\Entity
 */
class Receipt
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
     *
     * @var string @ORM\Column(name="reciept_number", type="string", length=45, nullable=true)
     */
    private $receipNumber;

    /**
     *
     * @var \Transactions\Entity\Transaction @ORM\OneToOne(targetEntity="Transactions\Entity\Transaction")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="transaction_id", referencedColumnName="id")
     *      })
     *      This is a one to one unidirectional mapping from transaction to receipt
     */
    private $transaction;

    /**
     * This is the equivalence of a double
     *
     * @var string @ORM\Column(name="amount_payed", type="string", nullable=false)
     */
    private $amountPayed;

    /**
     *
     * @var \DateTime @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $createdOn;
    // TODO - create the setter and getter for this property
    
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
     * Set receiptNumber
     *
     * @param string $number            
     *
     * @return Receipt
     */
    public function setReceiptNumber($number)
    {
        $this->receipNumber = $number;
        
        return $this;
    }

    /**
     * Get receipNumber
     *
     * @return string
     */
    public function getReceiptNumber()
    {
        return $this->receipNumber;
    }

    /**
     *
     * @return \Transactions\Entity\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     *
     * @param Transaction $isact            
     * @return \Transactions\Entity\Receipt
     */
    public function setTransaction(Transaction $isact)
    {
        $this->transaction = $isact;
        
        return $this;
    }

    /**
     * string
     */
    public function getAmountPayed()
    {
        return $this->amountPayed;
    }

    /**
     *
     * @param double $am            
     * @return \Transactions\Entity\Receipt
     */
    public function setAmountPayed($am)
    {
        $this->amountPayed = $am;
        return $this;
    }

    /**
     *
     * @param unknown $datetiime            
     */
    public function setCreatedOn($datetiime)
    {
        $this->createdOn = $datetiime;
        return $this;
    }

    /**
     *
     * @return \Datetime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }
}


