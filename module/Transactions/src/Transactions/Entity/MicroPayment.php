<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\MicroPaymentStructure;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Transactions\Entity\Repository\MicroPaymentRepository")
 * @ORM\Table(name="micro_payment")
 *
 * @author otaba
 *        
 */
class MicroPayment
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Deprecated
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MicroPaymentStructure")
     * 
     * @var MicroPaymentStructure
     */
    private $microPaymentStructure;

    /**
     * @ORM\ManyToOne(targetEntity="Transactions\Entity\Invoice")
     *
     * @var Invoice
     */
    private $invoice;

    /**
     * This is the actual split of the invoice
     * @ORM\Column(name="value", type="string", nullable=true)
     *
     * @var String
     */
    private $value;

    /**
     * This is the standard rate that will be added to all payment
     * @ORM\Column(name="flat_rate", type="string", nullable=true)
     *
     * @var String
     */
    private $flatRate;

    /**
     * This includes any additional payment inclusive
     * @ORM\Column(name="other_rate", type="string", nullable=true)
     *
     * @var String
     */
    private $otherRate;

    /**
     * This includes any additional payment inclusive
     * @ORM\Column(name="due_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $dueDate;

    /**
     * This includes any additional payment inclusive
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var String
     */
    private $createdOn;

    /**
     * This includes any additional payment inclusive
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     *
     * @var String
     */
    private $updatedOn;

    /**
     * @ORM\ManyToOne(targetEntity="TransactionStatus")
     *
     * @var TransactionStatus
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="Transactions\Entity\Transaction", mappedBy="microPayment")
     *
     * @var Collection
     */
    private $transaction;

    /**
     */
    public function __construct()
    {
        $this->transaction = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMicroPaymentStructure()
    {
        return $this->microPaymentStructure;
    }

    public function setMicroPaymentStructure($pay)
    {
        $this->microPaymentStructure = $pay;
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

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($val)
    {
        $this->value = $val;
        return $this;
    }

    public function getFlatRate()
    {
        return $this->flatRate;
    }

    public function setFlatRate($rate)
    {
        $this->flatRate = $rate;
        return $this;
    }

    public function getOtherRate()
    {
        return $this->otherRate;
    }

    public function setOtherRate($rate)
    {
        $this->otherRate = $rate;
        return $this;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate($date)
    {
        $this->dueDate = $date;
        return $this;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->updatedOn = $date;
        return $this;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function getTransaction()
    {
        return $this->transaction;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($sta)
    {
        $this->status = $sta;
        return $this;
    }

    /**
     *
     * @param Transaction $transaction            
     */
    public function addTransaction($transaction)
    {
        if (! $this->transaction->contains($transaction)) {
            $this->transaction->add($transaction);
            $transaction->setMicroPayment($this);
        }
        return $this;
    }

    /**
     *
     * @param Transaction $tran            
     */
    public function removeTransaction($tran)
    {
        if ($this->transaction->contains($tran)) {
            $this->transaction->removeElement($tran);
            $tran->setMicroPayment(NULL);
        }
        
        return $this;
    }
}

