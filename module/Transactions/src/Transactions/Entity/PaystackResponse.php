<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\PaystackStatus;

/**
 * @ORM\Entity
 * @ORM\Table(name="paystack_response")
 *
 * @author otaba
 *        
 */
class PaystackResponse
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="reference", type="string", nullable=true)
     *
     * @var string
     */
    private $reference;

    // /**
    // * @ORM\ManyToOne(targetEntity="Settings\Entity\PaystackStatus")
    // *
    // * @var PaystackStatus
    // */
    // private $status;
    
    /**
     * @ORM\Column(name="ip_address", type="string", nullable=true)
     *
     * @var string
     */
    private $ipAddress;

    /**
     * @ORM\ManyToOne(targetEntity="Transactions\Entity\Transaction", inversedBy="paystack")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="transaction", referencedColumnName="id")
     * })
     *
     * @var Transaction
     */
    private $transaction;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function setReference($ref)
    {
        $this->reference = $ref;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
        ;
    }

    public function setStatus($state)
    {
        $this->status = $state;
        return $this;
    }

    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    public function setIpAddress($add)
    {
        $this->ipAddress = $add;
        return $this;
    }

    public function getTransaction()
    {
        return $this->transaction;
    }

    public function setTransaction($tran)
    {
        $this->transaction = $tran;
        return $this;
    }
}

