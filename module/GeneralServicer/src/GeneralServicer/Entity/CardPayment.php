<?php
namespace All\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CardPayment
 *
 * @ORM\Table(name="card_payment", indexes={@ORM\Index(name="FK_card_payment_transaction_idx", columns={"transaction_id"}), @ORM\Index(name="FK_card_payment_type_idx", columns={"card_type"})})
 * @ORM\Entity
 */
class CardPayment
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
     * @var string @ORM\Column(name="processor", type="string", length=100, nullable=true)
     */
    private $processor;

    /**
     *
     * @var string @ORM\Column(name="amount", type="decimal", precision=15, scale=4, nullable=true)
     */
    private $amount;

    /**
     *
     * @var string @ORM\Column(name="event_date", type="string", length=45, nullable=true)
     */
    private $eventDate;

    /**
     *
     * @var integer @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     *
     * @var string @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     *
     * @var string @ORM\Column(name="transaction_line_id", type="string", length=200, nullable=true)
     */
    private $transactionLineId;

    /**
     *
     * @var \All\Entity\CustomerTransaction @ORM\ManyToOne(targetEntity="All\Entity\CustomerTransaction")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="transaction_id", referencedColumnName="id")
     *      })
     */
    private $transaction;

    /**
     *
     * @var \All\Entity\CardType @ORM\ManyToOne(targetEntity="All\Entity\CardType")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="card_type", referencedColumnName="id")
     *      })
     */
    private $cardType;

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
     * Set processor
     *
     * @param string $processor            
     *
     * @return CardPayment
     */
    public function setProcessor($processor)
    {
        $this->processor = $processor;
        
        return $this;
    }

    /**
     * Get processor
     *
     * @return string
     */
    public function getProcessor()
    {
        return $this->processor;
    }

    /**
     * Set amount
     *
     * @param string $amount            
     *
     * @return CardPayment
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
     * Set eventDate
     *
     * @param string $eventDate            
     *
     * @return CardPayment
     */
    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;
        
        return $this;
    }

    /**
     * Get eventDate
     *
     * @return string
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity            
     *
     * @return CardPayment
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set description
     *
     * @param string $description            
     *
     * @return CardPayment
     */
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set transactionLineId
     *
     * @param string $transactionLineId            
     *
     * @return CardPayment
     */
    public function setTransactionLineId($transactionLineId)
    {
        $this->transactionLineId = $transactionLineId;
        
        return $this;
    }

    /**
     * Get transactionLineId
     *
     * @return string
     */
    public function getTransactionLineId()
    {
        return $this->transactionLineId;
    }

    /**
     * Set transaction
     *
     * @param \All\Entity\CustomerTransaction $transaction            
     *
     * @return CardPayment
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

    /**
     * Set cardType
     *
     * @param \All\Entity\CardType $cardType            
     *
     * @return CardPayment
     */
    public function setCardType(\All\Entity\CardType $cardType = null)
    {
        $this->cardType = $cardType;
        
        return $this;
    }

    /**
     * Get cardType
     *
     * @return \All\Entity\CardType
     */
    public function getCardType()
    {
        return $this->cardType;
    }
}
